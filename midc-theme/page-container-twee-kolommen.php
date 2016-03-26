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
 * Template Name: Container - Twee kolommen
 */

 $pictureLeft = false;
 $pictureRight = false;
 $type = get_post_meta( $post->ID, 'midc_twee_kolommen_type', true);
 switch ($type) {
	case 'text50-text50': $left = 6; $right = 6; break;
 	case 'text33-text66': $left = 4; $right = 8; break;
 	case 'text66-text33': $left = 8; $right = 4; break;
 	case 'text50-picture50': $left = 6; $right = 6; $pictureRight = true; break;
 	case 'text33-picture66': $left = 4; $right = 8; $pictureRight = true; break;
 	case 'text66-picture33': $left = 8; $right = 4; $pictureRight = true; break;
 	case 'picture50-text50': $left = 6; $right = 6; $pictureLeft = true; break;
 	case 'picture33-text66': $left = 8; $right = 4; $pictureLeft = true; break;
 	case 'picture66-text33': $left = 4; $right = 8; $pictureLeft = true; break;
	default: $left = 6; $right = 6; break;
 }
?>
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><?php echo(midc_get_title(get_the_title()));?>
                    <small><?php echo(midc_get_sub_title(get_the_title()));?></small>
                </h2>
            </div>
            <div class="col-md-<?php echo($left);?>">
				<?php
				if ($pictureLeft)
					the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
				else
					the_content();
                ?>
            </div>
            <div class="col-md-<?php echo($right);?>">
				<?php
				if ($pictureRight)
					the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
				else if ($pictureLeft)
                    the_content();
                else
					echo (get_post_meta( $post->ID, 'midc_twee_kolommen_second_content', true));
                ?>
            </div>
        </div>
        <!-- /.row -->
