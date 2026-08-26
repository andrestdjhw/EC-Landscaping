/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/scripts/ContactForm.js"
/*!************************************!*\
  !*** ./src/scripts/ContactForm.js ***!
  \************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ ContactForm)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__);


/**
 * ContactForm — "Request a bid" · EC Landscaping
 *
 * Un componente, tres usos, combinando cinco props:
 *
 *   Hero          variant="inline"  persistent  density="compact"
 *                 surface="glass"
 *                 inlineMinWidth="(min-width: 1280px)"
 *                 Siempre visible en la columna derecha del hero. Por debajo
 *                 del umbral no hay sitio, así que cae a modal y el CTA del
 *                 hero vuelve a ser un disparador.
 *
 *   Página /contact  variant="inline" persistent density="comfortable"
 *                 Sin umbral: la página es suya, no compite con nada.
 *                 Sin surface: usa "solid", ver abajo por qué.
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
 *   surface         "solid" (default) | "glass" — superficie del panel inline.
 *                   "glass" baja el fondo a ink/70 y sube el blur: el panel
 *                   deja ver el slideshow del hero a través.
 *                   SOLO para instancias cuyo fondo es un medio velado en
 *                   oscuro (el hero). La página /contact se queda en "solid":
 *                   su panel apoya sobre el bone de la página, y con ink/70
 *                   encima el fondo efectivo se aclara hasta hundir las
 *                   etiquetas en bone/55 por debajo de AA. La transparencia
 *                   es del hero, no del formulario.
 *   inlineMinWidth  media query. Por debajo, la variante inline cae a modal.
 *                   null = nunca cae.
 *   trigger         selector de los disparadores. Vacío o null = la
 *                   instancia no intercepta clics y los enlaces navegan.
 *   endpoint        URL del REST route que recibe el envío
 *   nonce           nonce de wp_rest, viaja en la cabecera X-WP-Nonce
 *   phone           teléfono visible
 */

const SCOPES = ["Landscape installation", "Hardscape & concrete", "Grounds maintenance & snow", "Water-wise retrofit", "More than one of these"];
const BUYERS = ["General contractor", "Property manager", "HOA board", "Owner / developer", "Other"];
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
  website: ""
};
const ANIM_MS = 220;
function validate(values) {
  const errors = {};
  if (!values.name.trim()) errors.name = "Tell us who you are.";
  if (!values.email.trim()) errors.email = "We need an email to send the bid to.";else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(values.email.trim())) errors.email = "That email doesn’t look right.";
  if (!values.site.trim()) errors.site = "Where is the site?";
  if (!values.details.trim()) errors.details = "A line or two about the scope is enough.";
  return errors;
}

/* ── Campos ─────────────────────────────────────────────────────────
   Etiqueta siempre visible, nunca placeholder-como-etiqueta: el
   placeholder desaparece al escribir y el usuario pierde la referencia
   justo cuando revisa lo que puso. */

function Field({
  id,
  label,
  error,
  children,
  className = ""
}) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
    className: className,
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("label", {
      htmlFor: id,
      className: "mb-1.5 block text-[0.65rem] font-semibold uppercase tracking-[0.14em] text-bone/55",
      children: label
    }), children, error && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
      id: `${id}-error`,
      className: "mt-1.5 text-xs text-ember",
      children: error
    })]
  });
}
const controlBase = ["w-full rounded-md border bg-white/[0.04] px-3.5 py-2.5 text-sm text-bone", "placeholder:text-bone/30", "transition-colors duration-150", "focus:border-ember focus:bg-white/[0.07] focus:outline-none"].join(" ");
function control(hasError) {
  return `${controlBase} ${hasError ? "border-ember" : "border-white/12"}`;
}

/* ── Media query como hook ──
   Se escucha el cambio, no solo el valor inicial: si alguien redimensiona la
   ventana con el panel abierto, tiene que convertirse en modal en lugar de
   quedar montado encima del titular. */
