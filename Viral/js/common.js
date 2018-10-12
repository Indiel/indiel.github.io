function initPreloader() {
    setTimeout(function() {
        $('#preloader').fadeOut('slow', function() {});
    }, 2000);
} 

$(document).ready(function(){
    initPreloader();
});

const slider = $(".slide");
slider.slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    fade: true,
    verticalSwiping: true
});

slider.on('wheel', (function(e) {
    e.preventDefault();

    if (e.originalEvent.deltaY < 0) {
        $(this).slick('slickPrev');
    } else {
        $(this).slick('slickNext');
    }
}));


function initParallax() {
	var scene = document.querySelector('#parallax-bg');
	var parallaxInstance = new Parallax(scene, {
		relativeInput: true,
	});
}
initParallax();