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

let sibling_item = (i, n, boolVal = true) => {
	return (i + n + (-1) ** Number(!boolVal)) % n;
};

// in Js

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
