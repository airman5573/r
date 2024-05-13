<div class="before-after-photo kboard-list-item<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?> <?php echo esc_html($content->uid)?>">
	<?php if(!is_user_logged_in() && $board->meta->before_after_plus_filtering != 'off'):?>
		<div class="kboard-list-thumbnail slide before">
			
			<?php if($board->meta->before_after_plus_absoulte_filtering != 'off'):?>
				<?php if(!kboard_before_after_plus_image_check($content, 'front_before_image') && !kboard_before_after_plus_image_check($content, 'front_after_image')):?>
				<?php elseif(!kboard_before_after_plus_image_check($content, 'front_after_image')):?><img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
				<?php else:?><img class="front" src="<?php echo kboard_before_after_plus_image($content,'front_after_image')?>" alt="">
				<?php endif?>
				<?php if(!kboard_before_after_plus_image_check($content, 'half_side_before_image') && !kboard_before_after_plus_image_check($content, 'half_side_after_image')):?>
				<?php elseif(!kboard_before_after_plus_image_check($content, 'half_side_after_image')):?><img class="half-side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
				<?php else:?><img class="half-side" src="<?php echo kboard_before_after_plus_image($content,'half_side_after_image')?>" alt="">
				<?php endif?>
				<?php if(!kboard_before_after_plus_image_check($content, 'side_before_image') && !kboard_before_after_plus_image_check($content, 'side_after_image')):?>
				<?php elseif(!kboard_before_after_plus_image_check($content, 'side_after_image')):?><img class="side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
				<?php else:?><img class="side" src="<?php echo kboard_before_after_plus_image($content,'side_after_image')?>" alt="">
				<?php endif?>
			<?php else:?>
				<?php if(!kboard_before_after_plus_image_check($content, 'front_before_image') && !kboard_before_after_plus_image_check($content, 'front_after_image')):?>
				<?php elseif(!kboard_before_after_plus_image_check($content, 'front_before_image')):?><img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
				<?php else:?><img class="front" src="<?php echo kboard_before_after_plus_image($content,'front_before_image')?>" alt="">
				<?php endif?>
				<?php if(!kboard_before_after_plus_image_check($content, 'half_side_before_image') && !kboard_before_after_plus_image_check($content, 'half_side_after_image')):?>
				<?php elseif(!kboard_before_after_plus_image_check($content, 'half_side_before_image')):?><img class="half-side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
				<?php else:?><img class="half-side" src="<?php echo kboard_before_after_plus_image($content,'half_side_before_image')?>" alt="">
				<?php endif?>
				<?php if(!kboard_before_after_plus_image_check($content, 'side_before_image') && !kboard_before_after_plus_image_check($content, 'side_after_image')):?>
				<?php elseif(!kboard_before_after_plus_image_check($content, 'side_before_image')):?><img class="side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
				<?php else:?><img class="side" src="<?php echo kboard_before_after_plus_image($content,'side_before_image')?>" alt="">
				<?php endif?>
			<?php endif?>
		</div>
	<?php else:?>
		<div class="kboard-list-thumbnail slide before">
			<?php if(!kboard_before_after_plus_image_check($content, 'front_before_image') && !kboard_before_after_plus_image_check($content, 'front_after_image')):?>
			<?php elseif(!kboard_before_after_plus_image_check($content, 'front_before_image')):?><img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
			<?php else:?><img class="front" src="<?php echo kboard_before_after_plus_image($content,'front_before_image')?>" alt="">
			<?php endif?>
			<?php if(!kboard_before_after_plus_image_check($content, 'half_side_before_image') && !kboard_before_after_plus_image_check($content, 'half_side_after_image')):?>
			<?php elseif(!kboard_before_after_plus_image_check($content, 'half_side_before_image')):?><img class="half-side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
			<?php else:?><img class="half-side" src="<?php echo kboard_before_after_plus_image($content,'half_side_before_image')?>" alt="">
			<?php endif?>
			<?php if(!kboard_before_after_plus_image_check($content, 'side_before_image') && !kboard_before_after_plus_image_check($content, 'side_after_image')):?>
			<?php elseif(!kboard_before_after_plus_image_check($content, 'side_before_image')):?><img class="side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
			<?php else:?><img class="side" src="<?php echo kboard_before_after_plus_image($content,'side_before_image')?>" alt="">
			<?php endif?>
		</div>
	<?php endif?>
	<div class="kboard-list-thumbnail slide after">
		<?php if(!kboard_before_after_plus_image_check($content, 'front_before_image') && !kboard_before_after_plus_image_check($content, 'front_after_image')):?>
		<?php elseif(!kboard_before_after_plus_image_check($content, 'front_after_image')):?><img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
		<?php else:?><img class="front" src="<?php echo kboard_before_after_plus_image($content,'front_after_image')?>" alt="">
		<?php endif?>
		<?php if(!kboard_before_after_plus_image_check($content, 'half_side_before_image') && !kboard_before_after_plus_image_check($content, 'half_side_after_image')):?>
		<?php elseif(!kboard_before_after_plus_image_check($content, 'half_side_after_image')):?><img class="half-side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
		<?php else:?><img class="half-side" src="<?php echo kboard_before_after_plus_image($content,'half_side_after_image')?>" alt="">
		<?php endif?>
		<?php if(!kboard_before_after_plus_image_check($content, 'side_before_image') && !kboard_before_after_plus_image_check($content, 'side_after_image')):?>
		<?php elseif(!kboard_before_after_plus_image_check($content, 'side_after_image')):?><img class="side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
		<?php else:?><img class="side" src="<?php echo kboard_before_after_plus_image($content,'side_after_image')?>" alt="">
		<?php endif?>
	</div>
	<!-- <a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>#kboard-document">
		<div class="kboard-list-new"><?php if($content->isNew()):?><span class="kboard-before-after-plus-new-notify">New</span><?php endif?></div>
		<div class="kboard-list-title">
			<div class="kboard-before-after-plus-cut-strings">
				<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" class="kboard-default-img" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
				<?php echo $content->title?>
			</div>
		</div>
		<div class="kboard-list-user">
			<?php echo apply_filters('kboard_user_display', $content->member_display, $content->member_uid, $content->member_display, 'kboard', $boardBuilder)?>
		</div>
	</a>
	<?php if($board->getListTotal() > 0):?>
		<div class="kboard-list-slide-toggle <?php if($board->getListTotal() > 1):?>position-up <?php endif?>">
			<?php if(!kboard_before_after_plus_image_check($content, 'front_before_image') && !kboard_before_after_plus_image_check($content, 'front_after_image')):?><input type="button" class="front-toggle hide">
			<?php else:?><input type="button" class="front-toggle <?php if(kboard_before_after_plus_first_image($content) == 'front'):?>selected<?php endif?>" onclick="kboard_before_after_plus_slide_img_toggle('front', '<?php echo esc_html($content->uid)?>')" value="정면">
			<?php endif?>
			<?php if(!kboard_before_after_plus_image_check($content, 'half_side_before_image') && !kboard_before_after_plus_image_check($content, 'half_side_after_image')):?><input type="button" class="half-side-toggl hide">
			<?php else:?><input type="button" class="half-side-toggle <?php if(kboard_before_after_plus_first_image($content) == 'half-side'):?>selected<?php endif?>" onclick="kboard_before_after_plus_slide_img_toggle('half_side', '<?php echo esc_html($content->uid)?>')" value="반측면">
			<?php endif?>
			<?php if(!kboard_before_after_plus_image_check($content, 'side_before_image') && !kboard_before_after_plus_image_check($content, 'side_after_image')):?><input type="button" class="side-toggl hide">
			<?php else:?><input type="button" class="side-toggle <?php if(kboard_before_after_plus_first_image($content) == 'side'):?>selected<?php endif?>" onclick="kboard_before_after_plus_slide_img_toggle('side', '<?php echo esc_html($content->uid)?>')" value="측면">
			<?php endif?>
		</div>
	<?php endif?> -->
</div>