<?php
/**
 * Template Name: Landing Comercial
 *
 * Bloques 01 a 12 del copy deck. La navbar y el footer son componentes React
 * (header.php / footer.php); el formulario del bloque 12 monta en #ec-contact-form.
 *
 * Todo el contenido vive en los arrays de abajo, no en el markup. Cuando haya
 * que producir la variante por vertical (c-stores, credit unions, HOAs) se
 * duplica este archivo y se cambian los arrays: mismo esqueleto, distinta prueba.
 *
 * IDs consumidos por el scrollspy de la navbar:
 *   #commercial · #projects · #capabilities · #credentials · #service-area
 */

get_header();

/* ─────────────────────────────────────────────────────────────
   01 · HERO
   ───────────────────────────────────────────────────────────── */
$ec_uploads = wp_get_upload_dir();

$hero = array(
  'eyebrow' => 'Commercial landscape, hardscape & concrete · Northern Utah',
  'title'   => 'Commercial landscape installation that holds the schedule.',
  'lede'    => "Self-performed hardscape, concrete and landscape installation for general contractors, property managers, HOAs and multi-site brands across the Weber–Davis corridor. Thirty-one people on our crew. Licensed, insured, and on site when we said we'd be.",
  'micro'   => 'Utah License 1106462255001 · S330 — General Liability, Workers’ Compensation and Commercial Auto certificates available on request.',

  // Se arma desde wp_get_upload_dir() para que la URL sobreviva la migración
  // de ec-landscaping.local a producción.
  'video'   => $ec_uploads['baseurl'] . '/2026/07/ECLanscapingHero-1.mp4',

  // Fotograma del video exportado como JPG. Es lo que ven quienes no cargan
  // el video: móvil, prefers-reduced-motion y conexiones lentas. Sin poster
  // esos usuarios ven el hero sin imagen de fondo — no se rompe, pero pierde.
  'poster'  => '',
);

/* 02 · BARRA DE PRUEBA — cifras verificables, sin facturación (dato interno). */
$proof_bar = array(
  array('stat' => '31',    'label' => 'people on our crew, not a call list of subs'),
  array('stat' => '20+',   'label' => 'years in the trade'),
  array('stat' => '500+',  'label' => 'properties maintained across Weber, Davis and Box Elder'),
  array('stat' => '50 mi', 'label' => 'service radius from Ogden, up to 90 for large projects'),
);

/* 03 · PARA QUIÉN CONSTRUIMOS */
$clusters = array(
  array(
    'title' => 'General contractors & developers',
    'body'  => "Your certificate of occupancy shouldn't wait on the landscape. We bid the full scope, staff it with our own crew, and deliver submittals, insurance certificates and safety documentation with the bid, not after award.",
  ),
  array(
    'title' => 'Property managers',
    'body'  => 'One contract. Grounds, irrigation and snow. Twelve months of coverage under one vendor and one point of contact, with scheduled reporting and no surprise line items in your operating budget.',
  ),
  array(
    'title' => 'HOA boards',
    'body'  => 'A decision you can defend at the annual meeting. Transparent pricing by scope, references from other associations in Weber and Davis counties, and a local company your homeowners already see working in the neighborhood.',
  ),
  array(
    'title' => 'Institutional & multi-site owners',
    'body'  => 'Site 47 should look exactly like site 1. We build and maintain to written brand standards across locations, with the same crew leads and the same documentation on every property.',
  ),
  array(
    'title' => 'C-stores, credit unions & retail chains',
    'body'  => "We've already built to a corporate standard in your category. If your expansion plan adds sites across Northern Utah, we can bid them as a program instead of one at a time.",
  ),
);

/* 04 · PRECEDENTE — Versión B del copy deck.
   La Versión A (con Maverik y America First por nombre y con cifras) NO se
   publica hasta tener permiso escrito de ambos clientes: Pendiente 03. */
