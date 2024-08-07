<div id="video-gallery-list">
	<div class="kboard-header">
		<div class="kboard-total-count">
			<!-- <span class="entry-title"><?php echo $board->board_name?></span> -->
			전체
			<?php if(!$board->isPrivate()):?>
			<span class="count text-mint"><?php echo number_format($board->getListTotal())?></span>
			<?php endif?>
		</div>
		
		<div class="kboard-sort">
			<form id="kboard-sort-form-<?php echo $board->id?>" method="get" action="<?php echo esc_url($url->toString())?>">
				<?php echo $url->set('pageid', '1')->set('category1', '')->set('category2', '')->set('target', '')->set('keyword', '')->set('mod', 'list')->set('kboard_list_sort_remember', $board->id)->toInput()?>
				
				<select data-form="#kboard-sort-form-<?php echo $board->id?>" name="kboard_list_sort" onchange="jQuery('#kboard-sort-form-<?php echo $board->id?>').submit()">
					<option value="newest"<?php if($list->getSorting() == 'newest'):?> selected<?php endif?>><?php echo __('Newest', 'kboard')?></option>
					<option value="best"<?php if($list->getSorting() == 'best'):?> selected<?php endif?>><?php echo __('Best', 'kboard')?></option>
					<option value="viewed"<?php if($list->getSorting() == 'viewed'):?> selected<?php endif?>><?php echo __('Viewed', 'kboard')?></option>
					<option value="updated"<?php if($list->getSorting() == 'updated'):?> selected<?php endif?>><?php echo __('Updated', 'kboard')?></option>
				</select>
			</form>
		</div>
	</div>
	
	<!-- 카테고리 시작 -->
	<?php
	if($board->use_category == 'yes'){
		if($board->isTreeCategoryActive()){
			$category_type = 'tree-select';
		}
		else{
			$category_type = 'default';
		}
		$category_type = apply_filters('kboard_skin_category_type', $category_type, $board, $boardBuilder);
		echo $skin->load($board->skin, "list-category-{$category_type}.php", $vars);
	}
	?>
	<!-- 카테고리 끝 -->
	<!-- 리스트 시작 -->
	<?php if($list->getNoticeList() || $list->getList()):?>
	<ul class="kboard-list<?php if(kboard_hwaikeul_video_list($board)):?> <?php echo esc_attr(kboard_hwaikeul_video_list($board))?><?php endif?>">
		<?php if($list->getNoticeList()):?>
			<?php while($content = $list->hasNextNotice()):?>
				<li class="kboard-list-item<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
					<div class="item-padding">
						<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>">		
							<div class="video-gallery-thumbnail">
								<?php if($content->option->youtube_id || $content->option->vimeo_id):?>
									<div class="kboard-light-gallery">
										<?php if($content->getThumbnail(600, 600)):?>
											<div class="video-gallery-container wide" style="background-image:url(<?php echo esc_url($content->getThumbnail(600, 600))?>)"></div>
										<?php elseif($content->option->youtube_id):?>
											<div class="video-gallery-container wide" style="background-image:url(<?php echo esc_url($content->option->youtube_thumbnail_url)?>)"></div>
										<?php elseif($content->option->vimeo_id):?>
											<div class="video-gallery-container wide" style="background-image:url(<?php echo esc_url($content->option->vimeo_thumbnail_url)?>)"></div>
										<?php endif?>
									</div>
								<?php elseif(count((array)$content->getAttachmentList()) > 0): $count = 0?>
									<?php foreach($content->getAttachmentList() as $key=>$attach): $extension = strtolower(pathinfo($attach[0], PATHINFO_EXTENSION));?>
										<?php if(in_array($extension, array('mp4')) && $count == 0): $count++?>
											<div style="display:none;" id="video-<?php echo $content->uid?>-<?php echo $key?>">
												<video class="lg-video-object lg-html5" controls preload="none">
													<source src="<?php echo site_url($attach[0])?>" type="video/mp4">
												</video>
											</div>
											<div class="kboard-light-gallery">
												<div class="video-gallery-container wide target-video" style="background-image:url(<?php echo esc_url($content->getThumbnail(600, 338))?>)" data-poster="<?php echo esc_url($content->getThumbnail(600, 338))?>" data-html="#video-<?php echo $content->uid?>-<?php echo $key?>" ></div>
											</div>
										<?php endif?>
									<?php endforeach?>
								<?php else:?>
									<?php if($content->getThumbnail(600, 338)):?>
										<div class="video-gallery-container wide" style="background-image:url(<?php echo esc_url($content->getThumbnail(600, 338))?>)"></div>
									<?php else:?>
										<div class="video-gallery-container wide no-image"></div>
									<?php endif?>
								<?php endif?>
							</div>
							<div  class="video-gallery-wrap">
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
									<div class="video-gallery-info video-gallery-cut-strings">
										<?php echo implode('<span class="kboard-info-separator">ㆍ</span>', $info_value);?>
										<?php if($content->isNew()):?><span class="video-gallery-new-notify new-mark">N</span><?php endif?>
									</div>
								<?php endif?>
								<div class="video-gallery-title gallery-title">
									<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/lock-gray-14.png" srcset="<?php echo $skin_path?>/images/lock-gray-28.png 2x, <?php echo $skin_path?>/images/lock-gray-42.png 3x" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
									<?php echo $content->title?>
								</div>
							</div>
						</a>
					</div>
				</li>
			<?php endwhile?>
		<?php endif?>
		
		<?php while($content = $list->hasNext()):?>
			<li class="kboard-list-item<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
				<div class="item-padding">
					<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>">		
						<div class="video-gallery-thumbnail">
							<?php if($content->option->youtube_id || $content->option->vimeo_id):?>
								<div class="kboard-light-gallery">
									<?php if($content->getThumbnail(600, 338)):?>
										<div class="video-gallery-container wide" style="background-image:url(<?php echo esc_url($content->getThumbnail(600, 338))?>)"></div>
									<?php elseif($content->option->youtube_id):?>
										<div class="video-gallery-container wide" style="background-image:url(<?php echo esc_url($content->option->youtube_thumbnail_url)?>)"></div>
									<?php elseif($content->option->vimeo_id):?>
										<div class="video-gallery-container wide" style="background-image:url(<?php echo esc_url($content->option->vimeo_thumbnail_url)?>)"></div>
									<?php endif?>
								</div>
							<?php elseif(count((array)$content->getAttachmentList()) > 0): $count = 0?>
								<?php foreach($content->getAttachmentList() as $key=>$attach): $extension = strtolower(pathinfo($attach[0], PATHINFO_EXTENSION));?>
									<?php if(in_array($extension, array('mp4')) && $count == 0): $count++?>
										<div style="display:none;" id="video-<?php echo $content->uid?>-<?php echo $key?>">
											<video class="lg-video-object lg-html5" controls preload="none">
												<source src="<?php echo site_url($attach[0])?>" type="video/mp4">
											</video>
										</div>
										<div class="kboard-light-gallery">
											<div class="video-gallery-container wide target-video" style="background-image:url(<?php echo esc_url($content->getThumbnail(600, 338))?>)" data-poster="<?php echo esc_url($content->getThumbnail(600, 338))?>" data-html="#video-<?php echo $content->uid?>-<?php echo $key?>" ></div>
										</div>
									<?php endif?>
								<?php endforeach?>
							<?php else:?>
								<?php if($content->getThumbnail(600, 338)):?>
									<div class="video-gallery-container wide" style="background-image:url(<?php echo esc_url($content->getThumbnail(600, 338))?>)"></div>
								<?php else:?>
									<div class="video-gallery-container wide no-image"></div>
								<?php endif?>
							<?php endif?>
						</div>
						<div  class="video-gallery-wrap">
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
								<div class="video-gallery-info video-gallery-cut-strings">
									<?php echo implode('<span class="kboard-info-separator">ㆍ</span>', $info_value);?>
									<?php if($content->isNew()):?><span class="video-gallery-new-notify new-mark">N</span><?php endif?>
								</div>
							<?php endif?>
							<div class="video-gallery-title gallery-title">
								<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/lock-gray-14.png" srcset="<?php echo $skin_path?>/images/lock-gray-28.png 2x, <?php echo $skin_path?>/images/lock-gray-42.png 3x" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
								<?php echo $content->title?>
							</div>
						</div>
					</a>
				</div>
			</li>
		<?php endwhile?>
	</ul>
