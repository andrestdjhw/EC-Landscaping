<?php

function ec_load_assets() {
  $js_path  = get_theme_file_path('/build/index.js');
  $css_path = get_theme_file_path('/build/index.css');

  // Versionado por filemtime: evita servir CSS/JS cacheado tras cada build.
  $js_ver  = file_exists($js_path)  ? filemtime($js_path)  : '1.0';
  $css_ver = file_exists($css_path) ? filemtime($css_path) : '1.0';

  /* Display: Play · Body: Roboto. Solo los pesos que usa el diseño.
   *
   * Play va únicamente en 700: los 66 usos de font-display del tema son
   * todos font-bold, y la familia solo publica 400 y 700 — no hay 600 que
   * pedir. Si algún día hace falta un display en regular, se agrega el 400.
   *
   * Roboto lleva los cuatro pesos del cuerpo: 400 de base, 500 en enlaces
   * de contacto, 600 en eyebrows y etiquetas, 700 en las cifras.
   *
   * Reemplaza a Archivo + Inter. */
  wp_enqueue_style(
    'ec-fonts',
    'https://fonts.googleapis.com/css2?family=Play:wght@700&family=Roboto:wght@400;500;600;700&display=swap',
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


/* ═══════════════════════════════════════════════════════════════════
   Endpoint del formulario de bid
   ═══════════════════════════════════════════════════════════════════ */

/**
 * Dirección a la que llegan los bids.
 *
 * Por defecto va al correo del administrador de WordPress. Reemplazar por la
 * bandeja real de EC — y confirmar con Tomás quién la revisa, porque un bid
 * que cae en un buzón sin dueño es peor que no tener formulario.
 */
function ec_bid_recipient() {
  return apply_filters('ec_bid_recipient', get_option('admin_email'));
}

add_action('rest_api_init', function () {
  register_rest_route('ec/v1', '/bid', array(
    'methods'  => 'POST',
    'callback' => 'ec_handle_bid_request',
    // El formulario es público: cualquier visitante tiene que poder enviarlo.
    // El control de acceso no es el que corresponde acá; el antiabuso son el
    // honeypot y el límite por IP de abajo.
    'permission_callback' => '__return_true',
  ));
});

function ec_handle_bid_request(WP_REST_Request $request) {

  // Honeypot. Un humano nunca ve este campo, así que si viene con contenido
  // es un bot. Se responde 200 a propósito: un 403 le enseña al bot que el
  // campo lo delató y vuelve con el campo vacío.
  if (trim((string) $request->get_param('website')) !== '') {
    return new WP_REST_Response(array('ok' => true), 200);
  }

  // Límite por IP: cinco envíos por hora. No es antispam serio, es el techo
  // que evita que un script convierta el buzón de Tomás en un basurero.
  $ip  = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : 'unknown';
  $key = 'ec_bid_' . md5($ip);
  $hits = (int) get_transient($key);

  if ($hits >= 5) {
    return new WP_Error('ec_rate_limited', 'Too many submissions. Please call us instead.', array('status' => 429));
  }

  $fields = array(
    'name'    => sanitize_text_field($request->get_param('name')),
    'company' => sanitize_text_field($request->get_param('company')),
    'email'   => sanitize_email($request->get_param('email')),
    'phone'   => sanitize_text_field($request->get_param('phone')),
    'buyer'   => sanitize_text_field($request->get_param('buyer')),
    'scope'   => sanitize_text_field($request->get_param('scope')),
    'site'    => sanitize_text_field($request->get_param('site')),
    'date'    => sanitize_text_field($request->get_param('date')),
    'details' => sanitize_textarea_field($request->get_param('details')),
  );

  // La misma validación que hace el componente, repetida acá. No es
  // redundancia: el cliente valida para ayudar a la persona, el servidor
  // valida porque nadie está obligado a usar el formulario para llegar
  // a este endpoint.
  if ($fields['name'] === '' || !is_email($fields['email']) || $fields['site'] === '' || $fields['details'] === '') {
    return new WP_Error('ec_invalid', 'Missing or invalid fields.', array('status' => 400));
  }

  $labels = array(
    'name'    => 'Name',
    'company' => 'Company',
    'email'   => 'Email',
    'phone'   => 'Phone',
    'buyer'   => 'Buyer type',
    'scope'   => 'Scope',
    'site'    => 'Site',
    'date'    => 'Target date',
    'details' => 'Details',
  );

  $lines = array();
  foreach ($labels as $key_name => $label) {
    if ($fields[$key_name] !== '') {
      $lines[] = $label . ': ' . $fields[$key_name];
    }
  }
  $lines[] = '';
  $lines[] = 'Sent from ' . home_url('/');

  $subject = sprintf(
    '[Bid request] %s — %s',
    $fields['name'],
    $fields['site']
  );

  // Reply-To con el correo de quien escribe: así responder desde el cliente
  // de correo va a la persona y no al servidor. El From se deja en el
  // dominio del sitio para no romper SPF/DKIM.
  $headers = array(
    'Content-Type: text/plain; charset=UTF-8',
    'Reply-To: ' . $fields['name'] . ' <' . $fields['email'] . '>',
  );

  $sent = wp_mail(ec_bid_recipient(), $subject, implode("\n", $lines), $headers);

  if (!$sent) {
    // wp_mail falla callado en muchos hostings sin SMTP configurado. Se
    // registra para que el fallo sea rastreable en vez de un bid perdido.
    error_log('[ec] wp_mail falló al enviar un bid de ' . $fields['email']);
    return new WP_Error('ec_mail_failed', 'Could not send the message.', array('status' => 500));
  }

  set_transient($key, $hits + 1, HOUR_IN_SECONDS);

  return new WP_REST_Response(array('ok' => true), 200);
}

/* ══════════════════════════════════════════════════════════════════
   MOVIMIENTO — revelado por scroll y destello de titulares

   Vivía copiado dentro de cada plantilla. Acá está una sola vez y aplica a
   TODAS las páginas del tema, incluidas index.php y single.php, que nunca
   lo tuvieron.

   Son dos piezas y van en dos lugares distintos a propósito:

   · La MARCA (wp_head, prioridad 1) tiene que ejecutarse antes de que el
     navegador pinte. El estado oculto de [data-reveal] cuelga de .ec-reveal,
     así que si la clase llegara tarde se vería el contenido y después
     desaparecería de golpe.

   · Los MOTORES (wp_footer) corren cuando el DOM ya existe.

   Sin JavaScript la clase nunca se agrega y todo el contenido se ve tal
   cual. Nunca se esconde texto apostando a que corra un script — es la
   diferencia entre una animación y una página rota.
   ══════════════════════════════════════════════════════════════════ */

function ec_motion_boot() {
  ?>
  <script>
    (function () {
      var mq = window.matchMedia;
      if (mq && mq('(prefers-reduced-motion: reduce)').matches) return;
      document.documentElement.classList.add('ec-reveal');
    })();
  </script>
  <?php
}
add_action('wp_head', 'ec_motion_boot', 1);

function ec_motion_engines() {
  ?>
  <script>
    /* ── Revelado por scroll ──
       Genérico por [data-reveal]: colgarlo de cualquier bloque nuevo no pide
       tocar este código.

       unobserve al revelar: es una entrada, no un efecto de ida y vuelta.
       Volver a subir no debería re-esconder texto que ya se leyó. */
    (function () {
      if (!document.documentElement.classList.contains('ec-reveal')) return;

      var items = document.querySelectorAll('[data-reveal]');
      if (!items.length) return;

      if (!('IntersectionObserver' in window)) {
        Array.prototype.forEach.call(items, function (el) { el.classList.add('is-revealed'); });
        return;
      }

      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          entry.target.classList.add('is-revealed');
          io.unobserve(entry.target);
        });
      }, { threshold: 0.15, rootMargin: '0px 0px -8% 0px' });

      Array.prototype.forEach.call(items, function (el) { io.observe(el); });
    })();

    /* ── Destello de los titulares ──
       La clase se pone al entrar en pantalla y se QUITA al salir: la
       animación va en bucle, y dejarla corriendo en un titular que está tres
       pantallas más abajo repinta igual y se paga en batería. */
    (function () {
      var mq = window.matchMedia;
      if (mq && mq('(prefers-reduced-motion: reduce)').matches) return;

      var titles = document.querySelectorAll('.ec-shine');
      if (!titles.length || !('IntersectionObserver' in window)) return;

      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          entry.target.classList.toggle('is-shining', entry.isIntersecting);
        });
      }, { threshold: 0.35 });

      Array.prototype.forEach.call(titles, function (t) { io.observe(t); });
    })();
  </script>
  <?php
}
add_action('wp_footer', 'ec_motion_engines');