$(document).ready(function() {
    // Store the URL of the default image
    var defaultImageURL = 'https://cdn.pixabay.com/photo/2017/04/20/07/07/add-2244771_960_720.png';

    // When the file input changes
    $('#category_image').change(function(){
        // Check if any file is selected
        if(this.files && this.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                // Set the src attribute of the image to the selected file's data URL
                $('.image img').attr('src', e.target.result);
            }
            // Read the selected file as a Data URL
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Add button
    $('button[name="add"]').click(function(){
        $('#category_image').click();
    });

    // Remove button
    $('button[name="remove"]').click(function(){
        // Set the src attribute of the image to the default image URL
        $('.image img').attr('src', defaultImageURL);
        $('#category_image').val('');
    });
});