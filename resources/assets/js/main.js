$(function () {
   $('.navigation-sidebar').on('click', function () {
       $('#page_wrapper').toggleClass('show-menu');
       // if (!$('#page_wrapper').hasClass('show-menu')){
       //     setTimeout(function () {
       //         $($('#page_wrapper')).removeClass('no-overflow');
       //     }, 1000)
       // }
       // else{
       //     $($('#page_wrapper')).addClass('no-overflow');
       // }
   })
});