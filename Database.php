<?php 

/**
 * 
 */
class Database
{




	public $host="localhost";
	public $root="root";
	public $password="";
	public $dbname="phpcsv";



	public $link;
	public $error;




 public function __construct()
	{
		$this->dbconnection();
	}

	public function dbconnection(){
		$this->link=new mysqli($this->host,$this->root,$this->password,$this->dbname);
		if (!$this->link) {
			$this->error="connect error".$this->link.connect_error;
		}
		
	}

	public function insertdata($data){
		$insert_row=$this->link->query($data) or die($this->link->error.__line__);
		
	}
	public function selectdata($data){
		$result=$this->link->query($data) or die($this->link->error.__line__);
		if ($result->num_rows > 0) {
			return $result;
		}
		else{
			return false;
		}

	}
public function login($data){
		$logdata=$this->link->query($data) or die($this->link->error.__line__);
		if($logdata -> num_rows > 0 ){
			echo "you are logged";
		}
		else{
			echo 'not login';
		}
	}


	public function deletedata($data){
		$delete=$this->link->query($data) or die($this->link->error.__line__);
		if ($delete) {
			echo "Data is deleteted";
		}
		else{
			echo "not deleted";
		}
	}
	
}



 ?>