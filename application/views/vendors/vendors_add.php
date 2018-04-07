<?php
$product_image_path   = $product_no_image_url;

$editing	=	(isset($editing))?$editing:'';
 
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default card-view">
			<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark"><?php echo ($editing)?"Edit ":"Add ",$module;?></h6>
				</div>
				<div class="pull-right">
					<!-- <a href="<?php echo $base_url.$module.'/listing';?>" class="btn btn-primary btn-outline fancy-button btn-0 btn-xs" style="margin-top:auto;"><?php echo $module.' Listing';?></a> -->
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group <?php echo (form_error('first_name'))?'has-error':''; ?>">
								<label class="control-label col-md-3" for="first_name">First Name<span style="color:red;"> *</span></label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?php echo set_value('first_name',($editing)?$editing['first_name']:'');?>">
									<span class="help-block"><?php echo form_error('first_name'); ?></span>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group <?php echo (form_error('last_name'))?'has-error':''; ?>">
								<label class="control-label col-md-3" for="last_name">Last Name<span style="color:red;"> *</span></label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo set_value('last_name',($editing)?$editing['last_name']:'');?>">
									<span class="help-block"><?php echo form_error('last_name'); ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group <?php echo (form_error('email'))?'has-error':''; ?>">
								<label class="control-label col-md-3" for="email">Email</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo set_value('email',($editing)?$editing['email']:'');?>">
									<span class="help-block"><?php echo form_error('email'); ?></span>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group <?php echo (form_error('contact'))?'has-error':''; ?>">
								<label class="control-label col-md-3" for="contact">Contact</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="contact" name="contact" placeholder="Contact" value="<?php echo set_value('contact',($editing)?$editing['contact']:'');?>">
									<span class="help-block"><?php echo form_error('contact'); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">	
	
	$(function(){
		// $('#quantity_check').on('change',function(e){
		// 	if($(this).is(":checked")){
		// 		$(this).next().css('color','black');
		// 		$('#quantity').show();
		// 	}else{
		// 		$(this).next().css('color','inherit');
		// 		$('#quantity').hide();
		// 	}
		// }).on('focusin',function(e){			
		// 	$(this).next().css("text-decoration","underline");			
		// }).on('focusout',function(e){
		// 	$(this).next().css("text-decoration","none");
		// }).trigger('change');

		// $('#quantity_check_lbl').on('mouseover',function(){			
		// 	$(this).css("text-decoration","underline");
		// }).on('mouseout',function(){
		// 	$(this).css("text-decoration","none");
		// });

		$('#photo_anchor').on('focusin',function(){
			$(this).find('#product_image').addClass('img-thumbnail');
			// css('box-shadow','0 4px 8px 0 rgba(32, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);');
		}).on('focusout',function(){
			$(this).find('#product_image').removeClass('img-thumbnail');
		}).on('click',function(){
			$('#photo').trigger('click');
		});

		$('#photo').on('change',function(event){
	      var filename = $('#photo').val();

	      if(filename.length >0){
	        
	        var path = URL.createObjectURL(event.target.files[0]);
	      
	        if(validate_file(filename) >= 0){ //do validation of file here

	          if(event.target.files[0].size < settings.profile_pic_size_bytes){
	            $('#product_image').attr('src',path);
	          }else{
	          	$(this).val('');
	          	toast('error','Invalid File','File size must not exceeds'+settings.profile_pic_size_bytes);
	          }                                   
	        }else{
	        	$(this).val('');
	          	toast('error','Invalid File','Allowed File types are : <br/>'+allowed.join(", "));
	        }
	      }                             
	    });

	    $('.skuid_affector').on('change',function(){
    	
	    	var skuid_p = $('#skuid_p');
	    	var sku_id = $('#sku_id');
	    	var all_data_available = true;
	    	var skuid_arr = [];
	    	$('.skuid_affector').each(function(i,v){
	    		var val = $(v).val();
	    		if(val.length == 0){
	    			all_data_available = false;    			
	    		}else{
	    			skuid_arr.push(val);
	    		}
	    	});

	    	if(all_data_available){
	    		skuid_p.html("<b>SKUID # </b><u>"+skuid_arr.join('-')+"</u>");
	    		sku_id.val(skuid_arr.join('-'));
	    	}else{
				skuid_p.html("<b>SKUID # </b>");    			
				sku_id.val('');
			}
	    });
	});

	function validate_file(filename){  
	  var extension = filename.substring(filename.lastIndexOf('.')+1);
	  return $.inArray(extension,allowed);
	  return true;
	}	
</script>