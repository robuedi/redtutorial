$(function () {
    //change active form
    $('[data-role="sign-choose-action"] [data-action]').on('click', function () {
        //make only this button active
        $(this).parent().find('[data-action]').removeClass('active');
        $(this).addClass('active');

        //change active form
        //hide form
        $('[data-role="sign-in-form"]').removeClass('active');

        //show form
        var currentActiveForm = $(this).data('action');
        $('[data-role="sign-in-form"][data-type="'+currentActiveForm+'"]').addClass('active');
    })
});