<?php
    require_once "./fieldCheck.php";
    require_once "./httpResponse.php";
    require_once "././Model/register.php";
    
    class method {
        public static function newJudge($data) {
            $data = json_decode(json_encode($data));
            if (! fieldCheck::newJudge($data)) {
                httpResponse::mf();
            }
            $DBdata = find("judges", [
                "outside_judge_id" => $data->outside_judge_id
            ]);
            if (count($DBdata) <= 0) {
                $data->score = 0;
                $data->try_limit = 0;
                $insertId = auto_insert("judges", "", $data);
                $result = find("judges", [
                    "id" => $insertId,
                ])[0];
                httpResponse::ok($result);
            }else {
                httpResponse::ok($DBdata[0]);
            }
        }
        
        public static function newQuiz($data) {
            // $data => array[]
            // return judge state

            if(! isset($data['data'])) {
                httpResponse::mf();
            }
            $data = json_decode($data['data']);
            // httpResponse::ok($data);


            // check $data type
            if (gettype($data) != "array") {
                httpResponse::wdt();
            }

            // quiz process
            foreach($data as $quiz) {
                if (! fieldCheck::newQuiz($quiz)) {
                    httpResponse::mf();
                }
                // check judge exists
                $thisJudge = find("judges", [
                    "outside_judge_id" => $quiz->outside_judge_id
                ]);
                if (count($thisJudge) == 0) {
                    httpResponse::jne();
                }
                $thisJudge = $thisJudge[0];
                
                // quiz
                $quiz_id = explode("-", $quiz->question_id);
                $quiz_id = array_pop($quiz_id);
                $thisQuiz = find("quizzes", [
                    "judge_id" => $thisJudge["id"],
                    // "main" => json_encode($quiz->main, JSON_UNESCAPED_UNICODE),
                    // "data_type" => json_encode($quiz->data_type, JSON_UNESCAPED_UNICODE),
                    "question_id" => $quiz_id
                ]);
                if (count($thisQuiz) == 0) {
                    $quiz->judge_id = $thisJudge["id"];
                    $quiz->success = 0;
                    $quiz->main = str_replace("'", "\'", json_encode($quiz->main, JSON_UNESCAPED_UNICODE));
                    $thisQuizId = auto_insert("quizzes", "", [
                        "judge_id" => $thisJudge["id"],
                        "main" => $quiz->main,
                        "data_type" => json_encode($quiz->data_type, JSON_UNESCAPED_UNICODE),
                        "question_id" => $quiz_id
                    ]);
                }else {
                    $thisQuizId = $thisQuiz[0]["id"];
                }

                // options
                if (gettype($quiz->options) != "array") {
                    httpResponse::wdt();
                }
                foreach($quiz->options as $option) {
                    if(! fieldCheck::newOption($option)) {
                        httpResponse::mf();
                    }
                    $option->judge_id = $thisJudge["id"];
                    $option->quiz_id = $thisQuizId;
                    
                    // type switch
                    // ------------------------------------
                    // TODO: change method to formal model
                    // ------------------------------------
                    $option->control_type = json_encode($option->control_type, JSON_UNESCAPED_UNICODE);
                    $option->data_type = json_encode($option->data_type, JSON_UNESCAPED_UNICODE);
                    $option->main = str_replace("'", "\'", json_encode($option->main, JSON_UNESCAPED_UNICODE));
                    
                    $thisOption = find("options", (array)$option);
                    if (count($thisOption) == 0) {
                        auto_insert("options", "", (array)$option);
                    }
                }
            }
            return httpResponse::ok();
        }

        public static function overview($data, $resultJson = false) {
            // $data must have outside_judge_id
            $data = json_decode(json_encode($data));
            if (! isset($data->outside_judge_id)) {
                return httpResponse::mf();
            }
            // check judge exists
            $thisJudge = find("judges", [
                "outside_judge_id" => $data->outside_judge_id
            ]);
            if (count($thisJudge) == 0) {
                httpResponse::jne();
            }
            $thisJudge = $thisJudge[0];
            $quizzes = find("quizzes", [
                "judge_id" => $thisJudge["id"]
            ]);
            foreach($quizzes as &$quiz) {
                $quiz["main"] = json_decode($quiz["main"]);
                $quiz["data_type"] = json_decode($quiz["data_type"]);
                $quiz["options"] = find("options", [
                    "judge_id" => $thisJudge["id"],
                    "quiz_id" => $quiz["id"]
                ]);
                foreach($quiz["options"] as &$option) {
                    $option["main"] = json_decode($option['main']);
                    $option["data_type"] = json_decode($option['data_type']);
                    $option["control_type"] = json_decode($option['control_type']);
                }
                unset($option);
            }
            unset($quiz);
            
            $result = [
                "internal_judge_id" => (int)$thisJudge["id"],
                "outside_judge_id" => (int)$thisJudge["outside_judge_id"],
                "course_name" => $thisJudge["course_name"],
                "judge_name" => $thisJudge["judge_name"],
                "try_limit" => (int)$thisJudge['try_limit'],
                "score" => $thisJudge['score'],
                "quizzes" => $quizzes
            ];
            
            // type switch
            // ------------------------------------
            // TODO: change method to formal model
            // ------------------------------------
            foreach($result["quizzes"] as &$quiz) {
                $quiz["id"] = (int)$quiz["id"];
                $quiz["judge_id"] = (int)$quiz["judge_id"];
                $quiz["success"] = (int)$quiz["success"] == 1;
                foreach($quiz["options"] as &$option) {
                    $option["id"] = (int)$option["id"];
                    $option["judge_id"] = (int)$option["judge_id"];
                    $option["quiz_id"] = (int)$option["quiz_id"];
                    $option["is_right"] = (int)$option["is_right"] == 1;
                    $option["tried"] = (int)$option["tried"] == 1;
                }
                unset($option);
            }
            unset($quiz);
            
            return $resultJson ? httpResponse::ok($result) : $result;
        }

        public static function guessNext($data) {
            $judge = json_decode(json_encode(self::overview($data)));
            $result = [
                "internal_judge_id" => $judge->internal_judge_id,
                "outside_judge_id" => $judge->outside_judge_id,
                "course_name" => $judge->course_name,
                "judge_name" => $judge->judge_name,
                "quiz_limit" => count($judge->quizzes),
                "try_limit" => $judge->try_limit,
                "score" => $judge->score,
                "quizzes" => []
            ];
            foreach($judge->quizzes as $quiz) {
                foreach($quiz->options as $option) {
                    $quiz->option = [];
                    if ($option->is_right || !$option->tried) {
                        $quiz->option = $option;
                        break;
                    }
                }
                unset($quiz->options);
                $result["quizzes"][] = $quiz;
            }
            return httpResponse::ok($result);
        }

        public static function resultUpdate($data) {
            $data = json_decode($data['data']);

            if (! fieldCheck::searchJudge($data)) {
                return httpResponse::mf();
            }
            $thisJudge = find("judges", [
                "outside_judge_id" => $data->outside_judge_id
            ]);
            if (count($thisJudge) == 0) {
                httpResponse::jne();
            }
            $thisJudge = $thisJudge[0];
            auto_insert("judges", $thisJudge["id"], [
                "score" => $data->score,
                "try_limit" => (int)$thisJudge["try_limit"] + 1
            ]);
            foreach($data->quizzes as $quiz) {
                if ($quiz->success) {
                    auto_insert("quizzes", $quiz->id, [
                        "success" => 1
                    ]);
                }
                if (isset($quiz->option->id)) {
                    auto_insert("options", $quiz->option->id, [
                        "is_right" => $quiz->option->is_right ? 1 : 0,
                        "tried" => $quiz->option->tried ? 1 : 0
                    ]);
                }
            }
            return httpResponse::ok($data);
            
        }
    }