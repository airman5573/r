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


<script>

jQuery(($) => {
  const toggleVisibilityAndRequirement = (elementParent, isHidden, isRequired) => {
    if (isHidden) {
      elementParent.addClass('hidden');
    } else {
      elementParent.removeClass('hidden');
    }

    if (isRequired) {
      elementParent.addClass('required');
    } else {
      elementParent.removeClass('required');
    }
  };

  const clearInputValue = (inputElement) => {
    if (inputElement.attr('type') === 'checkbox') {
      inputElement.prop('checked', false);
    } else {
      inputElement.val('');
    }
  };

  const clearInputs = () => {
    const inputsToClear = [
      'input[name="member_display"]', // Author input
      'input[name="kboard_option_email"]', // Email input
      'input[name="kboard_option_agree_checkbox"]', // Agreement input
      'input[name="secret"]', // Secret checkbox
    ];

    inputsToClear.forEach((selector) => {
      const input = $(selector);
      if (input.length) {
        clearInputValue(input);
      }
    });
  };

  const setInitialState = (element, isHidden, isRequired) => {
    clearInputValue(element);
    const elementParent = element.closest('.kboard-attr-row');
    if (elementParent.length) {
        toggleVisibilityAndRequirement(elementParent, isHidden, isRequired);
    } else {
      console.error('Parent element not found for', element);
    }
  };

  const processNoticeInputChange = (isNotice) => {
    const elements = [
      'input[name="member_display"]', // Author input
      'input[name="kboard_option_email"]', // Email input
      'input[name="kboard_option_agree_checkbox[]"]', // Agreement input
      'input[name="password"]' // Password input (assumed for secret posts)
    ];

    clearInputs();

    elements.forEach(selector => {
      const element = $(selector);
      if (element.length) {
        setInitialState(element, isNotice, !isNotice);
      } else {
        console.error('Element not found for', selector);
      }
    });

    const passwordInput = $('input[name="password"]');
    if (passwordInput.length) {
      toggleVisibilityAndRequirement(passwordInput.closest('.kboard-attr-row'), isNotice, false);
    }
  };

  const processSecretCheckboxChange = (isSecret) => {
    const passwordInput = $('input[name="password"]');
    if (passwordInput.length) {
      clearInputValue(passwordInput);
      toggleVisibilityAndRequirement(passwordInput.closest('.kboard-attr-row'), !isSecret, false);
    }
  };

  const noticeInput = $('input[name="notice"]');
  if (noticeInput.length) {
    noticeInput.on('change', () => {
      processNoticeInputChange(noticeInput.prop('checked'));
    });
    if (noticeInput.prop('checked')) {
      processNoticeInputChange(true);
    }
  }

  const secretInput = $('input[name="secret"]');
  if (secretInput.length) {
    secretInput.on('change', () => {
      processSecretCheckboxChange(secretInput.prop('checked'));
    });
    if (secretInput.prop('checked')) {
      processSecretCheckboxChange(true);
    }
  }

  // Processing code exclusive to admin users
  <?php
    // if this user is admin, then uncheck secret checkbox
    if (dalia_is_admin()) {
      echo 'secretInput.prop("checked", false);';
      echo 'processNoticeInputChange(true);';
      echo 'noticeInput.prop("checked", true);';
    }
  ?>
});

</script>
