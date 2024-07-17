$(document).ready(function () {
    // Store the URL of the default image
    var defaultImageURL = 'https://cdn.pixabay.com/photo/2017/04/20/07/07/add-2244771_960_720.png';

    // Function to update the main image and link
    function updateMainImage(imageSrc) {
        $('#main-image').attr('src', imageSrc);
        $('#main-image-link').attr('href', imageSrc);
    }

    // Function to set an image as active
    function setActiveImage(element) {
        $('.image-gallery .nav-link').removeClass('active');
        element.addClass('active');
    }

    // Initial setup for main image and link
    var firstImageElement = $('.image-gallery .nav-link:first');
    var firstImageSrc = firstImageElement.find('img').attr('src');
    updateMainImage(firstImageSrc);
    setActiveImage(firstImageElement);
    $('#main-image-link').attr('href', firstImageSrc);

    $('input[type="file"]').change(function () {
        var inputFiles = this.files;

        // Check if any file is selected
        if (inputFiles && inputFiles.length > 0) {
            var imagesGallery = $('#image-gallery');

            // Keep existing images
            var existingImages = '';
            imagesGallery.find('.nav-link').each(function () {
                existingImages += $(this).prop('outerHTML');
            });

            imagesGallery.empty();
            imagesGallery.append(existingImages);

            for (var i = 0; i < inputFiles.length; i++) {
                var imageUrl = URL.createObjectURL(inputFiles[i]);
                imagesGallery.append('<a href="' + imageUrl + '" target="_blank" class="nav-link"><img src="' + imageUrl + '" alt=""></a>');
            }

            // Set the first new image as active in the main image
            var firstNewImageElement = imagesGallery.find('.nav-link:first');
            var firstNewImageSrc = firstNewImageElement.find('img:first').attr('src');
            updateMainImage(firstNewImageSrc);
            setActiveImage(firstNewImageElement);
            $('#main-image-link').attr('href', firstNewImageSrc);
        }
    });

    // Add button
    $('button[name="add"]').click(function () {
        $(this).closest('.action').find('input[type="file"]').click();
    });

    // Remove all images button
    $('#remove-all-images').click(function () {
        $('#image-gallery').empty();
        updateMainImage(defaultImageURL);
        $('#main-image-link').attr('href', defaultImageURL);
        $('input[type="file"]').val('');
        $('#remove-all-images-input').val('1');
    });

    // Change the main image when a thumbnail is clicked
    $(document).on('click', '.image-gallery .nav-link', function (e) {
        e.preventDefault();
        var imageSrc = $(this).find('img').attr('src');
        updateMainImage(imageSrc);
        setActiveImage($(this));
        $('#main-image-link').attr('href', imageSrc);
    });
});