$cases = array(
  array(
    'kicker' => 'Convenience store chain',
    'title'  => 'A Utah-headquartered chain with 800+ locations',
    'body'   => "Full site landscape installation to corporate brand standard, coordinated with the general contractor's opening schedule. Six-figure contract, delivered on the opening date.",
  ),
  array(
    'kicker' => 'Financial institution',
    'title'  => 'One of Utah’s largest credit unions, 115+ branches',
    'body'   => 'Branch site landscape and hardscape installation, awarded after institutional review of licensing, insurance and safety documentation.',
  ),
);

/* 05 · CAPACIDADES */
$capabilities = array(
  array(
    'title' => 'Commercial landscape installation',
    'body'  => 'New construction, retail pads, branch sites, multifamily and industrial. Grading and soil preparation, irrigation mains and zones, planting, sod, trees and final grade to plan.',
  ),
  array(
    'title' => 'Hardscape & concrete',
    'body'  => 'Retaining walls, paver plazas and walkways, flat and stamped concrete, curbing, site walls and pool decks — self-performed under our own concrete and masonry license.',
  ),
  array(
    'title' => 'Grounds maintenance, irrigation & snow',
    'body'  => 'Annual contracts covering mowing, fertilization, pruning, spring startup, smart irrigation management, fall winterization, and snow and ice management through the winter. One vendor, twelve months.',
  ),
  array(
    'title' => 'Water-wise retrofits',
    'body'  => 'Turf conversion, drip and smart controllers, native and adapted plantings, and design that meets local water district requirements without looking like a gravel lot.',
  ),
);

/* 07 · PROCESO DE BID.
   El plazo del paso 2 está sin definir: Pendiente 08. Confirmar con Tomás
   un número que EC pueda sostener antes de publicar. */
$process = array(
  array('n' => '1', 'title' => 'Walkthrough and takeoff', 'body' => 'We visit the site, review the plans and confirm scope with your PM or superintendent before we price anything.'),
  array('n' => '2', 'title' => 'Scoped bid',              'body' => 'A line-item proposal with quantities, exclusions and a schedule. No vague allowances that turn into change orders.'),
  array('n' => '3', 'title' => 'Preconstruction',         'body' => 'Submittals, certificates of insurance, W-9 and safety documentation delivered before mobilization, in the format your office needs them.'),
  array('n' => '4', 'title' => 'Self-performed execution','body' => 'Our crew, our equipment, one point of contact and weekly photo updates from the site.'),
  array('n' => '5', 'title' => 'Closeout and handoff',    'body' => 'Punch list walkthrough, warranty terms in writing, and an optional maintenance contract that starts the day we finish.'),
);

/* 08 · CREDENCIALES.
   "bonded" queda fuera hasta que se confirme capacidad de bonding: Pendiente 04.
   La licencia UDAF falta número y clase: Pendiente 09. */
$credentials = array(
  array('label' => 'Utah contractor license', 'value' => '1106462255001 · classification S330'),
  array('label' => 'Business license',        'value' => 'Current'),
  array('label' => 'General liability',       'value' => 'Certificate available on request'),
  array('label' => "Workers' compensation",   'value' => 'Certificate available on request'),
  array('label' => 'Commercial auto',         'value' => 'Certificate available on request'),
  array('label' => 'Concrete & masonry',      'value' => 'Self-performed — EC Hardscape and Concrete'),
  array('label' => 'Legal entity',            'value' => 'EC Landscaping LLC · operating since 2018'),
  array('label' => 'Experience',              'value' => 'Owner with 20+ years in the trade'),
  array('label' => 'Headquarters',            'value' => '3754 N Higley Rd, Suite 2, Ogden, UT 84404'),
);

/* 09 · ÁREA DE SERVICIO.
   Pendiente 07: el sitio actual promete Park City y SLC, el reporte fija el
   núcleo en Weber–Davis. Esta lista usa el núcleo del reporte. */
$service_cities   = array('Ogden', 'Layton', 'Clearfield', 'Syracuse', 'Farmington', 'Brigham City');
$service_counties = array('Weber', 'Davis', 'Morgan', 'Box Elder');

/* 10 · REPUTACIÓN.
   Array vacío a propósito. Los testimonios NO se redactan: se extraen
   textuales de Google y HomeAdvisor priorizando los que mencionen
   cumplimiento de fechas o trabajo comercial (Pendiente 05). Con el array
   vacío la sección no se renderiza. */
