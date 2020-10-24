const path = require('path');
module.exports = {
    mode: 'development',
    entry: './js/index.js',
    output: {
        path: path.resolve(__dirname, '/js/budles'),
        filename: 'bundle.js',
    },

    module: {
        rules: [
            {
                test: /\.(js|jsx)$/,
                exclude: /(node_modules)/,
                loader: 'babel-loader',
            }
        ]
    }
};

// module.exports = (env, options) => {
//     //Установить source-map только для дев.режима
//     webpackConfig.devtool = options.mode === 'production'
//         ? false : 'eval-cheap-module-source-map';
//
//     //Обязательно вернуть конфиг
//     return webpackConfig;
// };