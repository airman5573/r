<div class="slider-wrap">
	<div class="video-gallery-slider-list kboard-swiper">
		<ul class="swiper-wrapper video-gallery-slider kboard-list<?php if(video_gallery_list($board)):?> <?php echo esc_attr(video_gallery_list($board))?><?php endif?>">
			<?php while($content = $list->hasNext()): if ($content->notice) { continue; } ?>
				<li class="swiper-slide kboard-list-item<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
					<div class="item-padding">
						<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>">
							<div class="video-gallery-slider-thumbnail">
								<?php if($content->getThumbnail(600, 600)):?>
									<div class="kboard-hwaikeul-video-slider-container wide" style="background-image:url(<?php echo esc_url($content->getThumbnail(600, 600))?>)"></div>
								<?php elseif($content->option->youtube_id):?>
									<div class="kboard-hwaikeul-video-slider-container wide" style="background-image:url(<?php echo esc_url($content->option->youtube_thumbnail_url)?>)"></div>
								<?php elseif($content->option->vimeo_id):?>
									<div class="kboard-hwaikeul-video-slider-container wide" style="background-image:url(<?php echo esc_url($content->option->vimeo_thumbnail_url)?>)"></div>
								<?php endif?>
							</div>
							<div class="video-gallery-slider-wrap">
								<div class="video-gallery-slider-title gallery-title">
									<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/lock-gray-14.png" srcset="<?php echo $skin_path?>/images/lock-gray-28.png 2x, <?php echo $skin_path?>/images/lock-gray-42.png 3x" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
									<?php echo $content->title?>
								</div>
							</div>
						</a>
					</div>
				</li>
			<?php endwhile?>
		</ul>
		<div class="swiper-button-next">
			<svg class="flickity-button-icon" viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow" transform="translate(100, 100) rotate(180) "></path></svg>
		</div>
		<div class="swiper-button-prev">
			<svg class="flickity-button-icon" viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow"></path></svg>
		</div>
		<div class="swiper-pagination"></div>
	</div>
</div>

<?php
wp_enqueue_style('swiper', '//unpkg.com/swiper/swiper-bundle.min.css', array(), '8.4.3');
wp_enqueue_script('swiper', '//unpkg.com/swiper/swiper-bundle.min.js', array(), '8.4.3', true);
wp_enqueue_style('lightgallery', "{$skin_path}/lightgallery/css/lightgallery.min.css", array(), '1.6.11');
wp_enqueue_script('lightgallery-all', "{$skin_path}/lightgallery/js/lightgallery-all.min.js", array(), '1.6.11', true);
wp_enqueue_script('lg-zoom', "{$skin_path}/lightgallery/js/lg-zoom.min.js", array(), '1.1.0', true);
wp_enqueue_script('video-gallery-slider-latestview-slider', "{$skin_path}/script.js", array(), '1.0', true);
?>