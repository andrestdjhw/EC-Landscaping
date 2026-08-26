<?php
/**
 * Footer global — EC Landscaping
 *
 * Solo montaje: el markup vive en src/scripts/Footer.js y se monta sobre
 * #ec-footer con las props de abajo.
 */

$ec_uploads_footer = wp_get_upload_dir();

$ec_footer_props = array(
  /* ═══ LOGO CANÓNICO — NO CAMBIAR SIN PEDIDO EXPLÍCITO ═══
     FOOTER: EC_Imagotipo2-1-scaled.png (definido ago 2026).
     NAVBAR: EC_Imagotipo2-2-scaled.png (en header.php).
     Variantes distintas del mismo imagotipo, una por superficie — no
     unificarlas ni revertir a ecscapingneg.png, que quedó obsoleto. */
  'logo'    => $ec_uploads_footer['baseurl'] . '/2026/08/EC_Imagotipo2-1-scaled.png',

  'phone'   => '(385) 240-3907',
  'email'   => 'info@ecscaping.com',

  // NAP en una sola cadena, idéntica carácter a carácter a Google Business
  // (Pendiente 01 — nunca Hooper). Es la referencia de citation del negocio.
  'address' => '3754 N Higley Rd, Suite 2, Ogden, UT 84404',
  'mapsHref' => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode('3754 N Higley Rd Suite 2, Ogden, UT 84404'),

  // Sin número: solo la clasificación, igual que el navbar y la home. El
  // número completo (1106462255001) se retiró de todo el sitio a pedido
  // (ago 2026). AVISO dejado a conciencia: esta línea era parte del NAP de
  // referencia para citations — si un directorio pide el número de licencia,
  // ya no está visible en el sitio y hay que darlo aparte.
  'license' => 'Utah License S330',

  // Estampado de apoyo de la marca: se pinta repetido y a opacidad baja
  // sobre toda la superficie del footer. Armado desde $ec_uploads_footer
  // para sobrevivir la migración, como todos los medios.
  'pattern' => $ec_uploads_footer['baseurl'] . '/2026/08/Estampado-de-Apoyo-scaled.png',

  /* Redes sociales — las mismas tres URLs que el navbar (header.php). Si
     alguna cambia, cambiarla en LOS DOS archivos: viven duplicadas porque
     header y footer montan componentes independientes. */
  'social' => array(
    'facebook'  => 'https://www.facebook.com/eclandscape',
    'instagram' => 'https://www.instagram.com/ec_landscaping1/',
    'google'    => 'https://www.google.com/maps/place/EC+LANDSCAPING+LLC/@41.1811977,-112.1034322,17z/data=!3m1!1e3!4m6!3m5!1s0x87530f2cfdca3adf:0x82a1eda6e66ff9eb!8m2!3d41.1811977!4d-112.1034322!16s%2Fg%2F11k638rcqc',
  ),

  'nav' => array(
    'Explore' => array(
      array('label' => 'Commercial', 'href' => home_url('/#commercial')),
      // A la página /projects, no al ancla /#projects: la sección Track
      // record se eliminó de la home (ago 2026) y el ancla ya no existe.
      // Mismo destino que usa el navbar.
      array('label' => 'Projects', 'href' => home_url('/projects')),
      array('label' => 'Credentials', 'href' => home_url('/#credentials')),
      array('label' => 'Service Area', 'href' => home_url('/#service-area')),
      array('label' => 'Contact', 'href' => home_url('/contact')),
    ),
    'Capabilities' => array(
      array('label' => 'Landscape installation', 'href' => home_url('/landscape-installation')),
      array('label' => 'Hardscape & concrete', 'href' => home_url('/hardscape-concrete')),
      array('label' => 'Grounds maintenance & snow', 'href' => home_url('/grounds-maintenance')),
      array('label' => 'Water-wise retrofits', 'href' => home_url('/water-wise-retrofits')),
    ),
  ),

  'bidHref' => home_url('/contact'),
);
?>

</main>

<div
  id="ec-footer"
  data-props="<?php echo esc_attr(wp_json_encode($ec_footer_props)); ?>"
></div>

<?php wp_footer(); ?>
</body>
</html>