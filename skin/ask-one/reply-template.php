<?php while($content = $list->hasNextReply()):?>
<tr class="<?php if($content->uid == kboard_uid()):?>kboard-list-selected<?php endif?>">
	<td class="kboard-list-uid"></td>
	
	<?php if($board->use_category == 'yes' && $board->initCategory1()):?>
		<td class="kboard-list-category"><?php echo $content->category1?></td>
	<?php endif?>
	
	<td class="kboard-list-title" style="padding-left:<?php echo ($depth+1)*5?>px">
		<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>">
			<div class="kboard-ask-one-cut-strings">
				<img src="<?php echo $skin_path?>/images/icon-reply.png" class="kboard-icon-reply" alt="">
				<?php if($content->isNew()):?><span class="kboard-ask-one-new-notify">New</span><?php endif?>
				<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" class="kboard-icon-lock" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
				
				<?php if($board->use_category == 'yes' && $board->initCategory1()):?>
					<span class="kboard-mobile-category"><?php if($content->category1):?>[<?php echo $content->category1?>]<?php endif?></span>
				<?php endif?>
				
				<?php echo $content->title?>
				<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
			</div>
			<div class="kboard-mobile-status">
				<span class="kboard-ask-one-status status-answer"><?php echo __('Answer', 'kboard')?></span>
			</div>
			<div class="kboard-mobile-contents">
				<span class="contents-item kboard-user"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?></span>
				<span class="contents-separator kboard-date">|</span>
				<span class="contents-item kboard-date"><?php echo $content->getDate()?></span>
			</div>
		</a>
	</td>
	<td class="kboard-list-status">
		<span class="kboard-ask-one-status status-answer"><?php echo __('Answer', 'kboard')?></span>
	</td>
	<td class="kboard-list-user"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?></td>
	<td class="kboard-list-date"><?php echo $content->getDate()?></td>
	<td class="kboard-list-vote"><?php echo $content->vote?></td>
	<td class="kboard-list-view"><?php echo $content->view?></td>
</tr>
<?php $boardBuilder->builderReply($content->uid, $depth+1)?>
<?php endwhile?>