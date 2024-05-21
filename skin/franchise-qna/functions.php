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
						<option value="">상태없음</option>
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

function dalia_franchise_qna_kboard_get_email(&$content) {
	return $content->option->{'email'} ?: '';
}

function dalia_franchise_qna_kboard_get_tel(&$content) {
	return $content->option->{'tel'} ?: '';
}