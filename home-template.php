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
  'micro'   => 'Utah License S330 — General Liability, Workers’ Compensation and Commercial Auto certificates available on request.',

  // Slides del hero. Se arman desde wp_get_upload_dir() para que las URLs
  // sobrevivan la migración de ec-landscaping.local a producción.
  //
  // Reemplazan al video (Segmento-drone-9-EC-landscaping.mp4, que sigue en
  // la biblioteca por si hay que volver atrás). El orden del array es el
  // orden de rotación, y el PRIMERO es el que más pesa: es el que se ve al
  // cargar, el único que ven reduced-motion y quienes navegan sin JS, y el
  // LCP de la página.
  //
  // Ojo con los nombres: tres llevan sufijo -scaled y dos no. Así están
  // subidos en la biblioteca — la URL tiene que coincidir con el archivo,
  // no con la prolijidad.
  'slides'  => array(
    $ec_uploads['baseurl'] . '/2026/08/EC_HeroSlide1-scaled.jpg',
    $ec_uploads['baseurl'] . '/2026/08/EC_HeroSlide2.jpg',
    $ec_uploads['baseurl'] . '/2026/08/EC_HeroSlide3-scaled.jpg',
    $ec_uploads['baseurl'] . '/2026/08/EC_HeroSlide4.jpg',
    $ec_uploads['baseurl'] . '/2026/08/EC_HeroSlide5-scaled.jpg',
  ),
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
// Versión de mayor calidad (reemplaza a GeneralContractorDeveloper.jpeg).
// SUGERENCIA para antes de publicar: renombrar el archivo en la biblioteca
// a algo descriptivo — "WhatsApp-Image-2026-08-26-at-08.53.16" no dice nada
// en el sitemap de imágenes ni si hay que encontrarla en seis meses. Al
// renombrar, actualizar esta línea.
$ec_img_gc        = $ec_uploads['baseurl'] . '/2026/08/WhatsApp-Image-2026-08-26-at-08.53.16.jpeg';

// Prompt: "office park commercial property exterior"
// OJO doble con este nombre: es GroundsMaintenance.jpg (.jpg) — convive en
// la biblioteca con GroundsMaintenance.jpeg (.jpeg), que es OTRA foto y la
// usa la tarjeta de Grounds maintenance del carrusel. Mismo nombre, dos
// extensiones, dos archivos distintos: no "corregir" ninguna de las dos.
$ec_img_pm        = $ec_uploads['baseurl'] . '/2026/08/GroundsMaintenance.jpg';

// Prompt: "residential community entrance landscaping" — área común, no una casa
// ECLandscaping.jpg venía de la tarjeta de Commercial landscape del
// carrusel (que ya migró a EC_HeroSlide1); acá arranca su segunda vida.
$ec_img_hoa       = $ec_uploads['baseurl'] . '/2026/08/ECLandscaping.jpg';

// Prompt: "corporate campus building landscape"
// La misma foto que el paso 5 del proceso (Closeout and handoff) — repetida
// a conciencia: el acordeón va antes en la página, así que cuando el zigzag
// del proceso entra en pantalla, la foto ya está en caché. Si en el diseño
// la repetición canta, esta es la línea a cambiar.
$ec_img_multisite = $ec_uploads['baseurl'] . '/2026/08/CloseoutAndHandOff.jpeg';

// Prompt: "convenience store exterior daytime" — sin marca legible
// Foto real del drive-thru (reemplaza a ConvenienceStore-scaled.jpg).
// SUGERENCIA: renombrar en la biblioteca — el nombre de WhatsApp no dice
// nada; algo como RetailDriveThru.jpeg. Al renombrar, actualizar acá.
$ec_img_retail    = $ec_uploads['baseurl'] . '/2026/08/WhatsApp-Image-2026-08-24-at-18.44.52.jpeg';


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

/* 04 · PRECEDENTE — SECCIÓN ELIMINADA a pedido (ago 2026).
   El markup y el array $cases (las dos tarjetas de casos con la Versión B
   del copy) salieron de la plantilla; si hay que restituirlos, están en el
   historial de este archivo. El Pendiente 03 —permiso escrito de Maverik y
   America First para la Versión A— queda en suspenso con la sección.

   OJO: el footer todavía enlaza a home_url('/#projects'), que era el id de
   esta sección. Ese enlace ahora no salta a nada — hay que apuntarlo a la
   página /projects en footer.php, igual que ya hace el navbar.

   El VIDEO de la sección no se fue: pasó de fondo al bloque 11 (FAQ). */
$faq_video  = $ec_uploads['baseurl'] . '/2026/07/ProjectsECLandscaping.mp4';
$faq_poster = '';

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
    // La misma foto que abre el slideshow del hero (EC_HeroSlide1). Se repite
    // a propósito: para cuando la tarjeta entra en pantalla, el navegador ya
    // la tiene en caché — reemplaza a ECLandscaping.jpg, que sigue en la
    // biblioteca.
    'image' => $ec_uploads['baseurl'] . '/2026/08/EC_HeroSlide1-scaled.jpg',
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
    // OJO con la extensión: .jpeg y no .jpg. El archivo anterior era
    // GroundsMaintenance.jpg (sigue en la biblioteca); este se subió como
    // .jpeg y la URL tiene que coincidir con el archivo, no con la
    // prolijidad. Si algún día se renombra, esta línea es la que se corrige.
    'image' => $ec_uploads['baseurl'] . '/2026/08/GroundsMaintenance.jpeg',
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

/* ═════════════════════════════════════════════════════════════════
   FOTOS DEL PROCESO — una variable por paso. Cargadas (ago 2026).

   Ojo con los nombres: extensiones mezcladas (.jpeg, .webp, -scaled.jpg)
   y "SelfPermormedExecution" lleva la errata TAL CUAL está subido el
   archivo — la URL coincide con el archivo, no con la ortografía. Si
   algún día se renombra en la biblioteca, se corrige acá.
   ═════════════════════════════════════════════════════════════════ */
$ec_img_process_1 = $ec_uploads['baseurl'] . '/2026/08/Walkthrough.jpeg';
$ec_img_process_2 = $ec_uploads['baseurl'] . '/2026/08/ScopeBid-scaled.webp';
$ec_img_process_3 = $ec_uploads['baseurl'] . '/2026/08/GradingSoilPreparation-scaled.jpg';
$ec_img_process_4 = $ec_uploads['baseurl'] . '/2026/08/SelfPermormedExecution.jpeg';
$ec_img_process_5 = $ec_uploads['baseurl'] . '/2026/08/CloseoutAndHandOff.jpeg';

