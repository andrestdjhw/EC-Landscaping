<?php
/**
 * Template Name: Capacidad · Water-Wise Retrofits
 *
 * Página de capacidad. Slug esperado: /water-wise-retrofits
 *
 * Autocontenida a propósito: todo el markup y todo el copy de esta página
 * están en este archivo. Para cambiar cualquier cosa de esta capacidad no
 * hace falta abrir ningún otro.
 *
 * El precio de eso es que el proceso de bid, la banda de cierre y el enlazado
 * cruzado están repetidos en las cinco páginas de capacidad. Si se corrige uno
 * —por ejemplo cuando Tomás confirme el plazo del paso 2, Pendiente 08— hay
 * que corregir los cinco. Está dicho acá para que no sorprenda.
 *
 * Lo mismo con el título y el lede: también viven en capabilities-template.php
 * y en el carrusel de home-template.php. Tres copias del mismo texto del
 * bloque 05.
 *
 * SIN APROBAR: las viñetas de alcance son el párrafo del deck partido en
 * puntos —no hay afirmaciones nuevas, pero el troceado es propio—, y las
 * etiquetas de "Built for" son asignación propia. Las dos cosas necesitan el
 * visto bueno de Eunice antes de publicar.
 */

get_header();

$ec_uploads = wp_get_upload_dir();
$ec_media   = $ec_uploads['baseurl'] . '/2026/07/';

$ec_title = 'Water-wise retrofits';
$ec_lede  = 'Turf conversion, drip and smart controllers, native and adapted plantings, and design that meets local water district requirements without looking like a gravel lot.';
$ec_image = $ec_media . 'WaterWiseRetrofits-scaled.webp';
$ec_alt   = 'Drought-tolerant planting with drip irrigation on a commercial property';

/* ═════════════════════════════════════════════════════════════════
   IMÁGENES DE LAS TARJETAS DE ALCANCE

   Una variable por tarjeta, para cambiar una foto sin buscarla entre el
   markup. Se arman desde $ec_media_scope y no con la URL pegada entera:
   así sobreviven la migración de ec-landscaping.local a producción.

   Vaciar cualquiera de estas cadenas deja esa tarjeta solo con texto — la
   sección no se rompe.
   ═════════════════════════════════════════════════════════════════ */

// Carpeta de la biblioteca donde se subieron. Ajustar el mes si va a otra.
$ec_media_scope = $ec_uploads['baseurl'] . '/2026/08/';

// Prompt: "turf removal xeriscape conversion landscaping"
$ec_img_turf        = '';

// Prompt: "drip irrigation tubing garden bed installation"
$ec_img_drip        = '';

// Prompt: "smart irrigation controller wall mounted"
$ec_img_controllers = '';

// Prompt: "drought tolerant native plants commercial landscape"
$ec_img_natives     = '';

// Prompt: "landscape architect plans blueprint site"
$ec_img_design      = '';


/* ─────────────────────────────────────────────────────────────────
   ALCANCE — título, cuerpo e imagen por tarjeta.

   Cinco tarjetas y no cuatro: el lede del bloque 05 dice "drip and smart
   controllers", que son dos cosas distintas —tubería enterrada y un
   aparato en la pared— y las junté en un solo punto cuando partí el
   párrafo. Separarlas no agrega nada al alcance, solo deja de esconder
   una dentro de otra. Y de paso el mazo apilado deja de verse chato, que
   con cuatro tarjetas era el otro problema.

   Los cuerpos son copy nuevo y ninguno pasó por Eunice. Sin porcentajes
   de ahorro de agua, sin montos de rebate y sin nombrar al distrito: el
   Pendiente 06 sigue sin verificar y esas cifras no se publican hasta que
   Weber Basin las confirme.
   ───────────────────────────────────────────────────────────────── */
