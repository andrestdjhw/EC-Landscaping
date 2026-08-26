import React from "react"

/**
 * Footer — EC Landscaping · landing comercial
 *
 * Tres zonas sobre PINE:
 *   1. Rejilla principal: marca + NAP · columnas de navegación · contacto.
 *   2. Banda de rayas (el faldón de la van, girado).
 *   3. Línea legal: copyright + licencia.
 *
 * Props (inyectadas desde footer.php como JSON):
 *   logo        URL del logotipo en negativo. Sin él, wordmark tipográfico.
 *   phone       Teléfono display.           ej. "(385) 240-3907"
 *   email       Correo de contacto.
 *   address     NAP display, una línea.
 *   mapsHref    Enlace del NAP a Google Maps.
 *   license     Línea de licencia para la banda legal.
 *   pattern     URL del estampado de apoyo de la marca. Se pinta como capa
 *               de fondo sobre toda la superficie del footer, repetido y a
 *               opacidad baja. Sin URL, la capa no se renderiza y el footer
 *               queda en ink liso.
 *   social      Perfiles sociales. { facebook, instagram, google }.
 *               Clave vacía o ausente = el icono no se renderiza — a
 *               diferencia del navbar, acá no hay estado "pendiente":
 *               el footer es el cierre del sitio y un icono muerto ahí
 *               se lee como enlace roto, no como aviso de obra.
 *   nav         { grupo: [{ label, href }] } — columnas de navegación.
 *   bidHref     Destino del CTA.
 */

const iconProps = {
  viewBox: "0 0 24 24",
  fill: "none",
  stroke: "currentColor",
  strokeWidth: 1.6,
  strokeLinecap: "round",
  strokeLinejoin: "round",
  "aria-hidden": "true",
  focusable: "false",
}

const PhoneIcon = props => (
  <svg {...iconProps} {...props}>
    <path d="M4 4h4l2 5-2.5 1.5a11 11 0 0 0 6 6L15 14l5 2v4a1 1 0 0 1-1 1A16 16 0 0 1 3 5a1 1 0 0 1 1-1z" />
  </svg>
)

const MailIcon = props => (
  <svg {...iconProps} {...props}>
    <rect x="3" y="5" width="18" height="14" rx="1.5" />
    <path d="m3.5 7 8.5 6 8.5-6" />
  </svg>
)

const PinIcon = props => (
  <svg {...iconProps} {...props}>
    <path d="M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11z" />
    <circle cx="12" cy="10" r="2.5" />
  </svg>
)

/* ── Iconos sociales ──
   DUPLICADOS de Navbar.js a conciencia: allá viven como componentes locales
   de la franja de utilidad y este archivo no puede importarlos sin exponer
   internals del navbar. Son tres paths estáticos — el costo de la copia es
   menor que el de acoplar los dos componentes. Si aparece un tercer
   consumidor, ese es el momento de moverlos a un Icons.js compartido y
   dejar imports en los tres.

   Siluetas macizas con fill, no stroke: a este tamaño un contorno de 1.5
   se empasta. */

function FacebookIcon({ className = "" }) {
  return (
    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" className={className}>
      <path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.9h2.54V9.85c0-2.52 1.5-3.91 3.77-3.91 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.78-1.63 1.57v1.89h2.78l-.45 2.9h-2.33V22C18.34 21.24 22 17.08 22 12.06Z" />
    </svg>
  )
}

function InstagramIcon({ className = "" }) {
  return (
    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" className={className}>
      <path d="M12 2.16c3.2 0 3.58.01 4.85.07 1.17.05 1.8.25 2.23.41.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.36 1.06.41 2.23.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.25 1.8-.41 2.23-.22.56-.48.96-.9 1.38-.42.42-.82.68-1.38.9-.42.16-1.06.36-2.23.41-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.8-.25-2.23-.41-.56-.22-.96-.48-1.38-.9-.42-.42-.68-.82-.9-1.38-.16-.42-.36-1.06-.41-2.23C2.17 15.58 2.16 15.2 2.16 12s.01-3.58.07-4.85c.05-1.17.25-1.8.41-2.23.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.06-.36 2.23-.41C8.42 2.17 8.8 2.16 12 2.16Zm0 1.98c-3.14 0-3.51.01-4.75.07-1.15.05-1.77.24-2.18.4-.55.21-.94.47-1.35.88-.41.41-.67.8-.88 1.35-.16.41-.35 1.03-.4 2.18-.06 1.24-.07 1.61-.07 4.75s.01 3.51.07 4.75c.05 1.15.24 1.77.4 2.18.21.55.47.94.88 1.35.41.41.8.67 1.35.88.41.16 1.03.35 2.18.4 1.24.06 1.61.07 4.75.07s3.51-.01 4.75-.07c1.15-.05 1.77-.24 2.18-.4.55-.21.94-.47 1.35-.88.41-.41.67-.8.88-1.35.16-.41.35-1.03.4-2.18.06-1.24.07-1.61.07-4.75s-.01-3.51-.07-4.75c-.05-1.15-.24-1.77-.4-2.18a3.6 3.6 0 0 0-.88-1.35 3.6 3.6 0 0 0-1.35-.88c-.41-.16-1.03-.35-2.18-.4-1.24-.06-1.61-.07-4.75-.07Zm0 3.37a5.49 5.49 0 1 1 0 10.98 5.49 5.49 0 0 1 0-10.98Zm0 1.98a3.51 3.51 0 1 0 0 7.02 3.51 3.51 0 0 0 0-7.02Zm5.71-3.24a1.28 1.28 0 1 1 0 2.56 1.28 1.28 0 0 1 0-2.56Z" />
    </svg>
  )
}

