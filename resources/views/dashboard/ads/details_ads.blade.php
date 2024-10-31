@extends('dashboard.layouts.master')

@section('title', ' تفاصيل الاعلان')

@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">

                    {{-- Refernce Number--}}
                    <div class="row align-items-center mb-4">
                        <div class="col">
                            <h2 class="h5 page-title"><small class="text-muted text-uppercase">Reference Number</small><br>#{{$ad->reference_number}}</h2>
                        </div>

                        <div class="col-auto">
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#imageModal_{{$ad->id}}">
                                <i class="fa fa-edit"></i> Images
                            </button>
                            @include('dashboard.images.index', ['model' => $ad, 'folder' => 'ad_images'])

                            <button class="btn btn-success" data-toggle="modal" data-target="#imageModal_{{$ad->id}}">
                                <i class="fa fa-edit"></i> Reals
                            </button>
                            @include('dashboard.images.index', ['model' => $ad, 'folder' => 'reals'])
                        </div>
                    </div>


                    <div class="row my-4">
                        <div class="col-md-12">

                            {{-- Ads--}}
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">{{$ad->name}}</strong>
                                    <span class="float-right"><i class="fe fe-flag mr-2"></i>
                                        @if ($ad->status ===0)
                                            <span class="badge badge-pill badge-danger text-white">  {{__('admin_dashboard/ads/messages.not_approve')}}</span>
                                        @else
                                            <span class="badge badge-pill badge-success text-white"> {{__('admin_dashboard/ads/messages.approve') }}}}</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="card-body">
                                    <dl class="row align-items-center mb-0">
                                        <dt class="col-sm-2 mb-3 text-muted">Department</dt>
                                        <dd class="col-sm-4 mb-3">
                                            <strong>{{$ad->category->name}}</strong>
                                        </dd>
                                        <dt class="col-sm-2 mb-3 text-muted">Assigned to</dt>
                                        <dd class="col-sm-4 mb-3">
                                            <strong>{{$ad->user->name}}</strong>
                                        </dd>
                                    </dl>
                                    <dl class="row mb-0">
                                        <dt class="col-sm-2 mb-3 text-muted">City</dt>
                                        <dd class="col-sm-4 mb-3">{{$ad->city->name}}</dd>

                                        <dt class="col-sm-2 mb-3 text-muted">Price</dt>
                                        <dd class="col-sm-4 mb-3">{{$ad->price}}</dd>

                                        <dt class="col-sm-2 mb-3 text-muted">Created On</dt>
                                        <dd class="col-sm-4 mb-3">{{$ad->crated_at}}</dd>

                                        <dt class="col-sm-2 mb-3 text-muted">Status</dt>
                                        <dd class="col-sm-4 mb-3">{{ $ad->status ===0 ?  __('admin_dashboard/ads/messages.not_approve')  : __('admin_dashboard/ads/messages.approve') }}</dd>

                                        <dt crlass="col-sm-2 text-muted">Description</dt>
                                        <dd class="col-sm-10">{{$ad->description}} </dl>
                                </div>
                            </div>

                            {{-- Ads Filds--}}
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">Ad Filed Additions</strong>
                                    <span class="float-right"><i class="fe fe-flag mr-2"></i>
                                        @if ($ad->status ===0)
                                            <span class="badge badge-pill badge-danger text-white">  {{__('admin_dashboard/ads/messages.not_approve')}}</span>
                                        @else
                                            <span class="badge badge-pill badge-success text-white"> {{__('admin_dashboard/ads/messages.approve') }}}}</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="card-body">
                                    <dl class="row align-items-center mb-0">
                                        @foreach($ad->adFields('en') as $adFiled)
                                            <dt class="col-sm-2 mb-3 text-muted">{{$adFiled->field_name}}</dt>
                                            <dd class="col-sm-4 mb-3">
                                                <strong>{{$adFiled->field_value}}</strong>
                                            </dd>
                                    @endforeach

                                </div>
                            </div>

                        </div>

                    </div>


                </div>
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </main>

@endsection
