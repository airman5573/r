<div id="kboard-dalia-before-after-list">
	
	<!-- 버튼 시작 -->
	<!-- <div class="kboard-control">
		<div class="kboard-control-search">
			<a href="#" onclick="kboard_dalia_before_after_search_toggle();return false;" title="<?php echo __('Search', 'kboard')?>"><img src="<?php echo $skin_path?>/images/icon-search.png" alt="<?php echo __('Search', 'kboard')?>"></a>
		</div>
		
	</div> -->
	<!-- 버튼 끝 -->
	
	<?php
	$cat1 = kboard_category1();
	// show this slide when $_GET['category1'] is not set
	if (!$cat1) { ?>
		<!-- 슬라이드 시작 -->
		<div id="kboard-dalia-before-after-list-slide" class="kboard-dalia-before-after-list-slide">
			<div class="kboard-dalia-before-after-list owl-carousel owl-theme owl-loaded owl-drag">
				<?php
				while($content = $list->hasNext()):
					$has_before_img = kboard_dalia_before_after_image_check($content, 'front_before_image');
					$has_after_img = kboard_dalia_before_after_image_check($content, 'front_after_image');
					if (!$has_before_img || !$has_after_img) continue;
					include 'list-slide.php';
				endwhile;
				?>
			</div>
		</div>
		<!-- 슬라이드 끝 -->
		<?php
	}
	?>
	
	
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

	<!-- 공지 글 시작 -->
	<div class="kboard-list notice-list notice-list-02">
		<ul>
			<?php while($content = $list->hasNextNotice()):?>
			<li class="kboard-list-notice <?php echo esc_attr($content->getClass())?>">
				<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>">
					<div class="kboard-list-title">
						<div class="kboard-list-uid">
							<?php dalia_print_notice_tag($content); ?>
						</div>
						<p class="kboard-default-cut-strings">
							<?php echo $content->title?>
						</p>
						<div class="kboard-mobile-contents">
							<span class="contents-item kboard-date"><?php echo $content->getDate()?></span>
						</div>
					</div>
					<span class="kboard-list-date"><?php echo $content->getDate()?></span>
				</a>
			</li>
			<?php endwhile?>
		</ul>
	</div>
	<!-- 공지 글 끝 -->
	
	<?php $list = $boardBuilder->getList()?>
	
	<!-- 리스트 시작 -->
	<ul class="kboard-dalia-before-after-list other">
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

	<!-- 검색폼 시작 -->
	<div class="kboard-dalia-before-after-search kboard-search">
		<form id="kboard-search-form-<?php echo $board->id?>" method="get" action="<?php echo esc_url($url->toString())?>">
			<?php echo $url->set('pageid', '1')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
			<select name="target">
				<option value=""><?php echo __('All', 'kboard')?></option>
				<option value="title"<?php if(kboard_target() == 'title'):?> selected<?php endif?>><?php echo __('Title', 'kboard')?></option>
				<option value="content"<?php if(kboard_target() == 'content'):?> selected<?php endif?>><?php echo __('Content', 'kboard')?></option>
			</select>
			<input type="text" name="keyword" value="<?php echo esc_attr(kboard_keyword())?>" placeholder="<?php echo __('Search', 'kboard')?>...">
			<button type="submit" class="kboard-dalia-before-after-button-small dalia-btn-01"><?php echo __('Search', 'kboard')?></button>
		</form>
	</div>
	<!-- 검색폼 끝 -->

	<?php if($board->isWriter()):?>
		<div class="kboard-control-write kboard-control flex-end">
			<a href="<?php echo esc_url($url->getContentEditor())?>" title="<?php echo __('New', 'kboard')?>" class="dalia-btn-01">글쓰기</a>
		</div>
	<?php endif?>

	<?php if($board->contribution()):?>
	<!-- <div class="kboard-dalia-before-after-poweredby">
		<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>">Powered by KBoard</a>
	</div> -->
	<?php endif?>
</div>

<?php
wp_enqueue_style('kboard-dalia-before-after-owl-carousel', "{$skin_path}/owl-carousel/assets/owl.carousel.min.css", array(), '2.3.4');
wp_enqueue_style('kboard-dalia-before-after-owl-theme-default', "{$skin_path}/owl-carousel/assets/owl.theme.default.min.css", array(), '2.3.4');
wp_enqueue_script('kboard-dalia-before-after-owl-carousel', "{$skin_path}/owl-carousel/owl.carousel.js", array('jquery'), '2.3.4', true);
wp_enqueue_script('kboard-dalia-before-after-list', "{$skin_path}/list.js", array(), KBOARD_VERSION, true);
?>
