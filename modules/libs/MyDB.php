<?php


/*
 * Created on 2009/07/29
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

require_once ("DB.php");

class MySql_DB {

	public function __construct() {

	}

	function DB_Connect() {

		$dsn = DBTYPE . "://" . DBUSER . ":" . DBPASS . "@" . DBSERVER . "/" . DBNAME;
    
		$this->conn = DB :: connect($dsn);

		if (DB :: isError($this->conn)) {
			global $Error_Disp_Msg;
			$str = "$Error_Disp_Msg\n[Error Code] 0001\n" . DB :: errorMessage($this->conn) . "\n";
			$this->Send_Error($str);
			exit;
		}

	}

	# -------------------- テーブルロック

	function DB_Lock_Table($target) {

		$lock_sql = "LOCK TABLES " . $target . " WRITE";
		$res = $this->DB_Sql_Query($lock_sql);

		if (DB :: isError($res)) {
			global $Error_Disp_Msg;
			$str = "$Error_Disp_Msg\n[Error Code] func - 0002\n" . DB :: errorMessage($res) . "\n";
			$this->Send_Error($str);
			exit;
		}

	}

	# -------------------- テーブルロック解除

	function DB_Unlock_Table() {

		$lock_sql = "UNLOCK TABLES";
		$res = $this->DB_Sql_Query($lock_sql);

		if (DB :: isError($res)) {
			global $Error_Disp_Msg;
			$str = "$Error_Disp_Msg\n[Error Code] 0003\n" . DB :: errorMessage($res) . "\n";
			$this->Send_Error($str);
			exit;
		}

	}

	# -------------------- SQL実行

	function DB_Sql_Query($sql , $param_ar ="") {

    if(is_array($param_ar)){
    	
      $sth = $this->conn->prepare($sql);
      $res = $this->conn->execute($sth, $param_ar);
      
    }else{
    	
      $res = $this->conn->query($sql);
    }
    
		

		#echo "$sql<br><br>";

		if (DB ::isError($res)) {

			#echo $sql."<br><br>".DB::errorMessage($res)."<br><br>".$_SERVER['SCRIPT_NAME']."?".$_SERVER['QUERY_STRING'];

			global $Error_Disp_Msg;
			$str = "$Error_Disp_Msg\n[Error Code] 0004\n[msg]" . DB :: errorMessage($res) . "\n";
			$mail_str = $str . "[info]".$res->userinfo;
			$this->Send_Error($mail_str);
			exit;
		}


		return $res;

	}
  
  function Send_Error($mail_str){
    trigger_error($mail_str);
  }
  
  
	# -------------------- INSERT,DELETE,UPDATE実行結果行数取得

	function DB_Affected() {

		return $this->conn->affectedRows();

	}

	# -------------------- SELECT実行結果行取得

	function DB_Numrow($res) {

		return $res->numRows();

	}

	# -------------------- DB切断.3

	function DB_Disconnect() {
		$this->conn->disconnect();
	}

	# -------------------- フィールド情報取得(別のデータベースのテーブルも)
	function DB_Get_Field_Info($Table_Name) {

		$sql = "Describe " . $Table_Name;
		$res = $this->DB_Sql_Query($sql); # 1. クエリ実行
		$Temp_Ar = array ();

		while ($row = $res->fetchRow(DB_FETCHMODE_ASSOC)) {
			array_push($Temp_Ar, $row['Field']);
		}

		return $Temp_Ar;

	}

	# -------------------- SQL文実行結果取得関数(INSERT,UPDATE,DELETE)

	function Pkg_Sql_Result($sql, $target,$param_ar ="") {

		$this->DB_Lock_Table($target); # 1. ロックテーブル

		$res = $this->DB_Sql_Query($sql,$param_ar); # 2. SQL実行

		$rows = $this->DB_Affected(); # 3. 実行結果行数取得
		$this->DB_Unlock_Table(); # 4. テーブルアンロック
    
		return $rows;

	}

}
?>
