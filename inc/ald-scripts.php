<?php 
/*
* Scripts
*/
function ald_scripts(){
	//wp_enqueue_style('ald-stylesheet', plugin_dir_url(__FILE__).'inc/css/asr-main.css',array(),'1.0');	
	wp_enqueue_script('jquery');
}

add_action('init','ald_scripts');

/*
* Admin Scripts 
*/
function ald_admin_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'jquery-form' );
	wp_enqueue_script('bootstrap', plugin_dir_url(__FILE__).'/bootstrap/bootstrap.min.js',array('jquery'));
	
	wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__).'/bootstrap/bootstrap.min.css');
}
add_action( 'admin_init', 'ald_admin_scripts' );

/*
* Custom CSS script
*/
function ald_custom_style(){?>
	<style type="text/css"> 
		<?php 
		if(get_option('ald_load_class') != false){
			echo esc_attr( get_option('ald_load_class') );
		} 
		if(get_option('ald_load_classa') != false){
			echo ','.esc_attr( get_option('ald_load_classa') );
		} 
		if(get_option('ald_load_classb') != false){
			echo ','.esc_attr( get_option('ald_load_classb') );
		} 
		if(get_option('ald_load_classc') != false){
			echo ','.esc_attr( get_option('ald_load_classc') );
		} 
		if(get_option('ald_load_classd') != false){
			echo ','.esc_attr( get_option('ald_load_classd') );
		} 		
		?>{
			display: none;
		}
		<?php if(get_option('ald_css_class') == false){ ?>
		.btn.loadMoreBtn {
			color: #333333;
			text-align: center;
		}

		.btn.loadMoreBtn:hover {
		  text-decoration: none;
		}
		<?php } else{
			echo esc_attr( get_option('ald_css_class') );
		} ?>
	</style>
<?php }

add_action('wp_head','ald_custom_style');

/*
* Admin Scripts for form Design
*/
function ald_admin_style(){?>
	<style type="text/css"> 
		@media(min-width:960px){
			.left-col{			
				width:60%;
			}
			.right-col{			
				width:40%;
			}
			td.right-col{
				vertical-align:top;
			}
		}
		.successModal {
			display: block;
			position: fixed;
			top: 45%;
			left: 25%;
			width: 300px;
			height: auto;
			padding: 5px 20px;
			border: 3px solid green;
			background-color: #EFE;
			z-index:1002;
			overflow: auto;
			-moz-border-radius: 15px; 
			-webkit-border-radius: 15px;
			-moz-box-shadow: 5px 5px 10px #cfcfcf;
			-webkit-box-shadow: 5px 5px 10px #cfcfcf;
			}
		<?php if(get_option('ald_css_class') == false){ ?>
		.btn.loadMoreBtn {
			color: #333333;
			text-align: center;
		}

		.btn.loadMoreBtn:hover {
		  text-decoration: none;
		}
		<?php } else{
			echo esc_attr( get_option('ald_css_class') );
		} ?>
	</style>
<?php }

add_action('admin_head','ald_admin_style');

/*
* Ajax option Saving
*/
function ald_ajax_save_btn(){ ?>
	<?php submit_button(); ?>
	<div id="saveResult"></div>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#ald_option_form').submit(function() {
				jQuery(this).ajaxSubmit({
					success: function() {
						jQuery('#saveResult').html("<div id='saveMessage' class='successModal'></div>");
						jQuery('#saveMessage').append("<p><?php echo htmlentities(__('Settings Saved Successfully','wp'),ENT_QUOTES); ?></p>").show();
					},
					timeout: 5000
				});
				setTimeout("jQuery('#saveMessage').hide('slow');", 5000);
				return false;
			});
		});
	</script>
<?php }

