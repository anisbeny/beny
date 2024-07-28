<?php
/**
 * Fonctions et définitions du thème Beny
 *
 * @package Beny
 */

// Empêcher l'accès direct au fichier
if (!defined('ABSPATH')) {
    exit; // Sortie si accédé directement
}

/**
 * Configuration des fonctionnalités du thème
 */
function beny_supports() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 150,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menus([
        'header' => __('En tête de page', 'beny'),
        'footer' => __('Pied de page', 'beny')
    ]);
}

/**
 * Enregistrement et chargement des assets
 */
function beny_register_assets() {
    $theme_version = wp_get_theme()->get('Version');

    // Styles
    wp_enqueue_style('icones', 'https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css', [], null);
    wp_enqueue_style('archive_css', get_template_directory_uri() . '/assets/css/styles.css', [], $theme_version);
    wp_enqueue_style('main_css', get_template_directory_uri() . '/assets/css/style.css', [], $theme_version);

    // Scripts
    wp_enqueue_script('main_js', get_template_directory_uri() . '/assets/js/script.js', [], $theme_version, true);
    wp_enqueue_script('btnCall_js', get_template_directory_uri() . '/assets/js/call.js', [], $theme_version, true);
}

/**
 * Personnalisation du séparateur de titre
 */
function beny_title_separator() {
    return '|';
}

/**
 * Suppression du tagline du titre du document
 */
function beny_document_title_parts($title) {
    unset($title['tagline']);
    return $title;
}

/**
 * Ajout de classes aux éléments de menu
 */
function beny_menu_class($classes) {
    $classes[] = 'nav-item';
    return $classes;
}

/**
 * Ajout de classe aux liens de menu
 */
function beny_menu_link_class($attrs) {
    $attrs['class'] = isset($attrs['class']) ? $attrs['class'] . ' nav-link' : 'nav-link';
    return $attrs;
}

/**
 * Modification des classes du logo
 */
function beny_logo_class($html) {
    $html = str_replace(['custom-logo', 'custom-logo-link'], 'beny-custom-logo', $html);
    return $html;
}

/**
 * Enregistrement des zones de widgets
 */
function beny_widgets() {
    $footer_widget_areas = [
        'footer_left'   => __('Footer gauche', 'beny'),
        'footer_center' => __('Footer centre', 'beny'),
        'footer_right'  => __('Footer droite', 'beny'),
    ];

    foreach ($footer_widget_areas as $id => $name) {
        register_sidebar([
            'id'            => $id,
            'name'          => $name,
            'description'   => sprintf(__('Cette zone se situe dans le footer (%s)', 'beny'), $name),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ]);
    }
}

// Chargement des fichiers supplémentaires
require_once get_template_directory() . '/include/costomize-theme.php';
require_once get_template_directory() . '/include/projects.php';
// require_once get_template_directory() . '/include/taxonomy.php';

// Hooks
add_action('after_setup_theme', 'beny_supports');
add_action('wp_enqueue_scripts', 'beny_register_assets');
add_action('widgets_init', 'beny_widgets');

add_filter('document_title_separator', 'beny_title_separator');
add_filter('document_title_parts', 'beny_document_title_parts');
add_filter('get_custom_logo', 'beny_logo_class');
add_filter('nav_menu_css_class', 'beny_menu_class');
add_filter('nav_menu_link_attributes', 'beny_menu_link_class');