<div id="kboard-qna-list">
	
	<!-- 카테고리 시작 -->
	<?php
		if($board->use_category == 'yes'){
			if($board->isTreeCategoryActive()){
				$category_type = 'default';
			}
			else{
				$category_type = 'default';
			}
			$category_type = apply_filters('kboard_skin_category_type', $category_type, $board, $boardBuilder);
			echo $skin->load($board->skin, "list-category-{$category_type}.php", $vars);
		}
		?>
	<!-- 카테고리 끝 -->
	<!-- 게시판 정보 시작 -->
	<div class="kboard-list-header">
		<!-- <div class="kboard-left">
			<?php if($board->isWriter()):?>
				<a href="<?php echo $url->getContentEditor()?>" class="kboard-qna-button-small dalia-btn-01"><?php echo __('New', 'kboard')?></a>
			<?php endif?>
		</div> -->
		
		<div class="kboard-right">
			
		</div>
	</div>
	<div class="kboard-list-top flex-item space-between">
		<?php dalia_print_kbaord_current_category_article_count($board); ?>
		<?php dalia_print_branch_location_select_ui(); ?>
	</div>
	<!-- 게시판 정보 끝 -->
	
	<!-- 리스트 시작 -->
	<?php
	if($board->initCategory2()){
		$status_list = $board->category;
	}
	else{
		$status_list = kboard_ask_status();
	}
	?>
	<div class="kboard-list">
		<table>
			<thead>
				<tr>
					<td class="kboard-list-uid"><?php echo __('Number', 'kboard')?></td>
