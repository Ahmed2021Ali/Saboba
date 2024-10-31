@extends('dashboard.layouts.master')

@section('title', ' الاعلانات ')

@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title"> {{ __('admin_dashboard/ads/messages.show_all_ads') }}</h2>
                    {{--                    <div class="pull-right mb-2">
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#createCategoryModal">
                                                <i class="fa fa-plus"></i> إضافة فئة رائيسية
                                            </button>

                                        </div>--}}


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
                    <a class="btn btn-primary btn-lg" href="{{route('ads.create')}}">اضافة اعلان </a>
                    <div class="row my-4">
                        <div class="col-md-12">

                            <div class="card shadow">
                                <div class="card-body">
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('admin_dashboard/ads/messages.category_ads') }}</th>
                                            <th> {{ __('admin_dashboard/ads/messages.city') }}</th>
                                            <th> {{ __('admin_dashboard/ads/messages.status') }}</th>
                                            <th>  {{ __('admin_dashboard/ads/messages.show_ad_details') }}</th>
                                            <th>{{ __('admin_dashboard/ads/messages.operations') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($ads as $key => $ad)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $ad->category->name ?? "no" }}</td>
                                                <td>{{ $ad->city->name ?? "no" }}</td>
                                                <td>
                                                    {{ $ad->status ===0 ?  __('admin_dashboard/ads/messages.not_approve')  : __('admin_dashboard/ads/messages.approve') }}
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-info" href="{{route('ads.show',$ad)}}">
                                                        <i class="fa-solid fa-list"></i> {{ __('admin_dashboard/ads/messages.show_ad_details') }}
                                                    </a>
                                                </td>

                                                <td>

                                                    <!--  Reject Button Modal Trigger -->
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                            data-target="#deleteCategoryModal{{ $ad->id }}">
                                                        <i class="fa fa-trash"></i> {{ __('admin_dashboard/ads/messages.reject') }}
                                                    </button>
                                                    @include('dashboard.ads.delete')


                                                    <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                            data-target="#notify_edit{{ $ad->id }}">
                                                        <i class="fa fa-edit"></i> اشعار بالتعديل
                                                    </button>
                                                    @include('dashboard.ads.notify_edit',['ad'=>$ad])





                                                    {{--



                                                                                                        <!-- Edit Button Modal Trigger -->
                                                                                                       <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editCategoryModal{{ $category->id }}">
                                                                                                            <i class="fa fa-edit"></i> تعديل
                                                                                                        </button>



                                                                                                        <a class="btn btn-sm btn-info" href="{{ route('sub_categories.index', $category) }}">
                                                                                                            <i class="fa-solid fa-list"></i>  عرض الاقسام الفرعية
                                                                                                        </a>
                                                                                                        --}}
                                                </td>
                                            </tr>

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
