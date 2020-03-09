$(document).ready(function(){
    $(".block").hide()
	$(".block[id='Dashboard']").show()
	$(".navbar-user li a").click(function(event){
		event.preventDefault();
		$(this).addClass("active1").parent().siblings().find("a").removeClass("active1")
	})
	$(".navbar-user li a").click(function(){
		$(this).data("menu")
		$(".block").fadeOut(0)
		$(".block[id="+$(this).data("menu")+"]").fadeIn()
		console.log($(this).data("menu"))
	})
	$(".password-change,.eye").mouseenter(function(){
		$(".eye , .eye .show-eye").show()
		$(".hide-eye").hide()
	})
	$(".password-change,.eye").mouseleave(function(){
		$(".eye , .eye .show-eye").hide()
	})
	$(".eye , .eye .show-eye").mouseenter(function(){
		$(this).css("opacity","1")
	})
	$(".eye , .eye .show-eye").mouseleave(function(){
		$(this).css("opacity",".5")
	})
	$(".eye .show-eye").click(function(){
			$(".password-change").attr("type","text")
			$(".eye .show-eye").hide()
			$(".eye .hide-eye").show()
	})
	$(".eye .hide-eye").click(function(){
			$(".password-change").attr("type","password")
			$(".eye .show-eye").show()
			$(".eye .hide-eye").hide()
	})
	$(".password-renew,.password-new").keyup(function(){
		if ($(".password-renew").val()===$(".password-new").val()) {
			$(".error").text("The password is the same equal").css("color","green")
		}else if($(".password-renew").val()!==$(".password-new").val()){
			$(".error").text("The password is not equal").css("color","red")
		}
		if (!$(".password-renew").val()&&!$(".password-new").val()) {
				$(".error").text("")
		}
	})
	
    
})