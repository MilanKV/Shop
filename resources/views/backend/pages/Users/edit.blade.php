@extends('backend.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="column col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div class="title">
                                <h5 class="mb-0">Edit user</h5>
                            </div>
                            <div class="card-action my-auto mt-4 ms-auto mt-lg-0">
                                <a href="{{route('user.index')}}" class="btn btn-outline mb-0">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('user.update', ['user' => $user ])}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row row-create mt-4">
                                <div class="column-left col-lg-4">
                                    <div class="image-card h-100">
                                        <div class="body">
                                            <h5>User Image</h5>
                                            <div class="row">
                                                <div class="image">
                                                    <img class="mt-3 w-100" src="{{ old('image') ? asset('storage/' . old('image')) : ($user->image ? (Str::startsWith($user->image, 'https') ? $user->image : asset('storage/' . $user->image)) : 'https://st2.depositphotos.com/1104517/11965/v/950/depositphotos_119659092-stock-illustration-male-avatar-profile-picture-vector.jpg') }}" alt="user_image">
                                                </div>
                                                <div class="action mt-4 col-12">
                                                    <div class="d-flex">
                                                        <button class="btn btn-add mb-0 me-2" type="button" name="add">Add</button>
                                                        <input type="file" style="display: none;" name="image" id="add-image" value="{{ old('image') }}" accept="image/*">
                                                        <button class="btn btn-outline mb-0" type="button" name="remove" data-context="user-management">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="column-right mt-4 col-lg-8 mt-lg-0">
                                    <div class="input-card">
                                        <div class="body">
                                            <h5>User Information</h5>
                                            <label for="name" class="form-label mt-2 row mt-4">Name</label>
                                            <div class="form-group mb-0">
                                                <input id="name" name="name" class="form-control default" type="text" placeholder="Your Name" value="{{ old('name', $user->name) }}">
                                            </div>

                                            <label for="email" class="form-label mt-2 row mt-4">Email</label>
                                            <div class="form-group mb-0">
                                                <input id="email" name="email" class="form-control default" type="email" placeholder="Your Email" value="{{ old('email', $user->email) }}">
                                            </div>

                                            <label for="role" class="form-label mt-2 row mt-4">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="">--Select Role--</option>
                                                <option value="superadmin" {{ $user->role == \App\Enums\RoleType::SUPERADMIN ? 'selected' : '' }}>Superadmin</option>
                                                <option value="admin" {{ $user->role == \App\Enums\RoleType::ADMIN ? 'selected' : '' }}>Admin</option>
                                                <option value="user" {{ $user->role == \App\Enums\RoleType::USER ? 'selected' : '' }}>User</option>
                                            </select>

                                            <label for="password" class="form-label mt-2 row mt-4">Password</label>
                                            <div class="form-group mb-0">
                                                <input id="password" name="password" class="form-control default" type="password" placeholder="Password">
                                            </div>

                                            <label for="password-confirm" class="form-label mt-2 row mt-4">Confirm Password</label>
                                            <div class="form-group mb-0">
                                                <input id="password-confirm" name="password_confirmation" class="form-control default" type="password" placeholder="Confirm Password">
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