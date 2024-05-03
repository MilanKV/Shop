$(document).ready(function() {
    // Retrieve the 'perPage' parameter from the URL
    var urlParams = new URLSearchParams(window.location.search);
    var perPage = urlParams.get('perPage');
    if (perPage) {
        $('#perPage').val(perPage);
    }
    $('#perPage').change(function() {
        var perPage = $(this).val();
        var url = window.location.href.split('?')[0];
        window.location.href = url + '?perPage=' + perPage;
    });

    // Delete button is clicked
    $('.deleteBtn').on('click', function(event) {
        event.preventDefault();
        var categoryId = $(this).data('id');
        var deleteForm = $('#deleteForm' + categoryId);
        if (deleteForm.length > 0) {
            deleteForm.submit();
        }
    });
});