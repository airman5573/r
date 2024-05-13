<div id="kboard-staff-compliment-editor">
	<form class="kboard-form" method="post" action="<?php echo $url->getContentEditorExecute()?>" enctype="multipart/form-data" onsubmit="return kboard_editor_execute(this);">
		<?php $skin->editorHeader($content, $board)?>
		<!-- 지점선택 더미 -->
		<div class="kboard-attr-row">
			<label class="attr-name" for="select-branch"><span class="field-name">지점선택</span></label>
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

		<!-- 지점선택 더미 -->
		<?php foreach($board->fields()->getSkinFields() as $key=>$field):?>
			<?php echo $board->fields()->getTemplate($field, $content, $boardBuilder)?>
		<?php endforeach?>
		
		<div class="kboard-control">
			<div class="left">
				<?php if($content->uid):?>
				<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>" class="kboard-staff-compliment-button-small dalia-btn-01"><?php echo __('Back', 'kboard')?></a>
				<a href="<?php echo $url->getBoardList()?>" class="kboard-staff-compliment-button-small dalia-btn-01"><?php echo __('List', 'kboard')?></a>
				<?php else:?>
				<a href="<?php echo $url->getBoardList()?>" class="kboard-staff-compliment-button-small dalia-btn-01"><?php echo __('Back', 'kboard')?></a>
				<?php endif?>
			</div>
			<div class="right">
				<?php if($board->isWriter()):?>
				<button type="submit" class="kboard-staff-compliment-button-small dalia-btn-01"><?php echo __('Save', 'kboard')?></button>
				<?php endif?>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript" src="<?php echo $skin_path?>/script.js?<?php echo KBOARD_VERSION?>"></script>
<script>
jQuery(document).ready(function(){
	var auto_secret_check = false;
	var document_uid = <?php echo intval($content->uid)?>;
	if(auto_secret_check && !document_uid){
		jQuery('input[name=secret]').prop('checked', true);
		kboard_toggle_password_field(jQuery('input[name=secret]'));
	}
});
</script>
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