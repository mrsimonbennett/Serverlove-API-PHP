<?php
/**
 * ServerLove
 *
 * PHP Version 5
 *
 * Copyright (c) 2012, Simon Bennett
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions are met:
 *
 * - Redistributions of source code must retain the above copyright notice, 
 *   this list of conditions and the following disclaimer.
 * - Redistributions in binary form must reproduce the above copyright notice, 
 *   this list of conditions and the following disclaimer in the documentation 
 *   and/or other materials provided with the distribution.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE 
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE 
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR 
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF 
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN 
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE 
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package  ServerLove
 * @category Services
 * @author   Simon Bennett <simon@bennett.im>
 * @license  http://www.opensource.org/licenses/bsd-license.php New BSD License  
 * @version  @package_version@
 * @link     https://github.com/wgas/Serverlove-API-PHP
 * @link     
 */
class ServerLove{
	
	// Request URL
	// @var string $apiUrl
	private static $apiUrl = "https://api.z1-man.serverlove.com";
	
	private $username;
	private $password;
	
	public function __construct($username = NULL,$password = NULL)
	{
		$this->username = $username;
		$this->password = $password;	
	}
	//Server 
	function listallservers(){
		return $this->api_call('/servers/list');
	}
	function serverinfo($serviceid)
	{
		return $this->api_call("/servers/$serviceid/info");	
	}
	function shutdown($serviceid){
		return $this->api_call("/servers/$serviceid/shutdown",true);	
	}
	function start($serviceid){
		return $this->api_call("/servers/$serviceid/start",true);	
	}
	function serverset($uuid,$options){
		return $this->api_call("/servers/$uuid/set",$options);	
	}
    //Drives
	function listalldrives(){
		return $this->api_call('/drives/list');
	}
	function driveinfo($driveid)
	{
		return $this->api_call("/drives/$driveid/info");	
	}
	function drivecreate($options)
	{
		return $this->api_call("/drives/create",$options);		
	}
	function drivesset($uuid,$options){
		return $this->api_call("/drives/$uuid/set",$options);	
	}
	
	
	//Curl
	function api_call($call,$options = NULL)
	{
		$qry_str = $call;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_USERPWD, $this->username.':'.$this->password);
		
		if(empty($options))
		{
			//GET
			curl_setopt ($curl, CURLOPT_URL, self::$apiUrl . $qry_str);
			curl_setopt($curl,CURLOPT_HTTPHEADER,array ("Accept: application/json"));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		} else 
		{
			curl_setopt($curl,CURLOPT_URL,self::$apiUrl . $call);
			curl_setopt($curl,CURLOPT_POST,1); 
			curl_setopt($curl,CURLOPT_POSTFIELDS,$options);
			
			
		}
	   
	   	
	   	
	   
	   $result = curl_exec ($curl);
	   
	   //echo $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		
		curl_close ($curl);
	   return(json_decode($result,true));
	}
}
?>