<?php endif?>
	<!-- 리스트 끝 -->
	
	<!-- 페이징 시작 -->
	<div class="kboard-pagination">
		<ul class="kboard-pagination-pages">
			<?php echo kboard_pagination($list->page, $list->total, $list->rpp)?>
		</ul>
	</div>
	<!-- 페이징 끝 -->
	
	<div class="kboard-search">
    	<form id="kboard-search-form-<?php echo $board->id?>" method="get" action="<?php echo esc_url($url->toString())?>">
    		<?php echo $url->set('pageid', '1')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
    		
    		<div class="kboard-search-wrap">
	    		<select name="target">
	    			<option value=""><?php echo __('All', 'kboard')?></option>
	    			<option value="title"<?php if(kboard_target() == 'title'):?> selected<?php endif?>><?php echo __('Title', 'kboard')?></option>
	    			<option value="content"<?php if(kboard_target() == 'content'):?> selected<?php endif?>><?php echo __('Content', 'kboard')?></option>
	    			<option value="member_display"<?php if(kboard_target() == 'member_display'):?> selected<?php endif?>><?php echo __('Author', 'kboard')?></option>
	    		</select>
	    		<input type="text" name="keyword" value="<?php echo esc_attr(kboard_keyword())?>">
	    		<button type="submit" class="button-search dalia-btn-01" title="<?php echo __('Search', 'kboard')?>">검색</button>
    		</div>
    	</form>
	</div>
	
	<?php if($board->isWriter()):?>
	<!-- 버튼 시작 -->
	<div class="kboard-control flex-end">
		<a href="<?php echo esc_url($url->getContentEditor())?>" class="video-gallery-button-small dalia-btn-01"><span class="button-text text-new"><?php echo __('New', 'kboard')?></span></a>
	</div>
	<!-- 버튼 끝 -->
	<?php endif?>
	
</div>

<?php
wp_enqueue_style('jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js');
wp_enqueue_style('lightgallery', "{$skin_path}/lightgallery/css/lightgallery.min.css", array(), '1.6.11');
wp_enqueue_script('lightgallery-all', "{$skin_path}/lightgallery/js/lightgallery-all.min.js", array(), '1.6.11', true);
wp_enqueue_script('video-gallery-list', "{$skin_path}/list.js", array('jquery'), KBOARD_VERSION, true);
?>