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
	$branch_email = dalia_get_branch_email($branch_post_id);

	if (!$branch_email) {
		error_log('Branch email not found');
		return;
	}

	$title = $content->title;

	$url = new KBUrl();
	$mail = kboard_mail();
	$mail->to = $branch_email;
	$mail->title = apply_filters('kboard_latest_alerts_subject', '['.__('KBoard new document', 'kboard').'] '.$board->board_name.' - '. $title , $content);
	$mail->content = apply_filters('kboard_latest_alerts_message', $content->getDocumentOptionsHTML() . $content->content, $content);
	$mail->url = $url->getDocumentRedirect($content->uid);
	$mail->url_name = __('Go to Homepage', 'kboard');
	$mail->send();
}
add_action( 'kboard_document_insert', 'dalia_qna_send_email_when_user_ask_question', 10, 4 );

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


