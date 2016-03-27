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
 * Template Name: Container - Header Carousel
 */

global $template_order;
if (!strpos($template_order, 'page-container.php')) {
    wp_redirect(get_permalink( $post->post_parent ));
    exit;
}
$template_order .= '/page-container-header-carousel.php';

//<header id="myCarousel" class="carousel slide" data-ride="carousel">
?>

<!-- Preview Image -->
<header id="myCarousel" class="carousel slide">
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
<?php
		// Include content of pages with template "page-container-carousel-item"
		$args = array('posts_per_page' => -1, 'post_type' => 'page', 'order' => 'ASC', 'orderby' => 'menu_order' );
		$query = new WP_Query($args);
		$active = ' active';
		$slides = 0;
		while ( $query->have_posts() ) : $query->the_post(); 
			if ( get_post_meta( $post->ID, '_wp_page_template', true ) == "page-container-header-carousel-item.php" )
			{
				$slides = $slides + 1;
				echo('<div class="item' . $active . '">');
				get_template_part( 'page-container-header-carousel-item' );
				echo('</div>');
				$active = ''; // only first slide must get 'active' class
			}
		endwhile;
?>
    </div>

    <!-- Indicators -->
    <ol class="carousel-indicators">
<?php
	$activeClass = 'class="active"';
	for($slide = 0; $slide < $slides; $slide++) {
		if ($slide > 0)
			$activeClass = ""; // only for first slide
		echo('<li data-target="#myCarousel" data-slide-to="' . $slide . '" ' . $activeClass . '></li>');
	}
?>
    </ol>
	
    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
		<span class="icon-prev"></span>
	</a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next">
		<span class="icon-next"></span>
	</a>
</header>

<script>
$("#myCarousel").appendTo("#pre-container-placeholder");
</script>