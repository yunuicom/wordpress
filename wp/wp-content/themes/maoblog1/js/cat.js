$(document).ready(function(){
	$('.input-group-addon').click(function(){
		$('form').submit();
	});
});

//内容页导航
$(function(){
	$.fn.scrollToTop2=function(){
		var scrollDiv2=$(this);
		$(window).scroll(function(){
			if($(window).scrollTop()<"900"){
				$(scrollDiv2).removeClass("navbar-fixed-top")
			}else{
				$(scrollDiv2).addClass("navbar-fixed-top")
			}
		});
	}
});
$(function() {
	$("#navbar-spy").scrollToTop2();
});

//平滑滚动到锚点
$("a#gotop").click(function() {
        var gotop = $($(this).attr("href")).offset().top-80;
        $("html, body").animate({
            scrollTop: gotop + "px"
        }, {
            duration: 500,
            easing: "swing"
        });
        return false;
    });
    
function imgset() {
	$('.img-div').each(function() {
        var width = $(this).width();
        var height = $(this).height();
        var img_width = $('img',this).width();
        var img_height = $('img',this).height();
     
        if(height > img_height){
            ratio = height / img_height;
            ratio1 = width * ratio;
            $('img',this).css("height", height);
            $('img',this).css("width", ratio1);
            ratio2 = width - ratio1;
            ratio3 = ratio2 / 2;
            $('img',this).css("margin-left", ratio3);
        }
    });
};
    
//列表图片剧中
$(window).bind("load", function() {
    imgset();
});
$('#carousel-example-generic').on('slide.bs.carousel', function () {
	imgset();
});