<div class="slider-wrap">
	<div class="kboard-hwaikeul-video-slider-list kboard-swiper">
		<ul class="swiper-wrapper hompage-review-latest kboard-list<?php if(kboard_hwaikeul_video_list($board)):?> <?php echo esc_attr(kboard_hwaikeul_video_list($board))?><?php endif?>">
		<?php while($content = $list->hasNext()):?>
			<li class="swiper-slide kboard-list-item<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
				<div class="item-padding">
					<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>">
						<div class="kboard-hwaikeul-video-slider-thumbnail">
							<?php if($content->option->youtube_id || $content->option->vimeo_id):?>
								<div class="kboard-light-gallery">
									<!-- <a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>" class="target-video"> -->
										<?php if($content->getThumbnail(600, 338)):?>
											<div class="kboard-hwaikeul-video-slider-container wide" style="background-image:url(<?php echo esc_url($content->getThumbnail(600, 338))?>)"></div>
										<?php elseif($content->option->youtube_id):?>
											<div class="kboard-hwaikeul-video-slider-container wide" style="background-image:url(<?php echo esc_url($content->option->youtube_thumbnail_url)?>)"></div>
										<?php elseif($content->option->vimeo_id):?>
											<div class="kboard-hwaikeul-video-slider-container wide" style="background-image:url(<?php echo esc_url($content->option->vimeo_thumbnail_url)?>)"></div>
										<?php endif?>
									<!-- </a> -->
								</div>
								<!-- <div class="kboard-hwaikeul-video-slider-foreground"></div>
								<div class="kboard-hwaikeul-video-slider-foreground-search"></div> -->
							<?php elseif(count((array)$content->getAttachmentList()) > 0): $count = 0?>
								<?php foreach($content->getAttachmentList() as $key=>$attach): $extension = strtolower(pathinfo($attach[0], PATHINFO_EXTENSION));?>
									<?php if(in_array($extension, array('mp4')) && $count == 0): $count++?>
										<div style="display:none;" id="video-<?php echo $content->uid?>-<?php echo $key?>">
											<video class="lg-video-object lg-html5" controls preload="none">
												<source src="<?php echo site_url($attach[0])?>" type="video/mp4">
											</video>
										</div>
										<div class="kboard-light-gallery">
											<div class="kboard-hwaikeul-video-slider-container wide target-video" style="background-image:url(<?php echo esc_url($content->getThumbnail(600, 338))?>)" data-poster="<?php echo esc_url($content->getThumbnail(600, 338))?>" data-html="#video-<?php echo $content->uid?>-<?php echo $key?>" ></div>
										</div>
										<!-- <div class="kboard-hwaikeul-video-slider-foreground"></div>
										<div class="kboard-hwaikeul-video-slider-foreground-search"></div> -->
									<?php endif?>
								<?php endforeach?>
								<?php else:?>
									<!-- <a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>"> -->
										<?php if($content->getThumbnail(600, 338)):?>
											<div class="kboard-hwaikeul-video-slider-container wide" style="background-image:url(<?php echo esc_url($content->getThumbnail(600, 338))?>)"></div>
										<?php else:?>
											<div class="kboard-hwaikeul-video-slider-container wide no-image"></div>
										<?php endif?>
										<!-- <div class="kboard-hwaikeul-video-slider-foreground"></div>
										<div class="kboard-hwaikeul-video-slider-foreground-search"></div> -->
									<!-- </a> -->
								<?php endif?>
							
						</div>
						<div class="kboard-hwaikeul-video-slider-wrap">
							<!-- <a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>"> -->
							<?php
								$info_value = array();
								$info_value[] = sprintf('<span class="kboard-info-value kboard-date">%s</span>', $content->getDate());
								if($content->category1){
									$info_value[] = sprintf('<span class="kboard-info-value kboard-category1">%s</span>', $content->category1);
								}
								if($content->category2){
									$info_value[] = sprintf('<span class="kboard-info-value kboard-category2">%s</span>', $content->category2);
								}
								if($content->option->tree_category_1){
									for($i=1; $i<=$content->getTreeCategoryDepth(); $i++){
										$info_value[] = sprintf('<span class="kboard-info-value kboard-tree-category-'.$i.'">%s</span>', $content->option->{'tree_category_'.$i});
									}
								}
								?>
								<?php if($info_value):?>
								<div class="kboard-hwaikeul-video-slider-info kboard-hwaikeul-video-slider-cut-strings">
									<?php echo implode('<span class="kboard-info-separator">ㆍ</span>', $info_value);?>
									<?php if($content->isNew()):?><span class="kboard-hwaikeul-video-slider-new-notify new-mark">N</span><?php endif?>
								</div>
							<?php endif?>
								<div class="kboard-hwaikeul-video-slider-title gallery-title">
									
									<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/lock-gray-14.png" srcset="<?php echo $skin_path?>/images/lock-gray-28.png 2x, <?php echo $skin_path?>/images/lock-gray-42.png 3x" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
									<?php echo $content->title?>

									
								</div>

							<!-- </a> -->
							
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
wp_enqueue_script('kboard-hwaikeul-video-slider-latestview-slider', "{$skin_path}/script.js", array(), '1.0', true);
?>