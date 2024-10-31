<!-- Edit Category Modal -->
<div class="modal fade" id="notify_edit{{ $ad->id }}" tabindex="-1" role="dialog" aria-labelledby="notify_edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel"> اشعار بالتعديل  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('notify_edit', $ad) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <br>
                <h3 class="text-center"> اعلان  {{$ad->name}}</h3>
                <div class="modal-body">
                    <div class="form-group">
                        <label> رسالة التعديل  </label>
                        <textarea type="text" name="name" class="form-control" required></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary"> التأكيد الارسال  </button>
                </div>
            </form>
        </div>
    </div>
</div>
