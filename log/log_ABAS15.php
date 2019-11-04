<?php 

	$id = mysql_insert_id();
	
	$query_log = "INSERT INTO log_sistema(data_hora,usuario,guia,id_guia,acao)VALUES('".date('Y-m-d H:i:')."','{$_SESSION['OPERADOR']}','Beneficiários','{$id}','Cadastrou')";
	$query_log = mysql_query($query_log);

 ?>