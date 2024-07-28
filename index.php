<?php get_header() ?>

<main style= "display:grid;
                   grid-template-columns:repeat(4, 1fr);
                   gap:20px;">

<?php if (have_posts()) : 
   if ( is_home() && ! is_front_page() ) :?>
   <article style= "display:flex;
                     justify-content:center;
                     align-items:center;
                     flex-direction:column;
                     gap:20px;">
                     <header>
                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            </header>
            
      <?php 
      endif;
      while (have_posts()) : the_post() 
        
     
         
         get_template_part( 'template-parts/content', get_post_type() );
        
       endwhile; 
   </article>

<?php else : 
   get_template_part( 'template-parts/content', 'none' );
endif; ?>
</main>

<?php get_footer();