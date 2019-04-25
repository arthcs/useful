<?php
	$cep = $_POST['cep'];
	 
	//$reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=".$cep);

	$reg = simplexml_load_file("https://viacep.com.br/ws/".$cep."/xml");
	 
	$dados['sucesso'] = '1';
	$dados['rua']     = (string) strtoupper($reg->logradouro);
	$dados['bairro']  = (string) strtoupper($reg->bairro);
	$dados['cidade']  = (string) strtoupper($reg->localidade);
	$dados['estado']  = (string) $reg->uf;
	$dados['ibge']    = (string) $reg->ibge;
	//$dados['ibge']  = (string) $SegReg->ibge;

	//print_r($dados);
	 
	echo json_encode($dados);
?>
