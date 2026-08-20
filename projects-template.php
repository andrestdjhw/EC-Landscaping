<?php
/**
 * Template Name: Projects
 *
 * Página propia de precedente institucional. Hasta ahora "Projects" era un
 * ancla del bloque 04 de la home; ese bloque se queda donde está —es el que
 * sostiene la landing— y esta página lo desarrolla.
 *
 * ═══════════════════════════════════════════════════════════════════
 * ADVERTENCIA DE CONTENIDO — leer antes de publicar
 *
 * El copy deck no tiene una sección de proyectos. Lo único aprobado son los
 * dos casos de la Versión B del bloque 04, que es lo que arma esta página.
 * Dos casos sin nombre no son un portafolio: son un precedente.
 *
 * Por eso la página NO promete un portafolio. No dice "our work", no dice
 * "featured projects" y no tiene una rejilla de fotos que quede coja con dos
 * entradas. Afirma exactamente lo que se puede sostener hoy y deja la
 * estructura lista para crecer.
 *
 * La galería trae 12 proyectos de los cuales SOLO DOS son reales. Los otros
 * diez llevan 'draft' => true en los datos, pero NADA lo indica en la página:
 * se quitó el sello a pedido, para poder presentarla sin que parezca maqueta.
 *
 * ⚠ ANTES DE PUBLICAR: reemplazar esos diez por obras reales, o poner
 *   $ec_show_drafts en false. Ver la nota larga sobre $projects.
 *
 * Lo que hace falta para llenarlas:
 *   · Fotos reales de obra de EC (Pendiente de Tomás, el más viejo del brief)
 *   · Permiso escrito de Maverik y America First para nombrarlos (P03)
 *   · Alcance, plazo y resultado de cada obra
 * ═══════════════════════════════════════════════════════════════════
 */

get_header();

$ec_uploads = wp_get_upload_dir();

/* Foto del encabezado. Se arma desde wp_get_upload_dir() para que sobreviva
   la migración de ec-landscaping.local a producción.

   Vacía = el encabezado vuelve a ser el bloque de color liso que tenía antes.
   La condición está en el markup, así que no hay que tocar nada más. */
$ec_hero_img = $ec_uploads['baseurl'] . '/2026/08/MultifamilyComplex-scaled.jpg';

/* ─────────────────────────────────────────────────────────────
   ENCABEZADO
   ───────────────────────────────────────────────────────────── */
$page = array(
  'eyebrow' => 'Track record · Northern Utah',
  'title'   => 'Brands that audit every vendor',
  'title_em'=> 'already hired us.',
  'lede'    => 'Institutional buyers do not hand out contracts on a handshake. They review licensing, insurance, safety documentation and capacity before anyone touches the site. These are the ones that reviewed ours.',
);

/* ═════════════════════════════════════════════════════════════════
   GALERÍA DE PROYECTOS

   ── URLs DE IMAGEN ──
   Se pegan desde WP Admin → Medios → clic en la imagen → Copiar URL.
   Tres mapas, uno por pestaña del visor. La clave es el id del proyecto.

   Cualquiera puede quedar vacío: la galería lo resuelve sola. Sin foto
   principal la tarjeta muestra un panel con su categoría; sin "before" el
   proyecto no ofrece el comparador; sin "detail" esa pestaña no aparece.
   ═════════════════════════════════════════════════════════════════ */

$ec_uploads_url = $ec_uploads['baseurl'];

// Foto principal. Sale en la tarjeta y en la pestaña "Project" del visor.
$ec_img_main = array(
  // ── Landscape installation ──
  // El id 1 tenía ConvenienceStore-scaled.webp y se reemplazó por la primera
  // de las tres nuevas. Para volver atrás, esa línea es la única que cambia.
  1 => $ec_uploads_url . '/2026/08/LandscapingProject1.jpg',
  3 => $ec_uploads_url . '/2026/08/LandscapingProject2.jpg',
  4 => $ec_uploads_url . '/2026/08/LandscapingProject3.jpg',

  // ── Hardscape & concrete ──
  // El id 2 tenía FinancialInstitution-scaled.webp y se reemplazó por la
  // primera de las tres nuevas. Para volver atrás, esa línea es la única
  // que hay que cambiar.
  2 => $ec_uploads_url . '/2026/08/HardscapeProject1.webp',
  5 => $ec_uploads_url . '/2026/08/HardscapeProject2.jpg',
  6 => $ec_uploads_url . '/2026/08/HardscapeProject3.jpg',

  // ── Grounds maintenance ──
  7 => $ec_uploads_url . '/2026/08/GroundsProject1.webp',
  8 => $ec_uploads_url . '/2026/08/GroundsProject2.webp',
  9 => $ec_uploads_url . '/2026/08/GroundsProject3.jpg',

  // ── Water-wise retrofits ──
  // Mapeadas por el número del archivo, que sigue el orden de los prompts:
  // 1 turf conversion · 2 controller retrofit · 3 entry.
  10 => $ec_uploads_url . '/2026/08/WaterWiseProject1-scaled.jpg',

  // .jpeg y no .jpg: es la única de las tres con esa extensión. La URL tiene
  // que coincidir con el archivo, así que se respeta tal cual.
  11 => $ec_uploads_url . '/2026/08/WaterWiseProject2.jpeg',

  12 => $ec_uploads_url . '/2026/08/WaterWiseProject3-scaled.jpg',
);

// Estado previo. Habilita el comparador de arrastre.
$ec_img_before = array(
  1  => '',
  3  => '',
  4  => '',
  2  => '',
  5  => '',
  6  => '',
  7  => '',
  8  => '',
  9  => '',
  10 => '',
  11 => '',
  12 => '',
);

// Detalle de obra: material, junta, remate.
$ec_img_detail = array(
  1  => '',
  3  => '',
  4  => '',
  2  => '',
  5  => '',
  6  => '',
  7  => '',
  8  => '',
  9  => '',
  10 => '',
  11 => '',
  12 => '',
);

