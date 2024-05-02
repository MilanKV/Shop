<!DOCTYPE html>
<html lang="en">
{{-- Head --}}
@include('backend.includes.head')

<body class="d-flex flex-column min-vh-100">
    {{-- Sidebar --}}
    @include('backend.includes.sidebar')


    <div class="page-section">
        {{-- Header --}}
        @include('backend.includes.header')

        <div class="main">
            {{-- Page Content --}}
            @yield('content')
        </div>

        {{-- Footer --}}
        @include('backend.includes.footer')
    </div>
    {{-- app-body --}}

    {{-- Scripts --}}
    @vite('resources/js/app.js')
</body>

</html>
<script>
    $(document).ready(function(){
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

        // Add button is clicked
        $('button[name="add"]').click(function(){
            $('#category_image').click();
        });

        // Remove button is clicked
        $('button[name="remove"]').click(function(){
            // Set the src attribute of the image to the default image URL
            $('.image img').attr('src', defaultImageURL);
            $('#category_image').val('');
        });
    });

    $(document).ready(function() {
        $('#parent_id').change(function() {
            var selectedOption = $(this).find(':selected');
            var isParent = selectedOption.data('isparent');

            // Set is_parent value based on data-isparent attribute of selected option
            $('#is_parent').val(isParent);
        });
    });

    $(document).ready(function() {
        $('.deleteBtn').on('click', function(event) {
            event.preventDefault();
            var categoryId = $(this).data('id');
            var deleteForm = $('#deleteForm' + categoryId);
            if (deleteForm.length > 0) {
                deleteForm.submit();
            }
        });
    });
</script>