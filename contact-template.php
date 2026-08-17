<?php
/**
 * Template Name: Contacto
 *
 * Página de contacto. El formulario es el mismo componente que el hero y el
 * modal: variant="inline", permanente y en densidad cómoda. Sin umbral —
 * acá la página es suya y no compite con un titular.
 *
 * A diferencia de la landing, esta plantilla no lleva la clase de hero
 * inmersivo, así que el body conserva su padding-top y el contenido arranca
 * por debajo del header.
 */

get_header();

/* El NAP se repite en header.php, footer.php y el schema de la landing. Es la
   cuarta copia, y eso es un problema conocido: la referencia contra la que se
   auditan las citations es el footer, así que cualquier corrección tiene que
   replicarse aquí. Cuando salgan los partials, esto debería venir de una sola
   función. */
$ec_nap = array(
  'legalName' => 'EC Landscaping LLC',
  'street'    => '3754 N Higley Rd, Suite 2',
  'cityState' => 'Ogden, UT 84404',
  'phone'     => '(385) 240-3907',
  'email'     => 'info@ecscaping.com',
  'license'   => 'Utah License 1106462255001 · S330',
  'counties'  => 'Weber, Davis, Morgan and Box Elder counties',
);

$ec_map_query = '3754 N Higley Rd Suite 2, Ogden, UT 84404';
$ec_map_embed = 'https://www.google.com/maps?q=' . rawurlencode($ec_map_query) . '&output=embed';
$ec_map_href  = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($ec_map_query);
$ec_tel_href  = 'tel:+1' . preg_replace('/\D/', '', $ec_nap['phone']);

/* Lo que pasa después de enviar. Es la información que más baja la fricción
   de un formulario y la que casi ningún contratista publica: quién responde,
   en cuánto tiempo y qué sigue. */
$ec_what_happens = array(
  array(
    'n'     => '1',
    'title' => 'Same-day confirmation',
    'body'  => 'You get a reply confirming we received the plans and who is picking them up.',
  ),
  array(
    'n'     => '2',
    'title' => 'Site walkthrough',
    'body'  => 'Usually within the week. We review the plans and confirm scope with your PM or superintendent before we price anything.',
  ),
  array(
    'n'     => '3',
    'title' => 'Scoped bid',
    'body'  => 'A line-item proposal with quantities, exclusions and a schedule — plus certificates and W-9 if you need them with the bid.',
  ),
);
?>

