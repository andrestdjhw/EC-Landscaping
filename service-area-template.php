<?php
/**
 * Template Name: Service Area
 *
 * Página propia del área de servicio. Hasta ahora era un ancla del bloque 09
 * de la home; ese bloque se queda donde está —responde "¿llegan hasta acá?"
 * sin sacar a nadie de la landing— y esta página lo desarrolla condado por
 * condado.
 *
 * ═══════════════════════════════════════════════════════════════════
 * PENDIENTE 07 — leer antes de publicar
 *
 * El sitio actual promete Park City y Salt Lake City. El Industry Report fija
 * el núcleo real en el corredor Weber–Davis, con radio de 50 millas desde el
 * patio de Ogden y hasta 90 para instalaciones grandes.
 *
 * Esta página usa el núcleo del reporte, igual que el bloque 09 de la home.
 * Si Tomás confirma que EC sí trabaja Salt Lake o Summit de forma habitual,
 * se agregan a $counties y a $cities y el resto no se toca.
 *
 * Lo que NO se hace es prometer cobertura que la cuadrilla no puede sostener:
 * en una empresa cuyo argumento entero es "llegamos cuando dijimos", el área
 * de servicio es justamente donde una promesa de más se paga cara.
 * ═══════════════════════════════════════════════════════════════════
 */

get_header();

$ec_uploads = wp_get_upload_dir();

/* Foto del encabezado. Vacía = el hero vuelve a bloque de color liso. */
$ec_hero_img = '';

/* ─────────────────────────────────────────────────────────────
   NAP — la misma cadena que el footer y el bloque 09.

   Escrita una vez y derivadas de ella las dos URLs de mapa. Si mañana cambia
   la dirección, no queda un mapa apuntando a la anterior.
   ───────────────────────────────────────────────────────────── */
$ec_map_query = '3754 N Higley Rd Suite 2, Ogden, UT 84404';
$ec_map_embed = 'https://www.google.com/maps?q=' . rawurlencode($ec_map_query) . '&output=embed';
$ec_map_href  = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($ec_map_query);

/* ─────────────────────────────────────────────────────────────
   CONDADOS

   El orden no es alfabético: es por peso real de operación. Un GC piensa por
   condado —permisos, distrito de agua, jurisdicción— así que este es el dato
   que más pesa de la página, y el primero de la lista tiene que ser donde
   está el patio.

   'note' es lo que un buscador de "commercial landscaping [condado]" no
   encuentra en ningún otro lado: por qué EC opera bien ahí. Es copy nuevo y
   no pasó por Eunice.

   'map' es la consulta que se le pasa a Google. Se escribe una vez y de ella
   salen la URL del embed y la de "abrir en Maps".
   ───────────────────────────────────────────────────────────── */
$counties = array(
  array(
    'name'   => 'Weber County',
    'cities' => 'Ogden · North Ogden · Roy · Riverdale · Pleasant View',
    'note'   => 'Our yard sits in Ogden, so Weber is the county where a crew can be on your site the same morning you call. Most of our commercial contracts start here.',
    'map'    => 'Weber County, Utah',
  ),
  array(
    'name'   => 'Davis County',
    'cities' => 'Layton · Clearfield · Syracuse · Farmington · Kaysville · Bountiful',
    'note'   => 'The corridor’s densest commercial growth. Retail pads, branch sites and multifamily — the work that has to open on a date somebody already advertised.',
    'map'    => 'Davis County, Utah',
  ),
  array(
    'name'   => 'Box Elder County',
    'cities' => 'Brigham City · Perry · Willard',
    'note'   => 'North of the yard and inside the standard radius. Industrial and institutional sites, plus the maintenance contracts that come with them.',
    'map'    => 'Box Elder County, Utah',
  ),
  array(
    'name'   => 'Morgan County',
    'cities' => 'Morgan · Mountain Green',
    'note'   => 'East over the divide. Smaller market, and the drive is real — we bid it when the scope justifies putting a crew on the road.',
    'map'    => 'Morgan County, Utah',
  ),
);

/* ─────────────────────────────────────────────────────────────
   RADIO — las dos distancias que el mapa no dice.

   Un mapa muestra dónde está el patio, no hasta dónde llega la cuadrilla.
   ───────────────────────────────────────────────────────────── */
