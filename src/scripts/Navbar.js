import React, { useEffect, useRef, useState } from "react"

/**
 * Navbar — EC Landscaping · landing comercial
 *
 * Estructura de dos niveles:
 *   1. Franja de utilidad: número de licencia + teléfono + salida a residencial.
 *   2. Barra flotante que se "acopla" (dock) al hacer scroll.
 *
 * Props (todas opcionales, se pueden inyectar desde header.php como JSON):
 *   logo              URL del logotipo. Si no llega, se usa el wordmark tipográfico.
 *                     Ojo: ecscapingneg.png es la versión en negativo (arte claro),
 *                     así que solo funciona con theme="dark". Si se cambia a "light"
 *                     hace falta subir la versión en positivo.
 *   phone             Teléfono en formato display.  ej. "(385) 240-3907"
 *   license           Línea de licencia.            ej. "UT 1106462255001 · S330"
 *   links             [{ label, href, activeId, children }]
 *                     children: [{ label, href }] convierte la entrada en un
 *                     desplegable. El padre pasa a ser <button> y no <a>: un
 *                     elemento que navega y despliega a la vez deja al lector
 *                     de pantalla sin saber qué hace Enter.
 *                     activeId: id de sección para el scrollspy cuando el href
 *                     del padre ya no es un ancla.
 *   bidHref           Destino del CTA principal.
 *   residentialHref   Destino del enlace secundario a residencial. Si no llega,
 *                     el enlace no se renderiza — ni en la franja de utilidad ni
 *                     en el panel móvil. Hoy header.php no lo manda: el sitio es
 *                     de landscaping comercial y no expone salida a residencial.
 *                     El markup se conserva para que restituirlo sea agregar la
 *                     prop, sin tocar este archivo.
 *   theme             "dark" (default) | "light"
 *   ctaStyle          "ember" (default) | "soft"
 *                     "soft" es el estilo neumórfico de Uiverse; pide theme="light"
 *                     porque su resplandor blanco necesita superficie clara.
 */

// Raíz-relativos y no anclas sueltas: así el menú funciona desde cualquier
// página. header.php los reemplaza por home_url(), que además aguanta una
// instalación en subdirectorio.
const DEFAULT_LINKS = [
  { label: "Commercial", href: "/#commercial" },
  { label: "Projects", href: "/#projects" },
  {
    label: "Capabilities",
    activeId: "#capabilities",
    children: [
      { label: "All capabilities", href: "/capabilities" },
      { label: "Commercial landscape installation", href: "/landscape-installation" },
      { label: "Hardscape & concrete", href: "/hardscape-concrete" },
      { label: "Grounds maintenance, irrigation & snow", href: "/grounds-maintenance" },
      { label: "Water-wise retrofits", href: "/water-wise-retrofits" },
    ],
  },
  { label: "Credentials", href: "/#credentials" },
  { label: "Service Area", href: "/#service-area" },
]

/**
 * Devuelve el id de sección de un href, venga como "#projects", "/#projects"
 * o "https://sitio.com/#projects".
 *
 * Los enlaces del menú tienen que ser absolutos para funcionar desde /contact
 * o desde una página de capacidad — un "#projects" suelto no lleva a ninguna
 * parte fuera de la home. Pero el scrollspy sigue necesitando el id pelado,
 * así que se extrae acá en vez de asumir que el href empieza con #.
 */
function fragmentOf(value) {
  if (typeof value !== "string") return null
  const hash = value.indexOf("#")
  if (hash === -1) return null
  return value.slice(hash + 1) || null
}

function useDocked(threshold = 24) {
  const [docked, setDocked] = useState(false)
  useEffect(() => {
    let frame = null
    const onScroll = () => {
      if (frame) return
      frame = window.requestAnimationFrame(() => {
        setDocked(window.scrollY > threshold)
        frame = null
      })
    }
    onScroll()
    window.addEventListener("scroll", onScroll, { passive: true })
    return () => {
      window.removeEventListener("scroll", onScroll)
      if (frame) window.cancelAnimationFrame(frame)
    }
  }, [threshold])
  return docked
}

