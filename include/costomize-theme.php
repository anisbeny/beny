<?php
function beny_personnalisation(WP_Customize_Manager $wp_customize)
{
    // On ajoute la section 'Affichage'
    $wp_customize->add_section(
        'beny_affichage', // Identifiant "interne" de la section
        [
            'title' => 'Affichage', // Titre visible de la section
            'priority' => 100, // Ordre (poids) des sections
            'capability' => 'edit_theme_options',
            'description' => 'Cette section comporte les contrôles de gestion de l\'affichage des informations'
        ]
    );
    // On ajoute le paramètre dans lequel on stockera la valeur de la case à cocher "masquer l'auteur"
    $wp_customize->add_setting(
        'hide_author',
        [
            'default' => false
        ]
    );
    // On ajoute la case à cocher (contrôle)
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'hide_author_control',
            [
                'label' => 'Masquer l\'auteur',
                'section' => 'beny_affichage',
                'settings' => 'hide_author',
                'type' => 'checkbox'
            ]
        )
    );


    // Faire un sélecteur de couleurs pour les titres
    // On crée le paramètre
    $wp_customize->add_setting(
        'title_color',
        [
            'default' => '#000000'
        ]
    );

    // On ajoute le contrôle "sélecteur de couleurs"
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'title_color_control',
            [
                'label' => 'Couleur des titres',
                'section' => 'colors',
                'settings' => 'title_color'
            ]
        )
    );

    // Gestion des polices
    // On crée une section
    $wp_customize->add_section(
        'beny_polices',
        [
            'title' => 'Polices',
            'priority' => 101,
            'description' => 'Cette section permet de paramétrer les polices'
        ]
    );

    // On crée un paramètre
    $wp_customize->add_setting(
        'text_font',
        [
            'default' => 'Montserrat'
        ]
    );

    // On ajoute le contrôle
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'text_font_control',
            [
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
            ]
        )
    );
}
// On s'accroche à wp_head pour générer le CSS dynamique
function beny_css_dynamique()
{
    // On charge la bonne police de textes
    // On va chercher la police dans la base de données
    $police = get_theme_mod('text_font', 'Montserrat');
    // On "fabrique" l'url et on charge le CSS correspondant
    wp_enqueue_style('text_font_css', "https://fonts.googleapis.com/css2?family=$police&display=swap");

?>
    <style>
        body {
            font-family: '<?php echo $police ?>';
        }

        .author {
            display: <?php echo (get_theme_mod('hide_author')) ? 'none' : 'inline' ?>;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: <?php echo get_theme_mod('title_color', '#000000') ?>;
        }
    </style>
<?php
}
add_action('customize_register', 'beny_personnalisation');
add_action('wp_head', 'beny_css_dynamique');