function useMediaQuery(query) {
  const [matches, setMatches] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(() => {
    // Sin consulta, siempre coincide: es la forma de decir "no hay umbral"
    // sin ramificar en el sitio donde se usa.
    if (!query) return true;
    if (typeof window === "undefined" || !window.matchMedia) return false;
    return window.matchMedia(query).matches;
  });
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    if (!query || !window.matchMedia) return;
    const mq = window.matchMedia(query);
    const onChange = event => setMatches(event.matches);
    setMatches(mq.matches);
    if (mq.addEventListener) mq.addEventListener("change", onChange);else mq.addListener(onChange);
    return () => {
      if (mq.removeEventListener) mq.removeEventListener("change", onChange);else mq.removeListener(onChange);
    };
  }, [query]);
  return matches;
}
function ContactForm({
  variant = "modal",
  persistent = false,
  density = "comfortable",
  surface = "solid",
  inlineMinWidth = null,
  trigger = null,
  endpoint = "/wp-json/ec/v1/bid",
  nonce = "",
  phone = "(385) 240-3907"
}) {
  const wideEnough = useMediaQuery(inlineMinWidth);

  // Persistente por debajo del umbral: no hay panel y tampoco hay modal al
  // que caer. El componente se aparta —ni renderiza ni intercepta clics— y
  // el CTA se comporta como el enlace que es, navegando a /contact.
  const standDown = variant === "inline" && persistent && !wideEnough;
  const asModal = variant !== "inline" || !wideEnough && !persistent;
  const alwaysOn = persistent && !standDown;
  const [mounted, setMounted] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(alwaysOn);
  const [entered, setEntered] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(alwaysOn);
  const [values, setValues] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(EMPTY);
  const [errors, setErrors] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)({});
  const [status, setStatus] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)("idle"); // idle | sending | sent | failed

  const panelRef = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);
  const firstFieldRef = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);
  const returnFocusTo = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);
  const closeTimer = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);

  // Al cruzar el umbral en un redimensionado, el panel tiene que aparecer o
  // desaparecer solo. Sin esto queda montado como modal, o desmontado en una
  // ventana que ya tiene sitio para él.
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    if (alwaysOn) {
      setMounted(true);
      setEntered(true);
    }
  }, [alwaysOn]);
  const telHref = `tel:+1${phone.replace(/\D/g, "")}`;
  const reduced = typeof window !== "undefined" && window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const close = (0,react__WEBPACK_IMPORTED_MODULE_0__.useCallback)(() => {
    // Un panel permanente no se cierra. Sin esta guarda, Escape lo desmontaría
    // y no habría forma de recuperarlo sin recargar.
    if (alwaysOn) return;
    setEntered(false);
    // Se desmonta después de la transición de salida, no durante: quitar el
    // nodo en el primer frame haría que el panel desaparezca de golpe y la
    // animación de cierre no se vea nunca.
    if (closeTimer.current) window.clearTimeout(closeTimer.current);
    closeTimer.current = window.setTimeout(() => {
      setMounted(false);
      if (returnFocusTo.current && returnFocusTo.current.focus) {
        returnFocusTo.current.focus();
      }
    }, reduced ? 0 : ANIM_MS);
  }, [reduced, alwaysOn]);

  /* ── Disparadores ──
     Con el panel permanente el formulario ya está en pantalla, así que el CTA
     no tiene nada que abrir: lleva el foco al primer campo. El botón sigue
     sirviendo —es lo que la gente busca con la vista— pero ahora señala en
     lugar de revelar. */
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    // Sin panel y sin modal no hay nada que hacer con el clic: dejar que el
    // enlace navegue es exactamente el comportamiento correcto.
    if (standDown) return;

    // trigger vacío = esta instancia no intercepta nada. Es lo que usa el
    // hero: sus CTA tienen que llevar a /contact como cualquier otro enlace,
    // aunque el formulario esté visible al lado.
    if (!trigger) return;
    const focusFirst = () => {
      if (!firstFieldRef.current) return;
      firstFieldRef.current.focus();
      firstFieldRef.current.scrollIntoView({
        block: "nearest",
        behavior: reduced ? "auto" : "smooth"
      });
    };
    const onClick = event => {
      const link = event.target.closest(trigger);
      if (!link) return;
      event.preventDefault();
      if (alwaysOn) {
        focusFirst();
        return;
      }
      returnFocusTo.current = link;
      if (closeTimer.current) window.clearTimeout(closeTimer.current);
      setMounted(true);
    };
    const onEvent = () => {
      if (alwaysOn) {
        focusFirst();
        return;
      }
      returnFocusTo.current = document.activeElement;
      if (closeTimer.current) window.clearTimeout(closeTimer.current);
      setMounted(true);
    };
    document.addEventListener("click", onClick);
    document.addEventListener("ec:open-bid", onEvent);
    return () => {
      document.removeEventListener("click", onClick);
      document.removeEventListener("ec:open-bid", onEvent);
    };
  }, [trigger, alwaysOn, reduced, standDown]);

  /* ── Entrada: montar en un frame, animar en el siguiente ──
     Si se aplicara el estado final en el mismo frame del montaje, el
     navegador no tendría un estado inicial contra el que interpolar y no
     habría transición. */
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    if (!mounted) return;
    const raf = window.requestAnimationFrame(() => setEntered(true));
    return () => window.cancelAnimationFrame(raf);
  }, [mounted]);

  /* ── Escape, foco y bloqueo de scroll ──
     El bloqueo y la trampa de foco son exclusivos del modal. El panel del
     hero no es modal: la página sigue siendo suya, se puede scrollear y
     tabular fuera del formulario sin cerrarlo. */
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    if (!mounted) return;
    const previousOverflow = document.body.style.overflow;
    if (asModal) document.body.style.overflow = "hidden";
    const onKey = event => {
      if (event.key === "Escape") {
        close();
        return;
      }
      if (!asModal || event.key !== "Tab" || !panelRef.current) return;
      const focusables = panelRef.current.querySelectorAll('a[href], button:not([disabled]), input:not([type="hidden"]), select, textarea, [tabindex]:not([tabindex="-1"])');
      if (!focusables.length) return;
      const first = focusables[0];
      const last = focusables[focusables.length - 1];
      if (event.shiftKey && document.activeElement === first) {
        event.preventDefault();
        last.focus();
      } else if (!event.shiftKey && document.activeElement === last) {
        event.preventDefault();
        first.focus();
      }
    };
    document.addEventListener("keydown", onKey);

    // El foco entra al primer campo, no al panel: se puede empezar a escribir
    // sin un tabulador de por medio.
    //
    // Salvo cuando es permanente: ahí el formulario no fue invocado por nadie,
    // así que robarle el foco al cargar la página secuestraría el teclado y
    // saltaría el scroll al panel antes de que se lea el titular.
    const raf = window.requestAnimationFrame(() => {
      if (!alwaysOn && firstFieldRef.current) firstFieldRef.current.focus();
    });
    return () => {
      document.body.style.overflow = previousOverflow;
      document.removeEventListener("keydown", onKey);
      window.cancelAnimationFrame(raf);
    };
  }, [mounted, asModal, alwaysOn, close, status]);
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => () => {
    if (closeTimer.current) window.clearTimeout(closeTimer.current);
  }, []);
  const set = key => event => {
    const {
      value
    } = event.target;
    setValues(prev => ({
      ...prev,
      [key]: value
    }));
    setErrors(prev => prev[key] ? {
      ...prev,
      [key]: undefined
    } : prev);
  };
  const submit = async event => {
    event.preventDefault();
    if (status === "sending") return;
    const found = validate(values);
    setErrors(found);
    if (Object.keys(found).length) {
      // Foco al primer campo con problema: si el formulario es largo, el
      // mensaje de error puede quedar fuera de pantalla.
      const firstKey = Object.keys(found)[0];
      const node = panelRef.current && panelRef.current.querySelector(`#ec-${firstKey}`);
      if (node) node.focus();
      return;
    }
    setStatus("sending");
    try {
      const response = await fetch(endpoint, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          ...(nonce ? {
            "X-WP-Nonce": nonce
          } : {})
        },
        body: JSON.stringify(values)
      });
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      setStatus("sent");
    } catch (error) {
      console.warn("[ec] no se pudo enviar el formulario", error);
      setStatus("failed");
    }
  };
  if (standDown || !mounted) return null;

  // La densidad viene por prop, no del viewport: las variantes sm: de Tailwind
  // miden la ventana, no el contenedor, y el panel del hero mide 27rem dentro
  // de una ventana de 1280+. Un modal siempre es cómodo; el hero, compacto.
  const compact = asModal ? false : density === "compact";
  const padX = compact ? "px-5" : "px-6 sm:px-8";
  const gridCols = compact ? "grid-cols-2 gap-4" : "gap-5 sm:grid-cols-2";
  const spanFull = compact ? "col-span-2" : "sm:col-span-2";
  const body = /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.Fragment, {
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
      className: `flex items-start justify-between gap-4 border-b border-white/10 ${padX} ${compact ? "py-4" : "py-5"}`,
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
        children: [!compact && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
          className: "mb-1.5 text-[0.65rem] font-semibold uppercase tracking-[0.18em] text-ember",
          children: "Request a bid"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("h2", {
          id: "ec-bid-title",
          className: `font-display font-bold tracking-tight text-bone ${compact ? "text-xl" : "text-2xl sm:text-3xl"}`,
          children: "Send us the plans."
        })]
      }), !alwaysOn && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("button", {
        type: "button",
        onClick: close,
        "aria-label": "Close",
        className: "-mr-2 -mt-1 flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-bone/60 transition-colors hover:bg-white/10 hover:text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
          viewBox: "0 0 24 24",
          fill: "none",
          stroke: "currentColor",
          strokeWidth: "1.6",
          strokeLinecap: "round",
          "aria-hidden": "true",
          className: "h-5 w-5",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
            d: "M6 6l12 12M18 6L6 18"
          })
        })
      })]
    }), status === "sent" ?
    /*#__PURE__*/
    /* ── Éxito ──
       No se cierra solo a los tres segundos: el usuario acaba de entregar
       los datos de un proyecto y merece leer que llegaron. */
    (0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
      className: `${padX} py-12 text-center`,
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
        className: "mx-auto mb-5 flex h-12 w-12 items-center justify-center rounded-full bg-ember/15",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
          viewBox: "0 0 24 24",
          fill: "none",
          stroke: "currentColor",
          strokeWidth: "1.8",
          strokeLinecap: "round",
          strokeLinejoin: "round",
          "aria-hidden": "true",
          className: "h-6 w-6 text-ember",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
            d: "m5 13 4 4L19 7"
          })
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
        className: "font-display text-xl font-bold tracking-tight text-bone",
        children: "Got it. We\u2019ll be in touch."
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
        className: "mx-auto mt-3 max-w-sm text-sm leading-relaxed text-bone/70",
        children: "You\u2019ll hear back from the owner or the estimator. If it\u2019s urgent, call the yard."
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
        href: telHref,
        className: "mt-6 inline-block text-lg font-semibold tabular-nums text-bone underline decoration-ember decoration-2 underline-offset-8",
        children: phone
      })]
    }) :
    /*#__PURE__*/
    /* El cuerpo scrollea, la cabecera y el pie se quedan fijos: ni en un
       teléfono ni en el panel del hero entra el formulario completo, y el
       botón de enviar no puede quedar enterrado al final del scroll. */
    (0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("form", {
      onSubmit: submit,
      noValidate: true,
      className: "flex min-h-0 flex-1 flex-col",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
        className: `grid min-h-0 flex-1 overflow-y-auto ${padX} ${gridCols} ${compact ? "py-5" : "py-6"}`,
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Field, {
          id: "ec-name",
          label: "Name",
          error: errors.name,
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("input", {
            ref: firstFieldRef,
            id: "ec-name",
            type: "text",
            autoComplete: "name",
            value: values.name,
            onChange: set("name"),
            "aria-invalid": !!errors.name,
            "aria-describedby": errors.name ? "ec-name-error" : undefined,
            className: control(errors.name)
          })
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Field, {
          id: "ec-company",
          label: "Company",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("input", {
            id: "ec-company",
            type: "text",
            autoComplete: "organization",
            value: values.company,
            onChange: set("company"),
            className: control(false)
          })
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Field, {
          id: "ec-email",
          label: "Email",
          error: errors.email,
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("input", {
            id: "ec-email",
            type: "email",
            autoComplete: "email",
            value: values.email,
            onChange: set("email"),
            "aria-invalid": !!errors.email,
            "aria-describedby": errors.email ? "ec-email-error" : undefined,
            className: control(errors.email)
          })
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Field, {
          id: "ec-phone",
          label: "Phone",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("input", {
            id: "ec-phone",
            type: "tel",
            autoComplete: "tel",
            value: values.phone,
            onChange: set("phone"),
            className: control(false)
          })
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Field, {
          id: "ec-buyer",
          label: "You are",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("select", {
            id: "ec-buyer",
            value: values.buyer,
            onChange: set("buyer"),
            className: control(false),
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("option", {
              value: "",
              children: "Select one"
            }), BUYERS.map(option => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("option", {
              value: option,
              className: "bg-ink",
              children: option
            }, option))]
          })
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Field, {
          id: "ec-scope",
          label: "Scope",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("select", {
            id: "ec-scope",
            value: values.scope,
            onChange: set("scope"),
            className: control(false),
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("option", {
              value: "",
              children: "Select one"
            }), SCOPES.map(option => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("option", {
              value: option,
              className: "bg-ink",
              children: option
            }, option))]
          })
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Field, {
          id: "ec-site",
          label: "Site location",
          error: errors.site,
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("input", {
            id: "ec-site",
            type: "text",
            placeholder: compact ? "City or address" : "City, or the project address",
            value: values.site,
            onChange: set("site"),
            "aria-invalid": !!errors.site,
            "aria-describedby": errors.site ? "ec-site-error" : undefined,
            className: control(errors.site)
          })
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Field, {
          id: "ec-date",
          label: "Target date",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("input", {
            id: "ec-date",
            type: "date",
            value: values.date,
            onChange: set("date"),
            className: `${control(false)} [color-scheme:dark]`
          })
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Field, {
          id: "ec-details",
          label: "Scope and schedule",
          error: errors.details,
          className: spanFull,
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("textarea", {
            id: "ec-details",
            rows: compact ? 3 : 4,
            placeholder: compact ? "Site, scope and target date." : "What’s the site, what’s the scope, and when do you need it done?",
            value: values.details,
            onChange: set("details"),
            "aria-invalid": !!errors.details,
            "aria-describedby": errors.details ? "ec-details-error" : undefined,
            className: `${control(errors.details)} resize-y`
          })
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
          className: "absolute left-[-9999px]",
          "aria-hidden": "true",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("label", {
            htmlFor: "ec-website",
            children: "Website"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("input", {
            id: "ec-website",
            type: "text",
            tabIndex: -1,
            autoComplete: "off",
            value: values.website,
            onChange: set("website")
          })]
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
        className: `shrink-0 border-t border-white/10 ${padX} ${compact ? "py-4" : "py-5"}`,
        children: [status === "failed" && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("p", {
          role: "alert",
          className: "mb-4 rounded-md border border-ember/40 bg-ember/10 px-4 py-3 text-sm text-bone",
          children: ["That didn\u2019t go through. Try again, or call us at", " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
            href: telHref,
            className: "font-medium underline decoration-ember decoration-2 underline-offset-4",
            children: phone
          }), "."]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
          className: compact ? "flex flex-col gap-3" : "flex flex-col-reverse items-stretch gap-4 sm:flex-row sm:items-center sm:justify-between",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("button", {
            type: "submit",
            disabled: status === "sending",
            className: [
            // CTA en PINE con texto blanco — redefinición global de los
            // botones de bid (ago 2026). Sobre el panel de vidrio el
            // borde white/25 y el relief son lo que lo delimitan.
            "cta-relief group inline-flex items-center justify-center gap-2.5 border-2 border-white/25 bg-ink py-3.5 pl-7 pr-6", "text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-white whitespace-nowrap", "transition-all duration-200 ease-out", "hover:cta-relief-tight hover:bg-ink-900 hover:-translate-y-px", "active:translate-y-0 active:shadow-none", "disabled:pointer-events-none disabled:opacity-60", "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember", "motion-reduce:transform-none motion-reduce:transition-none", compact ? "order-first w-full" : ""].join(" "),
            children: [status === "sending" ? "Sending…" : "Send it", status !== "sending" && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
              viewBox: "0 0 24 24",
              fill: "none",
              stroke: "currentColor",
              strokeWidth: "1.6",
              strokeLinecap: "round",
              strokeLinejoin: "round",
              "aria-hidden": "true",
              className: "h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transform-none",
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
                d: "M5 12h13M13 6l6 6-6 6"
              })
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("p", {
            className: `text-xs leading-relaxed text-bone/50 ${compact ? "text-center" : ""}`,
            children: ["Prefer to talk it through?", " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
              href: telHref,
              className: "whitespace-nowrap font-medium text-bone/80 underline decoration-ember decoration-2 underline-offset-4",
              children: phone
            })]
          })]
        })]
      })]
    })]
  });

  /* ── Variante inline: panel dentro del hero ──
     Entra desplazándose desde la derecha. No lleva velo ni role="dialog":
     no bloquea la página, así que anunciarlo como diálogo modal sería
     mentirle al lector de pantalla. Va como región con nombre. */
  if (!asModal) {
    /* ── Superficie del panel ──
       "solid": bg-ink/95 con blur suave. Es la de /contact, donde el panel
       apoya sobre el bone de la página — ahí la transparencia no muestra
       nada que valga la pena y solo aclara el fondo bajo las etiquetas.
        "glass": bg-ink/55 con blur fuerte, para el hero. El slideshow se ve
       claramente a través del panel. Dos decisiones que sostienen el
       contraste con un fondo tan abierto:
        · backdrop-blur-xl + saturate: el blur promedia la foto detrás — sin
         él, el borde de un techo blanco cruzaría por debajo de una etiqueta
         y la cortaría en dos. Difuminado, el fondo se comporta como un tono
         parejo. A esta transparencia el blur ya no es un refinamiento: es
         la condición para que el texto se lea.
       · el velo del hero ya oscurece la foto antes de que el panel se
         mezcle encima, así que el fondo efectivo sigue siendo oscuro.
        LA PERILLA: /55 es un punto agresivo — contra el slide más claro de
       los cinco, las etiquetas en bone/55 van a estar cerca del límite.
       Si se lavan, subí a /65; si querés aún más vidrio, /45 es el piso
       razonable antes de que el panel deje de leerse como superficie.
       Está acá y no en la plantilla porque es una decisión del componente,
       no del contenido. */
    const surfaceClasses = surface === "glass" ? "bg-ink/55 backdrop-blur-xl backdrop-saturate-150" : "bg-ink/95 backdrop-blur-md";
    return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
      ref: panelRef,
      role: "region",
      "aria-labelledby": "ec-bid-title",
      className: ["pointer-events-auto flex max-h-full w-full flex-col overflow-hidden",
      // Sobre PINE. Con la paleta nueva umber apunta a OLIVE, un tono
      // MEDIO: las etiquetas en bone/55 caían a 2.57:1 y el botón ember
      // quedaba invisible contra su propio panel. Sobre PINE las mismas
      // opacidades dan 4.54:1 y el botón 3.90:1.
      surfaceClasses, "text-bone shadow-2xl shadow-ink/50 ring-1 ring-white/12",
      // Permanente no anima: el panel no entra desde ningún lado, ya
      // estaba ahí cuando cargó la página.
      alwaysOn ? "" : ["transition-[opacity,transform] ease-out motion-reduce:transition-none", entered ? "translate-x-0 opacity-100" : "translate-x-8 opacity-0"].join(" ")].join(" "),
      style: alwaysOn ? undefined : {
        transitionDuration: `${ANIM_MS}ms`
      },
      children: body
    });
  }

  /* ── Variante modal ──
     Hoy ninguna instancia la usa: el modal global se retiró y su trabajo lo
     hace la página /contact. Se conserva porque sigue estando a una prop de
     distancia —variant="modal" en cualquier nodo de montaje— y borrarla
     costaría más que mantenerla. Si en tres meses sigue sin usarse, sacala. */
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
    className: "fixed inset-0 z-[80] flex items-end justify-center sm:items-center sm:p-6",
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
      className: ["absolute inset-0 bg-ink/80 backdrop-blur-sm", "transition-opacity ease-out motion-reduce:transition-none", entered ? "opacity-100" : "opacity-0"].join(" "),
      style: {
        transitionDuration: `${ANIM_MS}ms`
      },
      onClick: close,
      "aria-hidden": "true"
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
      ref: panelRef,
      role: "dialog",
      "aria-modal": "true",
      "aria-labelledby": "ec-bid-title",
      className: ["relative flex max-h-[92svh] w-full flex-col overflow-hidden", "bg-ink text-bone shadow-2xl ring-1 ring-white/10 sm:max-w-2xl", "transition-[opacity,transform] ease-out motion-reduce:transition-none", entered ? "translate-y-0 opacity-100" : "translate-y-6 opacity-0"].join(" "),
      style: {
        transitionDuration: `${ANIM_MS}ms`
      },
      children: body
    })]
  });
}

