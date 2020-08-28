$(function () {
        $(document).on('click',  '.deleteButton', function (e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            let url = $(this).attr('data-url');
            let button = $(this).find("button").attr('disabled', true);

            $.ajax({
                url: url,
                type: 'post',
                data: {
                    'id': id
                },
                success: function (result) {
                    let response = JSON.parse(result);
                    console.log(response);
                    $.pjax.reload({container: '#my_pjax'});
                }
            }).done(function () {
                button.removeAttr('disabled');
            });
        });
});