/* Alt por paso, ajustados a lo que muestra cada foto. El del paso 3 cambió
   con la foto: la elegida para Preconstruction muestra preparación de
   terreno, no papeleo — el alt describe la imagen, no el título del paso. */
$ec_process_media = array(
  array('image' => $ec_img_process_1, 'alt' => 'Site walkthrough with the project team'),
  array('image' => $ec_img_process_2, 'alt' => 'Line-item bid proposal being reviewed'),
  array('image' => $ec_img_process_3, 'alt' => 'Grading and soil preparation on a commercial site'),
  array('image' => $ec_img_process_4, 'alt' => 'EC crew executing landscape work on site'),
  array('image' => $ec_img_process_5, 'alt' => 'Closeout walkthrough at a finished commercial site'),
);

/* 08 · CREDENCIALES.
   "bonded" queda fuera hasta que se confirme capacidad de bonding: Pendiente 04.
   La licencia UDAF falta número y clase: Pendiente 09.
   El número de la licencia de contratista se retiró de toda la home a
   pedido: queda solo la clasificación S330. El número completo sigue en el
   footer y en /contact (NAP) — si también hay que quitarlo de ahí, son
   footer.php y contact-template.php. */
$credentials = array(
  array('label' => 'Utah contractor license', 'value' => 'Classification S330'),
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

/* 10 · REPUTACIÓN — retirada (ago 2026). El widget de Trustindex en la
   sección 03B muestra las reseñas de Google en vivo y textuales, que era
   la regla del Pendiente 05; mantener este bloque manual en paralelo
   habría sido un segundo sistema de reviews esperando desincronizarse. */

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
<!-- Slideshow a sangre detrás de toda la sección: cinco fotos rotando con
     crossfade bajo el mismo velo oscuro que llevaba el video.

     Ganancia lateral del cambio: el video se omitía en móvil, en
     reduced-motion y en conexiones lentas, y como el poster nunca se
     exportó, esos usuarios veían el fondo liso. Las fotos SÍ se ven en
     todos esos casos — en el peor, se ve la primera, estática, que es
     exactamente lo que habría sido el poster. El pendiente del poster
     muere con el video. -->
<!-- Hero + barra de prueba comparten una pantalla SOLO cuando el alto
     alcanza. El clamp h-svh se condiciona a min-height:880px: en una laptop
     corta forzar todo dentro de un viewport comprimía el hero. Por debajo
     del umbral la página fluye natural y la barra queda tras un scroll
     corto. Cuando el clamp aplica, el hero toma lo que sobra (flex-1) y la
     barra ocupa lo que necesita. Solo en lg. -->
<div class="lg:flex lg:flex-col [@media(min-width:1024px)_and_(min-height:880px)]:h-svh">
<section class="relative isolate overflow-hidden bg-ink text-bone lg:min-h-0 lg:flex-1">

  <!-- ── Slideshow ──
       Las cinco imágenes apiladas en absolute; una sola lleva opacity-100 y
       el JS (al pie de la plantilla) rota la clase. El crossfade es la
       transición de opacidad de Tailwind — sin librería, sin transform.

       SOLO LA PRIMERA lleva src real: es el LCP de la página y sale con
       fetchpriority high. Las demás van en data-src y el JS las asigna al
       iniciar la rotación. No sirve loading="lazy" acá: apiladas dentro del
       viewport, el navegador las cargaría todas de inmediato —el atributo
       mira posición, no visibilidad— y las cinco competirían con la primera
       por el ancho de banda en plena carga inicial.

       Sin JS, o con prefers-reduced-motion, la rotación nunca arranca y las
       data-src nunca se asignan: queda la primera foto, estática. Nunca se
       apuesta el fondo del hero a que corra un script.

       aria-hidden y alt vacíos: es fondo decorativo, igual que lo era el
       video. El contenido del hero es el texto, no las fotos. -->
  <div data-hero-slideshow class="absolute inset-0 -z-20" aria-hidden="true">
    <?php foreach ($hero['slides'] as $ec_i => $ec_slide) : ?>
      <img
        <?php if (0 === $ec_i) : ?>
          src="<?php echo esc_url($ec_slide); ?>"
          fetchpriority="high"
        <?php else : ?>
          data-src="<?php echo esc_url($ec_slide); ?>"
        <?php endif; ?>
        alt=""
        class="absolute inset-0 h-full w-full object-cover transition-opacity duration-[1200ms] ease-linear motion-reduce:transition-none <?php echo 0 === $ec_i ? 'opacity-100' : 'opacity-0'; ?>"
        decoding="async"
      />
    <?php endforeach; ?>
  </div>

  <!-- Scrim: OSCURECEDOR NEUTRO de baja opacidad, no un tinte de color.

       Este es el tercer intento del velo y la lección quedó clara: cualquier
       color medio de la paleta (clay-600, olive, olive-600) usado como velo
       DESATURA el metraje — se mezcla con cada píxel y lo empuja hacia su
       propio tono, así que el césped, el cielo y la madera terminan todos
       grisáceos. Más opacidad solo empeoraba: más "opaco", menos video.

       Un neutro casi negro hace lo contrario: OSCURECE sin teñir. Los
       colores del video conservan su saturación —el verde del césped sigue
       siendo verde, el cielo sigue siendo azul— y el conjunto se lee como
       metraje con el contraste subido, no como metraje detrás de un vidrio
       de color. Es lo que hacen los heros de video que "se ven bien" (BC
       incluido): negro translúcido, nunca un tono medio.

       El neutro sale de pine-900 (#1A1D19), así que no es un negro ajeno a
       la paleta — pero el punto es la LUMINANCIA, no el matiz: a estas
       opacidades el matiz del velo es imperceptible.

       Opacidades bajas (0.6 → 0.28), con el sesgo hacia la columna de texto:
       el 0.6 de la izquierda es lo que sostiene el bone del titular contra
       una foto clara; a la derecha el velo casi desaparece y la imagen
       manda. LA PERILLA: si el texto se lava contra el slide más claro de
       los cinco, subí el 0.6 hacia 0.72. Para que las fotos destaquen aún
       más, bajá el 0.28 — el texto no vive de ese lado.

       bg-ink en la sección: es lo que se ve el instante previo a que cargue
       la primera foto, y lo que queda si una ruta se rompe en la migración.
       Un hero que falla en oscuro se lee como decisión.

       Gradiente explícito en lugar de utilidad de Tailwind para no depender
       del renombre de bg-gradient-* a bg-linear-* en v4. -->
  <div
    class="absolute inset-0 -z-10 bg-[linear-gradient(100deg,rgba(26,29,25,0.6)_0%,rgba(26,29,25,0.48)_40%,rgba(26,29,25,0.35)_70%,rgba(26,29,25,0.28)_100%)]"
    aria-hidden="true"
  ></div>

  <!-- El padding-top reserva el alto del header, que ahora flota encima en
       lugar de empujar la página. min-h en svh y no vh: en móvil, vh incluye
       la barra de direcciones y el hero salta cuando aparece o desaparece.

       h-full y min-h-0 van tras el mismo umbral de alto que el clamp del
       contenedor: solo tienen sentido cuando el hero mide una pantalla. En
       pantallas cortas el clamp no aplica, así que acá manda el min-h-[38rem]
       y el contenido fluye a su altura natural.

       Desde xl el hero es una rejilla de DOS MITADES IGUALES (grid-cols-2),
       y cada bloque se centra dentro de la suya con justify-self-center:
       el texto en el centro de la mitad izquierda, el formulario en el
       centro de la derecha. Antes las pistas eran 1fr + 27rem — el texto
       quedaba pegado al borde izquierdo, el formulario al derecho, y todo
       el aire muerto caía en el medio; con las mitades el aire se reparte
       a los costados de cada bloque y la composición queda balanceada.

       El ancho de cada bloque lo pone su propio max-w (3xl el texto, 27/30
       rem el formulario), no la pista: así el centrado tiene contra qué
       calcularse. -->
  <div class="relative flex min-h-[38rem] items-center px-5 pb-20 pt-[calc(var(--header-offset)+1rem)] sm:px-8 lg:px-10 lg:pb-12 lg:pt-[var(--header-offset)] [@media(min-width:1024px)_and_(min-height:880px)]:h-full [@media(min-width:1024px)_and_(min-height:880px)]:min-h-0 xl:grid xl:grid-cols-2 xl:items-stretch xl:gap-12">

    <!-- La columna de texto se centra por su cuenta desde xl — en los dos
         ejes: justify-center la centra verticalmente dentro de la celda
         estirada, y w-full + max-w-3xl + justify-self-center la centran
         horizontalmente dentro de su mitad de la rejilla.

         min-h-0 acompaña al justify-center: sin él, una columna estirada no
         puede encogerse por debajo de su contenido y el centrado no tiene
         contra qué calcularse. -->
    <div class="max-w-3xl xl:flex xl:min-h-0 xl:w-full xl:flex-col xl:justify-center xl:justify-self-center">
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
      <!-- Un escalón menos que antes (text-lg → text-base): a 18px el
           párrafo competía en peso con el titular; a 16px acompaña. El
           max-w baja con él para conservar las ~70 letras por línea. -->
      <p class="mt-6 max-w-xl text-base leading-relaxed text-bone">
        <?php echo esc_html($hero['lede']); ?>
      </p>

      <!-- items-stretch y no items-center: los tres botones igualan su altura
           contra el más alto de la fila, sin adivinar paddings. Cada uno
           centra su propio contenido. -->
      <div class="mt-9 flex flex-wrap items-stretch gap-4">
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
            class="cta-relief-light relative inline-flex items-center gap-2.5 border-2 border-white/60 bg-ink py-4 pl-7 pr-6 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-white transition-all duration-200 ease-out hover:cta-relief-light-tight hover:bg-ink-900 hover:-translate-y-px active:translate-y-0 active:shadow-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transform-none motion-reduce:transition-none"
          >
            Request a bid
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transform-none">
              <path d="M5 12h13M13 6l6 6-6 6" />
            </svg>
          </a>
        </span>

        <!-- ── Secundario: a la página de proyectos ──
             Fantasma sobre el hero: borde y texto claros, sin fondo. No
             compite con el CTA de bid — lo acompaña como salida para quien
             quiere ver obra antes de pedir precio. -->
        <a
          href="<?php echo esc_url(home_url('/projects')); ?>"
          class="group/proj inline-flex items-center gap-2.5 border-2 border-white/60 py-4 pl-7 pr-6 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-white transition-colors duration-200 hover:border-white hover:bg-white/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
        >
          See our projects
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true" class="h-4 w-4 transition-transform duration-200 group-hover/proj:translate-x-0.5 motion-reduce:transform-none">
            <path d="M5 12h13M13 6l6 6-6 6" />
          </svg>
        </a>

        <!-- ── Badge BBB ──
             Enlace al perfil de EC en el Better Business Bureau. Texto, no
             el sello oficial: el logo de la antorcha es marca registrada de
             BBB y se usa vía su programa de sellos, no redibujado — si EC
             quiere el sello gráfico, se descarga del panel de BBB y esta
             etiqueta se reemplaza por la imagen.

             OJO (Pendiente 01): la URL del perfil dice /hooper/ — BBB tiene
             registrada la dirección VIEJA. El enlace funciona igual, pero
             conviene que EC actualice su listing a Higley Rd para que la
             citation coincida con el NAP del sitio. -->
        <a
          href="https://www.bbb.org/us/ut/hooper/profile/landscape-contractors/ec-landscaping-1126-90055383"
          target="_blank"
          rel="noopener noreferrer"
          aria-label="EC Landscaping profile on the Better Business Bureau"
          class="inline-flex items-center gap-2.5 border-2 border-white/60 py-4 pl-7 pr-6 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-white transition-colors duration-200 hover:border-white hover:bg-white/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
        >
          <span class="font-display font-bold tracking-tight">BBB</span>
          <span class="h-4 w-px bg-white/30" aria-hidden="true"></span>
          Business Profile
        </a>

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
      // Panel translúcido: el slideshow se ve a través. Solo el hero lleva
      // esto — /contact se queda en la superficie sólida, porque su panel
      // apoya sobre el bone de la página y la transparencia hundiría las
      // etiquetas. La lógica vive en ContactForm.js.
      'surface'        => 'glass',
      'inlineMinWidth' => '(min-width: 1280px)',
      'endpoint'       => esc_url_raw(rest_url('ec/v1/bid')),
      'nonce'          => wp_create_nonce('wp_rest'),
      'phone'          => '(385) 240-3907',
    );
    ?>

    <!-- min-h-0 es lo que deja al panel toparse con max-h-full y activar su
         scroll interno cuando el hero mide una pantalla.

         El ancho del formulario ya no lo pone la pista de la rejilla (que
         ahora es media pantalla) sino este nodo: w-full acotado a 27rem
         (30 en 2xl) y justify-self-center para quedar en el centro de su
         mitad, espejando a la columna de texto. -->
    <div
      id="ec-hero-form"
      class="hidden min-h-0 w-full max-w-[27rem] xl:flex xl:items-center xl:justify-self-center 2xl:max-w-[30rem]"
      data-props="<?php echo esc_attr(wp_json_encode($ec_hero_form_props)); ?>"
    ></div>
  </div>
</section>

<!-- ═══════════════ 02 · BARRA DE PRUEBA ═══════════════ -->
<!-- Cuatro placas CLARAS con relieve, sobre el marco oscuro de la sección.

     Antes la barra alternaba superficies (clay · ink · claro · ink); ahora
     las cuatro celdas van parejas en breeze-100 — el casi-blanco de la
     paleta, nunca blanco puro — y la separación ya no la hace el color sino
     el RELIEVE: cada celda es una placa biselada (bevel-tile, la utilidad
     que el tema define para tarjetas sobre claro) que se levanta al pasar
     el mouse (bevel-tile-raised + translate). El bisel dibuja luz arriba y
     sombra abajo por dentro de cada placa, así que las cuatro se leen como
     piezas físicas apoyadas sobre el fondo oscuro, no como celdas de tabla.

     OJO: esta rejilla NO lleva ec-plates a propósito. Sus reglas escriben
     box-shadow sobre cada hijo desde CSS sin capa, que pisa a las utilidades
     bevel-* (que viven en @layer utilities) — con las dos puestas, el bisel
     nunca se vería. Acá el relieve lo hace bevel-tile solo.

     El gap-px sobre el bg-ink del dl es el filete oscuro entre placas
     claras: la línea es el fondo asomando, como en el resto del sitio.

     Colores del texto sobre breeze-100, verificados en la nota de contraste
     del CSS: la cifra en ember-600 (el ember base da 3.12:1 y falla; el 600
     da 4.92:1) y la etiqueta en ink/70. La banda de rayas va en ink en las
     cuatro (ec-band--ink): rayas claras sobre claro no se ven.

     Como banda clara bajo el hero oscuro, además, separa el hero del
     bloque 03 con el corte más fuerte que da la paleta. -->
<section class="relative bg-ink lg:shrink-0">

  <dl class="grid grid-cols-2 gap-px bg-ink lg:grid-cols-4">
    <?php foreach ($proof_bar as $i => $item) : ?>
      <div class="group relative bg-breeze-100 bevel-tile px-5 py-7 transition-[box-shadow,transform] duration-200 ease-out hover:bevel-tile-raised hover:-translate-y-0.5 motion-reduce:transform-none motion-reduce:transition-none sm:px-8 lg:px-10 lg:py-5">

        <!-- Remate de rayas sobre el filo superior de cada placa, en ink:
             es el recurso de la valla girado, y sobre claro las rayas tienen
             que ser oscuras para verse. -->
        <div class="ec-band ec-band--h ec-band--ink pointer-events-none absolute inset-x-0 top-0 h-1.5 opacity-30" aria-hidden="true"></div>

        <dt class="font-display text-3xl font-bold tracking-tight text-ember-600 sm:text-4xl lg:text-[1.85rem]">
          <?php echo esc_html($item['stat']); ?>
        </dt>
        <dd class="mt-2 text-xs leading-relaxed text-ink/70 lg:mt-1">
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

    <!-- ── Acordeón expandible ──
         Reemplaza al marquee. Un panel abierto —foto a sangre con el número,
         el título y el cuerpo sobre un velo oscuro— y los otros cuatro
         colapsados como franjas verticales con su número y el título girado.
         Clic sobre una franja y se expande; el que estaba abierto colapsa.

         La mecánica es CSS puro sobre flex-grow: cada panel arranca en
         flex 1 1 0 y el activo salta a flex 7 1 0, con transición sobre
         flex-grow. El estado vive en el atributo data-active del panel y
         los hijos reaccionan con variantes group-data — el JS solo mueve
         el atributo, nunca clases.

         En móvil (<lg) el acordeón no existe: los cinco paneles apilan como
         bloques completos, cada uno con su foto y su texto visibles — en
         una pantalla angosta las franjas verticales no caben y obligarían
         a cinco taps para leer cinco párrafos. Los botones de expandir se
         ocultan porque no hay nada que expandir.

         El motor genérico del marquee ([data-carousel]) sigue vivo al pie
         de la plantilla: el carrusel de capacidades lo usa. -->
    <div data-expander class="mt-12 flex flex-col gap-3 lg:mt-16 lg:h-[32rem] lg:flex-row">
      <?php foreach ($clusters as $ec_i => $cluster) : ?>
        <article
          data-expander-panel
          <?php echo 0 === $ec_i ? 'data-active' : ''; ?>
          class="group relative min-h-[24rem] overflow-hidden bg-ink transition-[flex-grow] duration-500 ease-out motion-reduce:transition-none lg:min-h-0 lg:flex-[1_1_0%] lg:data-active:flex-[7_1_0%]"
        >
          <!-- Foto a sangre. Sin lazy en la primera: es la que se ve al
               llegar a la sección. -->
          <?php if (!empty($cluster['image'])) : ?>
            <img
              src="<?php echo esc_url($cluster['image']); ?>"
              alt="<?php echo esc_attr($cluster['alt']); ?>"
              class="absolute inset-0 h-full w-full object-cover"
              <?php echo 0 === $ec_i ? '' : 'loading="lazy"'; ?>
              decoding="async"
            />
          <?php else : ?>
            <div class="absolute inset-0 bg-[linear-gradient(150deg,#696D56_0%,#565945_100%)]" aria-hidden="true"></div>
          <?php endif; ?>

          <!-- Velo: denso abajo, donde vive el texto del panel abierto, y un
               velo base parejo que mantiene legibles número y título girado
               en las franjas colapsadas. -->
          <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(26,29,25,0.25)_0%,rgba(26,29,25,0.35)_45%,rgba(26,29,25,0.88)_100%)]" aria-hidden="true"></div>

          <!-- Botón que cubre el panel entero. Solo desde lg: en móvil no
               hay estados que alternar. aria-expanded lo maneja el JS. -->
          <button
            type="button"
            data-expander-btn
            aria-expanded="<?php echo 0 === $ec_i ? 'true' : 'false'; ?>"
            aria-label="Show <?php echo esc_attr($cluster['title']); ?>"
            class="absolute inset-0 z-10 hidden cursor-pointer lg:block focus-visible:outline-2 focus-visible:outline-offset-[-4px] focus-visible:outline-ember"
          ></button>

          <!-- Etiqueta colapsada: número arriba, título girado debajo, como
               la referencia. Desaparece cuando el panel se abre. -->
          <div class="pointer-events-none absolute inset-0 hidden flex-col items-center gap-4 pt-7 opacity-100 transition-opacity duration-300 group-data-[active]:opacity-0 motion-reduce:transition-none lg:flex" aria-hidden="true">
            <span class="font-display text-sm font-bold tabular-nums text-white">
              <?php echo esc_html(str_pad($ec_i + 1, 2, '0', STR_PAD_LEFT)); ?>
            </span>
            <span class="font-display text-base font-bold tracking-wide text-white [writing-mode:vertical-rl]">
              <?php echo esc_html($cluster['title']); ?>
            </span>
          </div>

          <!-- Contenido expandido. En móvil siempre visible; en lg aparece
               con el panel. El retardo de 150ms en la entrada deja que el
               panel gane ancho antes de que el texto aparezca — sin él, el
               párrafo se dibuja apretado y se reacomoda a los tirones. -->
          <div class="relative flex h-full min-h-[inherit] flex-col justify-end p-7 lg:p-9 lg:opacity-0 lg:transition-opacity lg:duration-300 lg:delay-0 lg:group-data-[active]:opacity-100 lg:group-data-[active]:delay-150 motion-reduce:transition-none">
            <p class="text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-white/70 tabular-nums">
              <?php echo esc_html(str_pad($ec_i + 1, 2, '0', STR_PAD_LEFT)); ?> / <?php echo esc_html(str_pad(count($clusters), 2, '0', STR_PAD_LEFT)); ?>
            </p>
            <h3 class="mt-3 font-display text-2xl font-bold leading-snug tracking-tight text-white sm:text-3xl">
              <?php echo esc_html($cluster['title']); ?>
            </h3>
            <p class="mt-4 max-w-xl text-sm leading-relaxed text-white/85 sm:text-base">
              <?php echo esc_html($cluster['body']); ?>
            </p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════════ 03B · REVIEWS (Trustindex) ═══════════════════ -->