/***/ },

/***/ "./src/scripts/FloatingActions.js"
/*!****************************************!*\
  !*** ./src/scripts/FloatingActions.js ***!
  \****************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ FloatingActions)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _Icons__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Icons */ "./src/scripts/Icons.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__);



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
  const [visible, setVisible] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    let frame = null;
    const onScroll = () => {
      if (frame) return;
      frame = window.requestAnimationFrame(() => {
        setVisible(window.scrollY > threshold);
        frame = null;
      });
    };
    onScroll();
    window.addEventListener("scroll", onScroll, {
      passive: true
    });
    return () => {
      window.removeEventListener("scroll", onScroll);
      if (frame) window.cancelAnimationFrame(frame);
    };
  }, [threshold]);
  return visible;
}
function ActionPlate({
  icon: Icon,
  label,
  srLabel,
  href,
  external = false
}) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("a", {
      href: href,
      "aria-label": srLabel,
      ...(external ? {
        target: "_blank",
        rel: "noopener noreferrer"
      } : {}),
      className: [
      /* Cuadrados, no píldoras (ago 2026): rounded-full salió y no
         entra ningún rounded-*. Las esquinas rectas son el lenguaje de
         todo el sitio.
          Superficie CLARA (ago 2026): fondo blanco y letras oscuras,
         invertido a pedido para acompañar al navbar claro. El cambio de
         superficie arrastra su sistema entero:
           · borde a ink/10 — el white/12 sobre blanco no se ve
           · relieve bevel-tile / bevel-tile-raised, las utilidades del
             tema PARA claro (el par bevel/bevel-pressed es de superficie
             oscura y sobre blanco su luz interior desaparece)
           · íconos en ember-600, no ember: el clay base da 3.12:1 sobre
             blanco; el 600 es el paso que el tema define para claro */
      "group/plate flex items-center justify-end gap-0 border border-ink/10 bg-white/95 py-3 pl-3.5 pr-3.5", "text-ink/80 backdrop-blur-md bevel-tile", "transition-[box-shadow,transform,gap,padding,color] duration-200 ease-out", "hover:bevel-tile-raised hover:gap-2.5 hover:pl-4 hover:pr-5 hover:text-ink", "focus-visible:bevel-tile-raised focus-visible:gap-2.5 focus-visible:pl-4 focus-visible:pr-5", "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember", "active:shadow-none", "motion-reduce:transition-none"].join(" "),
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
        className: ["max-w-0 overflow-hidden whitespace-nowrap text-[0.78rem] font-medium tabular-nums opacity-0", "transition-[max-width,opacity] duration-200 ease-out", "group-hover/plate:max-w-[16rem] group-hover/plate:opacity-100", "group-focus-visible/plate:max-w-[16rem] group-focus-visible/plate:opacity-100", "motion-reduce:transition-none"].join(" "),
        children: label
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(Icon, {
        className: "h-[1.15rem] w-[1.15rem] shrink-0 text-ember-600"
      }), external && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_Icons__WEBPACK_IMPORTED_MODULE_1__.ExternalIcon, {
        className: "h-3 w-3 max-w-0 shrink-0 overflow-hidden text-ink/40 opacity-0 transition-opacity duration-200 group-hover/plate:max-w-3 group-hover/plate:opacity-100 motion-reduce:transition-none"
      })]
    })
  });
}
function FloatingActions({
  phone = "(385) 240-3907",
  email = "info@ecscaping.com",
  address = "3754 N Higley Rd, Ogden",
  mapsHref = "https://www.google.com/maps/search/?api=1&query=3754+N+Higley+Rd+Suite+2+Ogden+UT+84404",
  threshold = 520
}) {
  const visible = useVisibleAfter(threshold);
  const actions = [{
    icon: _Icons__WEBPACK_IMPORTED_MODULE_1__.PhoneIcon,
    label: phone,
    srLabel: `Call ${phone}`,
    href: `tel:+1${phone.replace(/\D/g, "")}`
  }, {
    icon: _Icons__WEBPACK_IMPORTED_MODULE_1__.MailIcon,
    label: email,
    srLabel: `Email ${email}`,
    href: `mailto:${email}`
  }, {
    icon: _Icons__WEBPACK_IMPORTED_MODULE_1__.PinIcon,
    label: address,
    srLabel: `Open ${address} in Google Maps`,
    href: mapsHref,
    external: true
  }];
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("ul", {
    "aria-label": "Contact EC Landscaping"
    // aria-hidden mientras está oculto: sin esto el lector de pantalla
    // anuncia tres enlaces que no se ven y que el usuario no puede alcanzar.
    ,
    "aria-hidden": !visible,
    className: ["fixed right-5 bottom-6 z-40 hidden flex-col items-end gap-2.5 lg:flex", "transition-[opacity,transform] duration-300 ease-out motion-reduce:transition-none", visible ? "translate-y-0 opacity-100" : "pointer-events-none translate-y-3 opacity-0"].join(" "),
    children: actions.map(action => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(ActionPlate, {
      ...action
    }, action.href))
  });
}

