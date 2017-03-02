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
$email_address = $_POST["newsletter-email"]; 
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
		<?php
        // Start the loop.
        while ( have_posts() ) : the_post();

            // Include the page content template.
            get_template_part( 'content', 'page' );

        // End the loop.
        endwhile;
        ?>
        <!-- Begin MailChimp Signup Form -->
        <div id="mc_embed_signup">
            <form action="//collegiumvocaleeindhoven.us9.list-manage.com/subscribe/post?u=431a575944c9a01997ade9536&amp;id=9de492aac9" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="form-horizontal" target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">
                    <div class="form-group">
                        <label for="mce-EMAIL" class="col-sm-2 control-label">E-mail-adres*</label>
                        <div class="col-sm-5">
                            <input type="email" maxlength="100" required placeholder="email adres" value="<?php echo $email_address; ?>" name="EMAIL" class="form-control" id="mce-EMAIL">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mce-FNAME" class="col-sm-2 control-label">Naam</label>
                        <div class="col-sm-10 form-inline">
                            <input type="text" placeholder="voornaam" value="" name="FNAME" class="form-control" id="mce-FNAME">
                            <input type="text" placeholder="achternaam" value="" name="LNAME" class="form-control" id="mce-LNAME">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <p><a class="btn btn-info" role="button" href="http://us9.campaign-archive2.com/home/?u=431a575944c9a01997ade9536&id=9de492aac9" title="Bekijk eerdere maandbrieven">Bekijk eerdere maandbrieven</a></p>
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
                            <button type="submit" name="subscribe" id="mc-embedded-subscribe" class="btn btn-lg btn-success"><i class='fa fa-flag fa-2x pull-left'></i>Meld mij aan voor de maandbrief!</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--End mc_embed_signup-->
                
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>