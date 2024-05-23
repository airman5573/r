<ul id="kboard-ocean-faq-latest">
	<?php while($content = $list->hasNext()):?>
		<li class="kboard-ocean-faq-latest-item cut_strings">
			<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>">
				<div class="kboard-faq-question" onclick="kboard_faq_view_answer('<?php echo $faq_item_index?>')">
				<!-- 카테고리 불릿 추가 -->
				<?php dalia_print_category1_name($content); ?>
				<!-- 카테고리 불릿 추가 -->
				<?php echo $content->title?><?php if($content->isNew()):?><span class="kboard-hwaikeul-video-slider-new-notify new-mark">N</span><?php endif?></div>
			</a>
		</li>
	<?php endwhile?>
</ul>
