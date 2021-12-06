<?php
    // 欄位確認
	class fieldCheck {
		private static function check($request_data, $checkField) {
			foreach($checkField as $main) {
				if (! isset($request_data->$main)) {
					return false;
				}
			}
			return true;
		}

		// 新增自動測驗題組
		public static function newJudge($request_data) {
			$requestField = [
				"outside_judge_id",
				"course_name",
				"judge_name",
			];
			return self::check($request_data, $requestField);
		}

		// 查詢測驗
		public static function searchJudge($request_data) {
			$requestField = [
				"outside_judge_id",
			];
			return self::check($request_data, $requestField);
		}

		// 查詢題目
		public static function searchQuiz($request_data) {
			$requestField = [
				"judge_id",
				"main",
				"data_type",
				"question_id"
			];
			return self::check($request_data, $requestField);
		}
	
		// 新增題目
		public static function newQuiz($request_data) {
			$requestField = [
				"outside_judge_id",
				"main",
				"data_type"
			];
			return self::check($request_data, $requestField);
		}

		// 新增題目選項
		public static function newOption($request_data) {
			$requestField = [
				"main",
				"data_type",
				"control_type"
			];
			return self::check($request_data, $requestField);
		}
		

	}
