<?php
$is_answer_content = $content->parent_uid > 0;

if ($is_answer_content) {
	require_once KBOARD_DIR_PATH . '/skin/franchise-qna/editor-answer.php';
} else {
	require_once KBOARD_DIR_PATH . '/skin/franchise-qna/editor-question.php';
}
?>
