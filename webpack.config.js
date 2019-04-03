const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const path = require('path');

module.exports = (env, args) => {
	const isProduction = args.mode === 'production';
	return {
		context: path.resolve(__dirname),
		entry: './www/scripts/index.js',
		output: {
			path: path.join(__dirname, 'www/dist'),
			publicPath: isProduction ? '/dist/' : '/',
		},
		module: {
			rules: [
				{
					test: /\.css$/,
					use: [
						MiniCssExtractPlugin.loader,
						'css-loader',
					],
				},
			],
		},
		plugins: [
			new MiniCssExtractPlugin(),
		],
		devServer: {
			contentBase: path.join(__dirname, 'www/dist'),
			port: 3060,
		},
	};
};
