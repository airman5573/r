<?php
$has_before_img = kboard_dalia_before_after_image_check($content, 'front_before_image');
$has_after_img = kboard_dalia_before_after_image_check($content, 'front_after_image');
?>

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
			
			<?php if ($has_before_img && $has_after_img): ?>
			<div id="dalia-kboard-before-after-photo-in-document">
				<div class="before-after-photo">
					<div class="wrapper">
						<div class="before-img-container">
							<?php kboard_dalia_display_image_list($content, 'before'); ?>
						</div>
						<div class="after-img-container">
							<?php kboard_dalia_display_image_list($content, 'after'); ?>
						</div>
						<div class="scroller">
							<i class="xi-caret-up"></i>
							<i class="xi-caret-up"></i>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
			
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
					<span class="navi-arrow"><i class="xi-angle-left-thin"></i></span>
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
					<span class="navi-arrow"><i class="xi-angle-right-thin"></i></span>
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

