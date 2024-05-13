<div id="kboard-franchise-qna-editor">
	<form class="kboard-form" method="post" action="<?php echo $url->getContentEditorExecute()?>" enctype="multipart/form-data" onsubmit="return kboard_editor_execute(this);">
		<?php $skin->editorHeader($content, $board)?>
		
		<?php foreach($board->fields()->getSkinFields() as $key=>$field):?>
			<?php echo $board->fields()->getTemplate($field, $content, $boardBuilder)?>
		<?php endforeach?>
		
		<div class="kboard-control">
			<div class="left">
				<?php if($content->uid):?>
				<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>" class="kboard-franchise-qna-button-small dalia-btn-01"><?php echo __('Back', 'kboard')?></a>
				<a href="<?php echo $url->getBoardList()?>" class="kboard-franchise-qna-button-small dalia-btn-01"><?php echo __('List', 'kboard')?></a>
				<?php else:?>
				<a href="<?php echo $url->getBoardList()?>" class="kboard-franchise-qna-button-small dalia-btn-01"><?php echo __('Back', 'kboard')?></a>
				<?php endif?>
			</div>
			<div class="right">
				<?php if($board->isWriter()):?>
				<button type="submit" class="kboard-franchise-qna-button-small dalia-btn-01"><?php echo __('Save', 'kboard')?></button>
				<?php endif?>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript" src="<?php echo $skin_path?>/script.js?<?php echo KBOARD_VERSION?>"></script>
<script>
jQuery(document).ready(function(){
	var auto_secret_check = false;
	var document_uid = <?php echo intval($content->uid)?>;
	if(auto_secret_check && !document_uid){
		jQuery('input[name=secret]').prop('checked', true);
		kboard_toggle_password_field(jQuery('input[name=secret]'));
	}
});
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const toggleClass = (element, className, condition) => {
    condition ? element.classList.add(className) : element.classList.remove(className);
  };

  const noticeInput = document.querySelector('input[name="notice"]');

  const emailInput = document.querySelector('input[name="kboard_option_email"]');
  const emailInputParent = emailInput.closest('.kboard-attr-row');

  const agreementInput = document.querySelector('input[name="kboard_option_agree_checkbox"]');
  const agreementInputParent = agreementInput.closest('.kboard-attr-row');

  const telInput = document.querySelector('input[name="kboard_option_tel"]');
  const telInputParent = telInput.closest('.kboard-attr-row');

  const handleToggle = (isNotice) => {
	emailInput.value = '';
	toggleClass(emailInputParent, 'required', !isNotice);
	toggleClass(emailInputParent, 'hidden', isNotice);

	agreementInput.checked = false;
	toggleClass(agreementInputParent, 'required', !isNotice);
	toggleClass(agreementInputParent, 'hidden', isNotice);

	telInput.value = '';
	toggleClass(telInput, 'required', !isNotice);
	toggleClass(telInputParent, 'hidden', isNotice);
  };

  // if noticeINput is checked, then required,
  noticeInput.addEventListener('change', () => {
	const isNotice = noticeInput.checked;
	handleToggle(isNotice);
  });

  // if noticeInput is checked, then required,
  if (noticeInput.checked) {
	handleToggle(true);
  }


  const secretInput = document.querySelector('input[name="secret"]');
<?php
	// if this user is admin, then uncheck secret checkbox
	if (dalia_is_admin()) {
		echo 'secretInput.checked = false;';
		echo 'handleToggle(true);';
		echo 'noticeInput.checked = true;';
	}
?>
});
</script>
