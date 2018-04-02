<?php
$product_image_path   = $product_no_image_url;

$editing_product	=	(isset($editing_product))?$editing_product:'';
 
if($editing_product){
    $image      = $editing_product['photo'];
    $product_image= $product_image_fs_url.$image;
    if(($image) && (file_exists($product_image))){
      $product_image_path = $product_image_url.$image;
    } 
}

?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default card-view">
			<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark"><?php echo ($editing_product)?"Edit ":"Add ",$module;?></h6>
				</div>
				<div class="pull-right">
					<!-- <a href="<?php echo $base_url.$module.'/listing';?>" class="btn btn-primary btn-outline fancy-button btn-0 btn-xs" style="margin-top:auto;"><?php echo $module.' Listing';?></a> -->
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">					
					<div class="form-wrap">
						<form method="post" action="<?php echo $base_url.'products/add/';?><?php echo($editing_product)?$editing_product['product_id']:'';?>" enctype="multipart/form-data">
							<div class="form-body">
								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-group <?php echo (form_error('name'))?'has-error':''; ?>">
													<label class="control-label mb-10" for="name">Product Name<span style="color:red;"> *</span></label>
													<input type="text" class="form-control" id="name" name="name" placeholder="Product Name" value="<?php echo set_value('name',($editing_product)?$editing_product['name']:''); ?>">
													<span class="help-block"><?php echo form_error('name'); ?></span>
												</div>
												<div class="form-group <?php echo (form_error('sku'))?'has-error':''; ?>">
													<label class="control-label mb-10" for="sku">SKU<span style="color:red;"> *</span></label>	
													<input type="text" class="form-control skuid_affector capitalize" id="sku" name="sku" placeholder="SKU" value="<?php echo set_value('sku',($editing_product)?$editing_product['sku']:''); ?>" <?php echo ($editing_product)?'disabled':'';?>>
													<span class="help-block"><?php echo form_error('sku'); ?></span>
												</div>
												<div class="form-group <?php echo (form_error('febric'))?'has-error':''; ?>">
													<label class="control-label mb-10" for="febric">Febric<span style="color:red;"> *</span></label>
													<select name="febric" id= "febric" class="form-control select2 skuid_affector" style="width: 100%;" <?php echo ($editing_product)?'disabled':'';?> >
														<?php
															$febric = set_value('febric',($editing_product)?$editing_product['febric']:'');

															echo "<option value=\"\">Select Febric</option>";
															foreach($febric_array as $k=>$v){
																$selected = ($febric == $k)?"selected=\"selected\"":"";
																echo "<option value=\"{$k}\" $selected>$v</option>";
															}
														?>
													</select>
													<span class="help-block"><?php echo form_error('sku'); ?></span>
												</div>
												<div class="form-group <?php echo (form_error('status'))?'has-error':''; ?>">
													<label class="control-label mb-10" for="status">Status<span style="color:red;"> *</span></label>
													<select name="status" id= "status" class="form-control" style="width: 100%;" >
														<?php $status = set_value('status',($editing_product)?$editing_product['status']:''); ?>									
														<option value="" <?php echo ($status)?'':"selected=\"selected\"" ?>>Select Status</option>
														<option value="<?php echo ACTIVE; ?>" <?php echo ($status==ACTIVE)?"selected=\"selected\"":"" ?>>Active</option>
														<option value="<?php echo INACTIVE; ?>" <?php echo ($status==INACTIVE)?"selected=\"selected\"":"" ?>>Inactive</option>
													</select>
													<span class="help-block"><?php echo form_error('status'); ?></span>
												</div>	
												<?php if(!$editing_product):?>
												<!-- <div class="form-group">
													<div class="checkbox checkbox-success">
														<input id="quantity_check" name="quantity_check" type="checkbox" <?php echo(isset($check_box_checked))?"checked":'';?>>
														<label for="quantity_check" id="quantity_check_lbl"> Initial Quantity </label>
													</div>
												</div> -->
												<?php foreach($tag_array as $t):?>
													<div class="form-group">
														<!-- <label class="control-label mb-10" for="<?php echo $t?>"><?php echo $t?></label> -->
														<input type="text" class="form-control numberonly" id="<?php echo $t?>" name="<?php echo $t?>" maxlength="3" placeholder="<?php echo $t?> Quantity" value="">
													</div>
												<?php endforeach;?>												
												<?php endif;?>	
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<input type="file" id="photo" name="photo" style="display:none;">
										<div style="text-align:center;margin-top: 30px;">
											<a href="javascript:void(0)" id="photo_anchor">
												<img class="" src="<?php echo $product_image_path;?>"  alt="Image description" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);max-height: 300px;min-height: 300px;" id="product_image" name="product_image"/>
											</a>
											<p id="skuid_p"><b>SKUID # </b><?php echo set_value('sku_id',($editing_product)?$editing_product['sku_id']:''); ?></p>
											<input type="hidden" name="sku_id" id="sku_id" value="<?php echo set_value('sku_id',($editing_product)?$editing_product['sku_id']:''); ?>">
										</div>										
									</div>
								</div>
							</div>
							<div class="form-actions mt-10">
								<div class="pull-right">
									<?php if($editing_product):?>
										<button type="submit" class="btn btn-success  mr-10">Update</button>
										<a href="<?php echo $base_url.$module.'/listing';?>" type="button" class="btn btn-default">Cancel</a>
									<?php else: ?>
										<button type="submit" class="btn btn-success  mr-10">Save</button>
										<button type="button" class="btn btn-default">Cancel</button>
									<?php endif;?>
								</div>
							</div>
						</form>					
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