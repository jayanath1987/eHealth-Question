<?php
/*
--------------------------------------------------------------------------------
HHIMS - Hospital Health Information Management System
Copyright (c) 2011 Information and Communication Technology Agency of Sri Lanka
<http: www.hhims.org/>
----------------------------------------------------------------------------------
This program is free software: you can redistribute it and/or modify it under the
terms of the GNU Affero General Public License as published by the Free Software 
Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,but WITHOUT ANY 
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR 
A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License along 
with this program. If not, see <http://www.gnu.org/licenses/> 




---------------------------------------------------------------------------------- 
Date : June 2016
Author: Mr. Jayanath Liyanage   jayanathl@icta.lk

Programme Manager: Shriyananda Rathnayake
URL: http://www.govforge.icta.lk/gf/project/hhims/
----------------------------------------------------------------------------------
*/

	include_once("header.php");	///loads the html HEAD section (JS,CSS)

?>
<?php echo Modules::run('menu'); //runs the available menu option to that usergroup ?>

	<div class="container" style="width:95%;">
		<div class="row" style="margin-top:55px;">
		  <div class="col-md-2 ">
			<?php //echo Modules::run('leftmenu/questionnaire'); //runs the available left menu for preferance ?>
			<?php echo Modules::run('leftmenu/preference'); //runs the available left menu for preferance ?>
		  </div>
		  <div class="col-md-10 ">
		  		<?php 
						if (isset($error)){
							echo '<div class="alert alert-danger"><b>ERROR:</b>'.$error.'</div>';
							exit;
						}
				?>
				<div class="panel panel-default"  >
					<div class="panel-heading"><b>Question preview </b>
					<input type='button' class='btn btn-xs btn-warning pull-right' onclick=self.document.location='<?php echo site_url('form/edit/qu_question_repos/'.$question_info['qu_question_repos_id'].'/?CONTINUE=question/view/'.$question_info['qu_question_repos_id'].''); ?>' value='Edit this question'>&nbsp;
					<input type='button' class='btn btn-xs btn-primary pull-right' onclick=self.document.location='<?php echo site_url('question'); ?>' value='Back to list'>&nbsp;
					 </div>

					<table class='table  table-striped table-condensed table-bordered' width=20%>
						<tr>	
							<td width="50%"><b>
								<?php 
									echo $question_info['question'];
									echo '('.$question_info['question_type'].')'; 
								?>
							</b></td>
							<td>
							<?php	
								if ($question_info['question_type'] == "Text"){
									echo '<span  class="form-group">';
									echo '<input type="text" class="input-xs" style="" />';
									echo '</span>';
								}
								elseif ($question_info["question_type"] == "Number"){
									echo '<span  class="form-group">';
									echo '<input type="number" class="input-xs" style="" />';
									echo '</span>';
								}
								elseif ($question_info["question_type"] == "Date"){
									echo '<span  class="form-group">';
									echo '<input type="text" class="input-xs" style="" id="date" onmousedown=\'$("#date").datepicker({"dateFormat": "yy-mm-dd"});\' />';
									echo '</span>';
								}
								elseif ($question_info["question_type"] == "TextArea"){
									echo '<span  class="form-group">';
									echo '<textarea class="input-xs" style="" ></textarea>';
									echo '</span>';
								}
								elseif ($question_info["question_type"] == "Header"){
									echo '<span  class="form-group">';
									echo '</span>';
								}
								elseif($question_info["question_type"] == "PAIN_DIAGRAM"){
									echo '<span  class="form-group">';
									if (isset($clinic_diagram_info)){
										//print_r($clinic_diagram_info);
										echo 'Diagram name:'.$clinic_diagram_info["name"].'<br>';
										echo 'File name:'.$clinic_diagram_info["diagram_name"].'<br>';
										//echo 'Path:'.$clinic_diagram_info["diagram_link"].'<br>';
										echo '<img id="diagram" style="border:1px solid #FFFFFF;" src='.base_url().ltrim($clinic_diagram_info["diagram_link"],'./').' width= 80px height= 100px >';
										echo '</img>';
										echo '<input type="button" class="btn btn-xs btn-success " onclick=self.document.location="'.site_url('form/edit/qu_diagram/'.$pain_diagram_info['qu_diagram_id'].'/?CONTINUE=question/view/'.$question_info['qu_question_repos_id'].'').'" value="Change diagram">';
									}
									else{
										echo '<input type="button" class="btn btn-xs btn-success " onclick=self.document.location="'.site_url('form/create/qu_diagram/'.$question_info['qu_question_repos_id'].'/?CONTINUE=question/view/'.$question_info['qu_question_repos_id'].'').'" value="Select diagram">';
									}
									echo '</span>';
									
								}
								elseif($question_info["question_type"] == "Select"){
									echo '<span  class="form-group">';
									$var = 'select'.$question_info["qu_question_repos_id"];
									echo '<select type="text" class="input-xs" style="width:200px;" />';
									if (isset($$var)){
										$option = $$var;
										for($o=0; $o < count($option); ++$o){
											echo '<option value="'.$option[$o]["select_value"].'">'.$option[$o]["select_text"].'</option>';
										}
									}
									echo '</select /> ';
									echo '<input type="button" class="btn btn-xs btn-success " onclick=self.document.location="'.site_url('form/create/qu_select/'.$question_info['qu_question_repos_id'].'/?CONTINUE=question/view/'.$question_info['qu_question_repos_id'].'').'" value="Add Option">';
									echo '</span>';
									
								}
								elseif($question_info["question_type"] == "MultiSelect"){
									echo '<span  class="form-group">';
									$var = 'select'.$question_info["qu_question_repos_id"];
									//echo '<select type="text" class="input-xs" style="width:200px;" />';
									if (isset($$var)){
										$option = $$var;
										for($o=0; $o < count($option); ++$o){
											echo '<span><input  class="input-xs" type="checkbox" >'.$option[$o]["select_text"].'</input></span><br>';
										}
									}
									//echo '</select /> ';
									echo '<input type="button" class="btn btn-xs btn-success " onclick=self.document.location="'.site_url('form/create/qu_select/'.$question_info['qu_question_repos_id'].'/?CONTINUE=question/view/'.$question_info['qu_question_repos_id'].'').'" value="Add Option">';
									echo '</span>';
									
								}
								elseif($question_info["question_type"] == "Yes_No"){
									echo '<span  class="form-group">';
									echo '<select type="text" class="input-xs" style="" />';
									echo '<option value="Yes">Yes</option>';
									echo '<option value="No">No</option>';
									echo '</select />';
								}

							?>
							</td>
						</tr>
						<tr>	
							<td><b>Code:</b></td>
							<td><?php echo $question_info['code']; ?></td>
						</tr>
						<tr>	
							<td><b>Category :</b></td>
							<td><?php echo $question_info['qu_group']; ?></td>
						</tr>
						<tr>	
							<td><b>Description/Help text:</b></td>
							<td><?php echo $question_info['help']; ?></td>
						</tr>
						<tr>	
							<td><b>Applicable gender:</b></td>
							<td><?php echo $question_info['applicable_to']; ?></td>
						</tr>
					</table>
				</div>

			</div>
		</div>
	</div>