<?php
/* Plugin Name: NyanPress
 * Plugin URI: http://www.boiteaweb.fr/nyanpress
 * Description: NYAN CAT YOUR WORDPRESS!!
 * Version: 1.0
 * Author: Juliobox
 * Author URI: http://www.boiteaweb.fr
 * License: GPLv2
**/
if( is_admin() ):
DEFINE( 'NYAN_IMAGES_URL', trailingslashit( WP_PLUGIN_URL ) . basename( dirname( __FILE__ ) ) . '/images/' );
function add_nyan_css()
{ 
global $pagenow;
$pagesnow = array( 'index.php', 'edit.php', 'post-new.php', 'edit-tags.php', 'link-manager.php', 'link-add.php', 'edit-comments.php', 'widgets.php', 'nav-menus.php', 'theme-editor.php', 'plugins.php', 'plugin-editor.php', 'users.php' );
?>
<style>
<?php if( in_array( $pagenow, $pagesnow ) ) { ?>
#wpwrap{background: url("<?php echo NYAN_IMAGES_URL; ?>nyan_bg.gif") repeat scroll 0 0 transparent !important;}
.subsubsub a, div.form-field p, div.form-required p{color:cyan !important;}
.form-wrap h3{color:#FFFFFF !important;}
.subsubsub a.current{color:#FFFFFF !important;}
form label{color:#FFFFFF !important;}
<?php } ?>
li#wp-admin-bar-site-name a:after{content:' Nyan';}
li#wp-admin-bar-my-account{ background:url("<?php echo NYAN_IMAGES_URL; ?>mini_avatar.gif") no-repeat right center transparent !important;padding-right:14px !important;margin-right:5px !important; }
img.photo{display:none !important;}
span.display-name:after{content:' Nyan';}
ul#wp-admin-bar-user-actions{background: url("<?php echo NYAN_IMAGES_URL; ?>big_avatar.png") no-repeat scroll 10px 10px transparent !important;}
li#wp-admin-bar-user-info img{display:none !important;}
form#adv-settings label{color:#000000 !important;}
*{font-family:Comic Sans MS !important; }
#wpadminbar .ab-icon { height: 22px !important; margin-top: 4px !important; width: 50px !important; }
#wp-admin-bar-wp-logo > .ab-item .ab-icon { width: 50px !important; }
div.wp-menu-image{background: url("<?php echo NYAN_IMAGES_URL; ?>menu_icon.gif") no-repeat scroll 3px 5px transparent !important;}
div.icon32{ background: url("<?php echo NYAN_IMAGES_URL; ?>icon32.png") no-repeat scroll 0 0 transparent!important;}
span.ab-icon{ background: url("<?php echo NYAN_IMAGES_URL; ?>icon_trail.gif") no-repeat scroll 0 0 transparent!important;}
body, *{cursor: url("<?php echo NYAN_IMAGES_URL; ?>cursor.gif"), pointer !important;}
.wrap h2{color:#FFFFFF !important;}
.menu-icon-dashboard { background-color:#ff2820 !important; color:#ffffff !important;}
.menu-icon-post { background-color:#ff862d !important; color:#ffffff !important;}
.menu-icon-media { background-color:#ffff00 !important; color:#000000 !important;}
.menu-icon-links { background-color:#3ce620 !important; color:#ffffff !important;}
.menu-icon-page { background-color:#08c2ff !important; color:#ffffff !important;}
.menu-icon-comments { background-color:#4575fb !important; color:#ffffff !important;}
.menu-icon-appearance { background-color:#7d00ff !important; color:#ffffff !important;}
.menu-icon-plugins { background-color:#ef2fed !important; color:#ffffff !important;}
.menu-icon-users { background-color:#c7131b !important; color:#ffffff !important;}
.menu-icon-tools { background-color:#c4e028 !important; color:#ffffff !important;}
.menu-icon-settings { background-color:#e09d28 !important; color:#ffffff !important;}
</style>
<script>
<!--
var trailLength = 10
var path = "<?php echo NYAN_IMAGES_URL; ?>nyan-trail.png" 

var standardbody=(document.compatMode=="CSS1Compat")? document.documentElement : document.body
var i,d = 0

function initTrail() { 
	images = new Array() 
	for (i = 0; i < parseInt(trailLength); i++) {
		images[i] = new Image()
		images[i].src = path
	}
	storage = new Array() 
	for (i = 0; i < images.length*3; i++) {
		storage[i] = 0;
	}
	for (i = 0; i < images.length; i++) { 
		document.write('<div id="obj' + i + '" style="position: absolute; z-Index: 100; height: 0; width: 0"><img src="' + images[i].src + '"></div>')
	}
	trail()
}
function trail() { 
	for (i = 0; i < images.length; i++) { 
		document.getElementById("obj" + i).style.top = storage[d]+'px' 
		document.getElementById("obj" + i).style.left = + storage[d+1]+'px' /
		d = d+2
	}
	for (i = storage.length; i >= 2; i--) { 
		storage[i] = storage[i-2]
	}
	d = 0;
}
setInterval( 'trail()', 10 );
function processEvent(e) { 
	if (window.event) { 
		storage[0] = window.event.y+standardbody.scrollTop+3
		storage[1] = window.event.x+standardbody.scrollLeft-14
	} else {
		storage[0] = e.pageY+5
		storage[1] = e.pageX-16
	}
}

	initTrail() 
	document.onmousemove = processEvent

//-->
</script>
<?php
}
add_action( 'admin_head', 'add_nyan_css', 999 );

function nyanboard_widgets()
{
	wp_add_dashboard_widget('nyanboard_widget', 'Nyan Press', 'nyanboard_widget');
}

function nyanboard_widget()
{
?>
<embed src="http://www.youtube-nocookie.com/v/48BRDNYN2H8?version=3&amp;hl=en_US&amp;rel=0&amp;autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="420" height="315"></embed>
<?php
}
add_action('wp_dashboard_setup', 'nyanboard_widgets');

function nyan_footertext( $ft )
{
	return str_replace( '<a href="http://wordpress.org/">WordPress</a>', '<a href="http://baw.li/nyanpress">NyanPress</a>', __( 'Thank you for creating with <a href="http://wordpress.org/">WordPress</a>.' ) );
}
add_action( 'admin_footer_text', 'nyan_footertext', 999 );

function good_bye_howdy( $wp_admin_bar ) // http://www.geekpress.fr/wordpress/tutoriel/modifier-howdy-admin-bar-1102/
{
	global $current_user;
	$my_account = $wp_admin_bar->get_node('my-account');
	$howdy = sprintf( __( 'Howdy, %1$s' ), $current_user->display_name );
	$title = str_replace( $howdy, 'Nyan Nyan, ' . $current_user->display_name, $my_account->title );
	$wp_admin_bar->add_node( array(
		'id' => 'my-account',
		'title' => $title
	) );
}
add_filter( 'admin_bar_menu', 'good_bye_howdy' );

function nyanboard_title()
{
	global $menu;
	$menu[2][0] = 'Nyanboard';
	return $menu;
}
add_action( 'admin_menu', 'nyanboard_title' );
endif;
?>
