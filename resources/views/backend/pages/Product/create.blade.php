@extends('backend.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="column col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div class="title">
                                <h5 class="mb-0">Add a new product</h5>
                            </div>
                            <div class="card-action my-auto mt-4 ms-auto mt-lg-0">
                                <a href="{{route('product.index')}}" class="btn btn-outline mb-0">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="row row-create mt-4">
                                <div class="column-left col-lg-4">
                                    <div class="image-card h-100">
                                        <div class="body">
                                            <h5>Product Image</h5>
                                            <div class="row mt-4">
                                                <a id="main-image-link" class="image" href="{{ old('photo_name') ? asset('storage/' . old('photo_name')) : 'https://cdn.pixabay.com/photo/2017/04/20/07/07/add-2244771_960_720.png' }}" target="_blank">
                                                    <img class="mt-3 w-100" id="main-image" src="{{ old('photo_name') ? asset('storage/' . old('photo_name')) : 'https://cdn.pixabay.com/photo/2017/04/20/07/07/add-2244771_960_720.png' }}" alt="photo_name">
                                                </a>
                                                <div class="image-row mt-5">
                                                    <nav>
                                                        <div class="image-gallery d-flex flex-wrap" id="image-gallery">
                                                            {{-- <a href="#" class="nav-link">
                                                                <img src="" alt="">
                                                            </a> --}}
                                                        </div>
                                                    </nav>
                                                </div>
                                                <div class="action mt-4 col-12">
                                                    <div class="d-flex">
                                                        <button class="btn btn-add mb-0 me-2" type="button" name="add">Add</button>
                                                        <input type="file" style="display: none;"  name="image[]" id="add-image" accept="image/*" multiple>
                                                        <button class="btn btn-outline mb-0" type="button" name="remove-all-images" id="remove-all-images">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="column-right mt-4 col-lg-8 mt-lg-0">
                                    <div class="input-card">
                                        <div class="body">
                                            <h5>Product Information</h5>
                                            <div class="d-flex flex-row">
                                                <div class="form-group flex-grow-1 mb-0 pe-4">
                                                    <label for="product_name" class="form-label mt-2 row mt-4">Name</label>
                                                    <input id="product_name" name="product_name" class="form-control default" type="text" placeholder="Product Name" value="{{ old('product_name') }}" required>
                                                </div>
                                                <div class="form-group flex-grow-1 mb-0 pe-4">
                                                    <label for="SKU" class="form-label mt-2 row mt-4">SKU</label>
                                                    <input id="SKU" name="product_SKU" class="form-control default" type="text" placeholder="12345678" value="{{ old('product_SKU') }}">
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <div class="form-group flex-grow-1 mb-0 pe-4">
                                                    <label for="weight" class="form-label mt-2 row mt-4">Weight</label>
                                                    <input id="weight" name="weight" class="form-control default" type="text" placeholder="2" value="{{ old('weight') }}">
                                                </div>
                                                <div class="form-group flex-grow-1 mb-0 pe-4">
                                                    <label for="quantity" class="form-label mt-2 row mt-4">Quantity</label>
                                                    <input id="quantity" name="quantity" class="form-control default" type="number" placeholder="50" value="{{ old('quantity') }}">
                                                </div>
                                                <div class="form-group flex-grow-1 mb-0 pe-4">
                                                    <label for="product_color" class="form-label mt-2 row mt-4">Color</label>
                                                    <select name="product_color" class="form-control">
                                                        <option value="">Color</option>
                                                        <option value="red" {{ old('product_color') == 'red' ? 'selected' : '' }}>Red</option>
                                                        <option value="blue" {{ old('product_color') == 'blue' ? 'selected' : '' }}>Blue</option>
                                                        <option value="black" {{ old('product_color') == 'black' ? 'selected' : '' }}>Black</option>
                                                        <option value="green" {{ old('product_color') == 'green' ? 'selected' : '' }}>Green</option>
                                                        <option value="yellow" {{ old('product_color') == 'yellow' ? 'selected' : '' }}>Yellow</option>
                                                    </select>
                                                </div>
                                                <div class="form-group flex-grow-1 mb-0 pe-4">
                                                    <label for="product_size" class="form-label mt-2 row mt-4">Size</label>
                                                    <select name="product_size" class="form-control">
                                                        <option value="">Size</option>
                                                        <option value="small" {{ old('product_size') == 'small' ? 'selected' : '' }}>Small</option>
                                                        <option value="medium" {{ old('product_size') == 'medium' ? 'selected' : '' }}>Medium</option>
                                                        <option value="large" {{ old('product_size') == 'large' ? 'selected' : '' }}>Large</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <label for="short_description" class="form-label mt-2 row mt-4">Summary</label>
                                            <div class="form-group mb-0">
                                                <textarea id="short_description" name="short_description" class="form-control m-0" cols="30" rows="2" placeholder="Summary">{{ old('short_description') }}</textarea>
                                            </div>

                                            <label for="long_descriptions" class="form-label mt-2 row mt-4">Description</label>
                                            <div class="form-group mb-0">
                                                <textarea id="long_descriptions" name="long_descriptions" class="form-control m-0" cols="30" rows="4" placeholder="Description">{{ old('long_descriptions') }}</textarea>
                                            </div>

                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-create mt-4 border-top">
                                <div class="column-left col-lg-4">
                                    <div class="input-card">
                                        <div class="body">
                                            <h5>Status Overview</h5>
                                            <label for="status" class="form-label mt-2 row mt-4">Product Status</label>
                                            <select name="status" class="form-control">
                                                <option value="">Status</option>
                                                <option value="in stock" {{ old('status') == 'in stock' ? 'selected' : '' }}>In Stock</option>
                                                <option value="out of stock" {{ old('status') == 'out of stock' ? 'selected' : '' }}>Out of Stock</option>
                                            </select>

                                            <label for="brand_id" class="form-label mt-2 row mt-4">Brand</label>
                                            <select name="brand_id" class="form-control">
                                                <option value="">Brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>

                                            <label for="category_id" class="form-label mt-2 row mt-4">Category</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Category</option>
                                                @foreach($categories as $category)
                                                    @if ($category->is_parent && is_null($category->parent_id))
                                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            <label for="subcategory_id" class="form-label mt-2 row mt-4">Subcategory</label>
                                            <select name="subcategory_id" id="subcategory_id" class="form-control">
                                                <option value="">Subcategory</option>
                                                @foreach($categories as $subcategory)
                                                    @if (!$subcategory->is_parent && !is_null($subcategory->parent_id))
                                                        <option value="{{ $subcategory->id }}" data-parent-id="{{ $subcategory->parent_id }}" {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->category_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="column-right mt-4 col-lg-8 mt-lg-0">
                                    <div class="input-card">
                                        <div class="body">
                                            <h5>Price Overview</h5>
                                            <label for="price" class="form-label mt-2 row mt-4">Price($)</label>
                                            <div class="form-group mb-0">
                                                <input id="purchase_price" name="purchase_price" class="form-control default" type="text" placeholder="129.00" value="{{ old('purchase_price') }}" required>
                                            </div>

                                            <label for="discount" class="form-label mt-2 row mt-4">Discount(%)</label>
                                            <div class="form-group mb-0">
                                                <input id="discount_price" name="discount_price" class="form-control default" type="number" min="0" max="100" placeholder="10" value="{{ old('discount_price') }}">
                                            </div>

                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <button class="btn btn-add mb-0 float-end mt-5" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection