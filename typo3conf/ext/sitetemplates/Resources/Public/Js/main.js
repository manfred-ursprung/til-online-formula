/**
 * Created by manfred on 27.02.15.
 */

/* Toggle Login Formular */
$(document).ready(function(){

/*    $('[data-toggle="login"]').on('click', function(){
        var loginForm = document.forms['felogin'];

        IsbFrontendLoginFormRsaEncryption.prepareForm(loginForm, TYPO3FrontendLoginFormRsaEncryptionPublicKeyUrl);
        $('#loginDialog').modal('toggle');
    });
    $('#felogin').on('submit', function(event){
        var loginForm = document.forms['felogin'];
        event.preventDefault();
        var result = IsbFrontendLoginFormRsaEncryption.encryptPassword(loginForm);

        //$('#loginDialog').modal('toggle');
        return result
    })

*/
    //hide searchbox
    $('#searchform').toggle();
    $('#searchform-link').on('click', function(){
        $('#searchform').toggle();
    });

    // Home Slideshow
    if ($('#head-slider').find('li').length > 1) {

        var $document = $(document);
        var $window = $(window);
        var slides = $('#head-slider');

        setTimeout(function(){
            $window.trigger('resize');
        }, 100);

        slides.superslides({
            inherit_height_from: '#head-slider',
            play: 10000,
            slide_speed: 800,
            pagination: true,
            fit_landscape: 1
        });
        /*
         $document.on('animated.slides', function() {
         $window.trigger('resize');
         console.log('updated');
         });
         */
    }

    var options = {
        $FillMode: 2,
        $AutoPlay: true,
        $AutoPlayInterval: 4000,
        $PauseOnHover: 1,
        $ArrowKeyNavigation: false,
        //$SlideEasing: $JssorEasing$.$EaseOutQuint,
        $SlideDuration: 800,
        $MinDragOffsetToSlide: 20,
        $SlideSpacing: 0,
        $DisplayPieces: 1,
        $ParkingPosition: 0,
        $UISearchMode: 1,
        $PlayOrientation: 1,
        $DragOrientation: 1,
    };
    if($('#slider1_contaner').length > 0) {
        $("#slider1_container").css("display", "block");
        var jssor_slider1 = new $JssorSlider$("slider1_container", options);
    }

    var flattenHeaderAtY = 20;
    $(window).scroll(function(event){
        if($(window).scrollTop() > flattenHeaderAtY) {
            if(!$('.navbar .nav').hasClass('scrolled')){
                $('.navbar .nav').addClass('scrolled');
                $('.navbar .navbar-header').addClass('scrolled');
            }
        } else {
            $('.navbar .nav').removeClass('scrolled');
            $('.navbar .navbar-header').removeClass('scrolled');
        }
    })
});
/*
("click.bs.modal.data-api", '[data-toggle="modal"]', function (c) {
    var d = a(this), e = d.attr("href"), f = a(d.attr("data-target") || e && e.replace(/.*(?=#[^\s]+$)/, "")), g = f.data("bs.modal") ? "toggle" : a.extend({remote: !/#/.test(e) && e}, f.data(), d.data());
    d.is("a") && c.preventDefault(), f.one("show.bs.modal", function (a) {
        a.isDefaultPrevented() || f.one("hidden.bs.modal", function () {
            d.is(":visible") && d.trigger("focus")
        })
    }), b.call(f, g, this)
})
}
*/