$ec_scope = array(
  array(
    'title' => 'Turf conversion',
    'body'  => 'Taking out the grass nobody walks on and replacing it with planting that still reads as landscape. The savings come from the area you convert, not from letting the rest go brown.',
    'image' => $ec_img_turf,
    'alt'   => 'Turf being removed and replaced with drought-tolerant planting',
  ),
  array(
    'title' => 'Drip irrigation',
    'body'  => 'Water delivered at the root instead of thrown through the air, where an August afternoon in this corridor takes its share before it ever lands.',
    'image' => $ec_img_drip,
    'alt'   => 'Drip irrigation tubing and emitters in a planting bed',
  ),
  array(
    'title' => 'Smart controllers',
    'body'  => 'Controllers that adjust to the weather instead of running the same program in May and in September, and that a property manager can check without walking the site.',
    'image' => $ec_img_controllers,
    'alt'   => 'Wall-mounted smart irrigation controller',
  ),
  array(
    'title' => 'Native and adapted plantings',
    'body'  => 'Species that survive a Weber County winter and an August with no rain, chosen so the property still looks maintained in the shoulder seasons and not just in June.',
    'image' => $ec_img_natives,
    'alt'   => 'Drought-tolerant native planting at a commercial property',
  ),
  array(
    'title' => 'Design to local water district requirements',
    'body'  => 'Every district in the corridor sets its own rules. We design to the ones that apply to your site from the start, so the plan does not come back for a second round of revisions.',
    'image' => $ec_img_design,
    'alt'   => 'Landscape plans being reviewed on site',
  ),
);

$ec_built_for = array(
  'Property managers',
  'HOA boards',
  'Institutional & multi-site owners',
);

$ec_process = array(
  array('n' => '1', 'title' => 'Walkthrough and takeoff', 'body' => 'We visit the site, review the plans and confirm scope with your PM or superintendent before we price anything.'),
  array('n' => '2', 'title' => 'Scoped bid', 'body' => 'A line-item proposal with quantities, exclusions and a schedule. No vague allowances that turn into change orders.'),
  array('n' => '3', 'title' => 'Preconstruction', 'body' => 'Submittals, certificates of insurance, W-9 and safety documentation delivered before mobilization, in the format your office needs them.'),
  array('n' => '4', 'title' => 'Self-performed execution', 'body' => 'Our crew, our equipment, one point of contact and weekly photo updates from the site.'),
  array('n' => '5', 'title' => 'Closeout and handoff', 'body' => 'Punch list walkthrough, warranty terms in writing, and an optional maintenance contract that starts the day we finish.'),
);

/* Enlazado cruzado a las otras tres capacidades. Escrito a mano acá: si se
   agrega una cuarta, hay que sumarla en las cinco plantillas. */
$ec_others = array(
  array('slug' => 'landscape-installation', 'title' => 'Commercial landscape installation'),
  array('slug' => 'hardscape-concrete', 'title' => 'Hardscape & concrete'),
  array('slug' => 'grounds-maintenance', 'title' => 'Grounds maintenance, irrigation & snow'),
);

$ec_bid_href = home_url('/contact');
$ec_tel_href = 'tel:+13852403907';
?>

<!-- ═══════════════════════ HERO ═══════════════════════ -->
<!-- Imagen a sangre detrás de toda la sección, igual que el hero de la
     landing — pero al revés: allá el texto va oscuro sobre claro y acá va
     claro sobre oscuro.

     El motivo es que las cuatro fotos son distintas y ninguna está pensada
     como fondo. Un scrim claro tendría que ganarle a un cielo blanco en una
     y a tierra oscura en otra; un velo oscuro funciona con las cuatro sin
     depender de qué salga en el encuadre.

     bg-sand debajo de la imagen: es lo que se ve el instante previo a que
     cargue, y lo que queda si la ruta se rompe en la migración. Un hero que
     falla en oscuro se lee como decisión; en blanco se lee como error. -->
