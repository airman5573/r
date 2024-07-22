<div id="video-gallery-editor">
	<form id="video-gallery-form" class="kboard-form" method="post" action="<?php echo esc_url($url->getContentEditorExecute())?>" enctype="multipart/form-data" onsubmit="return kboard_editor_execute(this);">
		<?php $skin->editorHeader($content, $board)?>
		
		<?php foreach($board->fields()->getSkinFields() as $key=>$field):?>
			<?php echo $board->fields()->getTemplate($field, $content, $boardBuilder)?>
		<?php endforeach?>

		<div class="kboard-control">
			<div class="left">
				<?php if($content->uid):?>
				<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>" class="video-gallery-button-small dalia-btn-01"><span class="button-text text-back"><?php echo __('Back', 'kboard')?></span></a>
				<a href="<?php echo esc_url($url->getBoardList())?>" class="video-gallery-button-small dalia-btn-01"><span class="button-text text-list"><?php echo __('List', 'kboard')?></span></a>
				<?php else:?>
				<a href="<?php echo esc_url($url->getBoardList())?>" class="video-gallery-button-small dalia-btn-01"><span class="button-text text-back"><?php echo __('Back', 'kboard')?></span></a>
				<?php endif?>
			</div>
			<div class="right">
				<?php if($board->isWriter()):?>
				<button type="submit" class="video-gallery-button-small dalia-btn-01"><span class="button-text text-save"><?php echo __('Save', 'kboard')?></span></button>
				<?php endif?>
			</div>
		</div>
	</form>
</div>

<?php wp_enqueue_script('video-gallery-editor', "{$skin_path}/editor.js", array(), KBOARD_VERSION, true)?>