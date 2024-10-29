@extends('dashboard.layouts.master')

@section('title', 'قائمة الفئات')

@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title">قائمة الفئات</h2>
                    <div class="pull-right mb-2">
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#createCategoryModal">
                            <i class="fa fa-plus"></i> إضافة فئة رائيسية
                        </button>

                    </div>


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
                                            <th>اسم الفئة</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($ads as $key => $ad)
                                            <tr>
                                                <td>{{ $ad->id }}</td>
                                                <td>{{ $ad->name }}</td>

                                                <td>
                                                    {{--

                                                                                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#imageModal_{{$category->id}}">
                                                                                                            <i class="fa fa-edit"></i> عرض صور
                                                                                                        </button>
                                                                                                        @include('dashboard.images.index', ['model' => $category, 'folder' => 'categoryImages'])


                                                                                                        <!-- Edit Button Modal Trigger -->
                                                                                                       <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editCategoryModal{{ $category->id }}">
                                                                                                            <i class="fa fa-edit"></i> تعديل
                                                                                                        </button>

                                                                                                        <!-- Delete Button Modal Trigger -->
                                                                                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteCategoryModal{{ $category->id }}">
                                                                                                            <i class="fa fa-trash"></i> حذف
                                                                                                        </button>

                                                                                                        <a class="btn btn-sm btn-info" href="{{ route('sub_categories.index', $category) }}">
                                                                                                            <i class="fa-solid fa-list"></i>  عرض الاقسام الفرعية
                                                                                                        </a>--}}
                                                </td>
                                            </tr>
                                            {{--                                            @include('dashboard.categories.delete')

                                                                                     @include('dashboard.categories.edit')--}}


                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-danger">لا توجد فئات متاحة</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
{{--
                                    {!! $categories->links('pagination::bootstrap-5') !!}
--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="text-center text-primary"><small>دليل من ItSolutionStuff.com</small></p>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </main>

    {{--
    @include('dashboard.categories.create')
    --}}

@endsection
