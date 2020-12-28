<?php

/**
 * 
 */
class Database extends PDO
{
    private $_display = "";
	function __construct()
	{
		//parent::__construct("mysql:host=sql201.0fees.us;dbname=0fe_23763878_review;","0fe_23763878","RheaS0ftd3v");
		//parent::__construct("mysql:host=myelination;dbname=myelinat_rebyu;","myelinat_admin","#Rheas0ftd3v#");
		parent::__construct("mysql:host=freedb.tech;dbname=freedbtech_myelination","freedbtech_username","password");
	}


	public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        
        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }

    

    public function display($sql){
		$num = 1;
        $sth = $this->prepare($sql);
		$sth->execute();
		$this->_display = "";
		while ($row=$sth->fetch()) {
			
			$this->_display .= "<input type='hidden' value='".$row["review_id"]."' id='review_id'>";
			$this->_display .= "<p>".$num." ".$row["review_question"]."</p>";
			$this->_display .= "<input type = 'text' placeholder = 'answer' id = 'useranswer_id".$num."' class='form-control' style='margin-bottom:8px;'>";
			$this->_display .= "<input type = 'button' value = 'check' class='btn btn-warning btn-sm' id = 'check_id".$num."'>";
			$this->_display.="<hr><br>";
			$num+=1;
			
		}
		echo $this->_display;

      
	}
	

	public function insert($sql,$param = array()){
		$sth = $this->prepare($sql);
        $sth->execute($param);
		
	}

	public function getData($sql){
		$sth = $this->prepare($sql);
		$sth->execute();
		return $sth->fetch();
	}

	public function getValue($sql,$array = array(), $fetchMode = PDO::FETCH_ASSOC){
		$sth = $this->prepare($sql);

        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        
        $sth->execute();
        return $sth->fetchAll($fetchMode);
	}

	public function getQuestions($sql,$param,$array = array(), $fetchMode = PDO::FETCH_ASSOC){
		$sth = $this->prepare($sql);

        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        
        $sth->execute($param);
        return $sth->fetchAll($fetchMode);
	}

	public function deleteData($id){
		
		$sth = $this->prepare("DELETE FROM `review_tbl` WHERE `review_tbl`.`review_id` =".$id);
		$sth->execute();
		return $id;
	}


	public function register($sql,$param){
		$id = 0;
		$sth = $this->prepare("select user_id from user_tbl where username =:username and password =:password");
		$sth->execute($param);
		while ($row=$sth->fetch()) {
			$id = $row['user_id'];
		}
		if($id>0){
			return "username or password already exists";
		}else{
			$sth = $this->prepare($sql);
			$sth->execute($param);
			return "saved successfully!";
		}
	}

	public function login($sql,$param){
		$id = 0;
		$sth = $this->prepare($sql);
		$sth->execute($param);
		while ($row=$sth->fetch()) {
			$id = $row['user_id'];
		}
		if($id>0){
			return "login successfully!";
			
		}else{
			return "invalid username or password";
			
		}
	}

	public function getCount($sql,$param){
		$sth = $this->prepare($sql);
		$id = 0;
		$sth->execute($param);
		while ($row=$sth->fetch()) {
			$id = $row['number'];
		}

		return $id;
	}

	

}
