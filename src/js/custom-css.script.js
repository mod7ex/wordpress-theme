let editor = ace.edit("css-editor");

editor.setTheme("ace/theme/monokai");

editor.session.setMode("ace/mode/css");

jQuery(document).ready(($) => {
	$("#custom_css_form").on("submit", (e) => {
		$("#hidden-editor").val(editor.getSession().getValue());
	});
});
