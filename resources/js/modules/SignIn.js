export default class SignIn {

    load(){
        $(function () {
            //change active form
            $('[data-role="choose-action"] [data-action]').on('click', function () {
                //make only this button active
                $(this).parent().find('[data-action]').removeClass('active');
                $(this).addClass('active');

                //change active form
                //hide form
                $('[data-role="choose-action-container"][data-type]').removeClass('active');

                //show form
                var currentActiveForm = $(this).data('action');
                $('[data-role="choose-action-container"][data-type="'+currentActiveForm+'"]').addClass('active');
            })

            //tag that class on click to itself
            $('[data-self-add-class]').on('click', function () {
                var className = $(this).data('self-add-class');

                if($(this).hasClass(className))
                {
                    $(this).removeClass(className);
                }
                else
                {
                    $(this).addClass(className);
                }
            })
        });
    }
}