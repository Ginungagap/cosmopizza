//плавный скролл на секцию

$(document).ready(function() {
		$('a[href^="#"]').click(function() {
			//Сохраняем значение атрибута href в переменной:
			var target = $(this).attr('href');
			$('html, body').animate({
				scrollTop: $(target).offset().top-33
			}, 800);
			return false;
		});
	});

$(function(){
    $(window).scroll(function(){
        if ( $(this).scrollTop() > 210 && $(".navbar").hasClass("default") ){
            $(".navbar").removeClass("default").addClass("fixed-top");

        } else if($(this).scrollTop() <= 210 && $(".navbar").hasClass("fixed-top")) {
            $(".navbar").removeClass("fixed").addClass("default");

        }
    });//scroll

});
