<?php
	$editing_order	=	(isset($editing_order))?$editing_order:'';
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default card-view">
			<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark"><?php echo ($editing_order)?"Edit ":"Add ",$module;?></h6>
				</div>
				<div class="pull-right">
					<!-- <a href="<?php echo $base_url.$module.'/listing';?>" class="btn btn-primary btn-outline fancy-button btn-0 btn-xs" style="margin-top:auto;"><?php echo $module.' Listing';?></a> -->
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">					
					<form method="post" id="order_form" action="<?php echo $base_url.'orders/add/';?><?php echo($editing_order)?$editing_order['product_id']:'';?>" enctype="multipart/form-data">
						<h3><span class="number"><i class="icon-user-following txt-black"></i></span><span class="head-font capitalize-font">Select Client</span></h3>
						<fieldset>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-wrap">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon"><i class="icon-user"></i></div>
												<input type="text" class="form-control required"  name="Username" id="exampleInputuname" placeholder="Username">
											</div>
										</div>
									</div>
								</div>
							</div>
						</fieldset>

						<h3><span class="number"><i class="icon-bag txt-black"></i></span><span class="head-font capitalize-font">shipping</span></h3>
						<fieldset>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-wrap">
										<div class="form-group">
											<label class="control-label mb-10" for="exampleCountry">country:</label>
											<select id="exampleCountry" class="form-control required" name="country">
												<option value="1">India</option>
												<option value="2">Australia</option>
												<option value="3">USA</option>
												<option value="4">Japan</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</fieldset>
					</form>
				</div>				
			</div>
		</div>
	</div>
</div>

<!-- Template tr -->
<table id="template_table" style="display:none;">
	<tr>
		<td>r</td>
		<td>
			<select class="form-control select2">
				<?php															
					echo "<option value=''>Select Product</option>";
					foreach($products as $product_array){
						$selected = '';//($febric == $k)?"selected=\"selected\"":"";
						echo "<option value=\"{$product_array['product_id']}\" $selected>{$product_array['name']}</option>";
					}
				?>
			</select>
		</td>
		<!-- <td>
			<select class="form-control select2">
				<?php															
					echo "<option value=''>Select Tag</option>";
					foreach($tag_array as $t){
						$selected = '';//($febric == $k)?"selected=\"selected\"":"";
						echo "<option value=\"{$t}\" $selected>{$t}</option>";
					}
				?>
			</select>
		</td> -->
		<td>
			<input type="text" class="form-control numberonly" maxlength="3">
		</td>
		<td class="table_row_btn">
			<a class="btn btn-primary add_row"><i class="fa fa-plus"></i></a>
			<a class="btn btn-warning remove_row"><i class="fa fa-minus"></i></a>
		</td>
	</tr>
</table>

<script type="text/javascript">	
	
	var template_row_1,order_table;
	var row_id = 1,counter=1;
	
	$(function(){
		template_row_1 = $('#template_table').find('tr').clone().end().remove();
		order_table = $('#order_table tbody');

		order_table.on('click','.add_row',function(e){
			add_row();
		}).on('click','.remove_row',function(e){
			if($(this).closest('tbody').find('tr').length>1){
				var parent = $(this).closest('tbody');
				$(this).closest('tr').remove();
						parent.find('tr').each(function(i,v){
							$(this).children(":first").text(counter++);
						});;
				counter=1;
			}		
		});

		add_row();

		$('.datepicker').datetimepicker({
			format: 'YYYY-MM-DD',
			// widgetParent: $('.abc'),
			// widgetPositioning:{vartical:'bottom'}
		});

		if($('#order_form').length >0){
		$("#order_form").steps({
				headerTag: "h3",
				bodyTag: "fieldset",
				transitionEffect: "fade",
				autoFocus: true,
				// titleTemplate: '<span class="number">#index#</span> #title#',
			});
		}

	});

	function add_row(){
		order_table.append(
					template_row_1
					.clone()
					.find('select')	//select:first
					// .attr('id',row_id)
					.attr('name','details['+row_id+'][]')
					// .select2()
					// .css('border','1px solid green')
					.end()
					.find(':input[type=text]')
					// .css('background-color','red')
					// .attr('id',row_id)
					.attr('name','details['+row_id+'][]')
					.end()
					).find('tr').each(function(i,v){
						$(this).children(":first").text(counter++);
					});
		row_id++;counter=1;
	}
</script>