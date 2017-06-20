//Set carousel heights to height of smallest images
function fixCarouselHeight() {
    var photoHeights = [];

    jQuery(".item img").each(function(){
        photoHeights.push(jQuery(this).height());
    });

    photoHeights = jQuery.grep(photoHeights, function( a ) {
        return a !== 0;
    });

    jQuery(".carousel-inner").css("height", Math.min.apply(Math, photoHeights));
}



jQuery(window).load(function() {

    var scrolled = false,
        scrollHeight = jQuery(window).outerHeight(true);

    /** Home Landing Page **/

    jQuery(".landing-area").fadeOut(0).fadeIn(1500);

    //Animate .scroll-down-icon
    jQuery(".scroll-down-icon").delay(1500).fadeOut(300).fadeIn(1000).fadeOut(300).fadeIn(1000);

    jQuery(window).scroll(function(event){
        event.preventDefault();

        //Disable .landing-area resizing on mobile browsers when address bar fades.
        if(scrollHeight) {
            jQuery(".landing-area").css("height", scrollHeight);
            jQuery(".site-content").css("min-height", (scrollHeight - jQuery(".site-footer").outerHeight(true)));
            scrollheight = false;
        }

        //Slide, Fadeout animation for scrolling down past .landing-area
        if ((jQuery(".landing-area").length) && (jQuery(window).width() >= 720) && (jQuery(window).scrollTop() >= 1) && (!scrolled)) {
            jQuery("html, body").animate({
                scrollTop:  jQuery(".content-area").offset().top
            }, 800);
            jQuery(".landing-area").animate({
                opacity: 0
            }, 500)
                .delay(2000)
                .animate({
                    opacity: 1
                }, 500);
            jQuery(".main-navigation").css("opacity", 0).animate({
                opacity: 1
            }, 1500);
            scrolled = true;
        }
    });

    //Reset scroll animation when user scrolls to top of page
    jQuery(window).scroll(function(){
        if (jQuery(window).scrollTop() == 0) {
            scrolled = false;
        }
    });


    /** Navigation **/

    jQuery(".main-navigation")
        .affix({
            offset: { top: jQuery(".landing-area").outerHeight(true) }
        });
    var mainNavHeight = jQuery(".main-navigation").outerHeight(true);
    jQuery(".content-area").css("padding-top", (mainNavHeight + 25));

    /** Gallery **/

    //Initiate Masonry & Options
        jQuery('.grid').masonry({
            columnWidth: 320,
            itemSelector: '.grid-item',
            gutter: 3,
            isFitWidth: true
        }).imagesLoaded(function () {
        });

    /** Blog **/

    //Delay Carousel Image Switch
    jQuery(".carousel").carousel({
        interval: 1000 * 10
    });

    fixCarouselHeight();

    jQuery(window).on("resize orientationchange", fixCarouselHeight());

    /** Modals **/

    jQuery(".modal-photos img").on('click', function(){

        jQuery('#modal').modal({
            show: true
        });

        var imgsrc= this.src;
        jQuery("#modal-image").attr('src', imgsrc);
        jQuery("#modal-image").on("click", function(){
            jQuery("#modal").modal('hide');
        });

    });
});