<?php
if(!defined('ABSPATH')) exit;

global $skin_dir_name;
$skin_dir_name = basename(dirname(__FILE__));

add_filter("kboard_{$skin_dir_name}_extends_setting", 'kboard_hwaikeul_gallery_extends_setting', 10, 3);
if(!function_exists('kboard_hwaikeul_gallery_extends_setting')){
	function kboard_hwaikeul_gallery_extends_setting($html, $meta, $board_id){
		$board = new KBoard($board_id);
		$page_rpp = $board->meta->mobile_page_rpp ? $board->meta->mobile_page_rpp : '';
		
		ob_start();
		?>
		<h3>KBoard 화이클 갤러리 스킨 : 기본 설정</h3>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row" style="width: 210px;"><label for="pc_row">PC 한 줄에 표시할 게시글 수</label></th>
					<td>
						<select name="pc_row" id="pc_row">
							<option value="1"<?php if($board->meta->pc_row == '1'):?> selected<?php endif?>>1개</option>
							<option value="2"<?php if($board->meta->pc_row == '2'):?> selected<?php endif?>>2개</option>
							<option value=""<?php if(!$board->meta->pc_row):?> selected<?php endif?>>3개</option>
							<option value="4"<?php if($board->meta->pc_row == '4'):?> selected<?php endif?>>4개</option>
							<option value="5"<?php if($board->meta->pc_row == '5'):?> selected<?php endif?>>5개</option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" style="width: 210px;"><label for="mobile_row">모바일 한 줄에 표시할 게시글 수</label></th>
					<td>
						<select name="mobile_row" id="mobile_row">
							<option value="">1개</option>
							<option value="2"<?php if($board->meta->mobile_row == '2'):?> selected<?php endif?>>2개</option>
							<option value="3"<?php if($board->meta->mobile_row == '3'):?> selected<?php endif?>>3개</option>
							<option value="4"<?php if($board->meta->mobile_row == '4'):?> selected<?php endif?>>4개</option>
							<option value="5"<?php if($board->meta->mobile_row == '5'):?> selected<?php endif?>>5개</option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" style="width: 210px;"><label for="latest_row">PC 한 줄에 표시할 최신글 수</label></th>
					<td>
						<select name="latest_row" id="latest_row">
							<option value="">1개</option>
							<option value="2"<?php if($board->meta->latest_row == '2'):?> selected<?php endif?>>2개</option>
							<option value="3"<?php if($board->meta->latest_row == '3'):?> selected<?php endif?>>3개</option>
							<option value="4"<?php if($board->meta->latest_row == '4'):?> selected<?php endif?>>4개</option>
							<option value="5"<?php if($board->meta->latest_row == '5'):?> selected<?php endif?>>5개</option>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
		$html = ob_get_clean();
		return $html;
	}
}

add_filter("kboard_{$skin_dir_name}_extends_setting_update", 'kboard_hwaikeul_gallery_extends_setting_update', 10, 2);
if(!function_exists('kboard_hwaikeul_gallery_extends_setting_update')){
	function kboard_hwaikeul_gallery_extends_setting_update($board_meta, $board_id){
		$board_meta->pc_row					 = isset($_POST['pc_row'])					? sanitize_textarea_field($_POST['pc_row'])					 : '';
		$board_meta->mobile_row				 = isset($_POST['mobile_row'])				? sanitize_textarea_field($_POST['mobile_row'])				 : '';
		$board_meta->latest_row				 = isset($_POST['latest_row'])				? sanitize_textarea_field($_POST['latest_row'])				 : '';
	}
}

add_filter('kboard_skin_fields', 'kboard_hwaikeul_gallery_skin_fields', 10, 2);
if(!function_exists('kboard_hwaikeul_gallery_skin_fields')){
	function kboard_hwaikeul_gallery_skin_fields($fields, $board){
		if($board->skin == 'hwaikeul-gallery'){
			if(isset($fields['media']) && !$fields['media']['description']){
				$fields['media']['description'] = '※ 미디어 추가로 업로드한 이미지는 갤러리에 표시됩니다.';
			}
		}
		
		return $fields;
	}
}

if(!function_exists('kboard_hwaikeul_gallery_list')){
	function kboard_hwaikeul_gallery_list($board, $is_latest=false){
		$classes = array();
		
		if($is_latest){
			if(!wp_is_mobile() && $board->meta->latest_row){
				$classes[] = "hwaikeul-gallery-row-{$board->meta->latest_row}";
			}
		}
		else{
			if(!wp_is_mobile() && $board->meta->pc_row){
				$classes[] = "hwaikeul-gallery-row-{$board->meta->pc_row}";
			}
			if(wp_is_mobile() && $board->meta->mobile_row){
				$classes[] = "hwaikeul-gallery-row-{$board->meta->mobile_row}";
			}
		}
		
		$classes = implode(' ', $classes);
		
		return $classes;
	}
}