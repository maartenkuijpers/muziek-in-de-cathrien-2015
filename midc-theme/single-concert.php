<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

$locale = get_the_terms($post->ID, 'language')[0]->description;
//setlocale(LC_ALL, $locale);
setlocale(LC_ALL, 'nl_NL');

$date = get_post_meta($post->ID, 'midc_concerten_meta_datum', true);
$date_value = date_parse_from_format("j-n-Y", $date);
$date_unix = mktime(0, 0, 0, $date_value['month'], $date_value['day'], $date_value['year']);

$date_long = strftime("%A %d %B", $date_unix);
$date_short = strftime("%a %d %b", $date_unix);

$time_begin = get_post_meta($post->ID, 'midc_concerten_meta_aanvang', true);
$time_end = get_post_meta($post->ID, 'midc_concerten_meta_einde', true);

$calendar_date = strftime("%Y-%m-%d", $date_unix);
$calendar_start = $calendar_date . ' ' . str_replace('.', ':', $time_begin);
$calendar_end = $calendar_date . ' ' . str_replace('.', ':', $time_end); 

$locatie_naam = get_post_meta( $post->ID, 'midc_concerten_meta_locatie_naam', true);
$locatie_adres = get_post_meta( $post->ID, 'midc_concerten_meta_locatie_adres', true);
$locatie_plaats = get_post_meta( $post->ID, 'midc_concerten_meta_locatie_plaats', true);
$locatie = $locatie_naam . ', ' . $locatie_adres . ', ' . $locatie_plaats; 

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
                
                <?php // custom_breadcrumbs(); ?>
                
            </div>
        </div>
        <!-- /.row -->
        <!-- Content Row -->
        <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
                <!-- Blog Post -->
                <!-- Date/Time -->
				<div class="concert-datetime">
					<i class='fa fa-clock-o'></i> <?php echo $date_long ?> | <?php echo $time_begin ?> uur | <?php echo $locatie ?>
				</div>

                <?php
                $gallery_id = get_post_meta($post->ID, 'midc_concerten_meta_gallerij', true);
                if ($gallery_id != '') {
                    global $nggdb;
                    $gallery = $nggdb->get_gallery($gallery_id, 'sortorder', 'ASC', true, 0, 0);
                    ?>                    
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                        <?php
                        $first = true;
                        $count = 0;
                        foreach($gallery as $image) {
                            $count = $count + 1;
                            if ($first) { echo '<div class="item active">'; $first = false; }
                            else { echo '<div class="item">'; }
                            ?>
                                <img class="img-responsive" src="<?php echo $image->imageURL;?>" alt="">
                            </div>
                            <?php } ?>
                        </div>
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php
                            $first = true;
                            for ($slide = 0; $slide < $count; $slide = $slide + 1) {
                                if ($first) {
                                    $first = false;
                                    echo '<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>';
                                } else {
                                    echo '<li data-target="#carousel-example-generic" data-slide-to="' . $slide . '"></li>';    
                                }
                            } ?>
                        </ol>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                    <?php
                }
                else {
                    // Preview Image
                    the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                }
                ?>                
                <hr />
                <!-- Post Content -->
                <?php                
			// Start the loop.
			while ( have_posts() ) :
                the_post();
                the_content();
			endwhile;
