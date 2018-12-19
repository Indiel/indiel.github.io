window.index = function () {

    $( function() {
        if ($(window).width() < 650) {
            var icons = {
                header: "iconClosed",
                activeHeader: "iconOpen"
            };
            $( ".accordion" ).accordion({
                collapsible: true,
                heightStyle: "content",
                active: false,
                icons: icons
            });
        }
    });

    AOS.init({
        offset: 150,
        duration: 600,
    });

    $(function() {
        var customSelect = $('.discuss-form__service');
        
        // Options for custom Select
        jcf.setOptions('Select', {
            wrapNative: false,
            fakeDropInBody: false
        });
        
        jcf.replace(customSelect);
    });

    jQuery(document).ready(function(){
        $(window).scroll(function(e){
            parallaxScroll();
        });
            
        function parallaxScroll(){
            var scrolled = $(window).scrollTop();
            $('#working-page__parallax-bottom').css('top',(-150+(scrolled*.3))+'px');
            $('#working-page__parallax-top').css('top',(-400+(scrolled*.3))+'px');

            $('#seo__parallax-bottom').css('top',(-600+(scrolled*.3))+'px');
            $('#seo__parallax-top').css('top',(-850+(scrolled*.3))+'px');
        }
        
    });

};