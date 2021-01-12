const path = require('path');

module.exports = {
    entry: {
        'impulse-components': './src/Resources/JS/Entries/ImpulseComponents.js',
        'impulse-core': './src/Resources/JS/Entries/ImpulseCore.js',
    },
    mode: 'development',
    output: {
        path: path.join(__dirname, "src", "Resources", "public", "js"),
        filename: "[name].js"
    },
    module: {
        rules: [
            {
                test: /.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            }
        ]
    }
};