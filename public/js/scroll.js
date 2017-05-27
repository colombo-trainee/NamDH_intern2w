$(document).ready(function(){
	$(".button-black").on("click",function(){
		$('html, body').animate({ scrollTop: $('.cover_section_reservations').offset().top }, 1000);
	});

	$(".button-white").on("click",function(){
		$('html, body').animate({ scrollTop: $('.cover_section_menu').offset().top }, 1000);
	});
	
});