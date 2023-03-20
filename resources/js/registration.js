$(function(){
    var $sections = $('.form-section');

    function navigateTo(index){
        $sections.removeClass('current').eq(index).addClass('current');
        $('.form-navigation .previous').toggle(index>0);
        var atTheEnd = index >= $sections.length - 1;
        $('.form-navigation .next').toggle(!atTheEnd);
        $('.form-navigation [type=submit]').toggle(atTheEnd);
    }

    function curIndex(){
        return $sections.index($sections.filter('.current'));
    }

    $('.form-navigation .previous').click(function(){
        navigateTo(curIndex()-1);
    });

    $('.form-navigation .next').click(function(){
        navigateTo(curIndex()+1);
    });

    navigateTo(0);
});
