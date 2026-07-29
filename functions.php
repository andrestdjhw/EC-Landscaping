<?php

function ec_load_assets() {
  $js_path  = get_theme_file_path('/build/index.js');
  $css_path = get_theme_file_path('/build/index.css');

  // Versionado por filemtime: evita servir CSS/JS cacheado tras cada build.
  $js_ver  = file_exists($js_path)  ? filemtime($js_path)  : '1.0';
  $css_ver = file_exists($css_path) ? filemtime($css_path) : '1.0';

  // Display: Archivo · Body: Inter. Solo los pesos que usa el diseño.
  wp_enqueue_style(
    'ec-fonts',
    'https://fonts.googleapis.com/css2?family=Archivo:wght@600;700&family=Inter:wght@400;500;600;700&display=swap',
    array(),
    null
  );

  wp_enqueue_style('ec-main', get_theme_file_uri('/build/index.css'), array('ec-fonts'), $css_ver);

  wp_enqueue_script(
    'ec-main',
    get_theme_file_uri('/build/index.js'),
    array('wp-element', 'react-jsx-runtime'),
    $js_ver,
    true
  );
}

add_action('wp_enqueue_scripts', 'ec_load_assets');

function ec_preconnect_fonts($urls, $relation_type) {
  if ('preconnect' === $relation_type) {
    $urls[] = array('href' => 'https://fonts.gstatic.com', 'crossorigin' => '');
  }
  return $urls;
}

add_filter('wp_resource_hints', 'ec_preconnect_fonts', 10, 2);

/**
 * La landing comercial arranca con un hero a sangre que pasa por detrás del
 * header, así que en esa plantilla el body no lleva padding-top. La clase la
 * consume index.css; el resto de las plantillas conserva la compensación.
 */
function ec_immersive_hero_body_class($classes) {
  if (is_page_template('home-template.php')) {
    $classes[] = 'ec-immersive-hero';
  }
  return $classes;
}

add_filter('body_class', 'ec_immersive_hero_body_class');

function ec_add_support() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', array('search-form', 'gallery', 'caption', 'style', 'script'));
}

add_action('after_setup_theme', 'ec_add_support');