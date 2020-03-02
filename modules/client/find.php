	<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Atención al Cliente <small>[Buscar]</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
			<div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="x_panel" style="height: auto;">
                  <div class="x_title">
                    <h2>Busqueda Codigos <small> Cup | N° Suministro | Hoja Única | Convenio...</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: none;">
                    <br />
                    <form id="findForm-adv-1" class="form-horizontal form-label-left" novalidate>			
					
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cod. Hoja Única</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<div class="field">
							  <input list="HUD" data-validate-length-range="4,15" type="text" name="C_HU" class="form-control" placeholder="Código de Hoja Única" autocomplete="off" required>
							
							<datalist id="HUD">
							<?php
							
							$SQL = do_query('SELECT DISTINCT `doc.hu` FROM t_clients ORDER BY `doc.hu` ASC',DB_GENERAL);

								while($SQLi = $SQL->fetch_array(MYSQLI_ASSOC)){
									
								echo '<option value="'.$SQLi['doc.hu'].'"></option>';
								
								}
							
							?>
							</datalist>
							
							</div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cod. Convenio</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<div class="field">
							  <input list="CONV" data-validate-length-range="4,15" type="text" name="C_CO" class="form-control" placeholder="Código de Convenio Fise" autocomplete="off" required>
							
							<datalist id="CONV">
							<?php
							
							$SQL = do_query('SELECT DISTINCT `doc.co` FROM t_clients WHERE `doc.co` > 0 ORDER BY `doc.co` ASC',DB_GENERAL);

								while($SQLi = $SQL->fetch_array(MYSQLI_ASSOC)){
									
								echo '<option value="'.$SQLi['doc.co'].'"></option>';
								
								}
							
							?>
							</datalist>
							</div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cod. Unidad Predial</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<div class="field">
							  <input list="CUP" data-validate-length-range="4,15" type="text" name="C_UP" class="form-control" placeholder="Código de Unidad Predial" autocomplete="off" required>
								<datalist id="CUP">
									<?php
									
									$SQL = do_query('SELECT DISTINCT `cup` FROM t_clients WHERE `doc.co` > 0 ORDER BY `cup` ASC',DB_GENERAL);

										while($SQLi = $SQL->fetch_array(MYSQLI_ASSOC)){
											
										echo '<option value="'.$SQLi['cup'].'"></option>';
										
										}
									
									?>
								</datalist>
							</div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">C. Contrato</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
							<div class="field">
							  <input list="SUMI" data-validate-length-range="4,15" type="text" name="C_NS" class="form-control" placeholder="Cuenta Contrato / Número de Suministro" autocomplete="off" required>
								<datalist id="SUMI">
									<?php
									
									$SQL = do_query('SELECT DISTINCT `n.suministro` FROM t_clients WHERE `doc.co` > 0 ORDER BY `n.suministro` ASC',DB_GENERAL);

										while($SQLi = $SQL->fetch_array(MYSQLI_ASSOC)){
											
										echo '<option value="'.$SQLi['n.suministro'].'"></option>';
										
										}
									
									?>
								</datalist>
							</div>
                        </div>
                      </div>
                        <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						   <button class="btn btn-primary" type="reset">Limpiar</button>
                          <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
			  
			  <div class="col-md-6 col-xs-12">
                <div class="x_panel" style="height: auto;">
                  <div class="x_title">
                    <h2>Busqueda Avanzada <small> Nombre | Telefono | Dirección | Distrito...</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: none;">				  
                    <form id="findForm-adv-2" class="form-horizontal form-label-left input_mask" novalidate>

                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<div class="field">
							<input data-validate-length-range="4,15" type="text" name="name" class="form-control has-feedback-left" placeholder="Nombre del cliente..." autocomplete="off" required>
							<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
						</div>					  
                      </div>					  
				  
					 <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<div class="field">
							<input data-validate-length-range="4,15" type="text" name="address" class="form-control" placeholder="Dirección del cliente..." autocomplete="off" required>
							<span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
						</div>
                      </div>

                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
						<div class="field">
							<input data-validate-length-range="4,15" type="text" class="form-control has-feedback-left" name="mz" placeholder="-" autocomplete="off" required>
							<span class="form-control-feedback left" aria-hidden="true">MZ</span>
						</div>
                      </div>
					  
					  <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <div class="field">
							<input data-validate-length-range="1,5" type="text" class="form-control has-feedback-left" name="lt" placeholder="-" autocomplete="off" required>
							<span class="form-control-feedback left" aria-hidden="true">LT</span>
						</div>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <div class="field">
							<input data-validate-length-range="6,10" type="text" class="form-control"  name="phone" placeholder="Telefono" autocomplete="off" required>
							<span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
						</div>
                      </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
						<div class="field">
						<input list="distrito" data-validate-length-range="5,30" type="text" name="distrito" class="form-control" placeholder="Elegir distrito..." autocomplete="off" required>
						
						<datalist id="distrito">
							<?php
							
							$SQL = do_query('SELECT DISTINCT distrito FROM t_clients ORDER BY distrito ASC',DB_GENERAL);

								while($SQLi = $SQL->fetch_array(MYSQLI_ASSOC)){
									
								echo '<option value="'.$SQLi['distrito'].'"></option>';
								
								}
							
							?>
						</datalist>                    
                      </div>
				  </div>
				  
				  <div class="col-md-6 col-sm-6 col-xs-6 form-group">
						<div class="field">
						<input list="malla" data-validate-length-range="5,30" type="text" name="malla" class="form-control" placeholder="Elegir malla..." autocomplete="off" required>
						
						<datalist id="malla">
							<?php
							
							$SQL = do_query('SELECT codigo, estado, distrito FROM `t_mallas` ORDER BY `estado` ASC',DB_GENERAL);

								while($SQLi = $SQL->fetch_array(MYSQLI_ASSOC)){
									
								echo '<option value="'.$SQLi['codigo'].'">'.($SQLi['estado'] == 1 ? "GASIFICADA" : "SIN GASIFICAR").' - '.(empty($SQLi['distrito']) ? "-" : $SQLi['distrito']).'</option>';
								
								}
							
							?>
						</datalist>                    
                      </div>
				  </div>
                       <!--<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Disabled Input </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" disabled="disabled" placeholder="Disabled Input">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Read-Only Input</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" readonly="readonly" placeholder="Read-Only Input">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>-->
                       <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						   <button class="btn btn-primary" type="reset">Limpiar</button>
                          <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>

              </div>
			  
            </div>
			
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Busqueda con Doc. Identidad <small>Realiza la busqueda con el Documento de identidad del usuario</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>-->
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  
				  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                        <li role="presentation" class="active"><a href="#tab-client-content1" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Busqueda</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab-client-content2" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">Busqueda Selectiva</a>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab-client-content1" aria-labelledby="home-tab">
                          
					<form id="findForm-dni" class="form-horizontal form-label-left" novalidate>

                      <p>Ten en cuenta que, por lo regular el documento de identidad consta de 8 caracteres. Ej.<code>02345678</code> echa un vistazo.</p>
                      <!-- <span class="section">Document Info</span> -->
						<!--<div class="item form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tipo de documento:</label>
                        <div class="field col-md-4 col-sm-6 col-xs-12"> 
							<select id="dc-type" class="form-control col-md-7 col-xs-12">
                            <option value="1">Doc. Nacional de Identidad</option>
                            <option value="2">Carnet de Extrangería</option>
                          </select>
                        </div>
                      </div>-->
					  
					   <div class="item form-group">					   
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Número de documento:</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">                          
							<div class="input-group">							
							<div class="field">
							<input data-validate-length-range="4,15" name="dni" class="form-control col-md-7 col-xs-12" type="text" autocomplete="off" placeholder="Ingrese número de documento" required />
							</div>							
							<span class="input-group-btn">
							<button type="submit" class="btn-find-dni btn btn-primary">Buscar</button>
							</span>
							</div>
                        </div>
                      </div>
                    </form>
						  
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab-client-content2" aria-labelledby="profile-tab">
                         <div class="x_panel">
						  <div class="x_title">
							<h2>Tipo de filtrados<small>Selecciona el filtro que deseas aplicar</small></h2>                    
							<div class="clearfix"></div>
						  </div>
						  <div class="x_content">

							<!-- start form for filter -->
							
						<form id="findForm-select" class="form-horizontal form-label-left">
							<div class="form-group">
							  <label>Tipo</label>
								  <select name="filType" class="select2_group form-control" required>
											<option value="">Elegir...</option>
										<optgroup label="ESTADO">
											<option value="1">Anulados</option>
											<option value="2">Instaladas - APROBADAS</option>
											<option value="3">Instaladas - SIN APROBAR</option>
											<option value="4">Sin Instalar - CON SUMINISTRO</option>
											<option value="5">Sin Instalar - SIN SUMINISTRO</option>
										</optgroup>
										<optgroup label="SELECTIVO">
											<option value="6">Vendedor</option>
											<option value="7">Instalador</option>
											<option value="8">Termas</option>
										</optgroup>
								  </select>   
							</div>
							<div class="form-group filUserBox" style="display: none;">
							  <label>Asesor</label>
								<select name="filUser" class="select2_group form-control" disabled>
									<option value="0">TODOS..</option>
									<?php
									$SQL = do_query('SELECT * FROM `t_users` WHERE `categ` LIKE 1 AND `estado` = 0',DB_GENERAL);

									while($SQLi = $SQL->fetch_array(MYSQLI_ASSOC)){
										
									$LEVEL = User::LvlArray($SQLi['level']);
									
										if($LEVEL["USUARIO"] == 2 || $LEVEL["USUARIO"] == 3){
											
											echo '<option value="'.$SQLi['id'].'">'.sprintf("%s %s - %s", $SQLi['nombre'],$SQLi['apellido'],$SQLi['doc.id']).'</option>';
											
										}												
									}
									
									?>
								</select>	
								  </select> 
							</div>	

							<div class="form-group filTecBox" style="display: none;">
							  <label>Técnico</label>
								<select name="filTec" class="select2_group form-control" disabled>
									<option value="0">TODOS..</option>
									<?php
									$SQL = do_query('SELECT * FROM `t_users` WHERE `categ` = 3 AND `estado` = 0',DB_GENERAL);	

									while($SQLi = $SQL->fetch_array(MYSQLI_ASSOC)){
										
									$LEVEL = User::LvlArray($SQLi['level']);
						
										if($LEVEL["TECNICO"] >= 1){
											
											if($SQLi['inst.reg'] < 1){
												
												echo '<option value="'.$SQLi['id'].'">'.sprintf("%s %s - DNI %s", $SQLi['nombre'],$SQLi['apellido'],$SQLi['doc.id']).'</option>';
												
											}else{
												
												echo '<option value="'.$SQLi['inst.reg'].'">'.sprintf("%s %s - DNI %s", $SQLi['nombre'],$SQLi['apellido'],$SQLi['doc.id']).'</option>';
												
											}
											
											
											
										}												
									}
									?>
								</select>	
								  </select> 
							</div>
								 <button type="submit" class="btn btn-primary">Buscar</button>
						</form>
							<!-- end form for validations -->

						  </div>
						</div>
                        </div>
                      </div>
                    </div>	          
                       
							
							<!-- Contenido -->
						
                      </div>
					</div>
                </div>
            </div>
			
			<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
					<div class="resultBox form-group" style="display: none;">
					</div>
            </div>
				
            </div>
			
	
<!-- LOAD SCIPTS

<script type="text/javascript">

$(document).ready(function(){
	init_general();
});
</script>-->