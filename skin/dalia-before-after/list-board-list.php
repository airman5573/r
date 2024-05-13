<li class="kboard-list-item<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
	<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>#kboard-document">
		<div class="kboard-list-thumbnail">
			<!-- 글 등록시 썸네일로 선택한 이미지로 노출 -->
			<img src="/wp-content/uploads/2024/04/b-a-thumb-1.jpg" alt="">
			<!-- 글 등록시 썸네일로 선택한 이미지로 노출 -->


			<!-- <?php if(!is_user_logged_in() && $board->meta->dalia_before_after_filtering != 'off'):?>
				<div class="kboard-list-thumbnail list before">
					<div class="kboard-list-thumbnail-blind"><span>BEFORE</span></div>
					<?php if($board->meta->dalia_before_after_absoulte_filtering != 'off'):?>
						<?php if(kboard_dalia_before_after_first_image($content) == 'front'):?>
              				<?php if(!kboard_dalia_before_after_image_check($content, 'front_after_image')):?>
              				<img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
							<?php else:?>
							<img class="front" src="<?php echo kboard_dalia_before_after_image($content, 'front_after_image')?>" alt="">
							<?php endif?>
						<?php elseif(kboard_dalia_before_after_first_image($content) == 'half-side'):?>
							<?php if(!kboard_dalia_before_after_image_check($content, 'half_side_after_image')):?>
							<img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
							<?php else:?>
							<img class="front" src="<?php echo kboard_dalia_before_after_image($content, 'half_side_after_image')?>" alt="">
							<?php endif?>
						<?php else:?>
							<?php if(!kboard_dalia_before_after_image_check($content, 'side_after_image')):?>
							<img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
							<?php else:?>
							<img class="front" src="<?php echo kboard_dalia_before_after_image($content, 'side_after_image')?>" alt="">
							<?php endif?>
						<?php endif?>
					<?php else:?>
						<?php if(kboard_dalia_before_after_first_image($content) == 'front'):?>
							<?php if(!kboard_dalia_before_after_image_check($content, 'front_before_image')):?>
							<img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
							<?php else:?>
							<img class="front" src="<?php echo kboard_dalia_before_after_image($content, 'front_before_image')?>" alt="">
							<?php endif?>
						<?php elseif(kboard_dalia_before_after_first_image($content) == 'half-side'):?>
							<?php if(!kboard_dalia_before_after_image_check($content, 'half_side_before_image')):?>
							<img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
							<?php else:?>
							<img class="front" src="<?php echo kboard_dalia_before_after_image($content, 'half_side_before_image')?>" alt="">
							<?php endif?>
						<?php else:?>
							<?php if(!kboard_dalia_before_after_image_check($content, 'side_before_image')):?>
							<img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
							<?php else:?>
							<img class="front" src="<?php echo kboard_dalia_before_after_image($content, 'side_before_image')?>" alt="">
							<?php endif?>
						<?php endif?>
					<?php endif?>
				</div>
			<?php else:?>
				<div class="kboard-list-thumbnail list before">
					<?php if(kboard_dalia_before_after_first_image($content) == 'front'):?>
						<?php if(!kboard_dalia_before_after_image_check($content, 'front_before_image')):?>
						<img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
						<?php else:?>
						<img class="front" src="<?php echo kboard_dalia_before_after_image($content, 'front_before_image')?>" alt="">
						<?php endif?>
					<?php elseif(kboard_dalia_before_after_first_image($content) == 'half-side'):?>
						<?php if(!kboard_dalia_before_after_image_check($content, 'half_side_before_image')):?>
						<img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
						<?php else:?>
						<img class="front" src="<?php echo kboard_dalia_before_after_image($content, 'half_side_before_image')?>" alt="">
						<?php endif?>
					<?php else:?>
						<?php if(!kboard_dalia_before_after_image_check($content, 'side_before_image')):?>
						<img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
						<?php else:?>
						<img class="front" src="<?php echo kboard_dalia_before_after_image($content, 'side_before_image')?>" alt="">
						<?php endif?>
					<?php endif?>
				</div>
			<?php endif?>
			
			<div class="kboard-list-thumbnail list after">
				<?php if(kboard_dalia_before_after_first_image($content) == 'front'):?>
					<?php if(!kboard_dalia_before_after_image_check($content, 'front_after_image')):?>
					<img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
					<?php else:?>
					<img class="front" src="<?php echo kboard_dalia_before_after_image($content, 'front_after_image')?>" alt="">
					<?php endif?>
				<?php elseif(kboard_dalia_before_after_first_image($content) == 'half-side'):?>
					<?php if(!kboard_dalia_before_after_image_check($content, 'half_side_after_image')):?>
					<img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
					<?php else:?>
					<img class="front" src="<?php echo kboard_dalia_before_after_image($content, 'half_side_after_image')?>" alt="">
					<?php endif?>
				<?php else:?>
					<?php if(!kboard_dalia_before_after_image_check($content, 'side_after_image')):?>
					<img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
					<?php else:?>
					<img class="front" src="<?php echo kboard_dalia_before_after_image($content, 'side_after_image')?>" alt="">
					<?php endif?>
				<?php endif?>
			</div> -->
		</div>
		<div class="program-title">
		<?php if($content->category1):?>
			<div class="detail-attr detail-category1 category-bullet">
				<div class="detail-name"><?php echo $content->category1?></div>
			</div>
		<?php endif?>
		</div>
		
		<div class="kboard-list-title">
			<div class="kboard-dalia-before-after-cut-strings">
				<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" class="kboard-icon-lock" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
				<?php echo $content->title?><?php if($content->isNew()):?><span class="kboard-dalia-before-after-new-notify new-mark">N</span><?php endif?>
	    	</div>
    	</div>
    	<!-- <div class="kboard-list-user"><?php echo apply_filters('kboard_user_display', $content->member_display, $content->member_uid, $content->member_display, 'kboard', $boardBuilder)?></div> -->
    </a>
</li>