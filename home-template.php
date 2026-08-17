<?php
/**
 * Template Name: Landing Comercial
 *
 * Bloques 01 a 11 del copy deck. La navbar y el footer son componentes React
 * (header.php / footer.php). El bloque 12 (CTA final + formulario) se eliminó
 * a pedido, así que el punto de montaje #ec-contact-form ya no existe en esta
 * plantilla.
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
  //
  // Reemplaza a ECLanscapingHero-1.mp4, que sigue en la biblioteca por si hay
  // que volver atrás. El archivo nuevo está en la carpeta de agosto, no en la
  // de julio como el de Projects.
  'video'   => $ec_uploads['baseurl'] . '/2026/08/VIDEO-EC.mp4',

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

/* ═════════════════════════════════════════════════════════════════
   03 · IMÁGENES DE LOS CLUSTERS DE COMPRADOR

   Una variable por tarjeta. Pegá la URL y listo — el resto del bloque no
   se toca. Vacío = la tarjeta se renderiza solo con texto, así que se
   pueden ir subiendo de a una sin que la sección quede rota.

   Se arman desde $ec_uploads y no con la URL pegada entera, para que
   sobrevivan la migración de ec-landscaping.local a producción:
     $ec_img_gc = $ec_uploads['baseurl'] . '/2026/08/BuyerGC.jpg';

   CRITERIO DE BÚSQUEDA: se fotografía el TIPO DE PROPIEDAD, no al
   comprador. "General contractor" o "property manager" como término de
   búsqueda devuelve gente con casco señalando planos — el género más
   reconocible de foto de banco, y justo lo que el brief prohíbe. El
   edificio que ese comprador administra dice lo mismo sin delatarse.

   Y ojo con la quinta: sin marcas legibles. Si aparece el logo de una
   cadena real parece que estamos reclamando un cliente que todavía no
   autorizó su nombre (Pendiente 03).
   ═════════════════════════════════════════════════════════════════ */

// Prompt: "commercial building under construction exterior"
$ec_img_gc        = $ec_uploads['baseurl'] . '/2026/08/GeneralContractors-scaled.jpg';

// Prompt: "office park commercial property exterior"
$ec_img_pm        = $ec_uploads['baseurl'] . '/2026/08/PropertyManagers-scaled.jpg';

// Prompt: "residential community entrance landscaping" — área común, no una casa
$ec_img_hoa       = $ec_uploads['baseurl'] . '/2026/08/HOABoards-scaled.jpg';

// Prompt: "corporate campus building landscape"
$ec_img_multisite = $ec_uploads['baseurl'] . '/2026/08/InstitutionalMultisiteBuildings-scaled.jpg';

// Prompt: "convenience store exterior daytime" — sin marca legible
$ec_img_retail    = $ec_uploads['baseurl'] . '/2026/08/ConvenienceStore-scaled.jpg';


/* 03 · PARA QUIÉN CONSTRUIMOS
   El copy es textual del bloque 03 del deck y está aprobado: no se toca.
   Lo único que se agrega acá es la imagen y su alt. */
$clusters = array(
  array(
    'title' => 'General contractors & developers',
    'body'  => "Your certificate of occupancy shouldn't wait on the landscape. We bid the full scope, staff it with our own crew, and deliver submittals, insurance certificates and safety documentation with the bid, not after award.",
    'image' => $ec_img_gc,
    'alt'   => 'Commercial building under construction',
  ),
  array(
    'title' => 'Property managers',
    'body'  => 'One contract. Grounds, irrigation and snow. Twelve months of coverage under one vendor and one point of contact, with scheduled reporting and no surprise line items in your operating budget.',
    'image' => $ec_img_pm,
    'alt'   => 'Maintained grounds at a commercial office property',
  ),
  array(
    'title' => 'HOA boards',
    'body'  => 'A decision you can defend at the annual meeting. Transparent pricing by scope, references from other associations in Weber and Davis counties, and a local company your homeowners already see working in the neighborhood.',
    'image' => $ec_img_hoa,
    'alt'   => 'Landscaped common area at the entrance to a residential community',
  ),
  array(
    'title' => 'Institutional & multi-site owners',
    'body'  => 'Site 47 should look exactly like site 1. We build and maintain to written brand standards across locations, with the same crew leads and the same documentation on every property.',
    'image' => $ec_img_multisite,
    'alt'   => 'Corporate campus with landscaped grounds',
  ),
  array(
    'title' => 'Convenience stores, credit unions & retail chains',
    'body'  => "We've already built to a corporate standard in your category. If your expansion plan adds sites across Northern Utah, we can bid them as a program instead of one at a time.",
    'image' => $ec_img_retail,
    'alt'   => 'Retail site exterior with landscaping',
  ),
);

/* 04 · PRECEDENTE — Versión B del copy deck.
   La Versión A (con Maverik y America First por nombre y con cifras) NO se
   publica hasta tener permiso escrito de ambos clientes: Pendiente 03. */
$projects_video  = $ec_uploads['baseurl'] . '/2026/07/ProjectsECLandscaping.mp4';
$projects_poster = '';

$cases = array(
  array(
    'kicker' => 'Convenience store chain',
    'title'  => 'A Utah-headquartered chain with 800+ locations',
    'body'   => "Full site landscape installation to corporate brand standard, coordinated with the general contractor's opening schedule. Six-figure contract, delivered on the opening date.",
    'image'  => $ec_uploads['baseurl'] . '/2026/07/ConvenienceStore-scaled.webp',
    'alt'    => 'Commercial landscape installation at a convenience store site in Northern Utah',
  ),
  array(
    'kicker' => 'Financial institution',
    'title'  => 'One of Utah’s largest credit unions, 115+ branches',
    'body'   => 'Branch site landscape and hardscape installation, awarded after institutional review of licensing, insurance and safety documentation.',
    'image'  => $ec_uploads['baseurl'] . '/2026/07/FinancialInstitution-scaled.webp',
    'alt'    => 'Landscape and hardscape installation at a credit union branch in Northern Utah',
  ),
);

