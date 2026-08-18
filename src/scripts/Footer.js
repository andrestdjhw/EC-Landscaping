import React from "react"

/**
 * Footer — EC Landscaping · landing comercial
 *
 * Estructura tomada de la referencia: columna de marca a la izquierda,
 * columnas de enlaces a la derecha, filete y fila inferior con copyright
 * y redes. Dos diferencias deliberadas:
 *
 *   1. Ancho casi completo (px-5 → px-10), sin tarjeta flotante centrada.
 *   2. La columna de marca carga el bloque NAP, no una tagline. El NAP del
 *      footer es la referencia contra la que se audita cada citation del
 *      directorio: si aquí dice algo distinto a Google Business, el ranking
 *      local lo paga. Por eso ocupa el lugar más visible.
 *
 * Props:
 *   logo        URL del logotipo en POSITIVO (arte oscuro). En theme="light"
 *               el ecscapingneg.png no sirve: es la versión en negativo y
 *               desaparece sobre fondo claro. Sin logo se usa el wordmark.
 *   stamp       URL del estampado de marca. Solo se dibuja en theme="dark":
 *               el tartán es claro y sobre bone no se distinguiría. Vacío =
 *               el footer va liso.
 *   theme       "light" (default, fondo bone) | "dark" (fondo ink)
 *   socials     [{ network, href }] — network: facebook | instagram | google
 *               | linkedin | youtube. Vacío = no se renderiza la fila.
 *   columns     [{ title, links: [{ label, href, cta }] }]
 *               cta: true marca el enlace con data-bid-cta, que es lo que
 *               ContactForm escucha. En /contact eso enfoca el formulario en
 *               lugar de recargar la página contra sí misma.
 */

// Raíz-relativos, nunca anclas sueltas: el footer sale en todas las páginas y
// un "#projects" pelado no lleva a ninguna parte fuera de la home.
// footer.php los reemplaza por home_url(), que además aguanta una instalación
// en subdirectorio.
const DEFAULT_COLUMNS = [
  {
    title: "Commercial",
    links: [
      { label: "Commercial overview", href: "/#commercial" },
      { label: "Capabilities", href: "/capabilities" },
      { label: "Projects", href: "/#projects" },
      { label: "Credentials", href: "/#credentials" },
      { label: "Service area", href: "/#service-area" },
    ],
  },
  {
    title: "Company",
    links: [
      { label: "About EC", href: "/about" },
      // El enlace a residencial se retiró: el sitio es de landscaping
      // comercial y no expone esa salida.
      { label: "Request a bid", href: "/contact", cta: true },
    ],
  },
  {
    title: "Legal",
    links: [
      { label: "Privacy policy", href: "/privacy-policy" },
      { label: "Terms of service", href: "/terms-of-service" },
    ],
  },
]

const socialPaths = {
  facebook: "M14 9h3V6h-3c-2.2 0-4 1.8-4 4v2H8v3h2v7h3v-7h3l1-3h-4v-2a1 1 0 0 1 1-1z",
  instagram: null,
  google: null,
  linkedin: null,
  youtube: null,
}