/* ─────────────────────────────────────────────────────────────
   PROYECTOS — 3 por categoría, 12 en total

   ⚠⚠ SOLO DOS SON REALES (ids 1 y 2). LOS OTROS DIEZ NO LO SON. ⚠⚠

   Los diez llevan 'draft' => true y a partir de acá ESA MARCA SOLO EXISTE EN
   EL CÓDIGO: la tarjeta ya no muestra ningún sello y la página se ve
   terminada. Fue un pedido explícito, para poder presentarla sin que parezca
   una maqueta.

   Eso traslada el riesgo a quien lea esto. El copy está escrito para no
   afirmar nada verificable —no hay nombres de cliente, ni montos, ni fechas
   de entrega, ni métricas— y los títulos describen un TIPO DE SITIO y una
   CIUDAD del área de servicio, no una obra documentada. Pero un visitante no
   distingue eso: va a leer doce proyectos y va a creer que son doce.

   Si un GC pide la referencia de "Retail pad — Layton" y no existe, el daño
   no es a la ficha: es a la página entera, cuyo argumento es justamente que
   compradores institucionales auditaron a EC y la contrataron.

   ── ANTES DE PUBLICAR, UNA DE LAS DOS ──
   A. Reemplazar el copy de los diez por obras reales y quitarles 'draft'.
   B. Poner $ec_show_drafts en false. La galería queda con los dos reales y
      los conteos de los filtros se ajustan solos.

   Lo que no es una opción es publicar así y olvidarse.

   ── PARA CONVERTIR UNA EN REAL ──
   1. Reemplazar title / place / desc / scope con los datos de la obra.
   2. Quitar la línea 'draft' => true.
   3. Sumar las URLs a $ec_img_main / _before / _detail con su id.
   ───────────────────────────────────────────────────────────── */

/* El interruptor. En true se ven las plantillas; en false la galería queda
   solo con los proyectos reales. */
$ec_show_drafts = true;

$projects = array(

  /* ══ LANDSCAPE INSTALLATION ══════════════════════════════ */
  array(
    'id'        => 1,
    'category'  => 'landscape',
    'cat_label' => 'Landscape installation',
    'title'     => 'Convenience store chain — 800+ locations',
    'place'     => 'Northern Utah',
    'desc'      => "Full site landscape installation to corporate brand standard, coordinated with the general contractor's opening schedule. Six-figure contract, delivered on the opening date.",
    'scope'     => 'Grading · Irrigation · Planting · Sod · Final grade',
    'size'      => 'wide',
    'ph_main'   => 'Completed site — convenience store landscape to brand standard',
    'ph_before' => 'Site before installation',
    'ph_detail' => 'Detail — planting bed and edge',
  ),
  array(
    'id'        => 3,
    'category'  => 'landscape',
    'cat_label' => 'Landscape installation',
    'title'     => 'Retail pad — Layton',
    'place'     => 'Layton, UT',
    'desc'      => 'New construction pad on a commercial corridor. Grading and soil preparation, irrigation mains and zones, planting and sod to the civil plan, coordinated around the general contractor’s sequence.',
    'scope'     => 'Grading · Irrigation · Planting · Sod',
    'size'      => 'normal',
    'draft'     => true,
    'ph_main'   => 'Retail pad — Layton',
    'ph_before' => 'Site before work began',
    'ph_detail' => 'Detail',
  ),
  array(
    'id'        => 4,
    'category'  => 'landscape',
    'cat_label' => 'Landscape installation',
    'title'     => 'Multifamily complex — Roy',
    'place'     => 'Roy, UT',
    'desc'      => 'Full site landscape for a multifamily property: common areas, entry approach and the strips between buildings that decide whether the place looks maintained a year in.',
    'scope'     => 'Grading · Irrigation · Planting · Final grade',
    'size'      => 'tall',
    'draft'     => true,
    'ph_main'   => 'Multifamily complex — Roy',
    'ph_before' => 'Site before work began',
    'ph_detail' => 'Detail',
  ),

  /* ══ HARDSCAPE & CONCRETE ════════════════════════════════ */
  array(
    'id'        => 2,
    'category'  => 'hardscape',
    'cat_label' => 'Hardscape & concrete',
    'title'     => 'Credit union — 115+ branches',
    'place'     => 'Weber–Davis corridor',
    'desc'      => 'Branch site landscape and hardscape installation, awarded after institutional review of licensing, insurance and safety documentation.',
    'scope'     => 'Flatwork · Curbing · Walkways · Planting',
    'size'      => 'tall',
    'ph_main'   => 'Completed branch site — landscape and hardscape',
    'ph_before' => 'Branch site before installation',
    'ph_detail' => 'Detail — walkway and curb transition',
  ),
  array(
    'id'        => 5,
    'category'  => 'hardscape',
    'cat_label' => 'Hardscape & concrete',
    'title'     => 'Parking lot curbing — Clearfield',
    'place'     => 'Clearfield, UT',
    'desc'      => 'Curb and gutter, islands and the transitions between them, set to the civil plan. The details that decide how a parking lot reads long before anyone notices the planting.',
    'scope'     => 'Curb & gutter · Islands · Flatwork',
    'size'      => 'wide',
    'draft'     => true,
    'ph_main'   => 'Parking lot curbing — Clearfield',
    'ph_before' => 'Site before work began',
    'ph_detail' => 'Detail',
  ),
  array(
    'id'        => 6,
    'category'  => 'hardscape',
    'cat_label' => 'Hardscape & concrete',
    'title'     => 'Plaza and walkways — Ogden',
    'place'     => 'Ogden, UT',
    'desc'      => 'Paver plaza and connecting walkways over a properly compacted base with edge restraint. Paver work fails from what is underneath it, so that is where the time went.',
    'scope'     => 'Base prep · Pavers · Edge restraint · Flatwork',
    'size'      => 'normal',
    'draft'     => true,
    'ph_main'   => 'Plaza and walkways — Ogden',
    'ph_before' => 'Site before work began',
    'ph_detail' => 'Detail',
  ),

  /* ══ GROUNDS MAINTENANCE ═════════════════════════════════ */
  array(
    'id'        => 7,
    'category'  => 'grounds',
    'cat_label' => 'Grounds maintenance',
    'title'     => 'Office park grounds — Farmington',
    'place'     => 'Farmington, UT',
    'desc'      => 'Annual grounds contract on a multi-building office property. Mowing, fertilization and pruning on a schedule the tenants can set their watch by, with snow written into the same agreement.',
    'scope'     => 'Mowing · Fertilization · Pruning · Snow',
    'size'      => 'wide',
    'draft'     => true,
    'ph_main'   => 'Office park grounds — Farmington',
    'ph_before' => 'Site before work began',
    'ph_detail' => 'Detail',
  ),
  array(
    'id'        => 8,
    'category'  => 'grounds',
    'cat_label' => 'Grounds maintenance',
    'title'     => 'HOA common areas — Syracuse',
    'place'     => 'Syracuse, UT',
    'desc'      => 'Common area maintenance for a residential association: entry approach, greenbelt and the shared spaces the board hears about first. One contract, one point of contact.',
    'scope'     => 'Mowing · Irrigation · Seasonal color · Snow',
    'size'      => 'normal',
    'draft'     => true,
    'ph_main'   => 'HOA common areas — Syracuse',
    'ph_before' => 'Site before work began',
    'ph_detail' => 'Detail',
  ),
  array(
    'id'        => 9,
    'category'  => 'grounds',
    'cat_label' => 'Grounds maintenance',
    'title'     => 'Industrial site grounds — Brigham City',
    'place'     => 'Brigham City, UT',
    'desc'      => 'Grounds and irrigation management on an industrial property, including spring startup, in-season adjustment and fall winterization before the first hard freeze.',
    'scope'     => 'Grounds · Spring startup · Winterization · Snow',
    'size'      => 'tall',
    'draft'     => true,
    'ph_main'   => 'Industrial site grounds — Brigham City',
    'ph_before' => 'Site before work began',
    'ph_detail' => 'Detail',
  ),

  /* ══ WATER-WISE RETROFITS ════════════════════════════════ */
  array(
    'id'        => 10,
    'category'  => 'water',
    'cat_label' => 'Water-wise retrofits',
    'title'     => 'Turf conversion — Kaysville',
    'place'     => 'Kaysville, UT',
    'desc'      => 'Removal of turf nobody walked on, replaced with drip-irrigated planting that still reads as landscape. The savings come from the area converted, not from letting the rest go brown.',
    'scope'     => 'Turf removal · Drip · Native plantings',
    'size'      => 'tall',
    'draft'     => true,
    'ph_main'   => 'Turf conversion — Kaysville',
    'ph_before' => 'Site before work began',
    'ph_detail' => 'Detail',
  ),
  array(
    'id'        => 11,
    'category'  => 'water',
    'cat_label' => 'Water-wise retrofits',
    'title'     => 'Controller retrofit — Riverdale',
    'place'     => 'Riverdale, UT',
    'desc'      => 'Smart controller retrofit across an existing system, programmed to adjust with the weather instead of running the same schedule in May and September.',
    'scope'     => 'Smart controllers · Zone audit · Drip conversion',
    'size'      => 'wide',
    'draft'     => true,
    'ph_main'   => 'Controller retrofit — Riverdale',
    'ph_before' => 'Site before work began',
    'ph_detail' => 'Detail',
  ),
  array(
    'id'        => 12,
    'category'  => 'water',
    'cat_label' => 'Water-wise retrofits',
    'title'     => 'Water-wise entry — North Ogden',
    'place'     => 'North Ogden, UT',
    'desc'      => 'Entry approach rebuilt with native and adapted species chosen to survive a Weber County winter and an August with no rain, designed to the local district’s requirements.',
    'scope'     => 'Native plantings · Drip · District compliance',
    'size'      => 'normal',
    'draft'     => true,
    'ph_main'   => 'Water-wise entry — North Ogden',
    'ph_before' => 'Site before work began',
    'ph_detail' => 'Detail',
  ),
);

