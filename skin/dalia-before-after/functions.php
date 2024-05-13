<?php
if(!defined('ABSPATH')) exit;

global $dalia_before_after_skin_dir_name;
$dalia_before_after_skin_dir_name = basename(dirname(__FILE__));

wp_enqueue_style('font-awesome-5', 'https://use.fontawesome.com/releases/v5.10.0/css/all.css', array(), '5.10.0');

if(!function_exists('kboard_dalia_before_after_extends_setting')){
	add_filter("kboard_{$dalia_before_after_skin_dir_name}_extends_setting", 'kboard_dalia_before_after_extends_setting', 10, 3);
	function kboard_dalia_before_after_extends_setting($html, $meta, $board_id){
		$board = new KBoard($board_id);
		$dalia_before_after_login_message = $board->meta->dalia_before_after_login_message ? $board->meta->dalia_before_after_login_message : dalia_before_after_default_login_message();
		$dalia_before_after_filtering = $board->meta->dalia_before_after_filtering ? $board->meta->dalia_before_after_filtering : '';
		$dalia_before_after_absoulte_filtering = $board->meta->dalia_before_after_absoulte_filtering ? $board->meta->dalia_before_after_absoulte_filtering : '';
		
		ob_start();
		?>
		<h3>KBoard 전후사진 플러스 스킨 : 기본 설정</h3>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">로그인 안내문</th>
					<td>
						<?php wp_editor($dalia_before_after_login_message, 'dalia_before_after_login_message', array('editor_height'=>200))?>
						<p class="description">게시판 목록 페이지에 표시할 로그인 메시지를 입력해주세요.</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Before 이미지 필터링</th>
					<td>
						<select name="dalia_before_after_filtering">
							<option value="">활성화</option>
							<option value="off"<?php if($dalia_before_after_filtering == 'off'):?> selected<?php endif?>>비활성화</option>
						</select>
						<p class="description">Before 이미지를 볼 수 없게 필터링 합니다.</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Before 이미지 절대 필터링</th>
					<td>
						<select name="dalia_before_after_absoulte_filtering">
							<option value="">활성화</option>
							<option value="off"<?php if($dalia_before_after_absoulte_filtering == 'off'):?> selected<?php endif?>>비활성화</option>
						</select>
						<p class="description">로그인을 하기 전에는 필터링 뒤의 Before 이미지를 불러오지 않습니다.</p>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
		$html = ob_get_clean();
		return $html;
	}
}

if(!function_exists('kboard_dalia_before_after_extends_setting_update')){
	add_filter("kboard_{$dalia_before_after_skin_dir_name}_extends_setting_update", 'kboard_dalia_before_after_extends_setting_update', 10, 2);
	function kboard_dalia_before_after_extends_setting_update($board_meta, $board_id){
		$board_meta->dalia_before_after_login_message = isset($_POST['dalia_before_after_login_message']) ? sanitize_textarea_field($_POST['dalia_before_after_login_message']) : '';
		$board_meta->dalia_before_after_filtering = isset($_POST['dalia_before_after_filtering']) ? sanitize_text_field($_POST['dalia_before_after_filtering']) : '';
		$board_meta->dalia_before_after_absoulte_filtering = isset($_POST['dalia_before_after_absoulte_filtering']) ? sanitize_text_field($_POST['dalia_before_after_absoulte_filtering']) : '';
	}
}

if(!function_exists('kboard_dalia_before_after_skin_header')){
	add_filter('kboard_skin_header', 'kboard_dalia_before_after_skin_header', 10, 1);
	function kboard_dalia_before_after_skin_header($builder){
		global $dalia_before_after_skin_dir_name;
		if($builder->board->skin == $dalia_before_after_skin_dir_name){
			add_filter('gettext', 'kboard_dalia_before_after_get_text', 10, 3);
		}
	}
}

if(!function_exists('dalia_before_after_default_login_message')){
	/**
	 * 기본 로그인 안내문을 반환한다.
	 * @return string
	 */
	function dalia_before_after_default_login_message(){
		return '로그인 후 확인 가능합니다.';
	}
}

if(!function_exists('kboard_dalia_before_after_content_get_thumbnail')){
	add_filter('kboard_content_get_thumbnail', 'kboard_dalia_before_after_content_get_thumbnail', 10, 4);
	/**
	 * 전후사진은 썸네일 이미지로 사용하지 못하게 적용한다.
	 * @param unknown $thumbnail_url
	 * @param unknown $width
	 * @param unknown $height
	 * @param unknown $content
	 * @return string
	 */
	function kboard_dalia_before_after_content_get_thumbnail($thumbnail_url, $width, $height, $content){
		global $dalia_before_after_skin_dir_name;
		$board = $content->getBoard();
		if($board->skin == $dalia_before_after_skin_dir_name){
			if(!$content->thumbnail_file){
				$thumbnail_url = '';
			}
		}
		return $thumbnail_url;
	}
}

if(!function_exists('kboard_dalia_before_after_image')){
	/**
	 * 전후사진 주소를 반환한다.
	 * @param KBContent $content
	 * @return string
	 */
	function kboard_dalia_before_after_image($content, $postion){
		$before_after_image = '';
		if(isset($content->attach->{$postion}) && $content->attach->{$postion}){
			$before_after_image = site_url($content->attach->{$postion}[0]);
		}
		return $before_after_image;
	}
}

