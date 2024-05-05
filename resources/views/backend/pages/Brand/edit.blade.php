@extends('backend.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="column col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div class="title">
                                <h5 class="mb-0">Edit brand</h5>
                            </div>
                            <div class="card-action my-auto mt-4 ms-auto mt-lg-0">
                                <a href="{{route('brand.index')}}" class="btn btn-outline mb-0">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('brand.update', ['brand' => $brand]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row row-create mt-4">
                                <div class="column-left col-lg-4">
                                    <div class="image-card h-100">
                                        <div class="body">
                                            <h5>Brand Image</h5>
                                            <div class="row">
                                                <div class="image">
                                                    <img class="mt-3 w-100" src="{{ asset('storage/' . $brand->brand_image) }}" alt="brand_image">
                                                </div>
                                                <div class="action mt-4 col-12">
                                                    <div class="d-flex">
                                                        <button class="btn btn-add mb-0 me-2" type="button" name="add">Add</button>
                                                        <input type="file" style="display: none;" name="brand_image" id="add-image" value="{{ old('brand_image') }}" accept="image/*">
                                                        <button class="btn btn-outline mb-0" type="button" name="remove">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="column-right mt-4 col-lg-8 mt-lg-0">
                                    <div class="input-card">
                                        <div class="body">
                                            <h5>Brand Information</h5>
                                            <label for="brand_name" class="form-label mt-2 row mt-4">Name</label>
                                            <div class="form-group mb-0">
                                                <input id="brand_name" name="brand_name" class="form-control default" type="text" placeholder="Brand Name" value="{{ old('brand_name', $brand->brand_name) }}" required>
                                            </div>

                                            <label for="status" class="form-label mt-2 row mt-4">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="active" {{ $brand->status == \App\Enums\BrandStatus::ACTIVE ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $brand->status == \App\Enums\BrandStatus::INACTIVE ? 'selected' : '' }}>Inactive</option>
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