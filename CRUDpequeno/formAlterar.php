<?php 

include'model/Procedimentos.php';
$pgIndex = "subTabMedicas";

$log = array(
	'operador'	=> $_SESSION['id'],
	'modulo'	=> '14',
	'pagina'	=> 'formVisualizar',
	'acao'		=> '5',
	'id'		=> ''
);

$f = new Funcoes($log);

$dados = $f->seleciona('tb_categoria_dependencia', "id = ".$_GET['id']);
//print_r($dados);

$dataPreencher = array(
	'categoria'		=> addslashes($dados->categoria),
	'id_categoria' 	=> $_GET['id']
);
//print_r($dataPreencher); exit();

?>
<div class="row">
	<form id="formulario" method="POST" action="painel?f=categoriaDependencia&a=atualizar">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4>Alterar Categorias de Dependência</h4>
				</div>
				<div class="card-body">
					<div class="default-tab">
						<div class="tab-content pl-3 pt-2" id="nav-tabContent">
							<div class="tab-pane fade show active" id="modulo" role="tabpanel" aria-labelledby="moduloTab">
								<!-- LINHA 1 -->
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="font-label">Categoria</label>
											<input type="text" name="categoria" id="categoria" class="form-control-sm form-control caps">
										</div>
									</div>
									<input type="hidden" name="id_categoria" name="id_categoria" value="<?=$_GET['id']?>">
									<div>
										<br>
										<button type="submit" class="btn btn-success">
											<i class="fa fa-save"></i> Alterar
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<?php $f->setarValores($dataPreencher); ?>