<div id="kboard-qna-list">
	<!-- 게시판 정보 시작 -->
	<div class="kboard-list-header flex-item space-between">
		<?php dalia_print_kboard_count_of_all_article($board); ?>
		
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
	<!-- <div class="kboard-list-top flex-item space-between">
		<div class="kboard-total-count">
			<?php echo __('전체', 'kboard')?> <span class="text-mint"><?php echo number_format($board->getListTotal())?></span>
		</div>
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
	</div> -->
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
					<td class="kboard-list-status table-pc"><?php echo __('Status', 'kboard')?></td>
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
						<div class="mo"><span class="notice-tag">공지</span></div>
						
							<!-- <?php if($content->category2):?>
								<div class="kboard-mobile-status">
									<span class="kboard-qna-status status-<?php echo array_search($content->category2, $status_list)?>"><?php echo $content->category2?></span>
								</div>
							<?php endif?> -->
							<div class="kboard-qna-cut-strings">
								<?php if($content->secret):?><i class="xi-lock kboard-icon-lock"></i><?php endif?>
								<?php if($board->use_category == 'yes' && $board->initCategory1()):?>
									<span class="kboard-mobile-category"><?php if($content->category1):?>[<?php echo $content->category1?>]<?php endif?></span>
								<?php endif?>
								
								<?php echo $content->title?>
								<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
								<?php if($content->isNew()):?><span class="new-mark">N</span><?php endif?></div>
							</div>
							<div class="kboard-mobile-contents">
								<span class="contents-item kboard-user"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?></span>
								<span class="contents-separator kboard-date">|</span>
								<span class="contents-item kboard-date"><?php echo $content->getDate()?></span>
							</div>
				
					</td>
					<td class="kboard-list-status table-pc">
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
							<span class="notice-tag">공지</span>
							<!-- <?php if($content->category2):?>
								<div class="kboard-mobile-status">
									<span class="kboard-qna-status status-<?php echo array_search($content->category2, $status_list)?>"><?php echo $content->category2?></span>
								</div>
							<?php endif?> -->
							<div class="kboard-qna-cut-strings">
								<?php if($content->secret):?><i class="xi-lock kboard-icon-lock"></i><?php endif?>
								
								<?php if($board->use_category == 'yes' && $board->initCategory1()):?>
									<span class="kboard-mobile-category"><?php if($content->category1):?>[<?php echo $content->category1?>]<?php endif?></span>
								<?php endif?>
								
								<?php echo $content->title?>
								<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
								<?php if($content->isNew()):?><span class="new-mark">N</span><?php endif?></div>
							</div>
							<div class="kboard-mobile-contents">
								<span class="contents-item kboard-user"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?></span>
								<span class="contents-separator kboard-date">•</span>
								<span class="contents-item kboard-date"><?php echo $content->getDate()?></span>
							</div>
					</td>
					<td class="kboard-list-status table-pc">
						<?php if($content->category2):?>
							<span class="kboard-qna-status status-<?php echo array_search($content->category2, $status_list)?>"><?php echo $content->category2?></span>
						<?php endif?>
					</td>
					<td class="kboard-list-user"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?></td>
					<td class="kboard-list-date"><?php echo $content->getDate()?></td>
					<td class="kboard-list-vote"><?php echo $content->vote?></td>
					<td class="kboard-list-view"><?php echo $content->view?></td>
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
		<form id="kboard-search-form-<?php echo $board->id?>" method="get" action="<?php echo $url->toString()?>">

			<!-- Preset search parameters to initial values -->
			<?php echo $url->set('pageid', '1')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>

			<!-- Search target dropdown -->
			<select name="target">
				<option value="">
					<?php echo __('All', 'kboard')?>
				</option>
				
				<option value="title"<?php if (kboard_target() == 'title'): ?> selected="selected"<?php endif; ?>>
					<?php echo __('Title', 'kboard')?>
				</option>
				
				<option value="content"<?php if (kboard_target() == 'content'): ?> selected="selected"<?php endif; ?>>
					<?php echo __('Content', 'kboard')?>
				</option>

				<option value="member_display"<?php if (kboard_target() == 'member_display'): ?> selected="selected"<?php endif; ?>>
					<?php echo __('Author', 'kboard')?>
				</option>

				<option value="kboard_option_tel_last_four"<?php if (kboard_target() == 'kboard_option_tel_last_four'): ?> selected="selected"<?php endif; ?>>
					<?php echo '전화번호'; ?>
				</option>
			</select>


			<!-- Keyword input field -->
			<input type="text" name="keyword" value="<?php echo kboard_keyword()?>">

			<!-- Search button -->
			<button type="submit" class="kboard-qna-button-search dalia-btn-01" title="<?php echo __('Search', 'kboard')?>">
				<?php echo __('Search', 'kboard')?>
			</button>

			<!-- Reset form button -->
			<a  class="reset-form-btn-container" href="<?php echo home_url('/franchise/franchise-qna/?mod=list&pageid=1'); ?>">
				<i class="xi-renew"></i>
			</a>
		
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
	<!-- <div class="kboard-qna-poweredby">
		<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>"></a>
	</div> -->
	<?php endif?>
</div>

<script>
jQuery(($) => {
	$('select[name="target"]').on('select2:select', function (e) {
		console.log('select2:select', e);
		const data = e.params.data;
		const { id } = data;

		const compareInputs = document.querySelectorAll('input[name="compare"]');
		const compareInput = compareInputs[1];
		compareInput.value = id === 'kboard_option_tel_last_four' ? '=' : 'LIKE';
	});
});
</script>
