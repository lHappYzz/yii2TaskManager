$(function () {
    $('.editButton').on('click', function () {
        let button = $(this);
        $('#editModal').modal('show')
            .find('#editModalContent')
            .load(button.attr('value'));
    })
});