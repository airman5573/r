<?php

// Status Sync -- Start
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
add_action( 'kboard_document_insert_21', 'dalia_homepage_review_sync_status_when_insert_answer', 10, 4 );

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
add_action('kboard_document_update', 'dalia_homepage_review_sync_status_when_update_answer', 10, 3);
// Status Sync -- End