function useActiveSection(links) {
  const [active, setActive] = useState(null)
  useEffect(() => {
    // activeId cubre las entradas cuyo href ya no apunta a una sección — el
    // padre de un desplegable, por ejemplo — pero que siguen correspondiendo
    // a un bloque de la landing.
    const ids = links.map(l => fragmentOf(l.activeId || l.href)).filter(Boolean)
    const nodes = ids.map(id => document.getElementById(id)).filter(Boolean)
    if (!nodes.length || !("IntersectionObserver" in window)) return
    const observer = new IntersectionObserver(
      entries => {
        const visible = entries
          .filter(e => e.isIntersecting)
          .sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0]
        if (visible) setActive(visible.target.id)
      },
      { rootMargin: "-45% 0px -50% 0px", threshold: [0, 0.25, 0.5] }
    )
    nodes.forEach(n => observer.observe(n))
    return () => observer.disconnect()
  }, [links])
  return active
}

/* ── Iconos ────────────────────────────────────────────────────────
   SVG inline en lugar de una librería: son tres, pesan nada y así el
   grosor de trazo queda alineado con la tipografía en vez de heredar
   el look de un set genérico. */

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

const ChevronIcon = props => (
  <svg {...iconProps} {...props}>
    <path d="m6 9 6 6 6-6" />
  </svg>
)

/**
 * Placa de contacto: icono + etiqueta, plana en reposo y biselada en hover.
 * `external` solo se activa para el mapa; tel: y mailto: los resuelve el
 * sistema operativo y abrirlos en pestaña nueva deja una ventana en blanco.
 */
function ContactPlate({ icon: Icon, label, srLabel, href, external = false }) {
  return (
    <a
      href={href}
      aria-label={srLabel}
      {...(external ? { target: "_blank", rel: "noopener noreferrer" } : {})}
      className={[
        "group flex items-center gap-2 rounded-md border border-white/10 bg-white/[0.04] px-2.5 py-1.5",
        "text-[0.68rem] font-medium uppercase tracking-[0.12em] text-bone/70",
        "transition-[box-shadow,transform,color,background-color] duration-150 ease-out",
        "hover:bevel hover:-translate-y-px hover:bg-white/[0.09] hover:text-bone",
        "active:bevel-pressed active:translate-y-0 active:text-bone/80",
        "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
        "motion-reduce:transform-none motion-reduce:transition-none",
      ].join(" ")}
    >
      <Icon className="h-4 w-4 shrink-0 text-ember/80 transition-colors group-hover:text-ember" />
      <span className="hidden sm:inline">{label}</span>
      {external && (
        <svg
          {...iconProps}
          className="hidden h-3 w-3 shrink-0 text-bone/40 transition-colors group-hover:text-bone/70 sm:block"
        >
          <path d="M7 17 17 7M17 7h-6M17 7v6" />
        </svg>
      )}
    </a>
  )
}

/**
 * BidButton — CTA principal.
 *
 * Toma la mecánica del botón de Uiverse (píldora, mayúsculas con tracking,
 * doble halo que se contrae en hover y se apaga en :active) y la ejecuta en
 * la paleta de marca.
 *
 *   skin="ember"  naranja de marca sobre la barra oscura. Default.
 *   skin="soft"   los valores literales del original, en azul claro.
 *   size="sm"     compacto, para el navbar. "md" replica el padding original.
 */
function BidButton({ href, onClick, skin = "ember", size = "sm", className = "" }) {
  const skins = {
    ember: [
      // Texto en ink, no blanco: blanco sobre #E2711D da 3.2:1 y falla AA a
      // 13px. Negro sobre naranja da 5.8:1 — y es el par de la señalética de
      // obra, que es exactamente el vocabulario de este cliente.
      "border-white/25 bg-ember text-ink cta-relief",
      "hover:cta-relief-tight hover:bg-ember-600 hover:-translate-y-px",
    ].join(" "),
    soft: [
      "border-white/[0.333] bg-[#e0e8ef] text-[#7e97b8] cta-soft",
      "hover:cta-soft-tight hover:bg-[#e5edf5] hover:text-[#516d91]",
    ].join(" "),
  }

  const sizes = {
    sm: "py-3 pl-6 pr-5",
    md: "py-4 pl-7 pr-6",
  }

  return (
    <a
      href={href}
      onClick={onClick}
      // Todos los CTA de bid llevan este atributo. ContactForm lo escucha:
      // donde hay formulario en pantalla intercepta y enfoca; donde no,
      // el enlace navega a /contact como cualquier otro.
      data-bid-cta=""
      className={[
        "group inline-flex items-center justify-center gap-2.5 rounded-full border-2",
        "text-[0.8125rem] font-medium uppercase tracking-[0.4px]",
        "transition-all duration-200 ease-out",
        "active:translate-y-0 active:shadow-none",
        "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
        "motion-reduce:transform-none motion-reduce:transition-none",
        skins[skin],
        sizes[size],
        className,
      ].join(" ")}
    >
      Request a Bid
      <svg
        {...iconProps}
        className="h-4 w-4 shrink-0 transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transition-none motion-reduce:group-hover:translate-x-0"
      >
        <path d="M5 12h13M13 6l6 6-6 6" />
      </svg>
    </a>
  )
}

