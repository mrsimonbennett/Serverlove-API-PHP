<?php

class ServerLove{
	private $url = "https://api.z1-man.serverlove.com";
	private $username;
	private $password;
	
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
    
	function api_call($call,$post=false)
	{
		$qry_str = $call;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_USERPWD, $this->username.':'.$this->password);
		
		if($post == false)
		{
			//GET
			curl_setopt ($curl, CURLOPT_URL, $this->url . $qry_str);
			curl_setopt($curl,CURLOPT_HTTPHEADER,array ("Accept: application/json"));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		} elseif ($post == true) 
		{
			curl_setopt($curl,CURLOPT_URL,$this->url. $call);
			curl_setopt($curl,CURLOPT_POST,'start'); 
			curl_setopt($curl,CURLOPT_POSTFIELDS,'now');
			
			
		}
	   
	   	
	   	
	   
	   $result = curl_exec ($curl);
	   
	   $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		echo $http_status;
		curl_close ($curl);
	   return(json_decode($result,true));
	}
}
$test = new ServerLove();
 
//print_r($test->shutdown("0868daa2-2e8d-4b26-bd39-4503b8ff6ece"));
//print_r($test->listallservers());
 //05496f28-3ca4-437a-ab4c-3b4e2458d6d5
?>