$reviews = array();
$review_summary = array('rating' => '4.7', 'count' => '67');

/* 11 · FAQ */
$faqs = array(
  array(
    'q' => 'Do you self-perform concrete and hardscape, or do you sub it out?',
    'a' => 'We self-perform. Retaining walls, flatwork, stamped concrete and paver work are done by our own crews under our own license.',
  ),
  array(
    'q' => 'Can you provide certificates of insurance and W-9 before mobilization?',
    'a' => "General Liability, Workers' Compensation and Commercial Auto certificates, plus W-9 and safety documentation, are delivered during preconstruction.",
  ),
  array(
    'q' => 'Do you handle snow removal for the properties you maintain?',
    'a' => 'Yes. Snow and ice management is included in our annual commercial contracts, which is how we keep the same crew on your property twelve months a year.',
  ),
  array(
    'q' => 'What happens if something fails after closeout?',
    'a' => 'Warranty terms are written into the closeout package. One phone call to the same number you had during the build — you won’t be routed to a national service center.',
  ),
  // Pendiente 08 (plazo de bid) y Pendiente 04 (bonding): esas dos preguntas
  // se publican cuando Tomás confirme los datos. Mejor cuatro respuestas
  // firmes que seis con huecos.
);

$bid_href = '#request-a-bid';
$deck_href = ''; // Pendiente 15: el Capability Deck en PDF todavía no existe.
?>

<!-- ═══════════════════════ 01 · HERO ═══════════════════════ -->
<!-- Video a sangre detrás de toda la sección. El texto sigue en oscuro sobre
     claro, así que la legibilidad no puede depender de lo que salga en el
     video: la resuelve un scrim asimétrico, casi opaco en la columna de
     texto y transparente a la derecha. Eso mantiene el hero claro y deja
     ver el video como presencia, sin apostar el contraste a un fotograma. -->
<!-- Hero + barra de prueba comparten una pantalla. El contenedor mide un
     viewport y reparte el espacio: el hero toma lo que sobra (flex-1) y la
     barra ocupa lo que necesita. Así no hay que adivinar el alto de la barra
     con un número mágico que se rompe al cambiar el copy de las etiquetas.
     Solo en lg: en móvil la barra son dos filas y forzarlas dentro de la
     pantalla aplastaría el titular. -->