/**
 * NavDropdown — entrada de menú con submenú.
 *
 * Abre con hover y con foco, porque son dos formas distintas de llegar y
 * ninguna debería quedar fuera. El cierre por hover lleva un retardo corto:
 * sin él, el desplegable se cierra en el hueco entre el botón y el panel
 * mientras el mouse baja.
 */
function NavDropdown({ link, isActive, linkBase, linkActive, isLight }) {
  const [open, setOpen] = useState(false)
  const wrapRef = useRef(null)
  const buttonRef = useRef(null)
  const timer = useRef(null)

  const cancelClose = () => {
    if (timer.current) window.clearTimeout(timer.current)
  }
  const scheduleClose = () => {
    cancelClose()
    timer.current = window.setTimeout(() => setOpen(false), 160)
  }

  useEffect(() => () => cancelClose(), [])

  // Clic afuera y Escape. Escape además devuelve el foco al botón: si no, el
  // teclado queda huérfano en medio del documento.
  useEffect(() => {
    if (!open) return
    const onDocClick = event => {
      if (wrapRef.current && !wrapRef.current.contains(event.target)) setOpen(false)
    }
    const onKey = event => {
      if (event.key !== "Escape") return
      setOpen(false)
      if (buttonRef.current) buttonRef.current.focus()
    }
    document.addEventListener("mousedown", onDocClick)
    document.addEventListener("keydown", onKey)
    return () => {
      document.removeEventListener("mousedown", onDocClick)
      document.removeEventListener("keydown", onKey)
    }
  }, [open])

  const panelId = `nav-menu-${link.label.replace(/\s+/g, "-").toLowerCase()}`

  return (
    <li
      ref={wrapRef}
      className="relative"
      onMouseEnter={() => { cancelClose(); setOpen(true) }}
      onMouseLeave={scheduleClose}
      onFocus={() => { cancelClose(); setOpen(true) }}
      onBlur={scheduleClose}
    >
      <button
        ref={buttonRef}
        type="button"
        aria-expanded={open}
        aria-controls={panelId}
        onClick={() => setOpen(v => !v)}
        className={[
          "relative flex items-center gap-1.5 py-1 text-[0.7rem] font-semibold uppercase tracking-[0.13em] transition-colors",
          "focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember",
          isActive ? linkActive : linkBase,
        ].join(" ")}
      >
        {link.label}
        <ChevronIcon
          className={[
            "h-3 w-3 shrink-0 transition-transform duration-200 motion-reduce:transition-none",
            open ? "rotate-180" : "",
          ].join(" ")}
        />
        <span
          aria-hidden="true"
          className={[
            "absolute -bottom-0.5 left-0 h-0.5 w-full origin-left bg-ember",
            "transition-transform duration-200 motion-reduce:transition-none",
            isActive ? "scale-x-100" : "scale-x-0",
          ].join(" ")}
        />
      </button>

      {/* pt-3 en el contenedor y no margin en el panel: el padding es zona
          sensible al hover, así que el mouse cruza el hueco sin salirse del
          <li> y el menú no se cierra a mitad de camino. */}
      <div
        id={panelId}
        hidden={!open}
        className="absolute left-0 top-full z-10 pt-3"
      >
        <ul
          className={[
            "min-w-[16rem] overflow-hidden rounded-lg py-2 shadow-xl shadow-ink/20 backdrop-blur-md",
            isLight ? "bg-white/95 ring-1 ring-mist" : "bg-ink/95 ring-1 ring-white/10",
          ].join(" ")}
        >
          {link.children.map(child => (
            <li key={child.href}>
              <a
                href={child.href}
                className={[
                  "block px-5 py-2.5 text-sm transition-colors",
                  "focus-visible:outline-2 focus-visible:outline-offset-[-2px] focus-visible:outline-ember",
                  isLight
                    ? "text-ink/75 hover:bg-bone hover:text-ink"
                    : "text-bone/75 hover:bg-white/[0.07] hover:text-bone",
                ].join(" ")}
              >
                {child.label}
              </a>
            </li>
          ))}
        </ul>
      </div>
    </li>
  )
}

