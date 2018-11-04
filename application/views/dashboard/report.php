<style>
	th, td{
		text-align: center;
	}
</style>

<div class="form-w3layouts">
	<div class="row">
		
		<div class="col-lg-12">
		<?php echo form_open('employee/report'); ?>
			<div class="col-lg-3 pull-left form-group">
				<label for="card_no">Card No</label>
				<input type="text" name="card_no" id="card_no" class="form-control" value="<?php echo $card_no; ?>">
			</div>

			<div class="col-lg-3 form-group">
				<label>Date From</label>
				<input type="text" name="start_date" class="form-control date" value="<?php 
					echo $start_date;
				?>">
			</div>

			<div class="col-lg-3 form-group">
				<label>Date To</label>
				<input type="text" name="end_date" class="form-control date" value="<?php 
					echo $end_date;
				?>">
			</div>
			<div class="col-lg-3 form-group">
				<label>Status</label>
				<select name="status" class="form-control m-bot15">
					<option value="all" <?php 
					if(isset($status)){
						if($status == 'all') echo "selected"; 
					}
					
					?>>All</option>
					<option value="1" 

					<?php 
					if(isset($status)){
						if($status == 1) echo "selected"; 
					}
					
					?>

					>Active</option>
					<option value="0" <?php 
					if(isset($status)){
						if(!$status) echo "selected"; 
					}
					
					?>
					>Inactive</option>
				</select>
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
		<div id="makePdf">
			
		
			<table class="table table-hover table-bordered">

				<?php if($this->session->flashdata('success_msg')): ?>
				<caption class="alert alert-success" id="success_msg"><?php echo $this->session->flashdata('success_msg'); ?></caption>
				<?php endif; ?>

				<caption>Employee Information</caption>
				<thead>
					<tr>
						<th rowspan="2">#</th>
						<!-- <th rowspan="2">Card No</th> -->
						<th rowspan="2">Employee</th>
						<th rowspan="2">Nominee</th>
						<th rowspan="2">Card</th>
						<th rowspan="2">Monthly Amount</th>
						<th rowspan="2">Total</th>
						<th colspan="3">Validity</th>
						<th rowspan="2" class="hideToPdf">Action</th>
					</tr>
					<tr>
						<th>From</th>
						<th>To</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				if(isset($employees)):
				foreach($employees as $key => $employee): ?>
					<?php 
						$number_of_nominees = count($nominees[$employee['employee_id']]);
					?>
					<tr class="<?php echo $employee['employee_id'] ?>">
						<td rowspan="<?php echo $number_of_nominees; ?>"><?php echo ++$count_from; ?></td>
						<!-- <td rowspan="<?php //echo $number_of_nominees; ?>">
							<?php //echo $employee['card_no'] ?>
								
						</td> -->
						<td rowspan="<?php echo $number_of_nominees; ?>">
							<?php echo $employee['name'] ?>
								
						</td>


						<td rowspan="1">
							<?php 
							
								echo $nominees[$employee['employee_id']][0]['nominee_name'];
							
								
							 ?>
						</td>
						<td rowspan="1">
							<?php 
							
								echo $nominees[$employee['employee_id']][0]['card_no'];
							
								
							 ?>
						</td>
						<td rowspan="1">
							<?php 
								echo $nominees[$employee['employee_id']][0]['amount_per_month'];
							 ?>
						</td>
						<td rowspan="1">
							<?php 
								echo $nominees[$employee['employee_id']][0]['total'];
							 ?>
						</td>

						<td rowspan="1">
							<?php 
								echo date('d M Y',strtotime($nominees[$employee['employee_id']][0]['pay_time_starts']));
							 ?>
						</td>

						<td rowspan="1">
							<?php 
								echo date('d M Y',strtotime($nominees[$employee['employee_id']][0]['pay_time_ends']));
							 ?>
						</td>
						<td>
							<?php if(!$nominees[$employee['employee_id']][0]['status']){?>
								<!-- <input class="btn btn-danger" value="Inactive"> -->
								<button class="btn btn-danger btn-sm"><i class="fa fa-ban" aria-hidden="true"></i></button><?php echo " (".$nominees[$employee['employee_id']][0]['inactive_date']. ")"; ?>

							<?php }else{ ?>
								&nbsp;
							<?php } ?>
						</td>
						<td rowspan="<?php echo $number_of_nominees; ?>" class="hideToPdf">
							<a href="<?php echo base_url('employee/edit/'.$employee['employee_id']) ?>" id="<?php echo $employee['employee_id']; ?>" class="btn btn-info btn-sm">
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>

							<a href="javascript:;" id="<?php echo $employee['employee_id']; ?>" class="btn btn-danger btn-sm delete">
								<span><i class="fa fa-trash" aria-hidden="true"></i></span></a>
						</td>
					</tr>
					
					<?php if($number_of_nominees > 1): ?>
						<?php for($i = 1; $i < $number_of_nominees; $i++){ ?>
							<tr class="<?php echo $employee['employee_id']; ?>">
								<td rowspan="1">
									<?php 
										echo $nominees[$employee['employee_id']][$i]['nominee_name'];
									 ?>
								</td>

								<td rowspan="1">
									<?php 
										echo $nominees[$employee['employee_id']][$i]['card_no'];
									 ?>
								</td>

								<td rowspan="1">
									<?php 
										echo $nominees[$employee['employee_id']][$i]['amount_per_month'];
									 ?>
								</td>

								<td rowspan="1">
									<?php 
										echo $nominees[$employee['employee_id']][$i]['total'];
									 ?>
								</td>
								<td rowspan="1">
									<?php 
										echo date('d M Y',strtotime($nominees[$employee['employee_id']][$i]['pay_time_starts']));
									 ?>
								</td>

								<td rowspan="1">
									<?php 
										echo date('d M Y',strtotime($nominees[$employee['employee_id']][$i]['pay_time_ends']));
									 ?>
								</td>

								<td>
									<?php if(!$nominees[$employee['employee_id']][$i]['status']){
										?>
										<button class="btn btn-danger btn-sm"><i class="fa fa-ban" aria-hidden="true"></i></button><?php echo " (".$nominees[$employee['employee_id']][$i]['inactive_date']. ")"; ?>

									<?php }else{ ?>
										&nbsp;
									<?php } ?>
								</td>
								
							</tr>
						<?php } ?>
					<?php endif; ?>

				<?php endforeach; ?>
			<?php endif; ?>
				</tbody>
			</table>
		</div>

		</div>
	</div>
	<div class="col-md-3 pull-left">
		<input type="button" value="Print" id="print" class="btn btn-default" style="padding:10px"/>
		<!-- <button id="cmd">generate PDF</button> -->
	</div>
</div>

<script src="<?php echo base_url('assets/js/printThis.js') ?>" type="text/javascript" charset="utf-8" async defer></script>

<script>

	$(document).on('click', '#print', function(){
		//var hf = $('.btn-info').attr('href');
		//$('.btn-info').attr('href', 'javascript:;');
		$('.hideToPdf').hide();
		$('#makePdf').printThis();
		//$('.btn-info').attr('href', hf);
	});

	

	$(document).ready(function(){
		$('#success_msg').delay(2000).fadeOut();
	});
	$(document).on('click', '.delete', function(e){
		e.preventDefault();

		if(confirm('Sure to delete')){
			var employee_id = $(this).attr('id');
			var url = "<?php echo base_url('employee/employee_delete/') ?>"+employee_id;
			$('tbody tr.'+employee_id).fadeOut();
			$.ajax({
	             url: url
			});
		}
		
	});
</script>