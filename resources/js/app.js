import './bootstrap';
$(document).ready(function() {
    $('form').on('submit', function(e) {
        var form = $(this);
        if (form[0].checkValidity() === false) {
            e.preventDefault();
            e.stopPropagation();
        }
        form.addClass('was-validated');
    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Example AJAX request
$('.delete-user').on('click', function(e) {
    e.preventDefault();
    var userId = $(this).data('id');
    if (confirm('Are you sure?')) {
        $.ajax({
            url: '/users/' + userId,
            type: 'DELETE',
            success: function(result) {
                // Handle success
            },
            error: function(xhr) {
                // Handle error
            }
        });
    }
});