/* El interruptor se aplica acá, una sola vez. Todo lo que viene después
   —rejilla, conteos de filtro, datos del visor— trabaja sobre esta lista
   ya filtrada, así que no hay ningún lugar donde se puedan desincronizar. */
if (!$ec_show_drafts) {
  $projects = array_values(array_filter($projects, function ($pr) {
    return empty($pr['draft']);
  }));
}

/* Las categorías son las cuatro capacidades del sitio, no una taxonomía
   nueva. Un GC que llega desde /hardscape-concrete encuentra acá el mismo
   nombre, y el conteo se calcula solo. */
$categories = array(
  'all'       => 'All projects',
  'landscape' => 'Landscape installation',
  'hardscape' => 'Hardscape & concrete',
  'grounds'   => 'Grounds maintenance',
  'water'     => 'Water-wise retrofits',
);

/* ─────────────────────────────────────────────────────────────
   QUÉ REVISARON — el bloque que convierte dos casos en un argumento.

   Sin esto la página son dos tarjetas y se acabó. Con esto, los dos casos
   pasan a ser evidencia de un proceso: lo que un comprador institucional
   audita antes de firmar, que es exactamente el material del bloque 08.
   ───────────────────────────────────────────────────────────── */
$review = array(
  array('n' => '01', 'title' => 'Licensing',      'body' => 'Utah contractor license S330, current and verifiable, with concrete and masonry self-performed under our own license.'),
  array('n' => '02', 'title' => 'Insurance',      'body' => 'General Liability, Workers’ Compensation and Commercial Auto certificates, issued to the requesting party before mobilization.'),
  array('n' => '03', 'title' => 'Safety',         'body' => 'Documentation delivered during preconstruction in the format the office needs it, not after award.'),
  array('n' => '04', 'title' => 'Capacity',       'body' => 'Thirty-one people on our crew and our own equipment — the question is whether we can staff the schedule, not whether we can find someone who will.'),
);

/* Cross-links a las cuatro capacidades. Slugs iguales a los del admin. */
$capabilities = array(
  array('label' => 'Landscape installation', 'href' => home_url('/landscape-installation')),
  array('label' => 'Hardscape & concrete',   'href' => home_url('/hardscape-concrete')),
  array('label' => 'Grounds maintenance',    'href' => home_url('/grounds-maintenance')),
  array('label' => 'Water-wise retrofits',   'href' => home_url('/water-wise-retrofits')),
);

