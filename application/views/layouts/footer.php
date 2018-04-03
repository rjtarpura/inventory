<!-- JQuery is included in layout.php -->

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $public_assets_url.'vendors/bower_components/bootstrap/dist/js/bootstrap.min.js';?>"></script>

<!-- Toaster -->
<script src="<?php echo $public_assets_url.'vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js';?>"></script>

<!-- Data table JavaScript -->
<script src="<?php echo $public_assets_url.'vendors/bower_components/datatables/media/js/jquery.dataTables.min.js';?>"></script>

<!-- Moment JavaScript -->
<script type="text/javascript" src="<?php echo $public_assets_url.'vendors/bower_components/moment/min/moment-with-locales.min.js';?>"></script>
<!-- Bootstrap Datetimepicker JavaScript -->
<script type="text/javascript" src="<?php echo $public_assets_url.'vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js';?>"></script>

<!-- Select2 JavaScript -->
<script src="<?php echo $public_assets_url.'vendors/bower_components/select2/dist/js/select2.full.min.js';?>"></script>

<!-- Form Wizard JavaScript -->
<script src="<?php echo $public_assets_url.'vendors/bower_components/jquery.steps/build/jquery.steps.min.js';?>"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>


<!-- Slimscroll JavaScript -->
<script src="<?php echo $public_assets_url.'dist/js/jquery.slimscroll.js';?>"></script>

<!-- Owl JavaScript -->
<script src="<?php echo $public_assets_url.'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js';?>"></script>

<!-- Switchery JavaScript -->
<script src="<?php echo $public_assets_url.'vendors/bower_components/switchery/dist/switchery.min.js';?>"></script>

<!-- Fancy Dropdown JS -->
<script src="<?php echo $public_assets_url.'dist/js/dropdown-bootstrap-extended.js';?>"></script>

<!-- Init JavaScript -->
<script src="<?php echo $public_assets_url.'dist/js/init.js';?>"></script>


<script type="text/javascript">
	var settings = <?php echo $js_variables; ?>;
	var allowed = settings.profile_pic_extensions.split("|");

	$(function(){		
		// Custom Validation base on class provided to element
			
			// Capitalize letter entered.
				$('.capitalize').on('keyup', function (e) {
					if (e.which >= 97 && e.which <= 122) {
						var newKey = e.which - 32;
						// I have tried setting those
						e.keyCode = newKey;
						e.charCode = newKey;
					}			
					$(this).val(($(this).val()).toUpperCase());
				});

			// Allows only numbers to be entered
				$('body').on('keypress', ".numberonly", function (key) {		
					if(key.charCode < 48 || key.charCode > 57) return false;			
							//* 42, + 43, - 45, . 46, / 47
							//[0-9] key code [48-57]
							//@64, #35, 
							//[A-Z] key code [65-90]		
							//[a-z] key code [97-122]
				});

			// Setup time to auto hide alert notifications show on success or failure of an action.
				// setTimeout(function() {
				//     $(".alert").fadeTo(500, 0).slideUp(500, function(){
				//         $(this).remove(); 
				//     });
				// }, settings.notification_display_duration_ms);

				$('.theme_chooser').on('change',function(){
					
					var new_value = $(this).val();					
					var reg = $(this).data('pattern');
					var field_name = ($(this).attr('id')=='theme_chooser')?'theme_name':'theme_primary_color';

					$.ajax({
						type	:	"post",
						url		:	"<?php echo $base_url.'settings/ajax_update';?>",
						data	:	{
										"field_name"	: 	field_name,
										"value"			:	new_value
									},
						datatype:	"json",
						success	:	function(result){
							if(result=='true'){								
								var regex = new RegExp(reg);
								
								$('.wrapper').removeClass(function(index,classes){
									// console.log(classes.split(/\s+/));
									return classes.split(/\s+/).filter(function(c) {
								    	return regex.test(c);
								    }).join(' ');
								}).addClass(new_value);
							}
						},
						error	:	function(xmlhttprequers,textStatus,error){
							console.log(xmlhttprequers.responseText);
						},
						complete:	function(){							
						}
					});
				});
				
	});
	function toast(type,heading,message){
		$.toast({
		  	heading: heading,
			text: message,
			position: 'bottom-right',
			loaderBg:'black',
			icon: type,
			hideAfter: settings.notification_display_duration_ms*2, 
			stack: 6
		});
	}
</script>