$radius = array(
  array(
    'value' => '50 mi',
    'label' => 'Standard radius',
    'body'  => 'From our Ogden yard. Inside this line we can staff a maintenance contract, hold a construction schedule and get a truck out for a punch item without it costing you a day.',
  ),
  array(
    'value' => 'Up to 90',
    'label' => 'Large installations',
    'body'  => 'For commercial installations big enough to justify the mobilization. If your site sits outside the standard line and the scope is there, ask us anyway — the answer is a number, not a policy.',
  ),
);

/* ─────────────────────────────────────────────────────────────
   FAQ del área de servicio.

   No repite ninguna de las ocho del bloque 11 de la home: estas son las que
   solo aparecen cuando alguien está mirando un mapa.
   ───────────────────────────────────────────────────────────── */
$faqs = array(
  array(
    'q' => 'We have sites in more than one county. Is that one contract or four?',
    'a' => 'One. You get the same crew leads and the same documentation on every property, and one point of contact for all of them. If your plan adds locations across Northern Utah, we would rather bid them as one program than one site at a time.',
  ),
  array(
    'q' => 'Do you handle snow at properties outside Weber and Davis?',
    'a' => 'Inside the standard radius, yes — snow and ice management is written into the annual contract, not bid separately in October. Outside it, ask early: winter coverage depends on how the route runs, and that gets decided before the season, not during it.',
  ),
  array(
    'q' => 'Our site is just outside your radius. Is it worth calling?',
    'a' => 'Yes. The radius is where we can guarantee response, not where we stop working. For a commercial installation the drive is a line item like any other — we will price it and tell you honestly whether it makes sense.',
  ),
  array(
    'q' => 'Can you meet on site before you bid?',
    'a' => 'That is how every bid starts. We visit, review the plans and confirm scope with your PM or superintendent before we price anything. Inside the corridor that walkthrough is usually the same week.',
  ),
);

$bid_href = home_url('/contact');
?>

<script>
  /* Marca de revelado, antes de que se pinte nada: el estado oculto de
     [data-reveal] cuelga de .ec-reveal, así que si la clase llegara tarde se
     vería el contenido y después desaparecería de golpe. */
  (function () {
    var mq = window.matchMedia;
    if (mq && mq('(prefers-reduced-motion: reduce)').matches) return;
    document.documentElement.classList.add('ec-reveal');
  })();
</script>

<!-- ═══════════════════════ ENCABEZADO ═══════════════════════ -->
<section class="relative isolate overflow-hidden bg-ink text-bone">

  <?php if ($ec_hero_img) : ?>
    <!-- Scrim de 0.94 a 0.82. Menos abierto que el de las páginas de
         capacidad porque acá el lede vive en la columna derecha: ese lado
         también lleva texto y no puede irse a transparente. -->
    <img
      src="<?php echo esc_url($ec_hero_img); ?>"
      alt=""
      aria-hidden="true"
      class="absolute inset-0 -z-20 h-full w-full object-cover"
      fetchpriority="high"
      decoding="async"
    />
    <div
      class="absolute inset-0 -z-10 bg-[linear-gradient(100deg,rgba(47,52,45,0.94)_0%,rgba(47,52,45,0.90)_40%,rgba(47,52,45,0.86)_72%,rgba(47,52,45,0.82)_100%)]"
      aria-hidden="true"
    ></div>
  <?php endif; ?>

  <div class="relative w-full px-5 pb-16 pt-[calc(var(--header-offset)+3rem)] sm:px-8 lg:px-10 lg:pb-24 lg:pt-[calc(var(--header-offset)+5rem)]">
    <div data-reveal class="grid gap-8 lg:grid-cols-[minmax(0,1.5fr)_minmax(0,1fr)] lg:items-end lg:gap-16">
      <div>
        <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300">
          Service area · Weber–Davis corridor
        </p>
        <h1 class="ec-shine ec-shine--light ec-mixed font-display text-4xl leading-[1.08] font-bold tracking-tight text-bone sm:text-5xl lg:text-[3.4rem]">
          Fifty miles from the yard. <em>Ninety when the scope earns it.</em>
        </h1>
      </div>
      <p class="text-base leading-relaxed text-bone/80 lg:pb-2">
        We are not a franchise with a map of territories. We are a crew with a yard in Ogden, and the honest answer to &ldquo;do you cover us?&rdquo; is a drive time, not a sales region.
      </p>
    </div>

    <div class="ec-band ec-band--h mt-12 h-1.5 opacity-40" aria-hidden="true"></div>
  </div>
