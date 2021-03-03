/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/modexy-admin.script.js":
/*!***************************************!*\
  !*** ./src/js/modexy-admin.script.js ***!
  \***************************************/
/***/ (() => {

eval("jQuery(document).ready(function ($) {\n  var frame;\n  $(\"#profile_img_uploader\").on(\"click\", function (e) {\n    e.preventDefault();\n\n    if (frame) {\n      frame.open();\n      return;\n    } // frame = wp.media.frames.file_frame = wp.media({\n\n\n    frame = wp.media({\n      title: \"Select Or Upload Profile Picture\",\n      button: {\n        text: \"Upload Profile\"\n      },\n      multiple: false\n    });\n    frame.on(\"select\", function () {\n      var attachment = frame.state().get(\"selection\").first().toJSON();\n      $(\"#profile-img\").css(\"background-image\", \"url(\" + attachment.url + \")\");\n      $(\"#profile_img\").val(attachment.id);\n      $(\"#profile_img_remover\").removeClass(\"hidden\");\n      $(\"#profile_img_msg\").removeClass(\"hidden\");\n    });\n    frame.open();\n  });\n  $(\"#profile_img_remover\").on(\"click\", function (e) {\n    e.preventDefault();\n    $(\"#profile_img\").val(\"\");\n    $(\"#profile-img\").css(\"background-image\", \"url()\");\n    $(\"#profile_img_remover\").addClass(\"hidden\");\n    $(\"#profile_img_msg\").removeClass(\"hidden\");\n  });\n});\n\n//# sourceURL=webpack://modexy/./src/js/modexy-admin.script.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./src/js/modexy-admin.script.js"]();
/******/ 	
/******/ })()
;