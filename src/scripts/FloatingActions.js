import React, { useCallback, useEffect, useRef, useState } from "react"

/**
 * ContactForm — "Request a bid" · EC Landscaping
 *
 * Un componente, tres usos, combinando cuatro props:
 *
 *   Hero          variant="inline"  persistent  density="compact"
 *                 inlineMinWidth="(min-width: 1280px)"
 *                 Siempre visible en la columna derecha del hero. Por debajo
 *                 del umbral no hay sitio, así que cae a modal y el CTA del
 *                 hero vuelve a ser un disparador.
 *
 *   Página /contact  variant="inline" persistent density="comfortable"
 *                 Sin umbral: la página es suya, no compite con nada.
 *
 *   (sin uso hoy)  variant="modal"
 *                 El modal global se retiró: su trabajo lo hace /contact.
 *                 La rama sigue en el archivo, a una prop de distancia.
 *
 * Props:
 *   variant         "inline" | "modal"
 *   persistent      inline: se dibuja siempre, sin disparador ni botón de
 *                   cerrar. El disparador, si existe, pasa a enfocar el primer
 *                   campo en lugar de abrir.
 *   density         "compact" | "comfortable" — decide padding y columnas.
 *                   No se deriva del viewport: las variantes sm: de Tailwind
 *                   miden la ventana, no el contenedor, y el panel del hero
 *                   mide 27rem dentro de una ventana de 1280+.
 *   inlineMinWidth  media query. Por debajo, la variante inline cae a modal.
 *                   null = nunca cae.
 *   trigger         selector de los disparadores. Vacío o null = la
 *                   instancia no intercepta clics y los enlaces navegan.
 *   endpoint        URL del REST route que recibe el envío
 *   nonce           nonce de wp_rest, viaja en la cabecera X-WP-Nonce
 *   phone           teléfono visible
 */

const SCOPES = [
  "Landscape installation",
  "Hardscape & concrete",
  "Grounds maintenance & snow",
  "Water-wise retrofit",
  "More than one of these",
]

const BUYERS = [
  "General contractor",
  "Property manager",
  "HOA board",
  "Owner / developer",
  "Other",
]

const EMPTY = {
  name: "",
  company: "",
  email: "",
  phone: "",
  buyer: "",
  scope: "",
  site: "",
  date: "",
  details: "",
  // Honeypot: invisible para una persona, irresistible para un bot que
  // rellena todo lo que encuentra. Si viene con algo, el servidor descarta.
  website: "",
}

const ANIM_MS = 220

function validate(values) {
  const errors = {}
  if (!values.name.trim()) errors.name = "Tell us who you are."
  if (!values.email.trim()) errors.email = "We need an email to send the bid to."
  else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(values.email.trim())) errors.email = "That email doesn’t look right."
  if (!values.site.trim()) errors.site = "Where is the site?"
  if (!values.details.trim()) errors.details = "A line or two about the scope is enough."
  return errors
}

/* ── Campos ─────────────────────────────────────────────────────────
   Etiqueta siempre visible, nunca placeholder-como-etiqueta: el
   placeholder desaparece al escribir y el usuario pierde la referencia
   justo cuando revisa lo que puso. */

function Field({ id, label, error, children, className = "" }) {
  return (
    <div className={className}>
      <label
        htmlFor={id}
        className="mb-1.5 block text-[0.65rem] font-semibold uppercase tracking-[0.14em] text-bone/55"
      >
        {label}
      </label>
      {children}
      {error && (
        <p id={`${id}-error`} className="mt-1.5 text-xs text-ember">
          {error}
        </p>
      )}
    </div>
  )
}

const controlBase = [
  "w-full rounded-md border bg-white/[0.04] px-3.5 py-2.5 text-sm text-bone",
  "placeholder:text-bone/30",
  "transition-colors duration-150",
  "focus:border-ember focus:bg-white/[0.07] focus:outline-none",
].join(" ")

function control(hasError) {
  return `${controlBase} ${hasError ? "border-ember" : "border-white/12"}`
}

/* ── Media query como hook ──
   Se escucha el cambio, no solo el valor inicial: si alguien redimensiona la
   ventana con el panel abierto, tiene que convertirse en modal en lugar de
   quedar montado encima del titular. */