</section>

<!-- ═══════════════════════ MAPA Y RADIO ═══════════════════════ -->
<!-- Composición modular: el mapa es una celda de la retícula, no un adorno
     al costado. Y las dos distancias suben de jerarquía a bloque en clay,
     porque son la promesa comercial que el mapa no puede mostrar. -->
<section class="bg-bone">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div data-reveal class="grid gap-px bg-ink/15 lg:grid-cols-6">

      <!-- El iframe va en absolute dentro de una celda con alto propio: así
           el espacio queda reservado antes de que cargue y la página no salta.
           loading=lazy no es cosmético — sin eso arrastra el JavaScript de
           Maps en la carga inicial. -->
      <div class="relative min-h-[22rem] bg-ink lg:col-span-4 lg:min-h-[30rem]">
        <iframe
          src="<?php echo esc_url($ec_map_embed); ?>"
          title="Map showing EC Landscaping at 3754 N Higley Rd, Suite 2, Ogden, Utah"
          class="absolute inset-0 h-full w-full border-0"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          allowfullscreen
        ></iframe>
      </div>

      <?php foreach ($radius as $ec_i => $r) :
        // El primero en clay, el segundo en ink: el bloque de mayor peso es
        // el que rompe el color de su vecino, no el que lo repite.
        $ec_bg  = (0 === $ec_i) ? 'bg-ember' : 'bg-ink';
        $ec_txt = (0 === $ec_i) ? 'text-ink' : 'text-bone';
        // Sobre clay el texto va SIN opacidad: es un tono medio y a 80% cae
        // por debajo de AA. Sobre ink sí hay margen para atenuarlo.
        $ec_sub = (0 === $ec_i) ? 'text-ink' : 'text-bone/80';
        ?>
        <div class="<?php echo esc_attr($ec_bg . ' ' . $ec_txt); ?> flex flex-col justify-center p-8 lg:col-span-2 lg:p-10">
          <p class="text-[0.65rem] font-semibold uppercase tracking-[0.14em] <?php echo esc_attr($ec_sub); ?>">
            <?php echo esc_html($r['label']); ?>
          </p>
          <p class="mt-3 font-display text-4xl font-bold leading-none tracking-tight tabular-nums">
            <?php echo esc_html($r['value']); ?>
          </p>
          <p class="mt-4 text-sm leading-relaxed <?php echo esc_attr($ec_sub); ?>">
            <?php echo esc_html($r['body']); ?>
          </p>
        </div>
      <?php endforeach; ?>

      <!-- El patio, cerrando la fila. -->
      <div class="flex flex-col justify-center bg-sand p-8 lg:col-span-6 lg:p-10">
        <p class="text-[0.65rem] font-semibold uppercase tracking-[0.14em] text-ember-800">The yard</p>
        <p class="mt-3 text-base text-ink">
          <a
            href="<?php echo esc_url($ec_map_href); ?>"
            target="_blank"
            rel="noopener noreferrer"
            class="font-medium underline decoration-ember decoration-2 underline-offset-4 transition-colors hover:text-forest"
          >3754 N Higley Rd, Suite 2, Ogden, UT 84404</a>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════ CONDADOS ═══════════════════════ -->
<!-- Un condado por fila, no una rejilla de fichas. Cada uno es un bloque con
     su nombre en display, sus ciudades y una línea que dice por qué EC opera
     bien ahí — que es lo único que un buscador de "commercial landscaping
     [condado]" no encuentra en otro lado. -->
