<div class="modal fade" id="delete_latest_news_{{$verification->id}}" tabindex="-1" role="dialog"
     aria-labelledby="verticalModalTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verticalModalTitle">تاكيد الحذف </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" action="{{ route('verifications.destroy', $verification) }}" style="display:inline">

                @csrf
                @method('DELETE')
                <br>
                <h4 style="text-align: center"> اذكر سبب رفض الاثبات الموسسة  {{$verification->user->name}}</h4>
                <br>
                <div class="form-group">
                    <textarea class="form-control" name="reason" id="message-text"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn mb-2 btn-primary ">تاكيد الرفض</button>
                </div>
            </form>
        </div>
    </div>
</div>
