/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */


$( document ).ready(function() {
    $("#origin-input").prependTo("#point_a");
    $("#destination-input").prependTo("#point_b");
    $('.date-picker').bootstrapMaterialDatePicker({weekStart : 0, time: false, lang : 'en', format : 'MM/DD/YYYY', minDate : new Date()}); /* @TODO [add lang param from session] */
    $('.time-picker').bootstrapMaterialDatePicker({ format : 'HH:mm', date: false });
     
    $("#submit_booking").click(function(e){
        var mp = new Mprogress();
//        e.preventDefault();
        mp.end(true);

//        var query_value = $('input#ajax_user_name').val();
//        $('#search-string').text(query_value);
//        if(query_value !== ''){
//            $.ajax({
//                type: "GET",
//                url: "/ajaxcall/check-user?query=" + query_value,
//    //            data: { query: query_value },
//                async: true,
//                cache: false,
//                success: function(html){
//                    $("ul#results").html(html);
//                    $('li h3').wrapInTag({
//                        tag: 'strong',
//                        words: [query_value]
//                    });
//                }
//            });
//        }
//        return false;
    });


});