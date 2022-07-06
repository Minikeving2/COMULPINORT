<?php
		if (isset($con))
		{ 
	?>	
			<!-- Modal -->
			<div class="modal fade bs-example-modal-lg" id="buscarCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-lg" role="document" id="Big_modal">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Buscar cliente</h4>
				  </div>
				  <div class="modal-body">
					<form class="form-horizontal">
					  <div class="form-group">
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="a" placeholder="Buscar cliente">
						</div>
						<button type="button" class="btn btn-default" onclick="load_Cliente()"><span class='glyphicon glyphicon-search'></span> Buscar</button>
					  </div>
					</form>
					<script> 
					document.addEventListener('DOMContentLoaded', () => {
						document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
							if(e.keyCode == 13) {
								e.preventDefault();
								
							}
						}))
					});
  				</script>
					<div id="loader" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="outer_div" id="clientes" >
                        
                    </div><!-- Datos ajax Final -->
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					
				  </div>
				</div>
			  </div>
			</div>
	<?php
		}
	?>