<?php
    require_once "./conn.php";
    require_once "./method.php";
    require_once "./httpResponse.php";
    // force cors
    header('Access-Control-Allow-Origin: *');
    if (!isset($g['method'])) {
        return;
        // httpResponse::me();
    }

    switch($g["method"]) {
        case "newJudge": 
            method::newJudge($p);
            break;
        case "newQuiz": 
            method::newQuiz($p);
            break;
        case "overview":
            method::overview($p, true);
            break;
        case "guessNext":
            method::guessNext($p);
            break;
        case "resultUpdate":
            method::resultUpdate($p);
            break;
    }



    