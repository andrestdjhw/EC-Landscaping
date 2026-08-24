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
  'micro'   => 'Utah License · S330 — General Liability, Workers’ Compensation and Commercial Auto certificates available on request.',

  // Se arma desde wp_get_upload_dir() para que la URL sobreviva la migración
  // de ec-landscaping.local a producción.
  //
  // Reemplaza a VIDEO-EC.mp4 (y antes a ECLanscapingHero-1.mp4), que siguen
  // en la biblioteca por si hay que volver atrás. El segmento de drone está
  // en la carpeta de agosto.
  'video'   => $ec_uploads['baseurl'] . '/2026/08/Segmento-drone-9-EC-landscaping.mp4',

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
$ec_img_pm        = $ec_uploads['baseurl'] . '/2026/08/GroundsMaintenance.jpg';

// Prompt: "residential community entrance landscaping" — área común, no una casa
$ec_img_hoa       = $ec_uploads['baseurl'] . '/2026/08/LandscapingProject3.jpg';

// Prompt: "corporate campus building landscape"
$ec_img_multisite = $ec_uploads['baseurl'] . '/2026/08/LanscapingCapabilitiesMultifamily.jpg';

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

   Cada tarjeta enlaza a su página de capacidad. El href se arma con
   home_url() y no con una ruta literal: si WordPress vive en un
   subdirectorio, una ruta absoluta desde la raíz se rompe.

   Los slugs tienen que coincidir con los de las páginas creadas en el admin:
   landscape-installation · hardscape-concrete · grounds-maintenance ·
   water-wise-retrofits.

   Las rutas se arman desde wp_get_upload_dir() y no se pegan literales, igual
   que el hero y los casos: así la URL sobrevive la migración de
   ec-landscaping.local a producción sin tocar código.
