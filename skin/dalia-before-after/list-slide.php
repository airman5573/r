<div class="kboard-list-item<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?> <?php echo esc_html($content->uid)?>">
	<?php if(!is_user_logged_in() && $board->meta->dalia_before_after_filtering != 'off'):?>
		<div class="kboard-list-thumbnail slide before">
			<!-- <div class="kboard-list-thumbnail-blind">
				<div class="kboard-list-login-message">
					<?php if($board->meta->dalia_before_after_login_message):?>
						<?php echo wpautop($board->meta->dalia_before_after_login_message)?>
					<?php else:?>
						<p><?php echo dalia_before_after_default_login_message()?></p>
					<?php endif?>
					<button type="button" class="kboard-list-login-button" onclick="window.location.href='<?php echo wp_login_url($_SERVER['REQUEST_URI'])?>';return false;">로그인</button>
				</div>
			</div> -->
			<span class="kboard-list-thumbnail-sticker">Before</span>
			<?php if($board->meta->dalia_before_after_absoulte_filtering != 'off'):?>
				<?php if(!kboard_dalia_before_after_image_check($content, 'front_before_image') && !kboard_dalia_before_after_image_check($content, 'front_after_image')):?>
				<?php elseif(!kboard_dalia_before_after_image_check($content, 'front_after_image')):?><img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
				<?php else:?><img class="front" src="<?php echo kboard_dalia_before_after_image($content,'front_after_image')?>" alt="">
				<?php endif?>
				<?php if(!kboard_dalia_before_after_image_check($content, 'half_side_before_image') && !kboard_dalia_before_after_image_check($content, 'half_side_after_image')):?>
				<?php elseif(!kboard_dalia_before_after_image_check($content, 'half_side_after_image')):?><img class="half-side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
				<?php else:?><img class="half-side" src="<?php echo kboard_dalia_before_after_image($content,'half_side_after_image')?>" alt="">
				<?php endif?>
				<?php if(!kboard_dalia_before_after_image_check($content, 'side_before_image') && !kboard_dalia_before_after_image_check($content, 'side_after_image')):?>
				<?php elseif(!kboard_dalia_before_after_image_check($content, 'side_after_image')):?><img class="side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
				<?php else:?><img class="side" src="<?php echo kboard_dalia_before_after_image($content,'side_after_image')?>" alt="">
				<?php endif?>
			<?php else:?>
				<?php if(!kboard_dalia_before_after_image_check($content, 'front_before_image') && !kboard_dalia_before_after_image_check($content, 'front_after_image')):?>
				<?php elseif(!kboard_dalia_before_after_image_check($content, 'front_before_image')):?><img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
				<?php else:?><img class="front" src="<?php echo kboard_dalia_before_after_image($content,'front_before_image')?>" alt="">
				<?php endif?>
				<?php if(!kboard_dalia_before_after_image_check($content, 'half_side_before_image') && !kboard_dalia_before_after_image_check($content, 'half_side_after_image')):?>
				<?php elseif(!kboard_dalia_before_after_image_check($content, 'half_side_before_image')):?><img class="half-side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
				<?php else:?><img class="half-side" src="<?php echo kboard_dalia_before_after_image($content,'half_side_before_image')?>" alt="">
				<?php endif?>
				<?php if(!kboard_dalia_before_after_image_check($content, 'side_before_image') && !kboard_dalia_before_after_image_check($content, 'side_after_image')):?>
				<?php elseif(!kboard_dalia_before_after_image_check($content, 'side_before_image')):?><img class="side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
				<?php else:?><img class="side" src="<?php echo kboard_dalia_before_after_image($content,'side_before_image')?>" alt="">
				<?php endif?>
			<?php endif?>
		</div>
	<?php else:?>
		<div class="kboard-list-thumbnail slide before">
			<span class="kboard-list-thumbnail-sticker">Before</span>
			<?php if(!kboard_dalia_before_after_image_check($content, 'front_before_image') && !kboard_dalia_before_after_image_check($content, 'front_after_image')):?>
			<?php elseif(!kboard_dalia_before_after_image_check($content, 'front_before_image')):?><img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
			<?php else:?><img class="front" src="<?php echo kboard_dalia_before_after_image($content,'front_before_image')?>" alt="">
			<?php endif?>
			<?php if(!kboard_dalia_before_after_image_check($content, 'half_side_before_image') && !kboard_dalia_before_after_image_check($content, 'half_side_after_image')):?>
			<?php elseif(!kboard_dalia_before_after_image_check($content, 'half_side_before_image')):?><img class="half-side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
			<?php else:?><img class="half-side" src="<?php echo kboard_dalia_before_after_image($content,'half_side_before_image')?>" alt="">
			<?php endif?>
			<?php if(!kboard_dalia_before_after_image_check($content, 'side_before_image') && !kboard_dalia_before_after_image_check($content, 'side_after_image')):?>
			<?php elseif(!kboard_dalia_before_after_image_check($content, 'side_before_image')):?><img class="side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
			<?php else:?><img class="side" src="<?php echo kboard_dalia_before_after_image($content,'side_before_image')?>" alt="">
			<?php endif?>
		</div>
	<?php endif?>
	<div class="kboard-list-thumbnail slide after">
		<span class="kboard-list-thumbnail-sticker">After</span>
		<?php if(!kboard_dalia_before_after_image_check($content, 'front_before_image') && !kboard_dalia_before_after_image_check($content, 'front_after_image')):?>
		<?php elseif(!kboard_dalia_before_after_image_check($content, 'front_after_image')):?><img class="front empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
		<?php else:?><img class="front" src="<?php echo kboard_dalia_before_after_image($content,'front_after_image')?>" alt="">
		<?php endif?>
		<?php if(!kboard_dalia_before_after_image_check($content, 'half_side_before_image') && !kboard_dalia_before_after_image_check($content, 'half_side_after_image')):?>
		<?php elseif(!kboard_dalia_before_after_image_check($content, 'half_side_after_image')):?><img class="half-side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
		<?php else:?><img class="half-side" src="<?php echo kboard_dalia_before_after_image($content,'half_side_after_image')?>" alt="">
		<?php endif?>
		<?php if(!kboard_dalia_before_after_image_check($content, 'side_before_image') && !kboard_dalia_before_after_image_check($content, 'side_after_image')):?>
		<?php elseif(!kboard_dalia_before_after_image_check($content, 'side_after_image')):?><img class="side empty_img" src="<?php echo $skin_path?>/images/default-img.png" alt="">
		<?php else:?><img class="side" src="<?php echo kboard_dalia_before_after_image($content,'side_after_image')?>" alt="">
		<?php endif?>
	</div>
	<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>#kboard-document">
		<div class="kboard-list-title">
			<div class="kboard-dalia-before-after-cut-strings">
				<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" class="kboard-default-img" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
				<?php if($content->category1):?>
					<div class="detail-attr detail-category1 category-bullet">
						<div class="detail-name"><?php echo $content->category1?></div>
					</div>
				<?php endif?>
				<?php echo $content->title?>
				<?php if($content->isNew()):?><span class="kboard-dalia-before-after-new-notify new-mark">N</span><?php endif?>
			</div>
		</div>
		<!-- <div class="kboard-list-user">
			<?php echo apply_filters('kboard_user_display', $content->member_display, $content->member_uid, $content->member_display, 'kboard', $boardBuilder)?>
		</div> -->
	</a>
	<!-- <?php if($board->getListTotal() > 0):?>
		<div class="kboard-list-slide-toggle <?php if($board->getListTotal() > 1):?>position-up <?php endif?>">
			<?php if(!kboard_dalia_before_after_image_check($content, 'front_before_image') && !kboard_dalia_before_after_image_check($content, 'front_after_image')):?><input type="button" class="front-toggle hide">
			<?php else:?><input type="button" class="front-toggle <?php if(kboard_dalia_before_after_first_image($content) == 'front'):?>selected<?php endif?>" onclick="kboard_dalia_before_after_slide_img_toggle('front', '<?php echo esc_html($content->uid)?>')" value="정면">
			<?php endif?>
			<?php if(!kboard_dalia_before_after_image_check($content, 'half_side_before_image') && !kboard_dalia_before_after_image_check($content, 'half_side_after_image')):?><input type="button" class="half-side-toggl hide">
			<?php else:?><input type="button" class="half-side-toggle <?php if(kboard_dalia_before_after_first_image($content) == 'half-side'):?>selected<?php endif?>" onclick="kboard_dalia_before_after_slide_img_toggle('half_side', '<?php echo esc_html($content->uid)?>')" value="반측면">
			<?php endif?>
			<?php if(!kboard_dalia_before_after_image_check($content, 'side_before_image') && !kboard_dalia_before_after_image_check($content, 'side_after_image')):?><input type="button" class="side-toggl hide">
			<?php else:?><input type="button" class="side-toggle <?php if(kboard_dalia_before_after_first_image($content) == 'side'):?>selected<?php endif?>" onclick="kboard_dalia_before_after_slide_img_toggle('side', '<?php echo esc_html($content->uid)?>')" value="측면">
			<?php endif?>
		</div>
	<?php endif?> -->
</div>