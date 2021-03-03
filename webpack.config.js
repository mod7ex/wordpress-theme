const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
	mode: "development", // "production" | "development" | "none"

	entry: {
		"custom-css": "./src/js/custom-css.js",
		"modexy.admin": "./src/js/modexy-admin.js",

		"custom-scss": "./src/sass/custom.css.scss",
		"modexy.admin": "./src/sass/modexy.admin.scss",
		"modexy.settings": "./src/sass/modexy.settings.scss",
	},

	output: {
		path: path.resolve(__dirname, "asset/js"),
		filename: "[name].js",
	},

	plugins: [
		new MiniCssExtractPlugin({
			linkType: "text/css",
			filename: "../css/[name].css",
		}),
	],

	module: {
		rules: [
			{
				test: /\.m?js$/,
				include: path.resolve(__dirname, "src"),
				exclude: /(node_modules)/,
				use: {
					loader: "babel-loader",
					options: {
						presets: [["@babel/preset-env", { targets: "defaults" }]],
					},
				},
			},

			{
				test: /\.scss$/i,
				exclude: /(node_modules)/,
				use: [
					// "style-loader",

					MiniCssExtractPlugin.loader,

					"css-loader",

					"postcss-loader",

					"sass-loader",
				],
			},

			{
				test: /\.css$/i,
				exclude: /(node_modules)/,
				use: [MiniCssExtractPlugin.loader, "css-loader", "postcss-loader"],
			},
		],
	},
};
