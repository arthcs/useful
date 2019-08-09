<?php 

	//codigo para debug
	ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(0);

$log = array(
	'operador'	=> $_SESSION['id'],
	'modulo'	=> '5',
	'pagina'	=> 'atualizar',
	'acao'		=> '4',
	'id'		=> ''
);


$id=$_POST['id_categoria'];

echo $id;

$f = new Funcoes();

$requeridos = array(
	'categoria'	=> $_POST['categoria']
);

if ($f->validaFormulario($requeridos) == '0') {
	$f->msgErro = "Preencha todos os campos requeridos!";
	$f->redireciona("painel?f=categoriaDependencia&a=formAlterar&id=".$id);
	exit();
}

$data = array(
	'categoria'	=> $_POST['categoria']
);

//print_r($data);

$alterar = $f->altera("tb_categoria_dependencia", $data, " id = ".$id);

if ($alterar != '0') {
	$f->msgSucesso = "Categoria alterada com sucesso!";
	$f->redireciona("painel?f=categoriaDependencia&a=listar");
}
else {
	$f->msgErro = "Erro ao alterar Categoria!";
	$f->redireciona("painel?f=categoriaDependencia&a=formAlterar&id=".$id);
}

?>