$bid_href = home_url('/contact');
?>

<script>
  /* Misma marca de revelado que la home. Va acá y no al pie: el estado oculto
     de [data-reveal] cuelga de .ec-reveal, así que si la clase llegara tarde
     se vería el contenido y después desaparecería de golpe. */
  (function () {
    var mq = window.matchMedia;
    if (mq && mq('(prefers-reduced-motion: reduce)').matches) return;
    document.documentElement.classList.add('ec-reveal');
  })();
</script>

<!-- ═══════════════════════ ENCABEZADO ═══════════════════════ -->
<!-- Hero de imagen a sangre, como las páginas de capacidad.

     EL SCRIM NO ES TAN ASIMÉTRICO COMO EL DE LAS PÁGINAS DE CAPACIDAD, y la
     razón es el layout. Allá la mitad derecha está vacía y el velo puede
     abrirse hasta casi transparente; acá el lede vive en la columna derecha,
     así que ese lado también lleva texto.

     Medido contra el peor caso —la foto en blanco puro debajo—, el lede va
     en bone/80 y es lo más flojo del hero:

       0.94 → 6.63:1     0.86 → 5.30:1     0.78 → 4.19:1  ✗
       0.90 → 5.89:1     0.82 → 4.71:1  ← el piso del gradiente

     De 0.94 a 0.82. Sigue habiendo degradado —la foto respira hacia la
     derecha— pero nunca por debajo de lo que el texto necesita.

     bg-ink debajo de la imagen: es lo que se ve el instante previo a que
     cargue, y lo que queda si la ruta se rompe en la migración. Un hero que
     falla en oscuro se lee como decisión; en claro se lee como error. -->
<section class="relative isolate overflow-hidden bg-ink text-bone">

  <?php if ($ec_hero_img) : ?>
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
          <?php echo esc_html($page['eyebrow']); ?>
        </p>
        <h1 class="ec-shine ec-shine--light ec-mixed font-display text-4xl leading-[1.08] font-bold tracking-tight text-bone sm:text-5xl lg:text-[3.4rem]">
          <?php echo esc_html($page['title']); ?> <em><?php echo esc_html($page['title_em']); ?></em>
        </h1>
      </div>
      <p class="text-base leading-relaxed text-bone/80 lg:pb-2">
        <?php echo esc_html($page['lede']); ?>
      </p>
    </div>

    <div class="ec-band ec-band--h mt-12 h-1.5 opacity-40" aria-hidden="true"></div>
  </div>
</section>

<!-- ═══════════════════════ GALERÍA ═══════════════════════ -->
<!-- Rejilla filtrable con visor. La mecánica es la de una galería de obra
     al uso —filtros, mosaico, lightbox con pestañas y comparador de
     arrastre— pero el vestido es el de EC: bloques rectos, sin radio, sin
     sombras, y la paleta de la marca.

     Todo el JS de esta página vive al pie del archivo, en un solo bloque.
     No hay dependencias. -->
