<div id="kboard-before-after-plus-list">
	
	<!-- 버튼 시작 -->
	<div class="kboard-control">
		<div class="kboard-control-search">
			<a href="#" onclick="kboard_before_after_plus_search_toggle();return false;" title="<?php echo __('Search', 'kboard')?>"><img src="<?php echo $skin_path?>/images/icon-search.png" alt="<?php echo __('Search', 'kboard')?>"></a>
		</div>
		<?php if($board->isWriter()):?>
		<div class="kboard-control-write">
			<a href="<?php echo esc_url($url->getContentEditor())?>" title="<?php echo __('New', 'kboard')?>"><img src="<?php echo $skin_path?>/images/icon-write.png" alt="<?php echo __('New', 'kboard')?>"></a>
		</div>
		<?php endif?>
	</div>
	<!-- 버튼 끝 -->
	
	<!-- 검색폼 시작 -->
	<div class="kboard-before-after-plus-search">
		<form id="kboard-search-form-<?php echo $board->id?>" method="get" action="<?php echo esc_url($url->toString())?>">
			<?php echo $url->set('pageid', '1')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
			
			<select name="target">
				<option value=""><?php echo __('All', 'kboard')?></option>
				<option value="title"<?php if(kboard_target() == 'title'):?> selected<?php endif?>><?php echo __('Title', 'kboard')?></option>
				<option value="content"<?php if(kboard_target() == 'content'):?> selected<?php endif?>><?php echo __('Content', 'kboard')?></option>
			</select>
			<input type="text" name="keyword" value="<?php echo esc_attr(kboard_keyword())?>" placeholder="<?php echo __('Search', 'kboard')?>...">
			<button type="submit" class="kboard-before-after-plus-button-small"><?php echo __('Search', 'kboard')?></button>
		</form>
	</div>
	<!-- 검색폼 끝 -->
	
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
	
	<!-- 슬라이드 시작 -->
	<div id="kboard-before-after-plus-list-slide" class="kboard-before-after-plus-list-slide">
		<div class="kboard-before-after-plus-list owl-carousel owl-theme owl-loaded owl-drag">
			<?php while($content = $list->hasNextNotice()):?>
				<?php include 'list-slide.php'?>
			<?php endwhile?>
			<?php while($content = $list->hasNext()):?>
				<?php include 'list-slide.php'?>
			<?php endwhile?>
		</div>
	</div>
	<!-- 슬라이드 끝 -->
	
	<?php $list = $boardBuilder->getList()?>
	
	<!-- 리스트 시작 -->
	<ul class="kboard-before-after-plus-list">
		<?php while($content = $list->hasNextNotice()):?>
			<?php include 'list-board-list.php'?>
		<?php endwhile?>
		<?php while($content = $list->hasNext()):?>
			<?php include 'list-board-list.php'?>
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
	
	<?php if($board->contribution()):?>
	<div class="kboard-before-after-plus-poweredby">
		<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>">Powered by KBoard</a>
	</div>
	<?php endif?>
</div>

<?php
wp_enqueue_style('kboard-before-after-plus-owl-carousel', "{$skin_path}/owl-carousel/assets/owl.carousel.min.css", array(), '2.3.4');
wp_enqueue_style('kboard-before-after-plus-owl-theme-default', "{$skin_path}/owl-carousel/assets/owl.theme.default.min.css", array(), '2.3.4');
wp_enqueue_script('kboard-before-after-plus-owl-carousel', "{$skin_path}/owl-carousel/owl.carousel.js", array('jquery'), '2.3.4', true);
wp_enqueue_script('kboard-before-after-plus-list', "{$skin_path}/list.js", array(), KBOARD_VERSION, true);
?>