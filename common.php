<?php 
include_once "mysql.php";
class User { 
    public $username = ''; 
    public $password = ''; 
    public $userid = '';
    public $name;
    
    function __construct($u,$p,$conn) {
    	$this->username = $conn->real_escape_string($u);
		$this->password = $conn->real_escape_string($p);
		$this->userid='';
    }
    function login($conn) { 
    	$username = $conn->real_escape_string($this->username);
    	$password = $conn->real_escape_string($this->password);

    	$q = $conn->query("SELECT id,password,name FROM users WHERE username = '$username' LIMIT 1");
		if ($q->num_rows == 0) {
			return 1;
		}
		else {
			$r = mysqli_fetch_assoc($q);
			if (password_verify($password, $r['password'])) {
				//$hash = password_hash($passwordFromPost, PASSWORD_BCRYPT, $options);
				$this->name = $r['name'];
				$this->userid = $r['id'];
				return 0;
			}
			else {
				return 1;
			}
		}
    } 

} 

class File {
	private $arr = ['doc','docx','xls','xlsx','pdf','ppt','pptx', 'rtf', 'txt','csv', 'pps','xml','mp3', 'mp4','wma','mkv','jpg','png', 'bmp'];
	public $originalname = '';
	public $filesize = '';
	public $servername = '';
	public $error = 0;
	
	function __construct($f, $conn) {
		$this->originalname = $conn->real_ecape_string($f['name']);
		$this->filesize = $conn->real_ecape_string($f['size']);
		$this->servername = $f['tmp_name'];

		if ($this->filesize < 5) { $error = 4; }

		if (!$this->validType()) {
    		{ $error = 5; }
		}
		
	}
	
	function getType() {
		$temp = explode('.', $this->originalname);
		if (count($temp) <= 1) {
			return "wrongEXT";
		}
		return $temp[count($temp)-1];
	}
	
	function validType() {
		if (!in_array($this->getType(), arr)) return false;
		else return true;
	}
	
	
}

?>