/* 05 · CAPACIDADES — carrusel de tarjetas con imagen.

   Las rutas se arman desde wp_get_upload_dir() y no se pegan literales, igual
   que el hero y los casos: así la URL sobrevive la migración de
   ec-landscaping.local a producción sin tocar código.
*/
$capabilities = array(
  array(
    'title' => 'Commercial landscape installation',
    'body'  => 'New construction, retail pads, branch sites, multifamily and industrial. Grading and soil preparation, irrigation mains and zones, planting, sod, trees and final grade to plan.',
    'image' => $ec_uploads['baseurl'] . '/2026/07/CommercialLandscapeInstallation-scaled.webp',
    'alt'   => 'Commercial landscape installation in progress on a Northern Utah site',
  ),
  array(
    'title' => 'Hardscape & concrete',
    'body'  => 'Retaining walls, paver plazas and walkways, flat and stamped concrete, curbing, site walls and pool decks — self-performed under our own concrete and masonry license.',
    'image' => $ec_uploads['baseurl'] . '/2026/07/HardscapeConcrete-scaled.webp',
    'alt'   => 'Retaining wall and paver hardscape under construction',
  ),
  array(
    'title' => 'Grounds maintenance, irrigation & snow',
    'body'  => 'Annual contracts covering mowing, fertilization, pruning, spring startup, smart irrigation management, fall winterization, and snow and ice management through the winter. One vendor, twelve months.',
    'image' => $ec_uploads['baseurl'] . '/2026/07/GroundsMaintenance-scaled.webp',
    'alt'   => 'Grounds maintenance on a commercial property',
  ),
  array(
    'title' => 'Water-wise retrofits',
    'body'  => 'Turf conversion, drip and smart controllers, native and adapted plantings, and design that meets local water district requirements without looking like a gravel lot.',
    'image' => $ec_uploads['baseurl'] . '/2026/07/WaterWiseRetrofits-scaled.webp',
    'alt'   => 'Drought-tolerant planting with drip irrigation on a commercial property',
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
  array(
    'q' => 'Do you bid as a subcontractor to the general contractor, or only direct to the owner?',
    'a' => 'Both. Most of our commercial work comes through general contractors — we bid the landscape scope, confirm it with your superintendent and deliver submittals on your schedule. We also contract directly with owners, property managers and HOA boards.',
  ),
  array(
    'q' => 'We have sites in more than one city. Can you hold the same standard across all of them?',
    'a' => 'Yes. We work to written brand standards, and you get the same crew leads and the same documentation on every property. If your plan adds locations across Northern Utah, we would rather bid them as one program than one site at a time.',
  ),
  array(
    // La primera mitad sale del paso 2 del proceso, que ya está aprobado.
    // La segunda —precio por escrito antes de ejecutar— es un compromiso
    // operativo que el copy deck no dice en ninguna parte: confirmar con
    // Tomás antes de publicar, o recortar la respuesta a la primera frase.
    'q' => 'How do you handle change orders?',
    'a' => 'By pricing the work properly the first time. Our proposals are line-item, with quantities and exclusions written out, so there are no vague allowances waiting to turn into change orders. When the scope genuinely changes, you get it priced in writing before we build it.',
  ),
  array(
    'q' => 'Do your designs meet local water district requirements?',
    'a' => 'Yes. Turf conversion, drip and smart controllers, and native and adapted plantings are standard scopes for us, and we design to the requirements of the district your site sits in — without handing you a gravel lot.',
  ),
  // Pendiente 08 (plazo de bid) y Pendiente 04 (bonding): esas dos preguntas
  // se publican cuando Tomás confirme los datos. Mejor ocho respuestas
  // firmes que diez con huecos.
);

/* Todos los CTA de la página apuntan a /contact. El modal global se retiró y
   la página de contacto ocupa su lugar.

   En el hero, cuando hay sitio para el panel (xl+), el componente intercepta
   el clic y enfoca el primer campo en lugar de navegar: el formulario ya está
   a la vista y recargar para llegar al mismo sitio sería absurdo. Por debajo
   de xl no hay panel, el componente se aparta y el enlace navega.

   El atributo data-bid-cta es lo que marca esos enlaces. Está también en
   Navbar.js y Footer.js. */
$bid_href = home_url('/contact');
$deck_href = ''; // Pendiente 15: el Capability Deck en PDF todavía no existe.
?>

<script>
  /* Marca <html> como "hay revelado" antes de que se pinte nada. Va aquí y no
     al final de la página a propósito: el estado oculto de [data-reveal] cuelga
     de .ec-reveal, así que si esta clase llegara tarde se vería el bloque 03
     completo y después desaparecería de golpe.

     El corolario es que sin JavaScript la clase nunca se agrega y todo el
     contenido queda visible. Nunca se esconde texto apostando a que corra un
     script. Lo mismo con prefers-reduced-motion: no se agrega la clase, no hay
     nada que revelar. */
  (function () {
    var mq = window.matchMedia;
    if (mq && mq('(prefers-reduced-motion: reduce)').matches) return;
    document.documentElement.classList.add('ec-reveal');
  })();
</script>

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
    data-bg-video
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

  <!-- Scrim: bone casi opaco donde va el texto, abriéndose hacia la derecha.
       Gradiente explícito en lugar de utilidad de Tailwind para no depender
       del renombre de bg-gradient-* a bg-linear-* en v4. -->
  <div
    class="absolute inset-0 -z-10 bg-[linear-gradient(100deg,#F1F0E6_0%,rgba(241,240,230,0.95)_34%,rgba(241,240,230,0.6)_62%,rgba(241,240,230,0.3)_100%)]"
    aria-hidden="true"
  ></div>

  <!-- El padding-top reserva el alto del header, que ahora flota encima en
       lugar de empujar la página. min-h en svh y no vh: en móvil, vh incluye
       la barra de direcciones y el hero salta cuando aparece o desaparece.

       Desde xl el hero es una rejilla de dos columnas reales, no un texto con
       un panel flotando encima. El formulario dejó de ser una capa que aparece
       al hacer clic: ahora está siempre, así que necesita ocupar su espacio en
       el layout. Con position:absolute el titular no sabría que hay algo a su
       derecha y a 1280px exactos se tocarían. -->
  <div class="relative flex min-h-[38rem] items-center px-5 pb-20 pt-[calc(var(--header-offset)+1rem)] sm:px-8 lg:h-full lg:min-h-0 lg:px-10 lg:pb-12 lg:pt-[var(--header-offset)] xl:grid xl:grid-cols-[minmax(0,1fr)_27rem] xl:items-center xl:gap-12 2xl:grid-cols-[minmax(0,1fr)_30rem]">
    <div class="max-w-3xl">
      <p class="mb-5 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">
        <?php echo esc_html($hero['eyebrow']); ?>
      </p>
      <h1 class="ec-shine font-display text-4xl leading-[1.08] font-bold tracking-tight text-ink sm:text-5xl lg:text-[3.4rem] [@media(min-width:1024px)_and_(max-height:860px)]:text-[2.7rem]">
        <?php echo esc_html($hero['title']); ?>
      </h1>
      <p class="mt-6 max-w-2xl text-lg leading-relaxed text-ink/80 [@media(min-width:1024px)_and_(max-height:860px)]:mt-4 [@media(min-width:1024px)_and_(max-height:860px)]:text-base">
        <?php echo esc_html($hero['lede']); ?>
      </p>

      <div class="mt-9 flex flex-wrap items-center gap-4">
        <!-- Los pulsos van en hermanos detrás del botón, no en su box-shadow.
             El relieve del CTA (cta-relief-light) ya ocupa esa propiedad y
             animarla encima haría que las dos se pisen: el bisel latiría junto
             con el anillo. Elementos aparte dejan cada cosa en su capa.

             Son dos con medio ciclo de desfase, de modo que siempre hay un
             anillo saliendo mientras el otro se apaga. Con uno solo el efecto
             se lee como un parpadeo intermitente en lugar de una emisión
             continua.

             `group` vive en el envoltorio, no en el <a>: así los pulsos —que
             son hermanos del botón— pueden reaccionar al hover. El área es la
             misma, así que la flecha del botón sigue animando igual. -->
        <span class="group relative inline-flex">
          <span class="ec-cta-pulse absolute inset-0 rounded-full transition-opacity duration-200 group-hover:opacity-0" aria-hidden="true"></span>
          <span class="ec-cta-pulse ec-cta-pulse--delayed absolute inset-0 rounded-full transition-opacity duration-200 group-hover:opacity-0" aria-hidden="true"></span>
          <a
            href="<?php echo esc_url($bid_href); ?>"
            data-bid-cta
            class="cta-relief-light relative inline-flex items-center gap-2.5 rounded-full border-2 border-white/60 bg-ember py-4 pl-7 pr-6 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink transition-all duration-200 ease-out hover:cta-relief-light-tight hover:bg-ember-600 hover:-translate-y-px active:translate-y-0 active:shadow-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transform-none motion-reduce:transition-none"
          >
            Request a bid
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transform-none">
              <path d="M5 12h13M13 6l6 6-6 6" />
            </svg>
          </a>
        </span>

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

    <?php
    /**
     * Formulario del hero. Permanente: se dibuja al cargar, sin clic.
     *
     * Se muestra desde xl. Por debajo la rejilla vuelve a una sola columna y
     * el componente cae a modal — el CTA del hero recupera su papel de
     * disparador. El umbral está en dos lugares que tienen que moverse
     * juntos: la clase xl:block de este nodo y la prop inlineMinWidth.
     *
     * Sin trigger: esta instancia no intercepta ningún clic. Los botones
     * "Request a Bid" de esta página —el del hero, el del navbar, el de la
     * barra inferior en móvil y el del footer— navegan a /contact, esté el
     * panel visible o no.
     *
     * Antes interceptaba y llevaba el foco al campo del hero. Se quitó: un
     * botón que dice lo mismo en toda la página tiene que hacer lo mismo en
     * toda la página, y que a veces navegue y a veces desplace es justo la
     * clase de inconsistencia que hace desconfiar de un CTA.
     */
    $ec_hero_form_props = array(
      'variant'        => 'inline',
      'persistent'     => true,
      'density'        => 'compact',
      'inlineMinWidth' => '(min-width: 1280px)',
      'endpoint'       => esc_url_raw(rest_url('ec/v1/bid')),
      'nonce'          => wp_create_nonce('wp_rest'),
      'phone'          => '(385) 240-3907',
    );
    ?>

    <div
      id="ec-hero-form"
      class="hidden max-h-[calc(100svh-var(--header-offset)-8rem)] xl:block"
      data-props="<?php echo esc_attr(wp_json_encode($ec_hero_form_props)); ?>"
    ></div>
  </div>
</section>

<!-- ═══════════════ 02 · BARRA DE PRUEBA ═══════════════ -->
<!-- Se queda oscura a propósito. EMBER sobre SAND da 4.39:1, que a este
     tamaño de cifra sobra; sobre el claro de BREEZE caería a 4.08:1 y habría
     que repintarlas de verde o de negro — y las cifras dejarían de ser lo
     primero que se ve. Como banda oscura bajo un hero claro cumple además una
     segunda función: separa el hero del bloque 03, que también es claro. -->
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
<!-- Galería en arco, inspirada en el CircularGallery de Vue Bits.

     Reimplementada con DOM y transforms CSS en lugar de WebGL, y esa no es
     una concesión: es mejor para esta página. El original dibuja todo dentro
     de un canvas —imágenes como texturas y los títulos como mapas de bits
     generados a mano—, lo que significa que Google no ve una sola palabra de
     esta sección, que las fotos no tienen alt, que no hay lazy loading y que
     el texto no se puede seleccionar. En una sección cuyo trabajo es
     posicionar cinco tipos de comprador, eso es caro.

     Con transforms el arco se ve igual y las imágenes siguen siendo <img> y
     los títulos siguen siendo texto.

     Lo único que se pierde del original es la distorsión de onda del shader
     al arrastrar rápido. No se extraña.

     Y una diferencia deliberada: el original secuestra la rueda del mouse
     con un listener en window, así que scrollear la página mueve la galería.
     Acá se arrastra o se usan las flechas; la rueda sigue siendo del
     documento. -->
<section id="commercial" class="relative isolate overflow-hidden bg-bone lg:flex lg:min-h-svh lg:items-start">

  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div data-reveal class="max-w-3xl">
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Who we build for</p>
      <h2 class="ec-shine font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
        You’re not buying landscaping. You’re buying a schedule that holds.
      </h2>
      <p class="mt-5 text-lg leading-relaxed text-ink/70">
        Every commercial buyer we work with is managing a different kind of risk. Here’s how we take it off your desk.
      </p>
    </div>

    <div data-arcgallery data-bend="90" class="mt-12 lg:mt-16">

      <div class="mb-6 flex items-end justify-between gap-6">
        <p class="max-w-md text-xs leading-relaxed text-ink/50">Drag, or use the arrows.</p>
        <div class="hidden shrink-0 items-center gap-2 lg:flex">
          <button type="button" data-arcgallery-prev aria-label="Previous buyer"
            class="flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 text-ink transition-colors duration-200 hover:bg-breeze-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="h-4 w-4"><path d="M19 12H6M11 6l-6 6 6 6" /></svg>
          </button>
          <button type="button" data-arcgallery-next aria-label="Next buyer"
            class="flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 text-ink transition-colors duration-200 hover:bg-breeze-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="h-4 w-4"><path d="M5 12h13M13 6l6 6-6 6" /></svg>
          </button>
        </div>
      </div>

      <!-- Punto de partida: una rejilla legible con las cinco tarjetas
           completas, párrafo incluido. El JS la convierte en arco. Sin JS
           —o con prefers-reduced-motion— queda la rejilla, que es la que
           lleva el argumento de la sección.

           Los párrafos no desaparecen al convertirse: el JS los oculta de
           las tarjetas y muestra el de la tarjeta centrada debajo del arco.
           El copy del bloque 03 es lo más trabajado del deck y no se cambia
           por un efecto. -->
      <ul data-arcgallery-track class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($clusters as $i => $cluster) : ?>
          <li data-arcgallery-item class="flex flex-col">
            <figure class="flex flex-col">
              <?php if (!empty($cluster['image'])) : ?>
                <img
                  src="<?php echo esc_url($cluster['image']); ?>"
                  alt="<?php echo esc_attr($cluster['alt']); ?>"
                  class="aspect-[3/4] w-full rounded-lg object-cover ring-1 ring-slate-200"
                  loading="lazy"
                  decoding="async"
                  draggable="false"
                  data-arcgallery-media
                />
              <?php else : ?>
                <!-- Todavía sin foto. Panel en la paleta con el número, en
                     lugar de un hueco gris: se ve intencional mientras
                     llegan los archivos, y el arco se puede evaluar igual.
                     Se borra este else cuando estén las cinco. -->
                <div
                  class="flex aspect-[3/4] w-full items-end justify-end rounded-lg bg-[linear-gradient(150deg,#696D56_0%,#565945_100%)] p-6 ring-1 ring-slate-200"
                  data-arcgallery-media
                  aria-hidden="true"
                >
                  <span class="font-display text-[4rem] font-bold leading-none tracking-tight text-bone/25 tabular-nums">
                    <?php echo esc_html(str_pad((string) ((int) $i + 1), 2, '0', STR_PAD_LEFT)); ?>
                  </span>
                </div>
              <?php endif; ?>

              <figcaption class="mt-4 font-display text-lg font-bold leading-snug tracking-tight text-ink" data-arcgallery-title>
                <?php echo esc_html($cluster['title']); ?>
              </figcaption>
            </figure>

            <p class="mt-3 text-sm leading-relaxed text-ink/70" data-arcgallery-body>
              <?php echo esc_html($cluster['body']); ?>
            </p>
          </li>
        <?php endforeach; ?>
      </ul>

      <!-- Párrafo de la tarjeta centrada. Solo se usa en modo arco; en la
           rejilla los párrafos viven dentro de cada tarjeta. -->
      <p
        data-arcgallery-caption
        hidden
        aria-live="polite"
        class="mx-auto mt-10 max-w-2xl text-center text-base leading-relaxed text-ink/70 transition-opacity duration-200"
      ></p>
    </div>
  </div>
</section>

<!-- ═══════════════════ 04 · PRECEDENTE INSTITUCIONAL ═══════════════════ -->
<!-- Video a sangre. A diferencia del hero, aquí el scrim NO puede ser
     asimétrico: las dos tarjetas de caso ocupan todo el ancho, así que la
     mitad derecha también lleva texto. Es un velo oscuro parejo, apenas más
     denso arriba, que garantiza el contraste caiga donde caiga el fotograma. -->
<section id="projects" class="relative isolate overflow-hidden bg-ink text-bone lg:flex lg:min-h-svh lg:items-stretch">

  <video
    data-bg-video
    class="absolute inset-0 -z-20 h-full w-full object-cover"
    data-src="<?php echo esc_url($projects_video); ?>"
    <?php if ($projects_poster) : ?>poster="<?php echo esc_url($projects_poster); ?>"<?php endif; ?>
    muted
    loop
    playsinline
    preload="none"
    aria-hidden="true"
    tabindex="-1"
  ></video>

  <div
    class="absolute inset-0 -z-10 bg-[linear-gradient(180deg,rgba(47,52,45,0.92)_0%,rgba(47,52,45,0.86)_45%,rgba(47,52,45,0.8)_100%)]"
    aria-hidden="true"
  ></div>

  <!-- Columna: el encabezado ocupa lo suyo y la rejilla de casos se queda
       con todo el alto sobrante. Eso es lo que hace que las tarjetas lleguen
       hasta abajo en lugar de dejar media pantalla de video vacía. -->
  <div class="relative flex w-full flex-col px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="max-w-3xl">
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember">Track record</p>
      <h2 class="ec-shine ec-shine--light font-display text-3xl leading-tight font-bold tracking-tight text-bone sm:text-4xl">
        Brands that audit every vendor already hired us.
      </h2>
      <p class="mt-5 text-lg leading-relaxed text-bone/75">
        Two institutional brands with corporate procurement standards reviewed our licensing, insurance and capacity — and paid us to build. That’s not a testimonial. That’s a precedent.
      </p>
    </div>

    <div class="mt-12 grid gap-6 lg:min-h-0 lg:flex-1 lg:grid-cols-2">
      <?php foreach ($cases as $case) : ?>
        <!-- Mismo tratamiento de superficie que la barra flotante del navbar:
             rounded-lg + ring-1 ring-white/10 + shadow-lg shadow-ink/10 +
             backdrop-blur-md. El fondo se queda en ink/55 y no en ink/95
             para que el video siga leyéndose por detrás de la tarjeta. -->
        <article class="flex flex-col overflow-hidden rounded-lg bg-ink/55 shadow-lg shadow-ink/10 ring-1 ring-white/10 backdrop-blur-md">
          <?php if (!empty($case['image'])) : ?>
            <!-- La imagen absorbe el alto sobrante (flex-1 + min-h-0) y el
                 texto conserva el suyo. Sin min-h-0 la imagen empujaría la
                 tarjeta más allá de la sección en vez de recortarse. -->
            <img
              src="<?php echo esc_url($case['image']); ?>"
              alt="<?php echo esc_attr($case['alt']); ?>"
              class="h-52 w-full shrink-0 object-cover lg:h-auto lg:min-h-[12rem] lg:flex-1 lg:shrink"
              loading="lazy"
              decoding="async"
            />
          <?php endif; ?>

          <div class="p-8">
            <p class="text-[0.65rem] font-semibold uppercase tracking-[0.18em] text-ember">
              <?php echo esc_html($case['kicker']); ?>
            </p>
            <h3 class="mt-4 font-display text-xl leading-snug font-bold tracking-tight text-bone">
              <?php echo esc_html($case['title']); ?>
            </h3>
            <p class="mt-4 text-sm leading-relaxed text-bone/70">
              <?php echo esc_html($case['body']); ?>
            </p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <p class="mt-8 text-xs text-bone/70">
      Client names and contract values available on request under NDA.
    </p>
  </div>
</section>

<!-- ═══════════════════════ 05 · CAPACIDADES ═══════════════════════ -->
<section id="capabilities" class="bg-breeze-100 lg:flex lg:min-h-svh lg:items-start">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="max-w-3xl">
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Capabilities</p>
      <h2 class="ec-shine font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
        What we self-perform.
      </h2>
      <p class="mt-5 text-lg leading-relaxed text-ink/70">
        Most landscape contractors in this corridor subcontract the heavy work and manage it from a truck. We hold the license, own the equipment and put our own people on your site.
      </p>
    </div>

    <!-- ── Marquee ───────────────────────────────────────────────────
         Sigue siendo un contenedor con scroll nativo: el desplazamiento
         continuo lo empuja el JS moviendo scrollLeft, no una animación de
         transform. Esa decisión es la que permite que el dedo, la rueda y
         el teclado sigan funcionando encima del movimiento — con un
         transform animado el contenido se vuelve intocable.

         El bucle es infinito porque la lista se imprime dos veces. Al llegar
         a la mitad exacta del recorrido se resta esa mitad de scrollLeft: el
         contenido en pantalla es idéntico, así que el salto no se ve. -->
    <div data-carousel data-marquee class="mt-12">

      <!-- Encabezado del control: las flechas viven arriba a la derecha y no
           flotando sobre las tarjetas. Encima de la foto habría que resolver
           contraste contra cuatro imágenes distintas. -->
      <div class="mb-6 flex items-end justify-between gap-6">
        <p class="max-w-md text-xs leading-relaxed text-ink/50">
          Four scopes, one contract, one crew.
        </p>

        <div class="hidden shrink-0 items-center gap-2 lg:flex">
          <button
            type="button"
            data-carousel-prev
            aria-label="Previous capability"
            class="flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 text-ink transition-[box-shadow,background-color] duration-200 hover:bg-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transition-none"
          >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="h-4 w-4">
              <path d="M19 12H6M11 6l-6 6 6 6" />
            </svg>
          </button>
          <button
            type="button"
            data-carousel-next
            aria-label="Next capability"
            class="flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 text-ink transition-[box-shadow,background-color] duration-200 hover:bg-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transition-none"
          >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="h-4 w-4">
              <path d="M5 12h13M13 6l6 6-6 6" />
            </svg>
          </button>
        </div>
      </div>

      <!-- La pista sangra hasta el borde de la pantalla con márgenes negativos
           y recupera la alineación con su propio padding. Así la tarjeta que
           asoma se corta contra el borde del viewport y no contra un margen.

           Ya no lleva scroll-snap ni scroll-smooth: los dos pelean con un
           scrollLeft que se reescribe en cada frame — el snap tironea de
           vuelta y el smooth anima el salto del bucle, que es justo lo que
           tiene que ser instantáneo.

           tabindex=0: un contenedor con scroll necesita foco propio para que
           se pueda recorrer con las flechas del teclado. -->
      <ul
        data-carousel-track
        tabindex="0"
        aria-label="Capabilities"
        class="-mx-5 flex gap-5 overflow-x-auto px-5 pb-2 [scrollbar-width:none] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember sm:-mx-8 sm:px-8 lg:-mx-10 lg:px-10 [&::-webkit-scrollbar]:hidden"
      >
        <?php
        /* Dos pasadas: la real y su copia. La copia va aria-hidden y con alt
           vacío — para un lector de pantalla las capacidades son cuatro, no
           ocho. El navegador reusa las mismas imágenes de caché, así que la
           duplicación no cuesta descargas. */
        for ($ec_pass = 0; $ec_pass < 2; $ec_pass++) :
          $ec_clone = (1 === $ec_pass);
          foreach ($capabilities as $item) : ?>
            <li
              class="w-[80vw] shrink-0 sm:w-[23rem] lg:w-[25rem]"
              <?php echo $ec_clone ? 'aria-hidden="true"' : ''; ?>
            >
              <article class="flex h-full flex-col overflow-hidden rounded-lg bg-bone ring-1 ring-slate-200 transition-shadow duration-300 hover:shadow-xl hover:shadow-ink/10 motion-reduce:transition-none">

                <?php if (!empty($item['image'])) : ?>
                  <img
                    src="<?php echo esc_url($item['image']); ?>"
                    alt="<?php echo $ec_clone ? '' : esc_attr($item['alt']); ?>"
                    class="aspect-[4/3] w-full object-cover"
                    loading="lazy"
                    decoding="async"
                  />
                <?php else : ?>
                  <!-- Respaldo: si una imagen se cae en la migración, la tarjeta
                       queda con un panel liso en verde de marca en lugar de un
                       ícono de imagen rota. Barato de mantener, así que se queda. -->
                  <div class="aspect-[4/3] w-full bg-[linear-gradient(150deg,#696D56_0%,#565945_100%)]" aria-hidden="true"></div>
                <?php endif; ?>

                <div class="flex flex-1 flex-col border-t-2 border-forest p-7">
                  <h3 class="font-display text-lg font-bold tracking-tight text-ink">
                    <?php echo esc_html($item['title']); ?>
                  </h3>
                  <p class="mt-3 text-sm leading-relaxed text-ink/70">
                    <?php echo esc_html($item['body']); ?>
                  </p>
                </div>
              </article>
            </li>
          <?php endforeach;
        endfor; ?>
      </ul>
    </div>
  </div>
</section>

<!-- ═══════════════════ 07 · CÓMO TRABAJAMOS ═══════════════════ -->
<section class="bg-bone lg:flex lg:min-h-svh lg:items-start">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="max-w-3xl">
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Process</p>
      <h2 class="ec-shine font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
        How a bid becomes a finished site.
      </h2>
    </div>

    <ol class="mt-12 flex flex-col">
      <?php foreach ($process as $step) : ?>
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

<!-- ═══════════════════ 08 · CREDENCIALES ═══════════════════ -->
<!-- Hallmark · redesign · seccion: credenciales · genre: editorial
     fingerprint: masthead de doble filete · ledger 3x3 · banda oscura plana ·
     imagen como estampilla · reveal: ninguno
     pre-emit critique: P5 H4 E4 S5 R5 V5

     El problema no era la foto ni la tabla: era que esta sección se parecía a
     las otras siete. Toda la página abre con eyebrow, titular y lede apilados
     a la izquierda dentro de una tarjeta redondeada con bisel — y Credentials
     es justamente la que no debería leerse como un bloque de marketing. El
     copy lo dice: "Boring for everyone else. Decisive for you."

     Cuatro decisiones, en orden de cuánto pesan:

     1. Banda oscura y plana, sin tarjeta. Después de Projects la página son
        seis secciones claras seguidas. UMBER devuelve la alternancia y le da
        a esta el peso que el copy reclama. Y al no ser una tarjeta deja de
        competir con las otras siete que sí lo son.

     2. Masthead en lugar de encabezado. Doble filete arriba, entidad a la
        izquierda y número de licencia a la derecha, en versalitas. Es como
        empieza un documento, no una landing.

     3. Ledger 3x3. Nueve credenciales entran exactas en tres columnas. Las
        etiquetas van sobre los valores en lugar de al lado: en una retícula
        de tres, una tabla etiqueta|valor deja media línea en blanco por celda.

     4. Sin reveal ni destello. Un documento no entra animándose. Es la única
        sección de la página que no se mueve, y esa quietud es parte de lo que
        afirma.

     Contraste verificado sobre la superficie umber (ahora OLIVE #696D56, un
     tono medio y no un oscuro): bone a plena da 4.68:1 y cualquier opacidad
     por debajo rompe AA, así que acá el texto va sin opacidad y las reglas
     suben a white/25. -->
<section id="credentials" class="bg-umber text-bone">
  <div class="w-full px-5 py-14 sm:px-8 lg:px-10 lg:py-20">

    <!-- ── Masthead ──
         Doble filete arriba y simple abajo: la asimetría es la que hace que
         se lea como cabecera de documento y no como un separador cualquiera. -->
    <div class="border-b border-t-2 border-white/25 py-3">
      <div class="flex flex-wrap items-baseline justify-between gap-x-8 gap-y-1">
        <p class="text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300">
          Credentials · EC Landscaping LLC
        </p>
        <!-- overflow-wrap:anywhere y no break-all: a 320px el número de
             licencia es lo único que puede desbordar la fila. -->
        <p class="text-[0.68rem] font-semibold uppercase tracking-[0.14em] text-bone tabular-nums [overflow-wrap:anywhere]">
          Utah 1106462255001 · S330
        </p>
      </div>
    </div>

    <!-- ── Titular a dos columnas ──
         El lede deja de ir debajo del titular y pasa al costado. Es el mismo
         texto, pero la disposición ya no repite la de las otras secciones —
         que es exactamente lo que hacía que esta se sintiera genérica. -->
    <div class="mt-10 grid gap-5 lg:grid-cols-[minmax(0,1.6fr)_minmax(0,1fr)] lg:items-end lg:gap-16">
      <h2 class="font-display text-3xl leading-[1.1] font-bold tracking-tight text-bone [overflow-wrap:anywhere] sm:text-4xl lg:text-5xl">
        The page your compliance team is going to ask for.
      </h2>
      <p class="text-base leading-relaxed text-bone lg:pb-2">
        Boring for everyone else. Decisive for you.
      </p>
    </div>

    <!-- ── Ledger ──
         Nueve credenciales, tres columnas, filetes horizontales continuos.
         Las celdas se tocan (sin gap) para que la regla inferior cruce la
         fila entera; la separación entre columnas la da el padding y la
         hairline vertical de lg.

         minmax(0,1fr) y no 1fr: con 1fr una celda de contenido largo estira
         la columna y rompe la retícula. -->
    <dl class="mt-11 grid grid-cols-[minmax(0,1fr)] border-t border-white/25 sm:grid-cols-[repeat(2,minmax(0,1fr))] lg:grid-cols-[repeat(3,minmax(0,1fr))]">
      <?php foreach ($credentials as $row) : ?>
        <div class="border-b border-white/25 py-4 pr-6 lg:[&:nth-child(3n)]:border-l lg:[&:nth-child(3n)]:border-white/25 lg:[&:nth-child(3n)]:pl-8 lg:[&:nth-child(3n+2)]:border-l lg:[&:nth-child(3n+2)]:border-white/25 lg:[&:nth-child(3n+2)]:pl-8">
          <dt class="text-[0.65rem] font-semibold uppercase tracking-[0.14em] text-bone">
            <?php echo esc_html($row['label']); ?>
          </dt>
          <dd class="mt-2 text-sm leading-relaxed text-bone tabular-nums [overflow-wrap:anywhere]">
            <?php echo esc_html($row['value']); ?>
          </dd>
        </div>
      <?php endforeach; ?>
    </dl>

    <!-- ── Estampilla ──
         El premio al pie, del tamaño de un sello, junto a la línea que dice
         qué es. Deja de ser media sección y pasa a ser lo que un documento
         lleva abajo: una marca que lo respalda.

         El alt describe la placa; el texto de al lado no lo repite. -->
    <div class="mt-10 flex flex-wrap items-center gap-6 border-t border-white/25 pt-7">
      <img
        src="<?php echo esc_url($ec_uploads['baseurl'] . '/2026/07/ec_landscaping_award.png'); ?>"
        alt="BusinessRate Best of 2026 Award Winner plaque"
        class="w-32 shrink-0 rounded object-contain ring-1 ring-white/25 sm:w-40 lg:w-48"
        loading="lazy"
        decoding="async"
      />
      <div>
        <p class="text-[0.65rem] font-semibold uppercase tracking-[0.14em] text-bone">Recognition</p>
        <p class="mt-1 text-sm leading-relaxed text-bone">
          BusinessRate Best of 2026 — Landscaper
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════ 09 · ÁREA DE SERVICIO ═══════════════════ -->
<section id="service-area" class="bg-bone lg:flex lg:min-h-svh lg:items-start">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="grid gap-12 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.2fr)] lg:gap-16">

      <!-- ── Columna izquierda: la promesa y su diagrama ── -->
      <div>
        <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Service area</p>
        <h2 class="ec-shine font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
          Where we work.
        </h2>
        <p class="mt-5 text-base leading-relaxed text-ink/70">
          50 miles from our Ogden yard, and up to 90 miles for large commercial installations. If your project sits outside that line and the scope justifies the drive, ask us anyway.
        </p>

        <?php
        /* El mapa se arma de la misma cadena de dirección que el NAP del
           footer. Escrita una vez acá y derivadas las dos URLs: si mañana
           cambia la dirección, no queda un mapa apuntando a la anterior.

           output=embed es la forma sin API key. Sirve para un mapa de lugar
           como este; si en algún momento hace falta controlar zoom, marcadores
           o estilo, ahí sí toca Maps Embed API y su clave. */
        $ec_map_query = '3754 N Higley Rd Suite 2, Ogden, UT 84404';
        $ec_map_embed = 'https://www.google.com/maps?q=' . rawurlencode($ec_map_query) . '&output=embed';
        $ec_map_href  = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($ec_map_query);
        ?>

        <!-- Marco del mapa. El iframe va en absolute dentro de un contenedor
             con proporción fija: así el alto queda reservado antes de que
             cargue y la sección no salta cuando aparece.

             loading=lazy no es cosmético — sin eso el iframe arrastra el
             JavaScript de Maps en la carga inicial de una página que ya trae
             dos videos. -->
        <div class="relative mt-10 aspect-[4/3] w-full overflow-hidden rounded-lg bg-ink/5 ring-1 ring-slate-200 sm:aspect-[3/2]">
          <iframe
            src="<?php echo esc_url($ec_map_embed); ?>"
            title="Map showing EC Landscaping at 3754 N Higley Rd, Suite 2, Ogden, Utah"
            class="absolute inset-0 h-full w-full border-0"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            allowfullscreen
          ></iframe>
        </div>

        <!-- Las dos distancias siguen siendo información que el mapa no da:
             muestra dónde está el patio, no hasta dónde llega la cuadrilla. -->
        <dl class="mt-6 flex flex-wrap gap-x-10 gap-y-4 text-sm">
          <div>
            <dt class="text-[0.65rem] font-semibold uppercase tracking-[0.14em] text-ink/45">Yard</dt>
            <dd class="mt-1 text-ink">
              <a
                href="<?php echo esc_url($ec_map_href); ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="underline decoration-ember decoration-2 underline-offset-4 transition-colors hover:text-forest"
              >3754 N Higley Rd, Ogden</a>
            </dd>
          </div>
          <div>
            <dt class="text-[0.65rem] font-semibold uppercase tracking-[0.14em] text-ink/45">Standard radius</dt>
            <dd class="mt-1 tabular-nums text-ink">50 miles</dd>
          </div>
          <div>
            <dt class="text-[0.65rem] font-semibold uppercase tracking-[0.14em] text-ink/45">Large installs</dt>
            <dd class="mt-1 tabular-nums text-ink">Up to 90 miles</dd>
          </div>
        </dl>
      </div>

      <!-- ── Columna derecha: dónde, en dos niveles ──
           Los condados van en tipografía display y las ciudades en fichas
           debajo. La jerarquía no es decorativa: un GC piensa por condado
           —permisos, distrito de agua, jurisdicción— y un property manager
           piensa por ciudad. El bloque responde a los dos sin repetirse. -->
      <div>
        <h3 class="mb-5 text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ink/50">Counties served</h3>
        <ul class="border-t border-slate-200">
          <?php foreach ($service_counties as $county) : ?>
            <li class="flex items-baseline justify-between gap-6 border-b border-slate-200 py-4">
              <span class="font-display text-2xl font-bold tracking-tight text-ink sm:text-[1.75rem]">
                <?php echo esc_html($county); ?>
              </span>
              <span class="text-[0.65rem] font-semibold uppercase tracking-[0.14em] text-ink/40">County · Utah</span>
            </li>
          <?php endforeach; ?>
        </ul>

        <h3 class="mb-5 mt-12 text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ink/50">Core cities</h3>
        <ul class="flex flex-wrap gap-2">
          <?php foreach ($service_cities as $city) : ?>
            <li class="rounded-full border border-slate-200 bg-slate-100 px-4 py-2 text-sm text-ink">
              <?php echo esc_html($city); ?>
            </li>
          <?php endforeach; ?>
        </ul>

        <p class="mt-8 text-sm text-ink/60">
          Not on the list? Call the yard —
          <a href="tel:+13852403907" class="font-medium text-ink underline decoration-ember decoration-2 underline-offset-4 transition-colors hover:text-forest">(385) 240-3907</a>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════ 10 · REPUTACIÓN ═══════════════════ -->
<?php if (!empty($reviews)) : ?>
  <section class="bg-breeze-100 lg:flex lg:min-h-svh lg:items-start">
    <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
      <h2 class="ec-shine max-w-3xl font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
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
<section class="bg-bone lg:flex lg:min-h-svh lg:items-start">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="grid gap-10 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.6fr)] lg:gap-16">

      <!-- Encabezado pegajoso: el acordeón crece al abrirse y sin sticky el
           título se va de pantalla justo cuando el usuario está leyendo la
           respuesta más larga. self-start es lo que impide que la columna
           se estire y anule el sticky. -->
      <div class="lg:sticky lg:top-[calc(var(--header-offset)+3rem)] lg:self-start">
        <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">FAQ</p>
        <h2 class="ec-shine font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
          Questions estimators actually ask.
        </h2>

        <!-- La página ya no tiene bloque de CTA final, así que este es el
             último punto de contacto antes del footer. -->
        <p class="mt-6 max-w-sm text-base leading-relaxed text-ink/70">
          Not covered here? Ask the estimator directly — you’ll get the owner or the person who priced your job, not a call center.
        </p>
        <a
          href="tel:+13852403907"
          class="mt-6 inline-flex items-center gap-2.5 text-lg font-semibold tabular-nums text-ink underline decoration-ember decoration-2 underline-offset-8 transition-colors hover:text-forest focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember"
        >
          (385) 240-3907
        </a>
      </div>

      <!-- <details> nativo: acordeón accesible sin una línea de JavaScript. -->
      <div>
        <?php foreach ($faqs as $faq) : ?>
          <details class="group border-b border-slate-200 first:border-t first:border-slate-200">
            <summary class="flex cursor-pointer list-none items-start justify-between gap-6 py-6 marker:content-none [&::-webkit-details-marker]:hidden">
              <span class="font-display text-lg font-bold leading-snug tracking-tight text-ink transition-colors group-hover:text-forest group-open:text-forest sm:text-xl">
                <?php echo esc_html($faq['q']); ?>
              </span>
              <!-- El signo gira 45° al abrir: el mismo glifo hace de más y de
                   cruz, así que el estado se lee sin cambiar de ícono. -->
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true" class="mt-1 h-4 w-4 shrink-0 text-ember transition-transform duration-200 group-open:rotate-45 motion-reduce:transition-none">
                <path d="M12 5v14M5 12h14" />
              </svg>
            </summary>
            <!-- Filete ember a la izquierda de la respuesta: ata visualmente
                 el texto abierto con el ícono que lo abrió. -->
            <p class="mb-6 border-l-2 border-ember pl-5 text-[0.95rem] leading-relaxed text-ink/70">
              <?php echo esc_html($faq['a']); ?>
            </p>
          </details>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<?php
/* Schema FAQPage generado del mismo array $faqs. Es la clase de marcado que
   Google usa para los resultados enriquecidos de preguntas, y sale gratis:
   una fuente, dos salidas, imposible que se desincronicen. */
$faq_schema = array(
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
<script type="application/ld+json"><?php echo wp_json_encode($faq_schema); ?></script>

<script>
  /* Un solo manejador para todos los [data-bg-video] de la página.
     El src se asigna por JS, nunca en el HTML, por dos razones:

     1. No se descarga cuando no se va a ver. Tres casos:
        · prefers-reduced-motion — un video de fondo en loop es exactamente
          el movimiento que esa preferencia pide evitar.
        · pantallas chicas — el comprador de esta página revisa proveedores
          desde una obra, con datos móviles, y en móvil el scrim lo tapa
          casi por completo de todas formas.
        · saveData o 2G/3G.
        En esos casos queda el poster.

     2. Carga diferida por proximidad. Con dos videos en la página, cargar
        ambos al abrir duplica el peso inicial sin que se vea el segundo.
        El de projects no empieza a descargar hasta que su sección se
        acerca al viewport; el del hero ya está en pantalla, así que
        arranca de inmediato. */
  (function () {
    var videos = document.querySelectorAll('[data-bg-video]');
    if (!videos.length) return;

    var mq = window.matchMedia;
    var reduce = mq && mq('(prefers-reduced-motion: reduce)').matches;
    var small = mq && mq('(max-width: 767px)').matches;
    var net = navigator.connection || {};
    var thin = net.saveData === true || /^(slow-)?2g$|^3g$/.test(net.effectiveType || '');

    if (reduce || small || thin) return;

    function start(v) {
      if (!v.dataset.src || v.src) return;
      v.src = v.dataset.src;
      var p = v.play();
      if (p && p.catch) p.catch(function () { /* autoplay bloqueado: queda el poster */ });
    }

    if (!('IntersectionObserver' in window)) {
      Array.prototype.forEach.call(videos, start);
      return;
    }

    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        start(entry.target);
        io.unobserve(entry.target);
      });
    }, { rootMargin: '200px 0px' });

    Array.prototype.forEach.call(videos, function (v) { io.observe(v); });
  })();
  (function () {
    /* Destello en bucle. La clase se pone al entrar en pantalla y se QUITA al
       salir — antes se ponía una vez y se dejaba de observar, que era lo
       correcto para un disparo único y es lo peor posible para un bucle: una
       animación infinita en un titular que está tres pantallas más abajo
       repinta igual y se paga en batería.

       El CSS maneja el reposo entre pasadas; acá solo se decide qué titulares
       están animando. Con prefers-reduced-motion no se agrega nada. */
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
  (function () {
    /* Revelado por scroll. Genérico: observa cualquier [data-reveal] de la
       página, así que colgarlo de otro bloque no pide tocar este script.

       Si .ec-reveal no está en <html>, es porque el usuario pidió menos
       movimiento o porque el script de arranque no corrió: en ninguno de los
       dos casos hay nada oculto que revelar, así que se sale de una.

       unobserve al revelar: es una entrada, no un efecto de ida y vuelta.
       Volver a subir no debería re-esconder texto que ya se leyó. */
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

  (function () {
    /* Galería en arco — DOM y transforms, sin WebGL.

       La geometría es la misma del CircularGallery: cada elemento se coloca
       sobre la circunferencia de un círculo enorme cuyo punto más bajo pasa
       por el centro del contenedor.

         H = mitad del ancho visible
         B = cuánto baja el arco en el borde   (data-bend, en píxeles)
         R = (H² + B²) / 2B                    (radio del círculo)
         y = R − √(R² − x²)                    (caída a distancia x)
         θ = −signo(x) · asin(x / R)           (giro tangente al arco)

       B en píxeles y no en unidades de viewport como el original: acá el
       valor se puede leer como "la tarjeta del borde baja 90px", que es una
       frase que significa algo cuando alguien lo ajusta dentro de un año. */
    var raices = document.querySelectorAll('[data-arcgallery]');
    if (!raices.length) return;

    var mq = window.matchMedia;
    if (mq && mq('(prefers-reduced-motion: reduce)').matches) return;

    Array.prototype.forEach.call(raices, function (raiz) {
      var track = raiz.querySelector('[data-arcgallery-track]');
      var items = Array.prototype.slice.call(raiz.querySelectorAll('[data-arcgallery-item]'));
      var caption = raiz.querySelector('[data-arcgallery-caption]');
      if (!track || items.length < 2) return;

      var bendBase = parseFloat(raiz.dataset.bend) || 90;

      var anchoItem = 0, paso = 0, total = 0, H = 0, B = 0, R = 0, altoTrack = 0;
      var destino = 0, actual = 0, frame = null, visible = false;
      var arrastrando = false, x0 = 0, base = 0, movio = false;
      var activo = -1;

      function medir() {
        var anchoCaja = raiz.getBoundingClientRect().width;
        var angosto = anchoCaja < 640;

        /* En pantalla chica la tarjeta ocupa dos tercios del ancho, no un
           30% como en escritorio. Con la proporción de escritorio quedaba
           en 190px dentro de un viewport de 445 — una foto de sello en el
           medio, con las vecinas encimándosele por los dos lados.

           Acá solo hay sitio para una tarjeta y dos asomos, así que la del
           centro tiene que mandar. El hueco también crece: con tarjetas más
           anchas y giradas, el que servía en escritorio las hacía chocar. */
        /* Escritorio: 30% más grande que el arranque —de 0.30 del ancho a
           0.39, con el tope de 300px subido a 390—. Los tres números se
           mueven juntos: si solo se sube el porcentaje, el tope lo recorta y
           la tarjeta no crece en pantallas anchas, que es justo donde se
           notaba el aire.

           Angosto no cambia: ya estaba en dos tercios de pantalla y un 30%
           más la desbordaría. */
        anchoItem = angosto
          ? Math.round(Math.min(320, anchoCaja * 0.66))
          : Math.round(Math.min(390, Math.max(247, anchoCaja * 0.39)));
        var hueco = Math.round(anchoItem * (angosto ? 0.30 : 0.16));
        paso = anchoItem + hueco;
        total = paso * items.length;

        H = anchoCaja / 2;
        /* El arco se aplana en angosto. No es estética: la curvatura genera
           el giro, y con una tarjeta de dos tercios de pantalla un giro de
           20° la manda contra las vecinas. A 0.25 el giro del borde baja a
           unos 11°, que se lee como arco sin chocar. */
        /* Y se escala con el ancho por encima de eso. Con B fijo, una caja
           más angosta da un arco MÁS cerrado —el radio depende de H— así que
           a 768px el giro del borde salía en 26° contra los 17° del
           escritorio. Proporcional, los dos quedan en 17. */
        B = angosto ? bendBase * 0.25 : bendBase * Math.min(1, anchoCaja / 1200);
        R = (H * H + B * B) / (2 * B);

        // Alto de la tarjeta: la imagen es 3/4, más el título de dos líneas.
        var altoItem = anchoItem * (4 / 3) + 62;
        altoTrack = Math.round(altoItem + B + 16);

        track.style.position = 'relative';
        track.style.display = 'block';
        track.style.height = altoTrack + 'px';
        track.style.touchAction = 'pan-y';
        track.style.cursor = 'grab';
        track.style.userSelect = 'none';

        items.forEach(function (li) {
          li.style.position = 'absolute';
          li.style.top = '0';
          li.style.left = '50%';
          li.style.width = anchoItem + 'px';
          li.style.willChange = 'transform';
          var p = li.querySelector('[data-arcgallery-body]');
          if (p) p.style.display = 'none';   // el cuerpo se muestra bajo el arco
        });

        if (caption) caption.hidden = false;
      }

      function pintar() {
        frame = visible ? window.requestAnimationFrame(pintar) : null;

        // Suavizado: el destino se persigue, nunca se salta.
        actual += (destino - actual) * 0.085;

        var centrado = -1, mejor = Infinity;

        for (var i = 0; i < items.length; i++) {
          // Envoltura infinita: la posición se normaliza al rango
          // [-total/2, total/2), de modo que el que sale por un lado
          // reaparece por el otro sin que haya un principio ni un final.
          var x = i * paso - actual;
          x = ((x % total) + total * 1.5) % total - total / 2;

          var ax = Math.min(Math.abs(x), H);
          var y = R - Math.sqrt(Math.max(R * R - ax * ax, 0));
          var giro = -Math.sign(x) * Math.asin(ax / R) * (180 / Math.PI);

          /* Las de los extremos se apagan: sin eso, aparecen y desaparecen
             de golpe en el borde del contenedor. El umbral se mide contra el
             paso y no contra H, para que valga igual con tarjetas de 190px
             que con las de 300: lo que importa es cuántas tarjetas de
             distancia hay, no cuántos píxeles. */
          var borde = Math.max(0, Math.min(1, (paso * 1.9 - Math.abs(x)) / paso));

          var li = items[i];
          li.style.transform = 'translate3d(' + Math.round(x - anchoItem / 2) + 'px,' +
                               Math.round(y) + 'px,0) rotate(' + giro.toFixed(2) + 'deg)';
          li.style.opacity = borde.toFixed(3);
          li.style.zIndex = String(100 - Math.round(Math.abs(x) / 10));

          if (Math.abs(x) < mejor) { mejor = Math.abs(x); centrado = i; }
        }

        if (centrado !== activo && centrado > -1) {
          activo = centrado;
          if (caption) {
            var p = items[centrado].querySelector('[data-arcgallery-body]');
            caption.textContent = p ? p.textContent.trim() : '';
          }
          items.forEach(function (li, n) {
            var t = li.querySelector('[data-arcgallery-title]');
            if (t) t.style.opacity = n === centrado ? '1' : '0.45';
          });
        }
      }

      // Imán al soltar: el arco descansa con una tarjeta centrada, nunca
      // entre dos. Es lo que hace que la de adelante se lea completa.
      function imantar() {
        destino = Math.round(destino / paso) * paso;
      }

      function empujar(dir) {
        destino += dir * paso;
      }

      function abajo(e) {
        arrastrando = true; movio = false;
        x0 = e.touches ? e.touches[0].clientX : e.clientX;
        base = destino;
        track.style.cursor = 'grabbing';
      }
      function mueve(e) {
        if (!arrastrando) return;
        var x = e.touches ? e.touches[0].clientX : e.clientX;
        if (Math.abs(x - x0) > 3) movio = true;
        destino = base - (x - x0);
      }
      function arriba() {
        if (!arrastrando) return;
        arrastrando = false;
        track.style.cursor = 'grab';
        imantar();
      }

      track.addEventListener('mousedown', abajo);
      window.addEventListener('mousemove', mueve, { passive: true });
      window.addEventListener('mouseup', arriba);
      track.addEventListener('touchstart', abajo, { passive: true });
      track.addEventListener('touchmove', mueve, { passive: true });
      track.addEventListener('touchend', arriba, { passive: true });

      // Un arrastre no debe disparar el enlace que quedó bajo el dedo.
      track.addEventListener('click', function (e) {
        if (movio) { e.preventDefault(); e.stopPropagation(); }
      }, true);

      var prev = raiz.querySelector('[data-arcgallery-prev]');
      var next = raiz.querySelector('[data-arcgallery-next]');
      if (prev) prev.addEventListener('click', function () { empujar(-1); });
      if (next) next.addEventListener('click', function () { empujar(1); });

      var reTimer = null;
      window.addEventListener('resize', function () {
        if (reTimer) window.clearTimeout(reTimer);
        reTimer = window.setTimeout(medir, 120);
      }, { passive: true });

      medir();

      if ('IntersectionObserver' in window) {
        new IntersectionObserver(function (e) {
          visible = e[0].isIntersecting;
          if (visible && !frame) frame = window.requestAnimationFrame(pintar);
        }, { rootMargin: '120px 0px' }).observe(raiz);
      } else {
        visible = true;
        frame = window.requestAnimationFrame(pintar);
      }
    });
  })();

</script>

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