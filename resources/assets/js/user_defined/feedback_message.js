$(function () {
    //close feedback message
    $('.alert .close').on('click', function () {
        $(this).closest('.alert').remove();
    })
})