<!-- Widget de reseñas de Google vía el plugin Trustindex, en modo
     no-registration. Va justo después de Who we build for: el acordeón
     termina de decir "esto resolvemos por vos" y las reseñas lo respaldan
     antes de pasar a capacidades.

     El shortcode se emite SOLO si el plugin está activo: sin el guard,
     do_shortcode devolvería el texto crudo "[trustindex...]" impreso en
     la página — que es exactamente lo que un visitante no debe ver si el
     plugin se desactiva o todavía no se instaló en producción. Con el
     plugin ausente, la sección entera desaparece sin dejar hueco.

     Esta sección deja resuelto el Pendiente 05 (testimonios): las reseñas
     salen de Google en vivo, textuales, sin redactar — que era justo la
     regla del pendiente. -->
<?php if (shortcode_exists('trustindex')) : ?>
  <section class="bg-breeze-100 lg:flex lg:items-start">
    <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
      <div data-reveal class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
        <div class="max-w-3xl">
          <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Reviews</p>
          <h2 class="ec-shine ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
            Rated by the people <em>we build for.</em>
          </h2>
        </div>

        <!-- ── Dejar una reseña ──
             Enlace directo al formulario de reseña de Google, armado con el
             Place ID del perfil (el mismo conectado en Trustindex): abre el
             cuadro de "escribir reseña" ya apuntado a EC, sin pasos
             intermedios.

             Fantasma en ink, no pine sólido: los botones llenos de la página
             son los CTA de bid, y pedir una reseña no puede competir con
             pedir un bid. -->
        <a
          href="https://search.google.com/local/writereview?placeid=ChIJ3zrK_SwPU4cR6_lv5qbtoYI"
          target="_blank"
          rel="noopener noreferrer"
          class="group/rev inline-flex shrink-0 items-center gap-2.5 self-start border-2 border-ink/60 py-3.5 pl-6 pr-5 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink transition-colors duration-200 hover:border-ink hover:bg-ink hover:text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember lg:self-auto"
        >
          Leave a review
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="h-4 w-4 transition-transform duration-200 group-hover/rev:translate-x-0.5 motion-reduce:transform-none">
            <path d="M5 12h13M13 6l6 6-6 6" />
          </svg>
        </a>
      </div>

      <div class="mt-10">
        <?php echo do_shortcode('[trustindex no-registration=google]'); ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<!-- ═══════════════════ 04 · PRECEDENTE — ELIMINADA ═══════════════════ -->
