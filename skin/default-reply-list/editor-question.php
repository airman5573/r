<?php
$locations = dalia_get_location_with_branches();
$care_programs = dalia_get_care_programs();
$fields = $board->fields();
?>

<div id="kboard-default-reply-list-editor" class="kboard-default-reply-list-editor--question">
	<form class="kboard-form" method="post" action="<?php echo esc_url($url->getContentEditorExecute())?>" enctype="multipart/form-data" onsubmit="return kboard_editor_execute(this);">
		<?php $skin->editorHeader($content, $board)?>
		
		<?php foreach($board->fields()->getSkinFields() as $key=>$field):?>
			<?php echo $board->fields()->getTemplate($field, $content, $boardBuilder)?>
		<?php endforeach?>
		
		<div class="kboard-control flex-center">
				<?php if($content->uid):?>
				<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>" class="kboard-default-reply-list-button-small dalia-btn-01"><?php echo __('Back', 'kboard')?></a>
				<a href="<?php echo esc_url($url->getBoardList())?>" class="kboard-default-reply-list-button-small dalia-btn-01"><?php echo __('List', 'kboard')?></a>
				<?php else:?>
				<a href="<?php echo esc_url($url->getBoardList())?>" class="kboard-default-reply-list-button-small dalia-btn-01"><?php echo __('Back', 'kboard')?></a>
				<?php endif?>
				<?php if($board->isWriter()):?>
				<button type="submit" class="kboard-default-reply-list-button-small dalia-btn-01"><?php echo __('Save', 'kboard')?></button>
				<?php endif?>
			</div>
		</div>
	</form>
</div>

<?php wp_enqueue_script('kboard-default-reply-list-script', "{$skin_path}/script.js", array(), KBOARD_VERSION, true)?>

<!-- 지역/지점 선택 -->
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

<!-- 프로그램 선택 -->
<script type="text/javascript">
jQuery(document).ready(function() {
	const carePrograms = <?php echo json_encode($care_programs); ?>;

	const primarySelectBox = jQuery("#select-care_program-1");
	const secondarySelectBox = jQuery("#select-care_program-2");
	const tertiarySelectBox = jQuery("#select-care_program-3");
	const tertiaryContainer = jQuery(".select-box-container-3");
	const hiddenInput = jQuery("#care_program");

	// 기본 옵션 추가
	function initializeSelectBox(selectBox, options) {
		selectBox.empty();
		selectBox.append("<option value=''>프로그램</option>");
		options.forEach(option => {
			selectBox.append("<option value='" + option.term_id + "'>" + option.term_name + "</option>");
		});
	}

	// 주 select box 초기화
	initializeSelectBox(primarySelectBox, carePrograms);

	// 주 select box 변경 시
	primarySelectBox.on("change", function() {
		const selectedValue = jQuery(this).val();
		if (selectedValue) {
			const selectedProgram = carePrograms.find(program => program.term_id == selectedValue);
			initializeSelectBox(secondarySelectBox, selectedProgram.children);
			secondarySelectBox.prop("disabled", false);
			tertiarySelectBox.prop("disabled", true);
			tertiaryContainer.addClass("d-none");
			tertiarySelectBox.empty().append("<option value=''>프로그램</option>");
		} else {
			secondarySelectBox.prop("disabled", true);
			secondarySelectBox.empty().append("<option value=''>프로그램</option>");
			tertiarySelectBox.prop("disabled", true);
			tertiaryContainer.addClass("d-none");
			tertiarySelectBox.empty().append("<option value=''>프로그램</option>");
		}
	});

	// 중간 select box 변경 시
	secondarySelectBox.on("change", function() {
		const primarySelectedValue = primarySelectBox.val();
		const selectedValue = jQuery(this).val();
		if (selectedValue) {
			const primarySelectedProgram = carePrograms.find(program => program.term_id == primarySelectedValue);
			const selectedProgram = primarySelectedProgram.children.find(program => program.term_id == selectedValue);

			if (selectedProgram.children.length > 0) {
				initializeSelectBox(tertiarySelectBox, selectedProgram.children);
				tertiarySelectBox.prop("disabled", false);
				tertiaryContainer.removeClass("d-none");
			} else {
				tertiarySelectBox.prop("disabled", true);
				tertiaryContainer.addClass("d-none");
				tertiarySelectBox.empty().append("<option value=''>프로그램</option>");
				hiddenInput.val(selectedValue); // 자식 항목이 없으면 hidden input에 선택된 값 설정
			}
		} else {
			tertiarySelectBox.prop("disabled", true);
			tertiaryContainer.addClass("d-none");
			tertiarySelectBox.empty().append("<option value=''>프로그램</option>");
		}
	});

	// 하위 select box 변경 시
	tertiarySelectBox.on("change", function() {
		const selectedValue = jQuery(this).val();
		hiddenInput.val(selectedValue); // 숨겨진 input에 선택된 값 설정
	});
});

// 관리자인 경우에 자동으로 필수 필드 삭제 및 공지사항 자동 체크
jQuery(($) => {
	const removeFieldsForAdmin = () => {
		const fieldsToRemove = [
			'input[name="kboard_option_email"]',
			'input[name="kboard_option_agree_checkbox[]"]',
			'input[name="kboard_option_tel"]',
			'input[name="kboard_option_branch"]',
			'select[name="care_program_1"]',
			'select[name="care_program_2"]',
			'select[name="care_program_3"]',
			'select[name="kboard_option_notification_method"]',
			'select[name="category1"]',
			'input[name="password"]',
		];

		fieldsToRemove.forEach(selector => {
			$(selector).closest('.kboard-attr-row').remove();
		});
	};

	// Admin-specific processing
	const isAdmin = <?= json_encode(dalia_is_admin()) ?>;
	if (isAdmin) {
		removeFieldsForAdmin();
		
		// 공지사항 체크
		$('input[name="notice"]').prop('checked', true);
	}
});

</script>
