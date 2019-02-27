<?php
session_start();

/**
 * Class Name  : Api
 */

 class ApiClient
 {
	protected $endpoint 	= "";	
	protected $org_id 		= "";
	protected $username 	= "";
	protected $password 	= "";
	protected $tokenType 	= "";
	protected $Token 		= "";
	protected $refresh_token = "";
	public $expires_in = 0;
	protected $loggedtime = NULL;
	
 	function __construct($host, $org_id, $username, $password)
 	{
		$this->org_id 	= $org_id;
		$this->username = $username;
		$this->password = $password;
		$this->endpoint =  "https://" . $host . "/api/1.0";	
 	}


	/*
	 * @Name 		getClient
	 * @params 		string 	$url
	 * @return 		mixed
	 */	
	function getClient($url){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		/* set headers*/
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/x-www-form-urlencoded',
			'Accept :application/json',
		));
		return $ch;
	}

	function _exec($ch){
		$res = curl_exec($ch);
		curl_close($ch);
		return $res;
	}

	function _error($resdt){
		if (isset($resdt->error)){
			// echo $resdt->error . "\r\n";
			return true;
		}
		return false;
	}


	/*
	 * @Name 		_POST
	 * @params 		string 	$url, array   body
	 * @return 		mixed
	 */
	public function _POST($url, $body, $is_login = false){
				
		$ch = $this->getClient($url);
		if (!$is_login){
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    'Content-Type: application/json',
				'Accept :application/json',
			));			
		}
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
		return $this->_exec($ch);
	}


	/*
	 * @Name 	: _GET
	 * @params 	: url , body
	 * @return 	: mixed
	 */
	public function _GET($url){
		$ch  = $this->getClient($url);
		return $this->_exec($ch);
	}

	/*
	 * @Name 		_PUT
	 * @params 		string $url , array body
	 * @return 		mixed
	 */
	public function _PUT($url, $body){
		$ch = $this->getClient($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
		return $this->_exec($ch);
	}

	/*
	 * @Name 		_DELETE
	 * @params 		url
	 * @return 		mixed
	 */
	public function _DELETE($url){
		$ch = $this->getClient($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		return $this->_exec($ch);
	}

	/*
	 * @Name 		Login
	 * @params 		none
	 * @return 		mixed
	 */
	public function Login(){		
		$fields = array(
			'org_id'	=> $this->org_id,
			'username'	=> $this->username,
			'password'	=> $this->password,
		);

		$loginUrl = $this->endpoint . "/login.php";
		$res = $this->_POST($loginUrl, http_build_query($fields), true);

		$resdt = json_decode($res);
		if ($this->_error($resdt)){			
			return false;
		}else{
			$this->Token 		= $resdt->access_token;
			$this->refresh_token= $resdt->refresh_token;
			$this->tokenType 	= $resdt->token_type;
			$this->expires_in   = $resdt->expires_in/1000;
			$this->loggedtime 	= time();
			// $_SESSION['user'] 	= $this->username;						
			// echo "Successfully login!\r\n";
			return true;
		}
	}

	/*
	 * @Name 		checkSession
	 * @params 		string 		$nameOfobj  	Name of Objects
	 * @return 		mixed
	 */
	public function checkSession(){
		if (time() - $this->loggedtime > $this->expires_in) {
			unset($_SESSION['api']);
		}
	}

	/*
	 * @Name 		getMetadata
	 * @params 		string 		$nameOfobj  	Name of Objects
	 * @return 		mixed
	 */
	public function _Metadata($nameOfobj){
		$url = $this->endpoint . "/metadata.php/" . $nameOfobj;
		$res = $this->_GET($url);
		$resdt = json_decode($res);
		if ($this->_error($resdt)){
			return null;
		}
		return $resdt;
	}

	/*
	 * @Name   _AllObjects 
	 * @param  string 		$nameOfobj  	Name of Object
	 * @return mixed
	 */
	public function _AllObjects($nameOfobj){
		$url = $this->endpoint . "/index.php/" . $nameOfobj . "/all?access_token=" . $this->Token;
		$res = $this->_GET($url);
		$resdt = json_decode($res);
		return $resdt;
	}

	/*
	 * @Name   _ObjectById 
	 * @param  string 		$nameOfobj  	Name of Object
	 * @return mixed
	 */
	public function _ObjectById($nameOfobj, $id){
		$url = $this->endpoint . "/index.php/" . $nameOfobj . "/" . $id . "/?access_token=" . $this->Token;
		$res = $this->_GET($url);
		$resdt = json_decode($res);
		return $resdt;
	}


	/*
	 * @Name   _DeleteById 
	 * @param  string 		$nameOfobj  	Name of Object,  string 	$id 	id
	 * @return mixed
	 */
	public function _DeleteById($nameOfobj, $id){
		$url = $this->endpoint . "/index.php/" . $nameOfobj . "/" . $id . "/?access_token=" . $this->Token;
		$res = $this->_DELETE($url);
		$resdt = json_decode($res);
		return $resdt;	
	}

	/*
	 * @Name   _Insert 
	 * @param  string 		$nameOfobj  	Name of Object,  array    $fields
	 * @return mixed
	 */
	public function _Insert($nameOfobj, $fields){
		$url = $this->endpoint . "/index.php/" . $nameOfobj . "/?access_token=" . $this->Token;		
		return json_decode($this->_POST($url, json_encode($fields)))[0];
	}	
 }


 if (isset($_SESSION['api']) && isset($_SESSION['user'])) $_SESSION['api']->checkSession();