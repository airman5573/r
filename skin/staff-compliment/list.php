<div id="kboard-qna-list">
	
	<!-- 카테고리 시작 -->
	<?php
		if($board->use_category == 'yes'){
			if($board->isTreeCategoryActive()){
				$category_type = 'default';
			}
			else{
				$category_type = 'default';
			}
			$category_type = apply_filters('kboard_skin_category_type', $category_type, $board, $boardBuilder);
			echo $skin->load($board->skin, "list-category-{$category_type}.php", $vars);
		}
		?>
	<!-- 카테고리 끝 -->
	<!-- 게시판 정보 시작 -->
	<div class="kboard-list-header">
		<!-- <div class="kboard-left">
			<?php if($board->isWriter()):?>
				<a href="<?php echo $url->getContentEditor()?>" class="kboard-qna-button-small dalia-btn-01"><?php echo __('New', 'kboard')?></a>
			<?php endif?>
		</div> -->
		
		<div class="kboard-right">
			
		</div>
	</div>
	<div class="kboard-list-top flex-item space-between">
		<div class="kboard-total-count">
			<?php echo __('전체', 'kboard')?> <span class="text-mint"><?php echo number_format($board->getListTotal())?></span>
		</div>
		<!-- 지점선택 더미 -->
		<div class="kboard-attr-row flex-item">
			<label class="attr-name" for="select-branch"><span class="field-name">지점</span></label>
			<div class="attr-value flex-item flex-start">
				<div class="half">
					<select id="select-area" name="mainCategory" class=" tabindex="-1" aria-hidden="true">
						<option value="">지역선택</option>
					</select>
				</div>
				<div class="half">
					<select id="select-branch" name="subCategory" class=" tabindex="-1" aria-hidden="true">
						<option value="">지점선택</option>
					</select>
				</div>

			</div>
		</div>
	</div>
	<!-- 게시판 정보 끝 -->
	
	<!-- 리스트 시작 -->
	<?php
	if($board->initCategory2()){
		$status_list = $board->category;
	}
	else{
		$status_list = kboard_ask_status();
	}
	?>
	<div class="kboard-list">
		<table>
			<thead>
				<tr>
					<td class="kboard-list-uid"><?php echo __('Number', 'kboard')?></td>
