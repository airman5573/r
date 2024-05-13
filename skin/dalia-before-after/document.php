<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/124874/twentytwenty.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/124874/jquery.event.move.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/124874/jquery.twentytwenty.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div id="kboard-document">
	<div id="kboard-dalia-before-after-document">
		<div class="kboard-document-wrap" itemscope itemtype="http://schema.org/Article">
			<div class="document-header">
				<div class="document-header-top kboard-detail">
					
					<?php if($content->category1):?>
					<div class="detail-attr detail-category1 category-bullet">
						<div class="detail-name"><?php echo $content->category1?></div>
					</div>
					<?php endif?>
					<?php if($content->category2):?>
					<div class="detail-attr detail-category2">
						<div class="detail-name"><?php echo $content->category2?></div>
					</div>
					<?php endif?>
					<?php if($content->option->tree_category_1):?>
					<?php for($i=1; $i<=$content->getTreeCategoryDepth(); $i++):?>
					<div class="detail-attr detail-tree-category-<?php echo $i?>">
						<div class="detail-name"><?php echo $content->option->{'tree_category_'.$i}?></div>
					</div>
					<?php endfor?>
					<?php endif?>
					<!-- <div class="detail-attr detail-writer">
						<div class="detail-name"><?php echo __('Author', 'kboard')?></div>
						<div class="detail-value"><?php echo apply_filters('kboard_user_display', $content->member_display, $content->member_uid, $content->member_display, 'kboard', $boardBuilder)?></div>
					</div> -->
					<div class="detail-attr detail-date">
						<!-- <div class="detail-name"><?php echo __('Date', 'kboard')?></div> -->
						<div class="detail-value"><?php echo date('Y-m-d H:i', strtotime($content->date))?></div>
					</div>
					<!-- <div class="detail-attr detail-view">
						<div class="detail-name"><?php echo __('Views', 'kboard')?></div>
						<div class="detail-value"><?php echo $content->view?></div>
					</div> -->
					
				</div>
				<div class="document-header-middle">
				<div class="kboard-title" itemprop="name">
					<h1><?php echo $content->title?></h1>
				</div>
			</div>
			</div>
			
			<div class="kboard-thumbnail before-after-photo">
				<img src="/wp-content/uploads/2024/04/test-02.jpg" alt="">
				<img src="/wp-content/uploads/2024/04/test-01.jpg"" alt="">
				<!-- <?php if(!is_user_logged_in() && $board->meta->dalia_before_after_filtering != 'off'):?>
					<div class="kboard-thumbnail-child document before">
						<div class="kboard-thumbnail-blind">
							<div class="kboard-login-message">
								<?php if($board->meta->dalia_before_after_login_message):?>
									<?php echo wpautop($board->meta->dalia_before_after_login_message)?>
								<?php else:?>
									<p><?php echo dalia_before_after_default_login_message()?></p>
								<?php endif?>
								<button type="button" class="kboard-login-button" onclick="window.location.href='<?php echo esc_url(wp_login_url($_SERVER['REQUEST_URI']))?>';return false;">로그인</button>
							</div>
						</div>
						<span class="kboard-thumbnail-sticker">BEFORE</span>
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
					<div class="kboard-thumbnail-child document before">
						<span class="kboard-thumbnail-sticker">BEFORE</span>
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
				<div class="kboard-thumbnail-child document after">
					<span class="kboard-thumbnail-sticker">AFTER</span>
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
				<div class="kboard-thumbnail-toggle">
					<?php if(!kboard_dalia_before_after_image_check($content, 'front_before_image') && !kboard_dalia_before_after_image_check($content, 'front_after_image')):?><input type="button" id="front-toggle" class="hide">
					<?php else:?><input type="button" class="front-toggle <?php if(kboard_dalia_before_after_first_image($content) == 'front'):?>selected<?php endif?>" onclick="kboard_dalia_before_after_document_img_toggle('front')" value="정면">
					<?php endif?>
					<?php if(!kboard_dalia_before_after_image_check($content, 'half_side_before_image') && !kboard_dalia_before_after_image_check($content, 'half_side_after_image')):?><input type="button" id="half-side-toggle" class="hide">
					<?php else:?><input type="button" class="half-side-toggle <?php if(kboard_dalia_before_after_first_image($content) == 'half-side'):?>selected<?php endif?>" onclick="kboard_dalia_before_after_document_img_toggle('half_side')" value="반측면">
					<?php endif?>
					<?php if(!kboard_dalia_before_after_image_check($content, 'side_before_image') && !kboard_dalia_before_after_image_check($content, 'side_after_image')):?><input type="button" id="side-toggle" class="hide">
					<?php else:?><input type="button" class="side-toggle <?php if(kboard_dalia_before_after_first_image($content) == 'side'):?>selected<?php endif?>" onclick="kboard_dalia_before_after_document_img_toggle('side')" value="측면">
					<?php endif?>
				</div> -->
			</div>
			
			<div class="kboard-content" itemprop="description">
				<div class="content-view">
					<?php echo $content->getDocumentOptionsHTML()?>
					<?php echo $content->content?>
				</div>
			</div>
			
			<div class="kboard-document-action">
				<div class="left">
					<button type="button" class="kboard-button-action kboard-button-like" onclick="kboard_document_like(this)" data-uid="<?php echo $content->uid?>" title="<?php echo __('Like', 'kboard')?>"><?php echo __('Like', 'kboard')?> <span class="kboard-document-like-count"><?php echo intval($content->like)?></span></button>
					<button type="button" class="kboard-button-action kboard-button-unlike" onclick="kboard_document_unlike(this)" data-uid="<?php echo $content->uid?>" title="<?php echo __('Unlike', 'kboard')?>"><?php echo __('Unlike', 'kboard')?> <span class="kboard-document-unlike-count"><?php echo intval($content->unlike)?></span></button>
				</div>
				<div class="right">
					<button type="button" class="kboard-button-action kboard-button-print" onclick="kboard_document_print('<?php echo esc_url($url->getDocumentPrint($content->uid))?>')" title="<?php echo __('Print', 'kboard')?>"><?php echo __('Print', 'kboard')?></button>
				</div>
			</div>
			
			<?php if($content->isAttached()):?>
			<div class="kboard-attach">
				<?php foreach($content->getAttachmentList() as $key=>$attach):?>
					<?php if($key=='front_before_image' || $key=='front_after_image' || $key=='half_side_before_image' || $key=='half_side_after_image' || $key=='side_before_image' || $key =='side_after_image'):?>
					<?php else:?>
					<button type="button" class="kboard-button-action kboard-button-download" onclick="window.location.href='<?php echo esc_url($url->getDownloadURLWithAttach($content->uid, $key))?>'" title="<?php echo sprintf(__('Download %s', 'kboard'), $attach[1])?>"><?php echo $attach[1]?></button>
					<?php endif?>
				<?php endforeach?>
			</div>
			<?php endif?>
		</div>
		
		<?php if($content->visibleComments()):?>
		<div class="kboard-comments-area"><?php echo $board->buildComment($content->uid)?></div>
		<?php endif?>
		
		<div class="kboard-document-navi">
			<div class="kboard-prev-document">
				<?php
				$bottom_content_uid = $content->getPrevUID();
				if($bottom_content_uid):
				$bottom_content = new KBContent();
				$bottom_content->initWithUID($bottom_content_uid);
				?>
				<a href="<?php echo esc_url($url->getDocumentURLWithUID($bottom_content_uid))?>" title="<?php echo esc_attr(wp_strip_all_tags($bottom_content->title))?>">
					<span class="navi-arrow"><i class="fa fa-angle-left"></i></span>
					<span class="navi-document-title kboard-default-cut-strings"><?php echo wp_strip_all_tags($bottom_content->title)?></span>
				</a>
				<?php endif?>
			</div>
			
			<div class="kboard-next-document">
				<?php
				$top_content_uid = $content->getNextUID();
				if($top_content_uid):
				$top_content = new KBContent();
				$top_content->initWithUID($top_content_uid);
				?>
				<a href="<?php echo esc_url($url->getDocumentURLWithUID($top_content_uid))?>" title="<?php echo esc_attr(wp_strip_all_tags($top_content->title))?>">
					<span class="navi-document-title kboard-default-cut-strings"><?php echo wp_strip_all_tags($top_content->title)?></span>
					<span class="navi-arrow"><i class="fa fa-angle-right"></i></span>
				</a>
				<?php endif?>
			</div>
		</div>
		
		<div class="kboard-control">
			<div class="left">
				<a href="<?php echo $url->set('mod', 'list')->toString()?>" class="kboard-dalia-before-after-button-small dalia-btn-01"><?php echo __('List', 'kboard')?></a>
			</div>
			<?php if($board->isEditor($content->member_uid) || $board->permission_write=='all'):?>
			<div class="right">
				<a href="<?php echo esc_url($url->getContentEditor($content->uid))?>" class="kboard-dalia-before-after-button-small dalia-btn-01"><?php echo __('Edit', 'kboard')?></a>
				<a href="<?php echo esc_url($url->getContentRemove($content->uid))?>" class="kboard-dalia-before-after-button-small dalia-btn-01" onclick="return confirm('<?php echo __('Are you sure you want to delete?', 'kboard')?>');"><?php echo __('Delete', 'kboard')?></a>
			</div>
			<?php endif?>
		</div>
		
		<?php if($board->contribution() && !$board->meta->always_view_list):?>
		<div class="kboard-dalia-before-after-poweredby">
			<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>"></a>
		</div>
		<?php endif?>
	</div>
</div>

    <script>
        jQuery(window).on('load', function() {
            // jQuery(".before-after-photo").twentytwenty();
        });
    </script>
<?php

wp_enqueue_script('kboard-dalia-before-after-document', "{$skin_path}/document.js", array(), KBOARD_VERSION, true);

?>

