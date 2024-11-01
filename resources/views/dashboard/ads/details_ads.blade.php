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
                            <h2 class="h5 page-title"><small class="text-muted text-uppercase">{{ __('admin_dashboard/ads/messages.reference_number') }}</small><br>#{{$ad->reference_number}}</h2>
                        </div>

                        <div class="col-auto">
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#imageModal_{{$ad->id}}">
                                <i class="fa fa-edit"></i>  {{ __('admin_dashboard/ads/messages.show_images') }}
                            </button>
                            @include('dashboard.images.index', ['model' => $ad, 'folder' => 'ad_images'])

                            <button class="btn btn-success" data-toggle="modal" data-target="#imageModal_{{$ad->id}}">
                                <i class="fa fa-edit"></i>  {{ __('admin_dashboard/ads/messages.show_reals') }}
                            </button>
                            @include('dashboard.images.index', ['model' => $ad, 'folder' => 'reals'])
                        </div>
                    </div>


                    <div class="row my-4">
                        <div class="col-md-12">

                            {{-- Ads--}}
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">{{$ad->name ?? "null"}}</strong>
                                    <span class="float-right">
                                        <span class="badge badge-pill @if($ad->status ===0) badge-danger @else badge-success  @endif text-white"> {{ $ad->status ===0 ?  __('admin_dashboard/ads/messages.not_approve')  : __('admin_dashboard/ads/messages.approve') }}</span>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <dl class="row align-items-center mb-0">
                                        <dt class="col-sm-2 mb-3">{{ __('admin_dashboard/ads/messages.department') }}</dt>
                                        <dd class="col-sm-4 mb-3">
                                            <strong>{{$ad->category->name ?? "null"}}</strong>
                                        </dd>

                                        <dt class="col-sm-2 mb-3">{{ __('admin_dashboard/ads/messages.assigned_to') }} </dt>
                                        <dd class="col-sm-4 mb-3">
                                            <strong>{{$ad->user->name??"null"}}</strong>
                                        </dd>
                                    </dl>
                                    <dl class="row mb-0">
                                        <dt class="col-sm-2 mb-3">{{ __('admin_dashboard/ads/messages.city') }}</dt>
                                        <dd class="col-sm-4 mb-3">{{$ad->city->name??"null"}}</dd>

                                        <dt class="col-sm-2 mb-3">{{ __('admin_dashboard/ads/messages.price') }}</dt>
                                        <dd class="col-sm-4 mb-3">{{$ad->price??"null"}}</dd>

                                        <dt class="col-sm-2 mb-3">{{ __('admin_dashboard/ads/messages.create_on') }}</dt>
                                        <dd class="col-sm-4 mb-3">{{$ad->crated_at??"null"}}</dd>

                                        <dt class="col-sm-2 mb-3">{{ __('admin_dashboard/ads/messages.status') }}</dt>
                                        <dd class="col-sm-4 mb-3">{{ $ad->status ===0 ?  __('admin_dashboard/ads/messages.not_approve')  : __('admin_dashboard/ads/messages.approve') }}</dd>

                                        <dt class="col-sm-2 ">{{ __('admin_dashboard/ads/messages.description') }}</dt>
                                        <dd class="col-sm-10">{{$ad->description??"null"}} </dl>
                                </div>
                            </div>

                            {{-- Ads Filds--}}
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">{{ __('admin_dashboard/ads/messages.ad_filed_Addition') }}</strong>
                                    <span class="float-right"><span class="badge badge-pill @if($ad->status ===0) badge-danger @else badge-success  @endif text-white">  {{ $ad->status ===0 ?  __('admin_dashboard/ads/messages.not_approve')  : __('admin_dashboard/ads/messages.approve') }}</span></span>
                                </div>
                                <div class="card-body">
                                    <dl class="row align-items-center mb-0">
                                        @foreach($ad->adFields(Config::get('app.locale')) as $adFiled)
                                            <dt class="col-sm-2 mb-3 ">{{$adFiled->field_name??"null"}}</dt>
                                            <dd class="col-sm-4 mb-3"><strong>{{$adFiled->field_value??"null"}}</strong></dd>
                                       @endforeach

                                </div>
                            </div>

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </main>

@endsection
