<?php
/**
 * Template Name: Capabilities (índice)
 *
 * Slug esperado: /capabilities
 *
 * Índice de las cuatro capacidades. Cada una tiene su propia plantilla —
 * landscape-installation-template.php y compañía— así que esta página solo
 * lista y enlaza.
 *
 * Autocontenida como las demás: todo el markup y todo el copy están acá.
 *
 * El costo, anotado para cuando duela: el título y el lede de cada tarjeta
 * están también en su plantilla de detalle y en el carrusel de
 * home-template.php —tres copias del mismo texto del bloque 05—, y el proceso
 * de bid y la banda de cierre están repetidos en las cinco páginas de
 * capacidad.
 */

get_header();

$ec_uploads = wp_get_upload_dir();
$ec_media   = $ec_uploads['baseurl'] . '/2026/07/';

$ec_capabilities = array(
  array(
    'slug'  => 'landscape-installation',
    'title' => 'Commercial landscape installation',
    'lede'  => 'New construction, retail pads, branch sites, multifamily and industrial. Grading and soil preparation, irrigation mains and zones, planting, sod, trees and final grade to plan.',
    'image' => $ec_media . 'CommercialLandscapeInstallation-scaled.webp',
    'alt'   => 'Commercial landscape installation in progress on a Northern Utah site',
  ),
  array(
    'slug'  => 'hardscape-concrete',
    'title' => 'Hardscape & concrete',
    'lede'  => 'Retaining walls, paver plazas and walkways, flat and stamped concrete, curbing, site walls and pool decks — self-performed under our own concrete and masonry license.',
    'image' => $ec_media . 'HardscapeConcrete-scaled.webp',
    'alt'   => 'Retaining wall and paver hardscape under construction',
  ),
  array(
    'slug'  => 'grounds-maintenance',
    'title' => 'Grounds maintenance, irrigation & snow',
    'lede'  => 'Annual contracts covering mowing, fertilization, pruning, spring startup, smart irrigation management, fall winterization, and snow and ice management through the winter. One vendor, twelve months.',
    'image' => $ec_media . 'GroundsMaintenance-scaled.webp',
    'alt'   => 'Grounds maintenance on a commercial property',
  ),
  array(
    'slug'  => 'water-wise-retrofits',
    'title' => 'Water-wise retrofits',
    'lede'  => 'Turf conversion, drip and smart controllers, native and adapted plantings, and design that meets local water district requirements without looking like a gravel lot.',
    'image' => $ec_media . 'WaterWiseRetrofits-scaled.webp',
    'alt'   => 'Drought-tolerant planting with drip irrigation on a commercial property',
  ),
);

/* Proceso de bid. Repetido en las cinco páginas de capacidad, igual que la
   banda de cierre: es el precio de que cada página sea un archivo completo.
   Si Tomás confirma el plazo del paso 2 (Pendiente 08), son cinco archivos. */
$ec_process = array(
  array('n' => '1', 'title' => 'Walkthrough and takeoff', 'body' => 'We visit the site, review the plans and confirm scope with your PM or superintendent before we price anything.'),
  array('n' => '2', 'title' => 'Scoped bid',              'body' => 'A line-item proposal with quantities, exclusions and a schedule. No vague allowances that turn into change orders.'),
  array('n' => '3', 'title' => 'Preconstruction',         'body' => 'Submittals, certificates of insurance, W-9 and safety documentation delivered before mobilization, in the format your office needs them.'),
  array('n' => '4', 'title' => 'Self-performed execution','body' => 'Our crew, our equipment, one point of contact and weekly photo updates from the site.'),
  array('n' => '5', 'title' => 'Closeout and handoff',    'body' => 'Punch list walkthrough, warranty terms in writing, and an optional maintenance contract that starts the day we finish.'),
);
?>

