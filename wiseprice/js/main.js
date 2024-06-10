/** ==========================================================================================

  Project :   Qmoto - Car Dealers - Responsive Multi-purpose HTML5 Template
  Version:    1.1
  Author :    Preyantechnosys

========================================================================================== */

/** ===============

 .. Preloader
 .. Fixed-header
 .. Menu
 .. Skillbar
 .. Tab
 .. Accordion
 .. Isotope
 .. Prettyphoto
 .. Slick_slider 
 .. Swiper-container Slider range
 .. Slider range
 .. Hide / Show Js
 .. Back to top 

 =============== */


jQuery(function($) {

  "use strict";

/*------------------------------------------------------------------------------*/
/* Preloader
/*------------------------------------------------------------------------------*/
   // makes sure the whole site is loaded
    $(window).on("load",function(){
        $(".loader-blob").fadeOut(),$("#preloader").delay(300).fadeOut("slow",function(){$(this).remove()});

    })
  
/*------------------------------------------------------------------------------*/
/* Fixed-header
/*------------------------------------------------------------------------------*/

    $(window).on("scroll", function() {
        if (matchMedia('only screen and (min-width: 1200px)').matches) {
            if ($(window).scrollTop() >= 50) {

                $('.prt-stickable-header').addClass('fixed-header');
            } else {

                $('.prt-stickable-header').removeClass('fixed-header');
            }
        }
    });

    
/*------------------------------------------------------------------------------*/
/* Menu
/*------------------------------------------------------------------------------*/
        
        var menu = {
        initialize: function() {
            this.Menuhover();
        },

        Menuhover : function(){
            var getNav = $("nav.main-menu"),
                getWindow = $(window).width(),
                getHeight = $(window).height(),
                getIn = getNav.find("ul.menu").data("in"),
                getOut = getNav.find("ul.menu").data("out");
            
            if ( matchMedia( 'only screen and (max-width: 1200px)' ).matches ) {
                                                     
                // Enable click event
                $("nav.main-menu ul.menu").each(function(){
                    
                    // Dropdown Fade Toggle
                    $("a.mega-menu-link", this).on('click', function (e) {
                        e.preventDefault();
                        var t = $(this);
                        t.toggleClass('active').next('ul').toggleClass('active');
                    });   

                    // Megamenu style
                    $(".megamenu-fw", this).each(function(){
                        $(".col-menu", this).each(function(){
                            $(".title", this).off("click");
                            $(".title", this).on("click", function(){
                                $(this).closest(".col-menu").find(".content").stop().toggleClass('active');
                                $(this).closest(".col-menu").toggleClass("active");
                                return false;
                                e.preventDefault();
                                
                            });

                        });
                    });  
                    
                }); 
            }
        },
    };

    
    $('.btn-show-menu-mobile').on('click', function(e){
        $(this).toggleClass('is-active'); 
        $('.menu-mobile').toggleClass('show'); 
        return false;
        e.preventDefault();  
    });

    // Initialize
    $(document).ready(function(){
        menu.initialize();

    });

/*------------------------------------------------------------------------------*/
/* Skillbar
/*------------------------------------------------------------------------------*/
    
    $('.prt-progress-bar').each(function() {
        $(this).find('.progress-bar').width(0);
    });

    $('.prt-progress-bar').each(function() {

        $(this).find('.progress-bar').animate({
            width: $(this).attr('data-percent')
        }, 2000);
    });


    // Part of the code responsible for loading percentages:

    $('.progress-bar-percent[data-percentage]').each(function () {

        var progress = $(this);
        var percentage = Math.ceil($(this).attr('data-percentage'));

            $({countNum: 0}).animate({countNum: percentage}, {
                duration: 2000,
                easing:'linear',
                step: function() {
                // What todo on every count
                    var pct = '';
                    if(percentage === "0"){
                        pct = Math.floor(this.countNum) + '%';
                    }else{
                        pct = Math.floor(this.countNum+1) + '%';
                    }
                    progress.text(pct);
                }
            });
    });

/*------------------------------------------------------------------------------*/
/* Tab
/*------------------------------------------------------------------------------*/ 

      $('.prt-tabs').each(function() {
        $(this).children('.content-tab').children().hide();
        $(this).children('.content-tab').children().first().show();
        $(this).find('.tabs').children('li').on('click', function(e) {  
        var liActive = $(this).index(),
        contentActive = $(this).siblings().removeClass('active').parents('.prt-tabs').children('.content-tab').children().eq(liActive);
        contentActive.addClass('active').fadeIn('slow');
        contentActive.siblings().removeClass('active');
        $(this).addClass('active').parents('.prt-tabs').children('.content-tab').children().eq(liActive).siblings().hide();
        e.preventDefault();
        });
    });


/*------------------------------------------------------------------------------*/
/* Accordion
/*------------------------------------------------------------------------------*/

    var allPanels = $('.accordion > .toggle').children('.toggle-content').hide();

    $('.toggle-title').on('click',function(e) {

        e.preventDefault();
        var $this = $(this);
            $this.parent().parent().find('.toggle .toggle-title a').removeClass('active');

        if ($this.next().hasClass('show')) {

            $this.next().removeClass('show');   
            $this.next().slideUp('easeInExpo');

        } else {
            $this.parent().parent().find('.toggle .toggle-content').removeClass('show');
            $this.parent().parent().find('.toggle .toggle-content').slideUp('easeInExpo');
            $this.next().toggleClass('show');
            $this.next().removeClass('show');
            $this.next().slideToggle('easeInExpo');
           $this.next().parent().children().children().addClass('active');

        }

    });

/*------------------------------------------------------------------------------*/
/* Isotope
/*------------------------------------------------------------------------------*/

$(function () {

    if ( $().isotope ) {           
        var $container = $('.isotope-project');
        $container.imagesLoaded(function(){
            $container.isotope({
                itemSelector: '',
                transitionDuration: '1s',
            });
        });

        $('.brand-filter li').on('click',function() {                           
            var selector = $(this).find("a").attr('data-filter');
            $('.brand-filter li').removeClass('active');
            $(this).addClass('active');
            $container.isotope({ filter: selector });
            return false;
        });
    };

});
    
/*------------------------------------------------------------------------------*/
/* Prettyphoto
/*------------------------------------------------------------------------------*/
    $(function () {

        // Normal link
        jQuery('a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]').each(function(){
            if( jQuery(this).attr('target')!='_blank' && !jQuery(this).hasClass('prettyphoto') ){
                var attr = $(this).attr('rel');
                if (typeof attr !== typeof undefined && attr !== false && attr!='prettyPhoto' ) {
                    jQuery(this).attr('data-rel','prettyPhoto');
                }
            }
        });    
         jQuery('a[data-gal^="prettyPhoto"]').prettyPhoto();
        jQuery('a.prt_prettyphoto').prettyPhoto();
        jQuery('a[data-gal^="prettyPhoto"]').prettyPhoto();
        jQuery("a[data-gal^='prettyPhoto']").prettyPhoto({hook: 'data-gal'})
    });
    

    $(window).on('load', function(){

    function gridMasonry(){
        var grid = $(".masonry-grid")
        if( grid.length ){
            
          grid.isotope({
            itemSelector: '.masonry-grid-item',
            percentPosition: true,
            layoutMode: 'masonry',
            masonry: {
              columnWidth: '.grid-sizer',
            },
          });
            
        }
    }
    gridMasonry();
});


/*------------------------------------------------------------------------------*/
/* Slick_slider
/*------------------------------------------------------------------------------*/
    $(".slick_slider").slick({
        speed: 1000,
        infinite: true,
        arrows: false,
        dots: false,                   
        autoplay: false,
        centerMode : false,

        responsive: [{

            breakpoint: 1360,
            settings: {
            slidesToShow: 3,
            slidesToScroll: 3
            }
        },
        {
            breakpoint: 1024,
            settings: {
            slidesToShow: 3,
            slidesToScroll: 3
            }
        },
        {
            breakpoint: 680,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 575,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
    });
});

/*------------------------------------------------------------------------------*/
/* swiper-container
/*------------------------------------------------------------------------------*/ 

var swiper = new Swiper(".swiper-container", {
    slidesPerView: 1,
    loop: true,
    effect: "coverflow",
    grabCursor: false,
    centeredSlides: true,
    spaceBetween: -10,
    coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 300,
        modifier: 1,
        slideShadows: false
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },
    breakpoints: {
    1199: {
      slidesPerView: 1
    }
  }
});

/*------------------------------------------------------------------------------*/
/* copy-link
/*------------------------------------------------------------------------------*/ 

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}

