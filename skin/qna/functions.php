<?php
if(!defined('ABSPATH')) exit;

if(!function_exists('kboard_ask_status')){
	function kboard_ask_status(){
		$status = array('답변대기', '답변완료');
		return $status;
	}
}

if(!function_exists('kboard_qna_get_template_field_html')){
	add_filter('kboard_get_template_field_html', 'kboard_qna_get_template_field_html', 10, 4);
	function kboard_qna_get_template_field_html($html, $field, $content, $board){
		if($field['meta_key'] == 'category2' && $board->skin == 'qna'){
			ob_start();
			?>
			<?php
			if(!$board->initCategory2()){
				$board->category = kboard_ask_status();
			}
			?>
			<?php if($board->isAdmin()):?>
			<div class="kboard-attr-row">
				<label class="attr-name" for="kboard-select-category2"><?php echo __('Status', 'kboard')?></label>
				<div class="attr-value">
					<select id="kboard-select-category2" name="category2">
						<?php while($board->hasNextCategory()):?>
						<option value="<?php echo $board->currentCategory()?>"<?php if($content->category2 == $board->currentCategory()):?> selected<?php endif?>><?php echo $board->currentCategory()?></option>
						<?php endwhile?>
						<!-- <option value="">상태없음</option> -->
					</select>
					<div class="description">※ 상태는 관리자만 수정할 수 있습니다.</div>
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

if (!function_exists('kboard_qna_get_all_category_count')) {
	function kboard_qna_get_all_category_count(&$board) {
		$all_category_count = 0;
		while ($board->hasNextCategory()) {
			$count = $board->getCategoryCount(array('category1' => $board->currentCategory()));
			if ($count) {
				$all_category_count += absint($count);
			}
		}
		return $all_category_count;
	}
}

function dalia_qna_kboard_get_username(&$content, &$boardBuilder) {
	return apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder);
}

function dalia_qna_kboard_get_notify_method(&$content) {
	return $content->option->{'notification_method'} ?: '';
}

function dalia_qna_kboard_get_email(&$content) {
	return $content->option->{'qna_email'} ?: '';
}

function dalia_qna_kboard_get_tel(&$content) {
	return $content->option->{'tel'} ?: '';
}

function dalia_qna_send_email_when_user_ask_question($content_uid, $board_id, $content, $board) {
	if (dalia_is_admin()) {
		return;
	}

	$branch_term_id = $content->option->{'branch'};
	if (!$branch_term_id) {
		error_log('Branch not found');
		return;
	}

	$branch = dalia_get_branch_post_by_term_id($branch_term_id);
	$branch_post_id = $branch->ID;
	$branch_emails = dalia_get_branch_emails($branch_post_id);

	if (empty($branch_emails)) {
		error_log('Branch email not found');
		return;
	}

	$title = $content->title;
    $url = new KBUrl();

    // Create the mail instance and set common properties
    $mail = kboard_mail();
    $mail->to = $branch_emails;
	// $mail->to = "rpf5573@gmail.com";
    $mail->title = '[' . __('KBoard new document', 'kboard') . '] ' . $board->board_name . ' - ' . $title;
    $mail->content = $content->getDocumentOptionsHTML() . $content->content;
    $mail->url = $url->getDocumentRedirect($content->uid);
    $mail->url_name = '게시물 보기';
    $mail->send();
}
add_action( 'kboard_document_insert_9', 'dalia_qna_send_email_when_user_ask_question', 10, 4 );

function dalia_qna_send_email_when_user_add_comment_to_the_question_article($comment_id, $content_uid, $board) {
	if (dalia_is_admin()) {
		return;
	}

	$content = new KBContent($board->board_id);
	$content->initWithUID($content_uid);
	
	$branch_term_id = $content->option->{'branch'};
	if (!$branch_term_id) {
		error_log('Branch not found');
		return;
	}

	$branch = dalia_get_branch_post_by_term_id($branch_term_id);
	$branch_post_id = $branch->ID;
	$branch_emails = dalia_get_branch_emails($branch_post_id);

	if (empty($branch_emails)) {
		error_log('Branch email not found');
		return;
	}

	$title = $content->title;
    $url = new KBUrl();

	$comment = new KBComment();
	$comment->initWithUID($comment_id);
	$comment_content = $comment->getContent();

    // Create the mail instance and set common properties
    $mail = kboard_mail();
    $mail->to = $branch_emails;
    $mail->title = '[신규댓글] ' . $board->board_name . ' - ' . $title;
    $mail->content = '[댓글내용] ' . "\n" . $comment_content;
    $mail->url = $url->getDocumentRedirect($content->uid);
    $mail->url_name = '게시물 보기';
    $mail->send();
}
add_action( 'kboard_comments_insert_9', 'dalia_qna_send_email_when_user_add_comment_to_the_question_article', 10, 3 );

function dalia_qna_change_ask_status_to_reask_when_comment_inserted($comment_id, $content_uid, $board) {
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
// add_action( 'kboard_comments_insert_9', 'dalia_qna_change_ask_status_to_reask_when_comment_inserted', 10, 3 );

// Function to log all functions registered to 'kboard_document_insert'
function log_registered_functions_for_kboard_document_insert() {
    if (isset($GLOBALS['wp_filter']['kboard_document_insert'])) {
        error_log('Functions registered to kboard_document_insert:');
        $hook = $GLOBALS['wp_filter']['kboard_document_insert'];
        if (is_a($hook, 'WP_Hook')) {
            foreach ($hook->callbacks as $priority => $functions) {
                foreach ($functions as $function) {
                    if (is_array($function['function'])) {
                        $func_name = $function['function'][1];
                        $class_name = is_object($function['function'][0]) ? get_class($function['function'][0]) : $function['function'][0];
                        error_log("Priority: $priority, Function: {$class_name}::{$func_name}");
                    } elseif (is_string($function['function'])) {
                        error_log("Priority: $priority, Function: {$function['function']}");
                    } else {
                        error_log("Priority: $priority, Function: Anonymous or Closure");
                    }
                }
            }
        } else {
            error_log('No functions registered to kboard_document_insert.');
        }
    } else {
        error_log('No functions registered to kboard_document_insert.');
    }
}

// sort by status
function dalia_qna_sort_board_by_status($orderby, $board_id, $kboard) {
    if (isset($_GET['sort_by_status']) && $_GET['sort_by_status']) {
        global $wpdb;
        // Define the custom order.
        $custom_order = "
            CASE `{$wpdb->prefix}kboard_board_content`.`category2`
				WHEN '답변대기' THEN 1
				WHEN '' THEN 2
                WHEN '답변완료' THEN 3
                ELSE 4
            END
        ";
        $orderby = "{$custom_order}, `{$wpdb->prefix}kboard_board_content`.`category2` ASC";
    }
    return $orderby;
}
add_filter('kboard_list_orderby', 'dalia_qna_sort_board_by_status', 10, 3);



// Status Sync -- Start
add_action( 'kboard_document_insert_9', 'dalia_qna_sync_status_when_insert_answer', 10, 4 );
function dalia_qna_sync_status_when_insert_answer($content_uid, $board_id, $content, $board) {
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

add_action('kboard_document_update', 'dalia_qna_sync_status_when_update_answer', 10, 3);
function dalia_qna_sync_status_when_update_answer($content_uid, $board_id, $board) {
	global $wpdb;

	if ($board_id !== 9) {
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

add_filter('kboard_get_template_field_html', 'kboard_qna_get_template_field_html', 10, 4);
function kboard_qna_get_template_field_html($html, $field, $content, $board){
	if ($field['meta_key'] == 'category2' && $board->skin == 'qna') {
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
add_action('kboard_document_insert_9', 'dalia_qna_sync_branch_id_with_location_text_and_branch_text_when_insert', 11, 4);
function dalia_qna_sync_branch_id_with_location_text_and_branch_text_when_insert($content_uid, $board_id, $content, $board) {
    dalia_sync_branch_and_location($content);
}

add_action('kboard_document_update', 'dalia_qna_sync_branch_id_with_location_text_and_branch_text_when_update', 11, 3);
function dalia_qna_sync_branch_id_with_location_text_and_branch_text_when_update($content_uid, $board_id, $board) {
    if ($board_id !== 9) {
        return;
    }

    $content = new KBContent($board_id);
    $content->initWithUID($content_uid);

    dalia_sync_branch_and_location($content);
}
// Branch and Location Sync -- End