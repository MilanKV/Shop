$(document).ready(function () {
    // Store the URL of the default image
    var defaultImageURLGeneral = 'https://cdn.pixabay.com/photo/2017/04/20/07/07/add-2244771_960_720.png';
    var defaultImageURLUserManagement = 'https://st2.depositphotos.com/1104517/11965/v/950/depositphotos_119659092-stock-illustration-male-avatar-profile-picture-vector.jpg';


    // When the file input changes
    $('input[type="file"]').change(function () {
        // Check if any file is selected
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // Set the src attribute of the corresponding image to the selected file's data URL
                $(this).closest('.row').find('.image img').attr('src', e.target.result);
            }.bind(this);
            // Read the selected file as a Data URL
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Add button
    $('button[name="add"]').click(function () {
        $(this).closest('.action').find('input[type="file"]').click();
    });

    // Remove button
    $('button[name="remove"]').click(function () {
        // Determine which default image URL to use based on a data attribute
        var context = $(this).data('context');
        var defaultImageURL = context === 'user-management' ? defaultImageURLUserManagement : defaultImageURLGeneral;

        // Set the src attribute of the corresponding image
        $(this).closest('.row').find('.image img').attr('src', defaultImageURL);
        $(this).closest('.action').find('input[type="file"]').val('');
    });
});