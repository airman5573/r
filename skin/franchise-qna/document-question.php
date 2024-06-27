<?php
$is_notice = $content->notice;
$additional_class = $is_notice ? 'kboard-notice-document' : '';
?>

<div id="kboard-document">
    <div id="kboard-qna-document" class="<?php echo $additional_class; ?>">
        <div class="kboard-document-wrap" itemscope itemtype="http://schema.org/Article">
            <meta itemprop="name" content="<?php echo kboard_htmlclear(strip_tags($content->title))?>">
            <div class="document-header">
                <div class="document-header-top flex-item">
                    <?php dalia_print_notice_tag($content); ?>
                    <?php if($content->category1):?>
                        <span class="category-bullet"><?php echo $content->category1?></span>
                    <?php endif?>
                    <div class="detail-value"><?php echo date('Y-m-d H:i', strtotime($content->date))?></div>
                    <?php if($content->isNew()):?><span class="new-mark">N</span><?php endif?>
                </div>
                <div class="detail-attr detail-title document-header-middle">
                    <div class="kboard-title">
                        <h1><?php echo $content->title?></h1>
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
                                <select id="kboard-select-category2" name="category2" onchange="kboard_franchise_qna_category_update('<?php echo $content->uid?>', this.value)">
                                    <?php while($board->hasNextCategory()):?>
                                    <option value="<?php echo $board->currentCategory()?>"<?php if($content->category2 == $board->currentCategory()):?> selected<?php endif?>><?php echo $board->currentCategory()?></option>
                                    <?php endwhile?>
                                </select>
                            </div>
                        </div>
                    <?php elseif($content->category2):?>
                        <span class="kboard-franchise-qna-status status-<?php echo array_search($content->category2, $board->category)?>"><?php echo $content->category2?></span>
                    <?php endif?>
                    <div class="detail-attr">
                        <div class="detail-name">작성자 :</div>
                        <div class="detail-value"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?></div>
                    </div>
                    <div class="detail-attr">
                        <div class="detail-name">이메일 :</div>
                        <div class="detail-value"><?php echo dalia_franchise_qna_kboard_get_email($content); ?></div>
                    </div>
                    <div class="detail-attr">
                        <div class="detail-name">휴대폰번호 :</div>
                        <div class="detail-value"><?php echo dalia_franchise_qna_kboard_get_tel($content); ?></div>
                    </div>
                    <div class="detail-attr detail-view">
                        <div class="detail-name"><?php echo __('Views', 'kboard')?></div>
                        <div class="detail-value"><?php echo $content->view?></div>
                    </div>
                </div>
            </div>
            
            <div class="kboard-content" itemprop="description">
                <div class="content-view">
                    <?php echo $content->getDocumentOptionsHTML()?>
                    <?php echo $content->content?>
                </div>
                
            </div>

            <div class="kboard-document-action">
                <div class="left">
                    <button type="button" class="kboard-button-action kboard-button-like" onclick="kboard_document_like(this)" data-uid="<?php echo $content->uid?>" title="<?php echo __('Like', 'kboard')?>"><?php echo __('Like', 'kboard')?> <span class="kboard-document-like-count"><?php echo intval($content->like)?></span></button>
                    <button type="button" class="kboard-button-action kboard-button-unlike" onclick="kboard_document_unlike(this)" data-uid="<?php echo $content->uid?>" title="<?php echo __('Unlike', 'kboard')?>"><?php echo __('Unlike', 'kboard')?> <span class="kboard-document-unlike-count"><?php echo intval($content->unlike)?></span></button>
                </div>
                <div class="right">
                    <button type="button" class="kboard-button-action kboard-button-print" onclick="kboard_document_print('<?php echo $url->getDocumentPrint($content->uid)?>')" title="<?php echo __('Print', 'kboard')?>"><?php echo __('Print', 'kboard')?></button>
                </div>
            </div>

            <?php if($content->isAttached()):?>
                <div class="kboard-attach">
                    <div class="kboard-attach-title"><?php echo __('Attachment', 'kboard')?> <?php echo intval(count((array)$content->getAttachmentList()))?>개</div>
                    <?php foreach($content->getAttachmentList() as $key=>$attach):?>
                        <button type="button" class="kboard-button-action kboard-button-download" onclick="window.location.href='<?php echo $url->getDownloadURLWithAttach($content->uid, $key)?>'" title="<?php echo sprintf(__('Download %s', 'kboard'), $attach[1])?>"><?php echo $attach[1]?></button>
                    <?php endforeach?>
                </div>
            <?php endif?>

        </div>
        <?php if($content->visibleComments()):?>
            <div class="kboard-comments-area"><?php echo $board->buildComment($content->uid)?></div>
        <?php endif?>
        <div class="kboard-document-navi">
            <div class="kboard-prev-document">
                <?php
                $bottom_content_uid = $content->getPrevUID();
                if($bottom_content_uid):
                    $bottom_content = new KBContent();
                    $bottom_content->initWithUID($bottom_content_uid);
                ?>
                    <a href="<?php echo $url->getDocumentURLWithUID($bottom_content_uid)?>">
                        <span class="navi-arrow"><i class="fa fa-angle-left"></i></span>
                        <span class="navi-document-title kboard-franchise-qna-cut-strings"><?php echo $bottom_content->title?></span>
                    </a>
                <?php endif?>
            </div>
            <div class="kboard-next-document">
                <?php
                $top_content_uid = $content->getNextUID();
                if($top_content_uid):
                    $top_content = new KBContent();
                    $top_content->initWithUID($top_content_uid);
                ?>
                    <a href="<?php echo $url->getDocumentURLWithUID($top_content_uid)?>">
                    <span class="navi-document-title kboard-franchise-qna-cut-strings"><?php echo $top_content->title?></span>
                        <span class="navi-arrow"><i class="fa fa-angle-right"></i></span>
                    </a>
                <?php endif?>
            </div>
        </div>
        <div class="kboard-control">
			<div class="left">
				<a href="<?php echo $url->getBoardList()?>" class="kboard-franchise-qna-button-gray dalia-btn-01"><?php echo __('List', 'kboard')?></a>
				<?php if($board->isReply() && !$content->notice):?><a href="<?php echo $url->set('parent_uid', $content->uid)->set('mod', 'editor')->toString()?>" class="kboard-franchise-qna-button-gray dalia-btn-01"><?php echo __('Reply', 'kboard')?></a><?php endif?>
			</div>
			<?php if($content->isEditor() || $board->permission_write=='all'):?>
			<div class="right">
				<a href="<?php echo $url->getContentEditor($content->uid)?>" class="kboard-franchise-qna-button-gray dalia-btn-01"><?php echo __('Edit', 'kboard')?></a>
				<a href="<?php echo $url->getContentRemove($content->uid)?>" class="kboard-franchise-qna-button-gray dalia-btn-01" onclick="return confirm('<?php echo __('Are you sure you want to delete?', 'kboard')?>');"><?php echo __('Delete', 'kboard')?></a>
			</div>
			<?php endif?>
		</div>
    </div>
</div>
<?php wp_enqueue_script('franchise-qna-document', "{$skin_path}/document.js", array(), KBOARD_VERSION, true)?>