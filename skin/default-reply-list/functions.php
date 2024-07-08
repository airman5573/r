<?php

// Status Sync -- Start
add_action( 'kboard_document_insert_21', 'dalia_homepage_review_sync_status_when_insert_answer', 10, 4 );
function dalia_homepage_review_sync_status_when_insert_answer($content_uid, $board_id, $content, $board) {
	global $wpdb;

	// 답변인 경우에만 실행
	$parent_uid = $content->parent_uid;
	if (!$parent_uid) {
		return;
	}

	$category2_of_answer = $content->category2;
	if ($category2_of_answer) {
		$wpdb->update($wpdb->prefix . 'kboard_board_content', ['category2' => $category2_of_answer], ['uid' => $parent_uid]);
	}
}

add_action('kboard_document_update', 'dalia_homepage_review_sync_status_when_update_answer', 10, 3);
function dalia_homepage_review_sync_status_when_update_answer($content_uid, $board_id, $board) {
	global $wpdb;

	if ($board_id !== 21) {
		return;
	}

	$content = new KBContent($board_id);
	$content->initWithUID($content_uid);
	$parent_uid = $content->parent_uid;
	if (!$parent_uid) {
		return;
	}

	$category2_of_answer = $content->category2;

	if ($category2_of_answer) {
		$wpdb->update($wpdb->prefix . 'kboard_board_content', ['category2' => $category2_of_answer], ['uid' => $parent_uid]);
	}
} 
// Status Sync -- End

add_filter('kboard_get_template_field_html', 'kboard_homepage_review_get_template_field_html', 10, 4);
function kboard_homepage_review_get_template_field_html($html, $field, $content, $board){
	if ($field['meta_key'] == 'category2' && $board->skin == 'default-reply-list') {
		ob_start();
		if(!$board->initCategory2()){
			$board->category = kboard_ask_status();
		}

		if($board->isAdmin()):?>
		<div class="kboard-attr-row">
			<label class="attr-name" for="kboard-select-category2"><?php echo __('Status', 'kboard')?></label>
			<div class="attr-value">
				<select id="kboard-select-category2" name="category2">
					<?php while($board->hasNextCategory()):?>
					<option value="<?php echo $board->currentCategory()?>"<?php if($content->category2 == $board->currentCategory()):?> selected<?php endif?>><?php echo $board->currentCategory()?></option>
					<?php endwhile?>
				</select>
			</div>
		</div>
		<?php else:?>
		<input type="hidden" name="category2" value="<?php echo $content->category2 ? $content->category2 : $board->category[0]?>">
		<?php endif?>
		<?php
		$html = ob_get_clean();
	}
	
	return $html;
}

// Branch and Location Sync -- Start
add_action('kboard_document_insert_21', 'dalia_review_sync_branch_id_with_location_text_and_branch_text_when_insert', 11, 4);
function dalia_review_sync_branch_id_with_location_text_and_branch_text_when_insert($content_uid, $board_id, $content, $board) {
    dalia_sync_branch_and_location($content);
}

add_action('kboard_document_update', 'dalia_review_sync_branch_id_with_location_text_and_branch_text_when_update', 11, 3);
function dalia_review_sync_branch_id_with_location_text_and_branch_text_when_update($content_uid, $board_id, $board) {
    if ($board_id !== 21) {
        return;
    }

    $content = new KBContent($board_id);
    $content->initWithUID($content_uid);

    dalia_sync_branch_and_location($content);
}
// Branch and Location Sync -- End
