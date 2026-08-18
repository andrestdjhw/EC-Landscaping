<?php
/**
 * Template Name: Capacidad · Grounds Maintenance
 *
 * Página de capacidad. Slug esperado: /grounds-maintenance
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

$ec_title = 'Grounds maintenance, irrigation & snow';
$ec_lede  = 'Annual contracts covering mowing, fertilization, pruning, spring startup, smart irrigation management, fall winterization, and snow and ice management through the winter. One vendor, twelve months.';
$ec_image = $ec_media . 'GroundsMaintenance-scaled.webp';
$ec_alt   = 'Grounds maintenance on a commercial property';

/* ═════════════════════════════════════════════════════════════════
   IMÁGENES DE LAS TARJETAS DE ALCANCE

   Una variable por tarjeta, para cambiar una foto sin buscarla entre el
   markup. Se arman desde $ec_media_scope y no con la URL pegada entera:
   así sobreviven la migración de ec-landscaping.local a producción.

   Vaciar cualquiera de estas cadenas deja esa tarjeta solo con texto — la
   sección no se rompe, que es lo que permite ir reemplazando fotos de a
   una cuando lleguen las de obra propia.
   ═════════════════════════════════════════════════════════════════ */

// Carpeta de la biblioteca donde se subieron. Ajustar el mes si va a otra.
$ec_media_scope = $ec_uploads['baseurl'] . '/2026/08/';

$ec_img_mowing   = $ec_media_scope . 'MowingFertilization-scaled.jpg';
$ec_img_startup  = $ec_media_scope . 'SpringStartup-scaled.jpg';

// .jpeg y no .jpg: es la única de las seis que se subió con esa extensión.
// La URL tiene que coincidir con el archivo, así que se respeta tal cual.
$ec_img_smart    = $ec_media_scope . 'SmartIrrigation-scaled.jpeg';

$ec_img_winter   = $ec_media_scope . 'FallWinterization-scaled.jpg';
$ec_img_snow     = $ec_media_scope . 'SnowIceManagement-scaled.jpg';
$ec_img_contract = $ec_media_scope . 'AnnualContractors-scaled.jpg';


/* ─────────────────────────────────────────────────────────────────
   ALCANCE — título, cuerpo e imagen por tarjeta.

   Los títulos son el lede del bloque 05 partido en puntos: nada nuevo.
   Los cuerpos SÍ son copy nuevo y ninguno pasó por Eunice.

   Misma regla que en las otras capacidades: describir el trabajo y el
   riesgo que le quita de encima al comprador, nunca prometer un
   procedimiento que el deck no respalde. Por eso no hay frecuencias de
   corte, ni tiempos de respuesta ante nevada, ni umbrales de pulgadas —
   todo eso es contractual y sale del capability deck, no de acá.

   El comprador de esta capacidad es el property manager del bloque 03, y
   su frase aprobada ("One contract. Grounds, irrigation and snow. Twelve
   months...") es la que ordena las seis tarjetas.
   ───────────────────────────────────────────────────────────────── */