<div class="lg:flex lg:h-svh lg:flex-col">
<section class="relative isolate overflow-hidden bg-bone text-ink lg:min-h-0 lg:flex-1">

  <video
    id="ec-hero-video"
    class="absolute inset-0 -z-20 h-full w-full object-cover"
    data-src="<?php echo esc_url($hero['video']); ?>"
    <?php if ($hero['poster']) : ?>poster="<?php echo esc_url($hero['poster']); ?>"<?php endif; ?>
    autoplay
    muted
    loop
    playsinline
    preload="none"
    aria-hidden="true"
    tabindex="-1"
  ></video>

  <script>
    /* El src se asigna por JS, no en el HTML, para que el mp4 no se descargue
       cuando no se va a ver. Tres casos donde no se carga:

       · prefers-reduced-motion — video de fondo en loop es exactamente el
         tipo de movimiento que esa preferencia pide evitar.
       · pantallas chicas — el comprador de esta página revisa proveedores
         desde una obra, con datos móviles. Un hero de varios MB ahí es
         hostil, y en móvil el video queda tapado por el scrim de todas formas.
       · saveData o 2G/3G — misma razón.

       En esos casos queda el poster. El script va inline y junto al video
       para correr durante el parseo, antes de que el navegador arranque
       la reproducción. */
    (function () {
      var v = document.getElementById('ec-hero-video');
      if (!v || !v.dataset.src) return;

      var mq = window.matchMedia;
      var reduce = mq && mq('(prefers-reduced-motion: reduce)').matches;
      var small = mq && mq('(max-width: 767px)').matches;
      var net = navigator.connection || {};
      var thin = net.saveData === true || /^(slow-)?2g$|^3g$/.test(net.effectiveType || '');

      if (reduce || small || thin) return;

      v.src = v.dataset.src;
      var p = v.play();
      if (p && p.catch) p.catch(function () { /* autoplay bloqueado: queda el poster */ });
    })();
  </script>

  <!-- Scrim: bone casi opaco donde va el texto, abriéndose hacia la derecha.
       Gradiente explícito en lugar de utilidad de Tailwind para no depender
       del renombre de bg-gradient-* a bg-linear-* en v4. -->
  <div
    class="absolute inset-0 -z-10 bg-[linear-gradient(100deg,#F7F7F5_0%,rgba(247,247,245,0.95)_34%,rgba(247,247,245,0.6)_62%,rgba(247,247,245,0.3)_100%)]"
    aria-hidden="true"
  ></div>

  <!-- El padding-top reserva el alto del header, que ahora flota encima en
       lugar de empujar la página. min-h en svh y no vh: en móvil, vh incluye
       la barra de direcciones y el hero salta cuando aparece o desaparece. -->
  <div class="relative flex min-h-[38rem] items-center px-5 pb-20 pt-[calc(var(--header-offset)+2rem)] sm:px-8 lg:h-full lg:min-h-0 lg:px-10 lg:pb-12 lg:pt-[calc(var(--header-offset)+1rem)]">
    <div class="max-w-3xl">
      <p class="mb-5 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">
        <?php echo esc_html($hero['eyebrow']); ?>
      </p>
      <h1 class="font-display text-4xl leading-[1.08] font-bold tracking-tight text-ink sm:text-5xl lg:text-[3.4rem] [@media(min-width:1024px)_and_(max-height:860px)]:text-[2.7rem]">
        <?php echo esc_html($hero['title']); ?>
      </h1>
      <p class="mt-6 max-w-2xl text-lg leading-relaxed text-ink/80 [@media(min-width:1024px)_and_(max-height:860px)]:mt-4 [@media(min-width:1024px)_and_(max-height:860px)]:text-base">
        <?php echo esc_html($hero['lede']); ?>
      </p>

      <div class="mt-9 flex flex-wrap items-center gap-4">
        <a
          href="<?php echo esc_url($bid_href); ?>"
          class="cta-relief-light group inline-flex items-center gap-2.5 rounded-full border-2 border-white/60 bg-ember py-4 pl-7 pr-6 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink transition-all duration-200 ease-out hover:cta-relief-light-tight hover:bg-ember-600 hover:-translate-y-px active:translate-y-0 active:shadow-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transform-none motion-reduce:transition-none"
        >
          Request a bid
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transform-none">
            <path d="M5 12h13M13 6l6 6-6 6" />
          </svg>
        </a>

        <?php if ($deck_href) : ?>
          <a href="<?php echo esc_url($deck_href); ?>" class="text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink/75 underline decoration-forest decoration-2 underline-offset-8 transition-colors hover:text-ink">
            Download capability deck (PDF)
          </a>
        <?php endif; ?>
      </div>

      <p class="mt-8 max-w-xl text-xs leading-relaxed text-ink/70">
        <?php echo esc_html($hero['micro']); ?>
      </p>
    </div>
  </div>
</section>

<!-- ═══════════════ 02 · BARRA DE PRUEBA ═══════════════ -->
<!-- Se queda oscura a propósito. Sobre bone, el naranja de las cifras cae a
     2.9:1: habría que repintarlas de verde o de negro y las cifras dejarían
     de ser lo primero que se ve. Como banda oscura bajo un hero claro cumple
     dos funciones: mantiene el contraste del dato y separa el hero del
     bloque 03, que también es claro. -->
<section class="bg-ink lg:shrink-0">
  <dl class="grid grid-cols-2 gap-px bg-white/10 lg:grid-cols-4">
    <?php foreach ($proof_bar as $item) : ?>
      <div class="bg-ink px-5 py-7 sm:px-8 lg:px-10 lg:py-5">
        <dt class="font-display text-3xl font-bold tracking-tight text-ember sm:text-4xl lg:text-[2rem]">
          <?php echo esc_html($item['stat']); ?>
        </dt>
        <dd class="mt-2 text-xs leading-relaxed text-bone/70 lg:mt-1.5">
          <?php echo esc_html($item['label']); ?>
        </dd>
      </div>
    <?php endforeach; ?>
  </dl>
