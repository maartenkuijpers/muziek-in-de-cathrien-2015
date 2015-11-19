<?php
$options = get_option('midc_options_data');
?>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline text-center">
                        <li><a href="contact.html">Contact</a></li>
                        <?php
                        if ($options['midc_option_algemeen_social_facebook'] != '')                       
                            echo ('<li><a href="' . $options['midc_option_algemeen_social_facebook'] . '"><i class="fa fa-2x fa-facebook-square"></i>&nbsp;Facebook</a></li>');
                        if ($options['midc_option_algemeen_social_twitter'] != '')                       
                            echo ('<li><a href="' . $options['midc_option_algemeen_social_twitter'] . '"><i class="fa fa-2x fa-twitter-square"></i>&nbsp;Twitter</a></li>');
                        ?>
                    </ul>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline text-center">
                        <li>Copyright &copy; <?php echo date("o", time()); ?> MPedia Design</li>
                    </ul>
                </div>

            </div>
        </footer>
    </div>
    <!-- /.container -->
    <!-- Script to Activate the Carousel -->
    <script>
        $('.carousel').carousel({
            interval: 5000 //changes the speed
        })

        $("[data-toggle=nieuwsbrief-popover]").popover({
            html: true,
            content: function () {
                return $('#nieuwsbrief-content').html();
            }
        });

        $("[data-toggle=search-popover]").popover({
            html: true,
            content: function () {
                return $('#search-content').html();
            }
        });
    </script>
</body>
</html>