/***/ },

/***/ "./src/scripts/Footer.js"
/*!*******************************!*\
  !*** ./src/scripts/Footer.js ***!
  \*******************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Footer)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__);


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
  focusable: "false"
};
const PhoneIcon = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
  ...iconProps,
  ...props,
  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    d: "M4 4h4l2 5-2.5 1.5a11 11 0 0 0 6 6L15 14l5 2v4a1 1 0 0 1-1 1A16 16 0 0 1 3 5a1 1 0 0 1 1-1z"
  })
});
const MailIcon = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
  ...iconProps,
  ...props,
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("rect", {
    x: "3",
    y: "5",
    width: "18",
    height: "14",
    rx: "1.5"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    d: "m3.5 7 8.5 6 8.5-6"
  })]
});
const PinIcon = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
  ...iconProps,
  ...props,
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    d: "M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("circle", {
    cx: "12",
    cy: "10",
    r: "2.5"
  })]
});

/* ── Iconos sociales ──
   DUPLICADOS de Navbar.js a conciencia: allá viven como componentes locales
   de la franja de utilidad y este archivo no puede importarlos sin exponer
   internals del navbar. Son tres paths estáticos — el costo de la copia es
   menor que el de acoplar los dos componentes. Si aparece un tercer
   consumidor, ese es el momento de moverlos a un Icons.js compartido y
   dejar imports en los tres.

   Siluetas macizas con fill, no stroke: a este tamaño un contorno de 1.5
   se empasta. */

function FacebookIcon({
  className = ""
}) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
    viewBox: "0 0 24 24",
    fill: "currentColor",
    "aria-hidden": "true",
    className: className,
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.9h2.54V9.85c0-2.52 1.5-3.91 3.77-3.91 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.78-1.63 1.57v1.89h2.78l-.45 2.9h-2.33V22C18.34 21.24 22 17.08 22 12.06Z"
    })
  });
}
function InstagramIcon({
  className = ""
}) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
    viewBox: "0 0 24 24",
    fill: "currentColor",
    "aria-hidden": "true",
    className: className,
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "M12 2.16c3.2 0 3.58.01 4.85.07 1.17.05 1.8.25 2.23.41.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.36 1.06.41 2.23.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.25 1.8-.41 2.23-.22.56-.48.96-.9 1.38-.42.42-.82.68-1.38.9-.42.16-1.06.36-2.23.41-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.8-.25-2.23-.41-.56-.22-.96-.48-1.38-.9-.42-.42-.68-.82-.9-1.38-.16-.42-.36-1.06-.41-2.23C2.17 15.58 2.16 15.2 2.16 12s.01-3.58.07-4.85c.05-1.17.25-1.8.41-2.23.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.06-.36 2.23-.41C8.42 2.17 8.8 2.16 12 2.16Zm0 1.98c-3.14 0-3.51.01-4.75.07-1.15.05-1.77.24-2.18.4-.55.21-.94.47-1.35.88-.41.41-.67.8-.88 1.35-.16.41-.35 1.03-.4 2.18-.06 1.24-.07 1.61-.07 4.75s.01 3.51.07 4.75c.05 1.15.24 1.77.4 2.18.21.55.47.94.88 1.35.41.41.8.67 1.35.88.41.16 1.03.35 2.18.4 1.24.06 1.61.07 4.75.07s3.51-.01 4.75-.07c1.15-.05 1.77-.24 2.18-.4.55-.21.94-.47 1.35-.88.41-.41.67-.8.88-1.35.16-.41.35-1.03.4-2.18.06-1.24.07-1.61.07-4.75s-.01-3.51-.07-4.75c-.05-1.15-.24-1.77-.4-2.18a3.6 3.6 0 0 0-.88-1.35 3.6 3.6 0 0 0-1.35-.88c-.41-.16-1.03-.35-2.18-.4-1.24-.06-1.61-.07-4.75-.07Zm0 3.37a5.49 5.49 0 1 1 0 10.98 5.49 5.49 0 0 1 0-10.98Zm0 1.98a3.51 3.51 0 1 0 0 7.02 3.51 3.51 0 0 0 0-7.02Zm5.71-3.24a1.28 1.28 0 1 1 0 2.56 1.28 1.28 0 0 1 0-2.56Z"
    })
  });
}
function GoogleIcon({
  className = ""
}) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
    viewBox: "0 0 24 24",
    fill: "currentColor",
    "aria-hidden": "true",
    className: className,
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z"
    })
  });
}

/* Enlace social del footer. Placa cuadrada con el mismo lenguaje de las
   placas de contacto: borde tenue, fondo apenas levantado, bisel al hover.
   Sin estado inerte — ver la nota de la prop social. */
