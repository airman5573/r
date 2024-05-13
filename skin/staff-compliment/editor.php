<?php
$locations = dalia_get_location_with_branches();
$fields = $board->fields();
?>

<div id="kboard-staff-compliment-editor">
	<form class="kboard-form" method="post" action="<?php echo $url->getContentEditorExecute()?>" enctype="multipart/form-data" onsubmit="return kboard_editor_execute(this);">
		<?php $skin->editorHeader($content, $board)?>

		<?php foreach($board->fields()->getSkinFields() as $key=>$field):?>
			<?php echo $board->fields()->getTemplate($field, $content, $boardBuilder)?>
		<?php endforeach?>
		
		<div class="kboard-control">
			<div class="left">
				<?php if($content->uid):?>
				<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>" class="kboard-qna-button-small dalia-btn-01"><?php echo __('Back', 'kboard')?></a>
				<a href="<?php echo $url->getBoardList()?>" class="kboard-qna-button-small dalia-btn-01"><?php echo __('List', 'kboard')?></a>
				<?php else:?>
				<a href="<?php echo $url->getBoardList()?>" class="kboard-qna-button-small dalia-btn-01"><?php echo __('Back', 'kboard')?></a>  
				<?php endif?>
			</div>
			<div class="right">
				<?php if($board->isWriter()):?>
				<button type="submit" class="kboard-qna-button-small dalia-btn-01"><?php echo __('Save', 'kboard')?></button>
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

<script type="text/javascript">
jQuery(document).ready(function() {
    const locations = <?php echo json_encode($locations); ?>;

    const locationSelectBox = jQuery("select[name='location']");

    for (let i = 0; i < locations.length; i++) {
        locationSelectBox.append("<option value='" + locations[i].term_id + "'>" + locations[i].term_name + "</option>");
    }

    jQuery(document).on("change", "select[name='location']", function() {
        const branchSelectBox = jQuery("select[name='branch_select']");
        branchSelectBox.children().remove();

        jQuery("option:selected", this).each(function() {
            const selectValue = jQuery(this).val();
            branchSelectBox.append("<option value=''>전체</option>");

            for (let i = 0; i < locations.length; i++) {
                if (selectValue == locations[i].term_id) {
                    const children = locations[i].children;
                    for (let j = 0; j < children.length; j++) {
                        branchSelectBox.append("<option value='" + children[j].term_id + "'>" + children[j].term_name + "</option>");
                    }
                    break;
                }
            }
        });
    });

	// insert option value to the hidden input whose name is 'branch' when branch_select is selcted.
	jQuery(document).on("change", "select[name='branch_select']", function() {
		jQuery("option:selected", this).each(function() {
			const selectValue = jQuery(this).val();
			jQuery("input[name='kboard_option_branch']").val(selectValue);
		});
	});

	const branchInput = jQuery("input[name='kboard_option_branch']");
	if (branchInput.val()) {
		const branchValue = branchInput.val();
		// find location with branchValue. branchValue is just a term_id
		let locationValue = null;
		for (let i = 0; i < locations.length; i++) {
			const children = locations[i].children;
			for (let j = 0; j < children.length; j++) {
				if (children[j].term_id == branchValue) {
					locationValue = locations[i].term_id;
					break;
				}
			}
		}
		locationSelectBox.val(locationValue);
		locationSelectBox.trigger("change");

		setTimeout(() => {
			const branchSelectBox = jQuery("select[name='branch_select']");
			branchSelectBox.val(branchValue);
			branchSelectBox.trigger("change");
		}, 500);
	}
});
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const toggleClass = (element, className, condition) => {
    condition ? element.classList.add(className) : element.classList.remove(className);
  };

  const noticeInput = document.querySelector('input[name="notice"]');

  const branchInput = document.querySelector('input[name="kboard_option_branch"]');
  const branchInputParent = branchInput.closest('.kboard-attr-row');

  const emailInput = document.getElementById('compliment_email');
  const emailInputParent = emailInput.closest('.kboard-attr-row');

  const agreementInput = document.querySelector('input[name="kboard_option_agree_checkbox"]');
  const agreementInputParent = agreementInput.closest('.kboard-attr-row');

  const handleToggle = (isNotice) => {
	branchInput.value = '';
	toggleClass(branchInputParent, 'required', !isNotice);
	toggleClass(branchInputParent, 'hidden', isNotice);

	emailInput.value = '';
	toggleClass(emailInputParent, 'required', !isNotice);
	toggleClass(emailInputParent, 'hidden', isNotice);

	agreementInput.checked = false;
	toggleClass(agreementInputParent, 'required', !isNotice);
	toggleClass(agreementInputParent, 'hidden', isNotice);
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
