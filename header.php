<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <?php wp_head() ?>
</head>
<body <?php body_class(); ?>>
    <header>

<?php
            if(has_custom_logo()){
                // J'ai un logo personnalisé
                the_custom_logo();
            }else{
                // Je n'ai pas de logo
                echo '<h1>' . get_bloginfo('name')  . '</h1>';
            }
            ?>
    <?php wp_nav_menu([
        'theme_location' => 'header',
        'container' => 'nav',
        'menu_class' => 'top-menu',
        
        ]) 
        ?>
    <div class="burger">
    <i class="las la-bars"></i>
    <i class="las la-times"></i>
    </div>
    </header>
        <?php if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb('<p id="breadcrumbs">','</p>');
        } ?>
    
