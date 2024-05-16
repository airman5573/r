<div id="revew-latest" class="revew-latest<?php if(revew_latest_list($board, true)):?> <?php echo esc_attr(revew_latest_list($board, true))?><?php endif?>">
	<?php while($content = $list->hasNext()):?>
	<div class="revew-latest-item<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
		<div class="revew-latest-thumbnail">
			<div class="item-padding">
				<?php if($content->option->youtube_id || $content->option->vimeo_id):?>
					<div class="kboard-light-gallery">
						<a href="<?php echo esc_url(revew_latest_url_with_uid($content->uid))?>" class="target-video">
							<?php if($content->getThumbnail(700, 700)):?>
								<div class="revew-latest-container latest target-video" style="background-image:url(<?php echo esc_url($content->getThumbnail(700, 700))?>)"></div>
							<?php elseif($content->option->youtube_id):?>
								<div class="revew-latest-container latest target-video" style="background-image:url(<?php echo esc_url($content->option->youtube_thumbnail_url)?>)"></div>
							<?php elseif($content->option->vimeo_id):?>
								<div class="revew-latest-container latest target-video" style="background-image:url(<?php echo esc_url($content->option->vimeo_thumbnail_url)?>)"></div>
							<?php endif?>
						</a>
					</div>
					<div class="revew-latest-foreground"></div>
					<div class="revew-latest-foreground-search"></div>
				<?php elseif(count((array)$content->getAttachmentList()) > 0): $count = 0?>
					<?php foreach($content->getAttachmentList() as $key=>$attach): $extension = strtolower(pathinfo($attach[0], PATHINFO_EXTENSION));?>
						<?php if(in_array($extension, array('mp4')) && $count == 0): $count++?>
							<div style="display:none;" id="video-<?php echo $content->uid?>-<?php echo $key?>">
								<video class="lg-video-object lg-html5" controls preload="none">
									<source src="<?php echo site_url($attach[0])?>" type="video/mp4">
									Your browser does not support HTML5 video.
								</video>
							</div>
							
							<div class="kboard-light-gallery">
								<div class="revew-latest-container latest target-video" style="background-image:url(<?php echo esc_url($content->getThumbnail(700, 700))?>)" data-poster="<?php echo esc_url($content->getThumbnail(700, 700))?>" data-html="#video-<?php echo $content->uid?>-<?php echo $key?>" ></div>
							</div>
							<div class="revew-latest-foreground"></div>
							<div class="revew-latest-foreground-search"></div>
						<?php endif?>
					<?php endforeach?>
				<?php else:?>
				
						<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>">
							<?php if($content->getThumbnail(700, 700)):?>
								<div class="revew-latest-container latest latest" style="background-image:url(<?php echo esc_url($content->getThumbnail(700, 700))?>)"></div>
							<?php else:?>
								<div class="revew-latest-container latest no-image"></div>
							<?php endif?>
							<div class="revew-latest-foreground"></div>
							<div class="revew-latest-foreground-search"></div>
						</a>
			
				<?php endif?>
			</div>
		</div>
		<div class="thumbnail-text-wrapper">
			<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>" title="<?php echo esc_attr($content->title)?>">
				<div class="revew-latest-title revew-latest-cut-strings">
					<?php if($content->isNew()):?><span class="revew-latest-new-notify">N</span><?php endif?>
					<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/lock-gray-14.png" srcset="<?php echo $skin_path?>/images/lock-gray-28.png 2x, <?php echo $skin_path?>/images/lock-gray-42.png 3x" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
					<p class="text"><?php echo $content->title?></p>
				</div>
				<div class="revew-latest-date revew-cut-strings">
					<?php echo $content->getDate()?>
				</div>
			</a>
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
wp_enqueue_script('revew-latest', "{$skin_path}/latest.js", array('jquery'), KBOARD_VERSION, true);
?>