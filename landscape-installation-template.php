<?php
/**
 * Template Name: Capacidad · Landscape Installation
 *
 * Página de capacidad. Slug esperado: /landscape-installation
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

$ec_title = 'Commercial landscape installation';
$ec_lede  = 'New construction, retail pads, branch sites, multifamily and industrial. Grading and soil preparation, irrigation mains and zones, planting, sod, trees and final grade to plan.';
$ec_image = $ec_media . 'CommercialLandscapeInstallation-scaled.webp';
$ec_alt   = 'Commercial landscape installation in progress on a Northern Utah site';

$ec_scope = array(
  'New construction, retail pads and branch sites',
  'Multifamily and industrial sites',
  'Grading and soil preparation',
  'Irrigation mains and zones',
  'Planting, sod and trees',
  'Final grade to plan',
);

$ec_built_for = array(
  'General contractors & developers',
  'Institutional & multi-site owners',
  'C-stores, credit unions & retail chains',
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
  array('slug' => 'hardscape-concrete', 'title' => 'Hardscape & concrete'),
  array('slug' => 'grounds-maintenance', 'title' => 'Grounds maintenance, irrigation & snow'),
  array('slug' => 'water-wise-retrofits', 'title' => 'Water-wise retrofits'),
);

$ec_bid_href = home_url('/contact');
$ec_tel_href = 'tel:+13852403907';
?>

<!-- ═══════════════════════ HERO ═══════════════════════ -->
<section class="bg-bone">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="grid gap-12 lg:grid-cols-2 lg:items-center lg:gap-16">

      <div>
        <!-- Salida al índice. Dos niveles no justifican markup de navegación,
             pero sí hace falta la vuelta para quien llega desde una búsqueda. -->
        <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">
          <a href="<?php echo esc_url(home_url('/capabilities')); ?>" class="transition-colors hover:text-ink">Capabilities</a>
        </p>

        <h1 class="ec-shine font-display text-4xl leading-[1.08] font-bold tracking-tight text-ink sm:text-5xl">
          <?php echo esc_html($ec_title); ?>
        </h1>

        <p class="mt-6 text-lg leading-relaxed text-ink/70">
          <?php echo esc_html($ec_lede); ?>
        </p>

        <div class="mt-9">
          <a
            href="<?php echo esc_url($ec_bid_href); ?>"
            data-bid-cta
            class="cta-relief-light group inline-flex items-center gap-2.5 rounded-full border-2 border-white/60 bg-ember py-4 pl-7 pr-6 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink transition-all duration-200 ease-out hover:cta-relief-light-tight hover:bg-ember-600 hover:-translate-y-px active:translate-y-0 active:shadow-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember motion-reduce:transform-none motion-reduce:transition-none"
          >
            Request a bid
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transform-none">
              <path d="M5 12h13M13 6l6 6-6 6" />
            </svg>
          </a>
        </div>
      </div>

      <div class="overflow-hidden rounded-lg ring-1 ring-ink/10">
        <img
          src="<?php echo esc_url($ec_image); ?>"
          alt="<?php echo esc_attr($ec_alt); ?>"
          class="aspect-[4/3] w-full object-cover"
          loading="eager"
          decoding="async"
        />
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════ ALCANCE ═══════════════════════ -->
<section class="bg-white">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-24">
    <div class="grid gap-12 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.4fr)] lg:gap-16">
      <div>
        <h2 class="ec-shine font-display text-3xl leading-tight font-bold tracking-tight text-ink sm:text-4xl">
          What&rsquo;s in scope.
        </h2>
        <p class="mt-5 text-base leading-relaxed text-ink/70">
          Self-performed with our own crew and our own equipment.
        </p>
      </div>

      <ul class="grid gap-px self-start bg-ink/10 sm:grid-cols-2">
        <?php foreach ($ec_scope as $item) : ?>
          <li class="flex items-start gap-3 bg-white px-6 py-5">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="mt-0.5 h-4 w-4 shrink-0 text-ember">
              <path d="m5 13 4 4L19 7" />
            </svg>
            <span class="text-sm leading-relaxed text-ink"><?php echo esc_html($item); ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- ═══════════════════════ PARA QUIÉN ═══════════════════════ -->
<section class="bg-bone">
  <div class="w-full px-5 py-14 sm:px-8 lg:px-10 lg:py-16">
    <h2 class="mb-6 text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ink/50">Built for</h2>
    <ul class="flex flex-wrap gap-2">
      <?php foreach ($ec_built_for as $buyer) : ?>
        <li class="rounded-full border border-ink/15 bg-white px-4 py-2 text-sm text-ink">
          <?php echo esc_html($buyer); ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

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

<!-- ═══════════════ OTRAS CAPACIDADES ═══════════════ -->
<section class="bg-bone">
  <div class="w-full px-5 py-16 sm:px-8 lg:px-10 lg:py-20">
    <h2 class="mb-8 text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ink/50">Also self-performed</h2>
    <ul class="grid gap-px bg-ink/10 sm:grid-cols-3">
      <?php foreach ($ec_others as $other) : ?>
        <li class="bg-bone">
          <a
            href="<?php echo esc_url(home_url('/' . $other['slug'])); ?>"
            class="group flex h-full flex-col p-7 transition-colors hover:bg-white focus-visible:outline-2 focus-visible:outline-offset-[-2px] focus-visible:outline-ember"
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

<?php
/* Contenido del editor, si la página tiene algo escrito. Permite agregar texto
   a esta capacidad sin tocar la plantilla. */
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