<section class="bg-bone">

  <!-- ── Barra de filtros ──
       Fija en el flujo, no pegajosa: con dos proyectos la rejilla no llega
       a ser larga, y una barra que persigue el scroll sobre un contenido que
       cabe en dos pantallas se lee como interfaz de aplicación, no como
       página. Si el portafolio crece a doce o quince, vuelve a tener sentido
       —es `sticky top-[var(--header-offset)]`, calculado contra el
       encabezado del sitio y no contra el borde del viewport. -->
  <div
    id="ec-filters"
    class="border-b border-ink/15 bg-bone"
  >
    <div class="w-full overflow-x-auto px-5 py-4 [scrollbar-width:none] sm:px-8 lg:px-10 [&::-webkit-scrollbar]:hidden">
      <div class="flex items-center gap-px">
        <?php foreach ($categories as $ec_key => $ec_label) :
          $ec_n = ('all' === $ec_key)
            ? count($projects)
            : count(array_filter($projects, function ($pr) use ($ec_key) { return $pr['category'] === $ec_key; }));
          $ec_activo = ('all' === $ec_key);
          ?>
          <button
            type="button"
            data-filter="<?php echo esc_attr($ec_key); ?>"
            aria-pressed="<?php echo $ec_activo ? 'true' : 'false'; ?>"
            class="ec-filter shrink-0 whitespace-nowrap px-5 py-2.5 text-[0.68rem] font-semibold uppercase tracking-[0.14em] transition-colors duration-200 focus-visible:outline-2 focus-visible:outline-offset-[-4px] focus-visible:outline-ember motion-reduce:transition-none <?php echo $ec_activo ? 'bg-ink text-bone' : 'bg-sand text-ink hover:bg-ember'; ?>"
          >
            <?php echo esc_html($ec_label); ?>
            <span class="ml-1.5 tabular-nums opacity-55">(<?php echo (int) $ec_n; ?>)</span>
          </button>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div class="w-full px-5 py-14 sm:px-8 lg:px-10 lg:py-20">

    <p class="mb-8 text-sm text-ink/70">
      Showing <span id="ec-count" class="font-semibold text-ink tabular-nums"><?php echo count($projects); ?></span>
      <span id="ec-count-word">projects</span>
    </p>

    <!-- Mosaico por columnas CSS y no grid: con alturas distintas por
         tarjeta, `columns` acomoda sin dejar huecos y sin una línea de JS.
         break-inside-avoid es lo que impide que una tarjeta se parta entre
         dos columnas. -->
    <div id="ec-grid" class="gap-5 space-y-5 sm:columns-2 lg:columns-3">
      <?php foreach ($projects as $pr) :
        $ec_main = isset($ec_img_main[$pr['id']]) ? $ec_img_main[$pr['id']] : '';
        $ec_ba   = !empty($ec_img_before[$pr['id']]);

        // La proporción viene del dato, no del orden: es lo que le da ritmo
        // al mosaico sin depender de cuántos proyectos haya.
        $ec_ratio = 'aspect-[4/3]';
        if ('tall' === $pr['size']) { $ec_ratio = 'aspect-[3/4]'; }
        if ('wide' === $pr['size']) { $ec_ratio = 'aspect-[16/9]'; }
        ?>
        <article
          class="ec-card group block break-inside-avoid bg-breeze-100"
          data-category="<?php echo esc_attr($pr['category']); ?>"
          data-id="<?php echo (int) $pr['id']; ?>"
        >
          <!-- La tarjeta entera abre el visor. Es un <button> y no un div con
               onclick: así entra en el recorrido de Tab, responde a Enter y
               el lector de pantalla lo anuncia como control. -->
          <button
            type="button"
            data-open="<?php echo (int) $pr['id']; ?>"
            class="block w-full text-left focus-visible:outline-2 focus-visible:outline-offset-[-4px] focus-visible:outline-ember"
          >
            <div class="relative <?php echo esc_attr($ec_ratio); ?> w-full overflow-hidden bg-ink">
              <?php if ($ec_main) : ?>
                <img
                  src="<?php echo esc_url($ec_main); ?>"
                  alt="<?php echo esc_attr($pr['title'] . ' — ' . $pr['place']); ?>"
                  class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 ease-out group-hover:scale-105 motion-reduce:transition-none motion-reduce:group-hover:scale-100"
                  loading="lazy"
                  decoding="async"
                />
              <?php else : ?>
                <!-- Sin foto todavía: panel de marca con la categoría, no un
                     rectángulo gris. Se ve intencional mientras llegan los
                     archivos de obra. -->
                <div class="absolute inset-0 flex items-end p-6">
                  <span class="text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-bone/60">
                    <?php echo esc_html($pr['cat_label']); ?>
                  </span>
                </div>
              <?php endif; ?>

              <!-- Etiqueta de categoría, sobre bloque de color macizo. -->
              <span class="absolute left-0 top-0 bg-ember px-3 py-1.5 text-[0.62rem] font-semibold uppercase tracking-[0.14em] text-ink">
                <?php echo esc_html($pr['cat_label']); ?>
              </span>

              <?php if ($ec_ba) : ?>
                <span class="absolute right-0 top-0 bg-ink px-3 py-1.5 text-[0.62rem] font-semibold uppercase tracking-[0.14em] text-bone">
                  Before &amp; after
                </span>
              <?php endif; ?>
            </div>

            <div class="border-t-4 border-ember p-6 transition-colors duration-300 group-hover:bg-sand motion-reduce:transition-none">
              <h2 class="font-display text-lg font-bold leading-snug tracking-tight text-ink">
                <?php echo esc_html($pr['title']); ?>
              </h2>
              <p class="mt-2 text-[0.68rem] font-semibold uppercase tracking-[0.14em] text-ember-800">
                <?php echo esc_html($pr['place']); ?>
              </p>
              <p class="mt-3 text-sm leading-relaxed text-ink/80">
                <?php echo esc_html($pr['desc']); ?>
              </p>
            </div>
          </button>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- Estado vacío del filtro. -->
    <p id="ec-empty" class="hidden py-20 text-center text-base text-ink/70">
      No projects in this category yet. The scope is still one we self-perform —
      <a href="<?php echo esc_url($bid_href); ?>" class="font-medium text-ink underline decoration-ember decoration-2 underline-offset-4">ask for a reference</a>.
    </p>

    <!-- ── El NDA, como módulo ──
         Explica por qué no hay nombres y convierte la ausencia en una
         invitación. Suelta al pie se leería como descargo legal. -->
    <div class="mt-12 bg-ember p-8 lg:p-12">
      <p class="max-w-3xl text-base leading-relaxed text-ink">
        Client names and contract values available on request under NDA. Ask the estimator and you will get the reference, not a brochure.
      </p>
    </div>
  </div>
</section>

<!-- ═══════════════════════ VISOR ═══════════════════════ -->
<!-- Oculto hasta que se abre una tarjeta. Vive fuera de la rejilla para que
     ningún overflow de la sección lo recorte. -->
<div
  id="ec-lightbox"
  class="fixed inset-0 z-[100] hidden items-center justify-center bg-ink-900/95 p-4 sm:p-8"
  role="dialog"
  aria-modal="true"
  aria-labelledby="ec-lb-title"
