$(document).ready(function(){
    'use strict';
    $(".services-block").hide();
    $(".services-block[id='services1']").show();
    $(".h6-services a").click(function(event){
        event.preventDefault();
        $(this).addClass("services-active").parent().siblings().find("a").removeClass("services-active");
    });
    $(".h6-services a").click(function(event){
        $(this).data("services");
        $(".services-block").hide(0);
        $(".services-block[id="+$(this).data("services")+"]").show(0);
        // console.log($(this).data("services"));
    });
});

