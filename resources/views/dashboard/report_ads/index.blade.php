@extends('dashboard.layouts.master')

@section('title', ' العناوين الرائيسية ')

@section('css')

@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title"> ابلاغات الاعلانات </h2>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
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
                                            <th> مرسل</th>
                                            <th> محتوي</th>
                                            <th> الاعلان</th>
                                            <th> العمليات</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($reportAds as $key => $reportAd)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-success" data-toggle="modal"
                                                            data-target="#imageModal_details_{{$reportAd->id}}">
                                                        <i class="fa fa-edit"></i>{{ $reportAd->sender->name }}
                                                    </button>
                                                    @include('dashboard.report_ads.details_sender',['reportAd'=>$reportAd])
                                                </td>
                                                <td>{{ $reportAd->content }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-info"
                                                       href="{{route('ads.show',$reportAd->ad)}}">
                                                        <i class="fa-solid fa-list"></i> {{ __('admin_dashboard/ads/messages.show_ad_details') }}
                                                    </a>
                                                </td>

                                                <td>

                                                    {{-- حذف الاعلان + اشعار لصاحب الاعلان --}}
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                            data-target="#deleteCategoryModal{{ $reportAd->ad_id }}">
                                                        <i class="fa fa-trash"></i> {{ __('admin_dashboard/ads/messages.reject') }}
                                                    </button>
                                                    @include('dashboard.report_ads.delete_ad')


                                                    {{-- حظر مستخدم صاحب الاعلان + اشعار  --}}
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                            data-target="#block_user_id{{ $reportAd->id }}">
                                                        <i class="fa fa-trash"></i> حظر مستخدم صاحب الاعلان
                                                    </button>
                                                    @include('dashboard.report_ads.block_user_ad')

                                                    {{--                                                      {{-- رسالة تحذير  --}}
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                            data-target="#notify_user_ads{{ $reportAd->id  }}">
                                                        <i class="fa fa-trash"></i> رسالة تحذيرية لصاحب الاعلان
                                                    </button>
                                                    @include('dashboard.report_ads.notify_user_ads')

                                                    {{-- اشعار رد لصاحب الابلاغ  --}}
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                            data-target="#notify_sender{{ $reportAd->id }}">
                                                        <i class="fa fa-trash"></i> اشعار لصاحب الابلاغ
                                                    </button>
                                                    @include('dashboard.report_ads.notify_sender')
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{--
                                                                        {!! $subAddresses->links/*('pagination::bootstrap-5')*/ !!}
                                    --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-center text-primary"><small>دليل من ItSolutionStuff.com</small></p>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')

@endsection
