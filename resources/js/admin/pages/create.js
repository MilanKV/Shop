$(document).ready(function () {
    $('#parent_id').change(function () {
        var selectedOption = $(this).find(':selected');
        var isParent = selectedOption.data('isparent');

        // Set is_parent value based on data-isparent attribute of selected option
        $('#is_parent').val(isParent);
    });

    // Change event for category_id select element
    $('#category_id').change(function () {
        const selectedCategoryId = $(this).val();
        const $subcategorySelect = $('#subcategory_id');
        const allSubcategories = $subcategorySelect.find('option').clone();

        $subcategorySelect.html('<option value="">--Select subcategory--</option>');

        allSubcategories.each(function () {
            if ($(this).data('parent-id') == selectedCategoryId) {
                $subcategorySelect.append($(this));
            }
        });
    });
});