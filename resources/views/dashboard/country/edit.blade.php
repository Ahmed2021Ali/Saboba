<div class="modal fade" id="edit_latest_news_{{$country->id}}" tabindex="-1" role="dialog"
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
                <form action="{{route('country.update',$country)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <div class="form-group">
                        <label for="message-text" class="col-form-label"> اسم الدولة </label>
                        <textarea class="form-control" name="name" id="message-text">{{$country->name}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="files">الصور</label>
                        <input type="file" name="image" id="files" class="form-control" multiple accept="image/*">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn mb-2 btn-primary"> تحديث الدولة </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