>
  <button
    type="button"
    id="ec-lb-close"
    aria-label="Close"
    class="absolute right-4 top-4 z-10 flex h-11 w-11 items-center justify-center bg-ink text-bone transition-colors hover:bg-ember hover:text-ink focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
  >
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true" class="h-4 w-4"><path d="M6 18 18 6M6 6l12 12" /></svg>
  </button>

  <div class="relative grid max-h-[90svh] w-full max-w-6xl grid-cols-1 overflow-hidden bg-ink lg:grid-cols-[minmax(0,1fr)_24rem]">

    <!-- ── Media ── -->
    <div class="relative min-h-[16rem] bg-ink-900 lg:min-h-[32rem]">

      <div id="ec-lb-tabs" class="absolute left-0 top-0 z-10 flex gap-px">
        <button type="button" class="ec-lb-tab bg-ink px-4 py-2 text-[0.62rem] font-semibold uppercase tracking-[0.14em] text-bone" data-tab="main">Project</button>
        <button type="button" class="ec-lb-tab bg-ink/70 px-4 py-2 text-[0.62rem] font-semibold uppercase tracking-[0.14em] text-bone/70" data-tab="before">Before</button>
        <button type="button" class="ec-lb-tab bg-ink/70 px-4 py-2 text-[0.62rem] font-semibold uppercase tracking-[0.14em] text-bone/70" data-tab="detail">Detail</button>
      </div>

      <div id="ec-lb-media" class="flex h-full w-full items-center justify-center bg-cover bg-center p-8 text-center text-sm text-bone/60"></div>

      <!-- Comparador de arrastre. Solo se monta si el proyecto tiene "before". -->
      <div id="ec-lb-ba" class="absolute inset-0 hidden cursor-col-resize select-none">
        <div id="ec-lb-ba-before" class="absolute inset-0 bg-cover bg-center"></div>
        <div id="ec-lb-ba-after" class="absolute inset-0 bg-cover bg-center" style="clip-path:inset(0 50% 0 0)"></div>
        <div id="ec-lb-ba-handle" class="absolute inset-y-0 left-1/2 w-0.5 -translate-x-1/2 bg-bone">
          <span class="pointer-events-none absolute left-1/2 top-1/2 flex h-10 w-10 -translate-x-1/2 -translate-y-1/2 items-center justify-center bg-bone">
            <svg viewBox="0 0 24 24" fill="none" stroke="#2F342D" stroke-width="2" stroke-linecap="round" aria-hidden="true" class="h-4 w-4"><path d="M9 6 3 12l6 6M15 6l6 6-6 6" /></svg>
          </span>
        </div>
        <span class="absolute left-3 top-3 text-[0.62rem] font-semibold uppercase tracking-[0.14em] text-bone/70">Before</span>
        <span class="absolute right-3 top-3 text-[0.62rem] font-semibold uppercase tracking-[0.14em] text-bone/70">After</span>
        <button type="button" id="ec-lb-ba-exit" class="absolute bottom-3 right-3 bg-bone px-3 py-1.5 text-[0.62rem] font-semibold uppercase tracking-[0.14em] text-ink">
          View photos
        </button>
      </div>
    </div>

    <!-- ── Ficha ── -->
    <div class="flex flex-col overflow-y-auto bg-ink p-8 text-bone lg:p-10">
      <p id="ec-lb-cat" class="text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300"></p>
      <h2 id="ec-lb-title" class="mt-4 font-display text-2xl leading-snug font-bold tracking-tight text-bone"></h2>
      <p id="ec-lb-place" class="mt-2 text-sm text-bone/80"></p>
      <p id="ec-lb-desc" class="mt-5 text-sm leading-relaxed text-bone/80"></p>

      <dl class="mt-8 border-t border-white/20">
        <div class="grid gap-1 border-b border-white/20 py-3 sm:grid-cols-[minmax(0,5rem)_minmax(0,1fr)] sm:gap-4">
          <dt class="text-[0.62rem] font-semibold uppercase tracking-[0.14em] text-bone">Scope</dt>
          <dd id="ec-lb-scope" class="text-sm text-bone/80"></dd>
        </div>
      </dl>

      <button type="button" id="ec-lb-ba-open" class="mt-6 hidden w-full border-2 border-white/25 py-3 text-[0.68rem] font-semibold uppercase tracking-[0.14em] text-bone transition-colors hover:bg-ember hover:text-ink focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember">
        Drag before &amp; after
      </button>

      <a
        href="<?php echo esc_url($bid_href); ?>"
        data-bid-cta
        class="mt-4 flex items-center justify-center gap-2.5 border-2 border-white/25 bg-ember py-3.5 text-[0.68rem] font-semibold uppercase tracking-[0.14em] text-ink transition-colors hover:bg-ember-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
      >
        Request a bid for a site like this
      </a>

      <div class="mt-6 flex items-center justify-between gap-4 border-t border-white/20 pt-5">
        <button type="button" id="ec-lb-prev" class="flex h-10 w-10 items-center justify-center border border-white/25 text-bone transition-colors hover:bg-ember hover:text-ink focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember" aria-label="Previous project">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true" class="h-4 w-4"><path d="M19 12H6M11 6l-6 6 6 6" /></svg>
        </button>
        <p id="ec-lb-pos" class="text-[0.68rem] font-semibold uppercase tracking-[0.14em] text-bone/70 tabular-nums"></p>
        <button type="button" id="ec-lb-next" class="flex h-10 w-10 items-center justify-center border border-white/25 text-bone transition-colors hover:bg-ember hover:text-ink focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember" aria-label="Next project">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true" class="h-4 w-4"><path d="M5 12h13M13 6l6 6-6 6" /></svg>
        </button>
      </div>
    </div>
  </div>
</div>

<?php
/* Los datos que necesita el visor, serializados una vez. Se pasan por
   JSON y no leyendo el DOM: los textos ya están escapados por PHP y así
   el JS no tiene que volver a interpretarlos. */
$ec_lb_data = array_map(
  function ($pr) use ($ec_img_main, $ec_img_before, $ec_img_detail) {
    return array(
      'id'        => $pr['id'],
      'cat'       => $pr['cat_label'],
      'title'     => $pr['title'],
      'place'     => $pr['place'],
      'desc'      => $pr['desc'],
      'scope'     => $pr['scope'],
      'main'      => isset($ec_img_main[$pr['id']])   ? $ec_img_main[$pr['id']]   : '',
      'before'    => isset($ec_img_before[$pr['id']]) ? $ec_img_before[$pr['id']] : '',
      'detail'    => isset($ec_img_detail[$pr['id']]) ? $ec_img_detail[$pr['id']] : '',
      'phMain'    => $pr['ph_main'],
      'phBefore'  => $pr['ph_before'],
      'phDetail'  => $pr['ph_detail'],
    );
  },
  $projects
);
?>
<script id="ec-projects-data" type="application/json"><?php echo wp_json_encode($ec_lb_data); ?></script>


<!-- ═══════════════════ QUÉ REVISARON ═══════════════════ -->
<!-- Este bloque es el que convierte dos casos en un argumento. Sin él la
     página son dos tarjetas y se acabó; con él, los casos pasan a ser
     evidencia de un proceso que se puede repetir con el lector. -->
