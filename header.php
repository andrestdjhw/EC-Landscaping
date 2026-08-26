<?php
/**
 * Header global — EC Landscaping
 *
 * Solo estructura y montaje: el markup real del navbar vive en
 * src/scripts/Navbar.js y se monta sobre #ec-navbar con las props de abajo.
 *
 * --header-offset: alto reservado para el header fijo. Lo consumen las
 * secciones (padding-top del hero) y el sticky del FAQ. Si el navbar cambia
 * de alto, este es el único número que hay que tocar.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php wp_head(); ?>
</head>

<body <?php body_class('bg-bone font-sans text-ink antialiased'); ?>>
<?php wp_body_open(); ?>

<?php
$ec_uploads_header = wp_get_upload_dir();

/**
 * Props del navbar. Se serializan a JSON en el data-props del nodo de
 * montaje; Navbar.js las lee al montar.
 *
 * Los href se arman con home_url() y no con rutas literales: una instalación
 * en subdirectorio rompería cualquier "/#commercial" pelado.
 */
$ec_navbar_props = array(
  /* ═══ LOGO CANÓNICO — NO CAMBIAR SIN PEDIDO EXPLÍCITO ═══
     NAVBAR: EC_Imagotipo2-2-scaled.png (definido ago 2026).
     FOOTER: EC_Imagotipo2-1-scaled.png (en footer.php).
     Son variantes distintas del mismo imagotipo, una por superficie — no
     unificarlas ni revertir a ecscapingneg.png, que quedó obsoleto. Si el
     logo cambia, este comentario y el de footer.php se actualizan juntos. */
  'logo'    => $ec_uploads_header['baseurl'] . '/2026/08/EC_Imagotipo2-2-scaled.png',

  'phone'   => '(385) 240-3907',
  'email'   => 'info@ecscaping.com',
  'address' => '3754 N Higley Rd, Suite 2 · Ogden, UT',

  // La misma cadena de dirección que el bloque de área de servicio y el
  // footer: un solo NAP en todo el sitio (Pendiente 01 — nunca Hooper).
  'mapsHref' => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode('3754 N Higley Rd Suite 2, Ogden, UT 84404'),

  // Sin número: solo la clasificación. El número completo se retiró de la
  // home a pedido (ago 2026).
  'license' => 'UT License S330',

  /* Redes sociales (Pendiente 13 resuelto, ago 2026). La clave es 'google'
     y no 'tiktok': EC no tiene TikTok y sí perfil de Google Business.

     La URL de Google va sin los parámetros de tracking (?entry=...&g_ep=...)
     con los que la copia el navegador, y con el viewport centrado en el
     negocio a nivel calle — la copiada venía con zoom de medio oeste de
     EE.UU. Si Google cambia el formato y el enlace deja de abrir el perfil,
     la alternativa simple es la misma URL de mapsHref de arriba. */
  'social' => array(
    'facebook'  => 'https://www.facebook.com/eclandscape',
    'instagram' => 'https://www.instagram.com/ec_landscaping1/',
    'google'    => 'https://www.google.com/maps/place/EC+LANDSCAPING+LLC/@41.1811977,-112.1034322,17z/data=!3m1!1e3!4m6!3m5!1s0x87530f2cfdca3adf:0x82a1eda6e66ff9eb!8m2!3d41.1811977!4d-112.1034322!16s%2Fg%2F11k638rcqc',
  ),

  /* Projects deja de ser un ancla de la home y pasa a página propia. El
     resto siguen siendo anclas raíz-relativas para funcionar desde
     cualquier página. Capabilities es desplegable: el padre no navega
     (activeId mantiene el scrollspy) y los hijos van a las páginas de
     capacidad. */
  'links' => array(
    array('label' => 'Commercial', 'href' => home_url('/#commercial')),
    array('label' => 'Projects', 'href' => home_url('/projects')),
    array(
      'label'    => 'Capabilities',
      'activeId' => '#capabilities',
      'children' => array(
        array('label' => 'All capabilities', 'href' => home_url('/capabilities')),
        array('label' => 'Commercial landscape installation', 'href' => home_url('/landscape-installation')),
        array('label' => 'Hardscape & concrete', 'href' => home_url('/hardscape-concrete')),
        array('label' => 'Grounds maintenance, irrigation & snow', 'href' => home_url('/grounds-maintenance')),
        array('label' => 'Water-wise retrofits', 'href' => home_url('/water-wise-retrofits')),
      ),
    ),
    array('label' => 'Credentials', 'href' => home_url('/#credentials')),
    // A página propia, como Projects — ya no al ancla de la home.
    array('label' => 'Service Area', 'href' => home_url('/service-area')),
  ),

  'bidHref' => home_url('/contact'),

  // Sin residentialHref: el sitio es comercial y no expone salida a
  // residencial. Restituirlo es agregar la prop acá, sin tocar Navbar.js.

  /* BARRA CLARA, ITEMS OSCUROS — la inversión pedida (ago 2026): la barra
     de navegación va en blanco y los nav items en ink. La franja de
     utilidad de arriba se queda oscura, haciendo el contraste. Todo el
     manejo de colores del modo claro ya vive en Navbar.js (prop theme). */
  'theme'    => 'light',
  'ctaStyle' => 'ember',
);
?>

<div
  id="ec-navbar"
  data-props="<?php echo esc_attr(wp_json_encode($ec_navbar_props)); ?>"
></div>

<?php
/**
 * FloatingActions: los tres botones flotantes (llamar, correo, mapa) del
 * borde derecho. Montaje aparte del navbar porque viven fijos sobre toda la
 * página, no dentro del header.
 */
$ec_floating_props = array(
  'phone'    => '(385) 240-3907',
  'email'    => 'info@ecscaping.com',
  'mapsHref' => $ec_navbar_props['mapsHref'],
);
?>

<div
  id="ec-floating-actions"
  data-props="<?php echo esc_attr(wp_json_encode($ec_floating_props)); ?>"
></div>

<main id="main">