if(!function_exists('kboard_dalia_before_after_image_check')){
	/**
	 * 전후사진 업로드 유무를 반환한다.
	 * @param KBContent $content
	 * @return boolean
	 */
	function kboard_dalia_before_after_image_check($content, $postion){
		$before_after_image_check = '';
		$check_img = kboard_dalia_before_after_image($content, $postion);
		if($check_img !== ''){
			$before_after_image_check = true;
		}
		else{
			$before_after_image_check = false;
		}
		return $before_after_image_check;
	}
}

if(!function_exists('kboard_dalia_before_after_first_image')){
	function kboard_dalia_before_after_first_image($content){
		$first_image = '';
		if(kboard_dalia_before_after_image_check($content, 'front_beforer_image') || kboard_dalia_before_after_image_check($content, 'front_after_image')){
			$first_image = 'front';
		}
		elseif(!kboard_dalia_before_after_image_check($content, 'front_beforer_image') && !kboard_dalia_before_after_image_check($content, 'front_after_image')){
			if(kboard_dalia_before_after_image_check($content, 'half_side_before_image') || kboard_dalia_before_after_image_check($content, 'half_side_after_image')){
				$first_image = 'half-side';
			}
			elseif(!kboard_dalia_before_after_image_check($content, 'half_side_before_image') && !kboard_dalia_before_after_image_check($content, 'half_side_after_image')){
				$first_image = 'side';
			}
		}
		return $first_image;
	}
}

if(!function_exists('kboard_dalia_before_after_get_text')){
	/**
	 * 카테고리 이름을 변경한다.
	 * @param string $translated_text
	 * @param string $text
	 * @param string $domain
	 * @return string
	 */
	function kboard_dalia_before_after_get_text($translated_text, $text, $domain){
		if($domain == 'kboard'){
			switch($translated_text){
				case '전체': $translated_text = '전체보기'; break;
			}
		}
		return $translated_text;
	}
}

add_filter('kboard_skin_fields', 'kboard_dalia_before_after_skin_field', 10, 2);
if(!function_exists('kboard_dalia_before_after_skin_field')){
	function kboard_dalia_before_after_skin_field($fields, $board){
		if($board->skin == 'dalia-before-after'){
			if(!isset($fields['front_before_image'])){
				$fields['front_before_image'] = array(
					'field_type' => 'file',
					'field_label' => __('정면 전 이미지', 'kboard'),
					'field_name' => __('정면 전 이미지', 'kboard_attach_front_before_image'),
					'class' => 'kboard-attr-file front-before-image',
					'meta_key' => 'front_before_image',
					'permission' => '',
					'roles' => array(),
					'description' => '※ 1:1 비율의 이미지를 등록해주세요.',
					'show_document' => '',
					'close_button' => 'yes'
				);
			}
			if(!isset($fields['front_after_image'])){
				$fields['front_after_image'] = array(
					'field_type' => 'file',
					'field_label' => __('정면 후 이미지', 'kboard'),
					'field_name' => __('정면 후 이미지', 'kboard_attach_front_after_image'),
					'class' => 'kboard-attr-file front-after-image',
					'meta_key' => 'front_after_image',
					'permission' => '',
					'roles' => array(),
					'description' => '※ 1:1 비율의 이미지를 등록해주세요.',
					'show_document' => '',
					'close_button' => 'yes'
				);
			}
			if(!isset($fields['half_side_before_image'])){
				$fields['half_side_before_image'] = array(
					'field_type' => 'file',
					'field_label' => __('반측면 전 이미지', 'kboard'),
					'field_name' => __('반측면 전 이미지', 'kboard_attach_half_side_before_image'),
					'class' => 'kboard-attr-file half-side-before-plus',
					'meta_key' => 'half_side_before_image',
					'permission' => '',
					'roles' => array(),
					'description' => '※ 1:1 비율의 이미지를 등록해주세요.',
					'show_document' => '',
					'close_button' => 'yes'
				);
			}
			if(!isset($fields['half_side_after_image'])){
				$fields['half_side_after_image'] = array(
					'field_type' => 'file',
					'field_label' => __('반측면 후 이미지', 'kboard'),
					'field_name' => __('반측면 후 이미지', 'kboard_attach_half_side_after_image'),
					'class' => 'kboard-attr-file half-side-after-plus',
					'meta_key' => 'half_side_after_image',
					'permission' => '',
					'roles' => array(),
					'description' => '※ 1:1 비율의 이미지를 등록해주세요.',
					'show_document' => '',
					'close_button' => 'yes'
				);
			}
			if(!isset($fields['side_before_image'])){
				$fields['side_before_image'] = array(
					'field_type' => 'file',
					'field_label' => __('측면 전 이미지', 'kboard'),
					'field_name' => __('측면 전 이미지', 'kboard_attach_side_before_image'),
					'class' => 'kboard-attr-file side-before-image',
					'meta_key' => 'side_before_image',
					'permission' => '',
					'roles' => array(),
					'description' => '※ 1:1 비율의 이미지를 등록해주세요.',
					'show_document' => '',
					'close_button' => 'yes'
				);
			}
			if(!isset($fields['side_after_image'])){
				$fields['side_after_image'] = array(
					'field_type' => 'file',
					'field_label' => __('측면 후 이미지', 'kboard'),
					'field_name' => __('측면 후 이미지', 'kboard_attach_side_after_image'),
					'class' => 'kboard-attr-file side-after-image',
					'meta_key' => 'side_after_image',
					'permission' => '',
					'roles' => array(),
					'description' => '※ 1:1 비율의 이미지를 등록해주세요.',
					'show_document' => '',
					'close_button' => 'yes'
				);
			}
		}
		
		return $fields;
	}
}