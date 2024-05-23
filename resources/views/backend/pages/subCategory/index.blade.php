@extends('backend.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="column col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div class="title">
                                <h5 class="mb-0">All Subcategories</h5>
                                <p class="title-description mb-0">View all active subcategories for easy navigation and management.</p>
                            </div>
                            <div class="card-action my-auto mt-4 ms-auto mt-lg-0">
                                <a href="{{route('subcategory.create')}}" class="btn btn-add mb-0">New SubCategory</a>
                                <a href="{{ route('subcategory.deactivated') }}" class="btn btn-outline mb-0">Deactivated</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table">
                            <div class="dataTable-header">
                                @include('backend.partials.page-selection')
                                @include('backend.partials.search-bar', ['searchRoute' => route('subcategory.index'), 'search' => $search])
                            </div>
                            @if(count($categories)>0)
                            <div class="dataTable-body">
                                <table id="product-list" class="table table-flush">
                                    <thead>
                                        <th data-sortable>
                                            <a href="{{ route('subcategory.index', ['sortColumn' => 'category_name', 'sortDirection' => $sortColumn == 'category_name' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}" class="dataTable-sorter">Name</a>
                                        </th>
                                        <th data-sortable>
                                            <a href="{{ route('subcategory.index', ['sortColumn' => 'parent_id', 'sortDirection' => $sortColumn == 'parent_id' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}" class="dataTable-sorter">Category</a>
                                        </th>
                                        <th data-sortable>
                                            <a href="{{ route('subcategory.index', ['sortColumn' => 'short_description', 'sortDirection' => $sortColumn == 'short_description' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}" class="dataTable-sorter">Description</a>
                                        </th>
                                        <th data-sortable>
                                            <a href="{{ route('subcategory.index', ['sortColumn' => 'status', 'sortDirection' => $sortColumn == 'status' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}" class="dataTable-sorter">STATUS</a>
                                        </th>
                                        <th data-sortable>
                                            <a href="#" class="dataTable-sorterF">ACTION</a>
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        @if($category->category_image)
                                                            @if(Str::startsWith($category->category_image, 'http'))
                                                                <img class="image ms-3" src="{{ $category->category_image }}" alt="{{ $category->category_image }}">
                                                            @else
                                                                <img class="image ms-3" src="{{ asset('storage/' . $category->category_image) }}" alt="{{ $category->category_image }}">
                                                            @endif
                                                        @else
                                                            <img class="image ms-3" src="data:image/jpeg;base64,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">
                                                        @endif
                                                        <h6 class="my-auto ms-3">{{ $category->category_name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-sm">
                                                    @if($category->parent_id !== null && $category->parentCategory)
                                                        {{ $category->parentCategory->category_name }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="text-sm">{{ $category->short_description }}</td>
                                                <td>
                                                    @if($category->status === \App\Enums\CategoryStatus::ACTIVE)
                                                        <span class="badge badge-success">{{ $category->status }}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ $category->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-sm">
                                                    <div class="action-btn">
                                                        <a href="{{ route('subcategory.edit', ['category' => $category]) }}" data-bs-toggle="tooltip" data-bs-original-title="Edit subcategory">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512" fill="#344767"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                                                        </a>

                                                        <form id="deleteForm{{$category->id}}" method="POST" action="{{ route('subcategory.destroy', $category->id) }}" style="display: none;">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                        <a href="#" class="deleteBtn" data-id="{{ $category->id }}" data-bs-toggle="tooltip" data-bs-original-title="Delete subcategory">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 448 512" fill="#344767"><path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @include('backend.partials.pagination', ['items' => $categories])
                            @else
                                <div class="no-item-found d-flex justify-content-center align-items-center">
                                    <p class="text-center">No subcategories were found.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection