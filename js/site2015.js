$(document).ready(function(){
    $('a.insidelink').bind('click',function (e) {
	    e.preventDefault();

	    var target = this.hash,
	    $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing', function () {
	        window.location.hash = target;
	    });
	});
	
	var bttoffset = 220;
    var bttduration = 500;
    $(window).scroll(function() {
        if ($(this).scrollTop() > bttoffset) {
            $('#backtotop').fadeIn(bttduration);
        } else {
            $('#backtotop').fadeOut(bttduration);
        }
    });
    
    $('#backtotop').click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, bttduration);
        return false;
    });
    $("#loader").fadeOut("slow");
    $('#currencySelector').change(function(){
        $("#loader").fadeIn('fast');
    });
});
