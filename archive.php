<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gridbox
 */

get_header();

$category = get_category( get_query_var( 'cat' ) );
$cat_id = $category->cat_ID;

if ( have_posts() ) : ?>

	<header class="page-header clearfix">
		
		<?php if( $cat_id == 162 || $cat_id == 140 || $cat_id == 139 || $cat_id == 166 ) :
			
			the_archive_title( '<h1 class="archive-title">Calculadoras Online de ', '</h1>' ); 
		
		elseif ( $cat_id == 131 || $cat_id == 183 ): 
		
			the_archive_title( '<h1 class="archive-title">', ' Online</h1>' ); 
		
		else: 

			the_archive_title( '<h1 class="archive-title">', '</h1>' ); 
		
		endif; 
		
		the_archive_description( '<div class="archive-description">', '</div>' ); ?>

	</header>

<?php endif; ?>

	<section id="primary" class="content-archive content-area">
		<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) : ?>

				<div id="post-wrapper" class="post-wrapper clearfix">

					<?php while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content' );

					endwhile; ?>

				</div>

				<?php gridbox_pagination(); ?>

			<?php
			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
