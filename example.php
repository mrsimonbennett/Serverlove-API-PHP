<?php

include "serverlove.class.php";

$serverlove = new ServerLove("Username","password");
 
foreach ($serverlove->listallservers() as $server){
	echo $server["uuid"];	
}

