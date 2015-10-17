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
    <link href="<?php echo get_stylesheet_directory_uri();
?>/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo get_stylesheet_directory_uri();
?>/css/modern-business.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo get_stylesheet_directory_uri();
?>/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<!-- jQuery -->
    <script src="<?php echo get_stylesheet_directory_uri();
?>/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo get_stylesheet_directory_uri();
?>
/js/bootstrap.min.js"></script>

</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!--<div class="container">-->
			<!-- INSERT WP MENU HERE -->
				<?php
				$defaults = array(
					'menu' => 'top_menu',
					'depth' => 2,
					'container' => false,
					'menu_class' => 'nav navbar-nav navbar-right',
					'walker' => new wp_bootstrap_navwalker()
				);
				wp_nav_menu( $defaults );
?>

			<!-- /INSERT WP MENU HERE -->

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><img src=" <?php echo get_stylesheet_directory_uri();
?>/images/Muziek in de Cathrien - horizontaal 50px.png" title="Logo Muziek in de Cathrien" /></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Concerten <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="http://www.muziekindecathrien.nl/agenda/jaarprogramma/">Seizoen 2014-2015</a>
                            </li>
                            <li>
                                <a href="reserveren-stap1.html"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Reserveren</a>
                            </li>
                            <li>
                                <a href="concerten-in-beeld.html">Concerten in beeld</a>
                            </li>
                            <li>
                                <a href="gastenboek.html">Gastenboek</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Informatie <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="pricing.html">Prijzen</a>
                            </li>
                            <li>
                                <a href="#">Stadskerk St. Cathrien</a>
                            </li>
                            <li>
                                <a href="#">Instrumentarium</a>
                            </li>
                            <li role="presentation" class="divider"></li>
                            <li>
                                <a href="#">Deelnemen in de serie</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a id="login" data-placement="bottom" data-toggle="nieuwsbrief-popover" data-title="Meldt u aan voor de nieuwsbrief" data-container="body" type="button" data-html="true" href="#">Nieuwsbrief</a>
                        <div id="nieuwsbrief-content" class="hide">
                            <form class="form-inline" id="niewsbrief-form" action="nieuwsbrief-aangemeld.html" method="post" role="form">
                                <div class="form-group">
                                    <input name="niewsbrief-email" id="nieuwsbrief-email" class="form-control" placeholder="nieuwsbrief-email" maxlength="100" type="email">
                                    <button type="submit" class="btn-sm btn-primary"><span class="glyphicon glyphicon-ok"></span></button>
                                </div>
                            </form>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Stichting CME <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="about.html">Bestuur</a>
                            </li>
                            <li>
                                <a href="#">Donateur worden</a>
                            </li>
                            <li>
                                <a href="#">Sponsoren</a>
                            </li>
                            <li>
                                <a href="anbi-informatie.html">ANBI Informatie</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="nav" href="#" title="English"><img src=" <?php echo get_stylesheet_directory_uri();
?>/images/BritishFlag.png" height="15" /></a>
                    </li>

                    <li>
                        <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </li>

                    <li>
                        <a id="login" data-placement="bottom" data-toggle="search-popover" data-title="Zoek op de website" data-container="body" type="button" data-html="true"><span class="glyphicon glyphicon-search"></span></a>
                        <div id="search-content" class="hide">
                            <form class="form-inline" action="" method="get" role="form">
                                <div class="form-group">
                                    <input name="s" class="form-control" placeholder="zoeken" maxlength="100" type="search">
                                    <button type="submit" class="btn-sm btn-primary" onclick="if ($('input#search').val() == '') return false;"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </form>
                        </div>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        <!-- </div> -->
        <!-- /.container -->
    </nav>

	    <!-- Page Content -->
    <div class="container">
