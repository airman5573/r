<div id="kboard-ocean-faq-list">
	
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
	<div class="kboard-header"> <?php
		dalia_print_kbaord_current_category_article_count($board); ?>
		<div class="kboard-sort">
			<form id="kboard-sort-form-<?php echo $board->id?>" method="get" action="<?php echo $url->toString()?>">
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

	<!-- 공지 글 더미 -->
	<!-- <div class="kboard-list notice-list notice-list-02">
		<ul>
			<li class="kboard-list-notice">
				<a href="">
					<div class="kboard-list-title">
						<div class="kboard-list-uid"> <span class="notice-tag">공지</span> </div>
							<p class="kboard-default-cut-strings">
								[공지] 달리아 에스테틱 2023년 추석 연휴 지점안내
							</p>
						
						<div class="kboard-mobile-contents">
							<span class="contents-item kboard-date">2024.04.08</span>
						</div>
					</div>
					<span class="kboard-list-date">2024.04.08</span>
				</a>
			</li>
		</ul>
	</div> -->
	<!-- 공지 글 -->
	
	<!-- 리스트 시작 -->
	<ul class="kboard-list">
	<?php while($content = $list->hasNext()):?>
		<li class="kboard-faq-item" data-index="<?php $faq_item_index=$list->index(); echo $faq_item_index;?>">
			<div class="kboard-faq-question" onclick="kboard_faq_view_answer('<?php echo $faq_item_index?>')">
			<!-- 카테고리 불릿 추가 -->
			<?php dalia_print_category1_name($content); ?>
			<!-- 카테고리 불릿 추가 -->
			<?php echo $content->title?><?php if($content->isNew()):?><span class="kboard-hwaikeul-video-slider-new-notify new-mark">N</span><?php endif?></div>
			
			<div class="kboard-faq-answer">
				<?php echo kboard_ocean_faq_content($board, $boardBuilder, $content)?>
				<div class="kboard-faq-control">
						<div class="left">
							<?php if($board->isEditor($content->member_uid) || $board->permission_write=='all'):?>
							<a href="<?php echo $url->getContentEditor($content->uid)?>" class="kboard-ocean-faq-button-small dalia-btn-04"><?php echo __('Edit', 'kboard')?></a>
							<a href="<?php echo $url->getContentRemove($content->uid)?>" class="kboard-ocean-faq-button-small dalia-btn-04" onclick="return confirm('<?php echo __('Are you sure you want to delete?', 'kboard')?>');"><?php echo __('Delete', 'kboard')?></a>
							<?php endif?>
						</div>
						<div class="right">
							<?php if($board->meta->ocean_faq_count):?><span class="kboard-ocean-faq-view"><?php echo __('Views', 'kboard')?> <?php echo $content->view?></span><?php endif?>
						</div>
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
	
	<!-- 검색폼 시작 -->
	<div class="kboard-search">
		<form id="kboard-search-form-<?php echo $board->id?>" method="get" action="<?php echo $url->toString()?>">
			<?php echo $url->set('pageid', '1')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
			
			<select name="target">
				<option value=""><?php echo __('All', 'kboard')?></option>
				<option value="title"<?php if(kboard_target() == 'title'):?> selected<?php endif?>><?php echo __('Title', 'kboard')?></option>
				<option value="content"<?php if(kboard_target() == 'content'):?> selected<?php endif?>><?php echo __('Content', 'kboard')?></option>
				<option value="member_display"<?php if(kboard_target() == 'member_display'):?> selected<?php endif?>><?php echo __('Author', 'kboard')?></option>
			</select>
			<input type="text" name="keyword" value="<?php echo kboard_keyword()?>">
			<button type="submit" class="kboard-ocean-faq-button-small dalia-btn-01"><?php echo __('Search', 'kboard')?></button>
		</form>
	</div>
	<!-- 검색폼 끝 -->
	
	<?php if($board->isWriter()):?>
	<!-- 버튼 시작 -->
	<div class="kboard-control flex-end">
		<a href="<?php echo $url->getContentEditor()?>" class="kboard-ocean-faq-button-small dalia-btn-01"><?php echo __('New', 'kboard')?></a>
	</div>
	<!-- 버튼 끝 -->
	<?php endif?>
	
	<?php if($board->contribution()):?>
	<div class="kboard-ocean-faq-poweredby">
		<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href); return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>"></a>
	</div>
	<?php endif?>
</div>

<?php wp_enqueue_script('kboard-ocean-faq-list', "{$skin_path}/list.js", array(), KBOARD_VERSION, true)?>