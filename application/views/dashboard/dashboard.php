
  
  <ul class="nav nav-pills">
    <li  
    class="<?php 
    		if(isset($active))
    			if($active == 'report') echo "active" 
    	?>">
    	<a href="<?php echo base_url('employee/report'); ?>">Report</a>
    </li>

    <li  class="
    	<?php 
    		if(isset($active))
    			if($active == 'add') echo "active" 
    	?>"

    >
    	<a href="<?php echo base_url('employee/add'); ?>">Add</a>
    </li>
  </ul>

   <?php if(isset($active)): ?>
	<?php if($active == 'report'): ?>
		<h5>Report here</h5>
	<?php endif; ?>
  <?php endif; ?>


  <?php if(isset($active)): ?>
	<?php if($active == 'add'): ?>
		<div class="form-w3layouts">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Employee
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <form role="form" class="form-horizontal ">
                                <div class="form-group">
                                    <label for="card_no" class="col-lg-3 control-label">Card No</label>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="Card Number" id="card_no" class="form-control">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="name" class="col-lg-3 control-label">Name</label>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="Name" id="name" class="form-control">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="designation" class="col-lg-3 control-label">Designation</label>
                                    <div class="col-lg-6">
                                        <select class="form-control m-bot15" name="sonalibank_branch">
                                            <option value=''>Select...</option>
                                            <?php foreach($designations as $key=>$designation): ?>
                                                <option value="<?php echo $designation['componentId']; ?>">

                                                    <?php echo $designation['name'] ?>
                                                    
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="commission" class="col-lg-3 control-label">Commission</label>
                                    <div class="col-lg-6">
                                        <select class="form-control m-bot15" name="sonalibank_branch">
                                            <option value=''>Select...</option>
                                            <?php foreach($commissions as $key=>$commission): ?>
                                                <option value="<?php echo $commission['componentId']; ?>">

                                                    <?php echo $commission['commission_name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="last_sallary" class="col-lg-3 control-label">Last Salary</label>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="last_sallary" id="last_sallary" class="form-control">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="file_no" class="col-lg-3 control-label">File No</label>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="file_no" id="file_no" class="form-control">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="date_of_birth" class="col-lg-3 control-label">Date of birth</label>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="date_of_birth" id="date_of_birth" class="form-control">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="death_date" class="col-lg-3 control-label">Death or Accident Date</label>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="death_date" id="death_date" class="form-control">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="sonalibank_branch" class="col-lg-3 control-label">Sonali Bank Branch</label>
                                    <div class="col-lg-6">
                                        <select class="form-control m-bot15" name="sonalibank_branch">
                                            <option value=''>Select...</option>
                                            <?php foreach($sonalibank_branches as $key=>$branch): ?>
                                                <option value="<?php echo $branch['componentId']; ?>">

                                                    <?php echo $branch['branch_name'] ?>
                                                    
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="name" class="col-lg-3 control-label">Name</label>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="name" id="name" class="form-control">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="relation" class="col-lg-3 control-label">Relation</label>
                                    <div class="col-lg-6">
                                        <select class="form-control m-bot15" name="relation">
                                            <option value=''>Select...</option>
                                            <?php foreach($relations as $key=>$relation): ?>
                                                <option value="<?php echo $relation['componentId']; ?>">

                                                    <?php echo $relation['relation_name'] ?>
                                                    
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-lg-3 control-label">Address</label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control"></textarea>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="amount_at_a_time" class="col-lg-3 control-label">Amount At a Time</label>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="amount_at_a_time" id="amount_at_a_time" class="form-control">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="amount_per_month" class="col-lg-3 control-label">Amount per month</label>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="amount_per_month" id="amount_per_month" class="form-control">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pay_time_starts" class="col-lg-3 control-label">Pay time starts</label>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="pay_time_starts" id="pay_time_starts" class="form-control">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pay_time_ends" class="col-lg-3 control-label">Pay time ends</label>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="pay_time_ends" id="pay_time_ends" class="form-control">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-6">
                                        <button class="btn btn-default" id="add_nominee">Add Nominee</button>

                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>

                                
                            </form>
                        </div>
                    </section>
                </div>
            </div>
	<?php endif; ?>
  <?php endif; ?>

  <script>
      $(window).load(function(){
            console.log('Mahmud');
      });
  </script>
  