</section>
</div>
<!-- ↑ cierra el contenedor de una pantalla que comparten hero y barra -->

<!-- ═══════════════════ 03 · PARA QUIÉN CONSTRUIMOS ═══════════════════ -->
<section id="commercial" class="bg-bone lg:flex lg:min-h-svh lg:items-center">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="max-w-3xl">
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Who we build for</p>
      <h2 class="font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
        You’re not buying landscaping. You’re buying a schedule that holds.
      </h2>
      <p class="mt-5 text-lg leading-relaxed text-ink/70">
        Every commercial buyer we work with is managing a different kind of risk. Here’s how we take it off your desk.
      </p>
    </div>

    <ul class="mt-12 grid gap-px bg-ink/10 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($clusters as $cluster) : ?>
        <li class="bg-bone p-7">
          <h3 class="font-display text-lg font-bold tracking-tight text-ink">
            <?php echo esc_html($cluster['title']); ?>
          </h3>
          <p class="mt-3 text-sm leading-relaxed text-ink/70">
            <?php echo esc_html($cluster['body']); ?>
          </p>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- ═══════════════════ 04 · PRECEDENTE INSTITUCIONAL ═══════════════════ -->
<section id="projects" class="bg-ink text-bone lg:flex lg:min-h-svh lg:items-center">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="max-w-3xl">
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember">Track record</p>
      <h2 class="font-display text-3xl leading-tight font-bold tracking-tight text-bone sm:text-4xl">
        Brands that audit every vendor already hired us.
      </h2>
      <p class="mt-5 text-lg leading-relaxed text-bone/75">
        Two institutional brands with corporate procurement standards reviewed our licensing, insurance and capacity — and paid us to build. That’s not a testimonial. That’s a precedent.
      </p>
    </div>

    <div class="mt-12 grid gap-6 lg:grid-cols-2">
      <?php foreach ($cases as $case) : ?>
        <article class="flex flex-col border border-white/12 bg-white/[0.03] p-8">
          <p class="text-[0.65rem] font-semibold uppercase tracking-[0.18em] text-ember">
            <?php echo esc_html($case['kicker']); ?>
          </p>
          <h3 class="mt-4 font-display text-xl leading-snug font-bold tracking-tight text-bone">
            <?php echo esc_html($case['title']); ?>
          </h3>
          <p class="mt-4 text-sm leading-relaxed text-bone/70">
            <?php echo esc_html($case['body']); ?>
          </p>
        </article>
      <?php endforeach; ?>
    </div>

    <p class="mt-8 text-xs text-bone/70">
      Client names and contract values available on request under NDA.
    </p>
  </div>
</section>

<!-- ═══════════════════════ 05 · CAPACIDADES ═══════════════════════ -->
<section id="capabilities" class="bg-white lg:flex lg:min-h-svh lg:items-center">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="max-w-3xl">
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Capabilities</p>
      <h2 class="font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
        What we self-perform.
      </h2>
      <p class="mt-5 text-lg leading-relaxed text-ink/70">
        Most landscape contractors in this corridor subcontract the heavy work and manage it from a truck. We hold the license, own the equipment and put our own people on your site.
      </p>
    </div>

    <div class="mt-12 grid gap-8 sm:grid-cols-2">
      <?php foreach ($capabilities as $item) : ?>
        <div class="border-t-2 border-forest pt-5">
          <h3 class="font-display text-lg font-bold tracking-tight text-ink">
            <?php echo esc_html($item['title']); ?>
          </h3>
          <p class="mt-3 text-sm leading-relaxed text-ink/70">
            <?php echo esc_html($item['body']); ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════════ 06 · WATER-WISE ═══════════════════ -->
<!-- Pendiente 06: verificar montos y vigencia de los programas del distrito
     Weber Basin antes de publicar. Las cifras están fuera del markup para
     poder actualizarlas o quitarlas en un solo lugar. -->
