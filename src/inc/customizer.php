<?php
  function wpa_customize_register($wp_customize) {
    /////////////////////
    ////// slide 1  /////
    /////////////////////
    $wp_customize -> add_section('slide1', array(
      'title' => __('slide1', 'wp-agency'),
      'description' => sprintf(__('Options for slide1', 'wp-agency')),
      'priority' => 130
    ));
    
    // slide 1 -> bg image
    $wp_customize -> add_setting('slide1_bg_image', array(
      'default' => get_bloginfo('template_directory') . '/img/front-parallax-bg1.png',
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control(new WP_Customize_Image_Control($wp_customize, 'slide1-bg-image', array(
      'label' => __('Background Image', 'wp-agency'),
      'section' => 'slide1',
      'settings' => 'slide1_bg_image',
      'priority' => 1
    )));
    
    // slide 1 -> title
    $wp_customize -> add_setting('slide1_heading', array(
      'default' => _x('CREATIVES', 'wp-agency'),
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control('slide1_heading', array(
      'label' => __('Heading', 'wp-agency'),
      'section' => 'slide1',
      'priority' => 2
    ));
    
    // slide 1 -> subtitle
    $wp_customize -> add_setting('slide1_subheading', array(
      'default' => _x('POWERED BY OLDERTHANYESTERDAY.COM', 'wp-agency'),
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control('slide1_subheading', array(
      'label' => __('Sub Heading', 'wp-agency'),
      'section' => 'slide1',
      'priority' => 3
    ));
    
    // slide 1 -> button url
    $wp_customize -> add_setting('btn_url', array(
      'default' => _x('#slide2', 'wp-agency'),
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control('btn_url', array(
      'label' => __('Button URL', 'wp-agency'),
      'section' => 'slide1',
      'priority' => 4
    ));

    // slide 1 -> button text
    $wp_customize -> add_setting('btn_text', array(
      'default' => _x('Scroll Down', 'wp-agency'),
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control('btn_text', array(
      'label' => __('Button Text', 'wp-agency'),
      'section' => 'slide1',
      'priority' => 5
    ));

    
    /////////////////////
    ////// slide 2  /////
    /////////////////////
    
    $wp_customize -> add_section('slide2', array(
      'title' => __('slide2', 'wp-agency'),
      'description' => sprintf(__('Options for slide2', 'wp-agency')),
      'priority' => 130
    ));
    
    // slide 2 -> title
    $wp_customize -> add_setting('slide2_heading', array(
      'default' => _x('we are an awesome agency', 'wp-agency'),
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control('slide2_heading', array(
      'label' => __('Heading', 'wp-agency'),
      'section' => 'slide2',
      'priority' => 1
    ));

    ////// feat. 1 /////
    // slide2 -> feature 1 -> icon
    $wp_customize -> add_setting('slide2_feature1_icon', array(
      'default' => get_bloginfo('template_directory') . '/img/feature1.png',
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control(new WP_Customize_Image_Control($wp_customize, 'slide2-feature1-icon', array(
      'label' => __('Feature 1 Icon', 'wp-agency'),
      'section' => 'slide2',
      'settings' => 'slide2_feature1_icon',
      'priority' => 11
    )));

    // slide2 -> feature 1 -> heading
    $wp_customize -> add_setting('slide2_feature1_heading', array(
      'default' => _x('feature one', 'wp-agency'),
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control('slide2_feature1_heading', array(
      'label' => __('Heading', 'wp-agency'),
      'section' => 'slide2',
      'priority' => 12
    ));

    // slide2 -> feature 1 -> text
    $wp_customize -> add_setting('slide2_feature1_text', array(
      'default' => _x('Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, autem!', 'wp-agency'),
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control('slide2_feature1_text', array(
      'label' => __('text', 'wp-agency'),
      'section' => 'slide2',
      'priority' => 13
    ));

    ////// feat. 2 /////
    // slide2 -> feature 2 -> icon
    $wp_customize -> add_setting('slide2_feature2_icon', array(
      'default' => get_bloginfo('template_directory') . '/img/icon-write.png',
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control(new WP_Customize_Image_Control($wp_customize, 'slide2-feature2-icon', array(
      'label' => __('Feature 2 Icon', 'wp-agency'),
      'section' => 'slide2',
      'settings' => 'slide2_feature2_icon',
      'priority' => 21
    )));

    // slide2 -> feature 2 -> heading
    $wp_customize -> add_setting('slide2_feature2_heading', array(
      'default' => _x('feature two', 'wp-agency'),
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control('slide2_feature2_heading', array(
      'label' => __('Heading', 'wp-agency'),
      'section' => 'slide2',
      'priority' => 22
    ));

    // slide2 -> feature 2 -> text
    $wp_customize -> add_setting('slide2_feature2_text', array(
      'default' => _x('Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, autem!', 'wp-agency'),
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control('slide2_feature2_text', array(
      'label' => __('text', 'wp-agency'),
      'section' => 'slide2',
      'priority' => 23
    ));
    
    ////// feat. 3 /////
    // slide2 -> feature 3 -> icon
    $wp_customize -> add_setting('slide2_feature3_icon', array(
      'default' => get_bloginfo('template_directory') . '/img/icon-search.png',
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control(new WP_Customize_Image_Control($wp_customize, 'slide2-feature3-icon', array(
      'label' => __('Feature 3 Icon', 'wp-agency'),
      'section' => 'slide2',
      'settings' => 'slide2_feature3_icon',
      'priority' => 31
    )));

    // slide2 -> feature 3 -> heading
    $wp_customize -> add_setting('slide2_feature3_heading', array(
      'default' => _x('feature three', 'wp-agency'),
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control('slide2_feature3_heading', array(
      'label' => __('Heading', 'wp-agency'),
      'section' => 'slide2',
      'priority' => 32
    ));

    // slide2 -> feature 3 -> text
    $wp_customize -> add_setting('slide2_feature3_text', array(
      'default' => _x('Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, autem!', 'wp-agency'),
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control('slide2_feature3_text', array(
      'label' => __('text', 'wp-agency'),
      'section' => 'slide2',
      'priority' => 33
    ));

    ////// feat. 4 /////
    // slide2 -> feature 4 -> icon
    $wp_customize -> add_setting('slide2_feature4_icon', array(
      'default' => get_bloginfo('template_directory') . '/img/icon-bubble.png',
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control(new WP_Customize_Image_Control($wp_customize, 'slide2-feature4-icon', array(
      'label' => __('Feature 4 Icon', 'wp-agency'),
      'section' => 'slide2',
      'settings' => 'slide2_feature4_icon',
      'priority' => 41
    )));

    // slide2 -> feature 4 -> heading
    $wp_customize -> add_setting('slide2_feature4_heading', array(
      'default' => _x('feature four', 'wp-agency'),
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control('slide2_feature4_heading', array(
      'label' => __('Heading', 'wp-agency'),
      'section' => 'slide2',
      'priority' => 42
    ));

    // slide2 -> feature 4 -> text
    $wp_customize -> add_setting('slide2_feature4_text', array(
      'default' => _x('Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, autem!', 'wp-agency'),
      'type' => 'theme_mod'
    ));
    
    $wp_customize -> add_control('slide2_feature4_text', array(
      'label' => __('text', 'wp-agency'),
      'section' => 'slide2',
      'priority' => 43
    ));


  }
  add_action('customize_register', 'wpa_customize_register');