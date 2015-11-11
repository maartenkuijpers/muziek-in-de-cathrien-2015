<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

$locale = get_the_terms($post->ID, 'language')[0]->description;
setlocale(LC_ALL, $locale);

$date = get_post_meta($post->ID, 'midc_concerten_meta_datum', true);
$date_value = date_parse_from_format("j-n-Y", $date);
$date_unix = mktime(0, 0, 0, $date_value['month'], $date_value['day'], $date_value['year']); 

$date_long = strftime("%A %d %B", $date_unix);
$date_short = strftime("%a %d %b", $date_unix);
$time = get_post_meta($post->ID, 'midc_concerten_meta_tijd', true);

$locatie = get_post_meta( $post->ID, 'midc_concerten_meta_locatie', true);

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                <?php the_title(); ?>
                <br />
                <?php $subtitle = get_post_meta( $post->ID, 'midc_concerten_artistiek_subtitel', true); ?>
                <small><?php echo $subtitle ?></small>
                </h1>
                
                <?php custom_breadcrumbs() ?>
                
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
                echo "<p><i class='fa fa-clock-o'></i> " . $date_long . " | " . $time . " uur | " . $locatie . "</p>";
                ?>

                <hr>
                <!-- Preview Image -->
                <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
                
                <hr>
                <!-- Post Content -->
<?php                
			// Start the loop.
			while ( have_posts() ) :
                the_post();
                $content = get_the_content();
                echo str_replace(array("<pre>", "</pre>"), array("<div class=lead>", "</div>"), $content);
                
			// End the loop.
			endwhile;
?>                
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Uitvoerenden</h4>
                    <small>
                        <?php echo get_post_meta( $post->ID, 'midc_concerten_artistiek_uitvoerenden', true); ?>
                    </small>
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Programma</h4>
                    <small>
                        <?php echo get_post_meta( $post->ID, 'midc_concerten_artistiek_programma', true); ?>
                    </small>
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Prijzen</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="small table table-striped table-condensed prices-table">
                                <tr><td>Aan de kassa</td><td>€7,00</td></tr>
                                <tr><td>Houders van de <a href="pricing.html">Strippenkaart</a></td><td>1 strip</td></tr>
                                <tr><td>CKE-Kaart&nbsp;<small><a href="http://www.cke.nl/nieuws/89063/cke-lanceert-kortingskaart-voor-cursisten">meer informatie</a></small></td><td>€5,00</td></tr>
                                <tr><td>CJP-houders en kinderen tot 16 jaar</td><td>gratis</td></tr>
                                <tr><td>Donateurs op vertoon van hun uitnodigings&shy;brief <small><a href="#">donateur worden</a></small></td><td>gratis</td></tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <form class="navbar-form navbar-left" role="button" method="get" action="reserveren.html">
                                <input type="hidden" name="post_id" value="1234" />
                                <button type="submit" class="btn-lg btn-primary">Reserveren</button>
                            </form>
                        </div>
                    </div>

                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Bezoeken</h4>
                    <small>
                        <ul class="list-unstyled">
                            <li>
                                <script>
                                    function download_ics(title, body, location, dt_start, dt_end) {
                                        var cal = ics();
                                        cal.addEvent(title, body, location, dt_start, dt_end);
                                        cal.download();
                                    }
                                </script>

                                <a href="#" class="btn btn-default btn-sm" title="Stuur een uitnodiging per email naar iemand en voeg er een persoonlijke boodschap aan toe">
                                    <span class="fa fa-envelope" aria-hidden="true"></span>&nbsp;Ga je mee?
                                </a>
                                <a class="btn btn-default btn-sm" href="javascript:download_ics('CVE zingt Nicolaimesse van Haydn', 'Meer informatie vindt u op http://www.muziekindecathrien.nl/', 'Kerkstraat 1, Eindhoven', '7/12/2014 12:15', '7/12/2014 13:53')"
                                   title="Download een iCalendar bestand (.ics) en open het vervolgens in je agenda programma (Apple Calendar, Microsoft Outlook, Google Calendar, etc.)">
                                    <span class="fa fa-calendar" aria-hidden="true"></span>&nbsp;&nbsp;Zet dit concert in je kalender
                                </a>
                            </li>
                            <li><hr /></li>
                            <li>
                                <h4>Tips voor een drankje na afloop</h4>
                                <dl>
                                    <dt>Van Moll</dt>
                                    <dd>
                                        Keizersgracht 16A&nbsp;
                                        <small>
                                            <a target="_blank" href="http://vanmolleindhoven.nl/"><span class="fa fa-external-link fa-1x" aria-hidden="true"></span> website</a> |
                                            <a target="_blank" href="https://goo.gl/maps/4uD5H">
                                                <span class="fa fa-map-marker fa-1x" aria-hidden="true"></span>&nbsp;looproute
                                            </a>
                                        </small>
                                    </dd>

                                    <dt>De Oude Rechtbank</dt>
                                    <dd>
                                        Stratumseind 32&nbsp;
                                        <small>
                                            <a target="_blank" href="http://www.ouderechtbank.nl/"><span class="fa fa-external-link fa-1x" aria-hidden="true"></span> website</a> |
                                            <a target="_blank" href="https://goo.gl/maps/nHkcs">
                                                <span class="fa fa-map-marker fa-1x" aria-hidden="true"></span>&nbsp;looproute
                                            </a>
                                        </small>
                                    </dd>

                                    <dt>The Trafalgar Pub</dt>
                                    <dd>
                                        Dommelstraat 21&nbsp;
                                        <small>
                                            <a target="_blank" href="http://www.thetrafalgarpub.nl/"><span class="fa fa-external-link fa-1x" aria-hidden="true"></span> website</a> |
                                            <a target="_blank" href="https://goo.gl/maps/4ZZai">
                                                <span class="fa fa-map-marker fa-1x" aria-hidden="true"></span>&nbsp;looproute
                                            </a>
                                        </small>
                                    </dd>
                                </dl>

                            </li>
                        </ul>
                    </small>
                </div>

            </div>
        </div>
        <!-- /.row -->
        <hr>
        
        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php get_footer(); ?>