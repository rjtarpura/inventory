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
					<div class="form-wrap">
						<form class="form-horizontal" method="post" action="<?php echo $base_url.'consignments/add/';?>">
							<div class="form-body">
								<div class="row">
									<div class="col-md-3" style="background-color: #fff;padding:20px;border-left: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4;">
										<div class="form-group">
											<label class="control-label mb-10" for="name">Vendor</label>
											<!-- <div class="input-group mb-15"> -->
												<select class="form-control select2" name="vendor_id">
													<option value=''>Select Vendor</option>
													<?php															
														foreach($vendors as $vendor_array){
															$selected = '';//($febric == $k)?"selected=\"selected\"":"";
															echo "<option value=\"{$vendor_array['vendor_id']}\" $selected>{$vendor_array['vendor_name']}</option>";
														}
													?>
												</select>
												<!-- <span class="input-group-addon"><i class="fa fa-search"></i></span>
											</div> -->
										</div>
										<div class="form-group abc">
											<label class="control-label mb-10" for="consignment_date">Recieve Date</label>
											<input class="form-control datepicker" type="text" name="consignment_date">
										</div>
									</div>
									<div class="col-md-9">
										<div class="table-wrap">
											<div class="table-responsive">
												<table id="consignments_table" class="table table-hover display  pb-30" >
													<thead>
														<tr>
															<th>#</th>
															<th>Select Product</th>
															<th>Tag</th>
															<th>Quantity</th>
															<th data-searchable="false" data-orderable="false" data-sortable="false">Action</th>
														</tr>
													</thead>
													<tbody>														
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>							
							<div class="form-actions mt-10">
								<div class="pull-right">
									<button type="submit" class="btn btn-success  mr-10">Save</button>
									<button type="button" class="btn btn-default">Cancel</button>
								</div>
							</div>
						</form>					
					</div>
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
		<td>
			<select class="form-control select2">
				<?php															
					echo "<option value=''>Select Tag</option>";
					foreach($tag_array as $t){
						$selected = '';//($febric == $k)?"selected=\"selected\"":"";
						echo "<option value=\"{$t}\" $selected>{$t}</option>";
					}
				?>
			</select>
		</td>
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
	var template_row_1,consignments_table_body;
	var row_id = 1,counter=1;
	$(function(){
		template_row_1 = $('#template_table').find('tr').clone().end().remove();

		consignments_table_body = $('#consignments_table tbody');
		
		consignments_table_body.on('click','.add_row',function(e){
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
		}).on('change','select',function(e){

			// if(!isNaN(parseInt($(this).val()))){

			// 	let selected_options = consignments_table_body.find('option:selected').filter(function(i,v){
			// 		if(!isNaN(parseInt($(v).val()))){return true;}				
			// 	}).map(function(i,v){
			// 		return $(v).val();
			// 	}).each(function(i,v){
			// 		// console.log(v);
			// 	});
			// 	console.log("Before",selected_options);
			// 	consignments_table_body.find('select').each(function(i,v){
			// 		let opt_arr = [];
			// 		if(!isNaN(parseInt($(v).val()))){
			// 			opt_arr = selected_options.filter(function(index,val){

			// 			});
			// 		}
				
			// 	});
			// }
		});

		$('.datepicker').datetimepicker({
			format: 'YYYY-MM-DD',
			// widgetParent: $('.abc'),
			// widgetPositioning:{vartical:'bottom'}
		});

		// $('.select2').select2();

		add_row();
	});

	function add_row(){
		consignments_table_body.append(
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