<section class="relative isolate overflow-hidden bg-sand text-bone">

  <img
    src="<?php echo esc_url($ec_image); ?>"
    alt="<?php echo esc_attr($ec_alt); ?>"
    class="absolute inset-0 -z-20 h-full w-full object-cover"
    loading="eager"
    fetchpriority="high"
    decoding="async"
  />

  <!-- Dos scrims, uno por ancho de pantalla.

       En móvil el texto ocupa todo el ancho, así que el velo tiene que ser
       parejo: un gradiente lateral dejaría la última palabra de cada línea
       sobre la foto pelada.

       Desde lg el texto vive en una columna a la izquierda, así que el velo
       se abre hacia la derecha y deja ver la foto. Es el mismo truco del
       hero de la landing, con los valores invertidos.

       Gradiente explícito y no utilidad de Tailwind: bg-gradient-* se
       renombró a bg-linear-* en v4 y no conviene depender de eso acá. -->
  <div class="absolute inset-0 -z-10 bg-[linear-gradient(180deg,rgba(13,15,16,0.80)_0%,rgba(13,15,16,0.86)_100%)] lg:hidden" aria-hidden="true"></div>
  <div class="absolute inset-0 -z-10 hidden bg-[linear-gradient(100deg,rgba(13,15,16,0.94)_0%,rgba(13,15,16,0.88)_38%,rgba(13,15,16,0.62)_66%,rgba(13,15,16,0.38)_100%)] lg:block" aria-hidden="true"></div>

  <div class="relative flex min-h-[28rem] w-full items-center px-5 pb-16 pt-[calc(var(--header-offset)+2rem)] sm:px-8 lg:min-h-[34rem] lg:px-10 lg:pb-24 lg:pt-[calc(var(--header-offset)+3rem)]">
    <div class="max-w-2xl">
      <!-- Salida al índice. Dos niveles no justifican markup de navegación,
           pero sí hace falta la vuelta para quien llega desde una búsqueda.
           En ember-300 y no en ember ni en forest: el verde de la sierra
           desaparece sobre el velo, y el ember base se queda en 2.4:1 contra
           una foto de cielo blanco. Un scrim protege al titular, no a una
           línea de 0.68rem. -->
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300">
        <a href="<?php echo esc_url(home_url('/capabilities')); ?>" class="transition-colors hover:text-bone">Capabilities</a>
      </p>

      <h1 class="ec-shine ec-shine--light font-display text-4xl leading-[1.08] font-bold tracking-tight text-bone sm:text-5xl">
        <?php echo esc_html($ec_title); ?>
      </h1>

      <p class="mt-6 text-lg leading-relaxed text-bone/80">
        <?php echo esc_html($ec_lede); ?>
      </p>

      <div class="mt-9">
        <a
          href="<?php echo esc_url($ec_bid_href); ?>"
          data-bid-cta
          class="cta-relief group inline-flex items-center gap-2.5 rounded-full border-2 border-white/25 bg-ember py-4 pl-7 pr-6 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink transition-all duration-200 ease-out hover:cta-relief-tight hover:bg-ember-600 hover:-translate-y-px active:translate-y-0 active:shadow-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transform-none motion-reduce:transition-none"
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

<!-- ═══════════════════════ ALCANCE ═══════════════════════ -->
<!-- Rejilla de puntos reactiva de fondo. Es puramente decorativa: va
     aria-hidden y pointer-events-none, así que ni el lector de pantalla ni
     los clics la ven. El texto y la lista van encima, sin depender de ella.

     Los colores salen de la paleta y se pasan por data-*, no se escriben en
     el JS: así el script queda genérico y el mismo bloque sirve en otra
     sección con otro fondo. -->
