jQuery(document).ready(function($){	
    //Header Search form show/hide
    var winWidth = $(window).width();
    if(winWidth > 1024){
        $('html').click(function() {
            $('.site-header .form-holder').slideUp();
        });

        $('.site-header .form-section-holder').click(function(event) {
            event.stopPropagation();
        });

        $('.site-header .form-holder').click(function(event) {
            event.stopPropagation();
        });

        $(".site-header .form-section-holder").click(function() {
            $(".site-header .form-holder").slideToggle();
            return false;
        });
    }

    if( travel_booking_pro_data.auto == '1' ){
        slider_auto = true;
    }else{
        slider_auto = false;
    }
    
    if( travel_booking_pro_data.loop == '1' ){
        slider_loop = true;
    }else{
        slider_loop = false;
    }
    
    if( travel_booking_pro_data.rtl == '1' ){
        rtl  = true;
        mrtl = false;
    }else{
        rtl  = false;
        mrtl = true;
    }
    
    // banner slider
    $('#banner-slider').owlCarousel({
        loop       : slider_loop,
        mouseDrag  : true,
        margin     : 0,
        nav        : true,
        items      : 1,
        dots       : false,
        autoplay   : slider_auto,
        navText    : '',
        rtl        : rtl,
        lazyLoad   : true,
        animateOut : travel_booking_pro_data.animation,
    });

    //testimonial slider
    $('#testimonial-carousel').owlCarousel({
        nav     : true,
        dots    : false,
        items   : 1,
        center  : true,
        loop    : true,
        rtl     : rtl,
        responsive: {
            //breakpoint from 1700 and up
            1700:{
                stagePadding: 445,
                margin: 130,
            },
            //breakpoint from 1430 and up
            1430: {
                stagePadding: 345,
                margin: 100,
            },
            //breakpoint from 1200 and up
            1025: {
                stagePadding: 230,
                margin: 100,
            },
            //breakpoint from 768 and up
            768: {
                stagePadding: 150,
                margin: 100,
            },
            //breakpoint from 0 and up
            0: {
                stagePadding: 0,
                margin: 0,
            }
        }
    });

    //prepending svg code for blockquote
    $("#primary .post .entry-content blockquote").append('<svg x="0px" y="0px"><path class="st0" d="M30.2,18.6h-2.8c0.2-2.1,0.6-3.8,1.2-5.1c0.6-1.3,1.4-2.6,2.5-3.9c1.2-1.3,2.3-2.3,3.5-3.1 c1.1-0.8,2.6-1.7,4.5-2.8L36.9,0c-1.2,0.8-2.7,1.8-4.5,3c-1.8,1.2-3.5,2.7-5.1,4.5c-1.6,1.7-2.9,3.7-4,5.8 c-1.1,2.2-1.6,4.6-1.6,7.2c0,3.7,0.7,6.8,2.2,9.1c1.4,2.3,3.8,3.4,7.2,3.4c2.1,0,3.8-0.7,5.1-2.2c1.2-1.5,1.8-3.1,1.8-4.8 c0-2.4-0.7-4.2-2.1-5.5C34.5,19.3,32.6,18.6,30.2,18.6z M9.4,9.6c1.2-1.3,2.3-2.3,3.5-3.1c1.1-0.8,2.6-1.7,4.5-2.8L15.2,0 c-1.2,0.8-2.7,1.8-4.5,3C8.9,4.2,7.2,5.7,5.6,7.4c-1.6,1.7-2.9,3.7-4,5.8C0.6,15.4,0,17.8,0,20.5c0,3.7,0.7,6.8,2.2,9.1 C3.6,31.8,6,33,9.4,33c2.1,0,3.8-0.7,5.1-2.2c1.2-1.5,1.8-3.1,1.8-4.8c0-2.4-0.7-4.2-2.1-5.5c-1.4-1.2-3.3-1.9-5.7-1.9H5.7 c0.2-2.1,0.6-3.8,1.2-5.2C7.5,12.1,8.3,10.8,9.4,9.6z"/></svg>');
    $("#primary .page .entry-content blockquote").append('<svg x="0px" y="0px"><path class="st0" d="M30.2,18.6h-2.8c0.2-2.1,0.6-3.8,1.2-5.1c0.6-1.3,1.4-2.6,2.5-3.9c1.2-1.3,2.3-2.3,3.5-3.1 c1.1-0.8,2.6-1.7,4.5-2.8L36.9,0c-1.2,0.8-2.7,1.8-4.5,3c-1.8,1.2-3.5,2.7-5.1,4.5c-1.6,1.7-2.9,3.7-4,5.8 c-1.1,2.2-1.6,4.6-1.6,7.2c0,3.7,0.7,6.8,2.2,9.1c1.4,2.3,3.8,3.4,7.2,3.4c2.1,0,3.8-0.7,5.1-2.2c1.2-1.5,1.8-3.1,1.8-4.8 c0-2.4-0.7-4.2-2.1-5.5C34.5,19.3,32.6,18.6,30.2,18.6z M9.4,9.6c1.2-1.3,2.3-2.3,3.5-3.1c1.1-0.8,2.6-1.7,4.5-2.8L15.2,0 c-1.2,0.8-2.7,1.8-4.5,3C8.9,4.2,7.2,5.7,5.6,7.4c-1.6,1.7-2.9,3.7-4,5.8C0.6,15.4,0,17.8,0,20.5c0,3.7,0.7,6.8,2.2,9.1 C3.6,31.8,6,33,9.4,33c2.1,0,3.8-0.7,5.1-2.2c1.2-1.5,1.8-3.1,1.8-4.8c0-2.4-0.7-4.2-2.1-5.5c-1.4-1.2-3.3-1.9-5.7-1.9H5.7 c0.2-2.1,0.6-3.8,1.2-5.2C7.5,12.1,8.3,10.8,9.4,9.6z"/></svg>');
    $("#primary .post .entry-content .pull-right").append('<svg x="0px" y="0px"><path class="st0" d="M30.2,18.6h-2.8c0.2-2.1,0.6-3.8,1.2-5.1c0.6-1.3,1.4-2.6,2.5-3.9c1.2-1.3,2.3-2.3,3.5-3.1 c1.1-0.8,2.6-1.7,4.5-2.8L36.9,0c-1.2,0.8-2.7,1.8-4.5,3c-1.8,1.2-3.5,2.7-5.1,4.5c-1.6,1.7-2.9,3.7-4,5.8 c-1.1,2.2-1.6,4.6-1.6,7.2c0,3.7,0.7,6.8,2.2,9.1c1.4,2.3,3.8,3.4,7.2,3.4c2.1,0,3.8-0.7,5.1-2.2c1.2-1.5,1.8-3.1,1.8-4.8 c0-2.4-0.7-4.2-2.1-5.5C34.5,19.3,32.6,18.6,30.2,18.6z M9.4,9.6c1.2-1.3,2.3-2.3,3.5-3.1c1.1-0.8,2.6-1.7,4.5-2.8L15.2,0 c-1.2,0.8-2.7,1.8-4.5,3C8.9,4.2,7.2,5.7,5.6,7.4c-1.6,1.7-2.9,3.7-4,5.8C0.6,15.4,0,17.8,0,20.5c0,3.7,0.7,6.8,2.2,9.1 C3.6,31.8,6,33,9.4,33c2.1,0,3.8-0.7,5.1-2.2c1.2-1.5,1.8-3.1,1.8-4.8c0-2.4-0.7-4.2-2.1-5.5c-1.4-1.2-3.3-1.9-5.7-1.9H5.7 c0.2-2.1,0.6-3.8,1.2-5.2C7.5,12.1,8.3,10.8,9.4,9.6z"/></svg>');
    $("#primary .page .entry-content .pull-right").append('<svg x="0px" y="0px"><path class="st0" d="M30.2,18.6h-2.8c0.2-2.1,0.6-3.8,1.2-5.1c0.6-1.3,1.4-2.6,2.5-3.9c1.2-1.3,2.3-2.3,3.5-3.1 c1.1-0.8,2.6-1.7,4.5-2.8L36.9,0c-1.2,0.8-2.7,1.8-4.5,3c-1.8,1.2-3.5,2.7-5.1,4.5c-1.6,1.7-2.9,3.7-4,5.8 c-1.1,2.2-1.6,4.6-1.6,7.2c0,3.7,0.7,6.8,2.2,9.1c1.4,2.3,3.8,3.4,7.2,3.4c2.1,0,3.8-0.7,5.1-2.2c1.2-1.5,1.8-3.1,1.8-4.8 c0-2.4-0.7-4.2-2.1-5.5C34.5,19.3,32.6,18.6,30.2,18.6z M9.4,9.6c1.2-1.3,2.3-2.3,3.5-3.1c1.1-0.8,2.6-1.7,4.5-2.8L15.2,0 c-1.2,0.8-2.7,1.8-4.5,3C8.9,4.2,7.2,5.7,5.6,7.4c-1.6,1.7-2.9,3.7-4,5.8C0.6,15.4,0,17.8,0,20.5c0,3.7,0.7,6.8,2.2,9.1 C3.6,31.8,6,33,9.4,33c2.1,0,3.8-0.7,5.1-2.2c1.2-1.5,1.8-3.1,1.8-4.8c0-2.4-0.7-4.2-2.1-5.5c-1.4-1.2-3.3-1.9-5.7-1.9H5.7 c0.2-2.1,0.6-3.8,1.2-5.2C7.5,12.1,8.3,10.8,9.4,9.6z"/></svg>');

    // responsive menu
    
    if (winWidth < 1025) {
        $('.site-header .right').prepend('<div class="btn-close-menu"><span></span></div>');
        $('#site-navigation ul li.menu-item-has-children').append('<div class="angle-down"><span class="fa fa-angle-down"></span></div>');
        $('#site-navigation ul li .angle-down').click(function() {
            $(this).prev().slideToggle();
            $(this).toggleClass('active');
        });

        $('#toggle-button').click(function() {
            $('.site-header .right').toggleClass('open');
            $('body').toggleClass('menu-open');
        });

        $('.btn-close-menu').click(function() {
            $('body').removeClass('menu-open');
            $('.site-header .right').removeClass('open');
        });

        $('.overlay').click(function() {
            $('body').removeClass('menu-open');
            $('.site-header .right').removeClass('open');
        });

        $('#toggle-button').click(function(event) {
            event.stopPropagation();
        });

        $('.site-header .right').click(function(event) {
            event.stopPropagation();
        });
    }

    // responsive language
    $('.site-header .right .tools .languages li a').click(function(){
        $(this).next().slideToggle();
    });

    // Script for back to top
    $('.to_top').css('bottom', 0);
    $('.to_top').css('opacity', 0);
    $(window).scroll(function(){
        if($(this).scrollTop() > 300){
            $('.to_top').css('bottom', 20);
            $('.to_top').css('opacity', 1);
        }else{
          $('.to_top').css('bottom', 0);
          $('.to_top').css('opacity', 0);
        }
    });
    
    $(".to_top").click(function(event){
        event.preventDefault();
        $('html,body').animate({
            scrollTop:0},600);
    });

    /** One page Scroll */
    if( travel_booking_pro_data.onepage_menu ){
        $('#site-navigation').onePageNav({
            currentClass: 'current-menu-item',
            changeHash: false,
            scrollSpeed: 1500,
            scrollThreshold: 0.5,
            filter: '',
            easing: 'swing',        
        });
    }

    //custom scroll bar
    $(".team-section .col .text-holder .team-content").mCustomScrollbar({
        theme:"minimal-dark"
    });

    $(".page-template-template-trip_types .item .text").mCustomScrollbar({
        theme:"minimal-dark"
    });

    $(".page-template-template-activities .item .text").mCustomScrollbar({
        theme:"minimal-dark"
    });

    /** Sticky Header */
    var windowWidth = $(window).width();
    var header_layout = travel_booking_pro_data.h_layout;
    
    if( travel_booking_pro_data.sticky_menu == '1' && windowWidth >= 1024 ){
        var mns = "sticky-menu";
        
        if( header_layout == 'two' ||  header_layout == 'five'  ){
            navhol = $('.navigation-holder');                
        }else if( header_layout == 'three' ){
            navhol = $('.main-header');
        }else if( header_layout == 'four' ){
            navhol = $('.main-menu-holder');                
        }

        holder = ( header_layout == 'one' ) ? $('.header-one') : $('.header-holder');
        hdr = holder.outerHeight(true);
        
        if( header_layout == 'one' ){
            if( !( $('.hasbanner').length > 0 ) ){
                $('.sticky-holder').height(hdr);
            }
        }else{
            nav = navhol.outerHeight(true);
            $(window).scroll(function() {
                if( $(this).scrollTop() > hdr ) {
                    navhol.addClass(mns);
                    $('.sticky-holder').height(nav);
                }else{
                    navhol.removeClass(mns);
                    $('.sticky-holder').height(0);
                }
            });            
        }        
    }

});
