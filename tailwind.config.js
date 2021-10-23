const colors = require('tailwindcss/colors')

module.exports = {
  //prefix: 'munich-',
  important: true,
  corePlugins: {
  },
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.trueGray,
      green: colors.green,
      indigo: colors.indigo,
      red: colors.red,
      yellow: colors.amber,
      teal: colors.teal,
    },
    backgroundColor: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.trueGray,
      green: colors.green,
      indigo: colors.indigo,
      red: colors.red,
      yellow: colors.amber,
      teal: colors.teal,
    },
    listStyleType: {
        square: 'square'
    },
    screens: {
      sm: '640px',
      md: '768px',
      lg: '1024px'
    },
    container: {
      center: true,
      padding: '.5rem',
    },
    extend: {}
  },
  variants: {
    container: ['responsive'],
    cursor: ['responsive', 'hover', 'focus'],
    display: ['responsive', 'hover', 'focus'],
    width: ['responsive'],
    backgroundColor: ['active', 'responsive', 'odd', 'even', 'hover', 'focus'],
    borderRadius: ['responsive', 'hover', 'focus'],
    padding: ['responsive', 'hover', 'focus'],
    position: ['responsive', 'hover', 'focus'],
    tableLayout: ['responsive', 'hover', 'focus'],
    gridColumn: ['responsive', 'hover'],
    gridColumnStart: ['responsive', 'hover'],
    gridColumnStartEnd: ['responsive', 'hover'],
    whitespace: ['responsive', 'hover', 'focus'],
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}