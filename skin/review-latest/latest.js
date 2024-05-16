/**
 * @author https://www.cosmosfarm.com
 */

jQuery(document).ready(function(){
	jQuery('.kboard-light-gallery', '.revew-latest-latest').lightGallery({
		select: '.target-video',
		download: false,
		getCaptionFromTitleOrAlt: false
	});
	
	jQuery('.revew-latest-thumbnail', '.revew-latest-latest').click(function(){
		if(jQuery('.target-video', this).length > 0){
			jQuery('.target-video', this).get(0).click();
		}
	});
});