<?php
	class PasswordManager {
 
    public $Username = '';
	public $Password = '';
	
	public function __construct($uname, $pass) {
        $this->Username = $uname;
		$this->Password = $pass;
    } 
 
    protected function encrypt($str){
        return md5($str);
    }
 
    protected function verifyPassword($str){
        return  md5($str)==md5($this->Password)?true:false;
    }
	
	public function validatePassword($pass){
		$err='';
		
		if (strpos($pass, ' ') !== false) {
			$err .='The password must not contain any whitespace.<br>';
		}
		
		if (strlen($pass) < 6 ) {
			$err .='The password must be at least 6 characters long.<br>';
		}
		
		if (!preg_match("#[A-Z]+#",$pass) || !preg_match("#[a-z]+#",$pass)) {
			$err .='The password must contain at least one uppercase and at least one lowercase letter.<br>';
		}
		
		if (!preg_match('/[^a-zA-Z0-9]/', $pass)) {
			$err .='The password must have at least one digit and symbol.<br>';
		}

        return  $err;
    }
	
	public function setNewPassword($pass){
		
		if ($this->validatePassword($pass)==''){
			$this->Password = md5($pass);
			return true;
		}else{
			return false;
		}
    }
	
	public function storeUser(){
		$file='password.txt';
		$content='username: ' . $this->Username . '; password: ' . $this->Password;
		
		if (file_exists($file)) {
		  $fh = fopen($file, 'a');
		} else {
		  $fh = fopen($file, 'w');
		} 
		fwrite($fh, $content."\n");
		fclose($fh);
    }
}

?>

