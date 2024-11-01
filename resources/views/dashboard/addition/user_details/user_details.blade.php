<div class="modal fade" id="user_details{{$moduleId}}" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">  {{ __('admin_dashboard/verification/messages.details') }}  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="scrollable">
                        @if($user->getFirstMediaUrl('userImages'))
                            <div style="text-align: center;">
                            <img src="{{$user->getFirstMediaUrl('userImages')}}" alt="company Image" width="200" height="150" style="text-align: center">
                            </div>
                        @else
                            <div style="text-align: center;">
                            <img src="https://marketplace.canva.com/EAE0rNNM2Fg/1/0/1600w/canva-letter-c-trade-marketing-logo-design-template-r9VFYrbB35Y.jpg" alt="company Image" width="200" height="150" >
                            </div>
                        @endif
                        <h4> {{ __('admin_dashboard/verification/messages.name') }}  : {{$user->name}} </h4>
                        <h4> {{ __('admin_dashboard/verification/messages.email') }}  : {{$user->email}} </h4>
                            @if($user->overview)
                                <h4> {{ __('admin_dashboard/verification/messages.overview') }}  : {{$user->overview}} </h4>
                            @endif
                        <h4> {{ __('admin_dashboard/verification/messages.country') }}  : {{$user->country->name}} </h4>
                        <h4> {{ __('admin_dashboard/verification/messages.number_contact') }}  : {{$user->contact_number}} </h4>
                        <h4>  {{ __('admin_dashboard/verification/messages.whatsApp_number') }}  : {{$user->whatsapp_number}} </h4>

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
