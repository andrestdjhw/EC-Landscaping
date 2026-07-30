import React, { useCallback, useEffect, useRef, useState } from "react"

/**
 * ContactForm — modal de "Request a bid" · EC Landscaping
 *
 * Se abre interceptando cualquier <a href="#request-a-bid"> de la página.
 * Esa decisión es la que evita tocar Navbar.js, Footer.js y header.php: los
 * tres ya apuntan a esa ancla y siguen funcionando sin cambios. El bloque 12
 * se eliminó, así que esos enlaces no llevaban a ninguna parte — ahora abren
 * el modal.
 *
 * También escucha el evento 'ec:open-bid' por si más adelante hace falta
 * abrirlo desde otro lado (el chatbot, por ejemplo) sin un enlace de por medio.
 *
 * Props (desde footer.php vía data-props):
 *   endpoint   URL del REST route que recibe el envío
 *   nonce      nonce de wp_rest, va en la cabecera X-WP-Nonce
 *   phone      teléfono visible, para la salida alterna y el estado de éxito
 *   trigger    selector de los disparadores. Default: a[href="#request-a-bid"]
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

const controlClass = [
  "w-full rounded-md border bg-white/[0.04] px-3.5 py-2.5 text-sm text-bone",
  "placeholder:text-bone/30",
  "transition-colors duration-150",
  "focus:border-ember focus:bg-white/[0.07] focus:outline-none",
].join(" ")

function control(hasError) {
  return `${controlClass} ${hasError ? "border-ember" : "border-white/12"}`
}

export default function ContactForm({
  endpoint = "/wp-json/ec/v1/bid",
  nonce = "",
  phone = "(385) 240-3907",
  trigger = 'a[href="#request-a-bid"]',
}) {
  const [open, setOpen] = useState(false)
  const [values, setValues] = useState(EMPTY)
  const [errors, setErrors] = useState({})
  const [status, setStatus] = useState("idle") // idle | sending | sent | failed

  const panelRef = useRef(null)
  const firstFieldRef = useRef(null)
  const returnFocusTo = useRef(null)

  const telHref = `tel:+1${phone.replace(/\D/g, "")}`

  const close = useCallback(() => {
    setOpen(false)
    // Devolver el foco al elemento que abrió el modal. Sin esto, quien navega
    // con teclado vuelve al principio del documento y tiene que rehacer todo
    // el recorrido para llegar a donde estaba.
    if (returnFocusTo.current && returnFocusTo.current.focus) {
      returnFocusTo.current.focus()
    }
  }, [])

  /* ── Disparadores ── */
  useEffect(() => {
    const onClick = event => {
      const link = event.target.closest(trigger)
      if (!link) return
      event.preventDefault()
      returnFocusTo.current = link
      setOpen(true)
    }
    const onEvent = () => {
      returnFocusTo.current = document.activeElement
      setOpen(true)
    }
    document.addEventListener("click", onClick)
    document.addEventListener("ec:open-bid", onEvent)
    return () => {
      document.removeEventListener("click", onClick)
      document.removeEventListener("ec:open-bid", onEvent)
    }
  }, [trigger])

  /* ── Bloqueo de scroll, Escape y trampa de foco ──
     Un diálogo modal que deja escapar el Tab no es modal: el lector de
     pantalla sigue leyendo la página de atrás como si nada. */
  useEffect(() => {
    if (!open) return

    const previousOverflow = document.body.style.overflow
    document.body.style.overflow = "hidden"

    const onKey = event => {
      if (event.key === "Escape") {
        close()
        return
      }
      if (event.key !== "Tab" || !panelRef.current) return

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
    const raf = window.requestAnimationFrame(() => {
      if (firstFieldRef.current) firstFieldRef.current.focus()
    })

    return () => {
      document.body.style.overflow = previousOverflow
      document.removeEventListener("keydown", onKey)
      window.cancelAnimationFrame(raf)
    }
  }, [open, close, status])

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

  if (!open) return null

  return (
    <div className="fixed inset-0 z-[80] flex items-end justify-center sm:items-center sm:p-6">
      {/* Velo. Cierra al hacer clic, pero es aria-hidden y no un botón: para
          teclado ya está Escape, y un botón acá aparecería en el recorrido
          de Tab sin nombre útil. */}
      <div
        className="absolute inset-0 bg-ink/80 backdrop-blur-sm"
        onClick={close}
        aria-hidden="true"
      />

      <div
        ref={panelRef}
        role="dialog"
        aria-modal="true"
        aria-labelledby="ec-bid-title"
        className="relative flex max-h-[92svh] w-full flex-col overflow-hidden rounded-t-xl bg-ink text-bone shadow-2xl ring-1 ring-white/10 sm:max-w-2xl sm:rounded-xl"
      >
        {/* ── Cabecera ── */}
        <div className="flex items-start justify-between gap-6 border-b border-white/10 px-6 py-5 sm:px-8">
          <div>
            <p className="mb-1.5 text-[0.65rem] font-semibold uppercase tracking-[0.18em] text-ember">
              Request a bid
            </p>
            <h2
              id="ec-bid-title"
              className="font-display text-2xl font-bold tracking-tight text-bone sm:text-3xl"
            >
              Send us the plans.
            </h2>
          </div>
          <button
            type="button"
            onClick={close}
            aria-label="Close"
            className="-mr-2 -mt-1 flex h-10 w-10 shrink-0 items-center justify-center rounded-full text-bone/60 transition-colors hover:bg-white/10 hover:text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember"
          >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" aria-hidden="true" className="h-5 w-5">
              <path d="M6 6l12 12M18 6L6 18" />
            </svg>
          </button>
        </div>

        {status === "sent" ? (
          /* ── Éxito ──
             No se cierra solo a los tres segundos: el usuario acaba de
             entregar los datos de un proyecto y merece leer que llegaron. */
          <div className="px-6 py-12 text-center sm:px-8">
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
          <>
            {/* El cuerpo scrollea, la cabecera y el pie se quedan fijos: en un
                teléfono el formulario no entra de una y el botón de enviar no
                puede quedar enterrado al final del scroll. */}
            <form onSubmit={submit} noValidate className="flex min-h-0 flex-1 flex-col">
              <div className="grid min-h-0 flex-1 gap-5 overflow-y-auto px-6 py-6 sm:grid-cols-2 sm:px-8">

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

                <Field id="ec-site" label="Site location" error={errors.site} className="sm:col-span-2">
                  <input
                    id="ec-site"
                    type="text"
                    placeholder="City, or the project address"
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

                <Field id="ec-details" label="Scope and schedule" error={errors.details} className="sm:col-span-2">
                  <textarea
                    id="ec-details"
                    rows={4}
                    placeholder="What’s the site, what’s the scope, and when do you need it done?"
                    value={values.details}
                    onChange={set("details")}
                    aria-invalid={!!errors.details}
                    aria-describedby={errors.details ? "ec-details-error" : undefined}
                    className={`${control(errors.details)} resize-y`}
                  />
                </Field>

                {/* Honeypot. aria-hidden y fuera del recorrido de Tab: una
                    persona no lo ve ni lo alcanza, un bot lo rellena. */}
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

              {/* ── Pie ── */}
              <div className="shrink-0 border-t border-white/10 px-6 py-5 sm:px-8">
                {status === "failed" && (
                  <p role="alert" className="mb-4 rounded-md border border-ember/40 bg-ember/10 px-4 py-3 text-sm text-bone">
                    That didn’t go through. Try again, or call us at{" "}
                    <a href={telHref} className="font-medium underline decoration-ember decoration-2 underline-offset-4">
                      {phone}
                    </a>
                    .
                  </p>
                )}

                <div className="flex flex-col-reverse items-stretch gap-4 sm:flex-row sm:items-center sm:justify-between">
                  <p className="text-xs leading-relaxed text-bone/50">
                    Prefer to talk it through?{" "}
                    <a href={telHref} className="font-medium text-bone/80 underline decoration-ember decoration-2 underline-offset-4">
                      {phone}
                    </a>
                  </p>

                  <button
                    type="submit"
                    disabled={status === "sending"}
                    className={[
                      "cta-relief group inline-flex items-center justify-center gap-2.5 rounded-full border-2 border-white/25 bg-ember py-3.5 pl-7 pr-6",
                      "text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink",
                      "transition-all duration-200 ease-out",
                      "hover:cta-relief-tight hover:bg-ember-600 hover:-translate-y-px",
                      "active:translate-y-0 active:shadow-none",
                      "disabled:pointer-events-none disabled:opacity-60",
                      "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
                      "motion-reduce:transform-none motion-reduce:transition-none",
                    ].join(" ")}
                  >
                    {status === "sending" ? "Sending…" : "Send it"}
                    {status !== "sending" && (
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true" className="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transform-none">
                        <path d="M5 12h13M13 6l6 6-6 6" />
                      </svg>
                    )}
                  </button>
                </div>
              </div>
            </form>
          </>
        )}
      </div>
    </div>
  )
}