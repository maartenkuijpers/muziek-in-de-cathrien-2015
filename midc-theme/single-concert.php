<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header();
		// Start the loop.
		while ( have_posts() ) : the_post();

?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
					<?php the_title();
?>
					<br />
					<?php $subtitle = get_post_meta( $post->ID, 'midc_concerten_artistiek_subtitel', true);
?>
                    <small><?php echo $subtitle
?></small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li class="active">Concerten</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- Content Row -->
        <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
                <!-- Blog Post -->
                <hr>
                <!-- Date/Time -->
				<?php
				$date = get_post_meta( $post->ID, 'midc_concerten_meta_datum', true);
				$time = get_post_meta( $post->ID, 'midc_concerten_meta_tijd', true);
				$locatie = get_post_meta( $post->ID, 'midc_concerten_meta_locatie', true);
				echo "<p><i class='fa fa-clock-o'></i> " . $date . " | " . $time . " | " . $locatie . "</p>";
?>
                <hr>
                <!-- Preview Image -->
				<?php
			get_template_part( 'content', get_post_format() );
			echo "door " . __FILE__ . " gerendered.";

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'twentyfifteen' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'twentyfifteen' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );

		// End the loop.
		endwhile;
?>

  </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
