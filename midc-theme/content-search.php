<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="row">
    <div class="col-md-3">
        <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive img-hover' ) ); ?>
    </div>
    <div class="col-md-9">
        <header class="entry-header">
            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        </header><!-- .entry-header -->
        <div class="entry-summary">
            <?php echo preg_replace('/\s{2,}[\t\n]/', ' ', get_the_excerpt()); ?>
        </div><!-- .entry-summary -->
        <h4 class="media-heading"><small>
            <?php
            $locale = get_the_terms($post->ID, 'language')[0]->description;
            setlocale(LC_ALL, $locale);
            
            $date_value = date_parse_from_format('j-n-Y', get_the_date('j-n-Y'));
            $date_unix = mktime(0, 0, 0, $date_value['month'], $date_value['day'], $date_value['year']); 
            $date_long = strftime("%A %d %B %Y", $date_unix);
            echo $date_long . ' | ';
            $categories = get_the_category();
            if (!empty($categories)) { ?>
                <?php echo __( 'Type', 'twentyfifteen' ) . ': '; ?>
                <?php the_category(', '); ?><?php
            } ?>
        </small></h4>
    </div>
</div>
<hr />    
</article><!-- #post-## -->
