const path = require('path');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const FireConfig = require('./fire.config');

const isProduction = process.env.NODE_ENV === 'production';

const aliases = {
  '@': path.resolve(__dirname, '.'),
  '@component': path.resolve(__dirname, 'theme/assets/scripts/components'),
  '@utility': path.resolve(__dirname, 'theme/assets/scripts/utilities'),
  '@font': path.resolve(__dirname, 'theme/assets/fonts'),
  '@template': path.resolve(__dirname, 'templates'),
};

// prettier-ignore
const styleLoaders = [
  {
    test: /\.css$/i,
    use: [
      MiniCssExtractPlugin.loader,
      { loader: 'css-loader', options: { importLoaders: 1 } },
      'postcss-loader',
    ]
  },
];

const scriptLoaders = [
  {
    test: /\.m?js$/,
    use: {
      loader: 'babel-loader',
      options: {
        presets: [['@babel/preset-env', { shippedProposals: true }]],
        plugins: [['@babel/plugin-proposal-object-rest-spread', { loose: true, useBuiltIns: true }]],
      },
    },
  },
];

const fontLoaders = [
  {
    test: /\.(ttf|otf|eot|woff|woff2)$/,
    loader: 'url-loader',
    options: { limit: 10000, name: 'fonts/[name].[ext]' },
  },
];

module.exports = {
  mode: isProduction === true ? 'production' : 'development',
  entry: {
    styles: path.resolve(__dirname, `./theme/main.css`),
    scripts: path.resolve(__dirname, `./theme/main.js`),
  },
  output: { path: FireConfig.DESTINATION_PATH },
  module: { rules: [...scriptLoaders, ...styleLoaders, ...fontLoaders] },
  resolve: { alias: aliases },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '[name].css',
    }),
    new CleanWebpackPlugin({
      verbose: true,
      cleanAfterEveryBuildPatterns: ['!fonts/*'],
    }),
    new BrowserSyncPlugin(
      {
        proxy: FireConfig.PROXY_URL,
        port: process.env.PORT || FireConfig.DEFAULT_PORT,
        files: FireConfig.WATCHED_FILES,
        ghostMode: false,
      },
      { injectCss: true }
    ),
  ],
};
