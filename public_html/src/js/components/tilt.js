import VainlaTilt from 'vanilla-tilt';

if (window.innerWidth > 1024) {	
	VanillaTilt.init(document.querySelectorAll(".poster__content > .image"), {
		max: 5,
		speed: 400
	});
}



