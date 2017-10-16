<?php 
/*
Plugin Name:  Ajax Load More Anything
Plugin URI:   http://asrcoder.com
Author:       Akhtarujjaman Shuvo
Author URI:   http://fb.com/suvobd.ml
Version: 	  1.0
Description:  A simple plugin that help you to Load more any item with Ajax. You can use Ajaxify Load More button for your blog post, Comments, page, Category, Recent Posts, Sidebar widget Data, Woocommerce Product, Images, Photos, Videos, custom Div or whatever you want.
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  asr_td
Domain Path:  /languages

ASR Google Map is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
ASR Google Map is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with ASR Google Map. If not, see https://www.gnu.org/licenses/gpl-2.0.html.

*/


/**
* Get Scripts files 
**/
require_once('inc/ald-scripts.php');

/**
* Add Setting Page Submenu
*/
function ald_add_submenu_page() {
	add_submenu_page( 
		'options-general.php', 
		'Ajax Load More Settings page by ASRCODER™', 
		'Ajax Load More', 
		'manage_options', 
		'ald_setting', 
		'ald_settings_callback' 
	);
}
add_action( 'admin_menu', 'ald_add_submenu_page' );

/**
* Design Setting Page
**/

function ald_settings_callback(){ ?>
<div class="wrap">
<h1>Ajax Load More Anyting by ASRCODER™</h1>

<form method="post" action="options.php" id="ald_option_form">
    <?php settings_fields( 'ald-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'ald-plugin-settings-group' ); ?>

	<table class="form-table">
		<tr>
			<td class="left-col">
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Load More Button Wrapper</th>
						<td>
							<input class="regular-text" type="text" name="ald_wrapper_class" value="<?php echo esc_attr( get_option('ald_wrapper_class') ); ?>" />
							<p>Load More Button will show inside End of this Div</p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Load More Div</th>
						<td>
							<input class="regular-text" type="text" name="ald_load_class" value="<?php echo esc_attr( get_option('ald_load_class') ); ?>" />
							<p>Which Div,class,ID you want to Ajaxing?</p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Visiable Items</th>
						<td>
							<input class="regular-text" type="number" name="ald_item_show" value="<?php echo esc_attr( get_option('ald_item_show') ); ?>" />
							<p>How Many Item Will Show Before Load Items?</p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Load Items</th>
						<td>
							<input class="regular-text" type="number" name="ald_item_load" value="<?php echo esc_attr( get_option('ald_item_load') ); ?>" />
							<p>How Many Item Will Load When Click Load More Button?</p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Load More Button Label</th>
						<td>
							<input class="regular-text" type="text" name="ald_load_label" value="<?php echo esc_attr( get_option('ald_load_label') ); ?>" />
							<p>Enter The Name of Load More Button</p>
						</td>
					</tr>
				</table>
			</td>
			<td class="right-col">
				<h2>Custom CSS</h2>
				<pre><textarea style="width:100%" name="ald_css_class" id="" rows="10"><?php if(empty(get_option('ald_css_class'))){echo ".btn.loadMoreBtn {
    color: #333333;
    text-align: center;
}

.btn.loadMoreBtn:hover {
    text-decoration: none;
}";}else {echo esc_attr( get_option('ald_css_class') ); } ?></textarea></pre>
			</td>
		</tr>
	</table>
	
    <?php ald_ajax_save_btn(); ?>
	
</form>
</div>

<?php }

/*
* Register settings fields to database
*/
function register_ald_plugin_settings() {	
	register_setting( 'ald-plugin-settings-group', 'ald_wrapper_class' );
	register_setting( 'ald-plugin-settings-group', 'ald_load_class' );
	register_setting( 'ald-plugin-settings-group', 'ald_item_show' );
	register_setting( 'ald-plugin-settings-group', 'ald_item_load' );
	register_setting( 'ald-plugin-settings-group', 'ald_load_label' );
	register_setting( 'ald-plugin-settings-group', 'ald_css_class' );	
}
add_action( 'admin_init', 'register_ald_plugin_settings' );