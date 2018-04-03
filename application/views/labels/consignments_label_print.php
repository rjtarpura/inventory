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
		@media print{
			@page {
			  size: A4;	/*size: 21cm 29.7cm landscape; width height orientation(portrait/landscape)*/
			}
		}		


	</style>
</header>
<body onload="window.print();">
	<table>
		<?php
		foreach($label_data as $arr){
			// echo "<div style=\"display:flex;\">";
				echo "<div style=\"display:inline-block;margin:auto;\">";
					echo "<img src=\"".$qr_image_url.$arr['file_name']."\" style=\"width:100px;\"/>";
				echo "</div>";
			// echo "</div>";
		} ?>						
	</table>
</body>