<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 * 
 * Template Name: Prijzen template
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			// End the loop.
			endwhile;

			// Include content of pages with template "bestuurslid"
			$args = array('posts_per_page' => -1, 'post_type' => 'page', 'order' => 'ASC', 'orderby' => 'menu_order' );
			$query = new WP_Query($args);
			while ( $query->have_posts() ) : $query->the_post(); 
				if ( get_post_meta( $post->ID, '_wp_page_template', true ) == "page-prijzen-item.php" )
				{
					?>
					<div class="col-md-4 text-center">
						<div class="thumbnail">
							<div class="caption">
								<?php get_template_part( 'content', 'page' ); ?>
								<script>
									$('article#post-<?php echo($post->ID); ?> header').hide();
								</script>

								<ul class="list-inline">
									<?php // Render social channels
									$value = get_post_meta( $post->ID, 'bestuurslid_meta_box_email', true);
									if (!empty($value)) {
										echo ("<li><a href='mailto:" . $value . "'><i class='fa fa-2x fa-envelope-square'></i></a></li>");
									}

									$value = get_post_meta( $post->ID, 'bestuurslid_meta_box_facebook', true);
									if (!empty($value)) {
										echo ("<li><a href='" . $value . "'><i class='fa fa-2x fa-facebook-square'></i></a></li>");
									}

									$value = get_post_meta( $post->ID, 'bestuurslid_meta_box_linkedin', true);
									if (!empty($value)) {
										echo ("<li><a href='" . $value . "'><i class='fa fa-2x fa-linkedin-square'></i></a></li>");
									}

									$value = get_post_meta( $post->ID, 'bestuurslid_meta_box_twitter', true);
									if (!empty($value)) {
										echo ("<li><a href='" . $value . "'><i class='fa fa-2x fa-twitter-square'></i></a></li>");
									}
									?>
								</ul>
							</div>
						</div>
					</div>
					<?php
					$columns = $columns + 1;
					if ($columns == 3) {
						echo "</div><div class='row'>";
						$columns = 0;
					}
				}	
			endwhile;
			echo "</div>";
			?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
