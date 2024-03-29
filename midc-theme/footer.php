<?php
$options = get_option('midc_options_data');
?>
        <!-- Footer -->
        <footer>
            <div class="row">
                <?php
                if ($options['midc_option_footer1_breedte'] != '') {
                    echo "<div class='col-lg-" . $options['midc_option_footer1_breedte'] . "'>" . $options['midc_option_footer1_body'] . "</div>";
                }
                if ($options['midc_option_footer2_breedte'] != '') {
                    echo "<div class='col-lg-" . $options['midc_option_footer2_breedte'] . "'>" . $options['midc_option_footer2_body'] . "</div>";
                }
                if ($options['midc_option_footer3_breedte'] != '') {
                    echo "<div class='col-lg-" . $options['midc_option_footer3_breedte'] . "'>" . $options['midc_option_footer3_body'] . "</div>";
                }
                if ($options['midc_option_footer4_breedte'] != '') {
                    echo "<div class='col-lg-" . $options['midc_option_footer4_breedte'] . "'>" . $options['midc_option_footer4_body'] . "</div>";
                }
                ?>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline text-center">
                        <?php
                        $contact = $options['midc_option_algemeen_contact'];
                        if ($contact != '') {
                            if (substr($contact, 0, 1) !== "/") {
                                $contact = "/" . $contact;
                                }                       
                            echo ('<li><a href="' . $contact . '"><span class="fa-stack fa-lg">
  <i class="fa fa-square-o fa-stack-2x"></i>
  <i class="fa fa-info fa-stack-1x"></i>
</span>&nbsp;' . __( 'Contact', 'midc-theme' ) . '</a></li>');
                        }
                        if ($options['midc_option_algemeen_social_facebook'] != '')                       
                            echo ('<li><a href="' . $options['midc_option_algemeen_social_facebook'] . '"><span class="fa-stack fa-lg">
  <i class="fa fa-square-o fa-stack-2x"></i>
  <i class="fa fa-facebook fa-stack-1x"></i>
</span>&nbsp;Facebook</a></li>');
                        if ($options['midc_option_algemeen_social_twitter'] != '')                       
                            echo ('<li><a href="' . $options['midc_option_algemeen_social_twitter'] . '"><span class="fa-stack fa-lg">
  <i class="fa fa-square-o fa-stack-2x"></i>
  <i class="fa fa-twitter fa-stack-1x"></i>
</span>&nbsp;Twitter</a></li>');
                        ?>
                    </ul>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline text-center">
                        <li><h6>Copyright &copy; <?php echo date("o", time()); ?> MPedia Design</h6></li>
                    </ul>
                </div>

            </div>
        </footer>
    </div>
    <!-- /.container -->
    <!-- Script to Activate the Carousel etc. -->
    <script>
        $('#menu-item-9999999999>a').attr('title', '<?php _e("Choose another language", "midc-theme")?>');
        $('li#menu-item-wpglobus_menu_switch_gb').attr('title', 'Switch to English');
        $('li#menu-item-wpglobus_menu_switch_gb a').attr('title', 'Switch to English');
        $('li#menu-item-wpglobus_menu_switch_nl').attr('title', 'Ga naar Nederlands');
        $('li#menu-item-wpglobus_menu_switch_nl a').attr('title', 'Ga naar Nederlands');
        $("#menu-item-9999999999").appendTo("#menu-main-menu");
        $("#search-menu").appendTo("#menu-main-menu");

        $('.carousel').carousel({
            interval: 5000 //changes the speed
        })

/*
        $("[data-toggle=newsletter-popover]").popover({
            html: true,
            content: function () {
                 return $('#newsletter-content').html();
            }
        });
*/

        $("[data-toggle=search-popover]").popover({
            html: true,
            content: function () {
                return $('#search-content').html();
            }
        });
        
        $('body').on('click', function (e) {
            // This is for closing the popups when clicking outside their area 
            $('[data-toggle="newsletter-popover"]').each(function () {
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }
            });
            
            $('[data-toggle="search-popover"]').each(function () {
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }
            });
        });
        
    </script>
</body>
</html>
