import React, { useEffect, useState } from "react"
import { PhoneIcon, MailIcon, PinIcon, ExternalIcon } from "./Icons"

/**
 * FloatingActions — teléfono, correo y dirección, fijos abajo a la derecha.
 *
 * Aparece solo después del hero, y eso es el punto del componente: la franja
 * de utilidad de la navbar colapsa al hacer scroll, así que a partir de ahí
 * el contacto desaparece de la pantalla. Esto lo devuelve. Si estuviera
 * visible desde el arranque, duplicaría la franja.
 *
 * Solo escritorio. En móvil la navbar ya fija una barra inferior con Call y
 * Request a Bid; apilar dos capas fijas en una pantalla chica se come el
 * viewport y compite con el CTA, que es lo único que no puede perder
 * prioridad. Para forzarlo en móvil: cambiar "hidden lg:flex" por "flex".
 *
 * OJO con el import de arriba: el archivo se llama Icons.js con I mayúscula.
 * Antes decía "./icons" y resolvía igual en macOS y Windows, donde el sistema
 * de archivos no distingue mayúsculas — pero en un build sobre Linux el
 * módulo no existe y la compilación falla. Es el tipo de bug que aparece
 * recién en el servidor de producción.
 *
 * Props:
 *   phone, email, address   textos visibles
 *   mapsHref                URL del mapa (se abre en pestaña nueva)
 *   threshold               px de scroll antes de aparecer
 */

function useVisibleAfter(threshold) {
  const [visible, setVisible] = useState(false)

  useEffect(() => {
    let frame = null
    const onScroll = () => {
      if (frame) return
      frame = window.requestAnimationFrame(() => {
        setVisible(window.scrollY > threshold)
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

  return visible
}

function ActionPlate({ icon: Icon, label, srLabel, href, external = false }) {
  return (
    <li>
      <a
        href={href}
        aria-label={srLabel}
        {...(external ? { target: "_blank", rel: "noopener noreferrer" } : {})}
        className={[
          "group/plate flex items-center justify-end gap-0 rounded-full border border-white/12 bg-ink/95 py-3 pl-3.5 pr-3.5",
          "text-bone/80 backdrop-blur-md",
          "transition-[box-shadow,transform,gap,padding,color] duration-200 ease-out",
          "hover:bevel hover:gap-2.5 hover:pl-4 hover:pr-5 hover:text-bone",
          "focus-visible:bevel focus-visible:gap-2.5 focus-visible:pl-4 focus-visible:pr-5",
          "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
          "active:bevel-pressed",
          "motion-reduce:transition-none",
        ].join(" ")}
      >
        {/* La etiqueta crece desde 0: colapsada no reserva ancho, así el
            grupo se lee como una columna de iconos hasta que interactúas. */}
        <span
          className={[
            "max-w-0 overflow-hidden whitespace-nowrap text-[0.78rem] font-medium tabular-nums opacity-0",
            "transition-[max-width,opacity] duration-200 ease-out",
            "group-hover/plate:max-w-[16rem] group-hover/plate:opacity-100",
            "group-focus-visible/plate:max-w-[16rem] group-focus-visible/plate:opacity-100",
            "motion-reduce:transition-none",
          ].join(" ")}
        >
          {label}
        </span>
        <Icon className="h-[1.15rem] w-[1.15rem] shrink-0 text-ember" />
        {external && (
          <ExternalIcon className="h-3 w-3 max-w-0 shrink-0 overflow-hidden text-bone/40 opacity-0 transition-opacity duration-200 group-hover/plate:max-w-3 group-hover/plate:opacity-100 motion-reduce:transition-none" />
        )}
      </a>
    </li>
  )
}

export default function FloatingActions({
  phone = "(385) 240-3907",
  email = "info@ecscaping.com",
  address = "3754 N Higley Rd, Ogden",
  mapsHref = "https://www.google.com/maps/search/?api=1&query=3754+N+Higley+Rd+Suite+2+Ogden+UT+84404",
  threshold = 520,
}) {
  const visible = useVisibleAfter(threshold)

  const actions = [
    {
      icon: PhoneIcon,
      label: phone,
      srLabel: `Call ${phone}`,
      href: `tel:+1${phone.replace(/\D/g, "")}`,
    },
    {
      icon: MailIcon,
      label: email,
      srLabel: `Email ${email}`,
      href: `mailto:${email}`,
    },
    {
      icon: PinIcon,
      label: address,
      srLabel: `Open ${address} in Google Maps`,
      href: mapsHref,
      external: true,
    },
  ]

  return (
    <ul
      aria-label="Contact EC Landscaping"
      // aria-hidden mientras está oculto: sin esto el lector de pantalla
      // anuncia tres enlaces que no se ven y que el usuario no puede alcanzar.
      aria-hidden={!visible}
      className={[
        "fixed right-5 bottom-6 z-40 hidden flex-col items-end gap-2.5 lg:flex",
        "transition-[opacity,transform] duration-300 ease-out motion-reduce:transition-none",
        visible
          ? "translate-y-0 opacity-100"
          : "pointer-events-none translate-y-3 opacity-0",
      ].join(" ")}
    >
      {actions.map(action => (
        <ActionPlate key={action.href} {...action} />
      ))}
    </ul>
  )
}