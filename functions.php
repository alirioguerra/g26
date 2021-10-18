<?php

add_filter( 'wpcf7_form_class_attr', 'custom_custom_form_class_attr' );

function custom_custom_form_class_attr( $class ) {
  $class .= ' main-footer--contact__form';
  return $class;
}


// Função para registrar os Scripts e o CSS
function g26_scripts() {
  wp_register_script('gsap', get_template_directory_uri() . '/javascript/gsap/gsap.min.js', [], false, true);
  wp_register_script('splittext', get_template_directory_uri() . '/javascript/gsap/SplitText.min.js', [], false, true);
  wp_register_script('flickity', get_template_directory_uri() . '/javascript/flickity.js', [], false, true);
  wp_register_script('scrollreveal', get_template_directory_uri() . '/javascript/scrollreveal.min.js', [], false, true);
  wp_register_script('script', get_template_directory_uri() . '/javascript/g26functions.js', ['gsap', 'splittext', 'flickity', 'scrollreveal'], false, true);
  wp_enqueue_script('script');
}
add_action('wp_enqueue_scripts', 'g26_scripts');

function g26_stylesheet() {
  wp_register_style('flickty', get_template_directory_uri() . '/flickity.css', array(), false, false);
  wp_register_style('g26style', get_template_directory_uri() . '/style.css', array('flickty'), false, false);
  wp_enqueue_style('g26style');
}
add_action('wp_enqueue_scripts', 'g26_stylesheet');

// Funções para Limpar o Header
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');


// Custom Images Sizes
function my_custom_sizes() {
  add_image_size('large', 1400, 380, true);
  add_image_size('medium', 768, 380, true);
}
add_action('after_setup_theme', 'my_custom_sizes');

?>