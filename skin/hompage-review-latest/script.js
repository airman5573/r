/**
 * @author https://www.cosmosfarm.com/
 */

jQuery(document).ready(function(){
	var hompageswiper = new Swiper(".hompage-review-latest", {
		slidesPerView: 3,
		spaceBetween: 15,
		pagination: {
			el: ".swiper-pagination",
			clickable: true
		},
		breakpoints: {
			1024: {
				slidesPerView: 3,
				spaceBetween: 30
			}
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev"
		}
	});
	
	// jQuery('.kboard-light-gallery').lightGallery({
	// 	select: '.target-video',
	// 	download: false,
	// 	getCaptionFromTitleOrAlt: false
	// });
	// jQuery('.kboard-hompage-review-slider-thumbnail').click(function(){
	// 	if(jQuery('.target-video', this).length > 0){
	// 		jQuery('.target-video', this).get(0).click();
	// 	}
	// });
});