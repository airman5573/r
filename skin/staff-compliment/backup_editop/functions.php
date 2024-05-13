<?php
if(!defined('ABSPATH')) exit;

if(!function_exists('kboard_ask_status')){
	function kboard_ask_status(){
		$status = array('답변대기', '답변완료');
		return $status;
	}
}

if(!function_exists('kboard_ask_one_get_template_field_html')){
	add_filter('kboard_get_template_field_html', 'kboard_ask_one_get_template_field_html', 10, 4);
	function kboard_ask_one_get_template_field_html($html, $field, $content, $board){
		if($field['meta_key'] == 'category2' && $board->skin == 'staff-compliement'){
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
	add_filter('kboard_skin_fields', 'my_kboard_skin_fields', 10, 2);
	function my_kboard_skin_fields($fields, $board){
		
		if($board->id == '20'){ // 실제 적용될 게시판 ID 값으로 변경해주세요.
			
			if(!isset($fields['agree_checkbox'])){
				$fields['agree_checkbox'] = array(
					'field_type' => 'agree_checkbox',
					'field_label' => '개인정보 제공 및 활용 동의',
					'class' => 'kboard-attr-checkbox',
					'hidden' => '',
					'meta_key' => '',
					'field_name' => '',
					'permission' => '',
					'roles' => '',
					'default_value' => '',
					'placeholder' => '',
					'required' => '',
					'show_document' => '',
					'description' => '',
					'close_button' => 'yes'
				);
			}
		}
		
		return $fields;
	}
	add_filter('kboard_get_template_field_html', 'my_kboard_get_template_field_html', 10, 4);
	function my_kboard_get_template_field_html($field_html, $field, $content, $board){
		
		if($field['field_type'] == 'agree_checkbox'){
			ob_start();
			?>
			<div class="kboard-attr-row meta-key-<?php echo esc_attr($field['meta_key'])?> required">
				<label class="attr-name" for="agree_checkbox" style="display:none">
					<span class="field-name"><?php echo esc_html($field['field_name'] ? $field['field_name'] : $field['field_label'])?></span>
				</label>
				<div class="attr-value" >
					<div style="margin: 20px 0; padding: 10px; height: 100px; background-color: #f2f2f2; overflow-y: auto;">
						<p>정보통신망법 규정에 따라 OOO에 회원가입 신청하시는 분께 수집하는 개인정보의 항목, 개인정보의 수집 및 이용목적, 개인정보의 보유 및 이용기간을 안내 드리오니 자세히 읽은 후 동의하여 주시기 바랍니다.</p>
						<p>1. 수집하는 개인정보</p>
						<p>2. 수집한 개인정보의 이용</p>
						<p>3. 개인정보의 파기</p>
					</div>
					<div style="text-align:center;">
						<input type="hidden" class="required" name="kboard_option_<?php echo esc_attr($field['meta_key'])?>" value="1">
						<label><input type="checkbox" class="required" name="kboard_option_<?php echo esc_attr($field['meta_key'])?>" value="1"> 개인정보 제공 및 활용에 동의합니다.</label>
					</div>
				</div>
			</div>
			<?php
			$field_html = ob_get_clean();
		}
		
		return $field_html;
	}
}