<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="<?php bloginfo('description'); ?>">

  <title> <?php is_front_page() ? bloginfo('name') : wp_title() ; ?> </title>

  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery.fullpage.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">

  <?php wp_head(); ?>
</head>

<body id='bootstrap-overrides' class='prx-1 d-none'>

  <nav  class="navbar fixed-top navbar-expand-lg navbar-dark p-lg-0 justify-content-center" 
        role="navigation">
    <div class="container">

      <a class="navbar-brand" href="<?php echo get_home_url() ?>">
        <img src="<?php bloginfo('template_url') ?>/img/logo.png" width="70px" height="auto" alt="">
      </a>

      <button class="navbar-toggler" 
              type="button" 
              data-toggle="collapse" 
              data-target="#navbarNavDropdown" 
              aria-controls="navbarNavDropdown" 
              aria-expanded="false" 
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <?php
        wp_nav_menu( array(
          'theme_location'    => 'primary',
          'depth'             => 2,
          'container'         => 'div',
          'container_class'   => 'collapse navbar-collapse justify-content-center',
          'container_id'      => 'navbarNavDropdown',
          'menu_class'        => 'navbar-nav',
          'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
          'walker'            => new WP_Bootstrap_Navwalker()
        ));
      ?>
      
      <div id="sns" class="d-none d-lg-block">
        <a class="mx-1" href="#"><img src="<?php bloginfo('template_url') ?>/img/sns-facebook.png" alt="sns link for facebook"></a>
        <a class="mx-1" href="#"><img src="<?php bloginfo('template_url') ?>/img/sns-twitter.png" alt="sns link for twitter"></a>
        <a class="mx-1" href="#"><img src="<?php bloginfo('template_url') ?>/img/sns-linkedin.png" alt="sns link for linked in"></a>
      </div>

    </div>
  </nav>