<?php
$locations = dalia_get_location_with_branches();
$care_programs = dalia_get_care_programs();
$fields = $board->fields();
$parent_uid = $content->parent_uid;
$original_question_content = new KBContent($content->board_id);
$original_question_content = $original_question_content->initWithUID($parent_uid);
?>

<div id="kboard-default-reply-list-editor" class="kboard-default-reply-list-editor--answer">
    <div class="original-question">
        <div id="kboard-document">
            <div id="kboard-default-reply-list-document">
                <div class="kboard-document-wrap" itemscope itemtype="http://schema.org/Article">
                    <div class="document-header">
                        <div class="document-header-top">
                            <div class="kboard-detail">
                                <?php dalia_print_branch_term_name($original_question_content); ?>

                                <?php dalia_print_care_program_term_name($original_question_content); ?>

                                <?php if($original_question_content->category1):?>
                                <div class="detail-attr detail-category1">
                                    <div class="detail-name"><?php echo esc_html($original_question_content->category1)?></div>
                                </div>
                                <?php endif?>
                                <?php if($original_question_content->category2):?>
                                <div class="detail-attr detail-category2">
                                    <div class="detail-name"><?php echo esc_html($original_question_content->category2)?></div>
                                </div>
                                <?php endif?>
                                <?php if($original_question_content->category3):?>
                                <div class="detail-attr detail-category3">
                                    <div class="detail-name"><?php echo esc_html($original_question_content->category3)?></div>
                                </div>
                                <?php endif?>
                                <?php if($original_question_content->category4):?>
                                <div class="detail-attr detail-category4">
                                    <div class="detail-name"><?php echo esc_html($original_question_content->category4)?></div>
                                </div>
                                <?php endif?>
                                <?php if($original_question_content->category5):?>
                                <div class="detail-attr detail-category5">
                                    <div class="detail-name"><?php echo esc_html($original_question_content->category5)?></div>
                                </div>
                                <?php endif?>
                                <?php if($original_question_content->option->tree_category_1):?>
                                <?php for($i=1; $i<=$original_question_content->getTreeCategoryDepth(); $i++):?>
                                <div class="detail-attr detail-tree-category-<?php echo $i?>">
                                    <div class="detail-name"><?php echo esc_html($original_question_content->option->{'tree_category_'.$i})?></div>
                                </div>
                                <?php endfor?>
                                <?php endif?>
                                <?php dalia_print_notice_tag($original_question_content); ?>
                                <!-- <div class="detail-attr detail-writer">
                                    <div class="detail-name"><?php echo __('Author', 'kboard')?></div>
                                    <div class="detail-value"><?php echo $original_question_content->getUserDisplay()?></div>
                                </div> -->
                                <div class="detail-attr detail-date">
                                    <!-- <div class="detail-name"><?php echo __('Date', 'kboard')?></div> -->
                                    <div class="detail-value"><?php echo date('Y-m-d H:i', strtotime($original_question_content->date))?></div>
                                </div>
                                <!-- <div class="detail-attr detail-view">
                                    <div class="detail-name"><?php echo __('Views', 'kboard')?></div>
                                    <div class="detail-value"><?php echo $original_question_content->view?></div>
                                </div> -->
                                <?php if($original_question_content->isNew()):?><span class="kboard-hwaikeul-video-slider-new-notify new-mark">N</span><?php endif?>
                            </div>
                        </div>
                        <div class="document-header-middle">
                            <div class="kboard-title" itemprop="name">
                                <h1><?php echo $original_question_content->title?></h1>
                            </div>
                        </div>
                        <div class="kboard-detail document-header-bottom">
                            <?php
                                if(!$board->initCategory2()){
                                    $board->category = kboard_ask_status();
                                }
                            ?>
                            <?php if($board->isAdmin()):?>
                                
                            <?php elseif($original_question_content->category2):?>
                                <span class="kboard-qna-status status-<?php echo array_search($original_question_content->category2, $board->category)?>"><?php echo $original_question_content->category2?></span>
                            <?php endif?>
                            <div class="detail-attr">
                                <div class="detail-name">작성자 :</div>
                                <div class="detail-value"><?php echo dalia_qna_kboard_get_username($original_question_content, $boardBuilder); ?></div>
                            </div>
                            <div class="detail-attr">
                                <div class="detail-name">이메일 :</div>
                                <div class="detail-value"><?php echo dalia_qna_kboard_get_email($original_question_content); ?></div>
                            </div>
                            <div class="detail-attr detail-view">
                                <div class="detail-name"><?php echo __('Views', 'kboard')?></div>
                                <div class="detail-value"><?php echo $original_question_content->view?></div>
                            </div>
                            <div class="detail-attr">
                                <div class="detail-name">IP :</div>
                                <div class="detail-value"><?php echo $original_question_content->option->ip?></div>
                            </div>
                        </div>	
                    </div>	
                    <div class="kboard-content" itemprop="description">
                        <div class="content-view">
                            <?php echo $original_question_content->getDocumentOptionsHTML()?>
                            <?php echo $original_question_content->content?>
                        </div>
                    </div>
                    <div class="kboard-document-action">
                        <?php if(!$board->meta->permission_vote_hide):?>
                            <div class="left">
                                <button type="button" class="kboard-button-action kboard-button-like" onclick="kboard_document_like(this)" data-uid="<?php echo $original_question_content->uid?>" title="<?php echo __('Like', 'kboard')?>"><?php echo __('Like', 'kboard')?> <span class="kboard-document-like-count"><?php echo intval($original_question_content->like)?></span></button>
                                <button type="button" class="kboard-button-action kboard-button-unlike" onclick="kboard_document_unlike(this)" data-uid="<?php echo $original_question_content->uid?>" title="<?php echo __('Unlike', 'kboard')?>"><?php echo __('Unlike', 'kboard')?> <span class="kboard-document-unlike-count"><?php echo intval($original_question_content->unlike)?></span></button>
                            </div>
                        <?php endif?>
                        <div class="right">
                            <button type="button" class="kboard-button-action kboard-button-print" onclick="kboard_document_print('<?php echo $url->getDocumentPrint($original_question_content->uid)?>')" title="<?php echo __('Print', 'kboard')?>"><?php echo __('Print', 'kboard')?></button>
                        </div>
                    </div>
                    <?php if($original_question_content->isAttached()):?>
                    <div class="kboard-attach">
                        <?php foreach($original_question_content->getAttachmentList() as $key=>$attach):?>
                        <button type="button" class="kboard-button-action kboard-button-download" onclick="window.location.href='<?php echo $url->getDownloadURLWithAttach($original_question_content->uid, $key)?>'" title="<?php echo sprintf(__('Download %s', 'kboard'), $attach[1])?>"><?php echo $attach[1]?></button>
                        <?php endforeach?>
                    </div>
                    <?php endif?>
                </div>
            </div>
        </div>
    </div>

    <div class="divider" style="height: 10px; background-color: green;"></div>

	<form class="kboard-form" method="post" action="<?php echo esc_url($url->getContentEditorExecute())?>" enctype="multipart/form-data" onsubmit="return kboard_editor_execute(this);">
		<?php $skin->editorHeader($content, $board)?>
		
		<?php foreach($board->fields()->getSkinFields() as $key=>$field):?>
			<?php echo $board->fields()->getTemplate($field, $content, $boardBuilder)?>
		<?php endforeach?>
		
		<div class="kboard-control flex-center">
				<?php if($content->uid):?>
				<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>" class="kboard-default-reply-list-button-small dalia-btn-01"><?php echo __('Back', 'kboard')?></a>
				<a href="<?php echo esc_url($url->getBoardList())?>" class="kboard-default-reply-list-button-small dalia-btn-01"><?php echo __('List', 'kboard')?></a>
				<?php else:?>
				<a href="<?php echo esc_url($url->getBoardList())?>" class="kboard-default-reply-list-button-small dalia-btn-01"><?php echo __('Back', 'kboard')?></a>
				<?php endif?>
				<?php if($board->isWriter()):?>
				<button type="submit" class="kboard-default-reply-list-button-small dalia-btn-01"><?php echo __('Save', 'kboard')?></button>
				<?php endif?>
			</div>
		</div>
	</form>
</div>

<?php wp_enqueue_script('kboard-default-reply-list-script', "{$skin_path}/script.js", array(), KBOARD_VERSION, true)?>


<script>
// 관리자인 경우에 자동으로 필수 필드 삭제 및 공지사항 자동 체크
jQuery(($) => {
	const removeFieldsForAdmin = () => {
		const fieldsToRemove = [
			'input[name="kboard_option_email"]',
			'input[name="kboard_option_agree_checkbox[]"]',
			'input[name="kboard_option_tel"]',
			'input[name="kboard_option_branch"]',
			'select[name="care_program_1"]',
			'select[name="care_program_2"]',
			'select[name="care_program_3"]',
			'select[name="kboard_option_notification_method"]',
			'select[name="category1"]',
			'input[name="password"]',
		];

		fieldsToRemove.forEach(selector => {
			$(selector).closest('.kboard-attr-row').remove();
		});
	};

	// Admin-specific processing
	const isAdmin = <?= json_encode(dalia_is_admin()) ?>;
	if (isAdmin) {
		removeFieldsForAdmin();
	}
});

</script>
