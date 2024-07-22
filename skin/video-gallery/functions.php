<?php
if(!defined('ABSPATH')) exit;

global $skin_dir_name;
$skin_dir_name = basename(dirname(__FILE__));

load_plugin_textdomain('video-gallery', false, dirname(plugin_basename(__FILE__)) . '/languages');

add_action('wp_enqueue_scripts', 'video_gallery_scripts', 999);
add_action('kboard_switch_to_blog', 'video_gallery_scripts');
if(!function_exists('video_gallery_scripts')){
	function video_gallery_scripts(){
		// 번역 등록
		$localize = array(
			'no_upload' => __('The thumbnail could not be loaded automatically. Do you want to upload the thumbnail directly?', 'video-gallery'),
			'save' => __('Save', 'kboard')
		);
		wp_localize_script('kboard-script', 'video_gallery_localize_strings', apply_filters('video_gallery_localize_strings', $localize));
	}
}

add_filter("kboard_{$skin_dir_name}_extends_setting", 'video_gallery_extends_setting', 10, 3);
if(!function_exists('video_gallery_extends_setting')){
	function video_gallery_extends_setting($html, $meta, $board_id){
		$board = new KBoard($board_id);
		$page_rpp = $board->meta->mobile_page_rpp ? $board->meta->mobile_page_rpp : '';
		
		ob_start();
		?>
		<h3>KBoard 화이클 비디오 스킨 : 기본 설정</h3>
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

add_filter("kboard_{$skin_dir_name}_extends_setting_update", 'video_gallery_extends_setting_update', 10, 2);
if(!function_exists('video_gallery_extends_setting_update')){
	function video_gallery_extends_setting_update($board_meta, $board_id){
		$board_meta->pc_row		   = isset($_POST['pc_row'])		? sanitize_textarea_field($_POST['pc_row'])		   : '';
		$board_meta->mobile_row	   = isset($_POST['mobile_row'])	? sanitize_textarea_field($_POST['mobile_row'])	   : '';
		$board_meta->latest_row	   = isset($_POST['latest_row'])	? sanitize_textarea_field($_POST['latest_row'])	   : '';
		$board_meta->pc_height	   = isset($_POST['pc_height'])		? sanitize_textarea_field($_POST['pc_height'])	   : '';
		$board_meta->mobile_height = isset($_POST['mobile_height'])	? sanitize_textarea_field($_POST['mobile_height']) : '';
		$board_meta->latest_height = isset($_POST['latest_height'])	? sanitize_textarea_field($_POST['latest_height'])	   : '';
	}
}

if(!function_exists('video_gallery_list')){
	function video_gallery_list($board, $is_latest=false){
		$classes = array();
		
		if($is_latest){
			if(!wp_is_mobile() && $board->meta->latest_row){
				$classes[] = "hwaikeul-video-row-{$board->meta->latest_row}";
			}
		}
		else{
			if(!wp_is_mobile() && $board->meta->pc_row){
				$classes[] = "hwaikeul-video-row-{$board->meta->pc_row}";
			}
			if(wp_is_mobile() && $board->meta->mobile_row){
				$classes[] = "hwaikeul-video-row-{$board->meta->mobile_row}";
			}
		}
		
		$classes = implode(' ', $classes);
		
		return $classes;
	}
}

if(!function_exists('video_gallery_url_with_uid')){
	function video_gallery_url_with_uid($content_uid){
		$content = new KBContent();
		$content->initWithUID($content_uid);
		$url = '';
		
		if($content->option->youtube_id){
			$url = "https://www.youtube.com/watch?v={$content->option->youtube_id}";
		}
		else if($content->option->vimeo_id){
			$url = "https://vimeo.com/{$content->option->vimeo_id}";
		}
		
		return $url;
	}
}

add_filter('kboard_skin_fields', 'video_gallery_skin_field', 10, 2);
if(!function_exists('video_gallery_skin_field')){
	function video_gallery_skin_field($fields, $board){
		if($board->skin == 'hwaikeul-video'){
			if(!isset($fields['youtube_id'])){
				$fields['youtube_id'] = array(
					'field_type' => 'text',
					'field_label' => __('YouTube ID', 'video-gallery'),
					'field_name' => __('YouTube ID', 'video-gallery'),
					'class' => 'kboard-attr-row kboard-attr-youtube_id',
					'hidden' => '',
					'meta_key' => 'youtube_id',
					'permission' => '',
					'roles' => array(),
					'default_value' => '',
					'placeholder' => __('YouTube Video ID', 'video-gallery'),
					'required' => '',
					'show_document' => '',
					'description' => '',
					'close_button' => 'yes'
				);
				
			}
			
			if(!isset($fields['vimeo_id'])){
				$fields['vimeo_id'] = array(
					'field_type' => 'text',
					'field_label' => __('Vimeo ID', 'video-gallery'),
					'field_name' => __('Vimeo ID', 'video-gallery'),
					'class' => 'kboard-attr-row kboard-attr-vimeo_id',
					'hidden' => '',
					'meta_key' => 'vimeo_id',
					'permission' => '',
					'roles' => array(),
					'default_value' => '',
					'placeholder' => __('Vimeo Video ID', 'video-gallery'),
					'required' => '',
					'show_document' => '',
					'description' => '',
					'close_button' => 'yes'
				);
			}
			if(!isset($fields['video_url'])){
				$fields['video_url'] = array(
					'field_type' => 'text',
					'field_label' => __('Video URL', 'video-gallery'),
					'field_name' => __('Video URL', 'video-gallery'),
					'class' => 'kboard-attr-row kboard-attr-video-url',
					'hidden' => '',
					'meta_key' => 'video_url',
					'permission' => '',
					'roles' => array(),
					'default_value' => '',
					'placeholder' => __('Video URL', 'video-gallery'),
					'required' => '',
					'show_document' => '',
					'description' => '',
					'close_button' => 'yes'
				);
			}
			if(!isset($fields['video_view'])){
				$fields['video_view'] = array(
					'field_type' => 'select',
					'field_label' => __('Screen Ratio', 'video-gallery'),
					'field_name' => __('Screen Ratio', 'video-gallery'),
					'class' => 'kboard-attr-row kboard-attr-video_view',
					'meta_key' => 'video_view',
					'row' => array(
						''=>array('label'=>__('Wide Screen (16:9)', 'video-gallery')),
						'normal'=>array('label'=>__('Standard (4:3)', 'video-gallery'))
					),
					'default_value' => '',
					'permission' => '',
					'roles' => array(),
					'description' => '',
					'required' => '',
					'show_document' => '',
					'close_button' => 'yes'
				);
			}
			if(!isset($fields['autoplay'])){
				$fields['autoplay'] = array(
					'field_type' => 'select',
					'field_label' => __('Auto Play', 'video-gallery'),
					'field_name' => __('Auto Play', 'video-gallery'),
					'class' => 'kboard-attr-row kboard-attr-autoplay',
					'meta_key' => 'autoplay',
					'row' => array(
						''=>array('label'=>'OFF'),
						'1'=>array('label'=>'ON'),
					),
					'default_value' => '',
					'permission' => '',
					'roles' => array(),
					'description' => '',
					'required' => '',
					'show_document' => '',
					'close_button' => 'yes'
				);
			}
		}
		return $fields;
	}
}

add_action('kboard_skin_field_after_youtube_id', 'video_gallery_skin_field_after_youtube_id', 10, 3);
if(!function_exists('video_gallery_skin_field_after_youtube_id')){
	function video_gallery_skin_field_after_youtube_id($field, $content, $board){
		if($board->skin == 'hwaikeul-video'){
			?>
			
			<div class="kboard-attr-row video-url-wrap">
				<div class="attr-value">
					<input type="hidden" name="kboard_option_youtube_thumbnail_url" value="<?php echo esc_url($content->option->youtube_thumbnail_url)?>">
					
				</div>
			</div>
			<?php
		}
	}
}

add_action('kboard_skin_field_after_vimeo_id', 'video_gallery_skin_field_after_vimeo_id', 10, 3);
if(!function_exists('video_gallery_skin_field_after_vimeo_id')){
	function video_gallery_skin_field_after_vimeo_id($field, $content, $board){
		if($board->skin == 'hwaikeul-video'){
			?>
			<!-- <div class="kboard-attr-row">
				<div class="attr-value">
					<input type="hidden" name="kboard_option_vimeo_thumbnail_url" value="<?php echo esc_url($content->option->vimeo_thumbnai_url)?>">
					<div class="description"><?php echo __('※ Please enter only the ID value at the end of the url.', 'video-gallery')?> (<?php echo __('ex', 'video-gallery')?>:https://vimeo.com/<span class="text-bold">237551523</span>)</div>
				</div>
			</div> -->
			<?php
		}
	}
}

add_filter('kboard_get_template_field_html', 'video_gallery_get_template_field_html', 10, 4);
if(!function_exists('video_gallery_get_template_field_html')){
	function video_gallery_get_template_field_html($field_html, $field, $content, $board){
		if($board->skin == 'hwaikeul-video'){
			$meta_key = (isset($field['meta_key']) && $field['meta_key']) ? $field['meta_key'] : '';
			$field_name = (isset($field['field_name']) && $field['field_name']) ? $field['field_name'] : $board->fields()->getFieldLabel($field);
			$required = (isset($field['required']) && $field['required']) ? 'required' : '';
			$default_value = (isset($field['default_value']) && $field['default_value']) ? $field['default_value'] : '';
			$fields = $board->fields();
			
			if($meta_key == 'video_view'){
				ob_start();
				?>
				<div class="kboard-attr-row <?php echo esc_attr($field['class'])?> meta-key-<?php echo esc_attr($meta_key)?> <?php echo esc_attr($required)?>">
					<label class="attr-name" for="<?php echo esc_attr($meta_key)?>"><span class="field-name"><?php echo esc_html($field_name)?></span><?php if($required):?> <span class="attr-required-text">*</span><?php endif?></label>
					<div class="attr-value">
						<select id="<?php echo esc_attr($meta_key)?>" name="<?php echo esc_attr($fields->getOptionFieldName($meta_key))?>"class="<?php echo esc_attr($required)?>">
							<option value=""><?php echo __('Wide Screen (16:9)', 'video-gallery')?></option>
							<option value="normal"<?php if($content->option->video_view):?> selected<?php endif?>><?php echo __('Standard (4:3)', 'video-gallery')?></option>
						</select>
						<?php if(isset($field['description']) && $field['description']):?><div class="description"><?php echo esc_html($field['description'])?></div><?php endif?>
					</div>
				</div>
				<?php
				$field_html = ob_get_clean();
				
			}
			else if($meta_key == 'autoplay'){
				ob_start();
				?>
				<div class="kboard-attr-row <?php echo esc_attr($field['class'])?> meta-key-<?php echo esc_attr($meta_key)?> <?php echo esc_attr($required)?>">
					<label class="attr-name" for="<?php echo esc_attr($meta_key)?>"><span class="field-name"><?php echo esc_html($field_name)?></span><?php if($required):?> <span class="attr-required-text">*</span><?php endif?></label>
					<div class="attr-value">
						<select id="<?php echo esc_attr($meta_key)?>" name="<?php echo esc_attr($fields->getOptionFieldName($meta_key))?>"class="<?php echo esc_attr($required)?>">
							<option value="">OFF</option>
							<option value="1"<?php if($content->option->autoplay):?> selected<?php endif?>>ON</option>
						</select>
						<div class="description autoplay-description">* 모바일 등 일부 환경에서는 적용되지 않습니다.</div>
						<!-- <?php if(isset($field['description']) && $field['description']):?><div class="description"><?php echo esc_html($field['description'])?></div><?php endif?> -->
					</div>
				</div>
				<?php
				$field_html = ob_get_clean();
				
			}
		}
		return $field_html;
	}
}

add_action('kboard_skin_field_after_autoplay', 'video_gallery_skin_field_after_autoplay', 10, 3);
if(!function_exists('video_gallery_skin_field_after_autoplay')){
	function video_gallery_skin_field_after_autoplay($field, $content, $board){
		if($board->skin == 'hwaikeul-video'){
			?>
			<!-- <div class="description"><?php echo __('※ Not applicable in all environments, such as mobile.', 'video-gallery')?></div> -->
			<?php
		}
	}
}