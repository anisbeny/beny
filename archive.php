<?php get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <h1>Articles</h1>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article class="post">
              
                    <h2><?php the_title(); ?></h2>

                    <?php the_post_thumbnail(); ?>

                    <p class="post__meta">
                        Publié le <?php the_time(get_option('date_format')); ?>
                        par <?php the_author(); ?>
                    </p>

                    <?php the_excerpt(); ?>

                    <p>
                        <a href="<?php the_permalink(); ?>" class="post__link">Lire la suite</a>
                    </p>
                </article>

        <?php endwhile;
        endif; ?>
 
</main>
<?php get_template_part( 'template-parts/pagination' ); ?>
</div>
<?php get_footer(); ?>