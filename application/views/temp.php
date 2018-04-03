<div class="form-wrap">
						<form method="post" action="<?php echo $base_url.'orders/add/';?><?php echo($editing_order)?$editing_order['product_id']:'';?>" enctype="multipart/form-data">
							<div class="form-body">
								<div class="row">
									<div class="col-md-3" style="background-color: #fff;padding:20px;border-left: 1px solid #e4e4e4;border-right: 1px solid #e4e4e4;">
										<div class="form-group">
											<label class="control-label mb-10" for="name">Vendor</label>
											<!-- <div class="input-group mb-15"> -->
												<select class="form-control select2" name="vendor_id">
													<option value=''>Select Client</option>
													<?php															
														foreach($clients as $client_array){
															$selected = '';//($febric == $k)?"selected=\"selected\"":"";
															echo "<option value=\"{$client_array['client_id']}\" $selected>{$client_array['first_name']} {$client_array['last_name']}</option>";
														}
													?>
												</select>
												<!-- <span class="input-group-addon"><i class="fa fa-search"></i></span>
											</div> -->
										</div>
										<div class="form-group abc">
											<label class="control-label mb-10" for="delivery_date">Delivery Date</label>
											<input class="form-control datepicker" type="text" name="delivery_date">
										</div>
									</div>
									<div class="col-md-9">
										<div class="table-wrap">
											<div class="table-responsive">
												<table id="order_table" class="datatable table table-hover display  pb-30" >
													<thead>
														<tr>
															<th>#</th>
															<th>Select Product</th>
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