function SocialLink({
  icon: Icon,
  label,
  href
}) {
  if (!href) return null;
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
    href: href,
    target: "_blank",
    rel: "noopener noreferrer",
    "aria-label": label,
    className: ["flex h-10 w-10 items-center justify-center rounded-md border border-white/10 bg-white/[0.04] text-bone/80", "transition-[box-shadow,transform,color,background-color] duration-150 ease-out", "hover:bevel hover:-translate-y-px hover:bg-white/[0.09] hover:text-bone", "active:bevel-pressed active:translate-y-0", "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember", "motion-reduce:transform-none motion-reduce:transition-none"].join(" "),
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Icon, {
      className: "h-4 w-4"
    })
  });
}
function Wordmark() {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("span", {
    className: "flex items-baseline gap-2 leading-none",
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
      className: "font-display text-[1.35rem] font-bold tracking-tight text-bone",
      children: "EC Landscaping"
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
      className: "text-[0.6rem] font-semibold uppercase tracking-[0.18em] text-ember",
      children: "Commercial"
    })]
  });
}
function Footer({
  logo = null,
  phone = "(385) 240-3907",
  email = "info@ecscaping.com",
  address = "3754 N Higley Rd, Suite 2, Ogden, UT 84404",
  mapsHref = "https://www.google.com/maps/search/?api=1&query=3754+N+Higley+Rd+Suite+2+Ogden+UT+84404",
  license = "Utah License S330",
  pattern = null,
  social = {},
  nav = {},
  bidHref = "/contact"
}) {
  const telHref = `tel:+1${phone.replace(/\D/g, "")}`;
  const mailHref = `mailto:${email}`;
  const year = new Date().getFullYear();
  const groups = Object.entries(nav);
  const hasSocial = !!(social.facebook || social.instagram || social.google);
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("footer", {
    className: "relative isolate overflow-hidden bg-ink text-bone",
    children: [pattern && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
      className: "pointer-events-none absolute inset-0 -z-10 opacity-[0.07]",
      style: {
        backgroundImage: `url(${pattern})`,
        backgroundRepeat: "repeat",
        backgroundSize: "480px auto"
      },
      "aria-hidden": "true"
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
      className: "px-5 py-14 sm:px-8 lg:px-10 lg:py-20",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
        className: "grid gap-12 lg:grid-cols-[1.4fr_1fr_1fr_1.2fr] lg:gap-10",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
            href: "/",
            className: "inline-block rounded focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember",
            children: logo ? /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("img", {
              src: logo,
              alt: "EC Landscaping",
              className: "h-9 w-auto"
            }) : /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Wordmark, {})
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
            className: "mt-6 max-w-xs text-sm leading-relaxed text-bone/70",
            children: "Commercial landscape, hardscape and concrete. Self-performed across the Weber\u2013Davis corridor."
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("a", {
            href: mapsHref,
            target: "_blank",
            rel: "noopener noreferrer",
            className: "mt-5 inline-flex items-start gap-2.5 text-sm text-bone/80 underline decoration-ember decoration-2 underline-offset-4 transition-colors hover:text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(PinIcon, {
              className: "mt-0.5 h-4 w-4 shrink-0 text-ember/80"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
              children: address
            })]
          })]
        }), groups.map(([title, links]) => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("nav", {
          "aria-label": title,
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
            className: "mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300",
            children: title
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("ul", {
            className: "flex flex-col gap-2.5",
            children: links.map(link => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("li", {
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
                href: link.href,
                className: "text-sm text-bone/70 transition-colors hover:text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
                children: link.label
              })
            }, link.href))
          })]
        }, title)), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
            className: "mb-4 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-ember-300",
            children: "Contact"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("ul", {
            className: "flex flex-col gap-2.5",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("li", {
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("a", {
                href: telHref,
                className: "group flex items-center gap-2.5 text-sm text-bone/80 transition-colors hover:text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(PhoneIcon, {
                  className: "h-4 w-4 shrink-0 text-ember/80 transition-colors group-hover:text-ember"
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
                  className: "font-semibold tabular-nums",
                  children: phone
                })]
              })
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("li", {
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("a", {
                href: mailHref,
                className: "group flex items-center gap-2.5 text-sm text-bone/80 transition-colors hover:text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(MailIcon, {
                  className: "h-4 w-4 shrink-0 text-ember/80 transition-colors group-hover:text-ember"
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
                  children: email
                })]
              })
            })]
          }), hasSocial && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
            className: "mt-7",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
              className: "mb-3 text-[0.68rem] font-semibold uppercase tracking-[0.18em] text-bone/50",
              children: "Follow the work"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
              className: "flex items-center gap-2",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SocialLink, {
                icon: FacebookIcon,
                label: "EC Landscaping on Facebook",
                href: social.facebook
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SocialLink, {
                icon: InstagramIcon,
                label: "EC Landscaping on Instagram",
                href: social.instagram
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SocialLink, {
                icon: GoogleIcon,
                label: "EC Landscaping on Google",
                href: social.google
              })]
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("a", {
            href: bidHref,
            "data-bid-cta": "",
            className: "mt-7 inline-flex items-center gap-2.5 border-2 border-white/25 bg-ember px-6 py-3 text-[0.8125rem] font-medium uppercase tracking-[0.4px] text-ink transition-colors hover:bg-ember-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
            children: ["Request a Bid", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
              ...iconProps,
              className: "h-4 w-4",
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
                d: "M5 12h13M13 6l6 6-6 6"
              })
            })]
          })]
        })]
      })
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
      className: "ec-band ec-band--h h-2 opacity-40",
      "aria-hidden": "true"
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
      className: "border-t border-white/10 px-5 py-5 sm:px-8 lg:px-10",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
        className: "grid gap-2 text-center text-xs text-bone/50 sm:grid-cols-3 sm:items-center sm:gap-4 sm:text-left",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("p", {
          children: ["\xA9 ", year, " EC Landscaping LLC. All rights reserved."]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("p", {
          className: "sm:text-center",
          children: ["Site by", " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
            href: "https://828marketingsolutions.com/",
            target: "_blank",
            rel: "noopener noreferrer",
            className: "text-bone/70 underline decoration-ember decoration-2 underline-offset-4 transition-colors hover:text-bone focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember",
            children: "828 Marketing Solutions"
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
          className: "sm:text-right",
          children: license
        })]
      })
    })]
  });
}

/***/ },

/***/ "./src/scripts/Icons.js"
/*!******************************!*\
  !*** ./src/scripts/Icons.js ***!
  \******************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   ExternalIcon: () => (/* binding */ ExternalIcon),
/* harmony export */   MailIcon: () => (/* binding */ MailIcon),
/* harmony export */   PhoneIcon: () => (/* binding */ PhoneIcon),
/* harmony export */   PinIcon: () => (/* binding */ PinIcon)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__);


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
  focusable: "false"
};
const PhoneIcon = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
  ...base,
  ...props,
  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    d: "M4 4h4l2 5-2.5 1.5a11 11 0 0 0 6 6L15 14l5 2v4a1 1 0 0 1-1 1A16 16 0 0 1 3 5a1 1 0 0 1 1-1z"
  })
});
const MailIcon = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
  ...base,
  ...props,
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("rect", {
    x: "3",
    y: "5",
    width: "18",
    height: "14",
    rx: "1.5"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    d: "m3.5 7 8.5 6 8.5-6"
  })]
});
const PinIcon = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
  ...base,
  ...props,
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    d: "M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("circle", {
    cx: "12",
    cy: "10",
    r: "2.5"
  })]
});
const ExternalIcon = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
  ...base,
  ...props,
  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    d: "M7 17 17 7M17 7h-6M17 7v6"
  })
});

/***/ },

