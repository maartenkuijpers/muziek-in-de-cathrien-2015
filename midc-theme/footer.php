        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline text-center">
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i>&nbsp;Facebook</a></li>
                        <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i>&nbsp;Twitter</a></li>
                    </ul>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline text-center">
                        <li>Copyright &copy; 2015 MPedia Design</li>
                    </ul>
                </div>

            </div>
        </footer>
    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.min.js"></script>
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
