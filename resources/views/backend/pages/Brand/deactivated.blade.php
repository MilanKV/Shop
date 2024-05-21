@extends('backend.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="column col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div class="title">
                                <h5 class="mb-0">Deactivated Brands</h5>
                                <p class="title-description mb-0">Brands that are currently inactive but can be restored as needed.</p>
                            </div>
                            <div class="card-action my-auto mt-4 ms-auto mt-lg-0">
                                <a href="{{route('brand.index')}}" class="btn btn-outline mb-0">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table">
                            @if(count($brands)>0)
                            <div class="dataTable-header">
                                @include('backend.partials.page-selection')
                            </div>
                            <div class="dataTable-body">
                                <table id="brand-list" class="table table-flush">
                                    <thead>
                                        <th data-sortable>
                                            <a href="#" class="dataTable-sorter">Name</a>
                                        </th>
                                        <th data-sortable>
                                            <a href="#" class="dataTable-sorter">Slug</a>
                                        </th>
                                        <th data-sortable>
                                            <a href="#" class="dataTable-sorter">STATUS</a>
                                        </th>
                                        <th data-sortable>
                                            <a href="#" class="dataTable-sorter">Deleted At</a>
                                        </th>
                                        <th data-sortable="false">
                                            <a href="#" class="dataTable-sorterF">ACTION</a>
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach($brands as $brand)
                                            <tr>
                                                <td class="text-sm">{{ $brand->brand_name }}</td>
                                                <td class="text-sm">{{ $brand->slug }}</td>
                                                <td>
                                                    @if($brand->status === \App\Enums\BrandStatus::ACTIVE)
                                                        <span class="badge badge-success">{{ $brand->status }}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ $brand->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-sm">{{ $brand->deleted_at }}</td>
                                                <td class="text-sm">
                                                    <a href="{{ route('brand.restore', $brand->id)}}" class="btn btn-success p-2 rounded" data-bs-toggle="tooltip" data-bs-original-title="Restore brand">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff"><path d="M10 11H7.101l.001-.009a4.956 4.956 0 0 1 .752-1.787 5.054 5.054 0 0 1 2.2-1.811c.302-.128.617-.226.938-.291a5.078 5.078 0 0 1 2.018 0 4.978 4.978 0 0 1 2.525 1.361l1.416-1.412a7.036 7.036 0 0 0-2.224-1.501 6.921 6.921 0 0 0-1.315-.408 7.079 7.079 0 0 0-2.819 0 6.94 6.94 0 0 0-1.316.409 7.04 7.04 0 0 0-3.08 2.534 6.978 6.978 0 0 0-1.054 2.505c-.028.135-.043.273-.063.41H2l4 4 4-4zm4 2h2.899l-.001.008a4.976 4.976 0 0 1-2.103 3.138 4.943 4.943 0 0 1-1.787.752 5.073 5.073 0 0 1-2.017 0 4.956 4.956 0 0 1-1.787-.752 5.072 5.072 0 0 1-.74-.61L7.05 16.95a7.032 7.032 0 0 0 2.225 1.5c.424.18.867.317 1.315.408a7.07 7.07 0 0 0 2.818 0 7.031 7.031 0 0 0 4.395-2.945 6.974 6.974 0 0 0 1.053-2.503c.027-.135.043-.273.063-.41H22l-4-4-4 4z"></path></svg>
                                                    </a>
                                                    <form id="deleteForm{{$brand->id}}" method="POST" action="{{ route('brand.delete-permanent', ['id' => $brand->id]) }}" style="display: none;">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    <a href="#" class="deleteBtn btn btn-danger p-2 rounded" data-id="{{ $brand->id }}" data-bs-toggle="tooltip" data-bs-original-title="Permanent Deletes">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="#fff"><path d="M9.172 16.242 12 13.414l2.828 2.828 1.414-1.414L13.414 12l2.828-2.828-1.414-1.414L12 10.586 9.172 7.758 7.758 9.172 10.586 12l-2.828 2.828z"></path><path d="M12 22c5.514 0 10-4.486 10-10S17.514 2 12 2 2 6.486 2 12s4.486 10 10 10zm0-18c4.411 0 8 3.589 8 8s-3.589 8-8 8-8-3.589-8-8 3.589-8 8-8z"></path></svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <div class="no-item-found d-flex justify-content-center align-items-center">
                                    <p class="text-center">No deactivated brands were found.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection