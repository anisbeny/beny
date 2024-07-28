<?php
function beny_supports(){

    add_theme_support( 'title-tag' );
    add_theme_support(
    	'custom-logo',
				[
					'height'      => 100,
					'width'       => 150,
					'flex-height' => true,
					'flex-width'  => true,
				]
    );
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête de page');
    register_nav_menu('footer', 'Pied de page');
}

function beny_register_assets(){
    wp_register_style('icones', 'https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css');
    wp_register_style('archive_css', get_template_directory_uri() . '/assets/css/styles.css');
    wp_register_style('main_css', get_template_directory_uri() . '/assets/css/style.css');
    wp_register_script('main_js', get_template_directory_uri() .'/assets/js/script.js', [], false, true);
    wp_register_script('btnCall_js', get_template_directory_uri() .'/assets/js/call.js', [], false, true);
     wp_enqueue_style('icones');
    wp_enqueue_style('main_css');
    wp_enqueue_style('archive_css');
    wp_enqueue_script('main_js');
    wp_enqueue_script('btnCall_js');

}
function beny_title_separator (){
    return '|';
}
function beny_document_title_parts($title){
   unset($title['tagline']);
   return $title;
}
function beny_menu_class($classes)
{
    $classes[] ='nav-item';
    return $classes;
}
function beny_menu_link_class($attrs)
{
    $attrs['class']= 'nav-link';
    return $attrs;
}
//Ajouter une classe au logo
function beny_logo_class( $html ) {

    $html = str_replace( 'custom-logo', 'beny-custom-log', $html );
    $html = str_replace( 'custom-logo-link', 'beny-custom-log', $html );

    return $html;
}
function beny_widgets(){

    register_sidebar([
        'id' => 'footer_left',
        'name' => 'Footer gauche',
        'description' => 'Cette zone se situe dans le footer à gauche',
        'before_widget' => '<aside>',
        'after_widget' => '</aside>',
        'before_title' => '<h1>',
        'after_title' => '</h1>'
    ]);
    register_sidebar([
        'id' => 'footer_center',
        'name' => 'Footer centre',
        'description' => 'Cette zone se situe dans le footer au centre',
        'before_widget' => '<aside>',
        'after_widget' => '</aside>',
        'before_title' => '<h1>',
        'after_title' => '</h1>'
    ]);
    register_sidebar([
        'id' => 'footer_right',
        'name' => 'Footer droite',
        'description' => 'Cette zone se situe dans le footer à droite',
        'before_widget' => '<aside>',
        'after_widget' => '</aside>',
        'before_title' => '<h1>',
        'after_title' => '</h1>'
    ]);

}
/* Personnalisation du thème */
require_once get_template_directory() . '/include/costomize-theme.php';



// Type de contenu personnalisé "chantiers"
require_once get_template_directory() . '/include/projects.php';

//Déclarer une taxonomie
// require_once get_template_directory() . '/include/taxonomy.php';


add_action('after_setup_theme', 'beny_supports');
add_action('wp_enqueue_scripts', 'beny_register_assets');
add_action('widgets_init', 'beny_widgets');

add_filter('document_title_separator', 'beny_title_separator');
add_filter('document_title_parts', 'beny_document_title_parts');
add_filter( 'get_custom_logo', 'beny_logo_class' );
add_filter('nav_menu_css_class', 'beny_menu_class');
add_filter('nav_menu_link_attributes', 'beny_menu_link_class');