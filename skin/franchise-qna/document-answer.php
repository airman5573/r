<?php
$answer_content = $content;
$question_content = new KBContent($answer_content->board_id);
$question_content = $question_content->initWithUID($answer_content->parent_uid);
?>

<div id="kboard-document">
    <div id="kboard-franchise-qna-document" class="kboard-reply-document">
        <div class="kboard-document-wrap kboard-document-wrap--question" itemscope itemtype="http://schema.org/Article">
            <meta itemprop="name" content="<?php echo kboard_htmlclear(strip_tags($question_content->title))?>">
            <div class="document-header">
                <div class="document-header-top flex-item">
                    <?php dalia_print_notice_tag($question_content); ?>
                    <?php if($question_content->category1):?>
                        <span class="category-bullet"><?php echo $question_content->category1?></span>
                    <?php endif?>
                    <div class="detail-value"><?php echo date('Y-m-d H:i', strtotime($question_content->date))?></div>
                    <?php if($question_content->isNew()):?>
                        <span class="kboard-hwaikeul-video-slider-new-notify new-mark">N</span>
                    <?php endif?>
                </div>
                <div class="detail-attr detail-title document-header-middle">
                    <div class="kboard-title">
                        <h1><?php echo $question_content->title?></h1>
                    </div>
                </div>
                <div class="kboard-detail document-header-bottom">
                    <?php
                        if(!$board->initCategory2()){
                            $board->category = kboard_ask_status();
                        }
                    ?>
                    <?php if($board->isAdmin()):?>
                        <div class="detail-attr detail-category2">
                            <div class="detail-name">
                                <select id="kboard-select-category2" name="category2" onchange="kboard_qna_category_update('<?php echo $question_content->uid?>', this.value)">
                                    <?php while($board->hasNextCategory()):?>
                                        <option value="<?php echo $board->currentCategory()?>"<?php if($question_content->category2 == $board->currentCategory()):?> selected<?php endif?>><?php echo $board->currentCategory()?></option>
                                    <?php endwhile?>
                                    <option value="">상태없음</option>
                                </select>
                            </div>
                        </div>
                    <?php elseif($question_content->category2):?>
                        <span class="kboard-qna-status status-<?php echo array_search($question_content->category2, $board->category)?>"><?php echo $question_content->category2?></span>
                    <?php endif?>
                    <div class="detail-attr">
                        <div class="detail-name">작성자 :</div>
                        <div class="detail-value"><?php echo dalia_qna_kboard_get_username($question_content, $boardBuilder); ?></div>
                    </div>
                    <div class="detail-attr admin-view">
                        <div class="detail-name">이메일 :</div>
                        <div class="detail-value"><?php echo dalia_qna_kboard_get_email($question_content); ?></div>
                    </div>
                    <div class="detail-attr admin-view">
                        <div class="detail-name">휴대폰번호 :</div>
                        <div class="detail-value"><?php echo dalia_qna_kboard_get_tel($question_content); ?></div>
                    </div>
                    <div class="detail-attr detail-view">
                        <div class="detail-name"><?php echo __('Views', 'kboard')?></div>
                        <div class="detail-value"><?php echo $question_content->view?></div>
                    </div>
                </div>
            </div>
            
            <div class="kboard-content" itemprop="description">
                <div class="content-view">
                    <?php echo $question_content->getDocumentOptionsHTML()?>
                    <?php echo $question_content->content?>
                </div>
            </div>

            <!-- 답변 - 시작 -->
            <div class="reply-content-wrap">
                <div class="reply-content-left">
                    <i class="xi-subdirectory-arrow"></i>
                </div>
                
                <div class="reply-content-right">
                    <div class="document-header">
                    
                        <div class="detail-attr detail-title document-header-middle">
                            <div class="kboard-title">
                                <h1><?php echo $answer_content->title?></h1>
                            </div>
                        </div>
                        <div class="kboard-detail document-header-bottom">
                            <?php if($answer_content->category1):?>
                                <span class="category-bullet"><?php echo $answer_content->category1?></span>
                            <?php endif?>
                            <div class="detail-attr">
                                <div class="detail-name">답변자 :</div>
                                <div class="detail-value"><?php echo dalia_qna_kboard_get_username($answer_content, $boardBuilder); ?></div>
                            </div>
                            <div class="detail-attr">
                                <div class="detail-value"><?php echo date('Y-m-d H:i', strtotime($answer_content->date))?></div>
                            </div>
                        
                            <div class="detail-attr detail-view">
                                <div class="detail-name"><?php echo __('Views', 'kboard')?></div>
                                <div class="detail-value"><?php echo $answer_content->view?></div>
                            </div>
                        </div>
                    </div>
                    <div class="kboard-content" itemprop="description">
                        <div class="content-view">
                            <?php echo $answer_content->getDocumentOptionsHTML()?>
                            <?php echo $answer_content->content?>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- 답변 - 끝 -->

            <div class="kboard-document-action">
                <div class="left">
                    <button type="button" class="kboard-button-action kboard-button-like" onclick="kboard_document_like(this)" data-uid="<?php echo $question_content->uid?>" title="<?php echo __('Like', 'kboard')?>"><?php echo __('Like', 'kboard')?> <span class="kboard-document-like-count"><?php echo intval($question_content->like)?></span></button>
                    <button type="button" class="kboard-button-action kboard-button-unlike" onclick="kboard_document_unlike(this)" data-uid="<?php echo $question_content->uid?>" title="<?php echo __('Unlike', 'kboard')?>"><?php echo __('Unlike', 'kboard')?> <span class="kboard-document-unlike-count"><?php echo intval($question_content->unlike)?></span></button>
                </div>
                <div class="right">
                    <button type="button" class="kboard-button-action kboard-button-print" onclick="kboard_document_print('<?php echo $url->getDocumentPrint($question_content->uid)?>')" title="<?php echo __('Print', 'kboard')?>"><?php echo __('Print', 'kboard')?></button>
                </div>
            </div>

            <?php if($question_content->isAttached()):?>
                <div class="kboard-attach">
                    <div class="kboard-attach-title"><?php echo __('Attachment', 'kboard')?> <?php echo intval(count((array)$question_content->getAttachmentList()))?>개</div>
                    <?php foreach($question_content->getAttachmentList() as $key=>$attach):?>
                        <button type="button" class="kboard-button-action kboard-button-download" onclick="window.location.href='<?php echo $url->getDownloadURLWithAttach($question_content->uid, $key)?>'" title="<?php echo sprintf(__('Download %s', 'kboard'), $attach[1])?>"><?php echo $attach[1]?></button>
                    <?php endforeach?>
                </div>
            <?php endif?>
        </div>

        <?php if($answer_content->visibleComments()):?>
            <div class="kboard-comments-area"><?php echo $board->buildComment($answer_content->uid)?></div>
        <?php endif?>

        <div class="kboard-document-navi">
			<div class="kboard-prev-document">
				<?php
				$prev_answer_content_uid = $answer_content->getPrevUID();
				if($prev_answer_content_uid):
				$prev_answer_content = new KBContent($answer_content->board_id);
				$prev_answer_content->initWithUID($prev_answer_content_uid);
				?>
				<a href="<?php echo esc_url($url->getDocumentURLWithUID($prev_answer_content_uid))?>" title="<?php echo esc_attr(wp_strip_all_tags($prev_answer_content->title))?>">
					<span class="navi-arrow"><i class="fa fa-angle-left"></i></span>
					<span class="navi-document-title kboard-default-reply-list-cut-strings"><?php echo wp_strip_all_tags($prev_answer_content->title)?></span>
				</a>
				<?php endif?>
			</div>
			
			<div class="kboard-next-document">
				<?php
				$next_answer_content_uid = $answer_content->getNextUID();
				if($next_answer_content_uid):
				$next_answer_content = new KBContent($answer_content->board_id);
				$next_answer_content->initWithUID($next_answer_content_uid);
				?>
				<a href="<?php echo esc_url($url->getDocumentURLWithUID($next_answer_content_uid))?>" title="<?php echo esc_attr(wp_strip_all_tags($next_answer_content->title))?>">
					<span class="navi-document-title kboard-default-reply-list-cut-strings"><?php echo wp_strip_all_tags($next_answer_content->title)?></span>
					<span class="navi-arrow"><i class="fa fa-angle-right"></i></span>
				</a>
				<?php endif?>
			</div>
		</div>

        <div class="kboard-control flex-center">
            <div class="left">
                <a href="<?php echo esc_url($url->getBoardList())?>" class="kboard-franchise-qna-button-gray dalia-btn-01"><?php echo __('List', 'kboard')?></a>
            </div>
            <?php if($answer_content->isEditor() || $board->permission_write=='all'):?>
            <div class="right">
                <a href="<?php echo esc_url($url->getContentEditor($answer_content->uid))?>" class="kboard-franchise-qna-button-gray dalia-btn-01"><?php echo '답글수정'; ?></a>
                <a href="<?php echo esc_url($url->getContentRemove($answer_content->uid))?>" class="kboard-franchise-qna-button-gray dalia-btn-01" onclick="return confirm('<?php echo __('Are you sure you want to delete?', 'kboard')?>');"><?php echo __('Delete', 'kboard')?></a>
            </div>
            <?php endif?>
        </div>

    </div>
</div>
<?php wp_enqueue_script('franchise-qna-document', "{$skin_path}/document.js", array(), KBOARD_VERSION, true)?>