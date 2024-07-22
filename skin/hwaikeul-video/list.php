<div id="kboard-hwaikeul-video-list">
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
	
	<?php if($list->getNoticeList()):?>
	<div class="kboard-list notice-list-02 notice-list">
		<ul <?php if(kboard_hwaikeul_video_list($board)):?> <?php echo esc_attr(kboard_hwaikeul_video_list($board))?><?php endif?>">
			<?php while($content = $list->hasNextNotice()):?>
			<li class="kboard-list-notice<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
				<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>">
					<div class="kboard-list-title">
						
						<div class="kboard-list-uid">
						<?php
								$info_value = array();
								$info_value[] = sprintf('<span class="kboard-info-value notice-tag">공지</span>', __('Notice', 'kboard'));
								?>
								<?php if($info_value):?>
								<div class="kboard-image-gallery-info kboard-image-gallery-cut-strings">
									<?php echo implode('<span class="kboard-info-separator">ㆍ</span>', $info_value);?>
								</div>
								<?php endif?>
						</div>
							
								
						<p class="kboard-hwaikeul-video-title kboard-default-cut-strings">
							
							<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/lock-gray-14.png" srcset="<?php echo $skin_path?>/images/lock-gray-28.png 2x, <?php echo $skin_path?>/images/lock-gray-42.png 3x" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
							<?php echo $content->title?>
							<?php if($content->isNew()):?><span class="kboard-hwaikeul-video-new-notify">New</span><?php endif?>
						</p>
					</div>		
					<?php
						$info_value = array();
						$info_value[] = sprintf('<span class="kboard-info-value kboard-date kboard-list-date">%s</span>', $content->getDate());
						?>
						<?php if($info_value):?>
						<div class="kboard-hwaikeul-video-info kboard-hwaikeul-video-cut-strings">
							<?php echo implode('<span class="kboard-info-separator">ㆍ</span>', $info_value);?>
						</div>
					<?php endif?>
				</a>
			</li>
			<?php endwhile?>
		</ul>
	</div>
	<?php endif?>
	<p class="info-text">* 작성자들의 동의 하에 게시물 업로드하였습니다.</p>
	<ul class="kboard-list<?php if(kboard_hwaikeul_video_list($board)):?> <?php echo esc_attr(kboard_hwaikeul_video_list($board))?><?php endif?>">
	<?php while($content = $list->hasNext()):?>
		<li class="kboard-list-item<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
				<div class="item-padding">
					<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>">		
						<div class="kboard-hwaikeul-video-thumbnail">
							<?php if($content->option->youtube_id || $content->option->vimeo_id):?>
								<div class="kboard-light-gallery">
									<!-- <a href="<?php echo esc_url(kboard_hwaikeul_video_url_with_uid($content->uid))?>" class="target-video"> -->
										<?php if($content->getThumbnail(600, 338)):?>
											<div class="kboard-hwaikeul-video-container wide" style="background-image:url(<?php echo esc_url($content->getThumbnail(600, 338))?>)"></div>
										<?php elseif($content->option->youtube_id):?>
											<div class="kboard-hwaikeul-video-container wide" style="background-image:url(<?php echo esc_url($content->option->youtube_thumbnail_url)?>)"></div>
										<?php elseif($content->option->vimeo_id):?>
											<div class="kboard-hwaikeul-video-container wide" style="background-image:url(<?php echo esc_url($content->option->vimeo_thumbnail_url)?>)"></div>
										<?php endif?>
									<!-- </a> -->
								</div>
								<!-- <div class="enlarge-btn"><i class="xi-search"></i></div> -->
								<!-- <div class="kboard-hwaikeul-video-foreground"></div>
								<div class="kboard-hwaikeul-video-foreground-search"></div> -->
							<?php elseif(count((array)$content->getAttachmentList()) > 0): $count = 0?>
								<?php foreach($content->getAttachmentList() as $key=>$attach): $extension = strtolower(pathinfo($attach[0], PATHINFO_EXTENSION));?>
									<?php if(in_array($extension, array('mp4')) && $count == 0): $count++?>
										<div style="display:none;" id="video-<?php echo $content->uid?>-<?php echo $key?>">
											<video class="lg-video-object lg-html5" controls preload="none">
												<source src="<?php echo site_url($attach[0])?>" type="video/mp4">
											</video>
										</div>
										
										<div class="kboard-light-gallery">
											<div class="kboard-hwaikeul-video-container wide target-video" style="background-image:url(<?php echo esc_url($content->getThumbnail(600, 338))?>)" data-poster="<?php echo esc_url($content->getThumbnail(600, 338))?>" data-html="#video-<?php echo $content->uid?>-<?php echo $key?>" ></div>
										</div>
										<!-- <div class="kboard-hwaikeul-video-foreground"></div>
										<div class="kboard-hwaikeul-video-foreground-search"></div> -->
										<!-- <div class="enlarge-btn"><i class="xi-search"></i></div> -->
									<?php endif?>
								<?php endforeach?>
							<?php else:?>
								<!-- <a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>"> -->
									<?php if($content->getThumbnail(600, 338)):?>
										<div class="kboard-hwaikeul-video-container wide" style="background-image:url(<?php echo esc_url($content->getThumbnail(600, 338))?>)"></div>
									<?php else:?>
										<div class="kboard-hwaikeul-video-container wide no-image"></div>
									<?php endif?>
									<!-- <div class="kboard-hwaikeul-video-foreground"></div>
									<div class="kboard-hwaikeul-video-foreground-search"></div> -->
									<!-- <div class="enlarge-btn"><i class="xi-search"></i></div> -->
								<!-- </a> -->
							<?php endif?>
						</div>
							<div  class="kboard-hwaikeul-video-wrap">
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
								<div class="kboard-hwaikeul-video-info kboard-hwaikeul-video-cut-strings">
									<?php echo implode('<span class="kboard-info-separator">ㆍ</span>', $info_value);?>
									<!-- <span class="writer-name">
									<?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?>
									</span> -->
									<?php if($content->isNew()):?><span class="kboard-hwaikeul-video-new-notify new-mark">N</span><?php endif?>
								</div>
								<?php endif?>
							<!-- <a class="text-wrap" href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>"> -->
								<div class="kboard-hwaikeul-video-title gallery-title">
									
									<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/lock-gray-14.png" srcset="<?php echo $skin_path?>/images/lock-gray-28.png 2x, <?php echo $skin_path?>/images/lock-gray-42.png 3x" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
									<?php echo $content->title?>
									
								</div>
							<!-- </a> -->
							
						</a>
				</div>
				
			</div>
			
		</li>
	<?php endwhile?>
	</ul>
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
		<a href="<?php echo esc_url($url->getContentEditor())?>" class="kboard-hwaikeul-video-button-small dalia-btn-01"><span class="button-text text-new"><?php echo __('New', 'kboard')?></span></a>
	</div>
	<!-- 버튼 끝 -->
	<?php endif?>
	
</div>

<?php
wp_enqueue_style('jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js');
wp_enqueue_style('lightgallery', "{$skin_path}/lightgallery/css/lightgallery.min.css", array(), '1.6.11');
wp_enqueue_script('lightgallery-all', "{$skin_path}/lightgallery/js/lightgallery-all.min.js", array(), '1.6.11', true);
wp_enqueue_script('kboard-hwaikeul-video-list', "{$skin_path}/list.js", array('jquery'), KBOARD_VERSION, true);
?>