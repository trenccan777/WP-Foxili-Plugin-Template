const path = require('path');
const TerserJSPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const ESLintPlugin = require('eslint-webpack-plugin');

const config = require('./config');

//ESLINT options
const options = {
  extensions: [`js`, `jsx`, `ts`, `tsx`],
  fix: true,
  overrideConfig: {
    parser: '@babel/eslint-parser',
    parserOptions: {
      requireConfigFile: false,
      test: /\.(js|ts|tsx)$/,
      babelOptions: {
        presets: ['@babel/preset-react'],
      },
      project: ['./tsconfig.json'], // Specify it only for TypeScript files
    },
    //remove missing semicolon error when typescript
    parser: '@typescript-eslint/parser',

    settings: {
      'import/resolver': {
        node: {
          paths: ['src'],
          extensions: ['.js', '.jsx', '.ts', '.tsx'],
        },
      },
    },
    plugins: ['prettier'],
    //Pravidla su v subore .prettierrc
    rules: {
      'no-console': 'warn',
      'import/no-extraneous-dependencies': 0,
      'react/prop-types': 0,
      'prettier/prettier': ['error'],
      'jsx-a11y/label-has-associated-control': [
        'error',
        {
          required: {
            some: ['nesting', 'id'],
          },
        },
      ],
      'react/jsx-filename-extension': [
        1,
        { extensions: ['.js', '.jsx', '.ts', '.tsx'] },
      ],
      'import/extensions': [
        'error',
        'ignorePackages',
        {
          js: 'never',
          jsx: 'never',
          ts: 'never',
          tsx: 'never',
        },
      ],
      'react/jsx-props-no-spreading': 0,
      'react/require-default-props': 0,
      'no-unused-vars': 'off',
      '@typescript-eslint/no-unused-vars': 'error',
      '@typescript-eslint/no-misused-promises': [
        'error',
        { checksVoidReturn: { attributes: false } },
      ],
    },
    overrides: [
      {
        files: ['*.ts', '*.tsx'],
        rules: {
          'no-undef': 'off',
        },
      },
    ],
    env: {
      browser: true,
      node: true,
    },
    globals: {
      wpApiSettings: 'readonly',
    },
    extends: [
      'airbnb',
      'prettier',
      'plugin:@typescript-eslint/recommended',
      'plugin:@typescript-eslint/recommended-requiring-type-checking',
    ],
  },
};

module.exports = {
  optimization: {
    minimizer: [
      new TerserJSPlugin({
        terserOptions: {
          format: {
            comments: false,
          },
        },
        extractComments: false,
      }),
      new CssMinimizerPlugin(),
    ],
  },
  plugins: [
    //Nastavenie vystupu pre css
    new MiniCssExtractPlugin({
      filename: ({ chunk }) => {
        if (chunk.name === 'public') {
          return '../assets/css/public.css';
        } else {
          return `./css/${chunk.name.replace('/js/', '/css/')}.css`;
        }
      },
    }),
    new BrowserSyncPlugin({
      files: '**/*.php',
      proxy: config.proxyUrl,
      open: false, //Doesn't open browser automaticaly and not create error on WLS2
    }),
    new ESLintPlugin(options),
  ],
  module: {
    rules: [
      //Nastavenie babel loadera
      {
        test: /\.m?js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              [
                '@babel/preset-env',
                {
                  targets: {
                    esmodules: true,
                  },
                },
              ],
              '@babel/preset-react',
            ],
            plugins: [['@babel/plugin-proposal-class-properties']],
          },
        },
      },
      //Nastavenie postcss pre autoprefixer
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: { url: false, sourceMap: true },
          },
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [
                  [
                    require('autoprefixer')({
                      overrideBrowserslist: ['last 2 version'],
                    }),
                    {
                      // Options
                    },
                  ],
                ],
              },
            },
          },
          {
            loader: 'sass-loader',
          },
        ],
      },
      {
        test: /\.(ts|tsx)$/,
        use: 'ts-loader',
        exclude: /node_modules/,
      },
      {
        test: /\.(png|jpe?g|gif)$/i,
        use: [
          {
            loader: 'file-loader',
          },
        ],
      },
    ],
  },

  resolve: {
    extensions: ['.tsx', '.ts', '.js'],
  },
  //Nastavenie hlavnych js vstupov
  entry: config.sourcePaths,

  mode: 'development',
  //Enable read code for debugging
  //devtool: 'inline-source-map',
  output: {
    path: path.resolve(__dirname, 'assets'),
    filename: 'js/[name].js',
  },
};
