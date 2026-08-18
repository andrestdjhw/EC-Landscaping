</main>

    <?php
    /**
     * El NAP del footer es la referencia contra la que se auditan las
     * citations. Cualquier cambio aquí tiene que replicarse carácter por
     * carácter en Google Business, Facebook, Yelp y HomeAdvisor.
     *
     * Logo (Pendiente 10): hasta ahora no se pasaba ninguno. El único archivo
     * disponible era ecscapingneg.png, la versión en negativo, que sobre el
     * fondo claro del footer desaparecía; el componente caía al wordmark
     * tipográfico.
     *
     * OJO CON EL LOGO: el footer pasó a theme => 'dark' para que se vea el
     * patrón orgánico —el efecto produce formas claras y sobre bone no se
     * distinguía—. Eso invierte el requisito: ahora este archivo tiene que
     * ser la versión en NEGATIVO, la misma que el navbar.
     *
     * Se deja apuntando a EC_Imagotipo2 porque no sé cuál de los dos es cuál.
     * Si el logo del footer se pierde contra el fondo oscuro, intercambialo
     * por EC_Imagotipo2-1 —el del navbar— y listo.
     *
     * Para volver el footer a claro: 'theme' => 'light'. El patrón deja de
     * montarse solo, y el logo vuelve a necesitar la versión en positivo.
     */
    $ec_uploads = wp_get_upload_dir();

    $ec_footer_props = array(
      'logo'           => $ec_uploads['baseurl'] . '/2026/08/EC_Imagotipo2-scaled.png',

      // Estampado de Apoyo. Se arma desde wp_get_upload_dir() como el resto
      // de los medios, para que sobreviva la migración a producción. Vaciar
      // esta línea deja el footer liso — el componente no lo dibuja.
      'stamp'          => $ec_uploads['baseurl'] . '/2026/08/Estampado-de-Apoyo-scaled.png',
      'theme'          => 'dark',
      'legalName'      => 'EC Landscaping LLC',
      'address'        => '3754 N Higley Rd, Suite 2',
      'cityState'      => 'Ogden, UT 84404',
      'phone'          => '(385) 240-3907',
      'email'          => 'info@ecscaping.com',
      'mapsHref'       => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode('3754 N Higley Rd Suite 2, Ogden, UT 84404'),
      'license'        => 'Utah License 1106462255001 · S330',
      'credentialLine' => "Licensed and insured · General Liability · Workers' Comp · Commercial Auto",
      'counties'       => 'Serving Weber, Davis, Morgan and Box Elder counties',
      'year'           => (int) current_time('Y'),

      /**
       * Los enlaces se arman con home_url() y no con anclas sueltas. El footer
       * sale en todas las páginas: un '#projects' pelado funciona en la home y
       * no hace nada en /contact ni en una página de capacidad.
       *
       * cta => true marca el enlace con data-bid-cta, que es lo que escucha
       * ContactForm para enfocar el formulario en vez de recargar /contact
       * contra sí misma.
       */
      'columns'        => array(
        array(
          'title' => 'Commercial',
          'links' => array(
            array('label' => 'Commercial overview', 'href' => home_url('/#commercial')),
            array('label' => 'Capabilities',        'href' => home_url('/capabilities')),
            array('label' => 'Projects',            'href' => home_url('/#projects')),
            array('label' => 'Credentials',         'href' => home_url('/#credentials')),
            array('label' => 'Service area',        'href' => home_url('/#service-area')),
          ),
        ),
        array(
          'title' => 'Company',
          'links' => array(
            array('label' => 'About EC',      'href' => home_url('/about')),
            array('label' => 'Request a bid', 'href' => home_url('/contact'), 'cta' => true),
          ),
        ),
        array(
          'title' => 'Legal',
          'links' => array(
            array('label' => 'Privacy policy',   'href' => home_url('/privacy-policy')),
            array('label' => 'Terms of service', 'href' => home_url('/terms-of-service')),
          ),
        ),
      ),

      // Vacío hasta que el cliente entregue los accesos y las URLs
      // definitivas (Pendiente 13). Con el array vacío la fila de redes
      // simplemente no se renderiza: mejor eso que enlaces muertos.
      // Formato: array( array('network' => 'facebook', 'href' => '...') )
      'socials'        => array(),
    );
    ?>

    <div
      id="ec-footer"
      data-props="<?php echo esc_attr(wp_json_encode($ec_footer_props)); ?>"
    ></div>

    <?php
    /**
     * FloatingActions: teléfono, correo y dirección fijos abajo a la derecha.
     * Comparte el NAP con el footer, así que se alimenta del mismo array —
     * si hay que corregir la dirección, se corrige en un solo lugar.
     * La dirección va abreviada porque es una etiqueta, no una citation.
     */
    $ec_floating_props = array(
      'phone'    => $ec_footer_props['phone'],
      'email'    => $ec_footer_props['email'],
      'address'  => '3754 N Higley Rd, Ogden',
      'mapsHref' => $ec_footer_props['mapsHref'],
    );
    ?>

    <div
      id="ec-floating-actions"
      data-props="<?php echo esc_attr(wp_json_encode($ec_floating_props)); ?>"
    ></div>

    <?php
    /**
     * Acá vivía el nodo de montaje del modal de "Request a bid".
     *
     * Se retiró: los CTA ahora navegan a la página /contact, que lleva el
     * mismo componente en modo permanente. El diálogo global dejaba dos
     * caminos hacia el mismo formulario y ninguno de los dos era una URL que
     * se pudiera enlazar, compartir o medir por separado.
     *
     * El componente conserva la variante modal, así que restituirlo es un div
     * con data-props y variant="modal" — pero no hay nada montado hoy.
     */
    ?>

    <?php wp_footer(); ?>
  </body>
</html>