/***/ "./src/scripts/Navbar.js"
/*!*******************************!*\
  !*** ./src/scripts/Navbar.js ***!
  \*******************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Navbar)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__);


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

const DEFAULT_LINKS = [{
  label: "Commercial",
  href: "/#commercial"
}, {
  label: "Projects",
  href: "/#projects"
}, {
  label: "Capabilities",
  activeId: "#capabilities",
  children: [{
    label: "All capabilities",
    href: "/capabilities"
  }, {
    label: "Commercial landscape installation",
    href: "/landscape-installation"
  }, {
    label: "Hardscape & concrete",
    href: "/hardscape-concrete"
  }, {
    label: "Grounds maintenance, irrigation & snow",
    href: "/grounds-maintenance"
  }, {
    label: "Water-wise retrofits",
    href: "/water-wise-retrofits"
  }]
}, {
  label: "Credentials",
  href: "/#credentials"
}, {
  label: "Service Area",
  href: "/#service-area"
}];

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
  if (typeof value !== "string") return null;
  const hash = value.indexOf("#");
  if (hash === -1) return null;
  return value.slice(hash + 1) || null;
}
function useDocked(threshold = 24) {
  const [docked, setDocked] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    let frame = null;
    const onScroll = () => {
      if (frame) return;
      frame = window.requestAnimationFrame(() => {
        setDocked(window.scrollY > threshold);
        frame = null;
      });
    };
    onScroll();
    window.addEventListener("scroll", onScroll, {
      passive: true
    });
    return () => {
      window.removeEventListener("scroll", onScroll);
      if (frame) window.cancelAnimationFrame(frame);
    };
  }, [threshold]);
  return docked;
}
function useActiveSection(links) {
  const [active, setActive] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(null);
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    // activeId cubre las entradas cuyo href ya no apunta a una sección — el
    // padre de un desplegable, por ejemplo — pero que siguen correspondiendo
    // a un bloque de la landing.
    const ids = links.map(l => fragmentOf(l.activeId || l.href)).filter(Boolean);
    const nodes = ids.map(id => document.getElementById(id)).filter(Boolean);
    if (!nodes.length || !("IntersectionObserver" in window)) return;
    const observer = new IntersectionObserver(entries => {
      const visible = entries.filter(e => e.isIntersecting).sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];
      if (visible) setActive(visible.target.id);
    }, {
      rootMargin: "-45% 0px -50% 0px",
      threshold: [0, 0.25, 0.5]
    });
    nodes.forEach(n => observer.observe(n));
    return () => observer.disconnect();
  }, [links]);
  return active;
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
  focusable: "false"
};
const PhoneIcon = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
  ...iconProps,
  ...props,
  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    d: "M4 4h4l2 5-2.5 1.5a11 11 0 0 0 6 6L15 14l5 2v4a1 1 0 0 1-1 1A16 16 0 0 1 3 5a1 1 0 0 1 1-1z"
  })
});
const MailIcon = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
  ...iconProps,
  ...props,
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("rect", {
    x: "3",
    y: "5",
    width: "18",
    height: "14",
    rx: "1.5"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    d: "m3.5 7 8.5 6 8.5-6"
  })]
});
const PinIcon = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
  ...iconProps,
  ...props,
  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    d: "M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11z"
  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("circle", {
    cx: "12",
    cy: "10",
    r: "2.5"
  })]
});
const ChevronIcon = props => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
  ...iconProps,
  ...props,
  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
    d: "m6 9 6 6 6-6"
  })
});

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

function FacebookIcon({
  className = ""
}) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
    viewBox: "0 0 24 24",
    fill: "currentColor",
    "aria-hidden": "true",
    className: className,
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.9h2.54V9.85c0-2.52 1.5-3.91 3.77-3.91 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.78-1.63 1.57v1.89h2.78l-.45 2.9h-2.33V22C18.34 21.24 22 17.08 22 12.06Z"
    })
  });
}
function InstagramIcon({
  className = ""
}) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
    viewBox: "0 0 24 24",
    fill: "currentColor",
    "aria-hidden": "true",
    className: className,
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "M12 2.16c3.2 0 3.58.01 4.85.07 1.17.05 1.8.25 2.23.41.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.36 1.06.41 2.23.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.25 1.8-.41 2.23-.22.56-.48.96-.9 1.38-.42.42-.82.68-1.38.9-.42.16-1.06.36-2.23.41-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.8-.25-2.23-.41-.56-.22-.96-.48-1.38-.9-.42-.42-.68-.82-.9-1.38-.16-.42-.36-1.06-.41-2.23C2.17 15.58 2.16 15.2 2.16 12s.01-3.58.07-4.85c.05-1.17.25-1.8.41-2.23.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.06-.36 2.23-.41C8.42 2.17 8.8 2.16 12 2.16Zm0 1.98c-3.14 0-3.51.01-4.75.07-1.15.05-1.77.24-2.18.4-.55.21-.94.47-1.35.88-.41.41-.67.8-.88 1.35-.16.41-.35 1.03-.4 2.18-.06 1.24-.07 1.61-.07 4.75s.01 3.51.07 4.75c.05 1.15.24 1.77.4 2.18.21.55.47.94.88 1.35.41.41.8.67 1.35.88.41.16 1.03.35 2.18.4 1.24.06 1.61.07 4.75.07s3.51-.01 4.75-.07c1.15-.05 1.77-.24 2.18-.4.55-.21.94-.47 1.35-.88.41-.41.67-.8.88-1.35.16-.41.35-1.03.4-2.18.06-1.24.07-1.61.07-4.75s-.01-3.51-.07-4.75c-.05-1.15-.24-1.77-.4-2.18a3.6 3.6 0 0 0-.88-1.35 3.6 3.6 0 0 0-1.35-.88c-.41-.16-1.03-.35-2.18-.4-1.24-.06-1.61-.07-4.75-.07Zm0 3.37a5.49 5.49 0 1 1 0 10.98 5.49 5.49 0 0 1 0-10.98Zm0 1.98a3.51 3.51 0 1 0 0 7.02 3.51 3.51 0 0 0 0-7.02Zm5.71-3.24a1.28 1.28 0 1 1 0 2.56 1.28 1.28 0 0 1 0-2.56Z"
    })
  });
}
function GoogleIcon({
  className = ""
}) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
    viewBox: "0 0 24 24",
    fill: "currentColor",
    "aria-hidden": "true",
    className: className,
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z"
    })
  });
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
function SocialLink({
  icon: Icon,
  label,
  href
}) {
  const clases = "flex h-7 w-7 items-center justify-center text-bone transition-colors";
  if (!href) {
    return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("span", {
      className: `${clases} cursor-default opacity-70`,
      title: `${label} — pendiente`,
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Icon, {
        className: "h-3.5 w-3.5"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("span", {
        className: "sr-only",
        children: [label, " (enlace pendiente)"]
      })]
    });
  }
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("a", {
    href: href,
    target: "_blank",
    rel: "noopener noreferrer",
    className: `${clases} hover:text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember`,
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Icon, {
      className: "h-3.5 w-3.5"
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
      className: "sr-only",
      children: label
    })]
  });
}
function ContactPlate({
  icon: Icon,
  label,
  srLabel,
  href,
  external = false
}) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("a", {
    href: href,
    "aria-label": srLabel,
    ...(external ? {
      target: "_blank",
      rel: "noopener noreferrer"
    } : {}),
    className: ["group flex items-center gap-2 rounded-md border border-white/10 bg-white/[0.04] px-2.5 py-1.5", "text-[0.68rem] font-medium uppercase tracking-[0.12em] text-bone/70", "transition-[box-shadow,transform,color,background-color] duration-150 ease-out", "hover:bevel hover:-translate-y-px hover:bg-white/[0.09] hover:text-bone", "active:bevel-pressed active:translate-y-0 active:text-bone/80", "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember", "motion-reduce:transform-none motion-reduce:transition-none"].join(" "),
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Icon, {
      className: "h-4 w-4 shrink-0 text-ember/80 transition-colors group-hover:text-ember"
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
      className: "hidden sm:inline",
      children: label
    }), external && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
      ...iconProps,
      className: "hidden h-3 w-3 shrink-0 text-bone/40 transition-colors group-hover:text-bone/70 sm:block",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
        d: "M7 17 17 7M17 7h-6M17 7v6"
      })
    })]
  });
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
function BidButton({
  href,
  onClick,
  skin = "ember",
  size = "sm",
  className = ""
}) {
  const skins = {
    ember: [
    /* CTA en PINE con texto blanco — redefinido a pedido (ago 2026): los
       botones de bid dejan el CLAY y toman el verde oscuro de marca, que
       además resuelve de una el viejo problema de contraste del clay
       (blanco sobre pine pasa AA sobrado, ~11:1). La skin conserva el
       nombre "ember" para no tocar los call sites. El hover profundiza a
       ink-900, el mismo escalón que usa la franja de utilidad. */
    "border-white/25 bg-ink text-white cta-relief", "hover:cta-relief-tight hover:bg-ink-900 hover:-translate-y-px"].join(" "),
    soft: ["border-white/[0.333] bg-[#e0e8ef] text-[#7e97b8] cta-soft", "hover:cta-soft-tight hover:bg-[#e5edf5] hover:text-[#516d91]"].join(" ")
  };
  const sizes = {
    sm: "py-3 pl-6 pr-5",
    md: "py-4 pl-7 pr-6"
  };
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("a", {
    href: href,
    onClick: onClick
    // Todos los CTA de bid llevan este atributo. ContactForm lo escucha:
    // donde hay formulario en pantalla intercepta y enfoca; donde no,
    // el enlace navega a /contact como cualquier otro.
    ,
    "data-bid-cta": "",
    className: [
    // Sin rounded-full: el branding no tiene una sola forma redondeada,
    // y este botón vive dentro del hero, donde la píldora desentonaba
    // contra los bloques rectos de todas las secciones.
    "group inline-flex items-center justify-center gap-2.5 border-2", "text-[0.8125rem] font-medium uppercase tracking-[0.4px]", "transition-all duration-200 ease-out", "active:translate-y-0 active:shadow-none", "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember", "motion-reduce:transform-none motion-reduce:transition-none", skins[skin], sizes[size], className].join(" "),
    children: ["Request a Bid", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
      ...iconProps,
      className: "h-4 w-4 shrink-0 transition-transform duration-200 group-hover:translate-x-0.5 motion-reduce:transition-none motion-reduce:group-hover:translate-x-0",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
        d: "M5 12h13M13 6l6 6-6 6"
      })
    })]
  });
}

/**
 * NavDropdown — entrada de menú con submenú.
 *
 * Abre con hover y con foco, porque son dos formas distintas de llegar y
 * ninguna debería quedar fuera. El cierre por hover lleva un retardo corto:
 * sin él, el desplegable se cierra en el hueco entre el botón y el panel
 * mientras el mouse baja.
 */