<section class="relative isolate overflow-hidden bg-breeze-200">

  <div
    data-dotgrid
    data-dot-size="3"
    data-gap="26"
    data-proximity="150"
    data-shock-radius="230"
    data-base="#B9BAB3"
    data-active="#A36C48"
    class="pointer-events-none absolute inset-0 -z-10"
    aria-hidden="true"
  ><canvas class="h-full w-full"></canvas></div>

  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="grid gap-12 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.4fr)] lg:gap-16">
      <div>
        <h2 class="ec-shine font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
          What&rsquo;s in scope.
        </h2>
        <p class="mt-5 text-base leading-relaxed text-ink/70">
          Self-performed with our own crew and our own equipment, from the turf removal to the controller on the wall.
        </p>

        <!-- Cierre de columna. Ancla la sección con una afirmación en lugar de
             dejar la última línea colgando de lo que mida la lista. -->
        <p class="mt-10 border-l-2 border-ember pl-5 text-sm leading-relaxed text-ink/70">
          Water-wise does not have to mean a gravel lot. Every conversion we build is still meant to read as a landscape.
        </p>
      </div>

      <!-- Mejora progresiva, no un componente.

           Lo que sale del servidor es la lista de alcance completa, en una
           rejilla legible de un vistazo. El JS la convierte en un stack de
           tarjetas 3D solo si el navegador puede: con puntero fino, sin
           prefers-reduced-motion y con JS corriendo. En cualquier otro caso
           se queda la rejilla, que es la que un estimador vino a leer.

           Ese orden importa acá más que en un carrusel decorativo: un stack
           muestra un ítem a la vez, y "¿hacen concreto estampado?" es
           exactamente la pregunta que trae a esta página.

           El JS no usa clases de Tailwind para el modo apilado — aplica
           estilos en línea. Así el efecto no depende de que una clase nueva
           haya entrado al build. -->
      <div data-cardswap data-delay="4200" data-dist-x="42" data-dist-y="38" data-skew="6">
        <ul class="grid gap-px self-start bg-slate-200 sm:grid-cols-2" data-cardswap-list>
          <?php foreach ($ec_scope as $item) : ?>
            <li class="flex flex-col overflow-hidden bg-breeze-100" data-cardswap-card>
              <?php if (!empty($item['image'])) : ?>
                <!-- 16/9 y no 4/3: la tarjeta ya lleva título y dos líneas de
                     cuerpo, y con una imagen más alta el stack apilado supera
                     el alto de la pantalla. -->
                <img
                  src="<?php echo esc_url($item['image']); ?>"
                  alt="<?php echo esc_attr($item['alt']); ?>"
                  class="aspect-[16/9] w-full shrink-0 object-cover"
                  loading="lazy"
                  decoding="async"
                  data-cardswap-media
                />
              <?php endif; ?>

              <div class="flex flex-1 items-start gap-4 px-6 py-6" data-cardswap-content>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="mt-1 h-4 w-4 shrink-0 text-ember">
                  <path d="m5 13 4 4L19 7" />
                </svg>
                <div>
                  <h3 class="font-display text-base font-bold leading-snug tracking-tight text-ink" data-cardswap-title>
                    <?php echo esc_html($item['title']); ?>
                  </h3>
                  <p class="mt-2 text-sm leading-relaxed text-ink/70" data-cardswap-body>
                    <?php echo esc_html($item['body']); ?>
                  </p>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════ PARA QUIÉN ═══════════════════════ -->
<section class="bg-slate-100">
  <div class="w-full px-5 py-14 sm:px-8 lg:px-10 lg:py-16">
    <h2 class="mb-6 text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ink/50">Built for</h2>
    <ul class="flex flex-wrap gap-2">
      <?php foreach ($ec_built_for as $buyer) : ?>
        <li class="rounded-full border border-ember-300 bg-ember-100 px-4 py-2 text-sm text-ink">
          <?php echo esc_html($buyer); ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- ═══════════════════════ PROCESO ═══════════════════════ -->
<section class="bg-breeze-100">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <h2 class="ec-shine max-w-3xl font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
      How a bid becomes a finished site.
    </h2>

    <ol class="mt-12 flex flex-col">
      <?php foreach ($ec_process as $step) : ?>
        <li class="grid gap-4 border-t border-slate-200 py-7 sm:grid-cols-[4rem_minmax(0,16rem)_minmax(0,1fr)] sm:gap-8">
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

<!-- ═══════════════ OTRAS CAPACIDADES ═══════════════ -->
<section class="bg-bone">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-20">
    <h2 class="mb-8 text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ink/50">Also self-performed</h2>
    <ul class="grid gap-px bg-slate-200 sm:grid-cols-3">
      <?php foreach ($ec_others as $other) : ?>
        <li class="bg-bone">
          <a
            href="<?php echo esc_url(home_url('/' . $other['slug'])); ?>"
            class="group flex h-full flex-col p-7 transition-colors hover:bg-breeze-100 focus-visible:outline-2 focus-visible:outline-offset-[-2px] focus-visible:outline-ember"
          >
            <h3 class="font-display text-lg font-bold tracking-tight text-ink group-hover:text-forest">
              <?php echo esc_html($other['title']); ?>
            </h3>
            <span class="mt-3 text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ember">
              View <span aria-hidden="true">&rarr;</span>
            </span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- ═══════════════════════ CTA ═══════════════════════ -->