function Wordmark({ theme }) {
  const primary = theme === "light" ? "text-ink" : "text-bone"
  return (
    <span className="flex items-baseline gap-2 leading-none">
      <span className={`font-display text-[1.35rem] font-bold tracking-tight ${primary}`}>
        EC Landscaping
      </span>
      <span className="hidden text-[0.6rem] font-semibold uppercase tracking-[0.18em] text-ember sm:inline">
        Commercial
      </span>
    </span>
  )
}

export default function Navbar({
  logo = null,
  phone = "(385) 240-3907",
  email = "info@ecscaping.com",
  address = "3754 N Higley Rd, Suite 2 · Ogden, UT",
  mapsHref = "https://www.google.com/maps/search/?api=1&query=3754+N+Higley+Rd+Suite+2+Ogden+UT+84404",
  license = "UT License 1106462255001 · S330",
  links = DEFAULT_LINKS,
  bidHref = "/contact",
  // null y no "/residential": el enlace es opt-in por prop. Ver la nota de
  // arriba — el sitio es comercial y hoy no expone salida a residencial.
  residentialHref = null,
  theme = "dark",
  ctaStyle = "ember",
}) {
  const docked = useDocked()
  const active = useActiveSection(links)
  const [open, setOpen] = useState(false)
  const panelRef = useRef(null)
  const telHref = `tel:+1${phone.replace(/\D/g, "")}`
  const mailHref = `mailto:${email}`

  // Bloqueo de scroll y cierre con Escape mientras el panel móvil está abierto.
  useEffect(() => {
    if (!open) return
    const previous = document.body.style.overflow
    document.body.style.overflow = "hidden"
    const onKey = e => {
      if (e.key === "Escape") setOpen(false)
    }
    document.addEventListener("keydown", onKey)
    return () => {
      document.body.style.overflow = previous
      document.removeEventListener("keydown", onKey)
    }
  }, [open])

  const isLight = theme === "light"

  /**
   * Al tope de la página la barra es opaca; al acoplarse baja a 80% para que
   * el contenido se insinúe por detrás.
   *
   * El 80% es el piso, no un valor estético: la landing alterna secciones
   * oscuras y claras, y sobre fondo blanco un ink al 70% deja los links en
   * 4.1:1, por debajo del mínimo legible a 10px. A 80% quedan en 5.6:1.
   *
   * El bg va tras supports-[backdrop-filter] porque sin blur la transparencia
   * no difumina nada: solo se ve el texto de la página cruzándose con el menú.
   * En ese caso la barra se queda opaca.
   */
  const barSurface = isLight
    ? [
        "ring-1 ring-mist bg-white/95",
        docked ? "supports-[backdrop-filter]:bg-white/80" : "",
      ].join(" ")
    : [
        "ring-1 ring-white/10 bg-ink/95",
        docked ? "supports-[backdrop-filter]:bg-ink/80" : "",
      ].join(" ")

  const linkBase = isLight ? "text-ink/70 hover:text-ink" : "text-bone/70 hover:text-bone"
  const linkActive = isLight ? "text-ink" : "text-bone"

  return (
    <>
      <header className="fixed inset-x-0 top-0 z-50">
        {/* ── Franja de utilidad: banda propia a todo el ancho, separada de la
            barra. Es opaca, así que tapa la franja superior del video del hero
            — para que el video se vea por detrás basta cambiar bg-ink por
            bg-ink/85 y añadir backdrop-blur-md: la licencia queda en 4.7:1,
            que sigue pasando AA a 11px. ── */}
        <div
          className={[
            "overflow-hidden border-b border-white/5 bg-ink text-bone",
            "transition-[max-height,opacity] duration-300 ease-out motion-reduce:transition-none",
            docked ? "max-h-0 opacity-0" : "max-h-12 opacity-100",
          ].join(" ")}
        >
          <div className="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-1.5">
            <span className="hidden text-[0.68rem] font-medium uppercase tracking-[0.14em] text-bone/55 md:inline">
              {license}
            </span>
            <div className="flex flex-1 items-center justify-end gap-2">
              <ContactPlate
                icon={PhoneIcon}
                label={phone}
                srLabel={`Call ${phone}`}
                href={telHref}
              />
              <ContactPlate
                icon={MailIcon}
                label={email}
                srLabel={`Email ${email}`}
                href={mailHref}
              />
              <ContactPlate
                icon={PinIcon}
                label={address}
                srLabel={`Open ${address} in Google Maps`}
                href={mapsHref}
                external
              />
              {residentialHref && (
                <a
                  href={residentialHref}
                  className="ml-1 hidden text-[0.68rem] font-medium uppercase tracking-[0.14em] text-bone/45 transition-colors hover:text-bone/90 lg:inline"
                >
                  Residential <span aria-hidden="true">→</span>
                </a>
              )}
            </div>
          </div>
        </div>

        {/* ── Barra principal: flotante arriba, acoplada al hacer scroll ── */}
        <div
          className={[
            "transition-all duration-300 ease-out motion-reduce:transition-none",
            docked ? "px-0 pt-0" : "px-4 pt-4 sm:px-6",
          ].join(" ")}
        >
          <nav
            aria-label="Primary"
            className={[
              barSurface,
              "mx-auto flex items-center justify-between gap-6",
              "transition-all duration-300 ease-out motion-reduce:transition-none",
              docked
                ? "max-w-none rounded-none px-5 py-3 shadow-[0_1px_0_0_rgba(0,0,0,0.08)] backdrop-blur-xl backdrop-saturate-150 sm:px-8"
                : "max-w-7xl rounded-lg px-5 py-4 shadow-lg shadow-ink/10 backdrop-blur-md sm:px-7",
            ].join(" ")}
          >
            {/* Marca */}
            <a href="/" className="flex shrink-0 items-center gap-3 rounded focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember">
              {logo ? (
                <img src={logo} alt="EC Landscaping" className="h-8 w-auto sm:h-9" />
              ) : (
                <Wordmark theme={theme} />
              )}
            </a>

            {/* Enlaces — escritorio */}
            <ul className="hidden items-center gap-7 lg:flex">
              {links.map(link => {
                const id = fragmentOf(link.activeId || link.href)
                const isActive = !!id && id === active

                if (link.children && link.children.length) {
                  return (
                    <NavDropdown
                      key={link.label}
                      link={link}
                      isActive={isActive}
                      linkBase={linkBase}
                      linkActive={linkActive}
                      isLight={isLight}
                    />
                  )
                }

                return (
                  <li key={link.href}>
                    <a
                      href={link.href}
                      aria-current={isActive ? "true" : undefined}
                      className={[
                        "relative py-1 text-[0.7rem] font-semibold uppercase tracking-[0.13em] transition-colors",
                        "focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember",
                        isActive ? linkActive : linkBase,
                      ].join(" ")}
                    >
                      {link.label}
                      <span
                        aria-hidden="true"
                        className={[
                          "absolute -bottom-0.5 left-0 h-0.5 w-full origin-left bg-ember",
                          "transition-transform duration-200 motion-reduce:transition-none",
                          isActive ? "scale-x-100" : "scale-x-0",
                        ].join(" ")}
                      />
                    </a>
                  </li>
                )
              })}
            </ul>

            {/* Acciones — escritorio */}
            <div className="hidden shrink-0 items-center gap-4 lg:flex">
              <a
                href={telHref}
                className={[
                  "text-sm font-semibold tabular-nums transition-colors",
                  "focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember",
                  isLight ? "text-ink hover:text-forest" : "text-bone hover:text-white",
                ].join(" ")}
              >
                {phone}
              </a>
              <BidButton href={bidHref} skin={ctaStyle} size="sm" />
            </div>

            {/* Disparador móvil */}
            <button
              type="button"
              onClick={() => setOpen(true)}
              aria-expanded={open}
              aria-controls="mobile-nav"
              className={[
                "flex items-center gap-2 rounded-md px-3 py-2 text-[0.7rem] font-bold uppercase tracking-[0.12em] lg:hidden",
                "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
                isLight ? "text-ink ring-1 ring-mist" : "text-bone ring-1 ring-white/15",
              ].join(" ")}
            >
              Menu
              <span aria-hidden="true" className="flex flex-col gap-[3px]">
                <span className="block h-[1.5px] w-4 bg-current" />
                <span className="block h-[1.5px] w-4 bg-current" />
              </span>
            </button>
          </nav>
        </div>
      </header>

      {/* ── Panel móvil ── */}
      <div
        id="mobile-nav"
        ref={panelRef}
        role="dialog"
        aria-modal="true"
        aria-label="Menu"
        hidden={!open}
        className="fixed inset-0 z-[60] flex flex-col bg-ink text-bone lg:hidden"
      >
        <div className="flex items-center justify-between border-b border-white/10 px-5 py-4">
          {logo ? (
            <img src={logo} alt="EC Landscaping" className="h-8 w-auto" />
          ) : (
            <Wordmark theme="dark" />
          )}
          <button
            type="button"
            onClick={() => setOpen(false)}
            className="rounded-md px-3 py-2 text-[0.7rem] font-bold uppercase tracking-[0.12em] text-bone ring-1 ring-white/15 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
          >
            Close
          </button>
        </div>

        <nav aria-label="Primary mobile" className="flex-1 overflow-y-auto px-5 py-6">
          <ul className="flex flex-col divide-y divide-white/10">
            {links.map(link => (
              <li key={link.label}>
                {/* En el panel móvil el submenú no se despliega: se muestra
                    entero, indentado. Una pantalla chica ya obliga a abrir un
                    menú; obligar a abrir un segundo nivel dentro es cobrar dos
                    veces por el mismo destino. */}
                {link.children && link.children.length ? (
                  <div className="py-4">
                    <p className="font-display text-2xl font-bold tracking-tight text-bone/50">
                      {link.label}
                    </p>
                    <ul className="mt-3 flex flex-col gap-1 border-l border-white/15 pl-4">
                      {link.children.map(child => (
                        <li key={child.href}>
                          <a
                            href={child.href}
                            onClick={() => setOpen(false)}
                            className="block py-2 text-base font-medium text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
                          >
                            {child.label}
                          </a>
                        </li>
                      ))}
                    </ul>
                  </div>
                ) : (
                  <a
                    href={link.href}
                    onClick={() => setOpen(false)}
                    className="block py-4 font-display text-2xl font-bold tracking-tight text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
                  >
                    {link.label}
                  </a>
                )}
              </li>
            ))}
            {residentialHref && (
              <li>
                <a
                  href={residentialHref}
                  onClick={() => setOpen(false)}
                  className="block py-4 text-sm font-semibold uppercase tracking-[0.14em] text-bone/50"
                >
                  Residential <span aria-hidden="true">→</span>
                </a>
              </li>
            )}
          </ul>
        </nav>

        <div className="border-t border-white/10 px-5 py-5">
          <ul className="mb-5 flex flex-col gap-2">
            {[
              { icon: PhoneIcon, label: phone, href: telHref, srLabel: `Call ${phone}`, external: false },
              { icon: MailIcon, label: email, href: mailHref, srLabel: `Email ${email}`, external: false },
              { icon: PinIcon, label: address, href: mapsHref, srLabel: `Open ${address} in Google Maps`, external: true },
            ].map(item => (
              <li key={item.href}>
                <a
                  href={item.href}
                  aria-label={item.srLabel}
                  {...(item.external ? { target: "_blank", rel: "noopener noreferrer" } : {})}
                  className="group flex items-center gap-3 rounded-md border border-white/10 bg-white/[0.04] px-3 py-2.5 text-sm text-bone/80 transition-[box-shadow,transform,background-color] duration-150 hover:bevel hover:-translate-y-px hover:bg-white/[0.09] active:bevel-pressed active:translate-y-0 motion-reduce:transform-none motion-reduce:transition-none"
                >
                  <item.icon className="h-4 w-4 shrink-0 text-ember/80 group-hover:text-ember" />
                  <span>{item.label}</span>
                </a>
              </li>
            ))}
          </ul>
          <p className="mb-4 text-[0.65rem] font-medium uppercase tracking-[0.14em] text-bone/50">
            {license}
          </p>
          <div className="grid grid-cols-2 gap-3">
            <a
              href={telHref}
              className="rounded-full border-2 border-white/20 py-3 text-center text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-bone"
            >
              Call now
            </a>
            <BidButton
              href={bidHref}
              onClick={() => setOpen(false)}
              skin={ctaStyle}
              size="sm"
              className="w-full"
            />
          </div>
        </div>
      </div>

      {/* ── Barra inferior fija en móvil (fuera del panel) ── */}
      {!open && (
        <div className="fixed inset-x-0 bottom-0 z-40 grid grid-cols-2 gap-px border-t border-white/10 bg-ink lg:hidden">
          <a
            href={telHref}
            className="py-4 text-center text-[0.72rem] font-bold uppercase tracking-[0.12em] text-bone"
          >
            Call {phone}
          </a>
          <a
            href={bidHref}
            data-bid-cta=""
            className="bg-ember py-4 text-center text-[0.72rem] font-bold uppercase tracking-[0.12em] text-ink"
          >
            Request a Bid
          </a>
        </div>
      )}
    </>
  )
}