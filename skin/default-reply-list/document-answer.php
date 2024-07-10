<?php
$answer_content = $content;
$question_content = new KBContent($answer_content->board_id);
$question_content = $question_content->initWithUID($answer_content->parent_uid);
?>

<div id="kboard-document">
	<div id="kboard-default-reply-list-document" class="kboard-reply-document">
		<div class="kboard-document-wrap" itemscope itemtype="http://schema.org/Article">
            <div class="document-header">
                <div class="document-header-top">
                    <div class="kboard-detail">
                        <?php dalia_print_branch_term_name($question_content); ?>

                        <?php dalia_print_care_program_term_name($question_content); ?>

                        <?php if($question_content->category1):?>
                        <div class="detail-attr detail-category1">
                            <div class="detail-name"><?php echo esc_html($question_content->category1)?></div>
                        </div>
                        <?php endif?>
                        <?php if($question_content->category2):?>
                        <div class="detail-attr detail-category2">
                            <div class="detail-name"><?php echo esc_html($question_content->category2)?></div>
                        </div>
                        <?php endif?>
                        <?php if($question_content->category3):?>
                        <div class="detail-attr detail-category3">
                            <div class="detail-name"><?php echo esc_html($question_content->category3)?></div>
                        </div>
                        <?php endif?>
                        <?php if($question_content->category4):?>
                        <div class="detail-attr detail-category4">
                            <div class="detail-name"><?php echo esc_html($question_content->category4)?></div>
                        </div>
                        <?php endif?>
                        <?php if($question_content->category5):?>
                        <div class="detail-attr detail-category5">
                            <div class="detail-name"><?php echo esc_html($question_content->category5)?></div>
                        </div>
                        <?php endif?>
                        <?php if($question_content->option->tree_category_1):?>
                        <?php for($i=1; $i<=$question_content->getTreeCategoryDepth(); $i++):?>
                        <div class="detail-attr detail-tree-category-<?php echo $i?>">
                            <div class="detail-name"><?php echo esc_html($question_content->option->{'tree_category_'.$i})?></div>
                        </div>
                        <?php endfor?>
                        <?php endif?>
                        <?php dalia_print_notice_tag($question_content); ?>
                        <!-- <div class="detail-attr detail-writer">
                            <div class="detail-name"><?php echo __('Author', 'kboard')?></div>
                            <div class="detail-value"><?php echo $question_content->getUserDisplay()?></div>
                        </div> -->
                        <div class="detail-attr detail-date">
                            <!-- <div class="detail-name"><?php echo __('Date', 'kboard')?></div> -->
                            <div class="detail-value"><?php echo date('Y-m-d H:i', strtotime($question_content->date))?></div>
                        </div>
                        <!-- <div class="detail-attr detail-view">
                            <div class="detail-name"><?php echo __('Views', 'kboard')?></div>
                            <div class="detail-value"><?php echo $question_content->view?></div>
                        </div> -->
                        <?php if($question_content->isNew()):?><span class="kboard-hwaikeul-video-slider-new-notify new-mark">N</span><?php endif?>
                    </div>
                </div>
                <div class="document-header-middle">
                    <div class="kboard-title" itemprop="name">
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
                        
                    <?php elseif($question_content->category2):?>
                        <span class="kboard-qna-status status-<?php echo array_search($question_content->category2, $board->category)?>"><?php echo $question_content->category2?></span>
                    <?php endif?>
                    <div class="detail-attr">
                        <div class="detail-name">작성자 :</div>
                        <div class="detail-value"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder); ?></div>
                    </div>
                    <div class="detail-attr">
                        <div class="detail-name">이메일 :</div>
                        <div class="detail-value"><?php echo $content->option->{'email'}; ?></div>
                    </div>
                    <div class="detail-attr detail-view">
                        <div class="detail-name"><?php echo __('Views', 'kboard')?></div>
                        <div class="detail-value"><?php echo $question_content->view?></div>
                    </div>
                    <div class="detail-attr">
                        <div class="detail-name">IP :</div>
                        <div class="detail-value"><?php echo $question_content->option->ip?></div>
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
                <?php if(!$board->meta->permission_vote_hide):?>
                    <div class="left">
                        <button type="button" class="kboard-button-action kboard-button-like" onclick="kboard_document_like(this)" data-uid="<?php echo $question_content->uid?>" title="<?php echo __('Like', 'kboard')?>"><?php echo __('Like', 'kboard')?> <span class="kboard-document-like-count"><?php echo intval($question_content->like)?></span></button>
                        <button type="button" class="kboard-button-action kboard-button-unlike" onclick="kboard_document_unlike(this)" data-uid="<?php echo $question_content->uid?>" title="<?php echo __('Unlike', 'kboard')?>"><?php echo __('Unlike', 'kboard')?> <span class="kboard-document-unlike-count"><?php echo intval($question_content->unlike)?></span></button>
                    </div>
                <?php endif?>
                <div class="right">
                    <button type="button" class="kboard-button-action kboard-button-print" onclick="kboard_document_print('<?php echo $url->getDocumentPrint($question_content->uid)?>')" title="<?php echo __('Print', 'kboard')?>"><?php echo __('Print', 'kboard')?></button>
                </div>
            </div>
            
            <?php if($question_content->isAttached()):?>
            <div class="kboard-attach">
                <?php foreach($question_content->getAttachmentList() as $key=>$attach):?>
                <button type="button" class="kboard-button-action kboard-button-download" onclick="window.location.href='<?php echo $url->getDownloadURLWithAttach($question_content->uid, $key)?>'" title="<?php echo sprintf(__('Download %s', 'kboard'), $attach[1])?>"><?php echo $attach[1]?></button>
                <?php endforeach?>
            </div>
            <?php endif?>
		</div>

		<?php if($question_content->visibleComments()):?>
		<div class="kboard-comments-area"><?php echo $board->buildComment($question_content->uid)?></div>
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
                <a href="<?php echo esc_url($url->getBoardList())?>" class="kboard-default-reply-list-button-small dalia-btn-01"><?php echo __('List', 'kboard')?></a>
            </div>
            <?php if($answer_content->isEditor() || $board->permission_write=='all'):?>
            <div class="right">
                <a href="<?php echo esc_url($url->getContentEditor($answer_content->uid))?>" class="kboard-default-reply-list-button-small dalia-btn-01"><?php echo '답글수정'; ?></a>
                <a href="<?php echo esc_url($url->getContentRemove($answer_content->uid))?>" class="kboard-default-reply-list-button-small dalia-btn-01" onclick="return confirm('<?php echo __('Are you sure you want to delete?', 'kboard')?>');"><?php echo __('Delete', 'kboard')?></a>
            </div>
            <?php endif?>
        </div>
	</div>
</div>