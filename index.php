<?php get_header() ?>

<main style= "display:grid;
                   grid-template-columns:repeat(4, 1fr);
                   gap:20px;">

<?php if (have_posts()) : ?>
   <article style= "display:flex;
                     justify-content:center;
                     align-items:center;
                     flex-direction:column;
                     gap:20px;">
      <?php while (have_posts()) : the_post() ?>
        
      
            <?php the_post_thumbnail('medium', ['class' =>'card-image-top', 'alt'=> '', 'style'=> 'height: auto;' ]) ?>
           
            
              
               <h5 class="card-titile"><?php the_title() ?></h5>
               <h6 class="card-subtitle"><?php the_category(', ') ?></h6>
               <p class="card-dat">Ecrit le <?= get_the_date() ?><span class="author"> par <?php the_author() ?></span></p>
               <p class="card-text"><?php the_excerpt() ?></p>
               <a href="<?php the_permalink() ?>" class="card-link">voir plus</a>
        
        
      <?php endwhile; ?>
   </article>

<?php else : ?>
   <p>Pas de contenu</p>
<?php endif; ?>
</main>

<?php get_footer();