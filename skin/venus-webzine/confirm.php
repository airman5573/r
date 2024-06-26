<div id="kboard-venus-webzine-editor">
	<form method="post" action="<?php echo esc_url($url->getConfirmExecute($content->uid))?>">
		<div class="kboard-attr-row kboard-confirm-row kboard-attr-title">
			<label class="attr-name"><?php echo __('Password', 'kboard')?></label>
			<div class="attr-value">
				<input type="password" name="password" placeholder="<?php echo __('Password', 'kboard')?>..." autofocus required>
				<?php if($board->isConfirmFailed()):?>
					<div class="description"><?php echo __('※ Your password is incorrect.', 'kboard')?></div>
				<?php endif?>
			</div>
		</div>
		<div class="kboard-control">
			<div class="left">
				<?php if($content->uid):?>
				<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>" class="kboard-venus-webzine-button-small dalia-btn-01"><?php echo __('Document', 'kboard')?></a>
				<?php endif?>
				<a href="<?php echo esc_url($url->getBoardList())?>" class="kboard-venus-webzine-button-small dalia-btn-01"><?php echo __('List', 'kboard')?></a>
			</div>
			<div class="right">
				<button type="submit" class="kboard-venus-webzine-button-small dalia-btn-01"><?php echo __('Password confirm', 'kboard')?></button>
			</div>
		</div>
	</form>
</div>