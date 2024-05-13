<div id="kboard-hompage-review-editor">
	<form id="kboard-hompage-review-form" class="kboard-form" method="post" action="<?php echo esc_url($url->getContentEditorExecute())?>" enctype="multipart/form-data" onsubmit="return kboard_editor_execute(this);">
		<?php $skin->editorHeader($content, $board)?>
		
		<?php foreach($board->fields()->getSkinFields() as $key=>$field):?>
			<?php echo $board->fields()->getTemplate($field, $content, $boardBuilder)?>
		<?php endforeach?>

		<!-- html 입력 필드 -->
		<!-- <div class="kboard-attr-row html-field">
			<label class="attr-name" for="title">
				<span class="field-name">네이버TV /<span class="pc-br">인스타그램 URL</span> </span></label>
			<div class="attr-value">
				<textarea name="" id="" rows="4"></textarea>
			</div>
		</div> -->
		<!-- html 입력 필드 -->

		<div class="kboard-control">
			<div class="left">
				<?php if($content->uid):?>
				<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>" class="kboard-hompage-review-button-small dalia-btn-01"><span class="button-text text-back"><?php echo __('Back', 'kboard')?></span></a>
				<a href="<?php echo esc_url($url->getBoardList())?>" class="kboard-hompage-review-button-small dalia-btn-01"><span class="button-text text-list"><?php echo __('List', 'kboard')?></span></a>
				<?php else:?>
				<a href="<?php echo esc_url($url->getBoardList())?>" class="kboard-hompage-review-button-small dalia-btn-01"><span class="button-text text-back"><?php echo __('Back', 'kboard')?></span></a>
				<?php endif?>
			</div>
			<div class="right">
				<?php if($board->isWriter()):?>
				<button type="submit" class="kboard-hompage-review-button-small dalia-btn-01"><span class="button-text text-save"><?php echo __('Save', 'kboard')?></span></button>
				<?php endif?>
			</div>
		</div>
	</form>
</div>

<?php wp_enqueue_script('kboard-hompage-review-editor', "{$skin_path}/editor.js", array(), KBOARD_VERSION, true)?>