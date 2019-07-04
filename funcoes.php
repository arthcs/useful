<?php

//Busca dados e traz um objeto;
$queryVersao = "SELECT * FROM tb_aux_schemas WHERE versao = '$versaoSelecionada'";
$stmVersao = $conn->prepare($queryVersao);
$stmVersao->execute();

$dadosVersao = $stmVersao->fetchObject();

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

	

	//desabilita os notice e o report de erros
	error_reporting(0);

	//codigo para debug
	ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);

    //seleciona = "SELECT ifnull(guia_principal, id) as guia FROM tb_solicitacao_sadt WHERE id = '$id'";
    $query=
    $stm = $conn->prepare($query);
	$stm->execute();
	$dados = $stm->fetchObject();

	//inserir ou Update
	$insere = $conn->prepare("INSERT INTO tb_auxiliar_procedimentos (guia, coluna, status, informacoes_solicitadas, justificativa_negado, data_solicitacao, data_negado, quantidade_autorizada)
										VALUES (:guia, :coluna, :status, :informacoes_solicitadas, :justificativa_negado, :data_solicitacao, :data_negado, :qtdAut)");
			$insere->execute(array(
				':guia'						=> $id,
				':coluna'					=> $coluna,
				':status'					=> $status,
				':informacoes_solicitadas'	=> $infoComplIn,
				':justificativa_negado'		=> $justificativaIn,
				':data_solicitacao'			=> $dataSolIn,
				':data_negado'				=> $dataNegadoIn,
				':qtdAut'					=> $qtdAut
			));
			$linha = "status_procedimento_solicitado".$coluna;
			$linhaQtd = "qntde_procedimento_autorizado".$coluna;

			$altera = $conn->prepare("UPDATE tb_solicitacao_sadt SET ".$linha." = :valor, ".$linhaQtd." = :qtd WHERE id = '$id'");
			$altera->execute(array(
				':valor' => $status,
				':qtd' 	 => $qtdAut
			));
?>

<?php 
//detecta encoding e altera.
function detect_encoding($string)
{
    ////w3.org/International/questions/qa-forms-utf-8.html
    if (preg_match('%^(?: [\x09\x0A\x0D\x20-\x7E] | [\xC2-\xDF][\x80-\xBF] | \xE0[\xA0-\xBF][\x80-\xBF] | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} | \xED[\x80-\x9F][\x80-\xBF] | \xF0[\x90-\xBF][\x80-\xBF]{2} | [\xF1-\xF3][\x80-\xBF]{3} | \xF4[\x80-\x8F][\x80-\xBF]{2} )*$%xs', $string))
        return 'UTF-8';
 
    //If you need to distinguish between UTF-8 and ISO-8859-1 encoding, list UTF-8 first in your encoding_list.
    //if you list ISO-8859-1 first, mb_detect_encoding() will always return ISO-8859-1.
    return mb_detect_encoding($string, array('UTF-8', 'ASCII', 'ISO-8859-1', 'JIS', 'EUC-JP', 'SJIS'));
}
 
function convert_encoding($string, $to_encoding, $from_encoding = '')
{
    if ($from_encoding == '')
        $from_encoding = detect_encoding($string);
 
    if ($from_encoding == $to_encoding)
        return $string;
 
    return mb_convert_encoding($string, $to_encoding, $from_encoding);
}
//exemplo de uso: $newString = convert_encoding($oldString, 'UTF-8');


//muda os caaracteres
function charset_decode_utf_8 ($string) {
        /* Only do the slow convert if there are 8-bit characters */
        /* avoid using 0xA0 (\240) in ereg ranges. RH73 does not like that */
        if (! preg_match("[\200-\237]", $string) and ! preg_match("[\241-\377]", $string))
            return $string;
 
        // decode three byte unicode characters
        $string = preg_replace("/([\340-\357])([\200-\277])([\200-\277])/", 
        "'&#'.((ord('\\1')-224)*4096 + (ord('\\2')-128)*64 + (ord('\\3')-128)).';'",   
        $string);
 
        // decode two byte unicode characters
        $string = preg_replace("/([\300-\337])([\200-\277])/",
        "'&#'.((ord('\\1')-192)*64+(ord('\\2')-128)).';'",
        $string);
 
        return $string;
}
//modo de usar
$seuTextoTransformado = charset_decode_utf_8($textoATransformar);
echo $seuTextoTransformado;
 ?>