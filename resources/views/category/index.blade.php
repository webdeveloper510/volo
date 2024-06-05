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
                                                <td></td>
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

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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