function NavDropdown({
  link,
  isActive,
  linkBase,
  linkActive,
  isLight
}) {
  const [open, setOpen] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  const wrapRef = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);
  const buttonRef = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);
  const timer = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);
  const cancelClose = () => {
    if (timer.current) window.clearTimeout(timer.current);
  };
  const scheduleClose = () => {
    cancelClose();
    timer.current = window.setTimeout(() => setOpen(false), 160);
  };
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => () => cancelClose(), []);

  // Clic afuera y Escape. Escape además devuelve el foco al botón: si no, el
  // teclado queda huérfano en medio del documento.
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    if (!open) return;
    const onDocClick = event => {
      if (wrapRef.current && !wrapRef.current.contains(event.target)) setOpen(false);
    };
    const onKey = event => {
      if (event.key !== "Escape") return;
      setOpen(false);
      if (buttonRef.current) buttonRef.current.focus();
    };
    document.addEventListener("mousedown", onDocClick);
    document.addEventListener("keydown", onKey);
    return () => {
      document.removeEventListener("mousedown", onDocClick);
      document.removeEventListener("keydown", onKey);
    };
  }, [open]);
  const panelId = `nav-menu-${link.label.replace(/\s+/g, "-").toLowerCase()}`;
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("li", {
    ref: wrapRef,
    className: "relative",
    onMouseEnter: () => {
      cancelClose();
      setOpen(true);
    },
    onMouseLeave: scheduleClose,
    onFocus: () => {
      cancelClose();
      setOpen(true);
    },
    onBlur: scheduleClose,
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("button", {
      ref: buttonRef,
      type: "button",
      "aria-expanded": open,
      "aria-controls": panelId,
      onClick: () => setOpen(v => !v),
      style: isLight ? undefined : {
        color: "#ffffff"
      },
      className: ["relative flex items-center gap-1.5 py-1 text-[0.78rem] font-bold uppercase tracking-[0.13em] transition-colors", "focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember", isActive ? linkActive : linkBase].join(" "),
      children: [link.label, /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(ChevronIcon, {
        className: ["h-3 w-3 shrink-0 transition-transform duration-200 motion-reduce:transition-none", open ? "rotate-180" : ""].join(" ")
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
        "aria-hidden": "true",
        className: ["absolute -bottom-0.5 left-0 h-0.5 w-full origin-left bg-ember", "transition-transform duration-200 motion-reduce:transition-none", isActive ? "scale-x-100" : "scale-x-0"].join(" ")
      })]
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
      id: panelId,
      hidden: !open,
      className: "absolute left-0 top-full z-10 pt-3",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("ul", {
        className: ["min-w-[16rem] overflow-hidden rounded-lg py-2 shadow-xl shadow-ink/20 backdrop-blur-md", isLight ? "bg-white/95 ring-1 ring-mist" : "bg-[#232322]/95 ring-1 ring-white/10"].join(" "),
        children: link.children.map(child => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("li", {
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
            href: child.href,
            className: ["block px-5 py-2.5 text-sm transition-colors", "focus-visible:outline-2 focus-visible:outline-offset-[-2px] focus-visible:outline-ember", isLight ? "text-ink/75 hover:bg-bone hover:text-ink" : "text-bone/75 hover:bg-white/[0.07] hover:text-bone"].join(" "),
            children: child.label
          })
        }, child.href))
      })
    })]
  });
}
function Wordmark({
  theme
}) {
  const primary = theme === "light" ? "text-ink" : "text-bone";
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("span", {
    className: "flex items-baseline gap-2 leading-none",
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
      className: `font-display text-[1.35rem] font-bold tracking-tight ${primary}`,
      children: "EC Landscaping"
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
      className: "hidden text-[0.6rem] font-semibold uppercase tracking-[0.18em] text-ember sm:inline",
      children: "Commercial"
    })]
  });
}
function Navbar({
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
  ctaStyle = "ember"
}) {
  const docked = useDocked();
  const active = useActiveSection(links);
  const [open, setOpen] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  const panelRef = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);
  const telHref = `tel:+1${phone.replace(/\D/g, "")}`;
  const mailHref = `mailto:${email}`;

  // Bloqueo de scroll y cierre con Escape mientras el panel móvil está abierto.
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    if (!open) return;
    const previous = document.body.style.overflow;
    document.body.style.overflow = "hidden";
    const onKey = e => {
      if (e.key === "Escape") setOpen(false);
    };
    document.addEventListener("keydown", onKey);
    return () => {
      document.body.style.overflow = previous;
      document.removeEventListener("keydown", onKey);
    };
  }, [open]);
  const isLight = theme === "light";

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
  const barSurface = isLight ? ["ring-1 ring-mist bg-white/95", docked ? "supports-[backdrop-filter]:bg-white/95" : ""].join(" ") : ["ring-1 ring-white/10 bg-[#232322]/95", docked ? "supports-[backdrop-filter]:bg-[#232322]/95" : ""].join(" ");

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
  const linkBase = isLight ? "text-ink/70 hover:text-ink" : "text-white";
  const linkActive = isLight ? "text-ink" : "text-white";
  const linkStyle = isLight ? undefined : {
    color: "#ffffff"
  };
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.Fragment, {
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("header", {
      className: "fixed inset-x-0 top-0 z-50",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
        className: [
        /* Neutro más oscuro que la barra (#171716 contra #232322): el
           mismo escalón que hacían pine-900 y pine, sin la base verde.
           Ver la nota de barSurface. */
        "overflow-hidden border-b border-white/10 bg-[#171716] text-bone", "transition-[max-height,opacity] duration-300 ease-out motion-reduce:transition-none", docked ? "max-h-0 opacity-0" : "max-h-12 opacity-100"].join(" "),
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
          className: "grid grid-cols-[1fr_auto] items-center gap-4 px-5 py-1.5 sm:px-8 lg:grid-cols-3 lg:px-10",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
            className: "flex items-center justify-start gap-2",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(ContactPlate, {
              icon: PhoneIcon,
              label: phone,
              srLabel: `Call ${phone}`,
              href: telHref
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(ContactPlate, {
              icon: MailIcon,
              label: email,
              srLabel: `Email ${email}`,
              href: mailHref
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
            className: "hidden items-center justify-center lg:flex",
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(ContactPlate, {
              icon: PinIcon,
              label: address,
              srLabel: `Open ${address} in Google Maps`,
              href: mapsHref,
              external: true
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
            className: "flex items-center justify-end gap-3",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
              className: "hidden text-[0.68rem] font-medium uppercase tracking-[0.14em] text-bone/55 xl:inline",
              children: license
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
              className: "hidden h-4 w-px bg-white/15 xl:inline-block",
              "aria-hidden": "true"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
              className: "flex items-center gap-0.5",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SocialLink, {
                icon: FacebookIcon,
                label: "Facebook",
                href: social.facebook
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SocialLink, {
                icon: InstagramIcon,
                label: "Instagram",
                href: social.instagram
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(SocialLink, {
                icon: GoogleIcon,
                label: "Google Business Profile",
                href: social.google
              })]
            })]
          })]
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("nav", {
          "aria-label": "Primary",
          className: [barSurface, "flex items-center justify-between gap-6", "transition-all duration-300 ease-out motion-reduce:transition-none",
          /* Ancho completo y bordes rectos en los dos estados. Lo único
             que cambia al acoplarse es el alto —py-3 contra py-4— y el
             desenfoque, que aparece cuando la barra empieza a dejar ver
             el contenido por detrás. */
          "px-5 sm:px-8 lg:px-10", docked ? "py-3 shadow-[0_1px_0_0_rgba(0,0,0,0.25)] backdrop-blur-xl" : "py-4"].join(" "),
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
            href: "/",
            className: "flex shrink-0 items-center gap-3 rounded focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember",
            children: logo ? /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("img", {
              src: logo,
              alt: "EC Landscaping",
              className: "h-8 w-auto sm:h-9"
            }) : /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Wordmark, {
              theme: theme
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("ul", {
            className: "hidden items-center gap-7 lg:flex",
            children: links.map(link => {
              const id = fragmentOf(link.activeId || link.href);
              const isActive = !!id && id === active;
              if (link.children && link.children.length) {
                return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(NavDropdown, {
                  link: link,
                  isActive: isActive,
                  linkBase: linkBase,
                  linkActive: linkActive,
                  isLight: isLight
                }, link.label);
              }
              return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("li", {
                children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("a", {
                  href: link.href,
                  "aria-current": isActive ? "true" : undefined,
                  style: linkStyle,
                  className: ["relative py-1 text-[0.78rem] font-bold uppercase tracking-[0.13em] transition-colors", "focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember", isActive ? linkActive : linkBase].join(" "),
                  children: [link.label, /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
                    "aria-hidden": "true",
                    className: ["absolute -bottom-0.5 left-0 h-0.5 w-full origin-left bg-ember", "transition-transform duration-200 motion-reduce:transition-none", isActive ? "scale-x-100" : "scale-x-0"].join(" ")
                  })]
                })
              }, link.href);
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
            className: "hidden shrink-0 items-center gap-4 lg:flex",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
              href: telHref,
              className: ["text-sm font-semibold tabular-nums transition-colors", "focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-ember", isLight ? "text-ink hover:text-forest" : "text-bone hover:text-white"].join(" "),
              children: phone
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(BidButton, {
              href: bidHref,
              skin: ctaStyle,
              size: "sm"
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("button", {
            type: "button",
            onClick: () => setOpen(true),
            "aria-expanded": open,
            "aria-controls": "mobile-nav",
            className: ["flex items-center gap-2 rounded-md px-3 py-2 text-[0.7rem] font-bold uppercase tracking-[0.12em] lg:hidden", "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember", isLight ? "text-ink ring-1 ring-mist" : "text-bone ring-1 ring-white/15"].join(" "),
            children: ["Menu", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("span", {
              "aria-hidden": "true",
              className: "flex flex-col gap-[3px]",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
                className: "block h-[1.5px] w-4 bg-current"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
                className: "block h-[1.5px] w-4 bg-current"
              })]
            })]
          })]
        })
      })]
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
      id: "mobile-nav",
      ref: panelRef,
      role: "dialog",
      "aria-modal": "true",
      "aria-label": "Menu",
      hidden: !open,
      className: ["fixed inset-0 z-[60] flex flex-col lg:hidden", isLight ? "bg-white text-ink" : "bg-[#232322] text-bone"].join(" "),
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
        className: `flex items-center justify-between border-b px-5 py-4 ${isLight ? "border-ink/10" : "border-white/10"}`,
        children: [logo ? /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("img", {
          src: logo,
          alt: "EC Landscaping",
          className: "h-8 w-auto"
        }) : /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(Wordmark, {
          theme: theme
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("button", {
          type: "button",
          onClick: () => setOpen(false),
          className: ["rounded-md px-3 py-2 text-[0.7rem] font-bold uppercase tracking-[0.12em]", "focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember", isLight ? "text-ink ring-1 ring-ink/15" : "text-bone ring-1 ring-white/15"].join(" "),
          children: "Close"
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("nav", {
        "aria-label": "Primary mobile",
        className: "flex-1 overflow-y-auto px-5 py-6",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("ul", {
          className: `flex flex-col divide-y ${isLight ? "divide-ink/10" : "divide-white/10"}`,
          children: [links.map(link => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("li", {
            children: link.children && link.children.length ? /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
              className: "py-4",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
                className: `font-display text-2xl font-bold tracking-tight ${isLight ? "text-ink/50" : "text-bone/50"}`,
                children: link.label
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("ul", {
                className: `mt-3 flex flex-col gap-1 border-l pl-4 ${isLight ? "border-ink/15" : "border-white/15"}`,
                children: link.children.map(child => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("li", {
                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
                    href: child.href,
                    onClick: () => setOpen(false),
                    className: `block py-2 text-base font-medium focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember ${isLight ? "text-ink" : "text-bone"}`,
                    children: child.label
                  })
                }, child.href))
              })]
            }) : /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
              href: link.href,
              onClick: () => setOpen(false),
              className: `block py-4 font-display text-2xl font-bold tracking-tight focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember ${isLight ? "text-ink" : "text-bone"}`,
              children: link.label
            })
          }, link.label)), residentialHref && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("li", {
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("a", {
              href: residentialHref,
              onClick: () => setOpen(false),
              className: `block py-4 text-sm font-semibold uppercase tracking-[0.14em] ${isLight ? "text-ink/50" : "text-bone/50"}`,
              children: ["Residential ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
                "aria-hidden": "true",
                children: "\u2192"
              })]
            })
          })]
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
        className: `border-t px-5 py-5 ${isLight ? "border-ink/10" : "border-white/10"}`,
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("ul", {
          className: "mb-5 flex flex-col gap-2",
          children: [{
            icon: PhoneIcon,
            label: phone,
            href: telHref,
            srLabel: `Call ${phone}`,
            external: false
          }, {
            icon: MailIcon,
            label: email,
            href: mailHref,
            srLabel: `Email ${email}`,
            external: false
          }, {
            icon: PinIcon,
            label: address,
            href: mapsHref,
            srLabel: `Open ${address} in Google Maps`,
            external: true
          }].map(item => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("li", {
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("a", {
              href: item.href,
              "aria-label": item.srLabel,
              ...(item.external ? {
                target: "_blank",
                rel: "noopener noreferrer"
              } : {}),
              className: ["group flex items-center gap-3 rounded-md border px-3 py-2.5 text-sm", "transition-[box-shadow,transform,background-color] duration-150", "hover:-translate-y-px active:translate-y-0", "motion-reduce:transform-none motion-reduce:transition-none", isLight ? "border-ink/10 bg-ink/[0.03] text-ink/80 bevel-tile hover:bevel-tile-raised active:shadow-none" : "border-white/10 bg-white/[0.04] text-bone/80 hover:bevel hover:bg-white/[0.09] active:bevel-pressed"].join(" "),
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(item.icon, {
                className: `h-4 w-4 shrink-0 ${isLight ? "text-ember-600" : "text-ember/80 group-hover:text-ember"}`
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("span", {
                children: item.label
              })]
            })
          }, item.href))
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("p", {
          className: `mb-4 text-[0.65rem] font-medium uppercase tracking-[0.14em] ${isLight ? "text-ink/50" : "text-bone/50"}`,
          children: license
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
          className: "grid grid-cols-2 gap-3",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
            href: telHref,
            className: `border-2 py-3 text-center text-[0.8125rem] font-medium uppercase tracking-[0.4px] ${isLight ? "border-ink/30 text-ink" : "border-white/20 text-bone"}`,
            children: "Call now"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(BidButton, {
            href: bidHref,
            onClick: () => setOpen(false),
            skin: ctaStyle,
            size: "sm",
            className: "w-full"
          })]
        })]
      })]
    }), !open && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("div", {
      className: ["fixed inset-x-0 bottom-0 z-40 grid grid-cols-2 gap-px border-t lg:hidden", isLight ? "border-ink/10 bg-white" : "border-white/10 bg-[#232322]"].join(" "),
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("a", {
        href: telHref,
        className: `py-4 text-center text-[0.72rem] font-bold uppercase tracking-[0.12em] ${isLight ? "text-ink" : "text-bone"}`,
        children: ["Call ", phone]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("a", {
        href: bidHref,
        "data-bid-cta": "",
        className: "bg-ink py-4 text-center text-[0.72rem] font-bold uppercase tracking-[0.12em] text-white",
        children: "Request a Bid"
      })]
    })]
  });
}