function SocialIcon({ network }) {
  const common = {
    viewBox: "0 0 24 24",
    "aria-hidden": "true",
    focusable: "false",
    className: "h-4 w-4",
  }

  if (network === "instagram") {
    return (
      <svg {...common} fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round">
        <rect x="3.5" y="3.5" width="17" height="17" rx="4.5" />
        <circle cx="12" cy="12" r="3.8" />
        <circle cx="17.2" cy="6.8" r="0.9" fill="currentColor" stroke="none" />
      </svg>
    )
  }
  if (network === "linkedin") {
    return (
      <svg {...common} fill="currentColor">
        <path d="M4.5 9h3v10.5h-3zM6 4.2a1.8 1.8 0 1 1 0 3.6 1.8 1.8 0 0 1 0-3.6zM9.5 9h2.9v1.5a3.2 3.2 0 0 1 2.9-1.6c2.3 0 3.7 1.5 3.7 4.2v6.4h-3v-5.7c0-1.4-.5-2.2-1.7-2.2-1 0-1.8.7-1.8 2.2v5.7h-3z" />
      </svg>
    )
  }
  if (network === "google") {
    return (
      <svg {...common} fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round">
        <path d="M20.5 12H12v3h5a5 5 0 1 1-1.5-5.3" />
        <circle cx="12" cy="12" r="8.5" />
      </svg>
    )
  }
  if (network === "youtube") {
    return (
      <svg {...common} fill="currentColor">
        <path d="M21.3 8.3a2.6 2.6 0 0 0-1.8-1.8C17.8 6 12 6 12 6s-5.8 0-7.5.5A2.6 2.6 0 0 0 2.7 8.3C2.2 10 2.2 12 2.2 12s0 2 .5 3.7a2.6 2.6 0 0 0 1.8 1.8C6.2 18 12 18 12 18s5.8 0 7.5-.5a2.6 2.6 0 0 0 1.8-1.8c.5-1.7.5-3.7.5-3.7s0-2-.5-3.7zM10.2 15.1V8.9l5.3 3.1z" />
      </svg>
    )
  }
  return (
    <svg {...common} fill="currentColor">
      <path d={socialPaths.facebook} />
    </svg>
  )
}

function Wordmark({ dark }) {
  return (
    <span className="flex flex-col gap-1.5">
      <span
        className={`font-display text-[2rem] leading-none font-bold tracking-tight ${
          dark ? "text-bone" : "text-ink"
        }`}
      >
        EC Landscaping
      </span>
      <span className="text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-ember">
        Commercial · Hardscape · Concrete
      </span>
    </span>
  )
}

