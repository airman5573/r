<?php
if($board->initCategory2()){
	$status_list = $board->category;
}
else{
	$status_list = kboard_ask_status();
}
?>
<div id="kboard-qna-latest">
	<table>
		<thead class="table-pc">
			<tr>
				<th class="kboard-latest-title"><?php echo __('Title', 'kboard')?></th>
				<th class="kboard-latest-status"><?php echo __('Status', 'kboard')?></th>
				<th class="kboard-list-user">작성자</th>
				<th class="kboard-latest-date"><?php echo __('Date', 'kboard')?></th>
			</tr>
		</thead>
		<tbody>
			<?php while($content = $list->hasNext()):?>
			<tr>
				<td class="kboard-latest-title table-pc">
					<a href="<?php echo $url->set('uid', $content->uid)->set('mod', 'document')->toStringWithPath($board_url)?>" class="flex-item">
						<?php dalia_print_branch_term_name($content); ?>
						<div class="kboard-qna-cut-strings">

							<?php if($content->secret):?><i class="xi-lock kboard-icon-lock"></i><?php endif?>
							<?php echo $content->title?>
							<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
							<?php if($content->isNew()):?><span class="kboard-default-new-notify new-mark">N</span><?php endif?>
						</div>
					</a>
				</td>
				<td class="kboard-list-status text-center table-pc">
						<?php
						$answer_status_index = $content->category2 ? array_search($content->category2, $status_list) : '0';
						$answer_status = $status_list[$answer_status_index];
						?>
					<span class="kboard-qna-status status-<?php echo $answer_status_index; ?>"><?php echo $answer_status; ?></span>
				</td>
				<td class="kboard-list-user text-center table-pc"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?></td>
				<td class="kboard-latest-date table-pc"><?php echo $content->getDate()?></td>
				<td class="kboard-latest-title mo">
					<a href="<?php echo $url->set('uid', $content->uid)->set('mod', 'document')->toStringWithPath($board_url)?>" class="flex-item">
						<div class="list-top-status">
							<?php
							$answer_status_index = $content->category2 ? array_search($content->category2, $status_list) : '0';
							$answer_status = $status_list[$answer_status_index];
							?>
							<span class="kboard-qna-status status-<?php echo $answer_status_index; ?>"><?php echo $answer_status; ?></span>
							<?php dalia_print_branch_term_name($content); ?>
						</div>
						<div class="kboard-qna-cut-strings">

							<?php if($content->secret):?><i class="xi-lock kboard-icon-lock"></i><?php endif?>
							<?php echo $content->title?>
							<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
							<?php if($content->isNew()):?><span class="kboard-default-new-notify new-mark">N</span><?php endif?>
						</div>
						<div class="kboard-latest-date"><?php echo $content->getDate()?></div>
					</a>
				</td>
			</tr>
			<?php endwhile?>
		</tbody>
	</table>
</div>