@extends('layouts.admin')
@section('page-title')
{{__('Categories')}}
@endsection
@section('title')
<div class="page-header-title">
    {{__('Categories')}}
</div>
@endsection
@section('action-btn')
<a href="#" data-bs-toggle="modal" data-bs-target="#createCategoryModal" data-bs-toggle="tooltip" data-title="{{__('Create category')}}" title="{{__('Create')}}" class="btn btn-sm btn-primary btn-icon m-1">
    <i class="ti ti-plus"></i>
</a>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item">{{__('Categories')}}</li>
@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12 p0">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="sort">{{__('Sr No.')}} <span class="opticy"></span></th>
                                                <th scope="col" class="sort" data-sort="name">{{__('Category Name')}} <span class="opticy"></span></th>
                                                <th scope="col" class="sort">{{__('Created On')}}<span class="opticy"></span></th>
                                                <th scope="col" class="sort">{{__('Action')}} <span class="opticy"></span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($allCategory as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$category->name}}</td>
                                                <td>{{ $category->created_at->format('F j, Y') }}</td>
                                                <td>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="javascript:void(0);" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white edit-category-btn" data-bs-toggle="tooltip" title='Edit' data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                    </div>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <a href="javascript:void(0);" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white delete-category-btn" data-bs-toggle="tooltip" title='Delete' data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">{{ __('Create Category') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="message" class="alert" style="display: none;"></div>
                <form id="createCategoryForm">
                    @csrf
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">{{ __('Category Name') }}</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">{{ __('Edit Category') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm" action="{{ route('category.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="editCategoryId">
                    <div class="form-group">
                        <label for="editCategoryName">Category Name</label>
                        <input type="text" class="form-control" id="editCategoryName" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script-page')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#createCategoryForm').on('submit', function(e) {
            e.preventDefault();

            let categoryName = $('#categoryName').val();

            $.ajax({
                url: '{{ route("categories.create") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    categoryName: categoryName
                },
                success: function(response) {
                    if (response.status === 200) {
                        $('#message').removeClass().addClass('alert alert-success').text(response.message).show();
                        setTimeout(function() {
                            $('#createCategoryModal').modal('hide');
                            location.reload();
                        }, 2000);
                    } else if (response.status === 400) {
                        $('#message').removeClass().addClass('alert alert-danger').text(response.message).show();
                    }
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.edit-category-btn').on('click', function() {
            var categoryId = $(this).data('id');
            var categoryName = $(this).data('name');

            $('#editCategoryId').val(categoryId);
            $('#editCategoryName').val(categoryName);

            $('#editCategoryModal').modal('show');
        });
    });
</script>

<script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        $('.delete-category-btn').on('click', function() {
            var categoryId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This category will be marked as deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#ff3a6e',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('category.destroy') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: categoryId
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.success,
                                    'success'
                                );
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                toastr.error(response.error);
                            }
                        },
                        error: function() {
                            toastr.error('Error marking category as deleted.');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush