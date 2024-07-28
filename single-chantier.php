<?php get_header(); ?>
<main class="single__chantier">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <article class="post__chantier">
                <h1 class="site-title"><?php the_title(); ?></h1>
                
                <section class="beny__single__content">

                    <div class="post__content">

                        <?php the_content(); ?>
                    </div>
                    <aside class="site-description">
                        <h2> Descriptif Chantier</h2>
                      
                        <?php
                     
                        $fields =$box->fields;
                    
                        foreach($fields as $field ){
                            $meta_value= get_post_meta(get_the_ID(),  $field['id'], true);
                            ?>
                           
                        <h3><?= $field['name']; ?> <span> <?= $meta_value; ?></span></h3>
                        <?php } ?>
                       
                    </aside>
                    <div class="btn-devis">
                        <a href="<?php echo get_permalink(14); ?>">Je souhaite un devis gratuit</a>

                    </div>
                </section>
            </article>

    <?php endwhile;
    endif; ?>
</main>
<?php get_footer(); ?>