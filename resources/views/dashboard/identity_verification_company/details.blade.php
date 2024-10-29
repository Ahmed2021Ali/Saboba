<div class="modal fade" id="imageModal_details_{{$verification->id}}" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">  تفاصيل الموسسة  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="scrollable">
                        <h4> اسم  : {{$verification->user->name}} </h4>
                        <h4> الاميل  : {{$verification->user->email}} </h4>
                        <h4> نبذة  : {{$verification->user->overview}} </h4>
                        <h4> دولة  : {{$verification->user->country->name}} </h4>
                        <h4> رقم الهاتف  : {{$verification->user->contact_number}} </h4>
                        <h4> رقم الواتس  : {{$verification->user->whatsapp_number}} </h4>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .scrollable {
        width: 468px;
        height: 350px;
        padding: 10px;
        border: 2px solid #ccc;
        overflow-y: auto; /* Makes the paragraph scrollable vertically */
        background-color: #f9f9f9;
    }
</style>
