<div class="modal fade" id="imageModal_details_{{$verification->id}}" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel"> محتوي البوست </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="scrollable">
                        <p>
                            {{$verification->user->name}}
                        </p>
                        <h6> اسم الموسسة : {{$verification->user->name}} </h6>
                        <h6> الاميل الموسسة : {{$verification->user->email}} </h6>
                        <h6> نبذة الموسسة : {{$verification->user->overview}} </h6>
                        <h6> دولة الموسسة : {{$verification->user->country->name}} </h6>
                        <h6> رقم الهاتف الموسسة : {{$verification->user->contact_number}} </h6>
                        <h6> رقم الواتس الموسسة : {{$verification->user->whatsapp_number}} </h6>

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