<section class="bg-bone">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="max-w-3xl">
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Capabilities</p>
      <h1 class="ec-shine font-display text-4xl leading-[1.08] font-bold tracking-tight text-ink sm:text-5xl">
        What we self-perform.
      </h1>
      <p class="mt-6 text-lg leading-relaxed text-ink/70">
        Most landscape contractors in this corridor subcontract the heavy work and manage it from a truck. We hold the license, own the equipment and put our own people on your site.
      </p>
    </div>

    <!-- ── Marquee ───────────────────────────────────────────────────
         Mismo patrón que el carrusel de capacidades de la landing: scroll
         nativo con desplazamiento continuo empujado por JS, no una animación
         de transform. Esa diferencia es la que deja que el dedo, la rueda y
         el teclado sigan operando la pista mientras se mueve — y acá pesa más
         que en la home, porque estas tarjetas son enlaces: hay que poder
         apuntarles y hacer clic.

         El bucle es infinito porque la lista se imprime dos veces. Al llegar
         a la mitad del recorrido se resta esa mitad de scrollLeft: el
         contenido en pantalla es idéntico, así que el salto no se ve.

         El script va al final de esta plantilla. Es el mismo de
         home-template.php, repetido acá porque cada página es un archivo
         completo. -->
    <div data-carousel data-marquee class="mt-14">

      <div class="mb-6 flex items-end justify-between gap-6">
        <p class="max-w-md text-xs leading-relaxed text-ink/50">
          Four scopes, one contract, one crew.
        </p>

        <div class="hidden shrink-0 items-center gap-2 lg:flex">
          <button
            type="button"
            data-carousel-prev
            aria-label="Previous capability"
            class="flex h-11 w-11 items-center justify-center rounded-full border border-ink/15 text-ink transition-[box-shadow,background-color] duration-200 hover:bg-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transition-none"
          >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="h-4 w-4">
              <path d="M19 12H6M11 6l-6 6 6 6" />
            </svg>
          </button>
          <button
            type="button"
            data-carousel-next
            aria-label="Next capability"
            class="flex h-11 w-11 items-center justify-center rounded-full border border-ink/15 text-ink transition-[box-shadow,background-color] duration-200 hover:bg-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transition-none"
          >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="h-4 w-4">
              <path d="M5 12h13M13 6l6 6-6 6" />
            </svg>
          </button>
        </div>
      </div>

      <!-- La pista sangra hasta el borde de la pantalla con márgenes negativos
           y recupera la alineación con su propio padding: la tarjeta que asoma
           se corta contra el borde del viewport, que es lo que hace legible
           que hay más a la derecha.

           Sin scroll-snap ni scroll-smooth: los dos pelean con un scrollLeft
           que se reescribe en cada frame. -->
      <ul
        data-carousel-track
        tabindex="0"
        aria-label="Capabilities"
        class="-mx-5 flex gap-5 overflow-x-auto px-5 pb-2 [scrollbar-width:none] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember sm:-mx-8 sm:px-8 lg:-mx-10 lg:px-10 [&::-webkit-scrollbar]:hidden"
      >
        <?php
        /* Dos pasadas: la real y su copia. La copia va aria-hidden y con alt
           vacío — para un lector de pantalla las capacidades son cuatro, no
           ocho, y sus enlaces no se anuncian dos veces. El navegador reusa las
           mismas imágenes de caché, así que duplicar no cuesta descargas. */
        for ($ec_pass = 0; $ec_pass < 2; $ec_pass++) :
          $ec_clone = (1 === $ec_pass);
          foreach ($ec_capabilities as $item) : ?>
            <li
              class="w-[80vw] shrink-0 sm:w-[23rem] lg:w-[25rem]"
              <?php echo $ec_clone ? 'aria-hidden="true"' : ''; ?>
            >
              <a
                href="<?php echo esc_url(home_url('/' . $item['slug'])); ?>"
                <?php echo $ec_clone ? 'tabindex="-1"' : ''; ?>
                class="group flex h-full flex-col overflow-hidden rounded-lg bg-white ring-1 ring-ink/10 transition-shadow duration-300 hover:shadow-xl hover:shadow-ink/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transition-none"
              >
                <img
                  src="<?php echo esc_url($item['image']); ?>"
                  alt="<?php echo $ec_clone ? '' : esc_attr($item['alt']); ?>"
                  class="aspect-[4/3] w-full object-cover"
                  loading="lazy"
                  decoding="async"
                />
                <div class="flex flex-1 flex-col border-t-2 border-forest p-7">
                  <h2 class="font-display text-xl font-bold tracking-tight text-ink group-hover:text-forest">
                    <?php echo esc_html($item['title']); ?>
                  </h2>
                  <p class="mt-3 text-sm leading-relaxed text-ink/70">
                    <?php echo esc_html($item['lede']); ?>
                  </p>
                  <span class="mt-5 text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ember">
                    View capability <span aria-hidden="true">&rarr;</span>
                  </span>
                </div>
              </a>
            </li>
          <?php endforeach;
        endfor; ?>
      </ul>
    </div>

  </div>
</section>

