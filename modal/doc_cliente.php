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
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar Documento</h4>
                    </div>

                    <div class="modal-body">
                            <div id="resultados_ajax"></div>
                            <div class="panel panel-default">
                                <div class="panel-body p-3 mb-2 bg-primary text-white">
                                    <span> Subir Documento  </span>
                                </div>
                            </div> 
                    
                            <div class="form-group">
                                <label class="col-sm-4 ">Tipo de doc</label>
                                <label class="col-sm-4 ">Fecha documento</label>
                                <label class="col-sm-4 ">Fecha vencimiento</label>
                            </div>
                            <div class="form-group">			
                                <div class="col-sm-4">
                                    <select class="form-control" id="tipo_doc" name="tipo_doc" >
                                        <option value="1">RUT</option>
                                        <option value="2">Camara de Comercio</option>
                                        <option value="3">Resolucion Dian</option>
                                        <option value="4">Cedula Representante Legal</option>
                                        <option value="5">Poliza Sura</option>
                                        <option value="6">Uso de Suelos</option>
                                        <option value="7">Formulario Coomulpinort</option>
                                        <option value="8">Antecedentes Policia</option>
                                        <option value="9">Antecedentes Procaduria</option>
                                        <option value="10">Antecedentes Contaduria</option>  
                                        <option value="11">Sarlaft</option> 
                                        <option value="12">Tajeta Profesional del Contador</option>
                                        <option value="13">Antecedentes Representante legal</option>
                                        <option value="14">Consulta Semestral Sarlaft</option>
                                        <option value="0">Otros</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="fecha_inicio_doc" name="fecha_inicio_doc" ></div>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="fecha_final_doc" name="fecha_final_doc" > </div>
                                    
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 ">Nombre</label>
                                <label class="col-sm-6 "></label>
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