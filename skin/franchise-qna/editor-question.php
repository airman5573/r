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
  const toggleVisibilityAndRequirement = (elementParent, isHidden, isRequired) => {
    isHidden ? elementParent.classList.add('hidden') : elementParent.classList.remove('hidden');
    isRequired ? elementParent.classList.add('required') : elementParent.classList.remove('required');
  };

  const clearInputValue = (inputElement) => {
    if (inputElement.type === 'checkbox') {
      inputElement.checked = false;
    } else {
      inputElement.value = '';
    }
  };

  const setInitialState = (element, isHidden, isRequired) => {
    clearInputValue(element);
    const elementParent = element.closest('.kboard-attr-row');
    toggleVisibilityAndRequirement(elementParent, isHidden, isRequired);
  };

  const processNoticeInputChange = (isNotice) => {
    const emailInput = document.querySelector('input[name="kboard_option_email"]');
    const agreementInput = document.querySelector('input[name="kboard_option_agree_checkbox"]');
    const telInput = document.querySelector('input[name="kboard_option_tel"]');
    const passwordInput = document.querySelector('input[name="password"]');

    setInitialState(emailInput, isNotice, !isNotice);
    setInitialState(agreementInput, isNotice, !isNotice);
    setInitialState(telInput, isNotice, !isNotice);
    toggleVisibilityAndRequirement(passwordInput.closest('.kboard-attr-row'), isNotice, false);
  };

  const processSecretCheckboxChange = (isSecret) => {
    const passwordInput = document.querySelector('input[name="password"]');
    clearInputValue(passwordInput);
    toggleVisibilityAndRequirement(passwordInput.closest('.kboard-attr-row'), !isSecret, false);
  };

  const noticeInput = document.querySelector('input[name="notice"]');
  noticeInput.addEventListener('change', () => {
    processNoticeInputChange(noticeInput.checked);
  });

  if (noticeInput.checked) {
    processNoticeInputChange(true);
  }

  const secretInput = document.querySelector('input[name="secret"]');
  secretInput.addEventListener('change', () => {
    processSecretCheckboxChange(secretInput.checked);
  });

  if (secretInput.checked) {
    processSecretCheckboxChange(true);
  }

  // Processing code exclusive to admin users
  <?php
    // if this user is admin, then uncheck secret checkbox
    if (dalia_is_admin()) {
      echo 'secretInput.checked = false;';
      echo 'processNoticeInputChange(true);';
      echo 'noticeInput.checked = true;';
    }
  ?>
});
</script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const telInput = document.querySelector('input[name="kboard_option_tel"]');
    const lastFourTelInput = document.querySelector('input[name="kboard_option_tel_last_four"]');
    if (!telInput || !lastFourTelInput) {
      console.warn('Tel input or last four tel input not found');
      return;
    }
    
    // sync telInput to lastFourTelInput. Extract only last four digits and insert it into lastFourTelInput. Always sync.
    telInput.addEventListener('input', () => {
      const telValue = telInput.value;
      const lastFourDigits = telValue.slice(-4);
      lastFourTelInput.value = lastFourDigits;
    });
  });
</script>
