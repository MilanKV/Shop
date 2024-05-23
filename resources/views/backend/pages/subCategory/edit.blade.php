@extends('backend.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="column col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div class="title">
                                <h5 class="mb-0">Edit subcategory</h5>
                            </div>
                            <div class="card-action my-auto mt-4 ms-auto mt-lg-0">
                                <a href="{{route('subcategory.index')}}" class="btn btn-outline mb-0">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('subcategory.update', ['category' => $category]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row row-create mt-4">
                                <div class="column-left col-lg-4">
                                    <div class="image-card h-100">
                                        <div class="body">
                                            <h5>Category Image</h5>
                                            <div class="row">
                                                <div class="image">
                                                    <img class="mt-3 w-100" src="{{ old('category_image') ? asset('storage/' . old('category_image')) : ($category->category_image ? (Str::startsWith($category->category_image, 'https') ? $category->category_image : asset('storage/' . $category->category_image)) : 'https://cdn.pixabay.com/photo/2017/04/20/07/07/add-2244771_960_720.png') }}" alt="category_image">
                                                </div>
                                                <div class="action mt-4 col-12">
                                                    <div class="d-flex">
                                                        <button class="btn btn-add mb-0 me-2" type="button" name="add">Add</button>
                                                        <input type="file" style="display: none;" name="category_image" id="add-image" value="{{ old('category_image') }}" accept="image/*">
                                                        <button class="btn btn-outline mb-0" type="button" name="remove" data-context="general-management">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="column-right mt-4 col-lg-8 mt-lg-0">
                                    <div class="input-card">
                                        <div class="body">
                                            <h5>Category Information</h5>
                                            <label for="category_name" class="form-label mt-2 row mt-4">Name</label>
                                            <div class="form-group mb-0">
                                                <input id="category_name" name="category_name" class="form-control default" type="text" placeholder="Category Name" value="{{ old('category_name', $category->category_name) }}" required>
                                            </div>

                                            <div class="form-group" id='parent_cat_div'>
                                            <label for="parent_id" class="form-label mt-2 row mt-4">Category</label>
                                                <select name="parent_id" id="parent_id" class="form-control">
                                                    @foreach($parent_cat as $parent)
                                                        <option value='{{$parent->id}}' {{ $parent->id == $category->parent_id ? 'selected' : '' }}>{{$parent->category_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" name="is_parent" id="is_parent" value="{{ $category->is_parent }}">

                                            <label for="status" class="form-label mt-2 row mt-4">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="active" {{ $category->status == \App\Enums\CategoryStatus::ACTIVE ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $category->status == \App\Enums\CategoryStatus::INACTIVE ? 'selected' : '' }}>Inactive</option>
                                            </select>

                                            <label for="short_description" class="form-label mt-2 row mt-4">Description</label>
                                            <div class="form-group mb-0">
                                                <textarea id="short_description" name="short_description" class="form-control m-0" cols="30" rows="4" placeholder="Description" value="{{ old('short_description') }}">{{ old('short_description', $category->short_description) }}</textarea>
                                            </div>

                                            {{-- @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif --}}
                                            <button class="btn mb-0 float-end mt-4 mb-0" type="submit">
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