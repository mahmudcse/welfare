  <ul class="nav nav-pills">
    <li  
    class="<?php 
    		if(isset($active))
    			if($active == 'report') echo "active" 
    	?>">
    	<a href="<?php echo base_url('district/report'); ?>">List</a>
    </li>

    <li  class="
    	<?php 
    		if(isset($active))
    			if($active == 'add' || $active == 'edit') echo "active"  
    	?>"

    >
    	<?php if($active == 'edit'){ ?>
            <a>Edit</a>
        <?php }else{ ?>
            <a href="<?php echo base_url('district/add'); ?>">Add</a>
        <?php } ?>
    </li>
  </ul>

   <?php if(isset($active)): ?>
	<?php if($active == 'report'): ?>
        <?php include 'report.php'; ?>
	<?php endif; ?>
  <?php endif; ?>

  <?php if(isset($active)): ?>
	<?php if($active == 'add' || $active == 'edit'): ?>
		<div class="form-w3layouts">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <?php 
                                if($active == 'add'){
                                    echo "Add";
                                }else if($active == 'edit'){
                                    echo "Edit";
                                }

                            ?> District
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <!-- <form role="form" class="form-horizontal "> -->

                            <?php 
                                $form_data = array(
                                    'role' => 'form',
                                    'class' => 'form-horizontal'
                                );
                            ?>

                            <?php if($active == 'add'){ ?>
                                <?php echo form_open('district/district_save', $form_data); ?>
                            <?php }else if($active == 'edit'){ ?>
                                <?php echo form_open('district/district_modify/'.$district[0]['componentId'], $form_data); ?>
                            <?php } ?> 
                                
                                <div class="form-group">
                                    <label for="name" class="col-lg-3 control-label">District</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="name"
                                            <?php if($active == 'edit'){ ?>
                                                value="<?php echo $district[0]['district_name'] ?>"
                                            <?php } ?>
                                        
                                         placeholder="district Name" id="name" class="form-control" required>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                
                                <div class="form-group">
                                    <label for="name" class="col-lg-3 control-label">Divsions</label>
                                    <div class="col-lg-6">
                                        <select name="division" class="form-control">
                                        <?php foreach ($divisions as $divisionKey => $division): ?>
                                            <option value="<?php echo $division['componentId']; ?>"><?php echo $division['division_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>    
                                    </div>
                                </div>
                                


                            <div id="buttons">
                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-6">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?> 
                        </div>
                    </section>
                </div>
            </div>
	<?php endif; ?>
  <?php endif; ?>

  <script>


  </script>
  
