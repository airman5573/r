/**
 * @author https://www.cosmosfarm.com
 */

jQuery(document).ready(function(){
	jQuery('.kboard-sort select[name="kboard_list_sort"]').each(function(){
		var select = this;
		var form_id = jQuery(select).data('form');
		jQuery(select).selectmenu({
			classes: {
				'ui-selectmenu-button': 'kboard-selectmenu-sort-button',
				'ui-selectmenu-text': 'kboard-selectmenu-sort-text',
				'ui-selectmenu-menu': 'kboard-sort-ui-menu'
			},
			change: function(event, data){
				jQuery(form_id).submit();
			}
		});		
	});

	jQuery('.kboard-search select[name="target"]').selectmenu({
		classes: {
			'ui-selectmenu-button': 'kboard-selectmenu-search-button',
			'ui-selectmenu-text': 'kboard-selectmenu-search-text',
			'ui-selectmenu-menu': 'kboard-search-ui-menu'
		},
	});
	
	// jQuery('.kboard-light-gallery', '#kboard-image-gallery-list').lightGallery({
	// 	selector: '.target-image',
	// 	download: false,
	// 	getCaptionFromTitleOrAlt: false
	// });
	
	// jQuery('.kboard-image-gallery-thumbnail', '#kboard-image-gallery-list').click(function(){
	// 	if(jQuery('.target-image', this).length > 0){
	// 		jQuery('.target-image', this).get(0).click();
	// 	}
	// });
});