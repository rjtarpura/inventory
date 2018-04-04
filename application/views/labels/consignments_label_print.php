<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title></title>
	<meta name="description" content="Hound is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Hound Admin, Houndadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework"/>
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

		.item{
			display:block;			
			margin:2px;
			border: 0.5px dashed gray;
    		border-radius: 4px;
    		text-align: center;
    		height:66px;
    		page-break-inside: avoid!important;
		}
		
		p{
			margin:0px;			
			font-family:monospace;
			font-size:7px;
			padding: 0px 1px;
			width:50px;
			page-break-inside: avoid!important;
		}

		img{
			width:48px;
			margin:2px;
			margin-bottom:-4px;
			page-break-inside: avoid!important;
		}

		.page_break{
				page-break-after: always!important;
			}

		@media print{
			@page {
			  size: A4;	/*size: 21cm 29.7cm landscape; width height orientation(portrait/landscape)*/
			  /*size: 21cm 29.7cm;*/
			  margin:0px;
			}

			.item{
				page-break-inside: avoid!important;
				border: 0.5px dashed gray;				
			}
			.page_break{
				page-break-after: always!important;
			}
		}

	</style>
</header>
<body onload="window.print();">
	<div class="container">
		<?php
			$item_w = 56.4;$item_h=70.4;$item_margin=4;

			$item_w_counter = 0;$item_h_counter=0;

			$counter = 0;
			foreach($label_data as $arr){
				// $item_w_counter = $item_w_counter+$item_w+$item_margin;
				// if($item_w_counter >= ())
				$counter++;
				echo "<div class=\"item\">";
						echo "<img src=\"".$qr_image_url.$arr['file_name']."\"/>";
						echo "<p>".$arr['sku_id']."</p>";
				echo "</div>";
				if($counter%195==0){
					echo "<div class=\"page_break\"></div>";
				}
			}
		?>				
	</div>		
</body>