<section class="bg-umber text-bone">
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
          href="<?php echo esc_url($ec_bid_href); ?>"
          data-bid-cta
          class="cta-relief group inline-flex items-center gap-2.5 rounded-full border-2 border-white/25 bg-ember py-4 pl-7 pr-6 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink transition-all duration-200 ease-out hover:cta-relief-tight hover:bg-ember-600 hover:-translate-y-px active:translate-y-0 active:shadow-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transform-none motion-reduce:transition-none"
        >
          Request a bid
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transform-none">
            <path d="M5 12h13M13 6l6 6-6 6" />
          </svg>
        </a>
        <a href="<?php echo esc_url($ec_tel_href); ?>" class="text-lg font-semibold tabular-nums text-bone underline decoration-ember decoration-2 underline-offset-8 transition-colors hover:text-white">
          (385) 240-3907
        </a>
      </div>
    </div>
  </div>
</section>


<script>
  /* Rejilla de puntos reactiva — canvas plano, sin dependencias.
     Inspirada en el DotGrid de Vue Bits, reimplementada por dos razones:
     ese componente es Vue y este tema es React, y arrastra GSAP más
     InertiaPlugin para lo único que hace falta de verdad, que es un
     resorte amortiguado. Eso son treinta líneas.

     El resorte: cada punto guarda su desplazamiento (ox, oy) y su velocidad.
     En cada frame se le aplica una fuerza proporcional al desplazamiento y
     contraria a él —eso lo devuelve al origen— más un rozamiento
     proporcional a la velocidad, que impide que oscile para siempre. Subir
     RESORTE lo hace más rígido; subir ROCE lo frena antes. */
  (function () {
    var roots = document.querySelectorAll('[data-dotgrid]');
    if (!roots.length) return;

    var mq = window.matchMedia;
    /* Sin puntero fino no hay efecto que mostrar: en táctil los puntos
       quedarían quietos y el canvas gastaría batería dibujando lo mismo. */
    if (mq && !mq('(hover: hover) and (pointer: fine)').matches) return;
    if (mq && mq('(prefers-reduced-motion: reduce)').matches) return;

    var RESORTE = 0.10;
    var ROCE    = 0.86;

    function hexRgb(h) {
      var m = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(h);
      return m ? [parseInt(m[1],16), parseInt(m[2],16), parseInt(m[3],16)] : [0,0,0];
    }

    Array.prototype.forEach.call(roots, function (root) {
      var canvas = root.querySelector('canvas');
      if (!canvas || !canvas.getContext) return;
      var ctx = canvas.getContext('2d');

      var size  = parseFloat(root.dataset.dotSize) || 3;
      var gap   = parseFloat(root.dataset.gap) || 26;
      var prox  = parseFloat(root.dataset.proximity) || 150;
      var shock = parseFloat(root.dataset.shockRadius) || 230;
      var base  = hexRgb(root.dataset.base || '#B9BAB3');
      var act   = hexRgb(root.dataset.active || '#A36C48');

      var dots = [];
      var px = -9999, py = -9999;
      var frame = null, visible = false;

      function construir() {
        var r = root.getBoundingClientRect();
        if (!r.width || !r.height) return;
        var dpr = window.devicePixelRatio || 1;
        canvas.width  = Math.round(r.width * dpr);
        canvas.height = Math.round(r.height * dpr);
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

        var celda = size + gap;
        var cols = Math.floor((r.width  + gap) / celda);
        var rows = Math.floor((r.height + gap) / celda);
        var x0 = (r.width  - (celda * cols - gap)) / 2 + size / 2;
        var y0 = (r.height - (celda * rows - gap)) / 2 + size / 2;

        dots = [];
        for (var y = 0; y < rows; y++) {
          for (var x = 0; x < cols; x++) {
            dots.push({ cx: x0 + x * celda, cy: y0 + y * celda, ox: 0, oy: 0, vx: 0, vy: 0 });
          }
        }
      }

      function pintar() {
        frame = visible ? window.requestAnimationFrame(pintar) : null;

        var r = canvas.getBoundingClientRect();
        ctx.clearRect(0, 0, r.width, r.height);
        var proxSq = prox * prox;

        for (var i = 0; i < dots.length; i++) {
          var d = dots[i];

          /* Resorte amortiguado hacia el origen. Se salta el cálculo cuando
             el punto ya está quieto: en una rejilla de cientos de puntos,
             la mayoría lo está en cualquier frame dado. */
          if (d.ox || d.oy || d.vx || d.vy) {
            d.vx = (d.vx - d.ox * RESORTE) * ROCE;
            d.vy = (d.vy - d.oy * RESORTE) * ROCE;
            d.ox += d.vx;
            d.oy += d.vy;
            if (Math.abs(d.ox) < 0.05 && Math.abs(d.oy) < 0.05 &&
                Math.abs(d.vx) < 0.05 && Math.abs(d.vy) < 0.05) {
              d.ox = d.oy = d.vx = d.vy = 0;
            }
          }

          var dx = d.cx - px, dy = d.cy - py;
          var dsq = dx * dx + dy * dy;

          if (dsq <= proxSq) {
            var t = 1 - Math.sqrt(dsq) / prox;
            ctx.fillStyle = 'rgb(' +
              Math.round(base[0] + (act[0] - base[0]) * t) + ',' +
              Math.round(base[1] + (act[1] - base[1]) * t) + ',' +
              Math.round(base[2] + (act[2] - base[2]) * t) + ')';
          } else {
            ctx.fillStyle = root.dataset.base || '#B9BAB3';
          }

          ctx.beginPath();
          ctx.arc(d.cx + d.ox, d.cy + d.oy, size / 2, 0, 6.283185);
          ctx.fill();
        }
      }

      function mover(e) {
        var r = canvas.getBoundingClientRect();
        px = e.clientX - r.left;
        py = e.clientY - r.top;
      }

      /* Onda de choque al hacer clic. Solo se escucha dentro de la sección:
         un listener en window haría saltar los puntos por un clic en el
         navbar, que no tiene nada que ver con esto. */
      function golpe(e) {
        var r = canvas.getBoundingClientRect();
        var cx = e.clientX - r.left, cy = e.clientY - r.top;
        for (var i = 0; i < dots.length; i++) {
          var d = dots[i];
          var dx = d.cx - cx, dy = d.cy - cy;
          var dist = Math.hypot(dx, dy);
          if (dist >= shock || dist === 0) continue;
          var f = (1 - dist / shock) * 14;
          d.vx += (dx / dist) * f;
          d.vy += (dy / dist) * f;
        }
      }

      var host = root.parentElement || root;
      host.addEventListener('mousemove', mover, { passive: true });
      host.addEventListener('mouseleave', function () { px = py = -9999; }, { passive: true });
      host.addEventListener('click', golpe);
      window.addEventListener('resize', construir, { passive: true });

      construir();

      /* Fuera de pantalla no se dibuja. Sin esto el rAF corre toda la vida
         de la página aunque la sección esté a tres pantallas de distancia. */
      if ('IntersectionObserver' in window) {
        new IntersectionObserver(function (entries) {
          visible = entries[0].isIntersecting;
          if (visible && !frame) frame = window.requestAnimationFrame(pintar);
        }, { rootMargin: '100px 0px' }).observe(root);
      } else {
        visible = true;
        frame = window.requestAnimationFrame(pintar);
      }
    });
  })();
