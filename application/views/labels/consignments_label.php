<?php
	$editing_order	=	(isset($editing_order))?$editing_order:'';
?>
<style>
	.consignment_links a{
		display: block;
	    text-decoration: underline;
	    color: green;
	}
</style>
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
						<form class="form-horizontal" method="post" action="<?php echo $base_url.'labels/generate/';?>">
							<div class="form-body">
								<div class="row">
									<div class="col-md-3" style="background-color: #fff;padding:20px;border-left: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4;">
										<div class="form-group">
											<label class="control-label mb-10" for="name">Vendor</label>
											<!-- <div class="input-group mb-15"> -->
												<select class="form-control select2" id="vendor_id">
													<option value=''>Select Vendor</option>
													<?php															
														foreach($vendors as $vendor_array){
															echo "<option value=\"{$vendor_array['vendor_id']}\">{$vendor_array['vendor_name']}</option>";
														}
													?>
												</select>
												<!-- <span class="input-group-addon"><i class="fa fa-search"></i></span>
											</div> -->
										</div>
										<div class="form-group">
											<label class="control-label mb-10" for="consignment_date">Recieve Date</label>
											<input class="form-control datepicker" type="text" id="consignment_date">
										</div>
										<div class="form-group">					
											<a href="javascript:void(0)" id="fetch_consignment" class="btn btn-success btn-xs btn-block">Fetch</a>
										</div>
										<div class="form-group consignment_links" style="display:none;">
											<label class="control-label mb-10" for="">Consignments</label>
											<div class="consignment_list">
												
											</div>
										</div>
									</div>
									<div class="col-md-9">
										<div class="table-wrap">
											<div class="table-responsive">
												<input type="hidden" name="consignment_id" id="consignment_id">
												<table id="consignments_table" class="table table-hover display  pb-30" >
													<thead>
														<tr>
															<th>#</th>
															<th>Product</th>
															<th>Tag</th>
															<th>Quantity</th>
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
									<button type="submit" class="btn btn-success  mr-10">Generate</button>
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
			<input type="hidden">
			<p class="product_name form-control-static"></p>
		</td>
		<td>
			<p class="product_tag form-control-static"></p>
		</td>
		<td>
			<input type="text" class="numberonly" maxlength="3">
		</td>
	</tr>
</table>

<script type="text/javascript">	
	var template_row,consignments_table_body;
	var row_id = 1;
	$(function(){
		template_row = $('#template_table').find('tr').clone().end().remove();

		consignments_table_body = $('#consignments_table tbody');		

		$('.datepicker').datetimepicker({
			format: 'YYYY-MM-DD',
			// widgetParent: $('.abc'),
			// widgetPositioning:{vartical:'bottom'}
		});

		$('#fetch_consignment').on('click',function(){
			consignments_table_body.children().remove();
			var parent = $(this).closest('.col-md-3');
			var vendor_id = parent.find('select').val();
			var consignment_date = parent.find('.datepicker').val();

			if(vendor_id.length >0 && consignment_date.length>0){
				$.ajax({
					type	:	"post",
					url		:	"<?php echo $base_url.'consignments/ajax_get_consignments';?>",
					data	:	{
									"vendor_id"			: 	vendor_id,
									"consignment_date"	:	consignment_date
								},
					datatype:	"json",
					success	:	function(result){
						result = JSON.parse(result);
						$('.consignment_list').children().remove().end().closest('.consignment_links').hide();
						if(result.length > 0){
							if(result.length == 1){
								generate_list(result[0].consignment_id);
							}else{
								var result_str = "";
								$.each(result,function(i,v){
									result_str += "<a href=\"javascript:void(0)\" data-consignment_id=\""+v.consignment_id+"\">Consignment_id - "+v.consignment_id+"</a>";
								});
								$('.consignment_list').closest('.consignment_links').show().end().append(result_str);
							}
						}
					},
					error	:	function(xmlhttprequers,textStatus,error){
						console.log(xmlhttprequers.responseText);
					},
					complete:	function(){							
					}
				});
			}
		});

		$('.consignment_list').on('click','a',function(e){
			var consignment_id = parseInt($(this).data('consignment_id'));
			generate_list(consignment_id);
			
		});

		// $('.select2').select2();


	});


	function generate_list(consignment_id){
		if(!isNaN(consignment_id)){

			$('#consignment_id').val(consignment_id);

			$.ajax({
				type	:	"post",
				url		:	"<?php echo $base_url.'consignments/ajax_get_consignments_detail';?>",
				data	:	{
								"consignment_id"	: 	consignment_id
							},
				datatype:	"json",
				success	:	function(result){
					result = JSON.parse(result);
					if(result.length > 0){
						var fragment = $(document.createDocumentFragment());
						$.each(result,function(i,v){
							counter=1;
							fragment.append(template_row
											.clone()
											.find(':input[type=hidden]')
											.attr('name','details['+row_id+'][]')
											.val(v.sku_id+"-"+v.tag_name+consignment_id)
											.end()
											.find('p.product_name')
											.text(v.name)
											.end()
											.find('p.product_tag')
											.text(v.tag_full_name)
											.end()
											.find(':input[type=text]')										
											.attr('name','details['+row_id+'][]')
											.val(v.quantity)
											.end()).find('tr').each(function(i,v){
												$(this).children(":first").text(counter++);
											});;
							row_id++;
						});
						consignments_table_body.children().remove().end().append(fragment);
					}else{
						consignments_table_body.children().remove()
					}
				},
				error	:	function(xmlhttprequers,textStatus,error){
					console.log(xmlhttprequers.responseText);
				},
				complete:	function(){							
				}
			});
		}
	}
</script>