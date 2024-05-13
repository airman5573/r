<?php
$article_url = esc_url($url->getDocumentURLWithUID($content->uid)) . '#kboard-document';

if (!function_exists('_getImageTag')) {
    function _getImageTag($content, $type, $position) {
        global $skin_path;
        $default_empty_img_src = "{$skin_path}/images/default-img.png";
        $beforeImageKey = "{$position}_before_image";
        $afterImageKey = "{$position}_after_image";
        
        // Check for 'before' or 'after' image based on the type
        $imageKey = ($type === 'after') ? $afterImageKey : $beforeImageKey;
        $imageExists = kboard_dalia_before_after_image_check($content, $imageKey);
        
        if (!$imageExists && !kboard_dalia_before_after_image_check($content, $beforeImageKey) && !kboard_dalia_before_after_image_check($content, $afterImageKey)) {
            // If neither before nor after images exist, return nothing
            return '';
        } elseif (!$imageExists) {
            // If image does not exist, show default empty image
            return "<img class='{$position} empty_img content-image' src='{$default_empty_img_src}' alt=''>";
        } else {
            // If image exists, show the image
            $imageUrl = kboard_dalia_before_after_image($content, $imageKey);
            return "<img class='{$position} content-image' src='{$imageUrl}' alt=''>";
        }
    }
}

if (!function_exists('displayImages')) {
    function displayImages($content, $type) {
        echo _getImageTag($content, $type, 'front');
    }
}
?>
<div class="kboard-list-item<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?> <?php echo esc_html($content->uid)?>">
	<div class="before-after-photo">
		<div class="wrapper">
			<div class="before-img-container">
				<?php displayImages($content, 'before'); ?>
			</div>
			<div class="after-img-container">
				<?php displayImages($content, 'after'); ?>
			</div>
			<div class="scroller">
				<svg class="scroller__thumb" xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><polygon points="0 50 37 68 37 32 0 50" style="fill:#fff"/><polygon points="100 50 64 32 64 68 100 50" style="fill:#fff"/></svg>
			</div>
		</div>
	</div>
    <a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>#kboard-document">
        <div class="kboard-list-title">
            <div class="kboard-dalia-before-after-cut-strings">
                <?php if($content->secret):?>
					<img src="<?php echo $skin_path?>/images/icon-lock.png" class="kboard-default-img" alt="<?php echo __('Secret', 'kboard')?>">
                <?php endif?>
                <?php if($content->category1):?>
                    <div class="detail-attr detail-category1 category-bullet">
                        <div class="detail-name"><?php echo $content->category1?></div>
                    </div>
                <?php endif?>
                <?php echo $content->title?>
                <?php if($content->isNew()):?>
                    <span class="kboard-dalia-before-after-new-notify new-mark">N</span>
                <?php endif?>
            </div>
        </div>
    </a>
</div>