<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title></title>
	<meta name="description" content="Hound is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Hound Admin, Houndadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework"/>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">	
		@media screen{
			body{
				/*width: 684px;*/
				/*margin:auto;*/
			}
		}		

		.container{
		    width: 100%;
		    margin: 0px;
		    display: flex;		    
		    flex-flow: row wrap;
		}

		/*.item, .item p,img{
			page-break-inside: avoid;
		}*/
		.item{
			margin:2px;
			border: 0.5px dashed gray;
    		border-radius: 4px;
    		text-align: center;
    		height:66px;
		}
		
		p{
			margin:0px;			
			font-family:monospace;
			font-size:7px;
			padding: 0px 1px;
			width:50px;
		}

		img{
			width:48px;
			margin:2px;
			margin-bottom:-4px;
		}

		@media print{
			@page {
			  size: A4;	/*size: 21cm 29.7cm landscape; width height orientation(portrait/landscape)*/
			  /*size: 21cm 29.7cm;*/
			  margin:0px;
			}

			.item{
				page-break-inside: avoid;
			}
			img{
				page-break-inside: avoid;
			}
		}
	</style>
</header>
<body onload="window.print();">
	<div class="container">
		<?php			
			foreach($label_data as $arr){
				echo "<div class=\"item\">";
						echo "<img src=\"".$qr_image_url.$arr['file_name']."\"/>";
						echo "<p>".$arr['sku_id']."</p>";
				echo "</div>";				
			}
		?>				
	</div>
	<!-- <div class="container">
		<div class="row">
			<?php foreach($label_data as $arr){
			  echo "<div class=\"col-xs-2\">";
			  	echo "<img src=\"".$qr_image_url.$arr['file_name']."\"/>";
			  	echo "<p>".$arr['sku_id']."</p>";
			  echo "</div>";
			}?>
		</div>
	</div> -->
</div>		
</body>