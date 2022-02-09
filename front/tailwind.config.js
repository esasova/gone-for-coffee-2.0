module.exports = {
  purge: ['./src/**/*.{js,vue}', './public/index.html'],
  theme: {
    extend: {
      colors: {
        primary: '#508186',
        secondary: '#F4E8D8',
        accent: '#F4BE6A'
      },
      height: {
        88: '22rem',
        160: '40rem'
      }
    },
    fontFamily: {
      aleo: ['Aleo', 'serif'],
      francoisOne: ['FrancoisOne', 'sans-serif']
    }
  },
  variants: {
    display: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    backgroundColor: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    textColor: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    borderColor: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    width: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    height: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    opacity: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    scale: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    grayscale: ['responsive', 'hover', 'focus', 'active', 'group-hover']
  }
}
