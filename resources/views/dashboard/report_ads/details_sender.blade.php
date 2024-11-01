<div class="modal fade" id="imageModal_details_{{$reportAd->id}}" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">
                    تفاصيل المرسل
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="scrollable">
                        @if($reportAd->sender->getFirstMediaUrl('userImages'))
                            <div style="text-align: center;">
                            <img src="{{$verification->sender->getFirstMediaUrl('userImages')}}" alt="company Image" width="200" height="150" style="text-align: center">
                            </div>
                        @else
                            <div style="text-align: center;">
                            <img src="https://marketplace.canva.com/EAE0rNNM2Fg/1/0/1600w/canva-letter-c-trade-marketing-logo-design-template-r9VFYrbB35Y.jpg" alt="company Image" width="200" height="150" >
                            </div>
                        @endif

                        <h4> {{ __('admin_dashboard/verification/messages.name') }}  : {{$reportAd->sender->name}} </h4>
                        <h4> {{ __('admin_dashboard/verification/messages.email') }}  : {{$reportAd->sender->email}} </h4>
                        <h4> {{ __('admin_dashboard/verification/messages.overview') }}  : {{$reportAd->sender->overview}} </h4>
                        <h4> {{ __('admin_dashboard/verification/messages.country') }}  : {{$reportAd->sender->country->name}} </h4>
                        <h4> {{ __('admin_dashboard/verification/messages.number_contact') }}  : {{$reportAd->sender->contact_number}} </h4>
                        <h4>  {{ __('admin_dashboard/verification/messages.whatsApp_number') }}  : {{$reportAd->sender->whatsapp_number}} </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .scrollable {
        width: 468px;
        height: 400px;
        padding: 10px;
        border: 2px solid #ccc;
        overflow-y: auto; /* Makes the paragraph scrollable vertically */
        background-color: #f9f9f9;
    }
</style>
