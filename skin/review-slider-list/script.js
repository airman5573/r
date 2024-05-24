/**
 * @author https://www.cosmosfarm.com/
 */

jQuery(document).ready(function(){
	var Swiper = new Swiper(".kboard-swiper", {
		slidesPerView: 1,
		pagination: {
			el: ".swiper-pagination",
			clickable: true
		},
		breakpoints: {
			1024: {
				slidesPerView: 1,
			}
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev"
		}
	});
	
});