*/
$capabilities = array(
  array(
    'title' => 'Commercial landscape installation',
    'body'  => 'New construction, retail pads, branch sites, multifamily and industrial. Grading and soil preparation, irrigation mains and zones, planting, sod, trees and final grade to plan.',
    'image' => $ec_uploads['baseurl'] . '/2026/08/ECLandscaping.jpg',
    'href'  => home_url('/landscape-installation'),
    'alt'   => 'Commercial landscape installation in progress on a Northern Utah site',
  ),
  array(
    'title' => 'Hardscape & concrete',
    'body'  => 'Retaining walls, paver plazas and walkways, flat and stamped concrete, curbing, site walls and pool decks — self-performed under our own concrete and masonry license.',
    'image' => $ec_uploads['baseurl'] . '/2026/08/ECHardscape.jpg',
    'href'  => home_url('/hardscape-concrete'),
    'alt'   => 'Retaining wall and paver hardscape under construction',
  ),
  array(
    'title' => 'Grounds maintenance, irrigation & snow',
    'body'  => 'Annual contracts covering mowing, fertilization, pruning, spring startup, smart irrigation management, fall winterization, and snow and ice management through the winter. One vendor, twelve months.',
    'image' => $ec_uploads['baseurl'] . '/2026/08/GroundsMaintenance.jpg',
    'href'  => home_url('/grounds-maintenance'),
    'alt'   => 'Grounds maintenance on a commercial property',
  ),
  array(
    'title' => 'Water-wise retrofits',
    'body'  => 'Turf conversion, drip and smart controllers, native and adapted plantings, and design that meets local water district requirements without looking like a gravel lot.',
    'image' => $ec_uploads['baseurl'] . '/2026/07/WaterWiseRetrofits-scaled.webp',  // sin reemplazo aún
    'href'  => home_url('/water-wise-retrofits'),
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


<!-- ═══════════════════════ 01 · HERO ═══════════════════════ -->
<!-- Video a sangre detrás de toda la sección. El texto sigue en oscuro sobre
     claro, así que la legibilidad no puede depender de lo que salga en el
     video: la resuelve un scrim asimétrico, casi opaco en la columna de
     texto y transparente a la derecha. Eso mantiene el hero claro y deja
     ver el video como presencia, sin apostar el contraste a un fotograma. -->
<!-- Hero + barra de prueba comparten una pantalla SOLO cuando el alto
     alcanza. El clamp h-svh se condiciona a min-height:880px: en una laptop
     corta (720–800px de alto útil) forzar todo dentro de un viewport
     comprimía el hero — el formulario recortaba sus últimos campos y
     activaba el scroll interno, los textos encogían y el micro-texto se
     ocultaba. Por debajo del umbral la página fluye natural: el formulario
     se muestra completo, el texto conserva su tamaño y la barra de prueba
     queda tras un scroll corto.

     Cuando el clamp aplica, el contenedor mide un viewport y reparte el
     espacio: el hero toma lo que sobra (flex-1) y la barra ocupa lo que
     necesita. Así no hay que adivinar el alto de la barra con un número
     mágico que se rompe al cambiar el copy de las etiquetas.
     Solo en lg: en móvil la barra son dos filas y forzarlas dentro de la
     pantalla aplastaría el titular. -->
<div class="lg:flex lg:flex-col [@media(min-width:1024px)_and_(min-height:880px)]:h-svh">
<section class="relative isolate overflow-hidden bg-umber text-bone lg:min-h-0 lg:flex-1">

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

  <!-- Scrim: velo verde casi UNIFORME, al estilo del hero de BC Landscaping
       — el video se ve claramente en toda la sección, teñido parejo, y el
       texto claro vive encima del metraje.

       El tono es OLIVE (#696D56), el verde de marca. Como base del velo es
       mejor superficie que el clay-600 que llevaba antes: LINEN sobre OLIVE
       da 8.16:1 contra los 5.15:1 del terracota, así que el texto claro
       tiene más margen frente a lo que salga en el video.

       Sigue habiendo un sesgo leve hacia la columna de texto (0.74 → 0.55):
       con un velo tan abierto, la legibilidad depende en parte del metraje,
       y ese cuarto de opacidad extra del lado izquierdo es el seguro contra
       un cielo blanco en el segmento de drone. LA PERILLA ES EL PRIMER
       VALOR: si en el navegador el titular se lava contra una toma clara,
       subí el 0.74 hacia 0.85; si querés más video, bajalo — pero probalo
       contra el fotograma más claro del loop, no contra el más oscuro.

       bg-umber en la sección (alias de OLIVE, la misma superficie que usan
       credenciales y las bandas de cierre): es lo que se ve el instante
       previo a que cargue el video, y lo que queda cuando el video no carga
       (móvil, reduced-motion, saveData).

       Gradiente explícito en lugar de utilidad de Tailwind para no depender
       del renombre de bg-gradient-* a bg-linear-* en v4. -->
  <div
    class="absolute inset-0 -z-10 bg-[linear-gradient(100deg,rgba(105,109,86,0.74)_0%,rgba(105,109,86,0.68)_40%,rgba(105,109,86,0.6)_70%,rgba(105,109,86,0.55)_100%)]"
    aria-hidden="true"
  ></div>

  <!-- El padding-top reserva el alto del header, que ahora flota encima en
       lugar de empujar la página. min-h en svh y no vh: en móvil, vh incluye
       la barra de direcciones y el hero salta cuando aparece o desaparece.

       h-full y min-h-0 van tras el mismo umbral de alto que el clamp del
       contenedor: solo tienen sentido cuando el hero mide una pantalla. En
       pantallas cortas el clamp no aplica, así que acá manda el min-h-[38rem]
       y el contenido fluye a su altura natural — un h-full contra un padre
       de alto automático no resuelve nada, y el min-h-0 anularía el piso de
       38rem justo donde hace falta.

       Desde xl el hero es una rejilla de dos columnas reales, no un texto con
       un panel flotando encima. El formulario dejó de ser una capa que aparece
       al hacer clic: ahora está siempre, así que necesita ocupar su espacio en
       el layout. Con position:absolute el titular no sabría que hay algo a su
       derecha y a 1280px exactos se tocarían. -->
  <div class="relative flex min-h-[38rem] items-center px-5 pb-20 pt-[calc(var(--header-offset)+1rem)] sm:px-8 lg:px-10 lg:pb-12 lg:pt-[var(--header-offset)] [@media(min-width:1024px)_and_(min-height:880px)]:h-full [@media(min-width:1024px)_and_(min-height:880px)]:min-h-0 xl:grid xl:grid-cols-[minmax(0,1fr)_27rem] xl:items-stretch xl:gap-12 2xl:grid-cols-[minmax(0,1fr)_30rem]">

    <!-- La columna de texto se centra por su cuenta desde xl.

         Hasta xl la sección es un flex con items-center y el texto queda
         centrado solo. Desde xl pasa a rejilla con items-stretch —que es lo
         que impide al panel del formulario estirar la fila y desbordar— y
         eso estira también esta columna: se vuelve tan alta como la fila,
         pero su contenido sigue fluyendo desde arriba y queda pegado al
         borde superior.

         min-h-0 acompaña al justify-center: sin él, una columna estirada no
         puede encogerse por debajo de su contenido y el centrado no tiene
         contra qué calcularse. -->
    <div class="max-w-3xl xl:flex xl:min-h-0 xl:flex-col xl:justify-center">
      <!-- Sobre el velo el eyebrow no puede seguir en forest: el olive
           desaparece contra su propio matiz. Bone a plena es lo que aguanta
           el velo abriéndose.

           Sin variantes de max-height: la compresión de pantalla corta se
           retiró de todo el hero cuando el clamp de una pantalla pasó a ser
           condicional — donde no hay alto, la página crece en lugar de
           encoger el texto. -->
      <p class="mb-5 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-bone">
        <?php echo esc_html($hero['eyebrow']); ?>
      </p>
      <h1 class="ec-shine ec-shine--light font-display text-4xl leading-[1.08] font-bold tracking-tight text-bone sm:text-5xl lg:text-[3.4rem]">
        <?php echo esc_html($hero['title']); ?>
      </h1>
      <!-- Sin opacidad en el lede ni el micro: con el velo translúcido el
           margen de contraste depende del metraje, y cualquier atenuación
           come de ese margen. -->
      <p class="mt-6 max-w-2xl text-lg leading-relaxed text-bone">
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

             Sobre el velo OLIVE el botón y sus pulsos ember recuperan todo su
             contraste: naranja sobre verde es la oposición más fuerte que da
             la paleta, así que el CTA se lee primero — que es el punto. El
             hover vuelve a ember-600 (cuando el velo era clay-600 se fundía
             con el fondo y hubo que aclararlo).

             `group` vive en el envoltorio, no en el <a>: así los pulsos —que
             son hermanos del botón— pueden reaccionar al hover. El área es la
             misma, así que la flecha del botón sigue animando igual. -->
        <span class="group relative inline-flex">
          <span class="ec-cta-pulse absolute inset-0 transition-opacity duration-200 group-hover:opacity-0" aria-hidden="true"></span>
          <span class="ec-cta-pulse ec-cta-pulse--delayed absolute inset-0 rounded-full transition-opacity duration-200 group-hover:opacity-0" aria-hidden="true"></span>
          <a
            href="<?php echo esc_url($bid_href); ?>"
            data-bid-cta
            class="cta-relief-light relative inline-flex items-center gap-2.5 border-2 border-white/60 bg-ember py-4 pl-7 pr-6 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink transition-all duration-200 ease-out hover:cta-relief-light-tight hover:bg-ember-600 hover:-translate-y-px active:translate-y-0 active:shadow-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transform-none motion-reduce:transition-none"
          >
            Request a bid
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transform-none">
              <path d="M5 12h13M13 6l6 6-6 6" />
            </svg>
          </a>
        </span>

        <?php if ($deck_href) : ?>
          <a href="<?php echo esc_url($deck_href); ?>" class="text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-bone underline decoration-bone/60 decoration-2 underline-offset-8 transition-colors hover:text-white">
            Download capability deck (PDF)
          </a>
        <?php endif; ?>
      </div>

      <p class="mt-8 max-w-xl text-xs leading-relaxed text-bone">
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

    <!-- min-h-0 y no un max-h calculado sobre 100svh. Ese era el bug: el
         panel se limitaba contra la altura del VIEWPORT, pero el hero no mide
         un viewport — mide eso menos la barra de prueba, con la que comparte
         pantalla. El panel quedaba unos 90px más alto que su contenedor,
         estiraba la fila de la rejilla, y el overflow-hidden de la sección
         recortaba el CTA y el pie del formulario. En una pantalla de 15" eso
         es justo lo que se pierde.

         Ahora la celda se estira al alto real de la fila y min-h-0 le permite
         encogerse por debajo de su contenido, que es lo que deja al panel
         toparse con max-h-full y activar su scroll interno. El panel se
         centra dentro de la celda con items-center. -->
    <div
      id="ec-hero-form"
      class="hidden min-h-0 xl:flex xl:items-center"
      data-props="<?php echo esc_attr(wp_json_encode($ec_hero_form_props)); ?>"
    ></div>
  </div>
</section>

<!-- ═══════════════ 02 · BARRA DE PRUEBA ═══════════════ -->
<!-- Cuatro bloques, no cuatro celdas iguales. En la valla ningún módulo
     repite el color del vecino: el ritmo lo da la alternancia, no la
     retícula. Acá la primera cifra —31 personas en la cuadrilla, el
     diferenciador de toda la página— va sobre clay, y las otras tres sobre
     ink. Eso convierte la barra en una composición y no en una tabla.

     Se queda oscura a propósito: EMBER sobre PINE da 3.90:1, que a este
     tamaño de cifra sobra; sobre claro caería y habría que repintar los
     números. Y como banda oscura bajo un hero claro separa el hero del
     bloque 03. -->
<section class="relative bg-ink lg:shrink-0">

  <dl class="ec-plates grid grid-cols-2 gap-px bg-white/10 lg:grid-cols-4">
    <?php
    /* Tres superficies, no dos. Antes el primer bloque iba en clay y los
       otros tres en ink: tres oscuros seguidos, que es justo lo que la valla
       no hace. El tercero pasa a claro y la barra queda clay · ink · claro ·
       ink, sin dos vecinos iguales.

       Cada superficie arrastra su propio par de colores de texto, y ninguno
       es intercambiable:
         · sobre CLAY, ink a plena. Es un tono medio: a 75% cae a 2.76:1.
         · sobre INK, ember para la cifra y bone/70 para la etiqueta.
         · sobre CLARO, ember-600 y no ember. El ember base da 3.12:1 y falla
           incluso el mínimo de texto grande; el 600 da 4.92:1. */
    /* La cuarta entrada de cada fila es el filete de rayas del borde superior.

       Antes era UN solo elemento cruzando la barra entera, en LINEN. Sobre
       los bloques oscuros se veía y sobre el claro desaparecía — rayas claras
       sobre fondo claro— así que el remate se cortaba justo en el medio.

       Ahora el filete vive dentro de cada bloque y toma el color que
       contrasta con su propia superficie: ink sobre las dos claras, linen
       sobre las oscuras. Un elemento por bloque en lugar de uno global es lo
       que permite que el remate cruce entero. */
    $ec_superficies = array(
      0 => array('bg-ember',      'text-ink',        'text-ink',       'ec-band--ink'),
      1 => array('bg-ink',        'text-ember',      'text-bone/70',   ''),
      2 => array('bg-breeze-100', 'text-ember-600',  'text-ink/70',    'ec-band--ink'),
      3 => array('bg-ink',        'text-ember',      'text-bone/70',   ''),
    );

    foreach ($proof_bar as $i => $item) :
      list($ec_bg, $ec_num, $ec_lbl, $ec_banda) = isset($ec_superficies[$i])
        ? $ec_superficies[$i]
        : array('bg-ink', 'text-ember', 'text-bone/70', '');
      ?>
      <!-- Sin variantes de pantalla corta: la barra solo comparte viewport
           con el hero cuando el alto alcanza (el clamp es condicional), así
           que ya no necesita encoger. -->
      <div class="<?php echo esc_attr($ec_bg); ?> relative px-5 py-7 sm:px-8 lg:px-10 lg:py-4">

        <!-- Remate de rayas sobre el filo superior del bloque. Es el recurso
             de la valla girado: cierra el hero con el elemento gráfico de la
             marca en lugar de una línea lisa. -->
        <div class="ec-band ec-band--h <?php echo esc_attr($ec_banda); ?> pointer-events-none absolute inset-x-0 top-0 h-1.5 opacity-40" aria-hidden="true"></div>

        <dt class="font-display text-3xl font-bold tracking-tight <?php echo esc_attr($ec_num); ?> sm:text-4xl lg:text-[1.85rem]">
          <?php echo esc_html($item['stat']); ?>
        </dt>
        <dd class="mt-2 text-xs leading-relaxed <?php echo esc_attr($ec_lbl); ?> lg:mt-1">
          <?php echo esc_html($item['label']); ?>
        </dd>
      </div>
    <?php endforeach; ?>
  </dl>
</section>
</div>
<!-- ↑ cierra el contenedor de una pantalla que comparten hero y barra -->

<!-- ═══════════════════ 03 · PARA QUIÉN CONSTRUIMOS ═══════════════════ -->
<!-- Marquee, no galería en arco. Las tarjetas quedan planas, alineadas y en
     movimiento continuo.

     Reusa el mismo motor [data-carousel][data-marquee] que el carrusel de
     capacidades del bloque 05 — el que ya vive en el bloque de JavaScript al
     pie de esta plantilla. Eso quita 211 líneas: el arco necesitaba su motor
     para calcular radio, caída y giro por tarjeta, y nada de eso hace falta
     cuando las tarjetas van derechas.

     El cuerpo del copy vuelve DENTRO de cada tarjeta. En el arco vivía debajo
     porque solo se mostraba el de la tarjeta centrada; con movimiento continuo
     no hay una centrada, y un párrafo que cambia solo cada dos segundos es
     ilegible. Cada tarjeta lleva lo suyo. -->
<section id="commercial" class="relative isolate overflow-hidden bg-bone lg:flex lg:min-h-svh lg:items-start">

  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div data-reveal class="max-w-3xl">
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Who we build for</p>
      <h2 class="ec-shine ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
        You’re not buying landscaping.<br /><em>You’re buying a schedule that holds.</em>
      </h2>
      <p class="mt-5 text-lg leading-relaxed text-ink/70">
        Every commercial buyer we work with is managing a different kind of risk. Here’s how we take it off your desk.
      </p>
    </div>

    <div data-carousel data-marquee class="mt-12 lg:mt-16">

      <!-- Las flechas se quedan aunque ya no hagan falta para ver el
           contenido: son la salida para quien no puede o no quiere esperar a
           que pase la tarjeta que le interesa. El motor las empuja un paso y
           el movimiento retoma solo. -->
      <div class="mb-6 flex items-end justify-between gap-6">
        <p class="max-w-md text-xs leading-relaxed text-ink/50">Five buyers, five kinds of risk.</p>
        <div class="hidden shrink-0 items-center gap-2 lg:flex">
          <button type="button" data-carousel-prev aria-label="Previous buyer"
            class="flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 text-ink transition-colors duration-200 hover:bg-breeze-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="h-4 w-4"><path d="M19 12H6M11 6l-6 6 6 6" /></svg>
          </button>
          <button type="button" data-carousel-next aria-label="Next buyer"
            class="flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 text-ink transition-colors duration-200 hover:bg-breeze-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="h-4 w-4"><path d="M5 12h13M13 6l6 6-6 6" /></svg>
          </button>
        </div>
      </div>

      <!-- La pista sangra hasta el borde de la pantalla y recupera la
           alineación con su propio padding: la tarjeta que asoma se corta
           contra el borde del viewport, que es lo que hace legible que hay
           más a la derecha.

           Sin scroll-snap ni scroll-smooth: pelean con un scrollLeft que se
           reescribe en cada frame. -->
      <ul
        data-carousel-track
        tabindex="0"
        aria-label="Who we build for"
        class="-mx-5 flex gap-6 overflow-x-auto px-5 pb-2 [scrollbar-width:none] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember sm:-mx-8 sm:px-8 lg:-mx-10 lg:px-10 [&::-webkit-scrollbar]:hidden"
      >
        <?php
        /* Dos pasadas: la real y su copia. El bucle infinito del motor resta
           un ciclo exacto al llegar a la mitad, y para que ese salto no se
           vea el contenido tiene que ser idéntico. La copia va aria-hidden:
           para un lector de pantalla los compradores son cinco, no diez. */
        for ($ec_pass = 0; $ec_pass < 2; $ec_pass++) :
          $ec_clone = (1 === $ec_pass);
          foreach ($clusters as $i => $cluster) : ?>
            <li
              class="w-[80vw] shrink-0 sm:w-[22rem] lg:w-[24rem]"
              <?php echo $ec_clone ? 'aria-hidden="true"' : ''; ?>
            >
              <!-- Bloque plano, no tarjeta: sin anillo, sin sombra, sin radio.
                   En la valla y en la van todo es un rectángulo de color
                   macizo contra otro, y el filete superior en clay es lo
                   único que separa el pie del bloque de su imagen. -->
              <article class="flex h-full flex-col overflow-hidden bg-sand">
                <?php if (!empty($cluster['image'])) : ?>
                  <img
                    src="<?php echo esc_url($cluster['image']); ?>"
                    alt="<?php echo $ec_clone ? '' : esc_attr($cluster['alt']); ?>"
                    class="aspect-[4/3] w-full shrink-0 object-cover"
                    loading="lazy"
                    decoding="async"
                  />
                <?php else : ?>
                  <div class="aspect-[4/3] w-full bg-[linear-gradient(150deg,#696D56_0%,#565945_100%)]" aria-hidden="true"></div>
                <?php endif; ?>

                <div class="flex flex-1 flex-col border-t-4 border-ember p-7">
                  <h3 class="font-display text-lg font-bold leading-snug tracking-tight text-ink">
                    <?php echo esc_html($cluster['title']); ?>
                  </h3>
                  <p class="mt-3 text-sm leading-relaxed text-ink/70">
                    <?php echo esc_html($cluster['body']); ?>
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

<!-- ═══════════════════ 04 · PRECEDENTE INSTITUCIONAL ═══════════════════ -->
<!-- Rediseñado como composición modular sobre el video.

     Antes era el patrón genérico de la página: encabezado suelto arriba y dos
     tarjetas flotando debajo sobre un velo parejo. Ahora la sección es una
     rejilla de bloques macizos y el video se ve POR LOS HUECOS, no por detrás
     de tarjetas semitransparentes.

     Ese cambio es el que hace que se parezca a la valla: allá el video no
     existe, pero la lógica es la misma — módulos opacos que se tocan, y lo
     que queda entre ellos es lo que deja pasar el fondo. Un bloque
     translúcido encima de un video es lenguaje de interfaz; un bloque opaco
     con una ventana al lado es lenguaje de cartel.

     El scrim baja de 0.92 a 0.55: ya no tiene que garantizar contraste bajo
     todo el texto, porque el texto vive dentro de bloques opacos. Solo tiene
     que impedir que el video compita, y con menos velo el metraje se ve más.

     Deliberadamente NO lleva ec-shine: es la única sección con dos videos de
     por medio y el destello sobre metraje en movimiento se pierde. -->
<section id="projects" class="relative isolate overflow-hidden bg-ink text-bone lg:flex lg:min-h-svh lg:items-center">

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
    class="absolute inset-0 -z-10 bg-[linear-gradient(180deg,rgba(47,52,45,0.6)_0%,rgba(47,52,45,0.5)_50%,rgba(47,52,45,0.65)_100%)]"
    aria-hidden="true"
  ></div>

  <div class="relative w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">

    <!-- gap-px sin fondo: acá la línea entre módulos ES el video. En las
         otras rejillas de la página el hueco muestra un ink al 15%; en esta
         muestra el metraje, y eso convierte el video en el material que une
         los bloques en lugar de en un telón detrás de ellos. -->
    <div data-reveal class="ec-plates grid gap-px lg:grid-cols-6">

      <!-- ── Encabezado, como bloque claro ──
           Es el único módulo claro de una sección enteramente oscura, y esa
           es la razón: en la valla el bloque de mayor jerarquía no es el que
           repite el color de fondo, es el que lo rompe. Contra los cuatro
           módulos en ink y el video detrás, el claro se lee primero.

           Todo el texto se invierte con él. Un cambio de superficie arrastra
           el color del contenido — dejar el eyebrow en ember-300 sobre claro
           daría 1.79:1 y el titular en bone directamente no se vería. -->
      <div class="relative flex flex-col justify-between bg-breeze-100 p-8 lg:col-span-2 lg:row-span-2 lg:p-10">
        <div>
          <!-- ember-600 y no ember-300: sobre claro el paso 300 da 1.79:1.
               El 600 existe justamente para esto y da 4.50:1. -->
          <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-600">Track record</p>
          <h2 class="ec-shine ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
            Brands that audit every vendor <em>already hired us.</em>
          </h2>
          <p class="mt-6 text-base leading-relaxed text-ink/70">
            Two institutional brands with corporate procurement standards reviewed our licensing, insurance and capacity — and paid us to build. That’s not a testimonial. That’s a precedent.
          </p>
        </div>

        <!-- Banda de rayas al pie, como el faldón de la van. En ink: el
             default de la clase es LINEN y sobre este bloque no se vería. -->
        <div class="ec-band ec-band--h ec-band--ink mt-10 h-1.5 opacity-30" aria-hidden="true"></div>
      </div>

      <?php
      /* Cada caso son DOS módulos: la foto y el texto, separados. Es lo que
         hace la valla —la imagen es un rectángulo y el copy es otro— y lo
         contrario de una tarjeta, donde la foto va cosida arriba del texto.

         Se INTERCALAN: el primer caso pone la foto a la izquierda y el texto
         a la derecha, el segundo al revés. Antes las dos fotos caían en la
         misma columna y los dos textos en la otra, y eso volvía a leerse como
         tabla — dos filas con las mismas celdas.

         Alternar hace que la retícula se lea como composición: es la lógica
         de la valla, donde ningún módulo está donde estaría si el sistema
         fuera una tabla.

         El orden se invierte en el DOM, no con `order`. Con `order` el lector
         de pantalla y el recorrido de Tab siguen el orden del código, así que
         en el segundo caso oiría la foto antes que su propio encabezado. */

      // Markup de cada módulo, resuelto una vez y colocado en el orden que
      // corresponda. Evita duplicar veinte líneas por invertir dos bloques.
      $ec_render_foto = function ($case) {
        ?>
        <div class="relative min-h-[16rem] bg-ink lg:col-span-2 lg:min-h-[18rem]">
          <?php if (!empty($case['image'])) : ?>
            <img
              src="<?php echo esc_url($case['image']); ?>"
              alt="<?php echo esc_attr($case['alt']); ?>"
              class="absolute inset-0 h-full w-full object-cover"
              loading="lazy"
              decoding="async"
            />
          <?php endif; ?>
        </div>
        <?php
      };

      $ec_render_texto = function ($case) {
        ?>
        <div class="flex flex-col justify-center bg-ink p-8 lg:col-span-2 lg:p-10">
          <p class="text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300">
            <?php echo esc_html($case['kicker']); ?>
          </p>
          <h3 class="mt-4 font-display text-xl leading-snug font-bold tracking-tight text-bone">
            <?php echo esc_html($case['title']); ?>
          </h3>
          <p class="mt-4 text-base leading-relaxed text-bone/80">
            <?php echo esc_html($case['body']); ?>
          </p>
        </div>
        <?php
      };

      foreach ($cases as $i => $case) :
        if (0 === $i % 2) {
          $ec_render_foto($case);
          $ec_render_texto($case);
        } else {
          $ec_render_texto($case);
          $ec_render_foto($case);
        }
      endforeach; ?>

      <!-- Bloque de cierre en clay. Lleva la línea del NDA, que antes iba
           suelta bajo la rejilla como una nota al pie. Convertida en módulo
           deja de leerse como advertencia legal y pasa a ser lo que es: la
           invitación a pedir los nombres. -->
      <div class="flex items-center bg-ember p-8 lg:col-span-6 lg:p-10">
        <p class="text-base leading-relaxed text-ink">
          Client names and contract values available on request under NDA.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════ 05 · CAPACIDADES ═══════════════════════ -->
<section id="capabilities" class="bg-breeze-100 lg:flex lg:min-h-svh lg:items-start">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div data-reveal class="max-w-3xl">
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Capabilities</p>
      <h2 class="ec-shine ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
        What we <em>self-perform.</em>
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
              <?php
              /* La tarjeta entera es el enlace, no un "ver más" al pie: el
                 área de clic es el bloque completo, que es lo que un dedo
                 espera de una tarjeta con foto.

                 La copia del marquee va con tabindex=-1 además de
                 aria-hidden. Sin eso el recorrido de Tab pasaría dos veces
                 por las mismas cuatro capacidades, y la segunda vuelta
                 llevaría a enlaces que el lector de pantalla no anuncia. */
              $ec_href = !empty($item['href']) ? $item['href'] : '';
              ?>
              <a
                href="<?php echo esc_url($ec_href); ?>"
                <?php echo $ec_clone ? 'tabindex="-1"' : ''; ?>
                class="group block h-full focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember"
              >
              <article class="flex h-full flex-col overflow-hidden bg-sand">

                <?php if (!empty($item['image'])) : ?>
                  <div class="aspect-[4/3] w-full overflow-hidden">
                    <img
                      src="<?php echo esc_url($item['image']); ?>"
                      alt="<?php echo $ec_clone ? '' : esc_attr($item['alt']); ?>"
                      class="h-full w-full object-cover transition-transform duration-500 ease-out group-hover:scale-105 motion-reduce:transition-none motion-reduce:group-hover:scale-100"
                      loading="lazy"
                      decoding="async"
                    />
                  </div>
                <?php else : ?>
                  <!-- Respaldo: si una imagen se cae en la migración, la tarjeta
                       queda con un panel liso en verde de marca en lugar de un
                       ícono de imagen rota. Barato de mantener, así que se queda. -->
                  <div class="aspect-[4/3] w-full bg-[linear-gradient(150deg,#696D56_0%,#565945_100%)]" aria-hidden="true"></div>
                <?php endif; ?>

                <div class="flex flex-1 flex-col border-t-4 border-ember p-7 transition-colors duration-300 group-hover:bg-breeze-100 motion-reduce:transition-none">
                  <h3 class="font-display text-lg font-bold tracking-tight text-ink">
                    <?php echo esc_html($item['title']); ?>
                  </h3>
                  <p class="mt-3 text-sm leading-relaxed text-ink/70">
                    <?php echo esc_html($item['body']); ?>
                  </p>
                </div>
              </article>
              </a>
            </li>
          <?php endforeach;
        endfor; ?>
      </ul>
    </div>
  </div>
</section>

<!-- ═══════════════════ 07 · CÓMO TRABAJAMOS ═══════════════════ -->
<!-- Rediseñado como composición modular, que es el lenguaje de las dos piezas
     de marca: rectángulos de distinto tamaño encajados entre sí, donde el
     color, la foto, el texto y el vacío son el mismo tipo de bloque.

     Antes era una lista con filetes — el elemento más genérico de la página.
     Ahora los cinco pasos son cinco bloques macizos sobre una rejilla de 6
     columnas, y el encabezado ocupa dos de esas celdas en lugar de vivir
     arriba, suelto. Igual que en la valla, donde el titular es un bloque más
     y no una capa flotando encima.

     El reparto NO es decorativo. Los pasos 1 y 2 —walkthrough y bid— son los
     que decide el comprador y ocupan el doble de ancho; los tres de ejecución
     van a un tercio cada uno. La retícula cuenta la misma jerarquía que el
     copy.

     El gap-px sobre bg-ink es lo que dibuja los filetes: los bloques se tocan
     y la línea es el fondo asomando, como en el cartel. -->
<section class="bg-bone lg:flex lg:min-h-svh lg:items-center">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">

    <div data-reveal class="ec-plates grid gap-px bg-ink/15 lg:grid-cols-6">

      <!-- Encabezado como bloque, no como capa. Ocupa dos celdas y se apoya
           abajo: el titular arranca donde arrancan los pasos. -->
      <div class="flex flex-col justify-end bg-ink p-8 text-bone lg:col-span-2 lg:row-span-2 lg:p-10">
        <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300">Process</p>
        <h2 class="ec-shine ec-shine--light ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-bone sm:text-4xl">
          How a bid becomes <em>a finished site.</em>
        </h2>
        <!-- Banda de rayas al pie del bloque, como el faldón de la van. -->
        <div class="ec-band ec-band--h mt-8 h-1.5 opacity-40" aria-hidden="true"></div>
      </div>

      <?php
      /* Superficie por posición en la retícula, no por rol.

         Antes alternaba por significado —sand para los pasos de decisión,
         breeze para los de ejecución— y eso dejaba 01 y 02 del mismo color,
         pegados uno al otro. En la valla ningún módulo repite el color de su
         vecino: el ritmo lo da la alternancia, y sin ella la rejilla vuelve a
         leerse como tabla.

         El tablero, con el encabezado ocupando las dos primeras celdas de
         las filas 1 y 2:

           [ ink  ][ 01 sand   ][ 02 breeze ]
           [ ink  ][ 03 breeze ][ 04 sand   ]
           [ 05 sand ][ clay, 4 columnas    ]

         Cada bloque difiere de su vecino de al lado Y del de arriba. */
      $ec_bg_por_paso = array('bg-sand', 'bg-breeze-100', 'bg-breeze-100', 'bg-sand', 'bg-sand');

      foreach ($process as $i => $step) :
        $ec_col = 'lg:col-span-2';
        $ec_bg  = isset($ec_bg_por_paso[$i]) ? $ec_bg_por_paso[$i] : 'bg-sand';
        ?>
        <div class="<?php echo esc_attr($ec_col . ' ' . $ec_bg); ?> flex flex-col p-8 lg:p-10">
          <span class="font-display text-5xl font-bold leading-none tracking-tight text-ember tabular-nums">
            <?php echo esc_html(str_pad($step['n'], 2, '0', STR_PAD_LEFT)); ?>
          </span>
          <h3 class="mt-6 font-display text-lg font-bold leading-snug tracking-tight text-ink">
            <?php echo esc_html($step['title']); ?>
          </h3>
          <p class="mt-3 text-sm leading-relaxed text-ink/70">
            <?php echo esc_html($step['body']); ?>
          </p>
        </div>
      <?php endforeach; ?>

      <!-- Bloque liso en clay, cerrando la fila entera.

           En la valla hay un rectángulo sin contenido y no es un descuido: el
           vacío es un bloque más del sistema y es lo que impide que la
           rejilla se lea como tabla.

           Ocupa cuatro columnas y no dos porque con dos quedaba una celda
           suelta al final de la fila, y esa celda dejaba ver el fondo de la
           rejilla como un rectángulo gris — un hueco, no un módulo.

           Se oculta por debajo de lg, donde no hay retícula que cerrar. -->
      <div class="hidden bg-ember lg:block lg:col-span-4" aria-hidden="true"></div>
    </div>
  </div>
</section>

<!-- ═══════════════════ 08 · CREDENCIALES ═══════════════════ -->
<!-- Rediseñada como composición modular, igual que 02, 04, 07 y 09.

     Sale el estampado. Era un tartán de escala grande usado como textura de
     fondo, y en las dos piezas de marca ese recurso nunca cubre una
     superficie: remata un borde. Acá competía con la retícula de credenciales
     —dos cuadrículas superpuestas— y para no romper el contraste había que
     dejarlo al 14%, o sea casi invisible. Un elemento que solo funciona
     cuando no se ve no está aportando nada.

     Lo que ocupa su lugar es el propio sistema de bloques. Las nueve
     credenciales dejan de ser filas de una tabla y pasan a ser nueve módulos
     de la misma retícula, con el encabezado y el premio como dos bloques más
     — uno de texto y otro de imagen, exactamente como en la valla.

     El fondo de sección es OLIVE y la rejilla va con gap-px SIN color propio:
     la línea entre módulos es la superficie asomando. Es lo mismo que hace el
     bloque 04 con el video, y lo que evita tener que elegir un color de
     filete que no está en la paleta. -->
<section id="credentials" class="bg-umber lg:flex lg:min-h-svh lg:items-center">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">

    <div data-reveal class="ec-plates grid gap-px lg:grid-cols-6">

      <!-- ── Encabezado ──
           El número de licencia ya no va acá: era el masthead del diseño
           anterior y repetía la primera credencial de la tabla. En un sistema
           de módulos, decir dos veces lo mismo cuesta un bloque. -->
      <div class="flex flex-col justify-between bg-ink p-8 text-bone lg:col-span-2 lg:row-span-2 lg:p-10">
        <div>
          <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300">Credentials</p>
          <h2 class="ec-shine ec-shine--light ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-bone sm:text-4xl">
            The page your compliance team <em>is going to ask for.</em>
          </h2>
          <p class="mt-6 text-base leading-relaxed text-bone/80">
            Boring for everyone else. Decisive for you.
          </p>
        </div>
        <div class="ec-band ec-band--h mt-10 h-1.5 opacity-40" aria-hidden="true"></div>
      </div>

      <?php
      /* Superficie por posición, no por contenido. Las ocho primeras
         credenciales caen en una retícula de dos columnas a la derecha del
         encabezado, y la novena abre la última fila.

         El damero sale de (fila + columna): así ningún módulo repite el color
         del de al lado ni el del de arriba, que es la regla que gobierna toda
         la página desde el bloque 07. */
      foreach ($credentials as $i => $row) :
        if ($i < 8) {
          $ec_bg = ((intdiv($i, 2) + ($i % 2)) % 2 === 0) ? 'bg-sand' : 'bg-breeze-100';
        } else {
          // La novena va debajo del bloque del premio, que es una imagen:
          // no hay color arriba con el que pueda chocar.
          $ec_bg = 'bg-sand';
        }
        ?>
        <div class="<?php echo esc_attr($ec_bg); ?> p-7 lg:col-span-2 lg:p-8">
          <dl>
            <!-- Mismo tratamiento que los kickers de Track record: 0.68rem,
                 tracking 0.18em y color de acento. Las dos secciones son
                 bloques del mismo sistema y deben leerse igual.

                 En ember-800 y no en el 600 de Track record: allá el kicker
                 vive sobre un solo fondo, acá cada módulo cae sobre sand o
                 sobre breeze-100 según su posición en el damero. El 600 da
                 3.64:1 sobre sand y el 700 tampoco llega; el 800 pasa en las
                 dos (4.61:1 y 6.23:1). -->
            <dt class="text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-800">
              <?php echo esc_html($row['label']); ?>
            </dt>
            <!-- El valor en display bold, como los títulos de caso de Track
                 record. text-lg y no text-xl: "1106462255001 · classification
                 S330" es el valor más largo y a xl parte en tres líneas. -->
            <dd class="mt-4 font-display text-lg leading-snug font-bold tracking-tight text-ink tabular-nums [overflow-wrap:anywhere]">
              <?php echo esc_html($row['value']); ?>
            </dd>
          </dl>
        </div>

        <?php
        /* El premio se inserta después de la cuarta credencial, donde arranca
           la tercera fila de la retícula. Va como bloque de imagen a sangre,
           no como estampilla al pie: en la valla la foto es un módulo del
           mismo sistema que el texto, con el mismo peso.

           object-contain y no cover: es un objeto, y recortarlo lo mutila.
           El fondo ink cubre lo que sobra de la caja. */
        if (3 === $i) : ?>
          <div class="relative flex min-h-[18rem] items-center justify-center bg-ink p-8 lg:col-span-2 lg:row-span-2 lg:min-h-0">
            <img
              src="<?php echo esc_url($ec_uploads['baseurl'] . '/2026/07/ec_landscaping_award.png'); ?>"
              alt="BusinessRate Best of 2026 Award Winner plaque"
              class="max-h-[22rem] w-auto max-w-full object-contain"
              loading="lazy"
              decoding="async"
            />
          </div>
        <?php endif;
      endforeach; ?>

      <!-- ── Cierre en clay ──
           Lleva la línea del premio, que antes era una estampilla con su
           texto al pie. Como módulo, el reconocimiento queda a la altura de
           las credenciales en lugar de ser una nota agregada al final. -->
      <div class="flex flex-col justify-center bg-ember p-7 lg:col-span-4 lg:p-8">
        <!-- Sobre clay la etiqueta se queda en ink: ember-800 encima da
             1.58:1. Es la excepción del sistema y por eso está anotada. -->
        <p class="text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ink">Recognition</p>
        <p class="mt-4 font-display text-lg leading-snug font-bold tracking-tight text-ink">
          BusinessRate Best of 2026 — Landscaper
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════ 09 · ÁREA DE SERVICIO ═══════════════════ -->
<!-- Rediseñado como composición modular. Antes eran dos columnas con el mapa
     y las listas apiladas dentro; ahora cada pieza es un bloque de la misma
     retícula: el titular, el mapa, los condados, las ciudades, el dato del
     patio y un bloque de color sin contenido.

     Es la estructura de la valla: rectángulos de tamaños distintos que se
     tocan, uno de ellos con foto, uno liso, y el texto ocupando los demás.
     La foto —acá el mapa— no es un adorno al costado, es una celda más.

     Y la información sube de jerarquía al hacerse bloque: las dos distancias
     que definen la promesa comercial dejan de ser una fila de fichas al pie
     y pasan a ser un bloque en clay, que es el único uso de ese color en la
     sección. -->
<section id="service-area" class="bg-bone lg:flex lg:min-h-svh lg:items-center">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">

    <?php
    /* El mapa se arma de la misma cadena de dirección que el NAP del footer.
       Escrita una vez acá y derivadas las dos URLs: si mañana cambia la
       dirección, no queda un mapa apuntando a la anterior.

       output=embed es la forma sin API key. */
    $ec_map_query = '3754 N Higley Rd Suite 2, Ogden, UT 84404';
    $ec_map_embed = 'https://www.google.com/maps?q=' . rawurlencode($ec_map_query) . '&output=embed';
    $ec_map_href  = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($ec_map_query);
    ?>

    <div data-reveal class="ec-plates grid gap-px bg-ink/15 lg:grid-cols-6">

      <!-- ── Titular ── -->
      <div class="flex flex-col justify-end bg-ink p-8 text-bone lg:col-span-2 lg:p-10">
        <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300">Service area</p>
        <h2 class="ec-shine ec-shine--light ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-bone sm:text-4xl">
          Where <em>we work.</em>
        </h2>
      </div>

      <!-- ── Mapa: bloque de imagen, no columna ──
           El iframe va en absolute dentro de una celda con proporción fija,
           así el alto queda reservado antes de que cargue. loading=lazy no es
           cosmético: sin eso arrastra el JavaScript de Maps en la carga
           inicial de una página que ya trae dos videos. -->
      <!-- El alto se fija acá y no se deja a la rejilla. Sin min-h propio,
           esta celda toma el alto de su fila, y esa fila la manda el bloque
           del titular de al lado — que mide lo que miden tres líneas de
           texto. El mapa quedaba como una franja de 230px: se veía el
           encuadre pero no el contexto, y los controles y la atribución de
           Google se apretaban contra los bordes.

           26rem le da al mapa proporción de mapa. De paso estira el bloque
           del titular, que va con justify-end y apoya el texto abajo — como
           el bloque de encabezado del proceso. -->
      <div class="relative min-h-[20rem] bg-ink lg:col-span-4 lg:min-h-[26rem]">
        <iframe
          src="<?php echo esc_url($ec_map_embed); ?>"
          title="Map showing EC Landscaping at 3754 N Higley Rd, Suite 2, Ogden, Utah"
          class="absolute inset-0 h-full w-full border-0"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          allowfullscreen
        ></iframe>
      </div>

      <!-- ── Las dos distancias, en clay ──
           Único uso del terracota en la sección. Es la promesa comercial
           —hasta dónde llega la cuadrilla— y el mapa no la dice: muestra
           dónde está el patio, no su alcance. -->
      <div class="bg-ember p-8 text-ink lg:col-span-2 lg:p-10">
        <p class="text-[0.65rem] font-semibold uppercase tracking-[0.14em] text-ink">Radius</p>
        <p class="mt-4 font-display text-4xl font-bold leading-none tracking-tight tabular-nums">50 mi</p>
        <p class="mt-2 text-sm leading-relaxed text-ink">Standard service radius from our Ogden yard.</p>
        <p class="mt-6 font-display text-2xl font-bold leading-none tracking-tight tabular-nums">Up to 90</p>
        <p class="mt-2 text-sm leading-relaxed text-ink">For large commercial installations. Outside that line, ask us anyway.</p>
      </div>

      <!-- ── Condados ──
           En tipografía display y no en lista: un GC piensa por condado
           —permisos, distrito de agua, jurisdicción— y es el dato que más
           pesa de esta sección. -->
      <div class="bg-sand p-8 lg:col-span-2 lg:p-10">
        <p class="mb-6 text-[0.65rem] font-semibold uppercase tracking-[0.14em] text-ink/50">Counties served</p>
        <ul class="flex flex-col gap-3">
          <?php foreach ($service_counties as $county) : ?>
            <li class="font-display text-2xl font-bold leading-none tracking-tight text-ink">
              <?php echo esc_html($county); ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- ── Ciudades y el patio ──
           Un property manager piensa por ciudad, así que las dos escalas
           conviven pero en bloques distintos. -->
      <div class="flex flex-col justify-between bg-breeze-100 p-8 lg:col-span-2 lg:p-10">
        <div>
          <p class="mb-4 text-[0.65rem] font-semibold uppercase tracking-[0.14em] text-ink/50">Core cities</p>
          <ul class="flex flex-wrap gap-x-5 gap-y-2">
            <?php foreach ($service_cities as $city) : ?>
              <li class="text-base text-ink"><?php echo esc_html($city); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="mt-8 border-t border-ink/15 pt-6">
          <p class="text-[0.65rem] font-semibold uppercase tracking-[0.14em] text-ink/50">Yard</p>
          <p class="mt-2 text-sm text-ink">
            <a
              href="<?php echo esc_url($ec_map_href); ?>"
              target="_blank"
              rel="noopener noreferrer"
              class="underline decoration-ember decoration-2 underline-offset-4 transition-colors hover:text-forest"
            >3754 N Higley Rd, Ogden</a>
          </p>
          <p class="mt-3 text-sm text-ink/70">
            Not on the list? Call the yard —
            <a href="tel:+13852403907" class="font-medium text-ink underline decoration-ember decoration-2 underline-offset-4 transition-colors hover:text-forest">(385) 240-3907</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════ 10 · REPUTACIÓN ═══════════════════ -->
<?php if (!empty($reviews)) : ?>
  <section class="bg-breeze-100 lg:flex lg:min-h-svh lg:items-start">
    <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
      <h2 class="ec-shine ec-mixed max-w-3xl font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
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
      <div data-reveal class="lg:sticky lg:top-[calc(var(--header-offset)+3rem)] lg:self-start">
        <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">FAQ</p>
        <h2 class="ec-shine ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
          Questions estimators <em>actually ask.</em>
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