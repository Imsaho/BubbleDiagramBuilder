
$(document).ready(function () {
    $('.askdelete').on('click', function (event) {
        console.log(('.askdelete'));
        event.preventDefault();
        var message = confirm("Czy na pewno chcesz usunąć element?");
        if (message === true) {
            console.log("ADfsdfdfa");
            window.location = $(this).attr('href');
            return true;
        }
    });
});
