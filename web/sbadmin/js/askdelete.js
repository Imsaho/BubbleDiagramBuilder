
$(document).ready(function () {
    $('.askdelete').on('click', function (event) {
        event.preventDefault();
        var message = confirm("Czy na pewno chcesz usunąć element?");
        if (message === true) {
            window.location = $(this).attr('href');
            return true;
        }
    });
});
