<?php
if(!defined('ABSPATH')) exit;

global $ocean_faq_skin_dir_name;
$ocean_faq_skin_dir_name = basename(dirname(__FILE__));

if(!function_exists('kboard_ocean_faq_content')){
	function kboard_ocean_faq_content($board, $boardBuilder, $content){
		$mod = kboard_builder_mod();
		
		if(!$mod || $mod == 'list'){
			// 에디터를 사용하지 않고, autolink가 활성화면 자동으로 link를 생성한다.
			if(!$board->use_editor && $boardBuilder->meta->autolink){
				include_once KBOARD_DIR_PATH . '/helper/Autolink.helper.php';
				
				// 댓글 내용에 자동으로 link를 생성한다.
				add_filter('kboard_comments_content', 'kboard_autolink', 10, 1);
				
				$content->content = apply_filters('kboard_content_paragraph_breaks', kboard_autolink($content->getContent()), $boardBuilder);
			}
			else{
				// 유튜브, 비메오 동영상 URL을 iframe 코드로 변환한다.
				add_filter('kboard_content', 'kboard_video_url_to_iframe', 10, 1);
				add_filter('kboard_comments_content', 'kboard_video_url_to_iframe', 10, 1);
				$content->content = apply_filters('kboard_content_paragraph_breaks', $content->getContent(), $boardBuilder);
			}
			
			// kboard_content 필터 실행
			$content->content = apply_filters('kboard_content', $content->getContent(), $content->uid, $boardBuilder->board_id);
			
			// 게시글 숏코드(Shortcode) 실행
			if($boardBuilder->meta->shortcode_execute == 1){
				$content->content = do_shortcode($content->getContent());
			}
			else{
				$content->content = str_replace('[', '&#91;', $content->getContent());
				$content->content = str_replace(']', '&#93;', $content->getContent());
			}
		}
		
		return $content->content;
	}
}
add_action("kboard_{$ocean_faq_skin_dir_name}_extends_setting", 'kboard_ocean_faq_count_extends_setting', 10, 3);
if(!function_exists('kboard_ocean_faq_count_extends_setting')){
	function kboard_ocean_faq_count_extends_setting($html, $meta, $board_id){
		if(!is_user_logged_in()){
			return false;
		}
		ob_start();
		?>
		<h3>KBoard 오션 FAQ 스킨 설정</h3>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="ocean_faq_count">조회수 보이기</label></th>
					<td>
						<select name="ocean_faq_count" id="ocean_faq_count">
							<option value="">비활성화</option>
							<option value="1"<?php if($meta->ocean_faq_count):?> selected<?php endif?>>활성화</option>
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

add_action("kboard_{$ocean_faq_skin_dir_name}_extends_setting_update", 'kboard_ocean_faq_count_extends_setting_update', 10, 2);
function kboard_ocean_faq_count_extends_setting_update($meta, $board_id){
	$meta->ocean_faq_count = isset($_POST['ocean_faq_count']) ? $_POST['ocean_faq_count'] : '';
}