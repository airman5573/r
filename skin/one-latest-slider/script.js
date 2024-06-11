/**
 * @author https://www.cosmosfarm.com/
 */

jQuery(document).ready(function(){
	var oneswiper = new Swiper(".kboard-swiper", {
		slidesPerView: 1,
		spaceBetween: 13,
		pagination: {
			el: ".swiper-pagination",
			clickable: true
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
	// jQuery('.revew-latest-slider-thumbnail').click(function(){
	// 	if(jQuery('.target-video', this).length > 0){
	// 		jQuery('.target-video', this).get(0).click();
	// 	}
	// });
});