function GoogleIcon({ className = "" }) {
  return (
    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" className={className}>
      <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z" />
    </svg>
  )
}

/* Enlace social del footer. Placa cuadrada con el mismo lenguaje de las
   placas de contacto: borde tenue, fondo apenas levantado, bisel al hover.
   Sin estado inerte — ver la nota de la prop social. */
function SocialLink({ icon: Icon, label, href }) {
  if (!href) return null
  return (
    <a
      href={href}
      target="_blank"
      rel="noopener noreferrer"
      aria-label={label}
      className={[
        "flex h-10 w-10 items-center justify-center rounded-md border border-white/10 bg-white/[0.04] text-bone/80",
        "transition-[box-shadow,transform,color,background-color] duration-150 ease-out",
        "hover:bevel hover:-translate-y-px hover:bg-white/[0.09] hover:text-bone",
        "active:bevel-pressed active:translate-y-0",
        "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
        "motion-reduce:transform-none motion-reduce:transition-none",
      ].join(" ")}
    >
      <Icon className="h-4 w-4" />
    </a>
  )
}

function Wordmark() {
  return (
    <span className="flex items-baseline gap-2 leading-none">
      <span className="font-display text-[1.35rem] font-bold tracking-tight text-bone">
        EC Landscaping
      </span>
      <span className="text-[0.6rem] font-semibold uppercase tracking-[0.18em] text-ember">
        Commercial
      </span>
    </span>
  )
}

