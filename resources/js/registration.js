$(document).ready(function(){
    $("#errorwarning").hide();
    var username = $("#username").val();
    var password = $("#password").val();
    var confirm_password = $("#password-confirm").val();
    var email = $("#email").val();
    $("#previousbtn").hide();
    $("#submitbtn").hide();
    $(".form-section2").hide();

    // $("#nextbtn").on("click", function(){
    //     if((username == "" || email == "" || password == "" || confirm_password == "") || password != confirm_password){

    //     }
    //     else{
    //         $(".form-section1").hide();
    //         $(".form-section2").show();
    //         $("#previousbtn").show();
    //         $("#submitbtn").show();
    //         $("#nextbtn").hide();
    //     }
    // })
    var $sections = $('.form-section');
    // if((username == "" || email == "" || password == "" || confirm_password == "") || password != confirm_password){}
        function navigateTo(index){
        $sections.removeClass('current').eq(index).addClass('current');
        $('.form-navigation .previous').hide();
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
        $("#submitbtn").show();
    });

    $('.form-navigation .next').click(function(){
        if((username == "" || email == "" || password == "" || confirm_password == "") || password != confirm_password){

        }
        else{
        $(".form-navigation .previous").show();
        navigateTo(curIndex()+1);
        }
    });

    navigateTo(0);
})