<!-- 					
					<?php if($board->use_category == 'yes' && $board->initCategory1()):?>
						<td class="kboard-list-category"><?php echo __('Category', 'kboard')?></td>
					<?php endif?> -->
					
					<td class="kboard-list-title"><?php echo __('Title', 'kboard')?></td>
					<td class="kboard-list-status"><?php echo __('Status', 'kboard')?></td>
					<td class="kboard-list-user"><?php echo __('Author', 'kboard')?></td>
					<td class="kboard-list-date"><?php echo __('Date', 'kboard')?></td>
					<td class="kboard-list-vote"><?php echo __('Votes', 'kboard')?></td>
					<td class="kboard-list-view"><?php echo __('Views', 'kboard')?></td>
				</tr>
			</thead>
			<tbody>
				<?php while($content = $list->hasNextNotice()):?>
				<tr class="kboard-list-notice<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>" onClick="location.href='<?php echo $url->getDocumentURLWithUID($content->uid)?>'">
					<td class="kboard-list-uid"><span class="notice-tag">공지</span></td>
					
					<!-- <?php if($board->use_category == 'yes' && $board->initCategory1()):?>
						<td class="kboard-list-category"><?php echo $content->category1?></td>
					<?php endif?> -->
					
					<td class="kboard-list-title">
					
							<?php if($content->category2):?>
								<div class="kboard-mobile-status">
									<span class="kboard-staff-compliment-status status-<?php echo array_search($content->category2, $status_list)?>"><?php echo $content->category2?></span>
								</div>
							<?php endif?>
							<div class="kboard-staff-compliment-cut-strings">
								<?php if($content->secret):?><i class="xi-lock kboard-icon-lock"></i><?php endif?>
								
								<?php if($board->use_category == 'yes' && $board->initCategory1()):?>
									<span class="kboard-mobile-category"><?php if($content->category1):?>[<?php echo $content->category1?>]<?php endif?></span>
								<?php endif?>
								
								<?php echo $content->title?>
								<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
								<?php if($content->isNew()):?><span class="kboard-hwaikeul-video-slider-new-notify new-mark">N</span><?php endif?>
							</div>
							<div class="kboard-mobile-contents">
								<span class="contents-item kboard-user"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?></span>
								<span class="contents-separator kboard-date">|</span>
								<span class="contents-item kboard-date"><?php echo $content->getDate()?></span>
							</div>
				
					</td>
					<td class="kboard-list-status">
						<?php if($content->category2):?>
							<!-- <span class="kboard-qna-status status-<?php echo array_search($content->category2, $status_list)?>"><?php echo $content->category2?></span> -->
						<?php endif?>
					</td>
					<td class="kboard-list-user">
						<!-- <?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?> -->
					</td>
					<td class="kboard-list-date"><?php echo $content->getDate()?></td>
					<td class="kboard-list-vote"><?php echo $content->vote?></td>
					<td class="kboard-list-view"><?php echo $content->view?></td>
				</tr>
				<?php endwhile?>
				<?php while($content = $list->hasNext()):?>
				<tr class="<?php if($content->uid == kboard_uid()):?>kboard-list-selected<?php endif?>" onClick="location.href='<?php echo $url->getDocumentURLWithUID($content->uid)?>'">
					<td class="kboard-list-uid"><?php echo $list->index()?></td>
					<!-- <?php if($board->use_category == 'yes' && $board->initCategory1()):?>
						<td class="kboard-list-category"><?php echo $content->category1?></td>
					<?php endif?> -->
					<td class="kboard-list-title">
							<?php if($content->category2):?>
								<div class="kboard-mobile-status">
									<span class="kboard-staff-compliment-status status-<?php echo array_search($content->category2, $status_list)?>"><?php echo $content->category2?></span>
								</div>
							<?php endif?>
							<div class="kboard-staff-compliment-cut-strings">
								<?php dalia_print_branch_term_name($content); ?>
								<?php if($content->secret):?><i class="xi-lock kboard-icon-lock"></i><?php endif?>
								
								<?php if($board->use_category == 'yes' && $board->initCategory1()):?>
									<span class="kboard-mobile-category"><?php if($content->category1):?>[<?php echo $content->category1?>]<?php endif?></span>
								<?php endif?>
								
								<?php echo $content->title?>
								<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
								<?php if($content->isNew()):?><span class="new-mark">N</span><?php endif?>
							</div>
							<div class="kboard-mobile-contents">
								<span class="contents-item kboard-user"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?></span>
								<span class="contents-separator kboard-date">|</span>
								<span class="contents-item kboard-date"><?php echo $content->getDate()?></span>
							</div>
					</td>
					<td class="kboard-list-status">
						<?php if($content->category2):?>
							<span class="kboard-staff-compliment-status status-<?php echo array_search($content->category2, $status_list)?>"><?php echo $content->category2?></span>
						<?php endif?>
					</td>
					<td class="kboard-list-user"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?></td>
					<td class="kboard-list-date"><?php echo $content->getDate()?></td>
					<td class="kboard-list-vote"><?php echo $content->vote?></td>
					<td class="kboard-list-view"><?php echo $content->view?></td>
				</tr>
				<!-- <?php $boardBuilder->builderReply($content->uid)?> -->
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
		<form id="kboard-search-form-<?php echo $board->id?>" method="get" action="<?php echo $url->toString()?>">
			<?php echo $url->set('pageid', '1')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
			
			<select name="target">
				<option value=""><?php echo __('All', 'kboard')?></option>
				<option value="title"<?php if(kboard_target() == 'title'):?> selected="selected"<?php endif?>><?php echo __('Title', 'kboard')?></option>
				<option value="content"<?php if(kboard_target() == 'content'):?> selected="selected"<?php endif?>><?php echo __('Content', 'kboard')?></option>
				<option value="member_display"<?php if(kboard_target() == 'member_display'):?> selected="selected"<?php endif?>><?php echo __('Author', 'kboard')?></option>
			</select>
			<input type="text" name="keyword" value="<?php echo kboard_keyword()?>">
			<button type="submit" class="kboard-qna-button-search dalia-btn-01" title="<?php echo __('Search', 'kboard')?>">검색</button>
		</form>
	</div>
	<!-- 검색폼 끝 -->
	
	<?php if($board->isWriter()):?>
	<div class="kboard-control flex-end">
		<?php if($board->isWriter()):?>
					<a href="<?php echo $url->getContentEditor()?>" class="kboard-qna-button-small dalia-btn-01"><?php echo __('New', 'kboard')?></a>
				<?php endif?>
		</div>
	<?php endif?>
	
	<?php if($board->contribution()):?>
	<div class="kboard-qna-poweredby">
		<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>"></a>
	</div>
	<?php endif?>
</div>
