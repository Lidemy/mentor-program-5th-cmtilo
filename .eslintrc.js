module.exports = {
  env: {
    browser: true,
    es6: true,
    node: true,
    jest: true,
    jquery: true
  },
  extends: '@lidemy/eslint-config-lidemy',
  globals: {
    Atomics: 'readonly',
    SharedArrayBuffer: 'readonly',
    jQuery: 'readonly'
  },
  parserOptions: {
    ecmaFeatures: {
      jsx: true
    },
    ecmaVersion: 2018
  },
  rules: {
    'no-console': 'off',
    'import/prefer-default-export': 'off'
  },
  settings: {
    'import/resolver': {
      webpack: {
        config: '../webpack-demo/webpack.config.js'
      }
    }
  }
}
