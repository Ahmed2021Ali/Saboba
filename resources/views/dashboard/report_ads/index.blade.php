@extends('dashboard.layouts.master')

@section('title', ' العناوين الرائيسية ')

@section('css')

@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title">  {{ __('admin_dashboard/report/messages.Advertisements Reports') }} </h2>
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
                                            <th> {{ __('admin_dashboard/report/messages.Sender') }}</th>
                                            <th> {{ __('admin_dashboard/report/messages.Content') }}</th>
                                            <th> {{ __('admin_dashboard/report/messages.Advertisement') }}</th>
                                            <th> {{ __('admin_dashboard/report/messages.Operations') }}</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($reportAds->isNotEmpty())
                                            @foreach ($reportAds as $key => $reportAd)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#user_details{{$reportAd->id}}">
                                                            <i class="fa fa-edit"></i> {{ $reportAd->sender->name }}
                                                        </button>
                                                        @include('dashboard.addition.user_details.user_details',['moduleId'=>$reportAd->id,'user'=>$reportAd->sender])
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#content_report{{$reportAd->id}}">
                                                            <i class="fa fa-edit"></i>{{ __('admin_dashboard/report_comments/messages.report_content') }}
                                                        </button>
                                                        @include('dashboard.addition.content.content',['moduleId'=>$reportAd->id,'content'=>$reportAd->content])
                                                    </td>
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
                                                            <i class="fa fa-trash"></i> {{ __('admin_dashboard/report/messages.Delete Ad') }}
                                                        </button>
                                                        @include('dashboard.report_ads.delete_ad')


                                                        {{-- حظر مستخدم صاحب الاعلان + اشعار  --}}
                                                        <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                                data-target="#block_user{{$reportAd->ad->user->id}}">
                                                            <i class="fa fa-trash"></i> {{ __('admin_dashboard/report/messages.Block the advertiser user') }}
                                                        </button>
                                                        @include('dashboard.addition.block.block_user',['moduleId'=>$reportAd->ad->user->id,'user'=>$reportAd->ad->user,'message'=>   __('admin_dashboard/report/messages.Block the advertiser user') ])



                                                        {{--                                                      {{-- رسالة تحذير  --}}
                                                        <button class="btn btn-sm btn-secondary" data-toggle="modal"
                                                                data-target="#notify_sender{{$reportAd->ad->user->id}}">
                                                            <i class="fa fa-trash"></i> {{  __('admin_dashboard/report/messages.Advertiser warning message') }}
                                                        </button>
                                                        @include('dashboard.addition.notify.notify',['moduleId'=>$reportAd->ad->user->id,'user'=>$reportAd->ad->user,'message'=>   __('admin_dashboard/report/messages.Advertiser warning message')  ])



                                                        {{-- اشعار رد لصاحب الابلاغ  --}}
                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#notify_sender{{$reportAd->sender_id}}">
                                                            <i class="fa fa-trash"></i> {{ __('admin_dashboard/report/messages.Notification to the complainant') }}
                                                        </button>
                                                        @include('dashboard.addition.notify.notify',['moduleId'=>$reportAd->sender_id,'user'=>$reportAd->sender,'message'=>  __('admin_dashboard/report/messages.Notification to the complainant')  ])

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <h3 class="text-center">{{ __('admin_dashboard/report_comments/messages.No reports') }}</h3>
                                        @endif
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
