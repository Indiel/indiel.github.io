function initPreloader() {
    setTimeout(function() {
        $('#preloader').fadeOut('slow', function() {});
    }, 2000);
} 

$(document).ready(function(){
    initPreloader();
    sliderRemove();
});

   


function initParallax() {
	var scene = document.querySelector('.parallax-bg');
	var parallaxInstance = new Parallax(scene, {    
		relativeInput: true,
	});
}
initParallax();

function sliderRemove(){
    if ($(window).width() > 768){
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

        $('.slick-active').addClass('slider-line-bottom');

        window.addEventListener('wheel', function(e) {
            if (e.target.classList.contains('text-block')){
                e.stopPropagation;
                return false;
            }
            if (e.deltaY < 0) {
                $('.slide').slick('slickPrev');

                $('.slick-active').addClass('slider-line-top');
            }
            if (e.deltaY > 0) {
                $('.slide').slick('slickNext');

                $('.slick-active').addClass('slider-line-bottom');

                $('.slick-active').prev('li').addClass('none-active-slider-line-bottom');
            }
        });
        $('.arrow').on('click', function(){
            $('.slide').slick('slickNext');
        });

        $('#main').on('click', function(){
            $('.slide').slick('slickGoTo', 0);
        });
        $('#services').on('click', function(){
            $('.slide').slick('slickGoTo', 1);
        });
        $('#contacts').on('click', function(){
            $('.slide').slick('slickGoTo', 2);
        });
    }
}

$(window).resize(function(){
    sliderRemove(); 
})

$(document).ready(function(){
    $(".main-nav__list").on("click","a", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
    });
});
