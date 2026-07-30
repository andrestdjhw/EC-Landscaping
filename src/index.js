import React from "react"
import ReactDOM from "react-dom/client"
import Navbar from "./scripts/Navbar"
import Footer from "./scripts/Footer"
import FloatingActions from "./scripts/FloatingActions"
import ContactForm from "./scripts/ContactForm"

/**
 * Monta un componente en un nodo y le pasa como props el JSON que venga
 * en data-props. Así el contenido editable vive en PHP y no en el bundle.
 */
function mount(selector, Component) {
  const node = document.querySelector(selector)
  if (!node) return
  let props = {}
  if (node.dataset.props) {
    try {
      props = JSON.parse(node.dataset.props)
    } catch (err) {
      console.warn(`[ec] data-props inválido en ${selector}`, err)
    }
  }
  ReactDOM.createRoot(node).render(<Component {...props} />)
}

mount("#ec-navbar", Navbar)
mount("#ec-footer", Footer)
mount("#ec-floating-actions", FloatingActions)

// El modal se monta vacío y se dibuja solo al abrirse. Vive en footer.php
// para que esté disponible en todas las plantillas, no solo en la landing.
mount("#ec-contact-modal", ContactForm)

// Pendiente de la misma tanda:
// mount("#ec-chatbot", Chatbot)