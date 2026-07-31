</main>

    <?php
    /**
     * El NAP del footer es la referencia contra la que se auditan las
     * citations. Cualquier cambio aquí tiene que replicarse carácter por
     * carácter en Google Business, Facebook, Yelp y HomeAdvisor.
     *
     * Logo: no se pasa a propósito. ecscapingneg.png es la versión en
     * negativo y el footer es claro, así que desaparecería. Cuando llegue
     * el logo en positivo, agregar 'logo' aquí (Pendiente 10).
     */
    $ec_footer_props = array(
      'theme'          => 'light',
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