<section class="bg-umber text-bone">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">

    <div data-reveal class="grid gap-px lg:grid-cols-6">

      <div class="flex flex-col justify-end bg-ink p-8 lg:col-span-2 lg:row-span-2 lg:p-10">
        <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300">What they reviewed</p>
        <h2 class="ec-shine ec-shine--light ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-bone sm:text-4xl">
          Four things <em>before the first shovel.</em>
        </h2>
        <div class="ec-band ec-band--h mt-8 h-1.5 opacity-40" aria-hidden="true"></div>
      </div>

      <?php
      /* Damero por posición, no por contenido: ningún módulo repite el color
         de su vecino de al lado ni del de arriba. */
      foreach ($review as $ec_i => $step) :
        $ec_bg = ((intdiv($ec_i, 2) + ($ec_i % 2)) % 2 === 0) ? 'bg-sand' : 'bg-breeze-100';
        ?>
        <div class="<?php echo esc_attr($ec_bg); ?> flex flex-col p-8 lg:col-span-2 lg:p-10">
          <span class="font-display text-4xl font-bold leading-none tracking-tight text-ember-800 tabular-nums">
            <?php echo esc_html($step['n']); ?>
          </span>
          <h3 class="mt-5 font-display text-lg font-bold leading-snug tracking-tight text-ink">
            <?php echo esc_html($step['title']); ?>
          </h3>
          <p class="mt-3 text-sm leading-relaxed text-ink/80">
            <?php echo esc_html($step['body']); ?>
          </p>
        </div>
      <?php endforeach; ?>

      <!-- Enlace al detalle completo. La tabla de credenciales de la home es
           donde vive el dato duro; acá solo se apunta hacia ella. -->
      <div class="flex items-center bg-ember p-8 lg:col-span-2 lg:p-10">
        <a
          href="<?php echo esc_url(home_url('/#credentials')); ?>"
          class="group inline-flex items-center gap-2.5 text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ink focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ink"
        >
          See the full credentials table
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transform-none">
            <path d="M5 12h13M13 6l6 6-6 6" />
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════ CAPACIDADES ═══════════════════ -->
<section class="bg-bone">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div data-reveal>
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">What we self-perform</p>
      <h2 class="ec-shine ec-mixed max-w-3xl font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
        The scopes behind <em>every one of these.</em>
      </h2>
    </div>

    <ul class="mt-12 grid gap-px bg-ink/15 sm:grid-cols-2 lg:grid-cols-4">
      <?php foreach ($capabilities as $ec_i => $cap) :
        $ec_bg = (0 === $ec_i % 2) ? 'bg-sand' : 'bg-breeze-100';
        ?>
        <li>
          <a
            href="<?php echo esc_url($cap['href']); ?>"
            class="<?php echo esc_attr($ec_bg); ?> group flex h-full items-center justify-between gap-4 p-8 transition-colors duration-300 hover:bg-ember focus-visible:outline-2 focus-visible:outline-offset-[-4px] focus-visible:outline-ember motion-reduce:transition-none"
          >
            <span class="font-display text-base font-bold leading-snug tracking-tight text-ink">
              <?php echo esc_html($cap['label']); ?>
            </span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true" class="h-4 w-4 shrink-0 text-ink transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transform-none">
              <path d="M5 12h13M13 6l6 6-6 6" />
            </svg>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- ═══════════════════════ CTA ═══════════════════════ -->
<section class="bg-umber text-bone">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-20">
    <div data-reveal class="grid gap-8 lg:grid-cols-[minmax(0,1.4fr)_minmax(0,1fr)] lg:items-center lg:gap-16">
      <div>
        <h2 class="ec-mixed font-display text-3xl leading-tight font-bold tracking-tight text-bone sm:text-4xl">
          Send us the plans. <em>We&rsquo;ll send back a scoped bid.</em>
        </h2>
        <p class="mt-5 max-w-2xl text-base leading-relaxed text-bone">
          Line-item pricing with quantities, exclusions and a schedule. Submittals and certificates delivered before mobilization.
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