<section class="bg-sand">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">

    <div data-reveal class="bg-ink p-8 text-bone lg:p-12">
      <div class="grid gap-6 lg:grid-cols-[minmax(0,1.4fr)_minmax(0,1fr)] lg:items-end lg:gap-16">
        <h2 class="ec-shine ec-shine--light ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-bone sm:text-4xl">
          Four counties. <em>One crew, one contract.</em>
        </h2>
        <p class="text-base leading-relaxed text-bone/80">
          Multi-site owners get the same crew leads and the same documentation on every property, whichever county it sits in.
        </p>
      </div>
      <div class="ec-band ec-band--h mt-10 h-1.5 opacity-40" aria-hidden="true"></div>
    </div>

    <!-- Cada condado es una fila de dos módulos: texto y mapa, alternando de
         lado. Mismo patrón que las secciones de alcance de las páginas de
         capacidad. -->
    <div class="mt-px grid gap-px">
      <?php foreach ($counties as $ec_i => $c) :
        $ec_bg  = (0 === $ec_i % 2) ? 'bg-breeze-100' : 'bg-linen';
        $ec_izq = (0 === $ec_i % 2);

        $ec_embed = 'https://www.google.com/maps?q=' . rawurlencode($c['map']) . '&output=embed';
        $ec_href  = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($c['map']);

        $ec_texto = function () use ($c, $ec_bg, $ec_href) { ?>
          <div class="<?php echo esc_attr($ec_bg); ?> flex flex-col justify-center p-8 lg:p-12">
            <h3 class="font-display text-2xl font-bold leading-none tracking-tight text-ink sm:text-3xl">
              <?php echo esc_html($c['name']); ?>
            </h3>
            <p class="mt-4 text-[0.68rem] font-semibold uppercase tracking-[0.14em] text-ember-800">
              <?php echo esc_html($c['cities']); ?>
            </p>
            <p class="mt-6 text-base leading-relaxed text-ink/80">
              <?php echo esc_html($c['note']); ?>
            </p>
            <p class="mt-6">
              <a
                href="<?php echo esc_url($ec_href); ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="text-[0.68rem] font-semibold uppercase tracking-[0.14em] text-ink underline decoration-ember decoration-2 underline-offset-4 transition-colors hover:text-forest"
              >Open in Google Maps</a>
            </p>
          </div>
        <?php };

        /* ── El mapa ──
           El iframe va en absolute dentro de una celda con alto propio: así
           el espacio queda reservado antes de que cargue y la fila no salta
           cuando aparece.

           loading="lazy" es lo único que amortigua el costo. Con el mapa del
           patio esta página tiene CINCO embeds, y cada uno arrastra el
           JavaScript de Maps completo — pero lazy los difiere hasta que se
           acercan al viewport, así que la carga inicial solo paga el primero.

           Va con fondo ink debajo: es lo que se ve el instante previo y lo
           que queda si Maps no responde. */
        $ec_mapa = function () use ($c, $ec_embed) { ?>
          <div class="relative min-h-[15rem] bg-ink lg:min-h-[22rem]">
            <iframe
              src="<?php echo esc_url($ec_embed); ?>"
              title="<?php echo esc_attr('Map of ' . $c['name']); ?>"
              class="absolute inset-0 h-full w-full border-0"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              allowfullscreen
            ></iframe>
          </div>
        <?php };

        ?>
        <!-- El orden se invierte en el DOM y no con `order`: con `order` el
             lector de pantalla oiría el mapa antes que el nombre del condado
             al que pertenece. -->
        <div data-reveal class="grid gap-px lg:grid-cols-2">
          <?php if ($ec_izq) { $ec_texto(); $ec_mapa(); } else { $ec_mapa(); $ec_texto(); } ?>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="mt-px bg-ember p-8 lg:p-12">
      <p class="max-w-3xl text-base leading-relaxed text-ink">
        Not on the list? Call the yard —
        <a href="tel:+13852403907" class="font-semibold underline decoration-ink decoration-2 underline-offset-4">(385) 240-3907</a>.
        If the drive works, we will tell you. If it does not, we will tell you that too.
      </p>
    </div>
  </div>
</section>

