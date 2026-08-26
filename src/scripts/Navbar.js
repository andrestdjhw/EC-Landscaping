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
 *   license           Línea de licencia.            ej. "UT License S330"
 *   social            Perfiles sociales. { facebook, instagram, google }.
 *                     Clave vacía o ausente = el icono se dibuja apagado y
 *                     sin enlace. Las URLs se llenan en header.php — ya
 *                     están definidas (Pendiente 13 resuelto): Facebook e
 *                     Instagram de EC, y el perfil de Google Business en
 *                     lugar de TikTok, que la empresa no tiene.
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
/* ── Iconos sociales ──
   Definidos acá y no en Icons.js a propósito: son de uso exclusivo de esta
   franja. Si en algún momento hacen falta también en el footer, se mueven
   allá y acá queda un import.

   Los tres a 24x24 con fill, no stroke: los logos de marca se dibujan como
   siluetas macizas y a 14px un contorno de 1.5 se empasta. */

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

/* Enlace social. Mientras no haya URL se dibuja como span inerte en vez de
   un <a href="#">: un enlace que no lleva a ningún lado ensucia el recorrido
   de Tab y engaña al lector de pantalla. El icono se ve —que es lo que
   permite evaluar la franja ahora— pero no promete nada.

   Base en bone PLENO (antes bone/60): a 3.5px de trazo sobre la franja
   pine-900, el 60% los volvía fantasmas — y el estado inerte les sumaba
   opacity-40 encima, dejándolos en un ~24% efectivo. El inerte sube a
   opacity-70: sigue marcando el escalón "pendiente" contra un enlace vivo,
   pero ya se ve qué redes va a haber. Los enlaces vivos rematan en blanco
   puro al hover.

   Cuando lleguen las URLs se llenan en header.php y estos se vuelven enlaces
   reales sin tocar el componente. */