<section class="bg-bone">
  <!-- La primera sección reserva el alto del header. El header es fixed:
       flota encima de la página en lugar de empujarla, así que si esta
       sección no le hace sitio, su propio titular queda debajo de la barra.

       La landing no necesita esto porque su hero ya lo hace —pasa por detrás
       del header a propósito—, pero cada plantilla interior tiene que
       resolverlo por su cuenta.

       No se hace con padding en el <body> desde el CSS: eso se aplicaría
       también a la landing y le metería el hero 9rem para abajo. -->
  <div class="w-full px-5 pb-16 pt-[calc(var(--header-offset)+2rem)] sm:px-8 lg:px-10 lg:pb-24 lg:pt-[calc(var(--header-offset)+3rem)]">

    <!-- ═══════════════ Encabezado ═══════════════ -->
    <div class="max-w-3xl">
      <p class="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-forest">Contact</p>
      <h1 class="ec-shine font-display text-4xl leading-[1.08] font-bold tracking-tight text-ink sm:text-5xl">
        Send us the plans.
      </h1>
      <p class="mt-6 max-w-2xl text-lg leading-relaxed text-ink/70">
        Tell us the site, the scope and the date. You’ll hear back from the owner or the estimator — not a call center.
      </p>
    </div>

    <!-- ═══════════════ Formulario + datos ═══════════════ -->
    <div class="mt-14 grid gap-12 lg:grid-cols-[minmax(0,1.3fr)_minmax(0,1fr)] lg:gap-16">

      <?php
      /**
       * Mismo componente que el hero y el modal.
       *
       * persistent sin inlineMinWidth: acá no hay umbral que cruzar, así que
       * nunca cae a modal. Un modal en la página de contacto sería absurdo —
       * la página ES el formulario.
       *
       * El trigger es el mismo data-bid-cta de todo el sitio. En esta página
       * esos enlaces apuntan a la página en la que ya estás, así que el
       * componente intercepta el clic y enfoca el primer campo en lugar de
       * recargar contra sí misma.
       */
      $ec_contact_form_props = array(
        'variant'    => 'inline',
        'persistent' => true,
        'density'    => 'comfortable',
        'trigger'    => '[data-bid-cta]',
        'endpoint'   => esc_url_raw(rest_url('ec/v1/bid')),
        'nonce'      => wp_create_nonce('wp_rest'),
        'phone'      => $ec_nap['phone'],
      );
      ?>

      <div
        id="ec-contact-form"
        data-props="<?php echo esc_attr(wp_json_encode($ec_contact_form_props)); ?>"
      ></div>

      <!-- ── Columna de datos ── -->
      <div class="flex flex-col gap-10">

        <!-- NAP. Carácter por carácter igual al footer: es la referencia
             contra la que se auditan las citations del directorio. -->
        <div>
          <h2 class="mb-4 text-[0.7rem] font-semibold uppercase tracking-[0.14em] text-ink/50">Yard</h2>
          <address class="flex flex-col gap-1 text-base not-italic leading-relaxed text-ink">
            <a
              href="<?php echo esc_url($ec_map_href); ?>"
              target="_blank"
              rel="noopener noreferrer"
              class="transition-colors hover:text-forest"
            >
              <?php echo esc_html($ec_nap['street']); ?><br>
              <?php echo esc_html($ec_nap['cityState']); ?>
            </a>
            <a href="<?php echo esc_url($ec_tel_href); ?>" class="mt-3 text-lg font-semibold tabular-nums underline decoration-ember decoration-2 underline-offset-8 transition-colors hover:text-forest">
              <?php echo esc_html($ec_nap['phone']); ?>
            </a>
            <a href="mailto:<?php echo esc_attr($ec_nap['email']); ?>" class="transition-colors hover:text-forest">
              <?php echo esc_html($ec_nap['email']); ?>
            </a>
          </address>
          <p class="mt-4 text-xs leading-relaxed text-ink/60">
            <?php echo esc_html($ec_nap['license']); ?><br>
            Serving <?php echo esc_html($ec_nap['counties']); ?>
          </p>
        </div>

        <!-- Mapa. Mismo tratamiento que el bloque 09: iframe en absolute
             dentro de una proporción fija, para que el alto quede reservado
             antes de que cargue, y lazy para que no arrastre el JavaScript de
             Maps en la carga inicial. -->
        <div class="relative aspect-[4/3] w-full overflow-hidden rounded-lg bg-ink/5 ring-1 ring-slate-200">
          <iframe
            src="<?php echo esc_url($ec_map_embed); ?>"
            title="Map showing EC Landscaping at 3754 N Higley Rd, Suite 2, Ogden, Utah"
            class="absolute inset-0 h-full w-full border-0"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            allowfullscreen
          ></iframe>
        </div>
      </div>
    </div>

    <!-- ═══════════════ Qué pasa después ═══════════════ -->
    <div class="mt-20 border-t border-slate-200 pt-12">
      <h2 class="ec-shine max-w-2xl font-display text-2xl font-bold tracking-tight text-ink sm:text-3xl">
        What happens after you hit send.
      </h2>

      <ol class="mt-10 grid gap-8 sm:grid-cols-3">
        <?php foreach ($ec_what_happens as $step) : ?>
          <li class="border-t-2 border-forest pt-5">
            <span class="font-display text-2xl font-bold tracking-tight text-ember-600-600 tabular-nums">
              <?php echo esc_html($step['n']); ?>
            </span>
            <h3 class="mt-2 font-display text-lg font-bold tracking-tight text-ink">
              <?php echo esc_html($step['title']); ?>
            </h3>
            <p class="mt-3 text-sm leading-relaxed text-ink/70">
              <?php echo esc_html($step['body']); ?>
            </p>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>

    <!-- Contenido editable desde el admin, por si hace falta agregar algo
         sin tocar la plantilla. Si la página va vacía, no imprime nada. -->
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();
        $ec_content = trim(get_the_content());
        if ($ec_content !== '') : ?>
          <div class="prose mt-16 max-w-3xl text-ink/80">
            <?php the_content(); ?>
          </div>
        <?php endif;
      endwhile;
    endif;
    ?>
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

<?php get_footer(); ?>