<style>
	th, td{
		text-align: center;
	}
</style>



<div class="form-w3layouts">
	<div class="row">
		
		<div class="col-lg-12">
		<?php echo form_open('division/report'); ?>
			<div class="col-lg-4 pull-left form-group">
				<label for="name">Division</label>
				<input type="text" name="name" id="name" class="form-control" value="<?php echo set_value('name'); ?>">
			</div>
			
			<div class="col-lg-4 form-group">
				<input type="submit" class="btn btn-default" value="Submit" class="form-control">
			</div>

		<?php echo form_close(); ?>
		<div class="col-lg-12">
			<div class="col-lg-4 pull-right">
				<p><?php echo $this->pagination->create_links(); ?></p>
			</div>
		</div>
			<table class="table table-hover table-bordered">
				<caption>Divisions</caption>
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 

				if(isset($divisions)):
				foreach($divisions as $key => $division): ?>

					<tr id="<?php echo $division['componentId']; ?>">
						<td>
							<?php echo ++$count_from; ?>
						</td>
						<td>
							<?php echo $division['division_name']; ?>
						</td>
						<td>
							<a href="<?php echo base_url('division/edit/').$division['componentId'] ?>" class="btn btn-info btn-sm">
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>

							</a>
							<a href="javascript:;" id="<?php echo $division['componentId']; ?>" class="btn btn-danger btn-sm delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
						</td>
					</tr>
					

				<?php endforeach; ?>
			<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	$(document).on('click', '.delete', function(e){
         e.preventDefault();
         var id = $(this).attr('id');
        
        if(confirm('Sure to delete')){
        	var url = '<?php echo base_url('division/delete/') ?>'+id;
	         $.ajax({
	             url: url,
	             dataType: 'json',
	             success: function(data){
	                 if(data){
	                 	$('tbody tr#'+id).fadeOut();
	                 }
	             },
	             error: function(){
	             	alert('Error');
	             }
	         });
        }

         
	});
</script>