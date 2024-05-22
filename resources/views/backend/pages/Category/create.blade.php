@extends('backend.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="column col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div class="title">
                                <h5 class="mb-0">Add a new category</h5>
                            </div>
                            <div class="card-action my-auto mt-4 ms-auto mt-lg-0">
                                <a href="{{route('category.index')}}" class="btn btn-outline mb-0">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row row-create mt-4">
                                <div class="column-left col-lg-4">
                                    <div class="image-card h-100">
                                        <div class="body">
                                            <h5>Category Image</h5>
                                            <div class="row">
                                                <div class="image">
                                                    <img class="mt-3 w-100" src="https://cdn.pixabay.com/photo/2017/04/20/07/07/add-2244771_960_720.png" alt="category_image">
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
                                                <input id="category_name" name="category_name" class="form-control default" type="text" placeholder="Category Name" value="{{ old('category_name') }}" required>
                                            </div>

                                            <label for="status" class="form-label mt-2 row mt-4">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>

                                            <label for="short_description" class="form-label mt-2 row mt-4">Description</label>
                                            <div class="form-group mb-0">
                                                <textarea id="short_description" name="short_description" class="form-control m-0" cols="30" rows="4" placeholder="Description" value="{{ old('short_description') }}"></textarea>
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