/*------------------------------------------------------------------------------*/
/* hide/show Button
/*------------------------------------------------------------------------------*/

$(".comment-wrap-btn").click (function(){
  // Close all open windows
  $(".prt-blog-comment").stop().slideUp(500); 
  // Toggle this window open/close
  $(this).next(".prt-blog-comment").stop().slideToggle(500);
});

/*------------------------------------------------------------------------------*/
/*team hide/show Button
/*------------------------------------------------------------------------------*/

    $(function(){
      $('.btn-circle').click(function(){
        $(this).parent().toggleClass('active');
        return false;
      })
    })

    $(function() {
    //do something
      
      $(".btn-round").click({animateIn: "closeButton", animateOut: "plusButton"}, animate_function);
      function animate_function(event){
          if( $(this).hasClass(event.data.animateIn) ) {
                $(this).removeClass(event.data.animateIn).addClass(event.data.animateOut);
               }
            else if( $(this).hasClass(event.data.animateOut) ) {
               $(this).removeClass(event.data.animateOut).addClass(event.data.animateIn);
            }
            else {
              $(this).addClass('animated ' + event.data.animateIn);
            }     
      }
    //end do something     
    });

/*------------------------------------------------------------------------------*/
/*  Slider range
/*------------------------------------------------------------------------------*/