</script>


<script>
  /* Stack de tarjetas — reimplementación del CardSwap de Vue Bits.

     Sin GSAP: el original lo usa para encadenar una timeline con ease
     elástico, y eso se resuelve con transiciones CSS y dos setTimeout. No
     vale sumar una librería de animación a un tema de WordPress por un
     efecto decorativo de una sección.

     Y sin componente: acá el punto de partida es una lista real de HTML que
     el JS transforma, no un contenedor vacío que el JS rellena. Si el script
     no corre, la página sigue teniendo la información.

     Geometría de cada posición del stack, igual que el original:
       x = i · distX     y = -i · distY     z = -i · distX · 1.5
     El skewY constante es lo que da el borde inclinado del original. */
  (function () {
    var raices = document.querySelectorAll('[data-cardswap]');
    if (!raices.length) return;

    var mq = window.matchMedia;
    /* Sin puntero fino no hay hover para pausar, así que el texto pasaría de
       largo sin que se pueda leer. En táctil se queda la rejilla. */
    if (mq && !mq('(hover: hover) and (pointer: fine)').matches) return;
    if (mq && mq('(prefers-reduced-motion: reduce)').matches) return;

    var ELASTICO = 'cubic-bezier(0.16, 1.06, 0.34, 1.02)';
    var CAIDA = 780;   // ms que tarda la de adelante en irse
    var SUBIDA = 900;  // ms que tardan las demás en promover

    Array.prototype.forEach.call(raices, function (raiz) {
      var lista = raiz.querySelector('[data-cardswap-list]');
      var cards = Array.prototype.slice.call(raiz.querySelectorAll('[data-cardswap-card]'));
      if (!lista || cards.length < 2) return;

      var distX = parseFloat(raiz.dataset.distX) || 46;
      var distY = parseFloat(raiz.dataset.distY) || 54;
      var skew  = parseFloat(raiz.dataset.skew)  || 6;
      var espera = parseFloat(raiz.dataset.delay) || 4200;

      /* En pantalla angosta el mazo se mira de frente, no de costado.
         El escalonado lateral y el skew existen para que en ancho se vean
         los cantos de las tarjetas de atrás; en angosto no hay ancho que
         gastar y lo único que hacen es empujar la tarjeta de adelante
         fuera de la pantalla y partirle el texto en columnas de tres
         palabras.

         De frente, la profundidad la dan dos cosas: un asomo vertical
         pequeño y una reducción de escala por posición. Se lee como un
         mazo visto desde arriba en lugar de un abanico. */
      var cfg = {};
      function medirCfg() {
        var angosto = window.innerWidth < 768;
        cfg.dx    = angosto ? 0 : distX;
        cfg.dy    = angosto ? 16 : distY;
        cfg.skew  = angosto ? 0 : skew;
        cfg.escala = angosto ? 0.035 : 0;
        cfg.caida = angosto ? 260 : 340;
        return angosto;
      }

      var orden = cards.map(function (_, i) { return i; });
      var timer = null, saltoTimer = null, visible = false, pausado = false;

      /* El alto del stack se mide ANTES de apilar, con las tarjetas todavía
         en rejilla: una vez que son absolutas, el contenedor colapsa y no
         hay contra qué medir. Se toma la más alta y se le suma el
         desplazamiento vertical de todas las posiciones. */
      function apilar() {
        var angosto = medirCfg();

        /* El alto se mide con las tarjetas todavía en rejilla: una vez que
           son absolutas el contenedor colapsa y no queda contra qué medir.
           Por eso el estado se limpia antes de volver a medir — si no, en
           un resize se mediría la tarjeta ya apilada. */
        cards.forEach(function (c) {
          c.style.position = '';
          c.style.width = '';
          c.style.minHeight = '';
          c.style.transform = '';
        });
        lista.style.position = '';
        lista.style.display = '';
        lista.style.height = '';

        var altoCard = 0, anchoCard = lista.getBoundingClientRect().width;
        cards.forEach(function (c) {
          altoCard = Math.max(altoCard, c.getBoundingClientRect().height);
        });
        altoCard = Math.max(altoCard, 170);

        // De frente, la tarjeta usa todo el ancho: no hay canto que dejar ver.
        var ancho = angosto
          ? anchoCard
          : Math.min(anchoCard - distX * (cards.length - 1), anchoCard * 0.82);

        lista.style.position = 'relative';
        lista.style.display = 'block';
        lista.style.background = 'none';
        lista.style.perspective = '900px';
        lista.style.height = (altoCard + cfg.dy * (cards.length - 1) + 24) + 'px';

        cards.forEach(function (c) {
          c.style.position = 'absolute';
          c.style.top = '50%';
          c.style.left = '0';
          c.style.width = ancho + 'px';
          c.style.minHeight = altoCard + 'px';
          c.style.alignItems = c.querySelector('[data-cardswap-media]') ? 'stretch' : 'flex-start';
          c.style.borderRadius = '12px';
          c.style.boxShadow = '0 18px 40px -22px rgba(13,15,16,0.55)';
          c.style.transformStyle = 'preserve-3d';
          c.style.backfaceVisibility = 'hidden';
          c.style.willChange = 'transform, opacity';
          /* Dos formatos de tarjeta conviven: una sola línea, o título más
             cuerpo. El JS sirve a los dos para no divergir entre plantillas
             — lo que cambia es el contenido, no el motor. */
          var t = c.querySelector('[data-cardswap-title]');
          var b = c.querySelector('[data-cardswap-body]');
          var u = c.querySelector('[data-cardswap-text]');
          if (t) { t.style.fontSize = '1.3125rem'; t.style.lineHeight = '1.3'; }
          if (b) { b.style.fontSize = '0.9375rem'; b.style.lineHeight = '1.6'; }
          if (u) { u.style.fontSize = '1.0625rem'; u.style.lineHeight = '1.5'; }

          /* El padding va en el contenido, no en la tarjeta: si la tarjeta lo
             lleva y hay una imagen a sangre, la imagen queda con marco. */
          var contenido = c.querySelector('[data-cardswap-content]');
          if (contenido) contenido.style.padding = '1.75rem';
          else c.style.padding = '2rem'; 
        });
      }

      function transformar(i) {
        return 'translate3d(' + (i * cfg.dx) + 'px,-50%,0)' +
               ' translateY(' + (-i * cfg.dy) + 'px)' +
               ' translateZ(' + (-i * cfg.dx * 1.5) + 'px)' +
               ' scale(' + (1 - i * cfg.escala) + ')' +
               ' skewY(' + cfg.skew + 'deg)';
      }

      function colocar(el, i, animar) {
        el.style.transition = animar
          ? 'transform ' + SUBIDA + 'ms ' + ELASTICO + ', opacity 320ms ease-out'
          : 'none';
        el.style.transform = transformar(i);
        el.style.zIndex = String(cards.length - i);
        el.style.opacity = '1';
      }

      function pintarOrden(animar) {
        orden.forEach(function (idx, i) { colocar(cards[idx], i, animar); });
      }

      function rotar() {
        if (pausado || !visible || orden.length < 2) return;

        var frente = cards[orden[0]];

        /* La de adelante cae y se desvanece. No vuelve por el aire hasta el
           fondo del stack como en el original: con seis tarjetas ese viaje
           cruza por delante de las demás y ensucia la lectura. Cae, se apaga,
           y reaparece al fondo. */
        frente.style.transition = 'transform ' + CAIDA + 'ms ease-in, opacity ' + (CAIDA - 180) + 'ms ease-in';
        frente.style.transform = transformar(0) + ' translateY(' + cfg.caida + 'px)';
        frente.style.opacity = '0';

        /* Las demás promueven antes de que la primera termine de caer: ese
           solape es lo que hace que el movimiento se lea como un mazo y no
           como una cola de turnos. */
        saltoTimer = window.setTimeout(function () {
          orden.slice(1).forEach(function (idx, i) { colocar(cards[idx], i, true); });
        }, CAIDA * 0.45);

        window.setTimeout(function () {
          orden = orden.slice(1).concat(orden[0]);
          var ultima = cards[orden[orden.length - 1]];
          colocar(ultima, orden.length - 1, false);
          ultima.style.opacity = '0';
          void ultima.offsetWidth;            // fuerza reflujo antes de reactivar la transición
          ultima.style.transition = 'opacity 420ms ease-out';
          ultima.style.opacity = '1';
        }, CAIDA);
      }

      function arrancar() {
        if (timer) return;
        timer = window.setInterval(rotar, espera);
      }
      function parar() {
        if (timer) { window.clearInterval(timer); timer = null; }
      }

      /* Pausa en hover. Acá no es un lujo: cada tarjeta lleva una línea de
         alcance y sin pausa no se puede terminar de leer la que interesa. */
      raiz.addEventListener('mouseenter', function () { pausado = true; });
      raiz.addEventListener('mouseleave', function () { pausado = false; });

      apilar();
      pintarOrden(false);

      var reTimer = null;
      window.addEventListener('resize', function () {
        if (reTimer) window.clearTimeout(reTimer);
        reTimer = window.setTimeout(function () {
          cards.forEach(function (c) { c.style.transition = 'none'; });
          apilar();
          pintarOrden(false);
        }, 120);
      }, { passive: true });

      if ('IntersectionObserver' in window) {
        new IntersectionObserver(function (e) {
          visible = e[0].isIntersecting;
          if (visible) arrancar(); else parar();
        }, { rootMargin: '80px 0px' }).observe(raiz);
      } else {
        visible = true;
        arrancar();
      }
    });
  })();
</script>

<?php
/* Contenido del editor, si la página tiene algo escrito. Permite agregar texto
   a esta capacidad sin tocar la plantilla. */
if (have_posts()) :
  while (have_posts()) : the_post();
    if (trim(get_the_content()) === '') continue; ?>
    <section class="bg-breeze-100">
      <div class="prose w-full max-w-3xl px-5 py-16 text-ink/80 sm:px-8 lg:px-10">
        <?php the_content(); ?>
      </div>
    </section>
  <?php endwhile;
endif;

get_footer(); ?>