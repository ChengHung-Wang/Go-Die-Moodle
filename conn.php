<?php
    $conn = new PDO("mysql:host=127.0.0.1;dbname=fuck_moodle;charset=utf8mb4","root","");
	$g = $_GET;
	$p = $_POST;
	$c = $_COOKIE;
	
    function q($cmd){
		global $conn;
		return $conn->query($cmd);
	}
	function f($cmd){
		return q($cmd)->fetchAll(PDO::FETCH_ASSOC);
	}
	function auto_insert($table,$id,$data){
		global $conn;
		if($id == ""){
			q("INSERT INTO `$table`(`id`)VALUES(null)");
			$id = $conn->lastInsertId();
		}
		foreach($data as $k=>$v){
			q("UPDATE `$table` SET `$k` = '$v' WHERE `id` = $id");
		}
		return $id;
	}
	function find($table, $data){
		if($data == ""){
			return f("SELECT * FROM `$table`");
		}else{
			foreach($data as $k => $v){
				$tmp[] = sprintf("`%s` = '%s'",$k,$v);
			}
			// echo "SELECT * FROM `$table` WHERE " . join(" AND ", $tmp) . "\n\n";
			return f("SELECT * FROM `$table` WHERE " . join(" AND ", $tmp));
		}
	}
	

	// class dataFetch {
		
	// }

	// class dataInsert {

	// }

	// class dataUpdate {

	// }
	

	