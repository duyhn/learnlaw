<?php
class User extends AppModel{
	var $name="User";
	private $userName;
	private $password;
	public $primaryKey = 'user_id';
	public $validate = array(
        'username' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            ),
        ),
        'password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email')
            ),
        ),
    );
 
    //The Associations below have been created with all possible keys, those that are not needed can be removed
 
/**
 * hasMany associations
 *
 * @var array
 */
    public $hasMany = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Topic' => array(
            'className' => 'Topic',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
	
	function setUserName($username){
		$this->userName=$username;
	}
	function getUserName(){
		if(!isset($this->userName)){
			$this->userName="";
		}
		return $this->userName;
	}
	function setPassword($pass){
		$this->password=$pass;
	}
	function getPassword(){
		if(!isset($this->password)){
			$this->password="";
		}
		return $this->password;
	}
	//
	function checkLogin(){
		$sql = "Select username,pass from users Where username='".$this->getUserName()."' AND pass ='".$this->getPassword()."'";
		$data=$this->query($sql);
		if(count($data)==0){
			return false;
		}
		return true;
	}
	//
	//
	function validateUser(){
		$this->validate = array(
				"username"=>array(
						"rule1" =>array(
								"rule" => "notEmpty",
								"message" => "Username can not empty",
						),
						"rule2" => array(
								"rule" => "/^[a-z0-9_.]{4,}$/i",
								"message" => "Username must be alpha & integer",
						),
						"rule3" =>array(
								"rule" => "checkUsername", // call function check Username
								"message" => "Username has been registered",
						),
				),
				
				"pass"=>array(
						"rule" => "notEmpty",
						"message" => "Password can not empty",
						"on" => "create"
				),
				"email"=>array(
						"rule" => "email",
						"message" => "Email is not avalible",
				),
		);
		if($this->validates($this->validate))
			return TRUE;
		else
			return FALSE;
	}

	//--------- Compare Pass
	function ComparePass(){
		if($this->data['User']['pass']!=$this->data['User']['re_pass']){
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	
    //-------- Check Useranme
    function checkUsername(){
        if(isset($this->data[$this->name]['id'])){
            $where = array(
                            "user_id !=" => $this->data[$this->name]['user_id'],
                            "username" => $this->data[$this->name]['username'],
                            ); 
                 
        }
        else{
            $where = array(
                            "username" => $this->data[$this->name]['username'],
                            );  
        } 
        $this->find($where);
        $count = $this->getNumRows();
        if($count!=0){
            return false;
        }
        else{
            return true;
        }
    }
    
    //--- HashPassword
    function hashPassword($data){
        if(isset($this->data['User']['password'])){
            $this->data['User']['password'] = Security::hash($this->data['User']['password'],NULL,TRUE);
            return $data;
        }
        return $data;
    }
    //----- beforeSave
    function beforeSave(){
        $this->hashPassword(NULL,TRUE);
        return TRUE;
    } 
}
?>