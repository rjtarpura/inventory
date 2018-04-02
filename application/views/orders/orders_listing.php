<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default card-view">
			<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark"><?php echo $module.' Listing';?></h6>
				</div>
				<div class="pull-right">
					<!-- <a href="#" class="pull-left inline-block full-screen mr-15">
						<i class="zmdi zmdi-fullscreen"></i>
					</a> -->
					<!-- <a href="<?php echo $base_url.$module.'/add';?>" class="btn btn-primary btn-xs" style="margin-top:auto;">Add <?php echo $module;?></a> -->
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div class="table-wrap">
						<div class="table-responsive">
							<table id="" class="datatable table table-hover display  pb-30" >
								<thead>
									<tr>
										<th>SKU</th>
										<th>SKU ID</th>
										<th>Name</th>
										<th>Febric</th>
										<th>Stock</th>
										<th>Status</th>
									<th  data-searchable="false" data-orderable="false" data-sortable="false">Action</th>
									</tr>
								</thead>
								<tbody>
									<!-- <?php foreach($products as $key=>$productArr): ?>
										<tr>									
											<td><?php echo $productArr['sku']; ?></td>
											<td><?php echo $productArr['sku_id']; ?></td>
											<td><?php echo $productArr['name']; ?></td>
											<td>										
												<?php foreach($febric_array as $feb_abbr=>$feb_name){
													if($feb_abbr == $productArr['febric']){
														echo $feb_name;
													}
												}?>
											</td>
											<th>
												<?php echo $productArr['quantity']; ?>
											</th>
											<td><?php echo ($productArr['status']==ACTIVE)?"<span class=\"label label-success\">ACTIVE</span>":"<span class=\"label label-warning\">INACTIVE</span>"; ?>
											</td>
											<td class="table_row_btn">										
												<a href="<?php echo $base_url.'products/add/'.$productArr['product_id']; ?>" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
											</td>
										</tr>
									<?php endforeach; ?> -->
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$('.datatable').DataTable();
	});
</script>