<?php
$article_url = esc_url($url->getDocumentURLWithUID($content->uid)) . '#kboard-document';

?>
<div class="kboard-list-item<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?> <?php echo esc_html($content->uid)?>">
	<div class="before-after-photo">
		<div class="wrapper">
			<div class="before-img-container">
				<?php kboard_dalia_display_image_list($content, 'after'); ?>
			</div>
			<div class="after-img-container">
				<?php kboard_dalia_display_image_list($content, 'before'); ?>
			</div>
			<div class="scroller">
                <i class="xi-caret-up"></i>
                <i class="xi-caret-up"></i>
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