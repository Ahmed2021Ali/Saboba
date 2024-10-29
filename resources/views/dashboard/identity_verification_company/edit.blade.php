<div class="modal fade" id="edit_latest_news_{{$verification->id}}" tabindex="-1" role="dialog"
     aria-labelledby="varyModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">تحديث الدولة </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('verifications.update',$verification)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <div class="form-group">
                        <label for="message-text" class="col-form-label"> سبب الرفض   </label>
                        <textarea class="form-control" name="name" id="message-text"> </textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn mb-2 btn-primary">  تأكيد  </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

