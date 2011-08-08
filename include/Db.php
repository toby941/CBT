<?php
final class Db {
	
	public static $mCon    = null;
	public static function closeDb()
    {
    	if(null!=$mCon){
    	mysql_close($mCon);
    	$mCon=null;
    	}
    }

	
	public static function execQuery($sql) {
		$mCon = mysql_connect("ftpbj.gotoftp4.com", "ftpbj", "bj12345678");
		if (!$mCon) {
			die('Could not connect: ' . mysql_error());
		} else {
			mysql_query("SET NAMES 'utf8'");
			mysql_select_db("ftpbj", $mCon);
			$result = mysql_query($sql);
			return $result;
		}
	}

/**
		 * 插入一条数据
		 *
		 * @param 表名 $table
		 * @param 要插入的数组 $data
		 * @return unknown
		 */
		public function insertData($table,$data=array()){
			if($table == '' || !is_array($data)){
				if(DEBUG){
					throw new Exception("Error ==> Paramter Error!");
				}
				return false;
			}		
			
			$keys = '';
			$values = '';
			foreach ($data as $k => $v){
				$keys .=" `$k` ,";
				$values .= " '$v' ,";		
			}
			$keys = substr($keys,0,-1);
			$values = substr($values,0,-1);
		
			$sql = "INSERT INTO `$table` ($keys) VALUES ($values)";
				$result = self::execQuery($sql);
			
		}


	public static function getBigThing($x="", $y="") {
		$result = self::execQuery("SELECT * FROM BIG_THING");
		while ($row = mysql_fetch_array($result)) {
			echo $row['TITLE'];
		}
		 closeDb();
	}

}
?>