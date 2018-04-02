<?php
	$method = $this->router->fetch_method();
?>

<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
  <ol class="breadcrumb">
	<li><a href="#">Dashboard</a></li>
	<li><span><?php echo $module;?></span></a></li>
	<?php if($method == 'add'):?>			
		<li><a href="<?php echo $base_url.$module.'/listing'?>">Listing</a></li>
		<li class="active"><span>Add</span></li>
	<?php elseif($method == 'listing'):?>
		<li><a href="<?php echo $base_url.$module.'/add'?>">Add</a></li>
		<li class="active"><span>Listing</span></li>
	<?php endif;?>
  </ol>
</div>