<script>
  (function () {
    /* Marquee: desplazamiento continuo sobre un contenedor con scroll nativo.
       El JS empuja scrollLeft frame a frame en vez de animar un transform, y
       esa es la diferencia que importa: el dedo, la rueda y el teclado siguen
       operando la pista mientras se mueve.

       Genérico por [data-carousel]: sirve para cualquier otro bloque que
       quiera el mismo patrón sin tocar este código. */
    var carousels = document.querySelectorAll('[data-carousel]');
    if (!carousels.length) return;

    var mqReduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)');

    Array.prototype.forEach.call(carousels, function (root) {
      var track = root.querySelector('[data-carousel-track]');
      if (!track) return;

      var prev = root.querySelector('[data-carousel-prev]');
      var next = root.querySelector('[data-carousel-next]');

      /* Un "paso" es el ancho de una tarjeta más el gap. Se mide en vivo y no
         se guarda: el ancho es responsive (80vw / 23rem / 25rem) y guardarlo
         dejaría el paso desfasado al rotar el teléfono o redimensionar. */
      function step() {
        var first = track.firstElementChild;
        if (!first) return track.clientWidth;
        var second = first.nextElementSibling;
        return second
          ? second.getBoundingClientRect().left - first.getBoundingClientRect().left
          : first.getBoundingClientRect().width;
      }

      var isMarquee = root.hasAttribute('data-marquee');

      /* Ancho de un ciclo: la distancia entre la primera tarjeta y su clon.
         Antes esto era scrollWidth/2, y estaba mal — scrollWidth incluye el
         padding lateral de la pista, así que la mitad no cae en el clon sino
         unos píxeles antes y el bucle se iba corriendo en cada vuelta.

         Se cachea porque offsetLeft fuerza layout y esto se consulta en cada
         frame. Se invalida al redimensionar y al terminar de cargar. */
      var cycle = 0;

      function cycleWidth() {
        if (!isMarquee) return 0;
        if (cycle) return cycle;
        var items = track.children;
        var count = Math.floor(items.length / 2);
        if (count < 1) return 0;
        cycle = items[count].offsetLeft - items[0].offsetLeft;
        return cycle;
      }

      window.addEventListener('resize', function () { cycle = 0; }, { passive: true });
      window.addEventListener('load', function () { cycle = 0; });

      function normalize() {
        var c = cycleWidth();
        if (c > 0 && track.scrollLeft >= c) track.scrollLeft -= c;
      }

      /* Ida y vuelta con las flechas. Antes de retroceder desde el arranque se
         salta al clon: sin esto el navegador topa en 0 y la flecha izquierda
         se siente muerta durante el primer ciclo. */
      function nudge(dir) {
        var c = cycleWidth();
        if (dir < 0 && c > 0 && track.scrollLeft < step()) track.scrollLeft += c;
        track.scrollBy({ left: dir * step(), behavior: 'smooth' });
      }

      if (prev) prev.addEventListener('click', function () { nudge(-1); });
      if (next) next.addEventListener('click', function () { nudge(1); });

      track.addEventListener('scroll', normalize, { passive: true });

      // Sin marquee, queda un carrusel manual y esto termina aquí.
      if (!isMarquee) return;

      /* Velocidad en px/s y no en px/frame: a 120 Hz un incremento fijo por
         frame corre al doble. */
      var SPEED = 26;
      var paused = false;
      var resumeTimer = null;
      var last = null;
      var frame = null;

      function pause() {
        paused = true;
        if (resumeTimer) window.clearTimeout(resumeTimer);
      }

      /* La reanudación es diferida: si se retoma apenas se suelta el dedo, el
         movimiento arranca encima del gesto y se lee como un tirón. */
      function resumeSoon(delay) {
        if (resumeTimer) window.clearTimeout(resumeTimer);
        resumeTimer = window.setTimeout(function () {
          paused = false;
          last = null;
        }, delay || 1200);
      }

      // Pausa mientras se lee o se manipula. Un marquee que no se detiene al
      // pasar el mouse obliga a perseguir el texto para terminar de leerlo.
      root.addEventListener('mouseenter', pause);
      root.addEventListener('mouseleave', function () { resumeSoon(300); });
      root.addEventListener('focusin', pause);
      root.addEventListener('focusout', function () { resumeSoon(600); });
      track.addEventListener('pointerdown', pause);
      track.addEventListener('wheel', function () { pause(); resumeSoon(); }, { passive: true });
      track.addEventListener('touchstart', pause, { passive: true });
      track.addEventListener('touchend', function () { resumeSoon(); }, { passive: true });
      window.addEventListener('pointerup', function () { if (paused) resumeSoon(); });

      // Fuera de pantalla no hay nada que animar: sin esto el rAF sigue
      // corriendo toda la página y se nota en batería.
      var onScreen = true;
      if ('IntersectionObserver' in window) {
        new IntersectionObserver(function (entries) {
          onScreen = entries[0].isIntersecting;
        }, { threshold: 0 }).observe(root);
      }

      /* Posición en punto flotante propia. Este es el arreglo del marquee que
         no se movía: a 26 px/s cada frame avanza ~0.43 px, y varios motores
         redondean scrollLeft a entero al escribirlo. Con `scrollLeft += 0.43`
         el valor volvía al mismo entero una y otra vez y el resultado neto
         era cero — no lento, quieto.

         Llevando el acumulador aparte, la fracción sobrevive entre frames y
         solo se pierde al pintar. Se resincroniza en cada reanudación, que es
         lo que mantiene coherente la posición después de un gesto manual. */
      var pos = track.scrollLeft;

      function tick(now) {
        frame = window.requestAnimationFrame(tick);
        if (paused || !onScreen || document.hidden) { last = now; return; }
        if (last === null) { last = now; pos = track.scrollLeft; return; }
        // Se descarta cualquier salto mayor a 100 ms (pestaña en segundo
        // plano): de lo contrario el marquee reaparece varios ciclos adelante.
        var dt = Math.min(now - last, 100);
        last = now;

        var c = cycleWidth();
        pos += (SPEED * dt) / 1000;
        if (c > 0 && pos >= c) pos -= c;
        track.scrollLeft = pos;
      }

      function enable() {
        if (frame) return;
        last = null;
        frame = window.requestAnimationFrame(tick);
      }

      function disable() {
        if (!frame) return;
        window.cancelAnimationFrame(frame);
        frame = null;
      }

      /* prefers-reduced-motion se consulta en vivo, no solo al cargar: si se
         activa desde el sistema con la página abierta, el marquee para. */
      function applyMotionPreference() {
        if (mqReduce && mqReduce.matches) disable();
        else enable();
      }

      if (mqReduce) {
        if (mqReduce.addEventListener) mqReduce.addEventListener('change', applyMotionPreference);
        else if (mqReduce.addListener) mqReduce.addListener(applyMotionPreference);
      }

      applyMotionPreference();
    });
  })();
