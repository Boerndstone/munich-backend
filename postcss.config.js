let tailwindcss = require('tailwindcss');

/*module.exports = {
    plugins: [
        tailwindcss('./tailwind.config.js'), // your tailwind.js configuration file path
        require('autoprefixer'),
        require('postcss-import')
    ]
}*/



const purgecss = require('@fullhuman/postcss-purgecss')
const cssnano = require('cssnano')

module.exports = {
  plugins: [
      require('tailwindcss'),
      require('autoprefixer'),
      cssnano({
        preset: 'default'
      }),
      require('@fullhuman/postcss-purgecss')({
        content: [
            './templates/**/*.html.twig',
            './src/Form/**/*.php',
        ],
        defaultExtractor: content => content.match(/[A-Za-z0-9-_:/]+/g) || []
      })
  ]
}