<!-- 					
					<?php if($board->use_category == 'yes' && $board->initCategory1()):?>
						<td class="kboard-list-category"><?php echo __('Category', 'kboard')?></td>
					<?php endif?> -->
					
					<td class="kboard-list-title"><?php echo __('Title', 'kboard')?></td>
					<td class="kboard-list-status"><?php echo __('Status', 'kboard')?></td>
					<td class="kboard-list-user"><?php echo __('Author', 'kboard')?></td>
					<td class="kboard-list-date"><?php echo __('Date', 'kboard')?></td>
					<td class="kboard-list-vote"><?php echo __('Votes', 'kboard')?></td>
					<td class="kboard-list-view"><?php echo __('Views', 'kboard')?></td>
				</tr>
			</thead>
			<tbody>
				<?php while($content = $list->hasNextNotice()):?>
				<tr class="kboard-list-notice<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>" onClick="location.href='<?php echo $url->getDocumentURLWithUID($content->uid)?>'">
					<td class="kboard-list-uid"><span class="notice-tag">공지</span></td>
					
					<!-- <?php if($board->use_category == 'yes' && $board->initCategory1()):?>
						<td class="kboard-list-category"><?php echo $content->category1?></td>
					<?php endif?> -->
					
					<td class="kboard-list-title">
					
							<?php if($content->category2):?>
								<div class="kboard-mobile-status">
									<span class="kboard-staff-compliment-status status-<?php echo array_search($content->category2, $status_list)?>"><?php echo $content->category2?></span>
								</div>
							<?php endif?>
							<div class="kboard-staff-compliment-cut-strings">
								<?php if($content->secret):?><i class="xi-lock kboard-icon-lock"></i><?php endif?>
								
								<?php if($board->use_category == 'yes' && $board->initCategory1()):?>
									<span class="kboard-mobile-category"><?php if($content->category1):?>[<?php echo $content->category1?>]<?php endif?></span>
								<?php endif?>
								
								<?php echo $content->title?>
								<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
								<?php if($content->isNew()):?><span class="kboard-hwaikeul-video-slider-new-notify new-mark">N</span><?php endif?>
							</div>
							<div class="kboard-mobile-contents">
								<span class="contents-item kboard-user"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?></span>
								<span class="contents-separator kboard-date">|</span>
								<span class="contents-item kboard-date"><?php echo $content->getDate()?></span>
							</div>
				
					</td>
					<td class="kboard-list-status">
						<?php if($content->category2):?>
							<!-- <span class="kboard-qna-status status-<?php echo array_search($content->category2, $status_list)?>"><?php echo $content->category2?></span> -->
						<?php endif?>
					</td>
					<td class="kboard-list-user">
						<!-- <?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?> -->
					</td>
					<td class="kboard-list-date"><?php echo $content->getDate()?></td>
					<td class="kboard-list-vote"><?php echo $content->vote?></td>
					<td class="kboard-list-view"><?php echo $content->view?></td>
				</tr>
				<?php endwhile?>
				<?php while($content = $list->hasNext()):?>
				<tr class="<?php if($content->uid == kboard_uid()):?>kboard-list-selected<?php endif?>" onClick="location.href='<?php echo $url->getDocumentURLWithUID($content->uid)?>'">
					<td class="kboard-list-uid"><?php echo $list->index()?></td>
					<!-- <?php if($board->use_category == 'yes' && $board->initCategory1()):?>
						<td class="kboard-list-category"><?php echo $content->category1?></td>
					<?php endif?> -->
					<td class="kboard-list-title">
							<?php if($content->category2):?>
								<div class="kboard-mobile-status">
									<span class="kboard-staff-compliment-status status-<?php echo array_search($content->category2, $status_list)?>"><?php echo $content->category2?></span>
								</div>
							<?php endif?>
							<div class="kboard-staff-compliment-cut-strings">
								<span class="category-bullet">광교중앙점</span>
								<?php if($content->secret):?><i class="xi-lock kboard-icon-lock"></i><?php endif?>
								
								<?php if($board->use_category == 'yes' && $board->initCategory1()):?>
									<span class="kboard-mobile-category"><?php if($content->category1):?>[<?php echo $content->category1?>]<?php endif?></span>
								<?php endif?>
								
								<?php echo $content->title?>
								<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
								<?php if($content->isNew()):?><span class="new-mark">N</span><?php endif?>
							</div>
							<div class="kboard-mobile-contents">
								<span class="contents-item kboard-user"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?></span>
								<span class="contents-separator kboard-date">|</span>
								<span class="contents-item kboard-date"><?php echo $content->getDate()?></span>
							</div>
					</td>
					<td class="kboard-list-status">
						<?php if($content->category2):?>
							<span class="kboard-staff-compliment-status status-<?php echo array_search($content->category2, $status_list)?>"><?php echo $content->category2?></span>
						<?php endif?>
					</td>
					<td class="kboard-list-user"><?php echo apply_filters('kboard_user_display', $content->getUserName(), $content->getUserID(), $content->getUserName(), 'kboard', $boardBuilder)?></td>
					<td class="kboard-list-date"><?php echo $content->getDate()?></td>
					<td class="kboard-list-vote"><?php echo $content->vote?></td>
					<td class="kboard-list-view"><?php echo $content->view?></td>
				</tr>
				<!-- <?php $boardBuilder->builderReply($content->uid)?> -->
				<?php endwhile?>
			</tbody>
		</table>
	</div>
	<!-- 리스트 끝 -->
	
	<!-- 페이징 시작 -->
	<div class="kboard-pagination">
		<ul class="kboard-pagination-pages">
			<?php echo kboard_pagination($list->page, $list->total, $list->rpp)?>
		</ul>
	</div>
	<!-- 페이징 끝 -->
	
	<!-- 검색폼 시작 -->
	<div class="kboard-search">
		<form id="kboard-search-form-<?php echo $board->id?>" method="get" action="<?php echo $url->toString()?>">
			<?php echo $url->set('pageid', '1')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
			
			<select name="target">
				<option value=""><?php echo __('All', 'kboard')?></option>
				<option value="title"<?php if(kboard_target() == 'title'):?> selected="selected"<?php endif?>><?php echo __('Title', 'kboard')?></option>
				<option value="content"<?php if(kboard_target() == 'content'):?> selected="selected"<?php endif?>><?php echo __('Content', 'kboard')?></option>
				<option value="member_display"<?php if(kboard_target() == 'member_display'):?> selected="selected"<?php endif?>><?php echo __('Author', 'kboard')?></option>
			</select>
			<input type="text" name="keyword" value="<?php echo kboard_keyword()?>">
			<button type="submit" class="kboard-qna-button-search dalia-btn-01" title="<?php echo __('Search', 'kboard')?>">검색</button>
		</form>
	</div>
	<!-- 검색폼 끝 -->
	
	<?php if($board->isWriter()):?>
	<div class="kboard-control flex-end">
		<?php if($board->isWriter()):?>
					<a href="<?php echo $url->getContentEditor()?>" class="kboard-qna-button-small dalia-btn-01"><?php echo __('New', 'kboard')?></a>
				<?php endif?>
		</div>
	<?php endif?>
	
	<?php if($board->contribution()):?>
	<div class="kboard-qna-poweredby">
		<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>"></a>
	</div>
	<?php endif?>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
		
		//Main 카테고리를 선택 할때 마다 AJAX를 호출할 수 있지만 DB접속을 매번 해야 하기 때문에 main, sub카테고리 전체을 들고온다.
		
		//****************이부분은 DB로 셋팅하세요.
		//Main 카테고리 셋팅 (DB에서 값을 가져와 셋팅 하세요.)
		var mainCategoryArray = new Array();
		var mainCategoryObject = new Object();
		
		mainCategoryObject = new Object();
		mainCategoryObject.main_category_id = "1";
		mainCategoryObject.main_category_name = "서울특별시";
		mainCategoryArray.push(mainCategoryObject);
		
		mainCategoryObject = new Object();
		mainCategoryObject.main_category_id = "2";
		mainCategoryObject.main_category_name = "경기도";
		mainCategoryArray.push(mainCategoryObject);
		
		//Sub 카테고리 셋팅 (DB에서 값을 가져와 셋팅 하세요.)
		var subCategoryArray = new Array();
		var subCategoryObject = new Object();
		
		//스포츠에 해당하는 sub category 리스트
		subCategoryObject = new Object();
		subCategoryObject.main_category_id = "1";
		subCategoryObject.sub_category_id = "1"
		subCategoryObject.sub_category_name = "건대입구점"    
		subCategoryArray.push(subCategoryObject);
		
		subCategoryObject = new Object();
		subCategoryObject.main_category_id = "1";
		subCategoryObject.sub_category_id = "2"
		subCategoryObject.sub_category_name = "반포점"    
		subCategoryArray.push(subCategoryObject);
		
		subCategoryObject = new Object();
		subCategoryObject.main_category_id = "1";
		subCategoryObject.sub_category_id = "3"
		subCategoryObject.sub_category_name = "상암점"    
		subCategoryArray.push(subCategoryObject);
		
		//공연에 해당하는 sub category 리스트
		subCategoryObject = new Object();
		subCategoryObject.main_category_id = "2";
		subCategoryObject.sub_category_id = "1"
		subCategoryObject.sub_category_name = "일산점"    
		subCategoryArray.push(subCategoryObject);
		
		subCategoryObject = new Object();
		subCategoryObject.main_category_id = "2";
		subCategoryObject.sub_category_id = "2"
		subCategoryObject.sub_category_name = "수원점"    
		subCategoryArray.push(subCategoryObject);
		
		//****************이부분은 DB로 셋팅하세요.
		
		
		//메인 카테고리 셋팅
		var mainCategorySelectBox = jQuery("select[name='mainCategory']");
		
		for(var i=0;i<mainCategoryArray.length;i++){
			mainCategorySelectBox.append("<option value='"+mainCategoryArray[i].main_category_id+"'>"+mainCategoryArray[i].main_category_name+"</option>");
		}
		
		//*********** 1depth카테고리 선택 후 2depth 생성 START ***********
		jQuery(document).on("change","select[name='mainCategory']",function(){
			
			//두번째 셀렉트 박스를 삭제 시킨다.
			var subCategorySelectBox = jQuery("select[name='subCategory']");
			subCategorySelectBox.children().remove(); //기존 리스트 삭제
			
			//선택한 첫번째 박스의 값을 가져와 일치하는 값을 두번째 셀렉트 박스에 넣는다.
			jQuery("option:selected", this).each(function(){
				var selectValue = jQuery(this).val(); //main category 에서 선택한 값
				subCategorySelectBox.append("<option value=''>전체</option>");
				for(var i=0;i<subCategoryArray.length;i++){
					if(selectValue == subCategoryArray[i].main_category_id){
						
						subCategorySelectBox.append("<option value='"+subCategoryArray[i].sub_category_id+"'>"+subCategoryArray[i].sub_category_name+"</option>");
						
					}
				}
			});
			
		});
		//*********** 1depth카테고리 선택 후 2depth 생성 END ***********
			
	}); 
</script>