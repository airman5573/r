<?php
if(!defined('ABSPATH')) exit;

if(!function_exists('kboard_ask_status')){
	function kboard_ask_status(){
		$status = array('답변대기', '답변완료');
		return $status;
	}
}

if(!function_exists('kboard_franchise_qna_get_template_field_html')){
	add_filter('kboard_get_template_field_html', 'kboard_franchise_qna_get_template_field_html', 10, 4);
	function kboard_franchise_qna_get_template_field_html($html, $field, $content, $board){
		if($field['meta_key'] == 'category2' && $board->skin == 'franchise-qna'){
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
}

function dalia_franchise_qna_send_email_when_user_ask_question($content_uid, $board_id, $content, $board) {
	if (dalia_is_admin()) {
		return;
	}

	$title = $content->title;
    $url = new KBUrl();

	$emails = ["rpf5573@gmail.com", "rpf5573@kakao.com"];

    // Create the mail instance and set common properties
    $mail = kboard_mail();
    $mail->to = $emails;
	// $mail->to = "rpf5573@gmail.com";
    $mail->title = '[' . __('KBoard new document', 'kboard') . '] ' . $board->board_name . ' - ' . $title;
    $mail->content = $content->getDocumentOptionsHTML() . $content->content;
    $mail->url = $url->getDocumentRedirect($content->uid);
    $mail->url_name = '게시물 보기';
    $mail->send();
}
add_action( 'kboard_document_insert_12', 'dalia_franchise_qna_send_email_when_user_ask_question', 10, 4 );

function dalia_franchise_qna_send_email_when_user_add_comment_to_the_question_article($comment_id, $content_uid, $board) {
	if (dalia_is_admin()) {
		return;
	}

	$content = new KBContent($board->board_id);
	$content->initWithUID($content_uid);
	
	$title = $content->title;
    $url = new KBUrl();

	$comment = new KBComment();
	$comment->initWithUID($comment_id);
	$comment_content = $comment->getContent();

	$emails = ["rpf5573@gmail.com", "rpf5573@kakao.com"];

    // Create the mail instance and set common properties
    $mail = kboard_mail();
    $mail->to = $emails;
    $mail->title = '[신규댓글] ' . $board->board_name . ' - ' . $title;
    $mail->content = '[댓글내용] ' . "\n" . $comment_content;
    $mail->url = $url->getDocumentRedirect($content->uid);
    $mail->url_name = '게시물 보기';
    $mail->send();
}
add_action( 'kboard_comments_insert_12', 'dalia_franchise_qna_send_email_when_user_add_comment_to_the_question_article', 10, 3 );

// Status Sync -- Start
function dalia_franchise_qna_sync_status_when_insert_answer($content_uid, $board_id, $content, $board) {
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
add_action( 'kboard_document_insert_12', 'dalia_franchise_qna_sync_status_when_insert_answer', 10, 4 );

function dalia_franchise_qna_sync_status_when_update_answer($content_uid, $board_id, $board) {
	global $wpdb;

	if ($board_id !== 12) {
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
add_action('kboard_document_update', 'dalia_franchise_qna_sync_status_when_update_answer', 10, 3);
// Status Sync -- End

function dalia_franchise_qna_kboard_get_email(&$content) {
	return $content->option->{'email'} ?: '';
}

function dalia_franchise_qna_kboard_get_tel(&$content) {
	return $content->option->{'tel'} ?: '';
}

function dalia_franchise_qna_change_ask_status_to_reask_when_comment_inserted($comment_id, $content_uid, $board) {
	if (dalia_is_admin()) {
		return;
	}

	$content = new KBContent($board->board_id);
	$content->initWithUID($content_uid);

	$data = [
		'category2' => '재질문'
	];
	$content->updateContent($data);
}
// add_action( 'kboard_comments_insert_12', 'dalia_franchise_qna_change_ask_status_to_reask_when_comment_inserted', 10, 3 );
