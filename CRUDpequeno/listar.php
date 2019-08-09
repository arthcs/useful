<?php 
	//codigo para debug
	ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(0);

include'model/Procedimentos.php';


$pgIndex = "subTabMedicas";

$log = array(
	'operador'	=> $_SESSION['id'],
	'modulo'	=> '14',
	'pagina'	=> 'Listar',
	'acao'		=> '5',
	'id'		=> ''
);

$f = new Funcoes($log);

$titulo = "Categorias de Dependências Cadastradas";

$filtros = array(
				0 => "id", 
				1 => "categoria"
			);

$campos = array(
				0 => "Código", 
				1 => "Categodia"
			);

$tamanhos = array(
				0 => "10%",
				1 => "90%"
			);

?>
<div class="container" id="principal">
	<h3 align="center"><?=$titulo?></h3>
	<hr>
	<form action="" method="POST">
		<div class="row">	
			<div class="col-md-1">
				<label>Campo</label>
			</div>
			<div class="col-md-3">
				<select name="filtro" id="filtro" class="form-control-sm form-control" required>
					<option value="">Selecione</option>
					<?php 
					for ($i=0; $i < count($campos); $i++) { 
						if (!empty($filtros[$i])) {
							?>
								<option value="<?= $filtros[$i] ?>"> <?= $campos[$i] ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
			<div class="col-md-1">
				<label>Pesquisar</label>
			</div>
			<div class="col-md-3">
				<input type="text" name="vlrPesquisa" id="vlrPesquisa" class="form-control-sm form-control" required>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-success btn-sm btn-block">
					<i class="fa fa-search"></i> Pesquisar
				</button>
			</div>
		</div>
	</form>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<a href="painel?f=categoriaDependencia&a=formCadastrar" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i> Cadastrar Nova Categoria</a>
		</div>
	</div>
	<hr>
	<table id="dataTableListar" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <?php 
                for ($i=0; $i < count($campos); $i++) { 
                	?>
                	<th width="<?= $tamanhos[$i] ?>"><?= $campos[$i] ?></th>
                	<?php
                }
                ?>
                <th width="10%">Ações</th>
            </tr>
        </thead>
        <tbody>
        	<?php 

        	// filtro
        	$where = "id is not null";

        	if (!empty($_POST['filtro']) && !empty($_POST['vlrPesquisa'])) {
        		if ($_POST['filtro'] == 'id') {
        			$where .= " and ".$_POST['filtro']." = '".$_POST['vlrPesquisa']."'";
        		}else{
        			$where .= " and ".$_POST['filtro']." like '%".$_POST['vlrPesquisa']."%'"; 
        			} 		
        	}

        	$conn = Database::connect();        	
        	$query ="SELECT * from tb_categoria_dependencia where {$where}";
        	//echo $query;
			$stm = $conn->prepare($query);
			$stm->execute();
			$dados = $stm->fetchAll(PDO::FETCH_ASSOC);

        	//mostra registro na tabela
        	if ($dados != '0') {
        		foreach ($dados as $row) {
        			$row = (object) $row;

        			$cor = ($row->excluido == 'S') ? "#FF0000;" : "#000000;";

        			?>
        			<tr style="color:<?=$cor?>">
        				<?php 

        				for ($i=0; $i < count($campos); $i++) {
        					if (!empty($filtros[$i])) { 
        						$line = $filtros[$i];
        						?>
        							<td><?=addslashes($row->$line) ?></td>
        						<?php    						
        					}else{
        						?>
        							<td></td>
        						<?php
        					}
        				}
        				?>
        				<td style="text-align: center;">
                            <div class="table-data-feature">
	                                <a href="#" class="item" data-toggle="dropdown">
	                                    <i class="zmdi zmdi-more" title="Mais"></i>
	                                </a>
                                <div class="dropdown-menu" style="text-align: center;">
									<a class="dropdown-item" href="painel?f=categoriaDependencia&a=formVisualizar&id=<?=$row->id?>">Visualizar</a>
									<a class="dropdown-item" href="painel?f=categoriaDependencia&a=formAlterar&id=<?=$row->id?>">Alterar</a>
									<a href="#" onclick="excluir('<?=$row->id?>','<?=$row->excluido?>');" class="dropdown-item">Excluir</a>
                           		</div>
							</div>
        				</td>
        			</tr>
        			<?php
        		}
        	}
        	?>
        </tbody>
    </table>
</div>
<br>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#dataTableListar').DataTable({
	    	"ordering": true,
		    "aaSorting": [[0, "desc"]],
		    language: {           
		        search:"Pesquisar: ",
		        lengthMenu:    "Visualizar _MENU_ registros",
		        info:           "_START_ a _END_ de _TOTAL_ registros",   
		        infoEmpty:      " ",
		        infoFiltered:   "", 
		        zeroRecords:    "Nenhum registro encontrado!",
		        emptyTable:     "Nenhum registro encontrado!",
		        paginate: {
		            first:      "Primeiro",
		            previous:   "Anterior",
		            next:       "Próximo",
		            last:       "Último"
		        },
		    }
	    });
	});
	function excluir(id, exc) {
		if (exc == 'S') {
			bootbox.alert({
			    message: "Este cadastro já foi excluída!",
			    size: 'small'
			});
			return;
		}
		bootbox.confirm({
		    message: "Tem certeza que deseja excluir?",
		    buttons: {
		        confirm: {
		            label: 'Sim',
		            className: 'btn-success'
		        },
		        cancel: {
		            label: 'Não',
		            className: 'btn-danger'
		        }
		    },
		    callback: function (resultado) {
		        if (resultado) {
		        	location.replace("painel?f=categoriaDependencia&a=excluir&id="+id);
		        }
		    }
		});
	}
</script>