/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function($) {

    // Defining our jQuery plugin

    $.fn.cthulhianaModalBox = function(prop) {
              
        // Default parameters
        var options = $.extend({
            height: "250",
            width: "500",
            title: "JQuery Cthulhiana Modal Box Demo",
            description: "Example of how to create a modal box.",
            top: "20%",
            left: "30%",
        }, prop);

        /*$(this).on('click',function(e) { alert('test');
         add_block_page();
         add_popup_box();
         add_styles();
         
         $('.сthulhiana_modal_box').fadeIn();
         
         });*/

        /*return this.click(function(e) {
            e.stopImmediatePropagation();
            add_block_page();
            add_popup_box();
            add_styles();

            $('.cthulhiana_modal_box').fadeIn();
            return false;
            e.preventDefault();
            e.stopPropagation();
        });*/
        
        return this.on('click',function(e){
            e.preventDefault();
            add_block_page();
            add_popup_box();
            add_styles();

            $('.cthulhianaModalBox').fadeIn();
        });

        function add_block_page() {
            var block_page = $('<div class="cthulhianaModalBlockPage"></div>');

            $(block_page).appendTo('body');
        }

        function add_styles() {
            //Block page overlay
            var pageHeight = $(document).height();
            var pageWidth = $(window).width();

            $('.cthulhianaModalBox').css({
                'position': 'absolute',
                'left': options.left,
                'top': options.top,
                'display': 'none',
                'height': options.height + 'px',
                'width': options.width + 'px',
                'border': '1px solid #fff',
                'box-shadow': '0px 2px 7px #292929',
                '-moz-box-shadow': '0px 2px 7px #292929',
                '-webkit-box-shadow': '0px 2px 7px #292929',
                'border-radius': '10px',
                '-moz-border-radius': '10px',
                '-webkit-border-radius': '10px',
                'background': '#f2f2f2',
                'z-index': '50',
            });

            $('.cthulhianaModalBlockPage').css({
                'position': 'absolute',
                'top': '0',
                'left': '0',
                'background-color': 'rgba(0,0,0,0.6)',
                'height': pageHeight,
                'width': pageWidth,
                'z-index': '10'
            });
                        
            $('.cthulhianaModalClose').css({
                'position': 'relative',
                'top': '-25px',
                'left': '20px',
                'float': 'right',
                'display': 'block',
                'height': 'auto',
                'width': 'auto',
                'padding': '1px',
                'background': '#fff',
                //'background': 'url(images/close.png) no-repeat',
            });
            
            $('.cthulhianaInnerModalBox').css({
                'background-color': '#fff',
                'height': (options.height - 50) + 'px',
                'width': (options.width - 50) + 'px',
                'padding': '10px',
                'margin': '15px',
                'border-radius': '10px',
                '-moz-border-radius': '10px',
                '-webkit-border-radius': '10px'
            });
        }

        function add_popup_box() {
            var pop_up = $('<div class="cthulhianaModalBox"><a href="#" class="cthulhianaModalClose"><i class="fa fa-times fa-4 orange"></i></a><div class="cthulhianaInnerModalBox"><h2>' + options.title + '</h2><p>' + options.description + '</p></div></div>');            
            $(pop_up).appendTo('.cthulhianaModalBlockPage');

            $('.cthulhianaModalClose').click(function() {
                $('.cthulhianaModalBlockPage').fadeOut().remove();
                $(this).parent().fadeOut().remove();
            });
        
            
        }
        return this;
    };

})(jQuery);

