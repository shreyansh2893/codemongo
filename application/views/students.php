
	
  <div class="container">
  	<h1>Codeigniter MongoDB </h1>

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Students</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#exampleModal" id="add_pop" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
						<!-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						 -->
					</div>
                </div>
            </div>
			     <div id="body">

						<?php
							if ($students) {
						?>
						<input id="myInput" class="form-control" style="width:30%;float: right;" type="text" placeholder="Search..">
						<br><br>
				        <table class="datatable" id="myTable">
				            <thead>
								<tr>
									<th>Name</th>
									<th>Roll no.</th>
									<th>Physics</th>
									<th>Chemestry</th>
									<th>Maths</th>
				                </tr>
				            </thead>
							<tbody>
								<?php
									$i = 0;
									foreach ($students as $student) {
										$col_class = ($i % 2 == 0 ? 'odd_col' : 'even_col');
										$i++;
									?>
									<tr class="<?php  ?>">
										<td>
											<?php echo $student->name; ?>
										</td>
										<td>
											<?php echo $student->rno; ?>
										</td>
										<td>
											<?php echo $student->physics; ?>
										</td>
										<td>
											<?php echo $student->chemistry; ?>
										</td>
										<td>
											<?php echo $student->maths; ?>
										</td> 
										<td>
											 <a style="cursor: pointer;" id="edit_pop" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $student->_id; ?>" data-name="<?php echo $student->name; ?>" data-rno="<?php echo $student->rno; ?>">&#xE254;</i></a>

											 <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $student->_id; ?>" data-name="<?php echo $student->name; ?>" data-email="<?php echo $student->email; ?>">Open modal for @mdo</button> -->
			                            <a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $student->_id; ?>" data-rno="<?php echo $student->rno; ?>" data-toggle="modal"><i class="material-icons" data-toggle="modal" title="Delete">&#xE872;</i></a>


			                            	<?php echo anchor('/students/delete/' . $student->_id, 'Delete', array('onclick' => "return confirm('Do you want delete this record')")); ?> 
											<!-- <?php echo anchor('/usercontroller/update/' . $student->_id, 'Update'); ?>
											  
											<?php echo anchor('/usercontroller/delete/' . $student->_id, 'Delete', array('onclick' => "return confirm('Do you want delete this record')")); ?> 
											-->
										</td>
									</tr>
									<?php
								}
								?>
							</tbody>
				        </table>
				    <?php
				        } else {
				            echo '<div style="color:red;"><p>No Record Found!</p></div>';
				        }
				    ?>
				</div>
        </div>
    </div>
		<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Add Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <div id="body">
        	 <?php
					if (isset($error)) {
						echo '<p style="color:red;">' . $error . '</p>';
					} else {
						echo validation_errors();
					}
                ?>

                <?php 

					$attributes = array('name' => 'form', 'id' => 'form');
					echo form_open($this->uri->uri_string(), $attributes);
                ?>
	        <div class="form-group">
	            <input type="text" name="id" style="display:none" class="form-control" id="pop_id">
	          </div>
	          <div class="form-group">
	            <label for="recipient-name" class="control-label">Roll No:</label>
	            <input type="number" value="<?php echo isset($student)?$student->rno:set_value('rno'); ?>" name="rno" class="form-control" id="pop_rno" required>
	            
	          </div>
	         <div class="form-group" id="pop_name_hide">
	            <label for="recipient-name" class="control-label">Name:</label>
	            <input type="text" value="<?php echo isset($student)?$student->name:set_value('name'); ?>" name="name" class="form-control" id="pop_name" >
	            
	          </div>
	          <div class="form-group">
				<label  for="recipient-email" class="control-label">Select Subject</label>
				<select  class="form-control" name="subject" id="pop_subject">
					<option>Select Subject</option>
					<?php
            	if ($subjects) {
									foreach ($subjects as $subject) {
									?>
									<option><?php echo $subject->name; ?></option>

								<?php }
							}?>
				</select>
			  </div> 
			  <div class="form-group">
				<label  for="recipient-email" class="control-label">Marks</label>
				<input type="number" name="marks"  class="form-control"  id="pop_marks" required>
			  </div> 
		      <div class="modal-footer">
		        <input type="button" class="btn btn-default" value="CLose" data-dismiss="modal">
		         <input type="submit"  class="btn btn-primary" name="submit_pop" value="Submit"/>
		        <!-- <button type="submit"  class="btn btn-primary" name="submit_pop" value="Submit"/>Submit</button> -->
		         <?php echo form_close(); ?>
		      </div>

        </div>
      </div>


     
    </div>
  </div>
</div>

	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<?php echo anchor('/students/delete/' . $student->_id, 'Delete', 'class="btn btn-danger" id="del_id"') ?> 
					</div>
				</form>
			</div>
		</div>
	</div>

<script type="text/javascript">

	var chekAddEdit = true;
	$('#exampleModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) 
	  var pop_id = button.data('id') 
	  var pop_rno = button.data('rno') 
	  var pop_name = button.data('name') 
	  var pop_marks = button.data('marks') 
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  modal.find('.modal-title').text('Add / Edit Record')
	  modal.find('.modal-body input#pop_id').val(pop_id)
	  modal.find('.modal-body input#pop_rno').val(pop_rno)
	  modal.find('.modal-body input#pop_name').val(pop_name)
	  modal.find('.modal-body input#pop_marks').val(pop_marks)
	})

	$('#deleteEmployeeModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) 
	  var pop_id = button.data('id') 
	  var pop_rno = button.data('rno') 
	  var modal = $(this)
	  modal.find('.modal-title').text('Delete Student with roll no' + pop_rno)
	 // alert('students/delete/'+pop_id);
	  modal.find('#del_id').attr('href', 'students/delete/'+pop_id)
	})
	$('#add_pop').click(function(){
		chekAddEdit = true;
		//alert(chekAddEdit);
		 $('#pop_rno').prop("readonly", false)
		$('#pop_name_hide').hide();
	});
	$('#edit_pop').click(function(){
		chekAddEdit = false;
		 $('#pop_rno').prop("readonly", true)
		$('#pop_name_hide').show();
		//alert(chekAddEdit);
	});
	$(document).ready(function(){

		//search
	 $("#myInput").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $("#myTable tbody tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });

	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>

