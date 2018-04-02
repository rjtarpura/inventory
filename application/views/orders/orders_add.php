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
						<form method="post" action="<?php echo $base_url.'products/add/';?><?php echo($editing_order)?$editing_order['product_id']:'';?>" enctype="multipart/form-data">
							<div class="form-body">
								<div class="row">
									<div class="col-md-3">

									</div>
									<div class="col-md-9">
										<div class="table-wrap">
											<div class="table-responsive">
												<table id="" class="datatable table table-hover display  pb-30" >
													<thead>
														<tr>
															<th>Select Product</th>
															<th>Quantity</th>
															<th data-searchable="false" data-orderable="false" data-sortable="false">Action</th>
														</tr>
													</thead>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-actions mt-10">
								<div class="pull-right">
									<?php if($editing_order):?>
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

	}
</script>