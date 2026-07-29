import React from "react"

/**
 * Iconos compartidos. SVG inline en lugar de librería: son pocos y así el
 * grosor de trazo queda alineado con la tipografía.
 *
 * Nota: Navbar.js todavía declara su propia copia de estos tres. Conviene
 * que importe desde aquí, pero ese archivo se está editando en paralelo y
 * preferí no tocarlo para no pisar cambios. Es una limpieza de un minuto.
 */

const base = {
  viewBox: "0 0 24 24",
  fill: "none",
  stroke: "currentColor",
  strokeWidth: 1.6,
  strokeLinecap: "round",
  strokeLinejoin: "round",
  "aria-hidden": "true",
  focusable: "false",
}

export const PhoneIcon = props => (
  <svg {...base} {...props}>
    <path d="M4 4h4l2 5-2.5 1.5a11 11 0 0 0 6 6L15 14l5 2v4a1 1 0 0 1-1 1A16 16 0 0 1 3 5a1 1 0 0 1 1-1z" />
  </svg>
)

export const MailIcon = props => (
  <svg {...base} {...props}>
    <rect x="3" y="5" width="18" height="14" rx="1.5" />
    <path d="m3.5 7 8.5 6 8.5-6" />
  </svg>
)

export const PinIcon = props => (
  <svg {...base} {...props}>
    <path d="M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11z" />
    <circle cx="12" cy="10" r="2.5" />
  </svg>
)

export const ExternalIcon = props => (
  <svg {...base} {...props}>
    <path d="M7 17 17 7M17 7h-6M17 7v6" />
  </svg>
)