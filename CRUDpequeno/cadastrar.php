<?php 

$log = array(
	'operador'	=> $_SESSION['id'],
	'modulo'	=> '5',
	'pagina'	=> 'atualizar',
	'acao'		=> '4',
	'id'		=> $_POST['id']
);

$f = new Funcoes($log);

$requeridos = array(
	'categoria'	=> $_POST['categoria']
);

if ($f->validaFormulario($requeridos) == '0') {
	$f->msgErro = "Preencha todos os campos requeridos!";
	$f->redireciona("painel?categoriaDependencia&a=formCadastrar");
	exit();
}

$data = array(
	'categoria'	=> $_POST['categoria'],
	'excluido'  => 'N'
);

//var_dump($_POST);
//echo("<br>");echo("<br>");echo("<br>");
//var_dump($data);
//echo("<br>");echo("<br>");echo("<br>");

//print_r($data); echo "<br>"; echo ($_POST['id']);

$cadastrar = $f->insere("tb_categoria_dependencia", $data);

if ($cadastrar == '0') {
	$f->msgSucesso = "Categoria cadastrada com sucesso!";	
	$f->redireciona("painel?f=categoriaDependencia&a=listar");
}
else {
	$f->msgErro = "Erro ao cadastrar Categoria!";
	$f->redireciona("painel?f=categoriaDependencia&a=formCadastrar");
}

?>