<section class="bg-forest text-bone lg:flex lg:min-h-svh lg:items-center">
  <div class="w-full grid gap-10 px-5 py-16 sm:px-8 lg:grid-cols-[minmax(0,1.1fr)_minmax(0,1fr)] lg:gap-14 lg:px-10 lg:py-24">
    <div>
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-bone/70">Water-wise retrofits</p>
      <h2 class="font-display text-3xl leading-tight font-bold tracking-tight text-bone sm:text-4xl">
        The state helps pay to fix your largest water line item.
      </h2>
      <p class="mt-5 text-base leading-relaxed text-bone/80">
        In the Weber Basin district — Weber, Davis, Morgan and Summit counties — commercial properties, HOAs and multifamily owners can qualify for landscape conversion incentives for turf removal.
      </p>
      <p class="mt-4 text-base leading-relaxed text-bone/80">
        For a property manager, that changes the math: a recurring water and maintenance expense becomes a partially funded capital improvement — designed, permitted and installed by the same contractor who already maintains the site.
      </p>
      <a href="<?php echo esc_url($bid_href); ?>" class="mt-8 inline-block text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-bone underline decoration-ember decoration-2 underline-offset-8 transition-colors hover:text-white">
        Ask what your property qualifies for
      </a>
    </div>

    <div class="flex items-center">
      <div class="w-full border border-bone/20 p-8">
        <p class="text-xs leading-relaxed text-bone/70">
          Espacio reservado para el incentivo por pie cuadrado y el ahorro anual en galones.
          Se publican cuando el distrito confirme montos y vigencia — una cifra vencida en
          una página que vende credibilidad cuesta más de lo que aporta.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════ 07 · CÓMO TRABAJAMOS ═══════════════════ -->
<section class="bg-bone lg:flex lg:min-h-svh lg:items-center">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="max-w-3xl">
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Process</p>
      <h2 class="font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
        How a bid becomes a finished site.
      </h2>
    </div>

    <ol class="mt-12 flex flex-col">
      <?php foreach ($process as $step) : ?>
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

<!-- ═══════════════════ 08 · CREDENCIALES ═══════════════════ -->
<section id="credentials" class="bg-white lg:flex lg:min-h-svh lg:items-center">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="max-w-3xl">
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Credentials</p>
      <h2 class="font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
        The page your compliance team is going to ask for.
      </h2>
      <p class="mt-5 text-lg leading-relaxed text-ink/70">
        Boring for everyone else. Decisive for you.
      </p>
    </div>

    <!-- Tabla y no tarjetas: una tabla se lee como documento, una tarjeta
         se lee como marketing. Para un GC eso importa. -->
    <dl class="mt-12 max-w-4xl">
      <?php foreach ($credentials as $row) : ?>
        <div class="grid gap-1 border-b border-ink/10 py-4 sm:grid-cols-[minmax(0,15rem)_minmax(0,1fr)] sm:gap-8">
          <dt class="text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ink/50">
            <?php echo esc_html($row['label']); ?>
          </dt>
          <dd class="text-sm text-ink"><?php echo esc_html($row['value']); ?></dd>
        </div>
      <?php endforeach; ?>
    </dl>
  </div>
</section>

<!-- ═══════════════════ 09 · ÁREA DE SERVICIO ═══════════════════ -->
<section id="service-area" class="bg-bone lg:flex lg:min-h-svh lg:items-center">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="grid gap-10 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.2fr)] lg:gap-14">
      <div>
        <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Service area</p>
        <h2 class="font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
          Where we work.
        </h2>
        <p class="mt-5 text-base leading-relaxed text-ink/70">
          50 miles from our Ogden yard, and up to 90 miles for large commercial installations. If your project sits outside that line and the scope justifies the drive, ask us anyway.
        </p>
      </div>

      <div class="grid gap-8 sm:grid-cols-2">
        <div>
          <h3 class="mb-4 text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ink/50">Core cities</h3>
          <ul class="flex flex-col gap-2">
            <?php foreach ($service_cities as $city) : ?>
              <li class="text-sm text-ink"><?php echo esc_html($city); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div>
          <h3 class="mb-4 text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ink/50">Counties</h3>
          <ul class="flex flex-col gap-2">
            <?php foreach ($service_counties as $county) : ?>
              <li class="text-sm text-ink"><?php echo esc_html($county); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════ 10 · REPUTACIÓN ═══════════════════ -->
