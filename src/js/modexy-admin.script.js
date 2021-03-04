jQuery(document).ready(function ($) {
	let frame;

	$("#profile_img_uploader").on("click", (e) => {
		e.preventDefault();

		if (frame) {
			frame.open();
			return;
		}

		// frame = wp.media.frames.file_frame = wp.media({
		frame = wp.media({
			title: "Select Or Upload Profile Picture",
			button: {
				text: "Upload Profile",
			},
			multiple: false,
		});

		frame.on("select", () => {
			let attachment = frame.state().get("selection").first().toJSON();

			$("#profile-img").css("background-image", "url(" + attachment.url + ")");

			$("#profile_img").val(attachment.id);

			$("#profile_img_remover").removeClass("hidden");
			$("#profile_img_msg").removeClass("hidden");
		});

		frame.open();
	});

	$("#profile_img_remover").on("click", (e) => {
		e.preventDefault();

		$("#profile_img").val("");
		$("#profile-img").css("background-image", "url()");

		$("#profile_img_remover").addClass("hidden");
		$("#profile_img_msg").removeClass("hidden");
	});
});