</script>

<!-- ═══════════════════════ PROCESO ═══════════════════════ -->
<section class="bg-white">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <h2 class="ec-shine max-w-3xl font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
      How a bid becomes a finished site.
    </h2>

    <ol class="mt-12 flex flex-col">
      <?php foreach ($ec_process as $step) : ?>
        <li class="grid gap-4 border-t border-ink/10 py-7 sm:grid-cols-[4rem_minmax(0,16rem)_minmax(0,1fr)] sm:gap-8">
          <span class="font-display text-2xl font-bold tracking-tight text-ember tabular-nums">
            <?php echo esc_html($step['n']); ?>
          </span>
          <h3 class="font-display text-lg font-bold tracking-tight text-ink">
            <?php echo esc_html($step['title']); ?>
          </h3>
          <p class="text-sm leading-relaxed text-ink/70">
            <?php echo esc_html($step['body']); ?>
          </p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<!-- ═══════════════════════ CTA ═══════════════════════ -->
<section class="bg-ink text-bone">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-20">
    <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
      <div>
        <h2 class="ec-shine ec-shine--light font-display text-3xl leading-tight font-bold tracking-tight text-bone sm:text-4xl">
          Send us the plans.
        </h2>
        <p class="mt-4 max-w-lg text-base leading-relaxed text-bone/75">
          You&rsquo;ll hear back from the owner or the estimator &mdash; not a call center.
        </p>
      </div>

      <div class="flex flex-wrap items-center gap-6">
        <a
          href="<?php echo esc_url(home_url('/contact')); ?>"
          data-bid-cta
          class="cta-relief group inline-flex items-center gap-2.5 rounded-full border-2 border-white/25 bg-ember py-4 pl-7 pr-6 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink transition-all duration-200 ease-out hover:cta-relief-tight hover:bg-ember-600 hover:-translate-y-px active:translate-y-0 active:shadow-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transform-none motion-reduce:transition-none"
        >
          Request a bid
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transform-none">
            <path d="M5 12h13M13 6l6 6-6 6" />
          </svg>
        </a>
        <a href="tel:+13852403907" class="text-lg font-semibold tabular-nums text-bone underline decoration-ember decoration-2 underline-offset-8 transition-colors hover:text-white">
          (385) 240-3907
        </a>
      </div>
    </div>
  </div>
</section>

<?php
/* Contenido del editor, si la página tiene algo escrito. */
if (have_posts()) :
  while (have_posts()) : the_post();
    if (trim(get_the_content()) === '') continue; ?>
    <section class="bg-white">
      <div class="prose w-full max-w-3xl px-5 py-16 text-ink/80 sm:px-8 lg:px-10">
        <?php the_content(); ?>
      </div>
    </section>
  <?php endwhile;
endif;

get_footer(); ?>