$ec_scope = array(
  array(
    'title' => 'Mowing, fertilization and pruning',
    'body'  => 'The half of the job everyone sees. Cut on a schedule your tenants can set their watch by, fed on a program that matches the season, and pruned before it turns into a complaint.',
    'image' => $ec_img_mowing,
    'alt'   => 'Maintenance crew mowing at a commercial property',
  ),
  array(
    'title' => 'Spring startup',
    'body'  => 'Controllers, valves and heads checked and adjusted before the first hot week — not after the first brown patch shows up in front of the entrance.',
    'image' => $ec_img_startup,
    'alt'   => 'Irrigation technician adjusting a sprinkler head',
  ),
  array(
    'title' => 'Smart irrigation management',
    'body'  => 'Programmed and adjusted through the season instead of set once in April. On a Northern Utah property water is one of the largest line items, and it gets managed like one.',
    'image' => $ec_img_smart,
    'alt'   => 'Technician programming a smart irrigation controller',
  ),
  array(
    'title' => 'Fall winterization',
    'body'  => 'Systems blown out and shut down before the first hard freeze. A cracked main in November gets paid for twice: once in parts, and once in the spring spent chasing it.',
    'image' => $ec_img_winter,
    'alt'   => 'Irrigation system being blown out for winter',
  ),
  array(
    'title' => 'Snow and ice management',
    'body'  => 'Written into the annual contract, not bid separately in October when every plow in the corridor is already committed. Same crew that already knows where your drains and curbs are.',
    'image' => $ec_img_snow,
    'alt'   => 'Plow clearing snow from a commercial parking lot',
  ),
  array(
    // "One contract. Grounds, irrigation and snow. Twelve months of
    // coverage under one vendor and one point of contact" — bloque 03,
    // aprobado. Esta tarjeta es esa promesa.
    'title' => 'Annual contracts — one vendor, twelve months',
    'body'  => 'One contract and one point of contact covering grounds, irrigation and snow. Twelve months of coverage with no gap in it where a second vendor has to be found and onboarded.',
    'image' => $ec_img_contract,
    'alt'   => 'Grounds maintenance crew and equipment at a commercial site',
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
  array('slug' => 'water-wise-retrofits', 'title' => 'Water-wise retrofits'),
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

     bg-ink debajo de la imagen: es lo que se ve el instante previo a que
     cargue, y lo que queda si la ruta se rompe en la migración. Un hero que
     falla en oscuro se lee como decisión; en claro se lee como error.

     Decía bg-sand y hubo que cambiarlo: en la paleta anterior SAND era el
     casi-negro, en la nueva es el claro cálido. El mismo nombre, el extremo
     opuesto de la escala — el texto bone encima habría quedado en 1.23:1. -->
<section class="relative isolate overflow-hidden bg-ink text-bone">

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
  <div class="absolute inset-0 -z-10 bg-[linear-gradient(180deg,rgba(47,52,45,0.80)_0%,rgba(47,52,45,0.86)_100%)] lg:hidden" aria-hidden="true"></div>
  <div class="absolute inset-0 -z-10 hidden bg-[linear-gradient(100deg,rgba(47,52,45,0.94)_0%,rgba(47,52,45,0.88)_38%,rgba(47,52,45,0.62)_66%,rgba(47,52,45,0.38)_100%)] lg:block" aria-hidden="true"></div>

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
          class="cta-relief group inline-flex items-center gap-2.5 border-2 border-white/25 bg-ember py-4 pl-7 pr-6 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink transition-all duration-200 ease-out hover:cta-relief-tight hover:bg-ember-600 hover:-translate-y-px active:translate-y-0 active:shadow-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transform-none motion-reduce:transition-none"
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
<!-- Rediseñada como composición modular, igual que las secciones de la home.

     Sale el stack de tarjetas 3D. Era un buen efecto pero contradecía la
     marca en tres frentes: mostraba un ítem a la vez cuando el comprador
     viene a verificar si hacés su alcance completo, dependía de bordes
     redondeados y sombras que el branding no tiene, y solo funcionaba con
     puntero fino — en un teléfono nunca se activaba.

     Sale también la rejilla de puntos reactiva del fondo. Es un canvas
     animado, y ni la van ni la valla tienen movimiento: son gráfica impresa.

     Entre las dos cosas, esta plantilla pierde unas 310 líneas de JavaScript.

     Lo que ocupa su lugar es el patrón de la valla: cada alcance es UNA FILA
     de dos módulos —la foto un rectángulo, el texto otro— y las filas se
     alternan de lado. La foto deja de estar cosida arriba del texto, que es
     lo que la volvía tarjeta. -->
<section class="bg-sand">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">

    <!-- Encabezado como bloque, a todo el ancho de la retícula. -->
    <div class="bg-ink p-8 text-bone lg:p-12">
      <div class="grid gap-6 lg:grid-cols-[minmax(0,1.4fr)_minmax(0,1fr)] lg:items-end lg:gap-16">
        <h2 class="ec-shine ec-shine--light ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-bone sm:text-4xl">
          What&rsquo;s <em>in scope.</em>
        </h2>
        <p class="text-base leading-relaxed text-bone/80">
          Self-performed with our own crew and our own equipment. Twelve months of it, not eight.
        </p>
      </div>
      <div class="ec-band ec-band--h mt-10 h-1.5 opacity-40" aria-hidden="true"></div>
    </div>

    <!-- Un alcance por fila: foto y texto como dos módulos del mismo sistema,
         alternando de lado. El gap-px muestra el fondo sand de la sección. -->
    <div class="mt-px grid gap-px lg:grid-cols-2">
      <?php foreach ($ec_scope as $ec_i => $item) :

        // La superficie del texto alterna para que ninguna fila repita a la
        // de arriba. El lado también se invierte: filas pares con la foto a
        // la izquierda, impares a la derecha.
        $ec_bg    = (0 === $ec_i % 2) ? 'bg-breeze-100' : 'bg-linen';
        $ec_izq   = (0 === $ec_i % 2);

        // El markup de cada módulo se resuelve una vez y se coloca en el
        // orden que toca. Se invierte en el DOM y no con `order`: con `order`
        // el lector de pantalla oiría la foto antes que su encabezado.
        $ec_foto = function () use ($item) { ?>
          <div class="relative min-h-[15rem] bg-ink lg:min-h-[20rem]">
            <?php if (!empty($item['image'])) : ?>
              <img
                src="<?php echo esc_url($item['image']); ?>"
                alt="<?php echo esc_attr($item['alt']); ?>"
                class="absolute inset-0 h-full w-full object-cover"
                loading="lazy"
                decoding="async"
              />
            <?php endif; ?>
          </div>
        <?php };

        $ec_texto = function () use ($item, $ec_bg) { ?>
          <div class="<?php echo esc_attr($ec_bg); ?> flex flex-col justify-center p-8 lg:p-12">
            <h3 class="font-display text-xl leading-snug font-bold tracking-tight text-ink sm:text-2xl">
              <?php echo esc_html($item['title']); ?>
            </h3>
            <p class="mt-4 text-base leading-relaxed text-ink/70">
              <?php echo esc_html($item['body']); ?>
            </p>
          </div>
        <?php };

        if ($ec_izq) { $ec_foto(); $ec_texto(); } else { $ec_texto(); $ec_foto(); }
      endforeach; ?>
    </div>

    <!-- Cierre en clay, cerrando la retícula con la afirmación de la sección.
         Antes iba suelto en la columna izquierda; como módulo queda a la
         altura de los alcances en lugar de leerse como pie de página. -->
    <div class="mt-px bg-ember p-8 lg:p-12">
      <p class="max-w-3xl text-base leading-relaxed text-ink">
        The same crew on your property in July and in January — which is the only way the person plowing your lot already knows where the curbs are.
      </p>
    </div>
  </div>
</section>

<!-- ═══════════════════════ PARA QUIÉN ═══════════════════════ -->
<section class="bg-slate-100">
  <div class="w-full px-5 py-14 sm:px-8 lg:px-10 lg:py-16">
    <h2 class="mb-6 text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ink/50">Built for</h2>
    <ul class="flex flex-wrap gap-2">
      <?php foreach ($ec_built_for as $buyer) : ?>
        <li class="border border-ember-300 bg-ember-100 px-4 py-2 text-sm text-ink">
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
          <span class="font-display text-2xl font-bold tracking-tight text-ember-600-600 tabular-nums">
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
            <span class="mt-3 text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ember-600-600">
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
        <p class="mt-4 max-w-lg text-base leading-relaxed text-bone">
          You&rsquo;ll hear back from the owner or the estimator &mdash; not a call center.
        </p>
      </div>

      <div class="flex flex-wrap items-center gap-6">
        <a
          href="<?php echo esc_url($ec_bid_href); ?>"
          data-bid-cta
          class="cta-relief group inline-flex items-center gap-2.5 border-2 border-white/25 bg-ember py-4 pl-7 pr-6 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink transition-all duration-200 ease-out hover:cta-relief-tight hover:bg-ember-600 hover:-translate-y-px active:translate-y-0 active:shadow-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transform-none motion-reduce:transition-none"
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
  
<script>
  /* Destello de los titulares. Vive en cada plantilla porque cada página es un
     archivo completo — y hasta ahora faltaba acá: la clase ec-shine estaba en
     el markup de las seis páginas interiores, pero sin este script nadie le
     ponía is-shining y el efecto no ocurría en ninguna.

     La clase se pone al entrar en pantalla y se quita al salir: con una
     animación en bucle, dejar animando un titular fuera del viewport repinta
     igual y se paga en batería. */
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

<?php endwhile;
endif;

get_footer(); ?>