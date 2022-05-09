<?php
    class httpResponse {
		// ERR_MISSING_FIELD
		public static function mf() {
			self::json([
				"success" => false,
				"reason" => "ERR_MISSING_FIELD"
			], 400);
			return;
		}
		
		// ERR_JUDGE_NOT_EXISTS
		public static function jne() {
			self::json([
				"success" => false,
				"reason" => "ERR_JUDGE_NOT_EXISTS"
			], 400);
			return;
		}
		
		// ERR_MISSING_METHOD
		public static function me() {
			self::json([
				"success" => false,
				"reason" => "ERR_MISSING_METHOD"
			], 400);
			return;
		}

		// ERR_WRONG_DATA_TYPE
		public static function wdt() {
			self::json([
				"success" => false,
				"reason" => "ERR_WRONG_DATA_TYPE"
			], 400);
			return;
		}

		// ok
		public static function ok($data = "") {
			self::json([
				"success" => true,
				"data" => $data
			]);	
			return;
		}

		private function json($data, $stateCode = 200) {
			header('Accept: application/json');
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
			echo json_encode($data, JSON_PRETTY_PRINT);
			http_response_code($stateCode);
			exit;
		}
	}