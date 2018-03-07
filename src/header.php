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

  <nav  class="navbar fixed-top navbar-expand-lg navbar-dark p-lg-0" 
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
          'container_class'   => 'collapse navbar-collapse justify-content-end',
          'container_id'      => 'navbarNavDropdown',
          'menu_class'        => 'navbar-nav',
          'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
          'walker'            => new WP_Bootstrap_Navwalker()
        ));
      ?>

      <!-- <div class="collapse navbar-collapse col-lg-9" id="navbarNavDropdown">
        <ul class="navbar-nav col justify-content-between">
          <li class="nav-item active d-flex align-items-center">
            <a class="nav-link" href="#">Home <span class="sr-only d-lg-none">(current)</span></a>
          </li>
          <li class="nav-item d-flex align-items-center">
            <a class="nav-link" href="#">Pages</a>
          </li>
          <li class="nav-item d-flex align-items-center">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item d-flex align-items-center">
            <a class="nav-link" href="#">Extensions</a>
          </li>
          <li class="nav-item d-flex align-items-center">
            <a class="nav-link" href="#">Tutorials</a>
          </li>
          <li class="nav-item d-flex align-items-center">
            <a class="nav-link" href="#">Contact us</a>
          </li>

          <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown link
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>

          <li class="nav-item d-flex align-items-center nav-sns">
            <a href="#"><img src="<?php bloginfo('template_url') ?>/img/sns-facebook.png" alt="sns link for facebook"></a>
            <a href="#"><img src="<?php bloginfo('template_url') ?>/img/sns-twitter.png" alt="sns link for twitter"></a>
            <a href="#"><img src="<?php bloginfo('template_url') ?>/img/sns-skype.png" alt="sns link for skype"></a>
            <a href="#"><img src="<?php bloginfo('template_url') ?>/img/sns-linkedin.png" alt="sns link for linked in"></a>
          </li>
        </ul>
      </div> -->



    </div>
  </nav>