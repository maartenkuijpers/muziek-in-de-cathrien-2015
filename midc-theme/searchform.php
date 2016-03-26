<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
            <div class="form-group">
                <label for="search-field" class="control-label">
                    <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
                </label>
                <input type="search" id="search-field" class="search-field form-control"
                    placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
                    value="<?php echo get_search_query() ?>" name="s"
                    title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
            </div>
            <div class="form-group">
                <input type="submit" class="search-submit btn btn-success btn-lg"
                    value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
            </div>    
        </form>
    </main><!-- .site-main -->
</section><!-- .content-area -->

<?php get_footer(); ?>