function ald_custom_code(){?>
	<script type="text/javascript"> 
		(function($) {
			'use strict';

			jQuery(document).ready(function( ) {
				
				$("<?php echo esc_attr( get_option('ald_wrapper_class') ); ?>").append('<a href="#" class="btn loadMoreBtn" id="loadMore"><?php echo esc_attr( get_option('ald_load_label') ); ?></a>');
				
				$("<?php echo esc_attr( get_option('ald_load_class') ); ?>").slice(0, <?php echo esc_attr( get_option('ald_item_show') ); ?>).show();
				$("#loadMore").on('click', function (e) {
					e.preventDefault();
					$("<?php echo esc_attr( get_option('ald_load_class') ); ?>:hidden").slice(0, <?php echo esc_attr( get_option('ald_item_load') ); ?>).slideDown();
					if ($("<?php echo esc_attr( get_option('ald_load_class') ); ?>:hidden").length == 0) {
						$("#loadMore").fadeOut('slow');
					}
				});
				// end wrapper 1
				
				<?php if(get_option('ald_wrapper_classa') != false):?>
				//wrapper 2
				$("<?php echo esc_attr( get_option('ald_wrapper_classa') ); ?>").append('<a href="#" class="btn loadMoreBtn" id="loadMorea"><?php echo esc_attr( get_option('ald_load_labela') ); ?></a>');
				
				$("<?php echo esc_attr( get_option('ald_load_classa') ); ?>").slice(0, <?php echo esc_attr( get_option('ald_item_showa') ); ?>).show();
				$("#loadMorea").on('click', function (e) {
					e.preventDefault();
					$("<?php echo esc_attr( get_option('ald_load_classa') ); ?>:hidden").slice(0, <?php echo esc_attr( get_option('ald_item_loada') ); ?>).slideDown();
					if ($("<?php echo esc_attr( get_option('ald_load_classa') ); ?>:hidden").length == 0) {
						$("#loadMorea").fadeOut('slow');
					}
				});
				// end wrapper 2
				<?php endif;?>
				
				<?php if(get_option('ald_wrapper_classb') != false):?>
				// wrapper 3 
				$("<?php echo esc_attr( get_option('ald_wrapper_classb') ); ?>").append('<a href="#" class="btn loadMoreBtn" id="loadMoreb"><?php echo esc_attr( get_option('ald_load_labelb') ); ?></a>');
				
				$("<?php echo esc_attr( get_option('ald_load_classb') ); ?>").slice(0, <?php echo esc_attr( get_option('ald_item_showb') ); ?>).show();
				$("#loadMoreb").on('click', function (e) {
					e.preventDefault();
					$("<?php echo esc_attr( get_option('ald_load_classb') ); ?>:hidden").slice(0, <?php echo esc_attr( get_option('ald_item_loadb') ); ?>).slideDown();
					if ($("<?php echo esc_attr( get_option('ald_load_classb') ); ?>:hidden").length == 0) {
						$("#loadMoreb").fadeOut('slow');
					}
				});
				// end wrapper 3
				<?php endif;?>
				
				<?php if(get_option('ald_wrapper_classc') != false):?>
				//wraper 4
				$("<?php echo esc_attr( get_option('ald_wrapper_classc') ); ?>").append('<a href="#" class="btn loadMoreBtn" id="loadMorec"><?php echo esc_attr( get_option('ald_load_labelc') ); ?></a>');
				
				$("<?php echo esc_attr( get_option('ald_load_classc') ); ?>").slice(0, <?php echo esc_attr( get_option('ald_item_showc') ); ?>).show();
				$("#loadMorec").on('click', function (e) {
					e.preventDefault();
					$("<?php echo esc_attr( get_option('ald_load_classc') ); ?>:hidden").slice(0, <?php echo esc_attr( get_option('ald_item_loadc') ); ?>).slideDown();
					if ($("<?php echo esc_attr( get_option('ald_load_classc') ); ?>:hidden").length == 0) {
						$("#loadMorec").fadeOut('slow');
					}
				});
				// end wrapper 4
				<?php endif;?>
				
				<?php if(get_option('ald_wrapper_classd') != false):?>
				//wrapper 5
				$("<?php echo esc_attr( get_option('ald_wrapper_classd') ); ?>").append('<a href="#" class="btn loadMoreBtn" id="loadMored"><?php echo esc_attr( get_option('ald_load_labeld') ); ?></a>');
				
				$("<?php echo esc_attr( get_option('ald_load_classd') ); ?>").slice(0, <?php echo esc_attr( get_option('ald_item_showd') ); ?>).show();
				$("#loadMored").on('click', function (e) {
					e.preventDefault();
					$("<?php echo esc_attr( get_option('ald_load_classd') ); ?>:hidden").slice(0, <?php echo esc_attr( get_option('ald_item_loadd') ); ?>).slideDown();
					if ($("<?php echo esc_attr( get_option('ald_load_classd') ); ?>:hidden").length == 0) {
						$("#loadMored").fadeOut('slow');
					}
				});
				// end wrapper 5
				<?php endif;?>

			});

		})(jQuery);
	</script>
<?php }

add_action('wp_footer','ald_custom_code');
