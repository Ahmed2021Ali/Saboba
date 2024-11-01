@extends('dashboard.layouts.master')

@section('title', ' العناوين الرائيسية ')

@section('css')

@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title">  {{ __('admin_dashboard/report_comments/messages.Comments Reports') }} </h2>
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
                                            <th> {{ __('admin_dashboard/report_comments/messages.Sender') }}</th>
                                            <th> {{ __('admin_dashboard/report_comments/messages.Content') }}</th>
                                            <th> {{ __('admin_dashboard/report_comments/messages.Comments') }}</th>
                                            <th> {{ __('admin_dashboard/report/messages.Advertisement') }}</th>
                                            <th> {{ __('admin_dashboard/report_comments/messages.Operations') }}</th>
                                        </tr>
                                        </thead>
                                        @if($reportComments->isNotEmpty())

                                            <tbody>
                                            @foreach ($reportComments as $key => $reportComment)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#user_details{{$reportComment->id}}">
                                                            <i class="fa fa-edit"></i> {{ $reportComment->sender->name }}
                                                        </button>
                                                        @include('dashboard.addition.user_details.user_details',['moduleId'=>$reportComment->id,'user'=>$reportComment->sender])

                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#content_report{{$reportComment->id}}">
                                                            <i class="fa fa-edit"></i>{{ __('admin_dashboard/report_comments/messages.report_content') }}
                                                        </button>
                                                        @include('dashboard.addition.content.content',['moduleId'=>$reportComment->id,'content'=>$reportComment->content])
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#content_report{{$key+2}}">
                                                            <i class="fa fa-edit"></i>{{ __('admin_dashboard/report_comments/messages.comment_content') }}
                                                        </button>
                                                        @include('dashboard.addition.content.content',['moduleId'=>$key+2,'content'=>$reportComment->comment->content])

                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info"
                                                           href="{{route('ads.show',$reportComment->comment->ad)}}">
                                                            <i class="fa-solid fa-list"></i> {{ __('admin_dashboard/ads/messages.show_ad_details') }}
                                                        </a>
                                                    </td>

                                                    <td>

                                                        {{-- حظر مستخدم صاحب التعليق + اشعار  --}}
                                                        <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                                data-target="#block_user{{$reportComment->comment->user->id}}">
                                                            <i class="fa fa-trash"></i> {{ __('admin_dashboard/report_comments/messages.Block the Comment user') }}
                                                        </button>
                                                        @include('dashboard.addition.block.block_user',['moduleId'=>$reportComment->comment->user->id,'user'=>$reportComment->comment->user,'message'=>  __('admin_dashboard/report_comments/messages.Block the Comment user') ])


                                                        {{-- رسالة تحذير  لصاحب التعليق  --}}
                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#notify_sender{{$reportComment->comment->user->id}}">
                                                            <i class="fa fa-trash"></i> {{ __('admin_dashboard/report_comments/messages.Warning message to the commenter') }}
                                                        </button>
                                                        @include('dashboard.addition.notify.notify',['moduleId'=>$reportComment->comment->user->id,'user'=>$reportComment->comment->user,'message'=> __('admin_dashboard/report_comments/messages.Warning message to the commenter') ])


                                                        {{-- اشعار رد لصاحب الابلاغ  --}}
                                                        <button class="btn btn-sm btn-secondary" data-toggle="modal"
                                                                data-target="#notify_sender{{$reportComment->sender_id}}">
                                                            <i class="fa fa-trash"></i> {{ __('admin_dashboard/report_comments/messages.Notification to the complainant') }}
                                                        </button>
                                                        @include('dashboard.addition.notify.notify',['moduleId'=>$reportComment->sender_id,'user'=>$reportComment->sender,'message'=>  __('admin_dashboard/report_comments/messages.Notification to the complainant')  ])

                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        @else
                                            <h3 class="text-center">{{ __('admin_dashboard/report_comments/messages.No reports') }}</h3>
                                        @endif
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
