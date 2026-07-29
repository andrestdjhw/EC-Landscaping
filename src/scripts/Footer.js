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
 *   theme       "light" (default, fondo bone) | "dark" (fondo ink)
 *   socials     [{ network, href }] — network: facebook | instagram | google
 *               | linkedin | youtube. Vacío = no se renderiza la fila.
 */

const DEFAULT_COLUMNS = [
  {
    title: "Commercial",
    links: [
      { label: "Commercial overview", href: "#commercial" },
      { label: "Capabilities", href: "#capabilities" },
      { label: "Projects", href: "#projects" },
      { label: "Credentials", href: "#credentials" },
      { label: "Service area", href: "#service-area" },
    ],
  },
  {
    title: "Company",
    links: [
      { label: "About EC", href: "/about" },
      { label: "Residential", href: "/residential" },
      { label: "Request a bid", href: "#request-a-bid" },
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
  const muted = dark ? "text-bone/60" : "text-ink/60"
  const linkTone = dark
    ? "text-bone/65 hover:text-bone"
    : "text-ink/65 hover:text-ink"
  const headingTone = dark ? "text-bone" : "text-ink"

  return (
    <footer className={`${surface} border-t ${rule}`}>
      <div className="px-5 pt-14 pb-8 sm:px-8 lg:px-10">
        <div className="grid gap-12 lg:grid-cols-[minmax(0,1.7fr)_repeat(3,minmax(0,1fr))] lg:gap-10">
          {/* ── Marca + NAP ── */}
          <div className="flex flex-col gap-6">
            {logo ? (
              <img src={logo} alt={legalName} className="h-11 w-auto self-start" />
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