<!-- La sección de Track record se retiró a pedido. Su video de fondo vive
     ahora en el bloque 11 (FAQ), más abajo. El id #projects se fue con ella:
     ver la nota junto a $faq_video sobre el enlace del footer. -->

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
<!-- Línea de tiempo en zigzag: encabezado centrado, una línea vertical al
     centro con el número de cada paso montado encima, y las filas alternando
     texto e imagen de lado. Reemplaza a la rejilla modular de bloques.

     La estructura por fila (desde lg):
       · grid de dos columnas con gap-24; la línea corre por el centro del
         hueco y el marcador del número se monta encima, en absolute.
       · el gap de 6rem es lo que le hace sitio al marcador: 3rem de cada
         lado del centro contra un marcador de 3.5rem — sobra sin que haga
         falta padding extra en las columnas.
       · el texto del lado izquierdo va alineado a la derecha, contra la
         línea, como en la referencia; el del lado derecho, normal.

     En móvil no hay línea ni marcador: el eyebrow "Step 0N" lleva el número
     y cada paso apila texto y foto.

     El orden se invierte en el DOM y no con `order`, la misma convención de
     todo el tema: con `order` el lector de pantalla oiría siempre la foto
     primero en las filas invertidas sin que el DOM lo diga.

     Las fotos vienen de $ec_process_media, vacías por ahora: cada celda
     muestra el panel liso en verde de marca hasta que llegue su URL. -->