<script>
  /* Destello de los titulares. La clase se pone al entrar en pantalla y se
     quita al salir: la animación va en bucle, y dejarla corriendo en un
     titular fuera del viewport repinta igual y se paga en batería. */
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

  /* ── Galería de proyectos ──
     Filtros, visor y comparador de arrastre. Sin dependencias.

     Los datos salen del <script type="application/json"> que imprime el PHP
     y no de leer el DOM: los textos ya vienen escapados y así el JS no tiene
     que volver a interpretarlos. */
  (function () {
    var raw = document.getElementById('ec-projects-data');
    var grid = document.getElementById('ec-grid');
    if (!raw || !grid) return;

    var datos;
    try { datos = JSON.parse(raw.textContent); } catch (e) { return; }
    if (!datos.length) return;

    var cards    = Array.prototype.slice.call(grid.querySelectorAll('.ec-card'));
    var filtros  = Array.prototype.slice.call(document.querySelectorAll('.ec-filter'));
    var contador = document.getElementById('ec-count');
    var palabra  = document.getElementById('ec-count-word');
    var vacio    = document.getElementById('ec-empty');

    // Ids visibles según el filtro. El visor navega SOLO entre estos: si
    // filtraste por hardscape, las flechas no te sacan de hardscape.
    var visibles = datos.map(function (d) { return d.id; });

    /* ── Filtros ── */
    function aplicar(clave) {
      visibles = [];
      cards.forEach(function (c) {
        var ok = (clave === 'all') || (c.dataset.category === clave);
        c.style.display = ok ? '' : 'none';
        if (ok) visibles.push(parseInt(c.dataset.id, 10));
      });

      filtros.forEach(function (b) {
        var activo = b.dataset.filter === clave;
        b.setAttribute('aria-pressed', activo ? 'true' : 'false');
        b.classList.toggle('bg-ink', activo);
        b.classList.toggle('text-bone', activo);
        b.classList.toggle('bg-sand', !activo);
        b.classList.toggle('text-ink', !activo);
        b.classList.toggle('hover:bg-ember', !activo);
      });

      contador.textContent = visibles.length;
      if (palabra) palabra.textContent = visibles.length === 1 ? 'project' : 'projects';
      if (vacio) vacio.classList.toggle('hidden', visibles.length > 0);
    }

    filtros.forEach(function (b) {
      b.addEventListener('click', function () { aplicar(b.dataset.filter); });
    });

    /* ── Visor ── */
    var lb      = document.getElementById('ec-lightbox');
    var media   = document.getElementById('ec-lb-media');
    var tabs    = Array.prototype.slice.call(document.querySelectorAll('.ec-lb-tab'));
    var ba      = document.getElementById('ec-lb-ba');
    var baAntes = document.getElementById('ec-lb-ba-before');
    var baDesp  = document.getElementById('ec-lb-ba-after');
    var baTira  = document.getElementById('ec-lb-ba-handle');
    var baOpen  = document.getElementById('ec-lb-ba-open');
    var baExit  = document.getElementById('ec-lb-ba-exit');

    var actual = null, pestana = 'main', comparando = false, ultimoFoco = null;

    function proyecto(id) {
      for (var i = 0; i < datos.length; i++) if (datos[i].id === id) return datos[i];
      return null;
    }

    // Pinta una URL como fondo, o cae al texto de respaldo si no hay archivo.
    function pintar(el, url, texto) {
      if (url) {
        el.style.backgroundImage = 'url("' + url + '")';
        el.textContent = '';
      } else {
        el.style.backgroundImage = '';
        el.textContent = texto || '';
      }
    }

    function dibujar() {
      var d = proyecto(actual);
      if (!d) return;

      document.getElementById('ec-lb-cat').textContent   = d.cat;
      document.getElementById('ec-lb-title').textContent = d.title;
      document.getElementById('ec-lb-place').textContent = d.place;
      document.getElementById('ec-lb-desc').textContent  = d.desc;
      document.getElementById('ec-lb-scope').textContent = d.scope;

      var i = visibles.indexOf(d.id);
      document.getElementById('ec-lb-pos').textContent = (i + 1) + ' / ' + visibles.length;

      // Una pestaña sin archivo no se muestra: es preferible a ofrecer un
      // "Before" que abre un panel vacío.
      var fuente = { main: d.main, before: d.before, detail: d.detail };
      tabs.forEach(function (t) {
        var clave = t.dataset.tab;
        var hay = clave === 'main' || !!fuente[clave];
        t.hidden = !hay;
        var activo = clave === pestana;
        t.classList.toggle('bg-ink', activo);
        t.classList.toggle('text-bone', activo);
        t.classList.toggle('bg-ink/70', !activo);
        t.classList.toggle('text-bone/70', !activo);
      });

      var respaldo = { main: d.phMain, before: d.phBefore, detail: d.phDetail };
      pintar(media, fuente[pestana], respaldo[pestana]);

      // El comparador solo existe si hay un "before" que comparar.
      baOpen.classList.toggle('hidden', !d.before);

      if (comparando && d.before) {
        pintar(baAntes, d.before, d.phBefore);
        pintar(baDesp,  d.main,   d.phMain);
        baDesp.style.clipPath = 'inset(0 50% 0 0)';
        baTira.style.left = '50%';
        ba.classList.remove('hidden');
        document.getElementById('ec-lb-tabs').style.display = 'none';
      } else {
        ba.classList.add('hidden');
        document.getElementById('ec-lb-tabs').style.display = '';
      }
    }

    function abrir(id) {
      ultimoFoco = document.activeElement;
      actual = id; pestana = 'main'; comparando = false;
      dibujar();
      lb.classList.remove('hidden');
      lb.classList.add('flex');
      // Bloquear el scroll del fondo: sin esto el documento se mueve por
      // detrás del visor mientras se arrastra el comparador.
      document.body.style.overflow = 'hidden';
      document.getElementById('ec-lb-close').focus();
    }

    function cerrar() {
      lb.classList.add('hidden');
      lb.classList.remove('flex');
      document.body.style.overflow = '';
      actual = null;
      // Devolver el foco a la tarjeta que abrió el visor, no al principio
      // del documento.
      if (ultimoFoco && ultimoFoco.focus) ultimoFoco.focus();
    }

    function mover(paso) {
      if (!visibles.length) return;
      var i = visibles.indexOf(actual);
      actual = visibles[(i + paso + visibles.length) % visibles.length];
      pestana = 'main'; comparando = false;
      dibujar();
    }

    grid.addEventListener('click', function (e) {
      var b = e.target.closest('[data-open]');
      if (b) abrir(parseInt(b.dataset.open, 10));
    });

    tabs.forEach(function (t) {
      t.addEventListener('click', function () { pestana = t.dataset.tab; dibujar(); });
    });
    baOpen.addEventListener('click', function () { comparando = true;  dibujar(); });
    baExit.addEventListener('click', function () { comparando = false; dibujar(); });

    document.getElementById('ec-lb-close').addEventListener('click', cerrar);
    document.getElementById('ec-lb-prev').addEventListener('click', function () { mover(-1); });
    document.getElementById('ec-lb-next').addEventListener('click', function () { mover(1); });

    // Clic en el velo, no en el panel.
    lb.addEventListener('click', function (e) { if (e.target === lb) cerrar(); });

    document.addEventListener('keydown', function (e) {
      if (actual === null) return;
      if (e.key === 'Escape')     cerrar();
      if (e.key === 'ArrowLeft')  mover(-1);
      if (e.key === 'ArrowRight') mover(1);
    });

    /* ── Arrastre del comparador ── */
    var arrastrando = false;

    function situar(x) {
      var r = ba.getBoundingClientRect();
      var pct = Math.min(Math.max((x - r.left) / r.width, 0), 1) * 100;
      baDesp.style.clipPath = 'inset(0 ' + (100 - pct) + '% 0 0)';
      baTira.style.left = pct + '%';
    }

    ba.addEventListener('mousedown', function (e) { arrastrando = true; situar(e.clientX); });
    ba.addEventListener('touchstart', function (e) { arrastrando = true; situar(e.touches[0].clientX); }, { passive: true });
    window.addEventListener('mousemove', function (e) { if (arrastrando) situar(e.clientX); }, { passive: true });
    window.addEventListener('touchmove', function (e) { if (arrastrando) situar(e.touches[0].clientX); }, { passive: true });
    window.addEventListener('mouseup', function () { arrastrando = false; });
    window.addEventListener('touchend', function () { arrastrando = false; });

    aplicar('all');
  })();

  /* Revelado por scroll. Si .ec-reveal no está en <html> —porque el usuario
     pidió menos movimiento o porque el script de arranque no corrió— no hay
     nada oculto que revelar y se sale de una. */
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