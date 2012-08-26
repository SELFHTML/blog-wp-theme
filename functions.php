<?php


remove_action( 'wp_head', 'waipoua_print_navibg_color_style' );


/* --------------------------------------------------------------------------------------------------------------------
   wp-admin config
-------------------------------------------------------------------------------------------------------------------- */

// set textdomain
load_theme_textdomain('selfhtml');


// remove the admin bar from the front end
add_filter( 'show_admin_bar', '__return_false' );


// disable visual editor
add_filter( 'user_can_richedit' , create_function('' , 'return false;') , 50 );


// profile pages: customize contact info fields
function customize_contact_info_fields( $contactmethods ) {
    $contactmethods['twitter'] = 'Twitter'; // add Twitter
    unset($contactmethods['yim']); // remove Yahoo IM
    unset($contactmethods['aim']); // remove AIM
    unset($contactmethods['jabber']); // remove Jabber
    return $contactmethods;
}
add_filter( 'user_contactmethods', 'customize_contact_info_fields', 10, 1 );


// customize dashboard widgets
function customize_dashboard_widgets() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' ); // incoming links
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' ); // plugins
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // quick press
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // wordpress blog
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' ); // other news
} 
add_action('wp_dashboard_setup', 'customize_dashboard_widgets' );


// hide welcome panel
function hide_welcome_panel() {
	update_user_meta( get_current_user_id(), 'show_welcome_panel', 0 );
}
add_action( 'load-index.php', 'hide_welcome_panel' );


// remove meta boxes from posts and pages
function customize_meta_boxes() {

    // posts
    remove_meta_box('slugdiv', 'post', 'normal');
    remove_meta_box('trackbacksdiv', 'post', 'normal');
    remove_meta_box('postcustom', 'post', 'normal');
    remove_meta_box('commentsdiv', 'post', 'normal');
    remove_meta_box('sqpt-meta-tags', 'post', 'normal');
    #remove_meta_box('postexcerpt', 'post', 'normal');
    #remove_meta_box('commentstatusdiv', 'post', 'normal');
    #remove_meta_box('revisionsdiv', 'post', 'normal');
    #remove_meta_box('authordiv', 'post', 'normal');

    // pages
    remove_meta_box('slugdiv', 'page', 'normal');
    remove_meta_box('trackbacksdiv', 'page', 'normal');
    remove_meta_box('postcustom', 'page', 'normal');
    remove_meta_box('commentsdiv', 'page', 'normal');
    remove_meta_box('sqpt-meta-tags', 'page', 'normal');
    #remove_meta_box('postexcerpt', 'page', 'normal');
    #remove_meta_box('commentstatusdiv', 'page', 'normal');
    #remove_meta_box('revisionsdiv', 'page', 'normal');
    #remove_meta_box('authordiv', 'page', 'normal');

    // links
    remove_meta_box('linktargetdiv', 'link', 'normal');
    remove_meta_box('linkxfndiv', 'link', 'normal');
    remove_meta_box('linkadvanceddiv', 'link', 'normal');
}
add_action( 'admin_init', 'customize_meta_boxes' );


/* --------------------------------------------------------------------------------------------------------------------
   template
-------------------------------------------------------------------------------------------------------------------- */

// load script ressources
if (!function_exists('loadScriptRessources')) {
	function loadScriptRessources() {

		// selfhtml.js
		wp_register_script('selfhtml', get_bloginfo('stylesheet_directory').'/js/selfhtml.js', array('jquery'), false, true);
		wp_enqueue_script('selfhtml');


        // twitter
		wp_register_script('twitter', 'http://twitter.com/statuses/user_timeline/selfhtml.json?callback=twitterCallback2&count=3', array('jquery'), false, true);
		wp_enqueue_script('twitter');

	}
}
add_action('wp_enqueue_scripts', 'loadScriptRessources');


/* --------------------------------------------------------------------------------------------------------------------
   SELFHTML
-------------------------------------------------------------------------------------------------------------------- */

// add SELFHTML widgets to dashboard
function selfhtml_author_widget() {
    // author widget content
    echo '
        <p>TO-DO</p>
';
}
function selfhtml_admin_widget() {
    // admin widget content
    echo '
        <p>TO-DO</p>
';
}
function add_selfhtml_widgets() {
    add_meta_box( 'selfhtml_author_widget', 'SELFHTML: Information für Redakteure', 'selfhtml_author_widget', 'dashboard', 'side', 'high' );
    if(current_user_can('administrator')) {
        add_meta_box( 'selfhtml_admin_widget', 'SELFHTML: Information für Administratoren', 'selfhtml_author_widget', 'dashboard', 'side', 'high' );
    }
}
add_action( 'wp_dashboard_setup', 'add_selfhtml_widgets' );



