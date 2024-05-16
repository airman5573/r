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
		<thead>
			<tr>
				<th class="kboard-latest-status"><?php echo __('Status', 'kboard')?></th>
				<th class="kboard-latest-title"><?php echo __('Title', 'kboard')?></th>
				<th class="kboard-latest-date"><?php echo __('Date', 'kboard')?></th>
			</tr>
		</thead>
		<tbody>
			<?php while($content = $list->hasNext()):?>
			<tr>
				<td class="kboard-list-status">
						<?php
						$answer_status_index = $content->category2 ? array_search($content->category2, $status_list) : '0';
						$answer_status = $status_list[$answer_status_index];
						?>
					<span class="kboard-qna-status status-<?php echo $answer_status_index; ?>"><?php echo $answer_status; ?></span>
				</td>
				<td class="kboard-latest-title">
					<a href="<?php echo $url->set('uid', $content->uid)->set('mod', 'document')->toStringWithPath($board_url)?>">
						<div class="kboard-qna-cut-strings">
							<?php if($content->isNew()):?><span class="kboard-qna-new-notify">N</span><?php endif?>
							<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" class="kboard-icon-lock" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
							<?php echo $content->title?>
							<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
						</div>
					</a>
				</td>
				<td class="kboard-latest-date"><?php echo $content->getDate()?></td>
			</tr>
			<?php endwhile?>
		</tbody>
	</table>
</div>