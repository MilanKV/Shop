$(document).ready(function() {
    $('#parent_id').change(function() {
        var selectedOption = $(this).find(':selected');
        var isParent = selectedOption.data('isparent');

        // Set is_parent value based on data-isparent attribute of selected option
        $('#is_parent').val(isParent);
    });
});