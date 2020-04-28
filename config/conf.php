<?php
        $con = new PDO('mysql:host=localhost;dbname=yammobot',"root","");
	    //$con = new PDO('mysql:host=localhost;dbname=utycc_testb',"utycc_testdbusr","yQ&(pknsmwol");
		$con->exec("SET NAMES UTF-8;");
		$con->exec("SET character_set_results=UTF-8;");
		$con->exec("SET character_set_client=UTF-8;");
		$con->exec("SET character_set_connection=UTF-8;");
		$con->exec("SET collation_connection=UTF-8;");
?>