?>                
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4 sidebar">
                <!-- Side Widget Well -->
                <?php $uitvoerenden = get_post_meta( $post->ID, 'midc_concerten_artistiek_uitvoerenden', true);
                if ($uitvoerenden != '') {?>
                <div class="well uitvoerenden">
                    <h4>Uitvoerenden</h4>
                    <small>
                        <?php echo $uitvoerenden ?>
                    </small>
                </div>
                <?php } ?>

                <!-- Side Widget Well -->
                <?php $programma = get_post_meta( $post->ID, 'midc_concerten_artistiek_programma', true);
                if ($programma != '') {?>
                <div class="well programma">
                    <h4>Programma</h4>
                    <small>
                        <?php echo $programma ?>
                    </small>
                </div>
                <?php } ?>

                <!-- Blog Categories Well -->
                <div class="well prijzen">
                    <h4>Prijzen</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="small table table-striped table-condensed prices-table">
                                <?php
                                    $array = array ( 
                                        array('Aan de kassa', 'midc_concerten_prijzen_standaard', '€', ''),
                                        array('Donateurs', 'midc_concerten_prijzen_donateurs', '€', ''),
                                        array('Houders van de Strippenkaart', 'midc_concerten_prijzen_strippenkaart', '', ' x strip'),
                                        array('CKE-kaart', 'midc_concerten_prijzen_cke_kaart', '€', ''),
                                        array('CJP-houders & Studentenpas', 'midc_concerten_prijzen_cjp', '€', ''),
                                        array('Kinderen tot 18 jaar', 'midc_concerten_prijzen_kinderen', '€', '')
                                    );
                                    foreach ($array as $pricing) {
                                        $active = get_post_meta($post->ID, $pricing[1] . '_active', true);
                                        $value = get_post_meta($post->ID, $pricing[1], true);
                                        if ($active)
                                        {
                                            echo '<tr>';
                                            echo '<td>' . $pricing[0] . '</td>';
                                            if (floatval($value) != 0.0)
                                                echo '<td>' . $pricing[2] . $value . $pricing[3] . '</td>';
                                            else
                                                echo '<td>gratis</td>';
                                            echo '</tr>';  
                                        }
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                    <!-- /.row -->

					<?php /*
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="navbar-form navbar-left" role="button" method="get" action="reserveren.html">
                                <input type="hidden" name="post_id" value="1234" />
                                <button type="submit" class="btn-lg btn-primary">Reserveren</button>
                            </form>
                        </div>
                    </div>
					*/ ?>

                </div>

                <!-- Side Widget Well -->
                <div class="well bezoeken">
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

                                <?php
                                $meer = "Meer informatie vindt je op " . get_permalink();
                                $body = "Beste ...,\xA\xAOp " . $date_long . " ga ik naar Muziek in de Cathrien om het volgende concert bij te wonen.\xAGa je mee?\xA\xA" . get_the_title() . "\xA" . $subtitle . "\xA\xA" . $meer . "\xA";
                                $mail_to_content = "?subject=Uitnodiging: " . rawurlencode($subtitle) . "&body=" . rawurlencode($body);
                                ?>
                                
                                <a href="mailto:<?php echo $mail_to_content; ?>" class="btn btn-default btn-sm" title="Stuur een uitnodiging per email naar iemand en voeg er een persoonlijke boodschap aan toe">
                                    <span class="fa fa-envelope" aria-hidden="true"></span>&nbsp;Ga je mee?
                                </a>
                                <a title="Download een iCalendar bestand (.ics) en open het vervolgens in je agenda programma (Apple Calendar, Microsoft Outlook, Google Calendar, etc.)"
                                   class="btn btn-default btn-sm"
                                   href="javascript:download_ics('<?php echo $subtitle; ?>', '<?php echo $meer; ?>', '<?php echo $locatie_adres; ?>, <?php echo $locatie_plaats; ?>', '<?php echo $calendar_start; ?>', '<?php echo $calendar_end; ?>')">
                                    <span class="fa fa-calendar" aria-hidden="true"></span>&nbsp;&nbsp;Zet dit concert in je kalender
                                </a>
                                
                            </li>
                            <li><hr /></li>
                            <li>
                                <h4>Tips voor een drankje na afloop</h4>
                                <dl>
                                    
                                <?php
                                    for ($drankje = 1; $drankje <= 3; $drankje++) {
                                        $active = get_post_meta($post->ID, 'midc_concerten_overig_drankje'.$drankje.'_active', true);
                                        $name = get_post_meta($post->ID, 'midc_concerten_overig_drankje'.$drankje.'_naam', true);
                                        $address = get_post_meta($post->ID, 'midc_concerten_overig_drankje'.$drankje.'_adres', true);
                                        // $maps = 'https://www.google.nl/maps/dir/St.+Catharina+kerk,+Kerkstraat+1,+Eindhoven/' . str_replace(' ', '+', $name) . ',+' . str_replace(' ', '+', $address) . ',+Eindhoven';
                                        $maps = 'https://www.google.nl/maps/dir/' . str_replace(' ', '+', $locatie) . '/' . str_replace(' ', '+', $name) . ',+' . str_replace(' ', '+', $address);
                                        $website =get_post_meta($post->ID, 'midc_concerten_overig_drankje'.$drankje.'_website', true); 
                                        if ($active)
                                        {
                                            ?>
                                    <dt><?php echo $name; ?></dt>
                                    <dd>
                                        <?php echo $address; ?>&nbsp;
                                        <small>
                                            <a target="_blank" href="<?php echo $website; ?>"><span class="fa fa-external-link fa-1x" aria-hidden="true"></span> website</a> |
                                            <a target="_blank" href="<?php echo $maps ?>">
                                                <span class="fa fa-map-marker fa-1x" aria-hidden="true"></span>&nbsp;looproute
                                            </a>
                                        </small>
                                    </dd>
                                            <?php                                            
                                        }
                                    }
                                ?>
                                
                                </dl>
                            </li>
                        </ul>
                    </small>
                </div>

            </div>
        </div>
        <!-- /.row -->
        <hr />
        
        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php get_footer(); ?>