export default function Footer({
  logo = null,
  phone = "(385) 240-3907",
  email = "info@ecscaping.com",
  address = "3754 N Higley Rd, Suite 2, Ogden, UT 84404",
  mapsHref = "https://www.google.com/maps/search/?api=1&query=3754+N+Higley+Rd+Suite+2+Ogden+UT+84404",
  license = "Utah License S330",
  pattern = null,
  social = {},
  nav = {},
  bidHref = "/contact",
}) {
  const telHref = `tel:+1${phone.replace(/\D/g, "")}`
  const mailHref = `mailto:${email}`
  const year = new Date().getFullYear()

  const groups = Object.entries(nav)
  const hasSocial = !!(social.facebook || social.instagram || social.google)

  return (
    <footer className="relative isolate overflow-hidden bg-ink text-bone">
      {/* ── Estampado de apoyo ──
          El patrón de marca, repetido sobre toda la superficie y en absolute
          detrás del contenido. Opacidad BAJA a propósito: el texto más
          apretado del footer es la línea legal en bone/50 a 12px, y el
          estampado no puede robarle contraste — a 0.07 se lee como textura
          del material, no como imagen. LA PERILLA: si al verlo compilado
          queda demasiado tenue, subilo de a poco (0.10 es un techo razonable)
          y revisá la línea legal contra la zona más clara del patrón.

          background-size fija la escala del mosaico; sin él, el PNG -scaled
          (2560px) entraría una sola vez y se leería como foto de fondo, no
          como estampado. */}
      {pattern && (
        <div
          className="pointer-events-none absolute inset-0 -z-10 opacity-[0.07]"
          style={{
            backgroundImage: `url(${pattern})`,
            backgroundRepeat: "repeat",
            backgroundSize: "480px auto",
          }}
          aria-hidden="true"
        ></div>
      )}
      {/* ── Rejilla principal ── */}
      <div className="px-5 py-14 sm:px-8 lg:px-10 lg:py-20">
        <div className="grid gap-12 lg:grid-cols-[1.4fr_1fr_1fr_1.2fr] lg:gap-10">

          {/* Marca + NAP.
              La dirección va como enlace al mapa y en UNA sola cadena: es la
              referencia de citation del negocio y tiene que coincidir
              carácter a carácter con Google Business (Pendiente 01 — nunca
              Hooper). */}
          <div>
            <a href="/" className="inline-block rounded focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember">
              {logo ? (
                <img src={logo} alt="EC Landscaping" className="h-9 w-auto" />
              ) : (
                <Wordmark />
              )}
            </a>
            <p className="mt-6 max-w-xs text-sm leading-relaxed text-bone/70">
              Commercial landscape, hardscape and concrete. Self-performed across the Weber–Davis corridor.
            </p>
            <a
              href={mapsHref}
              target="_blank"
              rel="noopener noreferrer"
              className="mt-5 inline-flex items-start gap-2.5 text-sm text-bone/80 underline decoration-ember decoration-2 underline-offset-4 transition-colors hover:text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
            >
              <PinIcon className="mt-0.5 h-4 w-4 shrink-0 text-ember/80" />
              <span>{address}</span>
            </a>
          </div>

          {/* Columnas de navegación */}
          {groups.map(([title, links]) => (
            <nav key={title} aria-label={title}>
              <p className="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300">
                {title}
              </p>
              <ul className="flex flex-col gap-2.5">
                {links.map(link => (
                  <li key={link.href}>
                    <a
                      href={link.href}
                      className="text-sm text-bone/70 transition-colors hover:text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
                    >
                      {link.label}
                    </a>
                  </li>
                ))}
              </ul>
            </nav>
          ))}

          {/* Contacto directo + redes */}
          <div>
            <p className="mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300">
              Contact
            </p>
            <ul className="flex flex-col gap-2.5">
              <li>
                <a
                  href={telHref}
                  className="group flex items-center gap-2.5 text-sm text-bone/80 transition-colors hover:text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
                >
                  <PhoneIcon className="h-4 w-4 shrink-0 text-ember/80 transition-colors group-hover:text-ember" />
                  <span className="font-semibold tabular-nums">{phone}</span>
                </a>
              </li>
              <li>
                <a
                  href={mailHref}
                  className="group flex items-center gap-2.5 text-sm text-bone/80 transition-colors hover:text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
                >
                  <MailIcon className="h-4 w-4 shrink-0 text-ember/80 transition-colors group-hover:text-ember" />
                  <span>{email}</span>
                </a>
              </li>
            </ul>

            {/* ── Redes ──
                Debajo del contacto directo, no mezcladas con él: teléfono y
                correo son acciones hacia EC; las redes son EC en otros
                lugares. El bloque entero desaparece si ninguna URL llegó —
                sin huecos ni títulos colgando sobre nada. */}
            {hasSocial && (
              <div className="mt-7">
                <p className="mb-3 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-bone/50">
                  Follow the work
                </p>
                <div className="flex items-center gap-2">
                  <SocialLink icon={FacebookIcon}  label="EC Landscaping on Facebook"  href={social.facebook} />
                  <SocialLink icon={InstagramIcon} label="EC Landscaping on Instagram" href={social.instagram} />
                  <SocialLink icon={GoogleIcon}    label="EC Landscaping on Google"    href={social.google} />
                </div>
              </div>
            )}

            <a
              href={bidHref}
              data-bid-cta=""
              className="mt-7 inline-flex items-center gap-2.5 border-2 border-white/25 bg-ember px-6 py-3 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink transition-colors hover:bg-ember-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
            >
              Request a Bid
              <svg {...iconProps} className="h-4 w-4">
                <path d="M5 12h13M13 6l6 6-6 6" />
              </svg>
            </a>
          </div>
        </div>
      </div>

      {/* ── Banda de rayas: el faldón de la van, girado ── */}
      <div className="ec-band ec-band--h h-2 opacity-40" aria-hidden="true"></div>

      {/* ── Línea legal ── */}
      <div className="border-t border-white/10 px-5 py-5 sm:px-8 lg:px-10">
        {/* Tres zonas en una rejilla, no flex con justify-between: con flex
            el centro se corre según cuánto midan los extremos, y el crédito
            tiene que quedar centrado contra la página — el mismo criterio
            que la franja de utilidad del navbar. En móvil apila. */}
        <div className="grid gap-2 text-center text-xs text-bone/50 sm:grid-cols-3 sm:items-center sm:gap-4 sm:text-left">
          <p>© {year} EC Landscaping LLC. All rights reserved.</p>
          {/* Crédito de agencia, al centro. Mismo peso visual que el resto
              de la línea legal — es firma, no CTA. */}
          <p className="sm:text-center">
            Site by{" "}
            <a
              href="https://828marketingsolutions.com/"
              target="_blank"
              rel="noopener noreferrer"
              className="text-bone/70 underline decoration-ember decoration-2 underline-offset-4 transition-colors hover:text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
            >
              828 Marketing Solutions
            </a>
          </p>
          <p className="sm:text-right">{license}</p>
        </div>
      </div>
    </footer>
  )
}