<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>

    <a
      href="#main"
      class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[70] focus:rounded-md focus:bg-ink focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-bone"
    >Skip to content</a>

    <?php
    /**
     * Todo el contenido editable del navbar vive aquí, no en el bundle de React.
     * Los href con # apuntan a los IDs de los bloques de la landing comercial.
     */
    // El logo vive en la biblioteca de medios, no en el tema. Se arma desde
    // wp_get_upload_dir() para que la URL siga funcionando al migrar de
    // ec-landscaping.local a producción sin tocar código.
    $ec_uploads = wp_get_upload_dir();
    $ec_logo    = $ec_uploads['baseurl'] . '/2026/07/ecscapingneg.png';

    $ec_navbar_props = array(
      'logo'            => $ec_logo,
      'phone'           => '(385) 240-3907',
      'email'           => 'info@ecscaping.com',
      // Higley Rd es el NAP único. La dirección de Hooper es solo billing
      // y el cliente pidió expresamente que no se muestre (Pendiente 01).
      'address'         => '3754 N Higley Rd, Suite 2 · Ogden, UT',
      'mapsHref'        => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode('3754 N Higley Rd Suite 2, Ogden, UT 84404'),
      'license'         => 'UT License 1106462255001 · S330',
      'bidHref'         => '#request-a-bid',
      'residentialHref' => home_url('/residential'),
      'theme'           => 'dark',
      // El orden replica el orden de los bloques en home-template.php: la
      // prueba (Projects) va antes que las capacidades, por lo que el menú
      // tiene que leerse en la misma secuencia que la página.
      'links'           => array(
        array('label' => 'Commercial',   'href' => '#commercial'),
        array('label' => 'Projects',     'href' => '#projects'),
        array('label' => 'Capabilities', 'href' => '#capabilities'),
        array('label' => 'Credentials',  'href' => '#credentials'),
        array('label' => 'Service Area', 'href' => '#service-area'),
      ),
    );
    ?>

    <div
      id="ec-navbar"
      data-props="<?php echo esc_attr(wp_json_encode($ec_navbar_props)); ?>"
    ></div>

    <main id="main">