
  <ul class="nav nav-pills">
    <li  
    class="<?php 
    		if(isset($active))
    			if($active == 'report') echo "active" 
    	?>">
    	<a href="<?php echo base_url('employee/report'); ?>">List</a>
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
            <a href="<?php echo base_url('employee/add'); ?>">Add</a>
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
                        <?php if($this->session->flashdata('success_msg')): ?>
                        <header class="panel-heading" id="success_msg">
                            <p class="alert alert-success"><?php echo $this->session->flashdata('success_msg'); ?></p>
                        </header>
                        <?php endif; ?>
                        <header class="panel-heading">
                            Add Employee
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <div class="col-md-9 col-md-offset-3">
                                <p class="help-block"><?php echo validation_errors(); ?></p>
                            </div>
                            
                            <!-- <form role="form" class="form-horizontal "> -->

                            <?php 
                                $form_data = array(
                                    'role' => 'form',
                                    'class' => 'form-horizontal'
                                );
                            ?>

                            <?php if($active == 'add'){ ?>
                                <?php echo form_open('employee/employee_save', $form_data); ?>
                            <?php }else if($active == 'edit'){ ?>
                                <?php echo form_open('employee/employee_modify/'.$employee['employee_id'], $form_data); ?>
                            <?php } ?> 

								<div class="form-group">
                                    <label for="employee_name" class="col-lg-3 control-label">মৃত/আক্ষম কর্মচারীর নাম</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="employee_name" placeholder="Name"
                                            
                                        <?php if($active == 'edit'){ ?>
                                            value="<?php echo $employee['name'] ?>"
                                        <?php }else{ ?>
                                            value="<?php echo set_value('employee_name'); ?>"
                                        <?php } ?>
                
                                         id="employee_name" class="form-control" required>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="designation" class="col-lg-3 control-label">পদবী</label>
                                    <div class="col-lg-6">
                                        <select class="form-control m-bot15" name="designation" required>
                                            <option value=''>Select...</option>
                                            <?php foreach($designations as $key=>$designation): ?>
                                                <option value="<?php echo $designation['componentId']; ?>"
                                                    

                                                    <?php 
                                                    if($active == 'edit'){
                                                        if($designation['componentId'] == $employee['designation']) echo "selected";
                                                    }else{ ?>
                                                    <?php echo set_select('designation', $designation['componentId']); ?>     
                                                    <?php } ?>
                                                    >

                                                    <?php echo $designation['name'] ?>
                                                    
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="division_chamber" class="col-lg-3 control-label">কার্যালয়ের বিভাগ</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="division_chamber" placeholder="Name"
                                            
                                        <?php if($active == 'edit'){ ?>
                                            value="<?php echo $employee['division_chamber'] ?>"
                                        <?php }else{ ?>
                                            value="<?php echo set_value('division_chamber'); ?>"
                                        <?php } ?>
                
                                         id="division_chamber" class="form-control" required>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="district_chamber" class="col-lg-3 control-label">কার্যালয়ের জেলা</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="district_chamber" placeholder="district_chamber"
                                            
                                        <?php if($active == 'edit'){ ?>
                                            value="<?php echo $employee['district_chamber'] ?>"
                                        <?php }else{ ?>
                                            value="<?php echo set_value('district_chamber'); ?>"
                                        <?php } ?>
                
                                         id="district_chamber" class="form-control" required>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="chamber" class="col-lg-3 control-label">কার্যালয়ের নাম</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="chamber" placeholder="chamber"
                                            
                                        <?php if($active == 'edit'){ ?>
                                            value="<?php echo $employee['chamber'] ?>"
                                        <?php }else{ ?>
                                            value="<?php echo set_value('chamber'); ?>"
                                        <?php } ?>
                
                                         id="chamber" class="form-control" required>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="last_sallary" class="col-lg-3 control-label">শেষ বেতনের পরিমান</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="last_sallary" placeholder="last_sallary" id="last_sallary"
                                        
                                        <?php if($active == 'edit'){ ?>
                                            value="<?php echo $employee['last_salary'] ?>"
                                        <?php }else{ ?>
                                            value="<?php echo set_value('last_sallary'); ?>"
                                        <?php } ?>

                                         class="form-control" required>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="file_no" class="col-lg-3 control-label">নথি নং</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="file_no" placeholder="file_no" id="file_no"
                                        
                                        <?php if($active == 'edit'){ ?>
                                            value="<?php echo $employee['file_no'] ?>"
                                        <?php }else{ ?>
                                            value="<?php echo set_value('file_no'); ?>"
                                        <?php } ?>

                                         class="form-control" required>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">জন্ম তারিখ</label>
                                    <div class="col-lg-6">
                                        <input name="date_of_birth"
                                            
                                            <?php if($active == 'edit'){ ?>
                                                value="<?php echo $employee['date_of_birth'] ?>"
                                            <?php }else{ ?>
                                            value="<?php echo set_value('date_of_birth'); ?>"
                                        <?php } ?>
                                            
                                         class="form-control date" required>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">মৃত অথবা অক্ষমের তারিখ</label>
                                    <div class="col-lg-6">
                                        <input name="death_accident_date"
                                            
                                            <?php if($active == 'edit'){ ?>
                                                value="<?php echo $employee['death'] ?>"
                                            <?php }else{ ?>
                                            value="<?php echo set_value('death_accident_date'); ?>"
                                        <?php } ?>

                                         class="form-control date" required>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="division_bank" class="col-lg-3 control-label">ব্যাংকের বিভাগ</label>
                                    <div class="col-lg-6">
                                        <select name="division_bank" class="form-control" id="division_bank">
                                            <?php foreach ($divisions as $divKey => $division): ?>
                                                <option 
                                                value="<?php echo $division['division'];
                                                ?>"
                                                <?php echo ($employee['division_bank'] == $division['division'])?'selected':''; ?>

                                                 ><?php echo $division['division']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="district_bank" class="col-lg-3 control-label">ব্যাংকের জেলা</label>
                                    <div class="col-lg-6">
                                        <select name="district_bank" class="form-control" id="district_bank">
                                            <?php foreach ($districts as $disKey => $district): ?>
                                                <option value="<?php echo $district['distName']; ?>"
                                                    
                                                    <?php echo ($employee['district_bank'] == $district['distName'])?'selected':''; ?>

                                                    ><?php echo $district['distName']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bank" class="col-lg-3 control-label">ব্যাংকের নাম</label>
                                    <div class="col-lg-6">
                                        <select name="bank" class="form-control" id="bank">
                                        <?php foreach ($branches as $branchKey => $branch): ?>
                                            <option value="<?php echo $branch['branchName'] ?>"
                                                <?php echo ($employee['bank'] == $branch['branchName'])?'selected':''; ?>
                                                ><?php echo $branch['branchName']; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                            <div class="form-group">
                                    <label id="nominee_form_title" class="col-lg-3 col-lg-offset-3 control-label">
                                        প্রাপক/প্রাপিকা 'র তথ্য
                                    </label>
                            </div>


                        <div id="nominee_form" 
                        <?php 
                            if($active == 'edit'){ 
                                echo "hidden";
                            ?>
                                
                                <input type="hidden" name="nominee_id[]" value="">
                                <?php } ?>
                        >
                            <div class="nominee_form">
                                <div class="form-group">
                                    <label id="nominee_counter" class="col-lg-3 col-lg-offset-3 control-label nominee_counter">
                                        1
                                    </label>

                                    <label id="nominee_form_title" class="col-lg-3 control-label">
                                        <a class="btn btn-danger remove_nominee">X</a>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-lg-3 control-label">কার্ড নং</label>
                                    <div class="col-lg-6">
                                        <input type="text" 
                                        
                                        <?php 
                                            if($active != 'edit') echo "required";
                                        ?>

                                        placeholder="card no" id="name" class="form-control" name="card_no[]">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="name" class="col-lg-3 control-label">প্রাপক/প্রাপিকা 'র নাম</label>
                                    <div class="col-lg-6">
                                        <input type="text" 
                                        
                                        <?php 
                                            if($active != 'edit') echo "required";
                                        ?>

                                        placeholder="name" id="name" class="form-control" name="name[]">
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="relation" class="col-lg-3 control-label">সম্পর্ক</label>
                                    <div class="col-lg-6">
                                        <select class="form-control m-bot15" 
                                        <?php 
                                            if($active != 'edit') echo "required";
                                        ?> 
                                        name="relation[]">
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
                                    <label for="address" class="col-lg-3 control-label">ঠিকানা</label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" name="address[]" <?php 
                                            if($active != 'edit') echo "required";
                                        ?>
                                        rows="5" cols="50" wrap="physical"></textarea>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="amount_at_a_time" class="col-lg-3 control-label">এককালীন টাকার পরিমান</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="amount_at_a_time[]" placeholder="amount_at_a_time" id="amount_at_a_time" class="form-control" 
                                        <?php 
                                            if($active != 'edit') echo "required";
                                        ?>>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="amount_per_month" class="col-lg-3 control-label">কল্যান ভাতার মাসিক পরিমান</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="amount_per_month[]" placeholder="amount_per_month" id="amount_per_month" class="form-control" 
                                        <?php 
                                            if($active != 'edit') echo "required";
                                        ?>>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">ভাতা শুরুর সময়</label>
                                    <div class="col-lg-6">
                                        <input name="pay_time_starts[]" class="form-control date" 
                                        <?php 
                                            if($active != 'edit') echo "required";
                                        ?>>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">ভাতা শেষের সময়</label>
                                    <div class="col-lg-6">
                                        <input name="pay_time_ends[]" class="form-control date" 
                                        <?php 
                                            if($active != 'edit') echo "required";
                                        ?>>
                                        <!-- <p class="help-block">Successfully done</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if($active == 'edit'): ?>
                            <?php foreach($nominees as $nominee_key => $nominee): ?>
                                        <div id="" 
                                >
                                <input type="hidden" name="nominee_id[]"
                                value="<?php 
                                    echo $nominee['componentId'];
                                ?>" 
                                >
                                    <div class="nominee_form">
                                        <div class="form-group">
                                            <label id="nominee_counter" class="col-lg-3 col-lg-offset-3 control-label nominee_counter">
                                                <?php echo $nominee_key+1; ?>
                                            </label>

                                            <label id="nominee_form_title" class="col-lg-3 control-label">
                                                <a id="<?php echo $nominee['componentId']; ?>" class="btn btn-danger remove_nominee">X</a>
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-lg-3 control-label">কার্ড নং</label>
                                            <div class="col-lg-6">
                                                <input type="text" 
                                                <?php 
                                                    if($active != 'edit') echo "required";
                                                ?> 
                                        placeholder="card no" id="card_no"
                                                value="<?php echo $nominee['card_no']; ?>" 
                                                class="form-control" name="card_no[]">
                                                <!-- <p class="help-block">Successfully done</p> -->
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="name" class="col-lg-3 control-label">প্রাপক/প্রাপিকা 'র নাম</label>
                                            <div class="col-lg-6">
                                                <input type="text" 
                                                <?php 
                                                    if($active != 'edit') echo "required";
                                                ?> 
                                        placeholder="name" id="name"
                                                value="<?php echo $nominee['name']; ?>" 
                                                class="form-control" name="name[]">
                                                <!-- <p class="help-block">Successfully done</p> -->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="relation" class="col-lg-3 control-label">সম্পর্ক</label>
                                            <div class="col-lg-6">
                                                <select class="form-control m-bot15" 
                                                <?php 
                                                    if($active != 'edit') echo "required";
                                                ?>
                                         name="relation[]">
                                                    <option value=''>Select...</option>
                                                    <?php foreach($relations as $key=>$relation): ?>
                                                        <option value="<?php echo $relation['componentId']; ?>"
                                                        
                                                        <?php if($relation['componentId'] == $nominee['relation']) echo "selected"; ?>
    
                                                            >

                                                            <?php echo $relation['relation_name'] ?>
                                                            
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <!-- <p class="help-block">Successfully done</p> -->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="address" class="col-lg-3 control-label">ঠিকানা</label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control" name="address[]" 
                                                <?php 
                                                    if($active != 'edit') echo "required";
                                                ?>
                                                rows="5" cols="50" wrap="physical"><?php echo $nominee['address']; ?></textarea>
                                                <!-- <p class="help-block">Successfully done</p> -->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="amount_at_a_time" class="col-lg-3 control-label">এককালীন টাকার পরিমান</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="amount_at_a_time[]" placeholder="amount_at_a_time"
                                                    
                                                    value="<?php echo $nominee['amount_at_a_time']; ?>" 

                                                 id="amount_at_a_time" class="form-control" 
                                                <?php 
                                                    if($active != 'edit') echo "required";
                                                ?>
                                                 >
                                                <!-- <p class="help-block">Successfully done</p> -->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="amount_per_month" class="col-lg-3 control-label">কল্যান ভাতার মাসিক পরিমান</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="amount_per_month[]" placeholder="amount_per_month"
                                                
                                                value="<?php echo $nominee['amount_per_month']; ?>"
                                                
                                                 id="amount_per_month" class="form-control" 
                                                 <?php 
                                                    if($active != 'edit') echo "required";
                                                ?>
                                        >
                                                <!-- <p class="help-block">Successfully done</p> -->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">ভাতা শুরুর সময়</label>
                                            <div class="col-lg-6">
                                                <input name="pay_time_starts[]"
                                                
                                                value="<?php echo $nominee['pay_time_starts']; ?>"

                                                 class="form-control date" 
                                                 <?php 
                                                    if($active != 'edit') echo "required";
                                                ?>
                                        >
                                                <!-- <p class="help-block">Successfully done</p> -->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">ভাতা শেষের সময়</label>
                                            <div class="col-lg-6">
                                                <input name="pay_time_ends[]"
                                                
                                                value="<?php echo $nominee['pay_time_ends']; ?>"
                                    
                                                 class="form-control date" 
                                                <?php 
                                                    if($active != 'edit') echo "required";
                                                ?>
                                                 >
                                                <!-- <p class="help-block">Successfully done</p> -->
                                            </div>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">অবস্থা</label>
                                            <div class="col-lg-6">
                                                <select class="form-control m-bot15" name="status[]">
                                                    <option value="1" <?php if($nominee['status']) echo "selected"; ?>>Active</option>
                                                    <option value="0" <?php if(!$nominee['status']) echo "selected"; ?>>Inactive</option>
                                                </select>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">নিষ্ক্রিয়</label>
                                            <div class="col-lg-6">
                                                <input name="inactive_date[]"
                                                
                                                value="<?php echo $nominee['inactive_date']; ?>"
                                    
                                                 class="form-control date" 
                                                <?php 
                                                    if($active != 'edit') echo "required";
                                                ?>
                                                 >
                                                <!-- <p class="help-block">Successfully done</p> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                            <div id="more_nominee_forms">
                                
                            </div>

                            <div id="buttons">
                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-6">
                                        <a class="btn btn-default" id="add_nominee">Add Nominee</a>

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
    $(document).on('change', '#division_bank', function(){
        var division = $('#division_bank').val();
        var url = '<?php echo base_url(); ?>'+'employee/fetchDistrict/'+division;
        console.log(url);
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function(response){
                var districts = '';
                var i;
                for(i = 0; i<response.length; i++){
                    districts += '<option value="'+response[i].distName+'">'+response[i].distName+'</option>';
                }
                $('#district_bank').html(districts);
            },
            error: function(){
                console.log('Something went wrong');
            }
        });

    });

    $(document).on('change', '#district_bank', function(){
        var district = $('#district_bank').val();
        var url = '<?php echo base_url(); ?>'+'employee/fetchBranch/'+district;
        console.log(url);
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function(response){
                var branches = '';
                var i;
                for(i = 0; i<response.length; i++){
                    branches += '<option value="'+response[i].branchName+'">'+response[i].branchName+'</option>';
                }
                $('#bank').html(branches);
            },
            error: function(){
                console.log('Something went wrong');
            }
        });

    });

        $(document).ready(function(){
            $('#success_msg').delay(2000).fadeOut();
        });

      $(document).on('click', '#add_nominee', function(e){
            e.preventDefault();

            var nominee_form = $('#nominee_form').html();
            $('#more_nominee_forms').append(nominee_form);

            var nominee_forms = $('.nominee_counter').length;
            $('.nominee_counter:last').text(nominee_forms);
      });



      $(document).on('click', '.remove_nominee', function(e){
            e.preventDefault();

            var nominee_id = $(this).attr('id');

            if(nominee_id){
                if(confirm('Sure to delete?')){
                    $(this).parent().parent().parent().fadeOut();
                    var url = "<?php echo base_url('employee/delete_nominee/') ?>"+nominee_id;
                    $.ajax({
                        url: url,
                        async: false,
                        dataType: 'json',
                        success: function(data){
                            if(data == true){
                                alert('Deleted');
                            }
                        },
                        error: function(){
                            alert('Cannot be deleted');
                        }
                    });
                }
                
            }else{
                $(this).parent().parent().parent().remove();
                var left_nominees = $('.nominee_counter').length;
                for(var i = 0; i < left_nominees; i++){
                    var j = i;
                    $('.nominee_counter:eq("'+i+'")').text(++j);
                }
            }
      });

      $(document).on('focus', '.date', function(){
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-150:+100",
            dateFormat: 'd-MM-yy'
        });
      });


  </script>
  
