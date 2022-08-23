<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="docCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	    <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
                <form class="form-horizontal" method="post" id="documento_cliente" name="documento_cliente" enctype="multipart/form-data"> 
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo Tercero</h4>
                    </div>

                    <div class="modal-body">
                            <div id="resultados_ajax"></div>
                            <div class="panel panel-default">
                                <div class="panel-body p-3 mb-2 bg-primary text-white">
                                    <span> Subir Documento  </span>
                                </div>
                            </div> 
                    
                            <div class="form-group">
                            <!-- 
                            <label for="id" class="col-sm-2 ">ID</label>-->	
                                <label for="nombre_doc" class="col-sm-6 ">Nombre</label>
                                <label for="archivo" class="col-sm-4 "> </label>
                            </div>
                            <div class="form-group">			
                                <!--	
                                <div class="col-sm-2">
                                <input type="text" class="form-control" id="id" name="id" > </div> -->
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="nombre_doc" name="nombre_doc" ></div>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" id="archivo" name="archivo" > </div>
                                    
                            </div>
                        
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="guardar_documentos">Guardar datos</button>
                    </div>
                </form>
		    </div>
	    </div>
	</div>
	<?php
		}
	?>