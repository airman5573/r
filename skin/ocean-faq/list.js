function kboard_faq_view_answer(index){
    var $faqItem = jQuery('.kboard-faq-item[data-index="'+index+'"]');
    var isActive = $faqItem.hasClass('answer-open');

    // 모든 FAQ 아이템에서 answer-open 클래스 제거
    jQuery('.kboard-faq-item').removeClass('answer-open');
    
    // 클릭된 FAQ 아이템에 대해 answer-open 클래스를 toggle
    if (!isActive) {
        $faqItem.addClass('answer-open');
    }
}