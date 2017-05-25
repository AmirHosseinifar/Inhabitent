<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package RED_Starter_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function red_starter_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'red_starter_body_classes' );
// Remove "Editor" links from sub-menus
function inhabitent_remove_submenus() {
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
}
add_action( 'admin_menu', 'inhabitent_remove_submenus', 110 );

function inhabitent_login_log(){
	echo '<style type="text/css">

	#login h1 a {
		background: url('. get_stylesheet_directory_uri(). '/images/inhabitent-logo-text-dark.svg) no-repeat !important;
		background-size: 300px 53px !important; 
		width: 300px !important; 
		height: 53px !important;
		}
		#login .button.button-primary {
			background-color: #248A83;
			}
	</style>';
}
add_action( 'login_head','inhabitent_login_log' );

function inhabitent_login_log_url( $url ) {
 return home_url();
}
add_filter( 'login_headerurl', 'inhabitent_login_log_url' );

/** 
* Customize the title attribute for the login logo link.
*
* @return string
*/
function inhabitent_login_title() {
	return 'Inhabitent';
}
add_filter( 'login_headertitle', 'inhabitent_login_title');

function hwl_home_pagesize( $query ) {
    if ( is_post_type_archive( 'product' ) && !is_admin() && $query->is_main_query() ) {
        // Display 50 posts for a custom post type called 'movie'
        $query->set( 'posts_per_page', 16 );
				$query->set( 'orderby', 'title');
				$query->set( 'order', 'ASC' );
        
    }
}
add_action( 'pre_get_posts', 'hwl_home_pagesize', 1 );