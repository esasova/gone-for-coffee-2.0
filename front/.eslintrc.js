module.exports = {
  root: true,
  env: {
    browser: true,
    node: true,
    'cypress/globals': true
  },
  parserOptions: {
    parser: 'babel-eslint'
  },
  extends: [
    '@nuxtjs',
    'plugin:nuxt/recommended',
    'plugin:cypress/recommended'
  ],
  plugins: [
    'vue',
    'cypress'
  ],
  rules: {
    'vue/max-attributes-per-line': 'off'
  }
}
