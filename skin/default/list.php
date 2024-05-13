<div id="kboard-default-list" class="kboard-list-wrap">
	
	<!-- 게시판 정보 시작 -->
	<div class="kboard-list-header">
		<?php if(!$board->isPrivate()):?>
			<div class="kboard-total-count">
				<?php echo __('Total', 'kboard')?> <span class="text-mint"><?php echo number_format($board->getListTotal())?></span>
			</div>
		<?php endif?>
		
		<div class="kboard-sort">
			<form id="kboard-sort-form-<?php echo $board->id?>" method="get" action="<?php echo esc_url($url->toString())?>">
				<?php echo $url->set('pageid', '1')->set('category1', '')->set('category2', '')->set('target', '')->set('keyword', '')->set('mod', 'list')->set('kboard_list_sort_remember', $board->id)->toInput()?>
				
				<select name="kboard_list_sort" onchange="jQuery('#kboard-sort-form-<?php echo $board->id?>').submit();">
					<option value="newest"<?php if($list->getSorting() == 'newest'):?> selected<?php endif?>><?php echo __('Newest', 'kboard')?></option>
					<option value="best"<?php if($list->getSorting() == 'best'):?> selected<?php endif?>><?php echo __('Best', 'kboard')?></option>
					<option value="viewed"<?php if($list->getSorting() == 'viewed'):?> selected<?php endif?>><?php echo __('Viewed', 'kboard')?></option>
					<option value="updated"<?php if($list->getSorting() == 'updated'):?> selected<?php endif?>><?php echo __('Updated', 'kboard')?></option>
				</select>
			</form>
		</div>
	</div>
	<!-- 게시판 정보 끝 -->
	
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
	<div class="kboard-list">
		<table>
			<thead>
				<tr>
					<td class="kboard-list-uid"><?php echo __('Number', 'kboard')?></td>
					<td class="kboard-list-title"><?php echo __('Title', 'kboard')?></td>
					<!-- <td class="kboard-list-user"><?php echo __('Author', 'kboard')?></td> -->
					<td class="kboard-list-date"><?php echo __('Date', 'kboard')?></td>
					<!-- <td class="kboard-list-vote"><?php echo __('Votes', 'kboard')?></td>
					<td class="kboard-list-view"><?php echo __('Views', 'kboard')?></td> -->
				</tr>
			</thead>
			<tbody>
				<?php while($content = $list->hasNextNotice()):?>
				<tr class="<?php echo esc_attr($content->getClass())?>" onClick="location.href='<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>'">
					<td class="kboard-list-uid"> <span class="notice-tag">공지</span> </td>
					<td class="kboard-list-title">
							<div class="kboard-default-cut-strings">
								<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
								<?php echo $content->title?>
								<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
								<?php if($content->isNew()):?><span class="kboard-default-new-notify">N</span><?php endif?>
							</div>
						<div class="kboard-mobile-contents">
							<!-- <span class="contents-item kboard-user"><?php echo $content->getUserDisplay()?></span> -->
							<!-- <span class="contents-separator kboard-date">|</span> -->
							<span class="contents-item kboard-date"><?php echo $content->getDate()?></span>
							<!-- <span class="contents-separator kboard-vote">|</span> -->
							<!-- <span class="contents-item kboard-vote"><?php echo __('Votes', 'kboard')?> <?php echo $content->vote?></span> -->
							<!-- <span class="contents-separator kboard-view">|</span>
							<span class="contents-item kboard-view"><?php echo __('Views', 'kboard')?> <?php echo $content->view?></span> -->
						</div>
					</td>
					<!-- <td class="kboard-list-user"><?php echo $content->getUserDisplay()?></td> -->
					<td class="kboard-list-date"><?php echo $content->getDate()?></td>
					<!-- <td class="kboard-list-vote"><?php echo $content->vote?></td> -->
					<!-- <td class="kboard-list-view"><?php echo $content->view?></td> -->
				</tr>
				<?php endwhile?>
				<?php while($content = $list->hasNextPopular()):?>
				<tr class="<?php echo esc_attr($content->getClass())?>" onClick="location.href='<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>'">
					<td class="kboard-list-uid"><?php echo esc_html($board->getPopularName())?></td>
					<td class="kboard-list-title">
		
							<div class="kboard-default-cut-strings">
								<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
								<?php echo $content->title?>
								<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
								<?php if($content->isNew()):?><span class="kboard-default-new-notify">N</span><?php endif?>
							</div>
		
						<div class="kboard-mobile-contents">
							<!-- <span class="contents-item kboard-user"><?php echo $content->getUserDisplay()?></span> -->
							<!-- <span class="contents-separator kboard-date">|</span> -->
							<span class="contents-item kboard-date"><?php echo $content->getDate()?></span>
							<!-- <span class="contents-separator kboard-vote">|</span> -->
							<!-- <span class="contents-item kboard-vote"><?php echo __('Votes', 'kboard')?> <?php echo $content->vote?></span> -->
							<!-- <span class="contents-separator kboard-view">|</span>
							<span class="contents-item kboard-view"><?php echo __('Views', 'kboard')?> <?php echo $content->view?></span> -->
						</div>
					</td>
					<!-- <td class="kboard-list-user"><?php echo $content->getUserDisplay()?></td> -->
					<td class="kboard-list-date"><?php echo $content->getDate()?></td>
					<!-- <td class="kboard-list-vote"><?php echo $content->vote?></td> -->
					<!-- <td class="kboard-list-view"><?php echo $content->view?></td> -->
				</tr>
				<?php endwhile?>
				<?php while($content = $list->hasNext()):?>
				<tr class="<?php echo esc_attr($content->getClass())?>" onClick="location.href='<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>'">
					<td class="kboard-list-uid"><?php echo $list->index()?></td>
					<td class="kboard-list-title">
							<div class="kboard-default-cut-strings">
								
								<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
								<?php echo $content->title?>
								<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
								<?php if($content->isNew()):?><span class="kboard-default-new-notify new-mark">N</span><?php endif?>
							</div>
						<div class="kboard-mobile-contents">
							<!-- <span class="contents-item kboard-user"><?php echo $content->getUserDisplay()?></span> -->
							<!-- <span class="contents-separator kboard-date">|</span> -->
							<span class="contents-item kboard-date"><?php echo $content->getDate()?></span>
							<!-- <span class="contents-separator kboard-vote">|</span> -->
							<!-- <span class="contents-item kboard-vote"><?php echo __('Votes', 'kboard')?> <?php echo $content->vote?></span> -->
							<!-- <span class="contents-separator kboard-view">|</span>
							<span class="contents-item kboard-view"><?php echo __('Views', 'kboard')?> <?php echo $content->view?></span> -->
						</div>
					</td>
					<!-- <td class="kboard-list-user"><?php echo $content->getUserDisplay()?></td> -->
					<td class="kboard-list-date"><?php echo $content->getDate()?></td>
					<!-- <td class="kboard-list-vote"><?php echo $content->vote?></td> -->
					<!-- <td class="kboard-list-view"><?php echo $content->view?></td> -->
				</tr>
				<?php $boardBuilder->builderReply($content->uid)?>
				<?php endwhile?>
			</tbody>
		</table>
	</div>
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
		<form id="kboard-search-form-<?php echo $board->id?>" method="get" action="<?php echo esc_url($url->toString())?>">
			<?php echo $url->set('pageid', '1')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
			
			<select name="target">
				<option value=""><?php echo __('All', 'kboard')?></option>
				<option value="title"<?php if(kboard_target() == 'title'):?> selected<?php endif?>><?php echo __('Title', 'kboard')?></option>
				<option value="content"<?php if(kboard_target() == 'content'):?> selected<?php endif?>><?php echo __('Content', 'kboard')?></option>
				<option value="member_display"<?php if(kboard_target() == 'member_display'):?> selected<?php endif?>><?php echo __('Author', 'kboard')?></option>
			</select>
			<input type="text" name="keyword" value="<?php echo esc_attr(kboard_keyword())?>">
			<button type="submit" class="kboard-default-button-small dalia-btn-01"><?php echo __('Search', 'kboard')?></button>
		</form>
	</div>
	<!-- 검색폼 끝 -->
	
	<?php if($board->isWriter()):?>
	<!-- 버튼 시작 -->
	<div class="kboard-control flex-end">
		<a href="<?php echo esc_url($url->getContentEditor())?>" class="kboard-default-button-small  dalia-btn-01"><?php echo __('New', 'kboard')?></a>
	</div>
	<!-- 버튼 끝 -->
	<?php endif?>
	
	<?php if($board->contribution()):?>
	<?php endif?>
</div>