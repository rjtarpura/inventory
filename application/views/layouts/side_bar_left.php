<div class="fixed-sidebar-left">
	<ul class="nav navbar-nav side-nav nicescroll-bar">
		<li class="navigation-header">
			<span>Main</span> 
			<i class="zmdi zmdi-more"></i>
		</li>
		<li>
			<a href="#"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
			
		</li>
		<li><hr class="light-grey-hr mb-10"/></li>
		<li>
			<a href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr" class="<?php echo ($current_page_url=='products/listing' || $current_page_url=='products/index' || $current_page_url=='products/add')?'active':'';?>"><div class="pull-left"><i class="zmdi zmdi-apps mr-20"></i><span class="right-nav-text">Products </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="app_dr" class="collapse collapse-level-1">
				<li>
					<a href="<?php echo $base_url.'products/add';?>" class="<?php echo ($current_page_url=='products/add')?'active-page':'';?>">Add Product</a>
				</li>
				<li>
					<a href="<?php echo $base_url.'products/listing';?>" class="<?php echo ($current_page_url=='products/listing')?'active-page':'';?>">Product List</a>
				</li>			
			</ul>
		</li>
		<li>
			<a href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr2" class="<?php echo ($current_page_url=='orders/listing' || $current_page_url=='orders/index' || $current_page_url=='orders/add')?'active':'';?>"><div class="pull-left"><i class="zmdi zmdi-apps mr-20"></i><span class="right-nav-text">Orders </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="app_dr2" class="collapse collapse-level-1">				
				<li>
					<a href="<?php echo $base_url.'orders/add';?>" class="<?php echo ($current_page_url=='orders/add')?'active-page':'';?>">New Order</a>
				</li>
				<li>
					<a href="<?php echo $base_url.'orders/listing';?>" class="<?php echo ($current_page_url=='orders/listing')?'active-page':'';?>">Order List</a>
				</li>			
			</ul>
		</li>
		<li>
			<a href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr3" class="<?php echo ($current_page_url=='consignments/listing' || $current_page_url=='consignments/index' || $current_page_url=='consignments/add')?'active':'';?>"><div class="pull-left"><i class="zmdi zmdi-apps mr-20"></i><span class="right-nav-text">consignments </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="app_dr3" class="collapse collapse-level-1">				
				<li>
					<a href="<?php echo $base_url.'consignments/add';?>" class="<?php echo ($current_page_url=='consignments/add')?'active-page':'';?>">consignments Recieved</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr4" class="<?php echo ($current_page_url=='labels/consignment_label')?'active':'';?>"><div class="pull-left"><i class="zmdi zmdi-apps mr-20"></i><span class="right-nav-text">Label Print </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="app_dr4" class="collapse collapse-level-1">				
				<li>
					<a href="<?php echo $base_url.'labels/consignment_label';?>" class="<?php echo ($current_page_url=='labels/consignment_label')?'active-page':'';?>">Consignment</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr5" class="<?php echo ($current_page_url=='vendors/listing' || $current_page_url=='vendors/index' || $current_page_url=='vendors/add')?'active':'';?>"><div class="pull-left"><i class="zmdi zmdi-apps mr-20"></i><span class="right-nav-text">vendorss </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
			<ul id="app_dr5" class="collapse collapse-level-1">				
				<li>
					<a href="<?php echo $base_url.'vendors/add';?>" class="<?php echo ($current_page_url=='vendors/add')?'active-page':'';?>">Add vendors</a>
				</li>
				<li>
					<a href="<?php echo $base_url.'vendors/listing';?>" class="<?php echo ($current_page_url=='vendors/listing')?'active-page':'';?>">vendors List</a>
				</li>
			</ul>
		</li>
	</ul>
</div>
