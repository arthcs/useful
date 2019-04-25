<?php

// DDL para redefinir a seguencia em tabelas do Postgresql
	ALTER SEQUENCE payments_id_seq RESTART WITH 22;


//Sugestão para codificação:
Quando for em cadastrar.php usar
utf8_decode(mb_convert_case($_POST[ 'xxxxx' ], MB_CASE_UPPER, "UTF-8"));

Quando for em alterar.php, formVizualizar.php ou formAlterar.php usar
addslashes(mb_convert_case($_POST[ 'xxxxx' ], MB_CASE_UPPER, "UTF-8"));

Quando for listar.php também usar
addslashes(mb_convert_case($row->$line, MB_CASE_UPPER, "UTF-8"));


Comando de comparação "like" no postgres não serve para inteiros.
  Exemplo: $where .= " id like '%$this->idContrato%'";
  Nesse caso deve ser '=' no lugar de 'like', ficando: $where .= " id ='$this->idContrato'";
 O postgres é case sensitive para strings no banco de dados, por isso, tudo deve ser salvo em maiúsculo e pesquisado em maiúsculo.
  Exemplo: Verificar código fonte do model Contratos.php (tiss/sistema/model/Contratos.php).
 Listar não retorna nada devido ao problema de conversão para o php7 na hora de pegar o item do array.
  Exemplo: $row->$filtros[$i];
  Sugestão: 
   $aux = $filtros[$i];
   $row->$aux;
  Ver exemplo no listar de contratos (tiss/sistema/view/contratos/listar.php)

Problema com as tabs, bug onde elas não são selecionas
	$(document).on("show.bs.tab", function() {
		$(".dropdown-item").removeClass("show");
		$(".dropdown-item").removeClass("active");
	});

	?>

	//codigo para debug
	ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);