/***/ },

/***/ "react"
/*!************************!*\
  !*** external "React" ***!
  \************************/
(module) {

module.exports = window["React"];

/***/ },

/***/ "react-dom/client"
/*!***************************!*\
  !*** external "ReactDOM" ***!
  \***************************/
(module) {

module.exports = window["ReactDOM"];

/***/ },

/***/ "react/jsx-runtime"
/*!**********************************!*\
  !*** external "ReactJSXRuntime" ***!
  \**********************************/
(module) {

module.exports = window["ReactJSXRuntime"];

/***/ }

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	const __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		const cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		const module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		if (!(moduleId in __webpack_modules__)) {
/******/ 			delete __webpack_module_cache__[moduleId];
/******/ 			const e = new Error("Cannot find module '" + moduleId + "'");
/******/ 			e.code = 'MODULE_NOT_FOUND';
/******/ 			throw e;
/******/ 		}
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			const getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter/value functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			if(Array.isArray(definition)) {
/******/ 				var i = 0;
/******/ 				while(i < definition.length) {
/******/ 					var key = definition[i++];
/******/ 					var binding = definition[i++];
/******/ 					if(!__webpack_require__.o(exports, key)) {
/******/ 						if(binding === 0) {
/******/ 							Object.defineProperty(exports, key, { enumerable: true, value: definition[i++] });
/******/ 						} else {
/******/ 							Object.defineProperty(exports, key, { enumerable: true, get: binding });
/******/ 						}
/******/ 					} else if(binding === 0) { i++; }
/******/ 				}
/******/ 			} else {
/******/ 				for(var key in definition) {
/******/ 					if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 						Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 					}
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.hasOwn(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
let __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom_client__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom/client */ "react-dom/client");
/* harmony import */ var react_dom_client__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_dom_client__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _scripts_Navbar__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./scripts/Navbar */ "./src/scripts/Navbar.js");
/* harmony import */ var _scripts_Footer__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./scripts/Footer */ "./src/scripts/Footer.js");
/* harmony import */ var _scripts_FloatingActions__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./scripts/FloatingActions */ "./src/scripts/FloatingActions.js");
/* harmony import */ var _scripts_ContactForm__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./scripts/ContactForm */ "./src/scripts/ContactForm.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__);







/**
 * Monta un componente en un nodo y le pasa como props el JSON que venga
 * en data-props. Así el contenido editable vive en PHP y no en el bundle.
 */

function mount(selector, Component) {
  const node = document.querySelector(selector);
  if (!node) return;
  let props = {};
  if (node.dataset.props) {
    try {
      props = JSON.parse(node.dataset.props);
    } catch (err) {
      console.warn(`[ec] data-props inválido en ${selector}`, err);
    }
  }
  react_dom_client__WEBPACK_IMPORTED_MODULE_1___default().createRoot(node).render(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)(Component, {
    ...props
  }));
}
mount("#ec-navbar", _scripts_Navbar__WEBPACK_IMPORTED_MODULE_2__["default"]);
mount("#ec-footer", _scripts_Footer__WEBPACK_IMPORTED_MODULE_3__["default"]);
mount("#ec-floating-actions", _scripts_FloatingActions__WEBPACK_IMPORTED_MODULE_4__["default"]);

// Dos instancias del mismo componente. Cada nodo existe solo en su plantilla,
// así que en el resto del sitio mount() no lo encuentra y no monta nada.
//
// El modal global se retiró: su trabajo lo hace la página /contact, y los CTA
// navegan hacia allá en lugar de abrir un diálogo.
mount("#ec-hero-form", _scripts_ContactForm__WEBPACK_IMPORTED_MODULE_5__["default"]);
mount("#ec-contact-form", _scripts_ContactForm__WEBPACK_IMPORTED_MODULE_5__["default"]);

// Pendiente de la misma tanda:
// mount("#ec-chatbot", Chatbot)
})();

/******/ })()
;
//# sourceMappingURL=index.js.map