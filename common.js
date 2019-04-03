$(function(){
	$('.accord .head').click(function(e){
		var
			t = $(this),
			c = t.next('.content'),
			i = t.data('accordionid'),
			a = $('#'+i);

		$('.accord')
			.children('.head')
			.not(t)
			.removeClass('open')
			.next('.content')
			.slideUp()

		t
			.toggleClass('open')
			.next('#'+i)
			.stop()
			.slideToggle();
	})
})