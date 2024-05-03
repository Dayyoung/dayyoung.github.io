<?php
/*
	
	GDBM 핸들링 함수 모음

*/


/* DB Open */
function dbm_open($file, $flags) // string
{
	if(!file_exists($file)) {
		err("데이터베이스 화일이 존재하지 않습니다.\\nFileName : $file");
	} else {
		for($i = 0 ; $i < 10 ; $i++) {
			$dbm = @dbmopen($file, $flags);
			if($dbm) {
				return $dbm;
				break;
			} else {
				usleep(500000);
			}
		}
		err("데이터베이스에 접근하지 못하였습니다.");
	}
}


/* DB Fetch */
function dbm_fetch($dbm, $key) // string
{
	$val = dbmfetch($dbm, $key);
	return $val;
}


/* DB Close */
function dbm_close($dbm) // void
{
	dbmclose($dbm);
}


/* DB Insert */
function dbm_insert($dbm, $key, $value) // void
{
	if(dbmexists($dbm, $key)) {
		dbm_replace($dbm, $key, $value);
	} else {
		$result = dbminsert($dbm, $key, $value);

		switch($result)
		{
			case "-1" :
				err("데이터 베이스 추가 오류 입니다.\\n이유 : 읽기 전용으로 열린 데이터 베이스");
				break;
		}
	}
}


/* DB Replace */
function dbm_replace($dbm, $key, $value) // void
{
	dbmreplace($dbm, $key, $value);
}

/*	DB Delete */
function dbm_delete($dbm, $key)
{
	$result = dbmdelete($dbm, $key);
	
	if($result) {
		return true;
	} else {
		return false;
	}
}
?>