<section class="bg-bone lg:flex lg:min-h-svh lg:items-start">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">

    <!-- ── Encabezado centrado ── -->
    <div data-reveal class="mx-auto max-w-3xl text-center">
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Process</p>
      <h2 class="ec-shine ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
        How a bid becomes<br /><em>a finished site.</em>
      </h2>
    </div>

    <!-- ── Línea de tiempo ── -->
    <div class="relative mt-14 lg:mt-20">

      <!-- La línea vertical, detrás de los marcadores. Solo desde lg: en
           móvil las filas apilan y una línea al costado no une nada. -->
      <div class="absolute inset-y-0 left-1/2 hidden w-px -translate-x-1/2 bg-ink/15 lg:block" aria-hidden="true"></div>

      <ol class="flex flex-col gap-14 lg:gap-24">
        <?php foreach ($process as $ec_i => $step) :

          $ec_media = isset($ec_process_media[$ec_i]) ? $ec_process_media[$ec_i] : array('image' => '', 'alt' => '');

          // Pasos pares (1º, 3º, 5º): texto a la izquierda, foto a la
          // derecha. Impares al revés. El texto del lado izquierdo se alinea
          // contra la línea central.
          $ec_izq = (0 === $ec_i % 2);

          $ec_texto = function () use ($step, $ec_izq) { ?>
            <div class="<?php echo $ec_izq ? 'lg:text-right' : ''; ?>">
              <p class="text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-800">
                Step <?php echo esc_html(str_pad($step['n'], 2, '0', STR_PAD_LEFT)); ?>
              </p>
              <h3 class="mt-3 font-display text-2xl font-bold leading-snug tracking-tight text-ink sm:text-3xl">
                <?php echo esc_html($step['title']); ?>
              </h3>
              <p class="mt-4 text-base leading-relaxed text-ink/70">
                <?php echo esc_html($step['body']); ?>
              </p>
            </div>
          <?php };

          $ec_foto = function () use ($ec_media) { ?>
            <div class="mt-8 lg:mt-0">
              <?php if (!empty($ec_media['image'])) : ?>
                <img
                  src="<?php echo esc_url($ec_media['image']); ?>"
                  alt="<?php echo esc_attr($ec_media['alt']); ?>"
                  class="aspect-[4/3] w-full object-cover"
                  loading="lazy"
                  decoding="async"
                />
              <?php else : ?>
                <!-- Respaldo mientras no hay foto: panel liso en verde de
                     marca, el mismo de las tarjetas de capacidades. La celda
                     conserva su proporción y el zigzag no se rompe. -->
                <div class="aspect-[4/3] w-full bg-[linear-gradient(150deg,#696D56_0%,#565945_100%)]" aria-hidden="true"></div>
              <?php endif; ?>
            </div>
          <?php };
        ?>
          <li data-reveal class="relative lg:grid lg:grid-cols-2 lg:items-center lg:gap-24">

            <!-- Marcador del número, montado sobre la línea central.
                 aria-hidden: el número ya lo anuncia el eyebrow "Step 0N"
                 del texto — este cuadrado es la versión gráfica. -->
            <div
              class="absolute left-1/2 top-1/2 hidden h-14 w-14 -translate-x-1/2 -translate-y-1/2 items-center justify-center border border-ember bg-breeze-100 bevel-tile lg:flex"
              aria-hidden="true"
            >
              <span class="font-display text-lg font-bold tracking-tight text-ember-600 tabular-nums">
                <?php echo esc_html(str_pad($step['n'], 2, '0', STR_PAD_LEFT)); ?>
              </span>
            </div>

            <?php if ($ec_izq) { $ec_texto(); $ec_foto(); } else { $ec_foto(); $ec_texto(); } ?>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </div>
