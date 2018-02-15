<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<div class="body-container">
    <div class="header">
        <div class="top-header">
            <div class="wrapper">
                <div class="row">
                    <div class="header-logo col-lg-3 col-sm-5 col-xs-12">
						<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
						$logo                 = wp_get_attachment_image_src( $custom_logo_id, 'full' );
						if ( has_custom_logo() ) {
							echo '<a href="' . get_home_url() . '"><img src="' . esc_url( $logo[0] ) . '" alt="Food Recipe"><h1 class="logo-h1">' . get_bloginfo( 'name' ) . '</h1></a>';
						} else {
							echo '<h1>' . get_bloginfo( 'name' ) . '</h1>';
						} ?>
                    </div><!-- .header-logo -->
					<?php wp_nav_menu( array(
						'theme_location'  => 'primary',
						'container_class' => 'main-nav col-lg-6 hidden-md hidden-sm hidden-xs'
					) ); ?>
                    <div class="buttons col-lg-3 col-sm-6 col-xs-12">
                        <a class="btn headbtn" href="#"><?php _e( 'REGISTER', 'foodrecipe' ); ?></a>
                        <a class="btn headbtn login" href="#"><?php _e( 'LOGIN', 'foodrecipe' ); ?></a>
                    </div><!-- buttons -->
                    <nav class="navbar navbar-default hidden-lg col-sm-1">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed my-collapsed"
                                        data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                                        aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <button class="close menu-close" type="button" data-dismiss="modal">
                                <i class="glyphicon glyphicon-remove"></i>
                            </button>
							<?php wp_nav_menu( array(
								'theme_location'  => 'primary',
								'container_class' => 'main-nav'
							) ); ?>
                        </div>
                    </nav>
                </div><!-- .row -->
            </div><!-- .wrapper -->
        </div><!-- .top-header -->
	    <?php get_template_part( 'slider' ); // Bootstrap slider (carousel) ?>
    </div><!-- .header -->
    <div class="wrapper container"><!-- .wrapper -->
        <div class="content"><!-- .content -->
