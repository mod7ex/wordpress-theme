let sidebar = document.getElementById("sidebar");
let contact_form = document.querySelector("#contact-form form");

let alert_message = (message, bool) => {
	let msg = document.createElement("div");
	let class_name = bool ? "success" : "error";
	msg.className = "alert " + class_name;
	msg.innerHTML = "<h4>" + message + "</h4><span class='close'>&#10006;</span>";

	msg.querySelector(".close").addEventListener("click", () => {
		msg.remove();
	});

	setTimeout(() => {
		msg.remove();
	}, 7000);

	document.querySelector("body > div").appendChild(msg);
};

let pending_state = (bool = false) => {
	document.querySelector(".screen-overlay").classList.toggle("hidden");
	document.body.classList.toggle("no-scroll");

	if (bool) {
		document.querySelector(".screen-overlay .loading").classList.toggle("hidden");
	}
};

let sibling_item = (i, n, boolVal = true) => {
	return (i + n + (-1) ** Number(!boolVal)) % n;
};

/*
let next_item = (i, n) => {
	return (i + 1) % n;
};

let previous_item = (i, n) => {
	return (i + n - 1) % n;
};

document.querySelectorAll(".post-gallery").forEach((gallery) => {
	let gallery_nav_left = gallery.querySelector("span.gallery-nav-left"),
		gallery_nav_right = gallery.querySelector("span.gallery-nav-right");

	let galleryItems = gallery.querySelectorAll(".post-attachment");
	let n = galleryItems.length,
		slideInterval = null,
		currItem = 0;

	// functions
	let setSlideInterval = () => {
		clearInterval(slideInterval);

		slideInterval = setInterval(() => {
			next_slide();
		}, base.gallery_delay);
	};

	let next_slide = () => {
		setSlideInterval();
		currItem = next_item(currItem, n);

		galleryItems[previous_item(currItem, n)].classList.toggle("hidden");
		galleryItems[currItem].classList.toggle("hidden");

		gallery_nav_right.querySelector("small.thumnail").style.backgroundImage = galleryItems[next_item(currItem, n)].style.backgroundImage;
		gallery_nav_left.querySelector("small.thumnail").style.backgroundImage = galleryItems[previous_item(currItem, n)].style.backgroundImage;
	};

	let previous_slide = () => {
		setSlideInterval();
		currItem = previous_item(currItem, n);

		galleryItems[next_item(currItem, n)].classList.toggle("hidden");
		galleryItems[currItem].classList.toggle("hidden");

		gallery_nav_right.querySelector("small.thumnail").style.backgroundImage = galleryItems[next_item(currItem, n)].style.backgroundImage;
		gallery_nav_left.querySelector("small.thumnail").style.backgroundImage = galleryItems[previous_item(currItem, n)].style.backgroundImage;
	};

	gallery_nav_right.addEventListener("click", () => {
		next_slide();
	});

	gallery_nav_left.addEventListener("click", () => {
		previous_slide();
	});

	galleryItems[currItem].classList.toggle("hidden");

	setSlideInterval();
});
*/

window.addEventListener("DOMContentLoaded", (event) => {
	document.querySelectorAll(".post-gallery").forEach((gallery) => {
		let gallery_nav_left = gallery.querySelector("span.gallery-nav-left"),
			gallery_nav_right = gallery.querySelector("span.gallery-nav-right");

		let galleryItems = gallery.querySelectorAll(".post-attachment");
		let n = galleryItems.length,
			slideInterval = null,
			currItem = 0;

		// functions
		let sibling_slide = (boolVal = true) => {
			setSlideInterval();
			currItem = sibling_item(currItem, n, boolVal);

			galleryItems[sibling_item(currItem, n, !boolVal)].classList.toggle("hidden");
			galleryItems[currItem].classList.toggle("hidden");

			gallery_nav_right.querySelector("small.thumnail").style.backgroundImage = galleryItems[sibling_item(currItem, n)].style.backgroundImage;
			gallery_nav_left.querySelector("small.thumnail").style.backgroundImage = galleryItems[sibling_item(currItem, n, false)].style.backgroundImage;
		};

		let setSlideInterval = (boolVal = true) => {
			clearInterval(slideInterval);

			slideInterval = setInterval(() => {
				sibling_slide(boolVal);
			}, base.gallery_delay);
		};

		gallery_nav_right.addEventListener("click", () => {
			sibling_slide();
		});

		gallery_nav_left.addEventListener("click", () => {
			sibling_slide(false);
		});

		galleryItems[currItem].classList.toggle("hidden");

		setSlideInterval(true);
	});

	// Side bar

	document.querySelectorAll(".sidebar-toggler").forEach((toggler) => {
		toggler.addEventListener("click", () => {
			sidebar.classList.toggle("hidden");
			pending_state();
		});
	});

	// Prevent submitting an empty form

	document.querySelectorAll(".search-form").forEach((form) => {
		form.addEventListener("submit", (e) => {
			if (form.querySelector("input").value == "") {
				e.preventDefault();
			}
		});
	});

	contact_form.addEventListener("submit", (e) => {
		e.preventDefault();

		pending_state(true);

		let name = contact_form.querySelector("#name").value,
			email = contact_form.querySelector("#email").value,
			message = contact_form.querySelector("#message").value;

		let contactForm = new FormData();

		contactForm.append("name", name);
		contactForm.append("email", email);
		contactForm.append("message", message);
		contactForm.append("_nonce", base.nonce);
		contactForm.append("action", base.contact_us);

		fetch(base.ajax_url, {
			method: "POST",
			body: contactForm,
		})
			.then((resp) => {
				return resp.json();
			})
			.then((feed) => {
				alert_message(feed.message, feed.bool);
			})
			.catch((err) => {
				alert_message("Oops something went wrong", false);
			})
			.then(() => {
				pending_state(true);
			});
	});
});
