const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
	mode: "development", // "production" | "development" | "none"

	entry: {
		// javascript files
		"custom.css": "./src/js/custom-css.script.js",
		"modexy.admin": "./src/js/modexy-admin.script.js",

		// scss files
		"custom-css": "./src/sass/custom-css.style.scss",
		"modexy-admin": "./src/sass/modexy-admin.style.scss",
		"modexy-settings": "./src/sass/modexy-settings.style.scss",
		"modexy-styles": "./src/sass/modexy-styles.scss",
	},

	output: {
		path: path.resolve(__dirname, "assets/js"),
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
