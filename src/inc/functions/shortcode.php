<?php
function wpa_lightgallery($atts = [], $content = null) {
  // do something to $content
  if ($content == null) {
    $o = "<div id='lg-here' class='lg-container'></div>";
  } else {
    $o = "Param contained";
  }
  // always return
  return $o;
}
add_shortcode('wporg', 'wpa_lightgallery');

function wpa_slide($atts = [], $content = null) {
  // var_dump(do_shortcode($content));
  $o = do_shortcode($content);
  
  // remove style tags
  $style = "/<style.*<\/style>/s";
  $o = preg_replace($style, '', $o);
  
  // addClass owl-carousel owl-theme
  $tag = '/(id=[\'\"])(gallery-\d+[\'\"] class=[\'\"])(.*?)([\'\"]>)/s';
  $add = '${1}owl-${2}owl-carousel owl-theme ${3}${4}';
  $o = preg_replace($tag, $add, $o);
  
  // remove clear:both tag
  $clearTag = '/<br.*?>/i';
  $o = preg_replace($clearTag, '', $o);
  
  // init owl script
  $id = '/id=[\'\"](gallery-\d+)[\'\"]/i';
  preg_match($id, $o, $result);
  $owl = $result[1];

  return $o;
}
add_shortcode('wpa_slide', 'wpa_slide');