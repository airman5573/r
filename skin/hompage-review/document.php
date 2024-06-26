<?php
$isNoticeDocument = $content->notice;
$additional_class = $isNoticeDocument ? 'kboard-notice-document' : '';
?>

<div id="kboard-document" class="<?php echo $additional_class; ?>">
    <div id="kboard-hompage-review-document">
    	<div class="kboard-document-wrap" itemscope itemtype="http://schema.org/Article">
			<div class="document-header">
				<div class="document-header-top flex-item">
				<?php
					$info_value = array();
					if (wp_validate_boolean( $content->notice )) {
						$info_value[] = dalia_get_notice_tag();
					}
					if($content->category1){
						$info_value[] = sprintf('<span class="kboard-info-value category-bullet kboard-category1">%s</span>', $content->category1);
					}
					
					if($content->category2){
						$info_value[] = sprintf('<span class="kboard-info-value kboard-category2">%s</span>', $content->category2);
					}
					if($content->option->tree_category_1){
						for($i=1; $i<=$content->getTreeCategoryDepth(); $i++){
							$info_value[] = sprintf('<span class="kboard-info-value kboard-tree-category-'.$i.'">%s</span>', $content->option->{'tree_category_'.$i});
						}
					}
					$info_value[] = sprintf('<span class="kboard-info-value kboard-date">%s</span>', $content->getDate());
					?>
					<?php if($info_value):?>
					<div class="kboard-image-gallery-info kboard-image-gallery-cut-strings">
						<?php echo implode($info_value);?>
						<?php if($content->isNew()):?><span class="kboard-image-gallery-new-notify new-mark">N</span><?php endif?>
					</div>
					<?php endif?>
				</div>
				<div class="detail-attr detail-title document-header-middle">
					<div class="kboard-title">
						<h1><?php echo $content->title?></h1>
					</div>
				</div>
				<div class="kboard-detail document-header-bottom">
					<div class="detail-attr">
						<div class="detail-name">작성자 : </div>
						<div class="detail-value"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?></div>
					</div>
					
					<div class="detail-attr">
						<div class="detail-name">이메일 : </div>
						<div class="detail-value">
							<?php echo $content->option->{'66151ed5bb66f'}?>

						</div>
					</div>
					
					<div class="detail-attr detail-view">
						<div class="detail-name"><?php echo __('Views', 'kboard')?></div>
						<div class="detail-value"><?php echo $content->view?></div>
					</div>
				</div>			
			</div>
    		
    		<div class="kboard-document-thumbnail">
				<?php if($content->option->youtube_id):?>
					<div class="kboard-hompage-review-container" style="<?php if($content->option->video_view):?>padding-bottom: 75%;<?php else:?>padding-bottom: 56.25%;<?php endif?>">
						<iframe width="560" height="315" src="<?php echo esc_url("https://www.youtube.com/embed/{$content->option->youtube_id}?autoplay={$content->option->autoplay}")?>" frameborder="0" allow="autoplay;" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					</div>
				
				<?php elseif($content->option->vimeo_id):?>
					<div class="kboard-hompage-review-container" style="<?php if($content->option->video_view):?>padding-bottom: 75%;<?php else:?>padding-bottom: 56.25%;<?php endif?>">
						<iframe src="<?php echo esc_url("https://player.vimeo.com/video/{$content->option->vimeo_id}?color=ffffff&title=0&byline=0&portrait=0&autoplay={$content->option->autoplay}")?>" frameborder="0" allow="autoplay;" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					</div>
				
				<?php elseif(count((array)$content->attach) > 0): $count = 0?>
					<?php foreach($content->attach as $key=>$attach): $extension = strtolower(pathinfo($attach[0], PATHINFO_EXTENSION));?>
						<?php if(in_array($extension, array('mp4')) && $count == 0): $count++?>
						<div class="kboard-hompage-review-container" style="<?php if($content->option->video_view):?>padding-bottom: 75%;<?php else:?>padding-bottom: 56.25%;<?php endif?>">
							<?php
							$attr = array(
								'src'        => site_url($attach[0]),
								'autoplay'   => $content->option->autoplay ? true : false,
							);
							echo wp_video_shortcode($attr);
							?>
						</div>
						<?php else: $download[$key] = $attach; endif?>
					<?php endforeach?>
				
				<?php elseif($content->option->video_url):?>
					<div class="kboard-hompage-review-container" style="<?php if($content->option->video_view):?>padding-bottom: 75%;<?php else:?>padding-bottom: 56.25%;<?php endif?>">
						<?php
						$attr = array(
							'src'        => $content->option->video_url,
							'autoplay'   => $content->option->autoplay ? true : false,
						);
						echo wp_video_shortcode($attr);
						?>
					</div>
				<?php endif?>
			</div>
			
			<?php if($content->isAttached()):?>
			<div class="kboard-attach-group">
				<div class="kboard-attach-group-download"><?php echo __('Download', 'kboard')?> <span class="files-count">(<?php echo count((array)$content->getAttachmentList())?>)</span></div>
				<?php foreach($content->getAttachmentList() as $key=>$file):?>
				<div class="kboard-attach">
					<button type="button" onclick="window.location.href='<?php echo esc_url($url->getDownloadURLWithAttach($content->uid, $key))?>'" title="<?php echo esc_attr(sprintf(__('Download %s', 'kboard'), $file[1]))?>">
						<div class="download-icon">
							<img src="<?php echo $skin_path?>/images/download-14.png" srcset="<?php echo $skin_path?>/images/download-28.png 2x, <?php echo $skin_path?>/images/download-42.png 3x" alt="download">
						</div>
						<div class="file-name kboard-hompage-review-cut-strings"><?php echo $file[1]?></div>
					</button>
				</div>
				<?php endforeach?>
			</div>
			<?php endif?>
			
			<?php if($content->category1 || $content->category2):?>
			<div class="kboard-category">
				<?php if($content->category1):?>
				<span class="category-name category1">#<?php echo $content->category1?></span>
				<?php endif?>
				<?php if($content->category2):?>
				<span class="category-name category2">#<?php echo $content->category2?></span>
				<?php endif?>
			</div>
			<?php endif?>
			<?php if($content->option->tree_category_1):?>
			<div class="kboard-category">
				<?php for($i=1; $i<=$content->getTreeCategoryDepth(); $i++):?>
				<span class="category-name category<?php echo $i?>">#<?php echo $content->option->{'tree_category_'.$i}?></span>
				<?php endfor?>
			</div>
			<?php endif?>
			
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
				<a href="<?php echo esc_url($url->getDocumentURLWithUID($bottom_content_uid))?>"title="<?php echo esc_attr($bottom_content->title)?>">
					<span class="navi-arrow"><i class="fa fa-angle-left"></i></span>
					<span class="navi-document-title kboard-hompage-review-cut-strings"><?php echo $bottom_content->title?></span>
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
				<a href="<?php echo esc_url($url->getDocumentURLWithUID($top_content_uid))?>" title="<?php echo esc_attr($top_content->title)?>">
					<span class="navi-document-title kboard-hompage-review-cut-strings"><?php echo $top_content->title?></span>
					<span class="navi-arrow"><i class="fa fa-angle-right"></i></span>
				</a>
				<?php endif?>
			</div>
		</div>
		
		<div class="kboard-control">
			<div class="left">
				<a href="<?php echo $url->getBoardList()?>" class="kboard-hompage-review-button-small dalia-btn-01"><span class="button-text text-list"><?php echo __('List', 'kboard')?></span></a>
			</div>
			<?php if($content->isEditor() || $board->permission_write=='all'):?>
			<div class="right">
				<a href="<?php echo esc_url($url->getContentEditor($content->uid))?>" class="kboard-hompage-review-button-small dalia-btn-01"><span class="button-text text-edit"><?php echo __('Edit', 'kboard')?></span></a>
				<a href="<?php echo esc_url($url->getContentRemove($content->uid))?>" class="kboard-hompage-review-button-small dalia-btn-01" onclick="return confirm('<?php echo __('Are you sure you want to delete?', 'kboard')?>');"><span class="button-text text-delete"><?php echo __('Delete', 'kboard')?></span></a>
			</div>
			<?php endif?>
		</div>
	</div>
</div>
