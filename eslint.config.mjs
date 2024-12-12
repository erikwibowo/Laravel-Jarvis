// eslint.config.mjs
// docs : https://github.com/antfu/eslint-config
import antfu from '@antfu/eslint-config'

export default antfu({
  vue: true,
  typescript: false,
  stylistic: {
    indent: 2,
    quotes: 'single',
  },

  jsonc: false,
  yaml: false,

  ignores: [
    // dependencies
    'node_modules',
    'vendor',

    // generated files
    'dist',
    'build',
    'public/build',
  ],
})
