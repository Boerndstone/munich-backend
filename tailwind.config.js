const colors = require('tailwindcss/colors')

module.exports = {
  //prefix: 'munich-',
  important: true,
  corePlugins: {
  },
  theme: {

    /*colors: {
      black: '#000',
      white: '#fff',
      gray: colors.blueGray,
      blue: '#2c5282',
      yellow: '#d69e2e',
      red: '#c53030',
      green: '#2f855a'
    },*/
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
    backgroundColor: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
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