<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="<?php bloginfo('description'); ?>">

  <title> <?php is_front_page() ? bloginfo('name') : wp_title() ; ?> </title>

  <?php wp_head(); ?>
</head>

<body id='bootstrap-overrides' 
      <?php body_class(); ?>
      style = 'visibility: hidden'
      data-temp-url = <?php bloginfo('template_url') ?>
      data-bg-img1 = "<?php echo get_theme_mod('slide1_bg_image', get_bloginfo('template_url').'/img/front-parallax-bg1.png') ?>"
      data-bg-img2 = "<?php echo get_theme_mod('slide2_bg_image', get_bloginfo('template_url').'/img/front-parallax-bg2.png') ?>" 
      data-bg-img3 = "<?php echo get_theme_mod('slide3_bg_image', get_bloginfo('template_url').'/img/front-parallax-bg3.png') ?>" 
      >

  <nav  class="navbar fixed-top navbar-expand-lg navbar-dark p-lg-0 justify-content-center animated fadeIn" 
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
        <div id="nav-icon">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
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
  