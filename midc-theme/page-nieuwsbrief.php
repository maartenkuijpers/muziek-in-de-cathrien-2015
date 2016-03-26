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
 * Template Name: Nieuwsbrief Aanmelding
 *
 */

get_header();

$email_address = $_POST["niewsbrief-email"]; 

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
        ?>
        <article id="post-<?php the_ID();?>" <?php post_class();?>>
            <?php twentyfifteen_post_thumbnail(); ?>
            <header class="entry-header">
                <?php echo('<h1 class="page-header entry-title">' . midc_get_title(get_the_title()) . '<small>' . midc_get_sub_title(get_the_title()) . '</small></h1>' ); ?>
            </header><!-- .entry-header -->
            <?php custom_breadcrumbs(); ?>
            <div class="entry-content">
                <?php
                    the_content();
                ?>
                <!-- Begin MailChimp Signup Form -->
                <div id="mc_embed_signup">
                    <form action="//collegiumvocaleeindhoven.us9.list-manage.com/subscribe/post?u=431a575944c9a01997ade9536&amp;id=9de492aac9" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="form-horizontal" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">
                            <div class="form-group">
                                <label for="mce-EMAIL" class="col-sm-2 control-label">E-mail-adres*</label>
                                <div class="col-sm-10">
                                    <input type="email" placeholder="email adres" value="<?php echo $email_address; ?>" name="EMAIL" class="form-control" id="mce-EMAIL">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mce-FNAME" class="col-sm-2 control-label">Naam</label>
                                <div class="col-sm-10 form-inline">
                                    <input type="text" placeholder="voornaam" value="" name="FNAME" class="form-control col-sm-5" id="mce-FNAME">
                                    <input type="text" placeholder="achternaam" value="" name="LNAME" class="form-control col-sm-5" id="mce-LNAME">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <p><a class="btn btn-info" role="button" href="http://us9.campaign-archive2.com/home/?u=431a575944c9a01997ade9536&id=9de492aac9" title="Bekijk eerdere nieuwsbrieven">Bekijk eerdere nieuwsbrieven.</a></p>
                                    <p class="help-block">* verplicht veld</p>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <div id="mce-responses">
                                        <div id="mce-error-response" style="display:none"></div>
                                        <div id="mce-success-response" style="display:none"></div>
                                    </div><!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_431a575944c9a01997ade9536_9de492aac9" tabindex="-1" value=""></div>
                                    <input type="submit" value="Meld mij aan voor de nieuwsbrief!" name="subscribe" id="mc-embedded-subscribe" class="btn btn-lg btn-success">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!--End mc_embed_signup-->
                
            </div><!-- .entry-content -->
        </article><!-- #post-## -->
        <?php
		// End the loop.
		endwhile;
		?>
    </main><!-- .site-main -->
</div><!-- .content-area -->
<?php get_footer(); ?>