@extends('dashboard.layouts.master')

@section('title', 'قائمة الفئات')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">{{ __('admin_dashboard/category/messages.show_all_category') }}</h2>

                <!-- Success Messages -->
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('admin_dashboard/category/messages.name') }}</th>
                                            <th>{{ __('admin_dashboard/category/messages.operations') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $key => $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>

                                                <td>


                                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#imageModal_{{$category->id}}">
                                                        <i class="fa fa-edit"></i>  {{ __('admin_dashboard/category/messages.show_images') }}
                                                    </button>
                                                    @include('dashboard.images.index', ['model' => $category, 'folder' => 'categoryImages'])


                                                    <a class="btn btn-sm btn-info" href="{{ route('sub_categories.index', $category) }}">
                                                        <i class="fa-solid fa-list"></i>  {{ __('admin_dashboard/category/messages.show_sub_categories') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-danger">لا توجد فئات متاحة</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {!! $categories->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div>
                </div>

                <p class="text-center text-primary"><small>دليل من ItSolutionStuff.com</small></p>
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
</main>
@endsection