<!-- ═══════════════════════ FAQ ═══════════════════════ -->
<section class="bg-bone">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="grid gap-10 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.6fr)] lg:gap-16">

      <!-- Encabezado pegajoso: el acordeón crece al abrirse y sin sticky el
           título se va de pantalla justo cuando se lee la respuesta más
           larga. self-start impide que la columna se estire y anule el
           sticky. -->
      <div data-reveal class="lg:sticky lg:top-[calc(var(--header-offset)+3rem)] lg:self-start">
        <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Coverage FAQ</p>
        <h2 class="ec-shine ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
          Questions that only come up <em>with a map open.</em>
        </h2>
      </div>

      <!-- <details> nativo: acordeón accesible sin una línea de JavaScript. -->
      <div>
        <?php foreach ($faqs as $faq) : ?>
          <details class="group border-b border-ink/15 first:border-t first:border-ink/15">
            <summary class="flex cursor-pointer list-none items-start justify-between gap-6 py-6 marker:content-none [&::-webkit-details-marker]:hidden">
              <span class="font-display text-lg font-bold leading-snug tracking-tight text-ink transition-colors group-hover:text-forest group-open:text-forest sm:text-xl">
                <?php echo esc_html($faq['q']); ?>
              </span>
              <!-- El signo gira 45° al abrir: el mismo glifo hace de más y de
                   cruz, así que el estado se lee sin cambiar de ícono. -->
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true" class="mt-1 h-4 w-4 shrink-0 text-ember-800 transition-transform duration-200 group-open:rotate-45 motion-reduce:transition-none">
                <path d="M12 5v14M5 12h14" />
              </svg>
            </summary>
            <p class="mb-6 border-l-2 border-ember pl-5 text-[0.95rem] leading-relaxed text-ink/80">
              <?php echo esc_html($faq['a']); ?>
            </p>
          </details>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════ CTA ═══════════════════════ -->
<section class="bg-umber text-bone">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-20">
    <div data-reveal class="grid gap-8 lg:grid-cols-[minmax(0,1.4fr)_minmax(0,1fr)] lg:items-center lg:gap-16">
      <div>
        <h2 class="ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-bone sm:text-4xl">
          Tell us where the site is. <em>We&rsquo;ll tell you when we can be there.</em>
        </h2>
        <p class="mt-5 max-w-2xl text-base leading-relaxed text-bone">
          A walkthrough, a line-item bid, and a schedule you can hand to your superintendent.
        </p>
      </div>

      <div class="flex lg:justify-end">
        <a
          href="<?php echo esc_url($bid_href); ?>"
          data-bid-cta
          class="cta-relief group inline-flex items-center gap-2.5 border-2 border-white/25 bg-ember py-4 pl-7 pr-6 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink transition-all duration-200 ease-out hover:cta-relief-tight hover:bg-ember-600 hover:-translate-y-px active:translate-y-0 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transform-none motion-reduce:transition-none"
        >
          Request a bid
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transform-none">
            <path d="M5 12h13M13 6l6 6-6 6" />
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>

<?php
/* Schema. areaServed con los cuatro condados, derivado del mismo array que
   pinta la página: una fuente, dos salidas, imposible que se desincronicen.

   Y FAQPage con las cuatro preguntas, que es el marcado que Google usa para
   los resultados enriquecidos. */
$ec_schema = array(
  '@context'   => 'https://schema.org',
  '@type'      => 'LandscapingBusiness',
  'name'       => 'EC Landscaping LLC',
  'url'        => home_url('/service-area'),
  'telephone'  => '+1-385-240-3907',
  'email'      => 'info@ecscaping.com',
  'address'    => array(
    '@type'           => 'PostalAddress',
    'streetAddress'   => '3754 N Higley Rd, Suite 2',
    'addressLocality' => 'Ogden',
    'addressRegion'   => 'UT',
    'postalCode'      => '84404',
    'addressCountry'  => 'US',
  ),
  'areaServed' => array_map(
    function ($c) {
      return array('@type' => 'AdministrativeArea', 'name' => $c['name'] . ', Utah');
    },
    $counties
  ),
);

$ec_faq_schema = array(
  '@context'   => 'https://schema.org',
  '@type'      => 'FAQPage',
  'mainEntity' => array_map(
    function ($faq) {
      return array(
        '@type'          => 'Question',
        'name'           => $faq['q'],
        'acceptedAnswer' => array('@type' => 'Answer', 'text' => $faq['a']),
      );
    },
    $faqs
  ),
);
?>
<script type="application/ld+json"><?php echo wp_json_encode($ec_schema); ?></script>
<script type="application/ld+json"><?php echo wp_json_encode($ec_faq_schema); ?></script>

<script>
  /* Destello de los titulares. La clase se pone al entrar en pantalla y se
     quita al salir: la animación va en bucle, y dejarla corriendo fuera del
     viewport repinta igual y se paga en batería. */
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

  /* Revelado por scroll. Si .ec-reveal no está en <html> no hay nada oculto
     que revelar y se sale de una. */
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
</script>

<?php get_footer(); ?>