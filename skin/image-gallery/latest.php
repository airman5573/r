<div id="kboard-image-gallery-latest"<?php if(kboard_image_gallery_list($board, true)):?> class="<?php echo kboard_image_gallery_list($board, true)?><?php endif?>">
	<?php while($content = $list->hasNext()):?>
	<div class="kboard-image-gallery-latest-item<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
		<div class="kboard-image-gallery-thumbnail">
			<?php if($content->getThumbnail(176, 132)):?>
				<div class="kboard-light-gallery">
					<div class="kboard-image-gallery-container latest target-image" data-thumb="<?php echo $content->getThumbnail(200, 200)?>" data-src="<?php echo $content->getThumbnail()?>">
						<img src="<?php echo $content->getThumbnail(176, 132)?>" alt="<?php echo esc_attr($content->title)?>">
					</div>
					<?php $media_list = $content->getMediaList()?>
					<?php if($media_list):?>
						<?php foreach($media_list as $media_item):?>
							<?php if($content->getThumbnail() == site_url($media_item->file_path)) continue?>
							<div class="kboard-image-gallery-container latest target-image" data-thumb="<?php echo kboard_resize($media_item->file_path, 200, 200)?>" data-src="<?php echo site_url($media_item->file_path)?>">
								<img src="<?php echo kboard_resize($media_item->file_path, 176, 132)?>" alt="<?php echo esc_attr(basename($media_item->file_name))?>">
							</div>
						<?php endforeach?>
					<?php endif?>
				</div>
				<div class="kboard-image-gallery-foreground"></div>
				<div class="kboard-image-gallery-foreground-search"></div>
			<?php else:?>
				<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>" title="<?php echo esc_attr($content->title)?>">
					<div class="kboard-image-gallery-container latest no-image"></div>
					<div class="kboard-image-gallery-foreground"></div>
					<div class="kboard-image-gallery-foreground-search"></div>
				</a>
			<?php endif?>
		</div>
		<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>" title="<?php echo esc_attr($content->title)?>">
			<div class="kboard-image-gallery-latest-title kboard-image-gallery-cut-strings">
				<?php if($content->isNew()):?><span class="kboard-image-gallery-new-notify">N</span><?php endif?>
				<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/lock-gray-14.png" srcset="<?php echo $skin_path?>/images/lock-gray-28.png 2x, <?php echo $skin_path?>/images/lock-gray-42.png 3x" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
				<?php echo $content->title?>
			</div>
		</a>
		<div class="kboard-image-gallery-latest-date kboard-image-gallery-cut-strings">
			<?php echo $content->getDate()?>
		</div>
	</div>
	<?php endwhile?>
</div>

<?php
wp_enqueue_style('jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js');
wp_enqueue_style('lightgallery', "{$skin_path}/lightgallery/css/lightgallery.min.css", array(), '1.6.11');
wp_enqueue_script('lightgallery', "{$skin_path}/lightgallery/js/lightgallery.min.js", array(), '1.6.11', true);
wp_enqueue_script('lightgallery-all', "{$skin_path}/lightgallery/js/lightgallery-all.min.js", array(), '1.6.11', true);
wp_enqueue_script('lg-zoom', "{$skin_path}/lightgallery/js/lg-zoom.min.js", array(), '1.1.0', true);
wp_enqueue_script('mousewheel', "{$skin_path}/lightgallery/js/mousewheel.min.js", array(), '3.1.12', true);
wp_enqueue_script('kboard-image-gallery-latest', "{$skin_path}/latest.js", array('jquery'), KBOARD_VERSION, true);
?>