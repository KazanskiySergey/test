<?
class sys{
	public $message;
	
	public function __construct(){
		session_start();
	}
	//==========================================================================
	public function is_auth(){
		if( isset( $_SESSION['auth'] ) ){
			$user = $this->test_by_elems( $_SESSION['login'] );			
			if( md5( $user['login'] . $user['pass'] ) == $_SESSION['auth'] ){								
				return  $user;
			} else {				
				unset($_SESSION);
			}			
		} else {
			return false;
		}
	}
	//==========================================================================
	public function auth_user(){			
		if( isset($_POST['login']) && isset($_POST['pass']) ){
			$user = $this->test_by_elems( $_POST['login'] );
			if( $user ){
				if( md5( $_POST['pass'] ) == $user['pass'] ){
					$_SESSION['login'] = $user['login'];
					$_SESSION['auth'] = md5( $user['login'] . $user['pass'] );
					header("Location:/");					
				} else {					
					$this->message = "pass incorrect";
					return false;
				}
			} else {
				$this->message = "login incorrect";
				return false;
			}
		}
	}
	//==========================================================================
	public function register_user(){		
		$inputs = [
			[ 
				microtime(true),
				$_POST['login'],
				md5( $_POST['pass'] ),
				$_POST['email'],				
				date('Y-m-d h:m:s', strtotime( $_POST['bday'] ) ) 
			]
		];
		
		$exist = $this->get_exist_row($inputs[0]);
		if( !$exist ){
			$fp = fopen( __dir__ . '/data/data.csv', 'a' );
			foreach ($inputs as $fields) {
				fputcsv($fp, $fields);
			}
			fclose($fp);
			
			$_SESSION['login'] = $_POST['login'];
			$_SESSION['auth'] = md5( $_POST['login'] . md5( $_POST['pass'] ) );
			header("Location:/");
		} else {
			$this->message = $exist;
		}
	}
	//==========================================================================
	public function logout(){
		unset($_SESSION['auth']);
		unset($_SESSION['login']);		
		header("Location:/");
	}
	
	/// sys ======================================================================
	public function test_by_elems($el_name){
			$csv = array_map( 'str_getcsv', file( __dir__ . '/data/data.csv' ) );
			foreach( $csv as $k=>$row ){
				if( in_array( $el_name, $row ) ){	
					$output = [
						'id'=>$row[0],
						'login'=>$row[1],
						'pass'=>$row[2],
						'email'=>$row[3],
						'bday'=>$row[4]
					];
				}
			}			
			return $output;
	}
	//==========================================================================
	public function get_all_users(){
			$csv = array_map( 'str_getcsv', file( __dir__ . '/data/data.csv' ) );
			foreach( $csv as $k=>$row ){
					$output[$k] = [
						'id'=>$row[0],
						'login'=>$row[1],
						'pass'=>$row[2],
						'email'=>$row[3],
						'bday'=>$row[4]
					];
			}			
			return $output;
	}
	//==========================================================================
	public function get_exist_row($inputs){		
		$csv = array_map( 'str_getcsv', file( __dir__ . '/data/data.csv' ) );		
		foreach( $csv as $k=>$row ){
			if( in_array( $inputs[1], $row ) || in_array( $inputs[3], $row ) ){
				return 'username or email exists';//'row_'.$k.'_exists';
			}
		}
		return false;
	}
	//==========================================================================
	public function view($path, $args=false){		
		$user = $this->is_auth();
		require("views/layout.php");
	}
	//==========================================================================
	public function to_sql(){
		$q = "
		CREATE TABLE IF NOT EXISTS `logs`(
		`id` INT AUTO_INCREMENT NOT NULL,
		`_id` DOUBLE DEFAULT NULL,
		`login` VARCHAR(100),
		`pass` VARCHAR(100),
		`email` VARCHAR(100),
		`bday` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (`id`))
		CHARACTER SET utf8 COLLATE utf8_general_ci;
		";
		
		$csv = array_map( 'str_getcsv', file( __dir__ . '/data/data.csv' ) );		
		foreach( $csv as $k=>$row ){
			$q .= "
			INSERT INTO `logs`(`_id`,`login`,`pass`,`email`,`bday`)
			VALUES({$row[0]},'{$row[1]}','{$row[2]}','{$row[3]}','{$row[4]}');
			";			
		}		
		file_put_contents( __dir__ . "/sql/data.sql", $q );
		if( file_exists( __dir__ . "/sql/data.sql" ) ){			
			$file = __dir__ . "/sql/data.sql";
			if (file_exists($file)) {
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="'.basename($file).'"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				readfile($file);
				exit;
			}
		}
	}
}
?>