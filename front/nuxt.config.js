export default {
  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'front',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },
  purgeCSS: {
    whitelistPatterns: [/svg.*/, /fa.*/]
  },
  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    '~/assets/style/app.css',
    '@fortawesome/fontawesome-svg-core/styles.css'
  ],
  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '~/plugins/fontawesome.js',
    { src: '~/plugins/leaflet.js', ssr: false },
    '~/plugins/vvalidate.js'
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    '@nuxtjs/eslint-module',
    // https://go.nuxtjs.dev/tailwindcss
    '@nuxtjs/tailwindcss'
  ],
  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/auth-next',
    '@nuxtjs/dayjs'
  ],
  auth: {
    strategies: {
      local: {
        user: {
          property: ''
        },
        endpoints: {
          login: { url: 'http://localhost:8000/api/login_check', method: 'post', propertyName: 'token' },
          user: { url: 'http://localhost:8000/api/users/me', method: 'get', propertyName: 'data' },
          logout: false
        }
      }
    },
    redirect: {
      logout: '/',
      home: '/'
    }
  },
  axios: {
    baseURL: process.env.API_URL || 'http://127.0.0.1:8000'
  },
  router: {
    middleware: ['auth']
  },
  dayjs: {
    locales: ['fr'],
    defaultLocale: 'fr',
    defaultTimeZone: 'utc',
    plugins: ['utc', 'timezone', 'isBetween']
  },
  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  }
}