<?php if (!empty($reviews)) : ?>
  <section class="bg-white lg:flex lg:min-h-svh lg:items-center">
    <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
      <h2 class="max-w-3xl font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
        <?php echo esc_html($review_summary['rating']); ?> stars.
        <?php echo esc_html($review_summary['count']); ?> reviews. And the crews get named.
      </h2>
      <ul class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($reviews as $review) : ?>
          <li class="border-l-2 border-ember pl-6">
            <blockquote class="text-sm leading-relaxed text-ink/80">
              <?php echo esc_html($review['quote']); ?>
            </blockquote>
            <p class="mt-4 text-xs text-ink/50">
              <?php echo esc_html($review['attribution']); ?>
            </p>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
<?php endif; ?>

<!-- ═══════════════════════ 11 · FAQ ═══════════════════════ -->
<section class="bg-bone lg:flex lg:min-h-svh lg:items-center">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <h2 class="max-w-3xl font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
      Questions estimators actually ask.
    </h2>

    <!-- <details> nativo: acordeón accesible sin una línea de JavaScript. -->
    <div class="mt-10 max-w-4xl">
      <?php foreach ($faqs as $faq) : ?>
        <details class="group border-b border-ink/10">
          <summary class="flex cursor-pointer items-center justify-between gap-6 py-5 text-base font-medium text-ink marker:content-none [&::-webkit-details-marker]:hidden">
            <?php echo esc_html($faq['q']); ?>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true" class="h-4 w-4 shrink-0 text-ember transition-transform duration-200 group-open:rotate-45 motion-reduce:transition-none">
              <path d="M12 5v14M5 12h14" />
            </svg>
          </summary>
          <p class="pb-6 pr-10 text-sm leading-relaxed text-ink/70">
            <?php echo esc_html($faq['a']); ?>
          </p>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════ 12 · CTA FINAL + FORMULARIO ═══════════════ -->
<section id="request-a-bid" class="bg-ink text-bone lg:flex lg:min-h-svh lg:items-center">
  <div class="w-full grid gap-12 px-5 py-16 sm:px-8 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.1fr)] lg:gap-16 lg:px-10 lg:py-24">
    <div>
      <h2 class="font-display text-4xl leading-tight font-bold tracking-tight text-bone sm:text-5xl">
        Send us the plans.
      </h2>
      <p class="mt-6 max-w-lg text-lg leading-relaxed text-bone/75">
        Tell us the site, the scope and the date. You’ll hear back from the owner or the estimator — not a call center.
      </p>
      <p class="mt-8 text-sm text-bone/60">
        Prefer to talk it through?
        <a href="tel:+13852403907" class="ml-1 font-medium text-bone underline decoration-ember decoration-2 underline-offset-4">(385) 240-3907</a>
      </p>
    </div>

    <!-- El formulario es el componente React ContactForm. -->
    <div id="ec-contact-form"></div>
  </div>
</section>

<?php
/* Schema LocalBusiness con el NAP único: Higley Rd, nunca Hooper (Pendiente 01). */
$schema = array(
  '@context' => 'https://schema.org',
  '@type'    => 'LandscapingBusiness',
  'name'     => 'EC Landscaping LLC',
  'url'      => home_url('/'),
  'telephone' => '+1-385-240-3907',
  'email'    => 'info@ecscaping.com',
  'address'  => array(
    '@type'           => 'PostalAddress',
    'streetAddress'   => '3754 N Higley Rd, Suite 2',
    'addressLocality' => 'Ogden',
    'addressRegion'   => 'UT',
    'postalCode'      => '84404',
    'addressCountry'  => 'US',
  ),
  'areaServed' => array_map(
    function ($county) {
      return array('@type' => 'AdministrativeArea', 'name' => $county . ' County, Utah');
    },
    $service_counties
  ),
);
?>
<script type="application/ld+json"><?php echo wp_json_encode($schema); ?></script>

<?php get_footer(); ?>