function getVals(){
  // Get slider values
  var parent = this.parentNode;
  var slides = parent.getElementsByTagName("input");
    var slide1 = parseFloat( slides[0].value );
    var slide2 = parseFloat( slides[1].value );
  // Neither slider will clip the other, so make sure we determine which is larger
  if( slide1 > slide2 ){ var tmp = slide2; slide2 = slide1; slide1 = tmp; }
  
  var displayElement = parent.getElementsByClassName("rangeValues")[0];
      displayElement.innerHTML = "$" + slide1 + " - $" + slide2 ;
}

window.onload = function(){
  // Initialize Sliders
  var sliderSections = document.getElementsByClassName("range-slider");
      for( var x = 0; x < sliderSections.length; x++ ){
        var sliders = sliderSections[x].getElementsByTagName("input");
        for( var y = 0; y < sliders.length; y++ ){
          if( sliders[y].type ==="range" ){
            sliders[y].oninput = getVals;
            // Manually trigger event first time to display values
            sliders[y].oninput();
          }
        }
      }
}

/*------------------------------------------------------------------------------*/
/*  show - hide
/*------------------------------------------------------------------------------*/

$("#phoneNumber").on("click", function() {
    let phone = $(this).data('phone');
    $("#phoneNumber a").replaceWith(`<a href="tel:${phone}"> ${phone}</a>`);
});

$("#emailAdress").on("click", function() {
    let email = $(this).data('email');
    $("#emailAdress a").replaceWith(`<a href="mailto:${email}"> ${email}</a>`);
});

$("#whatsapp").on("click", function() {
    let phone = $(this).data('phone');
    $("#whatsapp a").replaceWith(`<a href="tel:${phone}"> ${phone}</a>`);
});


/*------------------------------------------------------------------------------*/
/* Contact Form
/*------------------------------------------------------------------------------*/
$(function() {
    //Contact Form Validation
    if($('#contactform').length){
        $('#submit').click(function(){
            var o = new Object();
            var form = '#contactform';
            
            var username = $('#contactform .username').val();
            var email = $('#contactform .email').val();
            var message = $('#contactform .message').val();
            
            if(username == '' || email == '' || message == '')
            {
                $('#contactform .response').html('<div class="failed">Please fill the required fields.</div>');
                return false;
            }
            
            $.ajax({
                url:"php/sendemail.php",
                method:"POST",
                data: $(form).serialize(),
                beforeSend:function(){
                    $('#contactform .response').html('<div class="text-info">Loading...</div>');
                },
                success:function(data){
                    $('form').trigger("reset");
                    $('#contactform .response').fadeIn().html(data);
                    setTimeout(function(){
                        $('#contactform .response').fadeOut("slow");
                    }, 5000);
                },
                error:function(){
                    $('#contactform .response').fadeIn().html(data);
                }
            });
        });
    }

    });




/*------------------------------------------------------------------------------*/
/*  loan-calculator
/*------------------------------------------------------------------------------*/

// Functions starting with $ are JQuery functions.
$("#mortgageCalc").click(function()
{
    var L,P,n,c,dp,T;
    L=parseFloat($("#mcPrice").val());/* Selling price, dollars */
    n=parseFloat($("#mcTerm").val());/* Mortgage term, months */
    c=parseFloat($("#mcRate").val())/1200;/* Monthly interest rate, decimal */
    dp=parseFloat($("#mcDown").val());/* Down payment, dollars */
    L=L-dp;/* Amount owed (mortgage principal), dollars */
    P=(L*(c*Math.pow(1+c,n)))/(Math.pow(1+c,n)-1);/* Monthly payment, dollars */
    T=P*n;/* Total paid */
    
    if(!isNaN(P))
        {
            $("#mcPrincipal").val(L.toFixed(2));
            $("#mcPayment").val(P.toFixed(2));
            $("#mcTotal").val(T.toFixed(2));
        }
        else
        {
            $("#mcPayment").val('Error - Monthly Payment is not a number');
        }
    return false;
});

$(document).ready(function(){
  $('ul.car-details-menu-list li.items a').click(function(){
    $('li.items a').removeClass("active");
    $(this).addClass("active");
    });
});

/*------------------------------------------------------------------------------*/
/* Back to top
/*------------------------------------------------------------------------------*/
    
    // ===== Scroll to Top ==== 
    jQuery('#totop').hide();

    $(window).on("scroll",function(){
        if (jQuery(this).scrollTop() >= 500) {        // If page is scrolled more than 50px
            jQuery('#totop').fadeIn(200);    // Fade in the arrow
            jQuery('#totop').addClass('top-visible');
        } else {
            jQuery('#totop').fadeOut(200);   // Else fade out the arrow
            jQuery('#totop').removeClass('top-visible');
        }
    });

    jQuery('#totop').on("click",function() {      // When arrow is clicked
        jQuery('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
        return false;
    });

