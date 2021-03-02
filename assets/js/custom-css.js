var editor = ace.edit("css-editor");

editor.setTheme("ace/theme/monokai");

editor.session.setMode("ace/mode/css");

jQuery(document).ready(function ($) {
	$("form").on("submit", function (e) {
		$("#hidden-editor").val(editor.getSession().getValue());
	});
});