function useMediaQuery(query) {
  const [matches, setMatches] = useState(() => {
    // Sin consulta, siempre coincide: es la forma de decir "no hay umbral"
    // sin ramificar en el sitio donde se usa.
    if (!query) return true
    if (typeof window === "undefined" || !window.matchMedia) return false
    return window.matchMedia(query).matches
  })

  useEffect(() => {
    if (!query || !window.matchMedia) return
    const mq = window.matchMedia(query)
    const onChange = event => setMatches(event.matches)
    setMatches(mq.matches)
    if (mq.addEventListener) mq.addEventListener("change", onChange)
    else mq.addListener(onChange)
    return () => {
      if (mq.removeEventListener) mq.removeEventListener("change", onChange)
      else mq.removeListener(onChange)
    }
  }, [query])

  return matches
}

export default function ContactForm({
  variant = "modal",
  persistent = false,
  density = "comfortable",
  inlineMinWidth = null,
  trigger = null,
  endpoint = "/wp-json/ec/v1/bid",
  nonce = "",
  phone = "(385) 240-3907",
}) {
  const wideEnough = useMediaQuery(inlineMinWidth)

  // Persistente por debajo del umbral: no hay panel y tampoco hay modal al
  // que caer. El componente se aparta —ni renderiza ni intercepta clics— y
  // el CTA se comporta como el enlace que es, navegando a /contact.
  const standDown = variant === "inline" && persistent && !wideEnough
  const asModal = variant !== "inline" || (!wideEnough && !persistent)
  const alwaysOn = persistent && !standDown

  const [mounted, setMounted] = useState(alwaysOn)
  const [entered, setEntered] = useState(alwaysOn)
  const [values, setValues] = useState(EMPTY)
  const [errors, setErrors] = useState({})
  const [status, setStatus] = useState("idle") // idle | sending | sent | failed

  const panelRef = useRef(null)
  const firstFieldRef = useRef(null)
  const returnFocusTo = useRef(null)
  const closeTimer = useRef(null)

  // Al cruzar el umbral en un redimensionado, el panel tiene que aparecer o
  // desaparecer solo. Sin esto queda montado como modal, o desmontado en una
  // ventana que ya tiene sitio para él.
  useEffect(() => {
    if (alwaysOn) {
      setMounted(true)
      setEntered(true)
    }
  }, [alwaysOn])

  const telHref = `tel:+1${phone.replace(/\D/g, "")}`

  const reduced =
    typeof window !== "undefined" &&
    window.matchMedia &&
    window.matchMedia("(prefers-reduced-motion: reduce)").matches

  const close = useCallback(() => {
    // Un panel permanente no se cierra. Sin esta guarda, Escape lo desmontaría
    // y no habría forma de recuperarlo sin recargar.
    if (alwaysOn) return
    setEntered(false)
    // Se desmonta después de la transición de salida, no durante: quitar el
    // nodo en el primer frame haría que el panel desaparezca de golpe y la
    // animación de cierre no se vea nunca.
    if (closeTimer.current) window.clearTimeout(closeTimer.current)
    closeTimer.current = window.setTimeout(
      () => {
        setMounted(false)
        if (returnFocusTo.current && returnFocusTo.current.focus) {
          returnFocusTo.current.focus()
        }
      },
      reduced ? 0 : ANIM_MS
    )
  }, [reduced, alwaysOn])

  /* ── Disparadores ──
     Con el panel permanente el formulario ya está en pantalla, así que el CTA
     no tiene nada que abrir: lleva el foco al primer campo. El botón sigue
     sirviendo —es lo que la gente busca con la vista— pero ahora señala en
     lugar de revelar. */
  useEffect(() => {
    // Sin panel y sin modal no hay nada que hacer con el clic: dejar que el
    // enlace navegue es exactamente el comportamiento correcto.
    if (standDown) return

    // trigger vacío = esta instancia no intercepta nada. Es lo que usa el
    // hero: sus CTA tienen que llevar a /contact como cualquier otro enlace,
    // aunque el formulario esté visible al lado.
    if (!trigger) return

    const focusFirst = () => {
      if (!firstFieldRef.current) return
      firstFieldRef.current.focus()
      firstFieldRef.current.scrollIntoView({
        block: "nearest",
        behavior: reduced ? "auto" : "smooth",
      })
    }

    const onClick = event => {
      const link = event.target.closest(trigger)
      if (!link) return
      event.preventDefault()
      if (alwaysOn) {
        focusFirst()
        return
      }
      returnFocusTo.current = link
      if (closeTimer.current) window.clearTimeout(closeTimer.current)
      setMounted(true)
    }
    const onEvent = () => {
      if (alwaysOn) {
        focusFirst()
        return
      }
      returnFocusTo.current = document.activeElement
      if (closeTimer.current) window.clearTimeout(closeTimer.current)
      setMounted(true)
    }
    document.addEventListener("click", onClick)
    document.addEventListener("ec:open-bid", onEvent)
    return () => {
      document.removeEventListener("click", onClick)
      document.removeEventListener("ec:open-bid", onEvent)
    }
  }, [trigger, alwaysOn, reduced, standDown])

  /* ── Entrada: montar en un frame, animar en el siguiente ──
     Si se aplicara el estado final en el mismo frame del montaje, el
     navegador no tendría un estado inicial contra el que interpolar y no
     habría transición. */
  useEffect(() => {
    if (!mounted) return
    const raf = window.requestAnimationFrame(() => setEntered(true))
    return () => window.cancelAnimationFrame(raf)
  }, [mounted])

  /* ── Escape, foco y bloqueo de scroll ──
     El bloqueo y la trampa de foco son exclusivos del modal. El panel del
     hero no es modal: la página sigue siendo suya, se puede scrollear y
     tabular fuera del formulario sin cerrarlo. */
  useEffect(() => {
    if (!mounted) return

    const previousOverflow = document.body.style.overflow
    if (asModal) document.body.style.overflow = "hidden"

    const onKey = event => {
      if (event.key === "Escape") {
        close()
        return
      }
      if (!asModal || event.key !== "Tab" || !panelRef.current) return

      const focusables = panelRef.current.querySelectorAll(
        'a[href], button:not([disabled]), input:not([type="hidden"]), select, textarea, [tabindex]:not([tabindex="-1"])'
      )
      if (!focusables.length) return

      const first = focusables[0]
      const last = focusables[focusables.length - 1]

      if (event.shiftKey && document.activeElement === first) {
        event.preventDefault()
        last.focus()
      } else if (!event.shiftKey && document.activeElement === last) {
        event.preventDefault()
        first.focus()
      }
    }

    document.addEventListener("keydown", onKey)

    // El foco entra al primer campo, no al panel: se puede empezar a escribir
    // sin un tabulador de por medio.
    //
    // Salvo cuando es permanente: ahí el formulario no fue invocado por nadie,
    // así que robarle el foco al cargar la página secuestraría el teclado y
    // saltaría el scroll al panel antes de que se lea el titular.
    const raf = window.requestAnimationFrame(() => {
      if (!alwaysOn && firstFieldRef.current) firstFieldRef.current.focus()
    })

    return () => {
      document.body.style.overflow = previousOverflow
      document.removeEventListener("keydown", onKey)
      window.cancelAnimationFrame(raf)
    }
  }, [mounted, asModal, alwaysOn, close, status])

  useEffect(
    () => () => {
      if (closeTimer.current) window.clearTimeout(closeTimer.current)
    },
    []
  )

  const set = key => event => {
    const { value } = event.target
    setValues(prev => ({ ...prev, [key]: value }))
    setErrors(prev => (prev[key] ? { ...prev, [key]: undefined } : prev))
  }

  const submit = async event => {
    event.preventDefault()
    if (status === "sending") return

    const found = validate(values)
    setErrors(found)
    if (Object.keys(found).length) {
      // Foco al primer campo con problema: si el formulario es largo, el
      // mensaje de error puede quedar fuera de pantalla.
      const firstKey = Object.keys(found)[0]
      const node = panelRef.current && panelRef.current.querySelector(`#ec-${firstKey}`)
      if (node) node.focus()
      return
    }

    setStatus("sending")
    try {
      const response = await fetch(endpoint, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          ...(nonce ? { "X-WP-Nonce": nonce } : {}),
        },
        body: JSON.stringify(values),
      })
      if (!response.ok) throw new Error(`HTTP ${response.status}`)
      setStatus("sent")
    } catch (error) {
      console.warn("[ec] no se pudo enviar el formulario", error)
      setStatus("failed")
    }
  }

  if (standDown || !mounted) return null

  // La densidad viene por prop, no del viewport: las variantes sm: de Tailwind
  // miden la ventana, no el contenedor, y el panel del hero mide 27rem dentro
  // de una ventana de 1280+. Un modal siempre es cómodo; el hero, compacto.
  const compact = asModal ? false : density === "compact"

  const padX = compact ? "px-5" : "px-6 sm:px-8"
  const gridCols = compact ? "grid-cols-2 gap-4" : "gap-5 sm:grid-cols-2"
  const spanFull = compact ? "col-span-2" : "sm:col-span-2"

  const body = (
    <>
      {/* ── Cabecera ──
          En compacto se cae el eyebrow y el título baja un escalón: en un
          panel de 27rem, "Request a bid" sobre "Send us the plans." son dos
          líneas de encabezado comiéndose el alto que necesitan los campos.
          El botón que lo abrió ya dice Request a bid. */}
      <div className={`flex items-start justify-between gap-4 border-b border-white/10 ${padX} ${compact ? "py-4" : "py-5"}`}>
        <div>
          {!compact && (
            <p className="mb-1.5 text-[0.65rem] font-semibold uppercase tracking-[0.18em] text-ember">
              Request a bid
            </p>
          )}
          <h2
            id="ec-bid-title"
            className={`font-display font-bold tracking-tight text-bone ${compact ? "text-xl" : "text-2xl sm:text-3xl"}`}
          >
            Send us the plans.
          </h2>
        </div>
        {/* Sin botón de cerrar cuando es permanente: no habría forma de
            volver a abrirlo, y un control que rompe la página es peor que
            no tener control. */}
        {!alwaysOn && (
          <button
            type="button"
            onClick={close}
            aria-label="Close"
            className="-mr-2 -mt-1 flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-bone/60 transition-colors hover:bg-white/10 hover:text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
          >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" aria-hidden="true" className="h-5 w-5">
              <path d="M6 6l12 12M18 6L6 18" />
            </svg>
          </button>
        )}
      </div>

      {status === "sent" ? (
        /* ── Éxito ──
           No se cierra solo a los tres segundos: el usuario acaba de entregar
           los datos de un proyecto y merece leer que llegaron. */
        <div className={`${padX} py-12 text-center`}>
          <div className="mx-auto mb-5 flex h-12 w-12 items-center justify-center rounded-full bg-ember/15">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true" className="h-6 w-6 text-ember">
              <path d="m5 13 4 4L19 7" />
            </svg>
          </div>
          <p className="font-display text-xl font-bold tracking-tight text-bone">
            Got it. We’ll be in touch.
          </p>
          <p className="mx-auto mt-3 max-w-sm text-sm leading-relaxed text-bone/70">
            You’ll hear back from the owner or the estimator. If it’s urgent, call the yard.
          </p>
          <a
            href={telHref}
            className="mt-6 inline-block text-lg font-semibold tabular-nums text-bone underline decoration-ember decoration-2 underline-offset-8"
          >
            {phone}
          </a>
        </div>
      ) : (
        /* El cuerpo scrollea, la cabecera y el pie se quedan fijos: ni en un
           teléfono ni en el panel del hero entra el formulario completo, y el
           botón de enviar no puede quedar enterrado al final del scroll. */
        <form onSubmit={submit} noValidate className="flex min-h-0 flex-1 flex-col">
          <div className={`grid min-h-0 flex-1 overflow-y-auto ${padX} ${gridCols} ${compact ? "py-5" : "py-6"}`}>

            <Field id="ec-name" label="Name" error={errors.name}>
              <input
                ref={firstFieldRef}
                id="ec-name"
                type="text"
                autoComplete="name"
                value={values.name}
                onChange={set("name")}
                aria-invalid={!!errors.name}
                aria-describedby={errors.name ? "ec-name-error" : undefined}
                className={control(errors.name)}
              />
            </Field>

            <Field id="ec-company" label="Company">
              <input
                id="ec-company"
                type="text"
                autoComplete="organization"
                value={values.company}
                onChange={set("company")}
                className={control(false)}
              />
            </Field>

            <Field id="ec-email" label="Email" error={errors.email}>
              <input
                id="ec-email"
                type="email"
                autoComplete="email"
                value={values.email}
                onChange={set("email")}
                aria-invalid={!!errors.email}
                aria-describedby={errors.email ? "ec-email-error" : undefined}
                className={control(errors.email)}
              />
            </Field>

            <Field id="ec-phone" label="Phone">
              <input
                id="ec-phone"
                type="tel"
                autoComplete="tel"
                value={values.phone}
                onChange={set("phone")}
                className={control(false)}
              />
            </Field>

            <Field id="ec-buyer" label="You are">
              <select
                id="ec-buyer"
                value={values.buyer}
                onChange={set("buyer")}
                className={control(false)}
              >
                <option value="">Select one</option>
                {BUYERS.map(option => (
                  <option key={option} value={option} className="bg-ink">
                    {option}
                  </option>
                ))}
              </select>
            </Field>

            <Field id="ec-scope" label="Scope">
              <select
                id="ec-scope"
                value={values.scope}
                onChange={set("scope")}
                className={control(false)}
              >
                <option value="">Select one</option>
                {SCOPES.map(option => (
                  <option key={option} value={option} className="bg-ink">
                    {option}
                  </option>
                ))}
              </select>
            </Field>

            <Field id="ec-site" label="Site location" error={errors.site}>
              <input
                id="ec-site"
                type="text"
                placeholder={compact ? "City or address" : "City, or the project address"}
                value={values.site}
                onChange={set("site")}
                aria-invalid={!!errors.site}
                aria-describedby={errors.site ? "ec-site-error" : undefined}
                className={control(errors.site)}
              />
            </Field>

            <Field id="ec-date" label="Target date">
              <input
                id="ec-date"
                type="date"
                value={values.date}
                onChange={set("date")}
                className={`${control(false)} [color-scheme:dark]`}
              />
            </Field>

            <Field id="ec-details" label="Scope and schedule" error={errors.details} className={spanFull}>
              <textarea
                id="ec-details"
                rows={compact ? 3 : 4}
                placeholder={compact ? "Site, scope and target date." : "What’s the site, what’s the scope, and when do you need it done?"}
                value={values.details}
                onChange={set("details")}
                aria-invalid={!!errors.details}
                aria-describedby={errors.details ? "ec-details-error" : undefined}
                className={`${control(errors.details)} resize-y`}
              />
            </Field>

            {/* Honeypot. aria-hidden y fuera del recorrido de Tab: una persona
                no lo ve ni lo alcanza, un bot lo rellena. */}
            <div className="absolute left-[-9999px]" aria-hidden="true">
              <label htmlFor="ec-website">Website</label>
              <input
                id="ec-website"
                type="text"
                tabIndex={-1}
                autoComplete="off"
                value={values.website}
                onChange={set("website")}
              />
            </div>
          </div>

          {/* ── Pie ──
              En compacto el botón va a todo el ancho y la línea del teléfono
              debajo. En una fila de 27rem menos padding, "Send it" junto al
              teléfono parte las dos en dos renglones cada una. */}
          <div className={`shrink-0 border-t border-white/10 ${padX} ${compact ? "py-4" : "py-5"}`}>
            {status === "failed" && (
              <p role="alert" className="mb-4 rounded-md border border-ember/40 bg-ember/10 px-4 py-3 text-sm text-bone">
                That didn’t go through. Try again, or call us at{" "}
                <a href={telHref} className="font-medium underline decoration-ember decoration-2 underline-offset-4">
                  {phone}
                </a>
                .
              </p>
            )}

            <div
              className={
                compact
                  ? "flex flex-col gap-3"
                  : "flex flex-col-reverse items-stretch gap-4 sm:flex-row sm:items-center sm:justify-between"
              }
            >
              <button
                type="submit"
                disabled={status === "sending"}
                className={[
                  "cta-relief group inline-flex items-center justify-center gap-2.5 rounded-full border-2 border-white/25 bg-ember py-3.5 pl-7 pr-6",
                  "text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink whitespace-nowrap",
                  "transition-all duration-200 ease-out",
                  "hover:cta-relief-tight hover:bg-ember-600 hover:-translate-y-px",
                  "active:translate-y-0 active:shadow-none",
                  "disabled:pointer-events-none disabled:opacity-60",
                  "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
                  "motion-reduce:transform-none motion-reduce:transition-none",
                  compact ? "order-first w-full" : "",
                ].join(" ")}
              >
                {status === "sending" ? "Sending…" : "Send it"}
                {status !== "sending" && (
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true" className="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transform-none">
                    <path d="M5 12h13M13 6l6 6-6 6" />
                  </svg>
                )}
              </button>

              <p className={`text-xs leading-relaxed text-bone/50 ${compact ? "text-center" : ""}`}>
                Prefer to talk it through?{" "}
                <a href={telHref} className="whitespace-nowrap font-medium text-bone/80 underline decoration-ember decoration-2 underline-offset-4">
                  {phone}
                </a>
              </p>
            </div>
          </div>
        </form>
      )}
    </>
  )

  /* ── Variante inline: panel dentro del hero ──
     Entra desplazándose desde la derecha. No lleva velo ni role="dialog":
     no bloquea la página, así que anunciarlo como diálogo modal sería
     mentirle al lector de pantalla. Va como región con nombre. */
  if (!asModal) {
    return (
      <div
        ref={panelRef}
        role="region"
        aria-labelledby="ec-bid-title"
        className={[
          "pointer-events-auto flex max-h-full w-full flex-col overflow-hidden rounded-xl",
          "bg-ink/95 text-bone shadow-2xl shadow-ink/40 ring-1 ring-white/12 backdrop-blur-md",
          // Permanente no anima: el panel no entra desde ningún lado, ya
          // estaba ahí cuando cargó la página.
          alwaysOn
            ? ""
            : [
                "transition-[opacity,transform] ease-out motion-reduce:transition-none",
                entered ? "translate-x-0 opacity-100" : "translate-x-8 opacity-0",
              ].join(" "),
        ].join(" ")}
        style={alwaysOn ? undefined : { transitionDuration: `${ANIM_MS}ms` }}
      >
        {body}
      </div>
    )
  }

  /* ── Variante modal ──
     Hoy ninguna instancia la usa: el modal global se retiró y su trabajo lo
     hace la página /contact. Se conserva porque sigue estando a una prop de
     distancia —variant="modal" en cualquier nodo de montaje— y borrarla
     costaría más que mantenerla. Si en tres meses sigue sin usarse, sacala. */
  return (
    <div className="fixed inset-0 z-[80] flex items-end justify-center sm:items-center sm:p-6">
      {/* Velo. Cierra al hacer clic, pero es aria-hidden y no un botón: para
          teclado ya está Escape, y un botón acá aparecería en el recorrido
          de Tab sin nombre útil. */}
      <div
        className={[
          "absolute inset-0 bg-ink/80 backdrop-blur-sm",
          "transition-opacity ease-out motion-reduce:transition-none",
          entered ? "opacity-100" : "opacity-0",
        ].join(" ")}
        style={{ transitionDuration: `${ANIM_MS}ms` }}
        onClick={close}
        aria-hidden="true"
      />

      <div
        ref={panelRef}
        role="dialog"
        aria-modal="true"
        aria-labelledby="ec-bid-title"
        className={[
          "relative flex max-h-[92svh] w-full flex-col overflow-hidden rounded-t-xl",
          "bg-ink text-bone shadow-2xl ring-1 ring-white/10 sm:max-w-2xl sm:rounded-xl",
          "transition-[opacity,transform] ease-out motion-reduce:transition-none",
          entered ? "translate-y-0 opacity-100" : "translate-y-6 opacity-0",
        ].join(" ")}
        style={{ transitionDuration: `${ANIM_MS}ms` }}
      >
        {body}
      </div>
    </div>
  )
}