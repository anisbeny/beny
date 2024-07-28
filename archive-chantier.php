<?php get_header(); ?>

<main class="site__chantiers">
	<h1 class="site__heading">Nos réalisations</h1>
	

	<section class="all__Projects">
	<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
    	<div class="project">
			<?php if (has_post_thumbnail()) : ?>
					<div class="post__thumbnail">
					<a href="<?php the_permalink(); ?>">
						<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" style="width: 100%; height: 100%; object-fit: cover;">
						</a>
					</div>
				<?php endif; ?>
				<h2 class="project__title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
		</div>

		<?php endwhile; endif; ?>
	</section>
	<?php get_template_part( 'template-parts/pagination' ); ?>
</main> 

<?php get_footer(); ?>