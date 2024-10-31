<?php
/*
Plugin Name: QQ Yun IME
Plugin URI: http://codecto.com/projects/wordpress-qq-yun-ime-plugin/
Description: 为你的 WordPress 添加 QQ 云输入法
Author: CantonBolo
Author URI: http://codecto.com/
Version: 1.1
*/

include_once('core.php');

function register_qq_yun_ime_admin_menu(){
	add_dashboard_page('QQ 云输入法设置', 'QQ 云输入法设置', 'manage_options', 'qq_yun_ime', 'qq_yun_ime_options');
	//add_submenu_page('index.php', 'QQ 云输入法设置', 'QQ 云输入法设置', 'manage_options', 'qq_yun_ime', 'qq_yun_ime_options');
	add_action( 'admin_init', 'register_qym_settings' );
}
add_action('admin_menu','register_qq_yun_ime_admin_menu');

function register_qym_settings() {
	register_setting( 'qq-yun-ime-settings', 'qq_yun_ime_method' );
	register_setting( 'qq-yun-ime-settings', 'qq_yun_ime_char' );
	register_setting( 'qq-yun-ime-settings', 'qq_yun_ime_front' );
}

function qq_yun_ime_options(){
?>
<form method="post" action="options.php">
<div class="wrap">
<h2>QQ 云输入法设置</h2>
<?php settings_fields( 'qq-yun-ime-settings' ); ?>
<table class="form-table">
	<tr>
		<th scope="row">输入方式</th>
		<td>
			<label for="qym_en"><input id="qym_en" name="qq_yun_ime_method" type="radio" value="en" <?php if(get_option('qq_yun_ime_method') == 'en') { echo 'checked="checked"';} ?> />英语</label>
			<label for="qym_wb"><input id="qym_wb" name="qq_yun_ime_method" type="radio" value="wb" <?php if(get_option('qq_yun_ime_method') == 'wb') { echo 'checked="checked"';} ?> />五笔</label>
			<label for="qym_py"><input id="qym_py" name="qq_yun_ime_method" type="radio" value="py" <?php if(get_option('qq_yun_ime_method') == 'py') { echo 'checked="checked"';} ?> />拼音</label>
		</td>
	</tr>
	<tr>
		<th scope="row">输入字形</th>
		<td>
			<label for="qym_s"><input id="qym_s" name="qq_yun_ime_char" type="radio" value="s" <?php if(get_option('qq_yun_ime_char') == 's') { echo 'checked="checked"';} ?> />简体</label>
			<label for="qym_t"><input id="qym_t" name="qq_yun_ime_char" type="radio" value="t" <?php if(get_option('qq_yun_ime_char') == 't') { echo 'checked="checked"';} ?> />繁体</label>
		</td>
	</tr>
	<tr>
		<th scope="row">附加设置</th>
		<td>
			<label for="qym_front"><input id="qym_front" name="qq_yun_ime_front" type="checkbox" <?php if(get_option('qq_yun_ime_front')) { echo 'checked="checked"';} ?> />在评论区域加上云输入法按钮</label>
		</td>
	</tr>
</table>
<p class="submit">
<input type="submit" class="button-primary" value="保存更改" />
</p>
</div>
</form>
<?php
}

register_activation_hook(__FILE__,'qym_install');
function qym_install() {
	if(!get_option('qq_yun_ime_method')){
		update_option('qq_yun_ime_method', 'py');
	}
	if(!get_option('qq_yun_ime_char')){
		update_option('qq_yun_ime_char', 's');
	}
	if(!get_option('qq_yun_ime_front')){
		update_option('qq_yun_ime_front', '0');
	}
}

if(get_option('qq_yun_ime_front')) {
	add_action('wp_head', 'qyime_style');
}
add_action('admin_head', 'qyime_style');
function qyime_style () {
	echo '<link rel="stylesheet" media="all" type="text/css" href="'.WP_PLUGIN_URL.'/qq-yun-ime/style.css" />';
}

?>