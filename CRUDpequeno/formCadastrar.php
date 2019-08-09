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

?>
<div class="row">
	<form id="formulario" method="POST" action="painel?f=categoriaDependencia&a=cadastrar">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4>Cadastro de Categorias de Dependência</h4>
				</div>
				<div class="card-body">
					<div class="default-tab">
						<div class="tab-content pl-3 pt-2" id="nav-tabContent">
							<div class="tab-pane fade show active" id="modulo" role="tabpanel" aria-labelledby="moduloTab">
								<!-- LINHA 1 -->
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="font-label">Nova Categoria</label>
											<input type="text" name="categoria" id="categoria" class="form-control-sm form-control caps">
										</div>
									</div>
									<div>
										<hr>
										<button type="submit" class="btn btn-success">
											<i class="fa fa-save"></i> Cadastrar
										</button>
									</div>
								</div>
								<!-- FIM DA LINHA 2-->
								<!-- Fima da pagina -->
								<div class="tab-pane fade" id="anexos" role="tabpanel" aria-labelledby="anexosTab">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>