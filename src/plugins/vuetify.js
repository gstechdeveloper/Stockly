/**
 * plugins/vuetify.js
 *
 * Framework documentation: https://vuetifyjs.com`
 */

// Styles
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'

// Composables
import { createVuetify } from 'vuetify'

// https://vuetifyjs.com/en/introduction/why-vuetify/#feature-guides
export default createVuetify({
  theme: {
    defaultTheme: 'light',
    themes: {
      dark: {
        dark: true,
          colors: {
            primary: "#ffffff",
            error: "#ff0000"
          }
        },
      light: {
        dark: false,
          colors: {
            primary: "#0f384c",
            error: "#ff0000"
          }
        }
    }
  },
})
