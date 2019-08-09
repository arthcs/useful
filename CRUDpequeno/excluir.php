<?php 
$log = array(
	'operador'	=> $_SESSION['id'],
	'modulo'	=> '11',
	'pagina'	=> 'Excluir',
	'acao'		=> '6',
	'id'		=> $_GET['id']
);
$f = new Funcoes($log);
$id = $_GET['id'];
$data = array("excluido" => "S");
$exclui = $f->altera("tb_categoria_dependencia", $data, " id = '".$id."'");

if ($exclui != '0') {
	$f->msgSucesso = "Módulo excluida com sucesso!";
	$f->redireciona("painel?f=categoriaDependencia&a=listar");
}
else {
	$f->msgErro = "Erro ao excluir Módulo!";
	$f->redireciona("painel?f=categoriaDependencia&a=listar");
}
?>