function SocialLink({ icon: Icon, label, href }) {
  const clases = "flex h-7 w-7 items-center justify-center text-bone transition-colors"

  if (!href) {
    return (
      <span className={`${clases} cursor-default opacity-70`} title={`${label} — pendiente`}>
        <Icon className="h-3.5 w-3.5" />
        <span className="sr-only">{label} (enlace pendiente)</span>
      </span>
    )
  }

  return (
    <a
      href={href}
      target="_blank"
      rel="noopener noreferrer"
      className={`${clases} hover:text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember`}
    >
      <Icon className="h-3.5 w-3.5" />
      <span className="sr-only">{label}</span>
    </a>
  )
}

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
      /* CTA en PINE con texto blanco — redefinido a pedido (ago 2026): los
         botones de bid dejan el CLAY y toman el verde oscuro de marca, que
         además resuelve de una el viejo problema de contraste del clay
         (blanco sobre pine pasa AA sobrado, ~11:1). La skin conserva el
         nombre "ember" para no tocar los call sites. El hover profundiza a
         ink-900, el mismo escalón que usa la franja de utilidad. */
      "border-white/25 bg-ink text-white cta-relief",
      "hover:cta-relief-tight hover:bg-ink-900 hover:-translate-y-px",
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
        // Sin rounded-full: el branding no tiene una sola forma redondeada,
        // y este botón vive dentro del hero, donde la píldora desentonaba
        // contra los bloques rectos de todas las secciones.
        "group inline-flex items-center justify-center gap-2.5 border-2",
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
        style={isLight ? undefined : { color: "#ffffff" }}
        className={[
          "relative flex items-center gap-1.5 py-1 text-[0.78rem] font-bold uppercase tracking-[0.13em] transition-colors",
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
            isLight ? "bg-white/95 ring-1 ring-mist" : "bg-[#232322]/95 ring-1 ring-white/10",
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
  license = "UT License S330",

  /* Redes sociales. Cada clave acepta una URL; las que estén vacías se
     dibujan como icono inerte, no como enlace roto. Se llenan desde
     header.php cuando el cliente entregue los perfiles (Pendiente 13). */
  social = {},
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
  /* ═══ SUPERFICIES DEL NAVBAR: NEGRO NEUTRO, NO PINE ═══
     Este fue el hallazgo del debug de ago 2026: el "verde" del navbar nunca
     fue el texto — era la superficie. bg-ink apunta a PINE (#2F342D), un
     negro con base verde POR DISEÑO de la paleta, y sobre una franja de
     120px de alto ese matiz se lee como barra verde sin importar de qué
     color vayan las letras.

     El navbar (y solo el navbar) pasa a un par de neutros sin canal verde
     dominante: #232322 la barra, #171716 la franja de utilidad — el mismo
     escalón que tenían pine y pine-900, en neutro. Son valores literales y
     no tokens del tema a propósito: la paleta no tiene un oscuro neutro y
     agregárselo invitaría a usarlo en secciones, donde el pine SÍ es la
     decisión correcta. */
  const barSurface = isLight
    ? [
        "ring-1 ring-mist bg-white/95",
        docked ? "supports-[backdrop-filter]:bg-white/95" : "",
      ].join(" ")
    : [
        "ring-1 ring-white/10 bg-[#232322]/95",
        docked ? "supports-[backdrop-filter]:bg-[#232322]/95" : "",
      ].join(" ")

  /* Los enlaces del menú van en BLANCO PURO sobre la barra oscura. Es la
     excepción deliberada a la regla "nunca blanco puro" del tema: el bone
     (#F1F0E6) es un hueso CÁLIDO con base verdosa, y sobre el pine de la
     barra esa base se amplifica — incluso a plena opacidad se seguía
     leyendo verdoso. A este tamaño (10-11px en mayúsculas) el matiz del
     hueso no aporta nada y el blanco limpio es lo único que se lee neutro.
     El estado activo se distingue por el subrayado ember.

     linkStyle es el REFUERZO INLINE del mismo blanco: durante el debug de
     ago 2026 los cambios de CSS no llegaban al navegador (stylesheet
     cacheado) pero los de JS sí — el icono de Google lo probó. Un estilo
     inline viaja en el bundle JS, así que pinta blanco aunque el CSS
     compilado que reciba el navegador sea viejo. Cuando el encolado del
     CSS lleve versión (?ver= desde index.asset.php) este refuerzo se puede
     quitar; mientras tanto es inocuo: dice lo mismo que la clase. */
  const linkBase = isLight ? "text-ink/70 hover:text-ink" : "text-white"
  const linkActive = isLight ? "text-ink" : "text-white"
  const linkStyle = isLight ? undefined : { color: "#ffffff" }

  return (
    <>
      <header className="fixed inset-x-0 top-0 z-50">
        {/* ── Franja de utilidad ──
            Va pegada a la barra, sin aire entre las dos: juntas forman un solo
            bloque oscuro. Antes la barra flotaba con px-4 pt-4 y se leía como
            una pieza separada apoyada sobre la franja — lenguaje de interfaz,
            no de marca. En la valla y en la van los módulos se tocan.

            El padding lateral es el mismo de las secciones de la página
            (px-5 / sm:px-8 / lg:px-10), así que el número de licencia arranca
            en la misma vertical que los titulares de abajo.

            Sigue colapsando al hacer scroll: eso no cambia. Lo que cambia es
            que al colapsar no queda un hueco, porque nunca lo hubo. ── */}
        <div
          className={[
            /* Neutro más oscuro que la barra (#171716 contra #232322): el
               mismo escalón que hacían pine-900 y pine, sin la base verde.
               Ver la nota de barSurface. */
            "overflow-hidden border-b border-white/10 bg-[#171716] text-bone",
            "transition-[max-height,opacity] duration-300 ease-out motion-reduce:transition-none",
            docked ? "max-h-0 opacity-0" : "max-h-12 opacity-100",
          ].join(" ")}
        >
          {/* Tres zonas: contacto directo · ubicación · credencial y redes.

              La rejilla es de tres columnas y no un flex con justify-between,
              porque con flex el centro se corre según cuánto midan los
              extremos — y el bloque de la izquierda cambia de ancho con el
              teléfono y el correo. Con grid-cols-3 el geotag queda centrado
              contra la página, no contra sus vecinos.

              El orden no es arbitrario: teléfono y correo primero porque son
              las dos acciones que un estimador toma desde acá; la dirección
              en el centro porque es contexto, no acción; y a la derecha lo que
              se consulta pero no se usa — la licencia y las redes. */}
          <div className="grid grid-cols-[1fr_auto] items-center gap-4 px-5 py-1.5 sm:px-8 lg:grid-cols-3 lg:px-10">

            {/* ── Izquierda: teléfono y correo ── */}
            <div className="flex items-center justify-start gap-2">
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
            </div>

            {/* ── Centro: la dirección ──
                Se oculta por debajo de lg. Es el dato más largo de los tres
                y el único que no es una acción: cuando el espacio aprieta, es
                el primero que sobra. Sigue en el footer y en el bloque de
                área de servicio. */}
            <div className="hidden items-center justify-center lg:flex">
              <ContactPlate
                icon={PinIcon}
                label={address}
                srLabel={`Open ${address} in Google Maps`}
                href={mapsHref}
                external
              />
            </div>

            {/* ── Derecha: licencia y redes ── */}
            <div className="flex items-center justify-end gap-3">
              <span className="hidden text-[0.68rem] font-medium uppercase tracking-[0.14em] text-bone/55 xl:inline">
                {license}
              </span>

              {/* El filete solo aparece cuando hay algo a su izquierda que
                  separar. */}
              <span className="hidden h-4 w-px bg-white/15 xl:inline-block" aria-hidden="true"></span>

              <div className="flex items-center gap-0.5">
                <SocialLink icon={FacebookIcon}  label="Facebook"  href={social.facebook} />
                <SocialLink icon={InstagramIcon} label="Instagram" href={social.instagram} />
                <SocialLink icon={GoogleIcon}    label="Google Business Profile" href={social.google} />
              </div>
            </div>
          </div>
        </div>

        {/* ── Barra principal ── */}
        {/* Sin padding exterior en ningún estado. Era lo que separaba la barra
            de la franja y lo que la hacía flotar. */}
        <div>
          <nav
            aria-label="Primary"
            className={[
              barSurface,
              "flex items-center justify-between gap-6",
              "transition-all duration-300 ease-out motion-reduce:transition-none",
              /* Ancho completo y bordes rectos en los dos estados. Lo único
                 que cambia al acoplarse es el alto —py-3 contra py-4— y el
                 desenfoque, que aparece cuando la barra empieza a dejar ver
                 el contenido por detrás. */
              "px-5 sm:px-8 lg:px-10",
              docked
                ? "py-3 shadow-[0_1px_0_0_rgba(0,0,0,0.25)] backdrop-blur-xl"
                : "py-4",
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
                      style={linkStyle}
                      className={[
                        "relative py-1 text-[0.78rem] font-bold uppercase tracking-[0.13em] transition-colors",
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

      {/* ── Panel móvil ──
          Sigue al tema del navbar (ago 2026): con theme="light" el panel es
          claro — fondo blanco, enlaces en ink — igual que la barra de
          escritorio. La rama oscura se conserva por la prop. */}
      <div
        id="mobile-nav"
        ref={panelRef}
        role="dialog"
        aria-modal="true"
        aria-label="Menu"
        hidden={!open}
        className={[
          "fixed inset-0 z-[60] flex flex-col lg:hidden",
          isLight ? "bg-white text-ink" : "bg-[#232322] text-bone",
        ].join(" ")}
      >
        <div className={`flex items-center justify-between border-b px-5 py-4 ${isLight ? "border-ink/10" : "border-white/10"}`}>
          {logo ? (
            <img src={logo} alt="EC Landscaping" className="h-8 w-auto" />
          ) : (
            <Wordmark theme={theme} />
          )}
          <button
            type="button"
            onClick={() => setOpen(false)}
            className={[
              "rounded-md px-3 py-2 text-[0.7rem] font-bold uppercase tracking-[0.12em]",
              "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
              isLight ? "text-ink ring-1 ring-ink/15" : "text-bone ring-1 ring-white/15",
            ].join(" ")}
          >
            Close
          </button>
        </div>

        <nav aria-label="Primary mobile" className="flex-1 overflow-y-auto px-5 py-6">
          <ul className={`flex flex-col divide-y ${isLight ? "divide-ink/10" : "divide-white/10"}`}>
            {links.map(link => (
              <li key={link.label}>
                {/* En el panel móvil el submenú no se despliega: se muestra
                    entero, indentado. Una pantalla chica ya obliga a abrir un
                    menú; obligar a abrir un segundo nivel dentro es cobrar dos
                    veces por el mismo destino. */}
                {link.children && link.children.length ? (
                  <div className="py-4">
                    <p className={`font-display text-2xl font-bold tracking-tight ${isLight ? "text-ink/50" : "text-bone/50"}`}>
                      {link.label}
                    </p>
                    <ul className={`mt-3 flex flex-col gap-1 border-l pl-4 ${isLight ? "border-ink/15" : "border-white/15"}`}>
                      {link.children.map(child => (
                        <li key={child.href}>
                          <a
                            href={child.href}
                            onClick={() => setOpen(false)}
                            className={`block py-2 text-base font-medium focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember ${isLight ? "text-ink" : "text-bone"}`}
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
                    className={`block py-4 font-display text-2xl font-bold tracking-tight focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember ${isLight ? "text-ink" : "text-bone"}`}
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
                  className={`block py-4 text-sm font-semibold uppercase tracking-[0.14em] ${isLight ? "text-ink/50" : "text-bone/50"}`}
                >
                  Residential <span aria-hidden="true">→</span>
                </a>
              </li>
            )}
          </ul>
        </nav>

        <div className={`border-t px-5 py-5 ${isLight ? "border-ink/10" : "border-white/10"}`}>
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
                  className={[
                    "group flex items-center gap-3 rounded-md border px-3 py-2.5 text-sm",
                    "transition-[box-shadow,transform,background-color] duration-150",
                    "hover:-translate-y-px active:translate-y-0",
                    "motion-reduce:transform-none motion-reduce:transition-none",
                    isLight
                      ? "border-ink/10 bg-ink/[0.03] text-ink/80 bevel-tile hover:bevel-tile-raised active:shadow-none"
                      : "border-white/10 bg-white/[0.04] text-bone/80 hover:bevel hover:bg-white/[0.09] active:bevel-pressed",
                  ].join(" ")}
                >
                  <item.icon className={`h-4 w-4 shrink-0 ${isLight ? "text-ember-600" : "text-ember/80 group-hover:text-ember"}`} />
                  <span>{item.label}</span>
                </a>
              </li>
            ))}
          </ul>
          <p className={`mb-4 text-[0.65rem] font-medium uppercase tracking-[0.14em] ${isLight ? "text-ink/50" : "text-bone/50"}`}>
            {license}
          </p>
          <div className="grid grid-cols-2 gap-3">
            <a
              href={telHref}
              className={`border-2 py-3 text-center text-[0.8125rem] font-medium uppercase tracking-[0.4px] ${isLight ? "border-ink/30 text-ink" : "border-white/20 text-bone"}`}
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
        <div className={[
          "fixed inset-x-0 bottom-0 z-40 grid grid-cols-2 gap-px border-t lg:hidden",
          isLight ? "border-ink/10 bg-white" : "border-white/10 bg-[#232322]",
        ].join(" ")}>
          <a
            href={telHref}
            className={`py-4 text-center text-[0.72rem] font-bold uppercase tracking-[0.12em] ${isLight ? "text-ink" : "text-bone"}`}
          >
            Call {phone}
          </a>
          <a
            href={bidHref}
            data-bid-cta=""
            className="bg-ink py-4 text-center text-[0.72rem] font-bold uppercase tracking-[0.12em] text-white"
          >
            Request a Bid
          </a>
        </div>
      )}
    </>
  )
}