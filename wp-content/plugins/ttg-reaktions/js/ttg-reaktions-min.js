/**
 * @package T2G Reaktions
 * Script for the Qantumthemes Love It plugin
 */


(function($) {
    "use strict";
    $.qtWebsiteObj = {};
    $.qtWebsiteObj.body = $("body");

    $.fn.ttgReaktionsLoveitAjax = function(){
        var post_id, heart;
        $.qtWebsiteObj.body.on("click","a.ttg_reaktions-link", function(e){
            e.preventDefault();
            heart = $(this);
            // Retrieve post ID from data attribute
            post_id = heart.data("post_id");
            // Ajax call
            $.ajax({
                type: "post",
                url: ajax_var.url,
                data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
                success: function(count){
                    // If vote successful
                    if(count != "already") {
                        heart.addClass("ttg-reaktions-btn-disabled");
                        heart.find(".count").text(count);
                        heart.find('i').removeClass('reakticons-heart').addClass('reakticons-heart-full');
                    }
                }
            });
            return false;
        });
    };


     $.fn.ttgRatingCounterAjax = function(){
       
        var post_id, rating, single, multi, container, label;

        $.qtWebsiteObj.viewCounterAjax = $(".ttg-reactions-viewconuterajax");
        if($.qtWebsiteObj.viewCounterAjax == 0){
            return;
        }

        $.qtWebsiteObj.body.on("change","input[name='ttg-reaktions-star']", function(e){
            e.preventDefault();

            var that = $(this),
                form = that.closest("form"),
                post_id = form.attr("data-postid"),
                rating = that.attr("value");
                
            var data =  "action=ttg_rating_submit&nonce="+ajax_var.nonce+"&ttg_rating_submit="+rating+"&post_id="+post_id;
            var ajaxurl = ajax_var.url;
            var responsearray, avg, count, label_novote,rating_container, before, rating_feedback,feedback_msg;
            $.ajax({
                type: "post",
                url: ajaxurl,
                data: data,
                success: function(response){
                    container = $(".ttg-Ratings-Amount");
                    rating_container =  $(".ttg-Ratings-Avg");
                    rating_feedback = $(".ttg-Ratings-Feedback");
                    label_novote = container.attr("data-novote");
                    responsearray = response.split("|avg=");
                    label = container.attr("data-single");
                    before = container.attr("data-before");
                    feedback_msg = rating_feedback.attr("data-thanks");
                    if(response === 'novote'){
                        // container.html(label_novote);
                         rating_feedback.html(label_novote);
                        return;
                    }
                    count = responsearray[0];
                    avg = responsearray[1];
                    if(count > 1){
                        label = container.attr("data-multi");
                    }
                    rating_container.html(parseFloat(avg).toFixed(2)  );
                    rating_feedback.html(feedback_msg);
                    container.html(before+' '+count+ ' ' +label);
                },
                error: function(result){
                    // console.log("Ajax rating error");
                }
            });
        });
    }
    $.fn.ttgViewCounterAjax = function(){
        $.qtWebsiteObj.viewCounterAjax = $(".ttg-reactions-viewconuterajax");
        var single, multi, container, label;
        if($.qtWebsiteObj.viewCounterAjax.length == 0){
            return;
        }
        var post_id = $.qtWebsiteObj.viewCounterAjax.attr("data-id");
        var data =  "action=ttg_post_views&nonce="+ajax_var.nonce+"&ttg_post_views=&post_id="+post_id;
        var ajaxurl = ajax_var.url;

        $.ajax({
            type: "post",
            url: ajaxurl,
            data: data,
            success: function(count){
                container = $(".ttg-Reaktions-Views-Amount");
                label = container.attr("data-single");
                if(count > 1){
                    label = container.attr("data-multi");
                }
                container.html(count+ ' ' +label);
            },
            error: function(result){
                // console.log("Ajax count error");
            }
        });
    }

    /* activates
    *  Adds and removes the class "wpcast-active" from the target item  
    ====================================================================*/
   $.fn.ttgReactionsActivates= function(){
       
        var t, // target
            o = $.qtWebsiteObj,
            s = false;
        o.body.off("click", "[data-ttg-reaktions-activates]");
        o.body.on("click", "[data-ttg-reaktions-activates]", function(e){
            e.preventDefault();
            s = $(this).attr("data-ttg-reaktions-activates")
            t = $(s);
            if(!s || s === ''){
                t = $(this);
            }
            if( s == 'parent'){
                t = $(this).parent();
            }
            t.toggleClass("ttg-reaktions-active");
            return;
        });
    },

   

  

    /**====================================================================
     *
     * 
     *  Popup opener (requires library component) 
     *  
     * 
     ====================================================================*/
    $.fn.ttgReaktionPopupwindow = function() {
        if(typeof($.fn.popupwindow) !== "undefined"){
           $.fn.popupwindow();
        }
    };

    $(document).ready(function() {
        $.fn.ttgReaktionPopupwindow();
        $.fn.ttgReaktionsLoveitAjax();
        $.fn.ttgViewCounterAjax();
        $.fn.ttgRatingCounterAjax();
         $.fn.ttgReactionsActivates();
    });


})(jQuery);