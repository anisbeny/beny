<?php get_header() ?>
<main>
<?php if(have_posts()): ?>
<?php  while (have_posts()) : the_post() ?>

        <h1 class="entry-title"><?php the_title() ?></h1>
       <?php the_content() ?>
        
<?php endwhile;  ?>
<?php else: ?>
    <p>Pas de contenu</p>
<?php endif; ?>
</main>
<?php get_footer();