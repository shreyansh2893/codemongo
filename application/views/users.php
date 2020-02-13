<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
</head>
<body>


	
  <div class="container">
  	<h1>Codeigniter MongoDB </h1>
	
	<div class="row">
		<div class="col-sm-12">
			<?php echo anchor('/usercontroller/create', 'Create User', 'class="text-center"' );?>
		</div>
		
	</div>

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Students</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#exampleModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
						<!-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						 -->
					</div>
                </div>
            </div>
     <div id="body">
			<?php
				if ($users) {
			?>
	        <table class="datatable">
	            <thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Actions</th>
	                </tr>
	            </thead>
				<tbody>
					<?php
						$i = 0;
						foreach ($users as $user) {
							$col_class = ($i % 2 == 0 ? 'odd_col' : 'even_col');
							$i++;
						?>
						<tr class="<?php  ?>">
							<td>
								<?php echo $user->name; ?>
							</td>
							<td>
								<?php echo $user->email; ?>
							</td>
							<td>
								 <a style="cursor: pointer;" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $user->_id; ?>" data-name="<?php echo $user->name; ?>" data-email="<?php echo $user->email; ?>">&#xE254;</i></a>

								 <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $user->_id; ?>" data-name="<?php echo $user->name; ?>" data-email="<?php echo $user->email; ?>">Open modal for @mdo</button> -->
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
								<!-- <?php echo anchor('/usercontroller/update/' . $user->_id, 'Update'); ?>
								  
								<?php echo anchor('/usercontroller/delete/' . $user->_id, 'Delete', array('onclick' => "return confirm('Do you want delete this record')")); ?> 
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
	            <label for="recipient-name" class="control-label">Name:</label>
	            <input type="text" name="id" style="display:none" class="form-control" id="pop_id">
	            <input type="text" value="<?php echo isset($user)?$user->name:set_value('name'); ?>" name="name" class="form-control" id="pop_name" required>
	            
	          </div>
	          <div class="form-group">
				<label  for="recipient-email" class="control-label">Email</label>
				<input type="email" name="email"  value="<?php echo isset($user)?$user->email:set_value('email'); ?>" class="form-control"  id="pop_email" required>
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
						<?php echo anchor('/usercontroller/delete/' . $user->_id, 'Delete', 'class="btn btn-danger"') ?> 
					</div>
				</form>
			</div>
		</div>
	</div>

<script type="text/javascript">
	$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var pop_id = button.data('id') // Extract info from data-* attributes
  var pop_name = button.data('name') // Extract info from data-* attributes
  var pop_email = button.data('email') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Record of ' + pop_name)
  modal.find('.modal-body input#pop_id').val(pop_id)
  modal.find('.modal-body input#pop_name').val(pop_name)
  modal.find('.modal-body input#pop_email').val(pop_email)
})
	$(document).ready(function(){
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
</body>
</html>
<!-- https://stackoverflow.com/questions/46528667/pass-value-to-modal-on-button-click -->