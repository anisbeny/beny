<?php
function beny_personnalisation(WP_Customize_Manager $wp_customize)
{
    // Section Affichage
    $wp_customize->add_section('beny_affichage', [
        'title' => 'Affichage',
        'priority' => 100,
        'capability' => 'edit_theme_options',
        'description' => 'Cette section comporte les contrôles de gestion de l\'affichage des informations'
    ]);

    // Paramètre et contrôle pour masquer l'auteur
    $wp_customize->add_setting('hide_author', ['default' => false]);
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'hide_author_control', [
        'label' => 'Masquer l\'auteur',
        'section' => 'beny_affichage',
        'settings' => 'hide_author',
        'type' => 'checkbox'
    ]));

    // Paramètre et contrôle pour afficher le titre de la page
    $wp_customize->add_setting('show_page_title', ['default' => true]);
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'show_page_title_control', [
        'label' => 'Afficher le titre de la page',
        'section' => 'beny_affichage',
        'settings' => 'show_page_title',
        'type' => 'checkbox'
    ]));

    // Section Couleurs
    $wp_customize->add_section('beny_colors', [
        'title' => 'Couleurs',
        'priority' => 101,
        'description' => 'Cette section permet de paramétrer les couleurs globales du site'
    ]);

    // Paramètre et contrôle pour la couleur des titres
    $wp_customize->add_setting('title_color', ['default' => '#000000']);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'title_color_control', [
        'label' => 'Couleur des titres',
        'section' => 'beny_colors',
        'settings' => 'title_color'
    ]));

    // Paramètre et contrôle pour la couleur de fond
    $wp_customize->add_setting('background_color', ['default' => '#ffffff']);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color_control', [
        'label' => 'Couleur de fond',
        'section' => 'beny_colors',
        'settings' => 'background_color'
    ]));

    // Section Polices
    $wp_customize->add_section('beny_polices', [
        'title' => 'Polices',
        'priority' => 102,
        'description' => 'Cette section permet de paramétrer les polices'
    ]);

    // Paramètre et contrôle pour la police de texte
    $wp_customize->add_setting('text_font', ['default' => 'Montserrat']);
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'text_font_control', [
        'label' => 'Police des textes',
        'section' => 'beny_polices',
        'settings' => 'text_font',
        'type' => 'select',
        'choices' => [
            'Italiana' => 'Italiana',
            'Lato' => 'Lato',
            'Lobster' => 'Lobster',
            'Roboto' => 'Roboto',
            'Poppins' => 'Poppins',
            'Montserrat' => 'Montserrat'
        ]
    ]));

    // Section Layout
    $wp_customize->add_section('beny_layout', [
        'title' => 'Layout',
        'priority' => 103,
        'description' => 'Cette section permet de paramétrer les layouts des pages et articles'
    ]);

    // Paramètre et contrôle pour le layout des pages
    $wp_customize->add_setting('page_layout', ['default' => 'full-width']);
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'page_layout_control', [
        'label' => 'Layout des pages',
        'section' => 'beny_layout',
        'settings' => 'page_layout',
        'type' => 'select',
        'choices' => [
            'full-width' => 'Pleine largeur',
            'sidebar-left' => 'Barre latérale gauche',
            'sidebar-right' => 'Barre latérale droite'
        ]
    ]));

    // Paramètre et contrôle pour le layout des articles
    $wp_customize->add_setting('post_layout', ['default' => 'full-width']);
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'post_layout_control', [
        'label' => 'Layout des articles',
        'section' => 'beny_layout',
        'settings' => 'post_layout',
        'type' => 'select',
        'choices' => [
            'full-width' => 'Pleine largeur',
            'sidebar-left' => 'Barre latérale gauche',
            'sidebar-right' => 'Barre latérale droite'
        ]
    ]));
}
add_action('customize_register', 'beny_personnalisation');

function beny_css_dynamique()
{
    $police = get_theme_mod('text_font', 'Montserrat');
    $title_color = get_theme_mod('title_color', '#000000');
    $background_color = get_theme_mod('background_color', '#ffffff');
    $show_page_title = get_theme_mod('show_page_title', true);

    wp_enqueue_style('text_font_css', "https://fonts.googleapis.com/css2?family=$police&display=swap");
    ?>
    <style>
        body {
            font-family: '<?php echo $police; ?>';
            background-color: <?php echo $background_color; ?>;
        }

        .author {
            display: <?php echo (get_theme_mod('hide_author')) ? 'none' : 'inline'; ?>;
        }

        h1, h2, h3, h4, h5, h6 {
            color: <?php echo $title_color; ?>;
        }

        .page-title {
            display: <?php echo ($show_page_title) ? 'block' : 'none'; ?>;
        }

        /* Layout styles */
        .page-layout-full-width .content {
            width: 100%;
        }

        .page-layout-sidebar-left .content {
            float: right;
            width: 75%;
        }

        .page-layout-sidebar-left .sidebar {
            float: left;
            width: 25%;
        }

        .page-layout-sidebar-right .content {
            float: left;
            width: 75%;
        }

        .page-layout-sidebar-right .sidebar {
            float: right;
            width: 25%;
        }
    </style>
    <?php
}
add_action('wp_head', 'beny_css_dynamique');
?>