export default function Footer({
  logo = null,
  stamp = null,
  theme = "light",
  legalName = "EC Landscaping LLC",
  address = "3754 N Higley Rd, Suite 2",
  cityState = "Ogden, UT 84404",
  phone = "(385) 240-3907",
  email = "info@ecscaping.com",
  mapsHref = "https://www.google.com/maps/search/?api=1&query=3754+N+Higley+Rd+Suite+2+Ogden+UT+84404",
  license = "Utah License 1106462255001 · S330",
  // "bonded" queda fuera a propósito: el capability deck aún no confirma
  // capacidad de bonding (Pendiente 04). No se publica hasta que Tomás lo
  // confirme por escrito.
  credentialLine = "Licensed and insured · General Liability · Workers' Comp · Commercial Auto",
  counties = "Serving Weber, Davis, Morgan and Box Elder counties",
  columns = DEFAULT_COLUMNS,
  socials = [],
  year = new Date().getFullYear(),
}) {
  const dark = theme === "dark"
  const telHref = `tel:+1${phone.replace(/\D/g, "")}`

  const surface = dark ? "bg-ink text-bone" : "bg-bone text-ink"
  const rule = dark ? "border-white/10" : "border-ink/10"

  /* En oscuro el texto atenuado sube de /60 y /65 a /75 y /80. No es un
     ajuste de gusto: con el estampado al 14% el punto más claro del tartán
     deja el fondo en #484B43, y ahí bone/60 da 3.97:1 y bone/65 da 4.35:1
     — los dos por debajo de AA. A /75 y /80 quedan en 5.22:1 y 5.66:1.

     En claro se conservan los valores originales: ahí no hay estampado. */
  const muted = dark ? "text-bone/75" : "text-ink/60"
  const linkTone = dark
    ? "text-bone/80 hover:text-bone"
    : "text-ink/65 hover:text-ink"
  const headingTone = dark ? "text-bone" : "text-ink"

  return (
    <footer className={`relative isolate overflow-hidden ${surface} border-t ${rule}`}>

      {/* ── Estampado de marca ──
          El "Estampado de Apoyo" del manual: el tartán de cuadros. Reemplaza
          al mosaico de gradientes que aproximábamos en CSS.

          La URL llega por prop desde footer.php y viaja al CSS en una custom
          property: la hoja de estilos no puede resolver la ruta de la
          biblioteca de medios por su cuenta.

          Solo sobre superficie oscura, y solo si hay archivo. En theme="light"
          el estampado quedaría más claro que su propio fondo.

          La opacidad vive en el CSS y está topeada en 0.14: por encima, el
          texto atenuado del footer deja de pasar AA sobre los cuadros claros
          del tartán. */}
      {dark && stamp && (
        <div className="pointer-events-none absolute inset-0 -z-10" aria-hidden="true">
          <span className="ec-stamp" style={{ "--stamp": `url('${stamp}')` }} />
        </div>
      )}

      <div className="relative px-5 pt-14 pb-8 sm:px-8 lg:px-10">
        <div className="grid gap-12 lg:grid-cols-[minmax(0,1.7fr)_repeat(3,minmax(0,1fr))] lg:gap-10">
          {/* ── Marca + NAP ── */}
          <div className="flex flex-col gap-6">
            {logo ? (
              /* brightness(0) invert(1) pinta el logo de blanco pleno, sea cual
                 sea su color original: brightness(0) lo lleva todo a negro y el
                 invert lo devuelve como blanco. Es lo que permite usar el mismo
                 archivo en las dos superficies sin subir una segunda versión.

                 Tiene un costo: aplana. El arco terracota del imagotipo
                 desaparece y queda una silueta blanca. Si esa parte tiene que
                 conservar su color, no hay filtro que lo resuelva — hace falta
                 el archivo en negativo de verdad, y entonces se quita esta
                 clase.

                 Solo en tema oscuro: sobre bone un logo blanco no se vería. */
              <img
                src={logo}
                alt={legalName}
                className={`h-11 w-auto self-start ${dark ? "[filter:brightness(0)_invert(1)]" : ""}`}
              />
            ) : (
              <Wordmark dark={dark} />
            )}

            <address className="flex flex-col gap-1 text-sm not-italic leading-relaxed">
              <a
                href={mapsHref}
                target="_blank"
                rel="noopener noreferrer"
                className={`${linkTone} transition-colors`}
              >
                {address}
                <br />
                {cityState}
              </a>
              <a href={telHref} className={`${linkTone} mt-2 tabular-nums transition-colors`}>
                {phone}
              </a>
              <a href={`mailto:${email}`} className={`${linkTone} transition-colors`}>
                {email}
              </a>
            </address>

            <p className={`max-w-sm text-xs leading-relaxed ${muted}`}>{credentialLine}</p>
          </div>

          {/* ── Columnas de enlaces ── */}
          {columns.map(column => (
            <nav key={column.title} aria-label={column.title}>
              <h2
                className={`mb-4 text-[0.7rem] font-semibold uppercase tracking-[0.16em] ${headingTone}`}
              >
                {column.title}
              </h2>
              <ul className="flex flex-col gap-2.5">
                {column.links.map(link => (
                  <li key={link.href + link.label}>
                    <a
                      href={link.href}
                      {...(link.cta ? { "data-bid-cta": "" } : {})}
                      className={`${linkTone} text-sm transition-colors focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember`}
                    >
                      {link.label}
                    </a>
                  </li>
                ))}
              </ul>
            </nav>
          ))}
        </div>

        {/* ── Filete ── */}
        <hr className={`mt-14 border-t ${rule}`} />

        {/* ── Fila inferior ── */}
        <div className="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
          <div className={`flex flex-col gap-1 text-xs ${muted}`}>
            <p>
              © {year} {legalName}. All rights reserved.
            </p>
            <p className="tabular-nums">{license}</p>
            <p>{counties}</p>
          </div>

          {socials.length > 0 && (
            <ul className="flex items-center gap-2">
              {socials.map(social => (
                <li key={social.network}>
                  <a
                    href={social.href}
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label={`${legalName} on ${social.network}`}
                    className={[
                      "flex h-9 w-9 items-center justify-center rounded-md border transition-colors",
                      dark
                        ? "border-white/15 text-bone/70 hover:border-white/30 hover:text-bone"
                        : "border-ink/15 text-ink/60 hover:border-ink/35 hover:text-ink",
                      "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
                    ].join(" ")}
                  >
                    <SocialIcon network={social.network} />
                  </a>
                </li>
              ))}
            </ul>
          )}
        </div>
      </div>
    </footer>
  )
}