</section>

<!-- ═══════════════════ 08 · CREDENCIALES ═══════════════════ -->
<!-- Rediseñada (ago 2026): VIDEO-EC.mp4 a sangre de fondo y las
     credenciales como LISTADO con reveal escalonado, en lugar del damero
     de módulos.

     Dos columnas desde lg, como la FAQ: a la izquierda el encabezado
     pegajoso con la placa del premio debajo; a la derecha las nueve
     credenciales apiladas como filas — etiqueta arriba en ember-300, valor
     en display bold — separadas por filetes claros, entrando una por una
     al llegar a pantalla (data-list-reveal, 90ms de escalón).

     El velo es el OSCURECEDOR NEUTRO de la casa (pine-900), no un tinte:
     un color medio desaturaría el metraje. Va denso (~0.85, el mismo rango
     que la FAQ) porque las filas apoyan DIRECTO sobre el video — el velo
     es quien garantiza el contraste, y el metraje queda como presencia.

     El video usa el manejador [data-bg-video]: no descarga hasta que la
     sección se acerca, y en móvil / reduced-motion / saveData queda el
     velo sobre bg-ink — la sección sigue legible sin metraje. -->
<section id="credentials" class="relative isolate overflow-hidden bg-ink text-bone lg:flex lg:min-h-svh lg:items-start">

  <video
    data-bg-video
    class="absolute inset-0 -z-20 h-full w-full object-cover"
    data-src="<?php echo esc_url($ec_uploads['baseurl'] . '/2026/08/VIDEO-EC.mp4'); ?>"
    muted
    loop
    playsinline
    preload="none"
    aria-hidden="true"
    tabindex="-1"
  ></video>

  <div
    class="absolute inset-0 -z-10 bg-[linear-gradient(180deg,rgba(26,29,25,0.88)_0%,rgba(26,29,25,0.82)_50%,rgba(26,29,25,0.88)_100%)]"
    aria-hidden="true"
  ></div>

  <div class="relative w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="grid gap-12 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.5fr)] lg:gap-16">

      <!-- ── Encabezado + premio ──
           Pegajoso como el de la FAQ: la lista de la derecha es larga y sin
           sticky el título se va de pantalla a mitad del recorrido. -->
      <div data-reveal class="lg:sticky lg:top-[calc(var(--header-offset)+3rem)] lg:self-start">
        <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300">Credentials</p>
        <h2 class="ec-shine ec-shine--light ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-bone sm:text-4xl">
          The page your compliance team <em>is going to ask for.</em>
        </h2>
        <p class="mt-6 text-base leading-relaxed text-bone/80">
          Boring for everyone else. Decisive for you.
        </p>

        <!-- La placa del premio como BLOQUE de imagen: ancho completo de la
             columna y proporción fija, con object-cover. La foto original es
             vertical (la placa centrada con fondo de escritorio), así que el
             recorte come fondo por arriba y abajo y deja la placa — si en
             el navegador el recorte la pellizca, las perillas son
             object-position (bajar el foco: object-[center_35%]) o la
             proporción (aspect-[4/5] muestra más placa a costa de alto).
             La mejora real sería exportar un recorte horizontal de la misma
             foto, pensado para este encuadre. -->
        <img
          src="<?php echo esc_url($ec_uploads['baseurl'] . '/2026/07/ec_landscaping_award.png'); ?>"
          alt="BusinessRate Best of 2026 Award Winner plaque"
          class="mt-10 aspect-[5/4] w-full object-cover object-center"
          loading="lazy"
          decoding="async"
        />
        <p class="mt-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-bone/60">
          BusinessRate Best of 2026 — Landscaper
        </p>
      </div>

      <!-- ── Listado de credenciales, con reveal escalonado ── -->
      <dl>
        <?php foreach ($credentials as $ec_i => $row) : ?>
          <div
            data-list-reveal
            style="transition-delay: <?php echo (int) ($ec_i * 90); ?>ms"
            class="border-b border-white/15 py-6 transition-[opacity,transform] duration-700 ease-out first:pt-0 last:border-b-0 motion-reduce:transition-none lg:py-7"
          >
            <dt class="text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300">
              <?php echo esc_html($row['label']); ?>
            </dt>
            <dd class="mt-2 font-display text-xl leading-snug font-bold tracking-tight text-bone tabular-nums [overflow-wrap:anywhere] sm:text-2xl">
              <?php echo esc_html($row['value']); ?>
            </dd>
          </div>
        <?php endforeach; ?>
      </dl>
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

    <!-- Sin ec-plates (ago 2026): sus reglas escriben box-shadow sobre cada
         hijo desde CSS sin capa y pisarían a las utilidades bevel-* — la
         misma lección de la barra de prueba. El relieve 3D de cada bloque
         lo hace bevel-tile solo, como en los botones flotantes. -->
    <div data-reveal class="grid gap-px bg-ink/15 lg:grid-cols-6">

      <!-- ── Titular ── -->
      <div class="bevel-tile transition-[box-shadow,transform] duration-200 ease-out hover:bevel-tile-raised hover:-translate-y-0.5 motion-reduce:transform-none motion-reduce:transition-none relative flex flex-col justify-end bg-ink p-8 text-bone lg:col-span-2 lg:p-10">
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
      <div class="bevel-tile transition-[box-shadow,transform] duration-200 ease-out hover:bevel-tile-raised hover:-translate-y-0.5 motion-reduce:transform-none motion-reduce:transition-none relative bg-ember p-8 text-ink lg:col-span-2 lg:p-10">
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
      <div class="bevel-tile transition-[box-shadow,transform] duration-200 ease-out hover:bevel-tile-raised hover:-translate-y-0.5 motion-reduce:transform-none motion-reduce:transition-none relative bg-sand p-8 lg:col-span-2 lg:p-10">
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
      <div class="bevel-tile transition-[box-shadow,transform] duration-200 ease-out hover:bevel-tile-raised hover:-translate-y-0.5 motion-reduce:transform-none motion-reduce:transition-none relative flex flex-col justify-between bg-breeze-100 p-8 lg:col-span-2 lg:p-10">
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

