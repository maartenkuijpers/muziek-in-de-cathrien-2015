<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Muziek in de Cathrien - v2</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo get_stylesheet_directory_uri();?>/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo get_stylesheet_directory_uri();?>/css/modern-business.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo get_stylesheet_directory_uri();?>/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald|Source+Sans+Pro" rel="stylesheet"> 
    <!-- ICS -->
    <script src="<?php echo get_stylesheet_directory_uri();?>/js/blob.js-master/blob.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri();?>/js/filesaver.js-master/filesaver.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri();?>/js/ics.js-master/ics.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<!-- jQuery -->
    <script src="<?php echo get_stylesheet_directory_uri();?>/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo get_stylesheet_directory_uri();?>/js/bootstrap.min.js"></script>

</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src=" <?php echo get_stylesheet_directory_uri();?>/images/Muziek in de Cathrien - horizontaal 50px.png" title="Logo Muziek in de Cathrien" /></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<?php
                // WP MENU IS INSERTED HERE
				$defaults = array(
					'menu' => 'top_menu',
					'depth' => 2,
					'container' => false,
					'menu_class' => 'nav navbar-nav navbar-right',
					'walker' => new wp_bootstrap_navwalker()
				);
				wp_nav_menu( $defaults );
                // WP MENU IS INSERTED HERE -- end
                ?>

                <ul id="menu-custom-menu" class="nav navbar-nav navbar-right">
                    <li>
                        <a id="newsletter" data-placement="bottom" data-toggle="newsletter-popover" data-title="Meldt u aan voor de nieuwsbrief" data-container="body" type="button" data-html="true" href="#">Nieuwsbrief</a>
                        <div id="newsletter-content" class="hide">
                            <form class="form-inline" id="newsletter-form" action="<?php echo get_site_url();?>/nieuwsbrief-aanmelding" method="post" role="form">
                                <div class="form-group">
                                    <input name="newsletter-email" id="newsletter-email" class="form-control" placeholder="E-mailadres" maxlength="100" required type="email">
                                    <button type="submit" class="btn-sm btn-primary"><span class="glyphicon glyphicon-ok"></span></button>
                                </div>
                            </form>
                        </div>
                    </li>

                    <li>
                        <a id="search" data-placement="bottom" data-toggle="search-popover" title="Zoek op de website" data-container="body" type="button" data-html="true"><span class="glyphicon glyphicon-search"></span></a>
                        <div id="search-content" class="hide">
                            <form id="search-form" class="form-inline" action="<?php echo get_site_url();?>" method="get" role="form">
                                <div class="form-group">
                                    <input id="s" name="s" class="form-control" placeholder="zoeken" maxlength="100" type="search">
                                    <button type="submit" class="btn-sm btn-primary" onclick="if ($('input#search').val() == '') return false;"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </form>
                        </div>
                        <script type="text/javascript">
                        </script>
                    </li>

                    <!-- <li>
                        <a class="nav" href="#" title="English"><img src=" <?php echo get_stylesheet_directory_uri(); ?>/images/BritishFlag.png" height="15" /></a>
                    </li>

                    <li>
                        <a class="navbar-brand" title="Ga naar de winkel" href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </li> -->
                </ul>
                
                <script>
                    $('#menu-custom-menu').children().appendTo("#menu-main-menu");
                </script>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

	<!-- Header injector -->
	<span id="pre-container-placeholder"></span>

	<!-- Page Content -->
    <div class="container">