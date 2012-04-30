<?php
		include "serverlove.class.php";
		
		$serverlove = new ServerLove('username','password');
		
		foreach($serverlove->serverslist() as $server)
		{
			$serveridlist[] = $server['uuid'];
		}
		foreach ($serveridlist as $server)
		{
			$serverdetails[] = $serverlove->serverinfo($server);	
		}
	
		echo '<pre>UUID of each Server you have: <br>';
	
		print_r($serveridlist);
	/*Example
	Array
	(
		[0] => 200fa0c1-5s56-4132-9219-6b69dc64395c
	)
	*/ 
		echo 'Info on each server you have: <br>';
		print_r($serverdetails);
	
	/*Example
	Array
	(
		[0] => Array
			(
				[boot] => ide:0:0
				[cpu] => 500
				[ide:0:0] => f553fe00-231a-db26-b282-bfse63dsa79a
				[mem] => 256
				[name] => backupserver
				[nic:0:dhcp] => 192.168.0.2
				[nic:0:model] => e1000
				[persistent] => true
				[server] => 200fa0c1-5s56-4132-9219-6b69dc64395c
				[smp] => auto
				[status] => stopped
				[user] => Your Server love api username
				[vnc] => auto
				[vnc:password] => raw_password
			)
	)		
	*/

