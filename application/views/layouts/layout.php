<?php
$flashdata="";
if($fd = $this->session->flashdata('success')){
    $flashdata  = "<div class='alert alert-success alert-dismissable alert-style-1' style='background-color:#01c853;color:#fff;'>";
    $flashdata  .=  "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    $flashdata  .=  "<i class='zmdi zmdi-check' style='color:inherit;background-color:#01c853;'></i>";
    $flashdata  .=  $fd;
    $flashdata  .=  "</div>";
  }elseif($fd = $this->session->flashdata('error')){
    $flashdata  = "<div class='alert alert-danger alert-dismissable alert-style-1' style='background-color:#ff2a00;color:#fff;'>";
    $flashdata  .=  "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    $flashdata  .=  "<i class='zmdi zmdi-block' style='color:inherit;background-color:#ff2a00;'></i>";
    $flashdata  .=  $fd;
    $flashdata  .=  "</div>";
  }elseif($fd = $this->session->flashdata('fileerror')){
    $flashdata  = "<div class='alert alert-warning alert-dismissable alert-style-1' style='background-color:#fec107;color:#fff;'>";
    $flashdata  .=  "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    $flashdata  .=  "<i class='zmdi zmdi-alert-circle-o' style='color:inherit;background-color:#fec107;'></i>";
    $flashdata  .=  "Following errors are related to uploaded files: <br/><ul>";
    foreach($fd as $name=>$error){
      $flashdata    .=  "<li>$name - $error</li>";
    }
    $flashdata  .=  "</ul></div>";
  }
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<?php $this->load->view('layouts/header.php'); ?>
		<?php $this->load->view('layouts/custom.css'); ?>
	</head>

	<body>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->

	    <div class="wrapper <?php echo $current_theme,' ',$current_theme_primary_color;?>">	<!-- slide-nav-toggle -->
			<!-- Top Menu Items -->
				<?php $this->load->view('layouts/nav_bar.php'); ?>
			<!-- /Top Menu Items -->

			<!-- Right Sidebar Menu -->
				<?php $this->load->view('layouts/side_bar_right.php'); ?>
			<!-- /Right Sidebar Menu -->

			<!-- Left Sidebar Menu -->
				<?php $this->load->view('layouts/side_bar_left.php'); ?>
			<!-- /Left Sidebar Menu -->

			<!-- Main Content -->
				<div class="page-wrapper">
					<div class="container-fluid">
						<!-- Title -->							
							<div class="row heading-bg">
								<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
								  <h5 class="txt-dark"><?php echo $module; ?></h5>
								</div>

								<!-- Breadcrumb -->
								<?php if(file_exists(VIEWPATH.$module.'/bread_comb.php')){
									$this->load->view("$module/bread_comb");
								}?>
								<!-- /Breadcrumb -->
								
							</div>
						<!-- /Title -->

						<?php if($flashdata): ?>
								<div class="row">
									<div class="col-xs-12">
										<?php echo $flashdata; ?>
									</div>
								</div>
						<?php endif; ?>

						<!-- jQuery -->
						<script src="<?php echo $public_assets_url.'vendors/bower_components/jquery/dist/jquery.min.js';?>"></script>

						<!-- PAGE CONTENT START -->
							<?php $this->load->view($sub_view); ?>
						<!-- PAGE CONTENT END -->

					</div>

					<!-- Footer -->
						<footer class="footer container-fluid pl-30 pr-30">
							<div class="row">
								<div class="col-sm-12">
									<p style="text-align: right;">
										<?php echo date('Y'); ?> &copy; Inventory. Pampered by LetsEnkindle
									</p>
								</div>
							</div>
						</footer>
					<!-- /Footer -->
				</div>
			<!-- /Main Content -->
		</div>

		<!-- JavaScript -->
		<?php $this->load->view('layouts/footer.php'); ?>
	</body>
</html>