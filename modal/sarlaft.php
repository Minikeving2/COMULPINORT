<?php
	if (isset($con))
	{
?>
	<!-- Modal -->
    <div class="modal fade" id="SARLAFT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	    <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> SARLAFT</h4>
                </div>
                <form class="form-horizontal" method="post" id="guardar_cliente" name="guardar_cliente">
                    <div class="modal-body">
                        <div id="resultados_ajax"></div>
                        <div class="panel panel-default">
                            <div class="panel-body p-3 mb-2 bg-primary text-white">
                                <span> EN PROCESO </span>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
                    </div>
                </form>
		    </div>
	    </div>
    </div>
<?php
	}
?>