<!-- ═══════════════════ 10 · REPUTACIÓN — retirada ═══════════════════ -->
<!-- Las reseñas viven en la sección 03B (Trustindex), tras Who we build
     for. Ver la nota junto a la definición de datos del bloque 10. -->

<!-- ═══════════════════════ 11 · FAQ ═══════════════════════ -->
<!-- Con el video de fondo heredado de la sección 04, que se eliminó.

     El velo acá es MÁS denso que el que llevaba Track record (0.9 contra
     0.55), y la diferencia no es de gusto: allá el texto vivía dentro de
     bloques opacos y el velo solo tenía que impedir que el video compitiera;
     acá las preguntas y respuestas apoyan DIRECTO sobre el metraje, así que
     el velo es el que garantiza el contraste. El video queda como presencia
     — se insinúa, no protagoniza — que es lo máximo que admite una sección
     de lectura larga.

     Todo el texto se invierte con la superficie: eyebrow a ember-300 (el
     forest da 2.38:1 sobre ink — invisible), titulares a bone con
     ec-shine--light, filetes a white/15. -->
<section class="relative isolate overflow-hidden bg-ink text-bone lg:flex lg:min-h-svh lg:items-start">

  <video
    data-bg-video
    class="absolute inset-0 -z-20 h-full w-full object-cover"
    data-src="<?php echo esc_url($faq_video); ?>"
    <?php if ($faq_poster) : ?>poster="<?php echo esc_url($faq_poster); ?>"<?php endif; ?>
    muted
    loop
    playsinline
    preload="none"
    aria-hidden="true"
    tabindex="-1"
  ></video>

  <div
    class="absolute inset-0 -z-10 bg-[linear-gradient(180deg,rgba(47,52,45,0.92)_0%,rgba(47,52,45,0.86)_50%,rgba(47,52,45,0.92)_100%)]"
    aria-hidden="true"
  ></div>

  <div class="relative w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="grid gap-10 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.6fr)] lg:gap-16">

      <!-- Encabezado pegajoso: el acordeón crece al abrirse y sin sticky el
           título se va de pantalla justo cuando el usuario está leyendo la
           respuesta más larga. self-start es lo que impide que la columna
           se estire y anule el sticky. -->
      <div data-reveal class="lg:sticky lg:top-[calc(var(--header-offset)+3rem)] lg:self-start">
        <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300">FAQ</p>
        <h2 class="ec-shine ec-shine--light ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-bone sm:text-4xl">
          Questions estimators <em>actually ask.</em>
        </h2>

        <!-- La página ya no tiene bloque de CTA final, así que este es el
             último punto de contacto antes del footer. -->
        <p class="mt-6 max-w-sm text-base leading-relaxed text-bone/80">
          Not covered here? Ask the estimator directly — you’ll get the owner or the person who priced your job, not a call center.
        </p>
        <a
          href="tel:+13852403907"
          class="mt-6 inline-flex items-center gap-2.5 text-lg font-semibold tabular-nums text-bone underline decoration-ember decoration-2 underline-offset-8 transition-colors hover:text-white focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember"
        >
          (385) 240-3907
        </a>
      </div>

      <!-- <details> nativo: acordeón accesible sin una línea de JavaScript. -->
      <div>
        <?php foreach ($faqs as $faq) : ?>
          <details class="group border-b border-white/15 first:border-t first:border-white/15">
            <summary class="flex cursor-pointer list-none items-start justify-between gap-6 py-6 marker:content-none [&::-webkit-details-marker]:hidden">
              <span class="font-display text-lg font-bold leading-snug tracking-tight text-bone transition-colors group-hover:text-ember-300 group-open:text-ember-300 sm:text-xl">
                <?php echo esc_html($faq['q']); ?>
              </span>
              <!-- El signo gira 45° al abrir: el mismo glifo hace de más y de
                   cruz, así que el estado se lee sin cambiar de ícono. -->
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true" class="mt-1 h-4 w-4 shrink-0 text-ember-300 transition-transform duration-200 group-open:rotate-45 motion-reduce:transition-none">
                <path d="M12 5v14M5 12h14" />
              </svg>
            </summary>
            <!-- Filete ember a la izquierda de la respuesta: ata visualmente
                 el texto abierto con el ícono que lo abrió. -->
            <p class="mb-6 border-l-2 border-ember pl-5 text-[0.95rem] leading-relaxed text-bone/80">
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
  /* ── Reveal escalonado del listado de credenciales ──
     Las filas salen VISIBLES en el HTML; este script esconde las que
     todavía no entraron en pantalla y las suelta cuando llegan, con el
     retardo escalonado que cada fila trae en su transition-delay inline.
     El orden importa: primero se esconden solo las filas por debajo del
     viewport (las ya visibles al cargar nunca parpadean), después observa.
     Sin JS las credenciales simplemente están ahí — el contenido nunca se
     apuesta a que corra un script (menos esta sección, que es la que el
     compliance del comprador viene a leer). Con prefers-reduced-motion la
     transición se anula desde las clases y el reveal es instantáneo.
     Genérico por atributo: cualquier otra lista con [data-list-reveal] y
     su transition-delay ya queda servida. */
  (function () {
    var items = document.querySelectorAll('[data-list-reveal]');
    if (!items.length || !('IntersectionObserver' in window)) return;

    var oculto = ['opacity-0', 'translate-y-5'];

    Array.prototype.forEach.call(items, function (el) {
      if (el.getBoundingClientRect().top > window.innerHeight) {
        el.classList.add.apply(el.classList, oculto);
      }
    });

    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.remove.apply(entry.target.classList, oculto);
        io.unobserve(entry.target);
      });
    }, { threshold: 0.3 });

    Array.prototype.forEach.call(items, function (el) { io.observe(el); });
  })();

  /* ── Acordeón expandible de "Who we build for" ──
     El JS solo mueve el atributo data-active entre paneles y sincroniza
     aria-expanded; toda la animación (flex-grow, opacidades, retardo del
     texto) vive en las clases del markup. Un clic sobre el panel ya abierto
     no hace nada: siempre hay exactamente uno abierto, como en la
     referencia — colapsar todo dejaría cinco franjas mudas. */
  (function () {
    var root = document.querySelector('[data-expander]');
    if (!root) return;

    var panels = root.querySelectorAll('[data-expander-panel]');

    root.addEventListener('click', function (event) {
      var btn = event.target.closest('[data-expander-btn]');
      if (!btn) return;
      var target = btn.closest('[data-expander-panel]');
      if (!target || target.hasAttribute('data-active')) return;

      Array.prototype.forEach.call(panels, function (panel) {
        var on = panel === target;
        if (on) panel.setAttribute('data-active', '');
        else panel.removeAttribute('data-active');
        var b = panel.querySelector('[data-expander-btn]');
        if (b) b.setAttribute('aria-expanded', on ? 'true' : 'false');
      });
    });
  })();

  /* ── Slideshow del hero ──
     Rotación con crossfade sobre las imágenes apiladas de
     [data-hero-slideshow]. El JS solo intercambia opacity-100/opacity-0;
     la transición la hace el CSS de las propias imágenes.

     Al arrancar asigna las data-src de los slides 2..n — es lo que difiere
     su descarga fuera de la carga inicial sin depender de loading="lazy",
     que no aplazaría nada con las imágenes apiladas dentro del viewport.
     Hay 6 segundos de mantenido antes del primer cambio: de sobra para que
     el segundo slide llegue, y si una foto viene lenta, el guard de
     `complete` la salta en lugar de fundir hacia un hueco.

     Con prefers-reduced-motion la rotación no arranca y las data-src no se
     asignan: queda la primera foto, estática, y no se descarga lo que no se
     va a mostrar. Se consulta en vivo, como el marquee: si la preferencia
     se activa con la página abierta, la rotación para donde está.

     Pausa fuera de pantalla y con la pestaña oculta: rotar un fondo que
     nadie ve solo gasta batería y decodificación. */
  (function () {
    var root = document.querySelector('[data-hero-slideshow]');
    if (!root) return;

    var slides = root.querySelectorAll('img');
    if (slides.length < 2) return;

    var mqReduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)');

    var HOLD = 6000;   // ms que cada foto se queda quieta
    var current = 0;
    var timer = null;
    var onScreen = true;
    var loaded = false;

    function loadRest() {
      if (loaded) return;
      loaded = true;
      Array.prototype.forEach.call(slides, function (img) {
        if (img.dataset.src && !img.src) img.src = img.dataset.src;
      });
    }

    function advance() {
      if (document.hidden || !onScreen) return;

      // Siguiente slide ya cargado. Si el próximo viene lento se lo salta,
      // en vez de fundir hacia una imagen vacía. Si ninguno está listo
      // todavía, se queda en el actual y lo intenta al próximo tick.
      var next = current;
      for (var i = 1; i <= slides.length; i++) {
        var candidate = (current + i) % slides.length;
        if (slides[candidate].complete && slides[candidate].naturalWidth > 0) {
          next = candidate;
          break;
        }
      }
      if (next === current) return;

      slides[current].classList.remove('opacity-100');
      slides[current].classList.add('opacity-0');
      slides[next].classList.remove('opacity-0');
      slides[next].classList.add('opacity-100');
      current = next;
    }

    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function (entries) {
        onScreen = entries[0].isIntersecting;
      }, { threshold: 0 }).observe(root);
    }

    function enable() {
      if (timer) return;
      loadRest();
      timer = window.setInterval(advance, HOLD);
    }

    function disable() {
      if (!timer) return;
      window.clearInterval(timer);
      timer = null;
    }

    function applyMotionPreference() {
      if (mqReduce && mqReduce.matches) disable();
      else enable();
    }

    if (mqReduce) {
      if (mqReduce.addEventListener) mqReduce.addEventListener('change', applyMotionPreference);
      else if (mqReduce.addListener) mqReduce.addListener(applyMotionPreference);
    }

    applyMotionPreference();
  })();

  /* Manejador de los [data-bg-video] de la página. Sirve a DOS: el de
     Credentials (VIDEO-EC.mp4) y el del bloque FAQ. Genérico: cualquier
     sección nueva con video ya queda cubierta.

     El src se asigna por JS, nunca en el HTML, por dos razones:

     1. No se descarga cuando no se va a ver. Tres casos:
        · prefers-reduced-motion — un video de fondo en loop es exactamente
          el movimiento que esa preferencia pide evitar.
        · pantallas chicas — el comprador de esta página revisa proveedores
          desde una obra, con datos móviles.
        · saveData o 2G/3G.
        En esos casos queda el poster.

     2. Carga diferida por proximidad: no empieza a descargar hasta que su
        sección se acerca al viewport. */
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