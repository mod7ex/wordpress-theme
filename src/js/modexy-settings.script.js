jQuery(document).ready(function ($) {
	let frame;

	$("#notfound_image_uploader").on("click", (e) => {
		e.preventDefault();

		if (frame) {
			frame.open();
			return;
		}

		// frame = wp.media.frames.file_frame = wp.media({
		frame = wp.media({
			title: "Select Or Upload 404 Image",
			button: {
				text: "Upload 404 Image",
			},
			multiple: false,
		});

		frame.on("select", () => {
			let attachment = frame.state().get("selection").first().toJSON();

			$("#notfound-view").css("background-image", "url(" + attachment.url + ")");

			$("#notfound_image").val(attachment.id);

			$("#notfound_image_remover").removeClass("hidden");
			$("#notfound_image_msg").removeClass("hidden");
		});

		frame.open();
	});

	$("#notfound_image_remover").on("click", (e) => {
		e.preventDefault();

		$("#notfound_image").val("");
		$("#notfound-view").css("background-image", "url()");

		$("#notfound_image_remover").addClass("hidden");
		$("#notfound_image_msg").removeClass("hidden");
	});
});
