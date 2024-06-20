<?php
$locations = dalia_get_location_with_branches();
$fields = $board->fields();
?>

<div id="kboard-default-reply-list-editor">
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