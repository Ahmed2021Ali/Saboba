<!-- Delete Category Modal -->
<div class="modal fade" id="notify_sender{{ $reportAd->id }}" tabindex="-1" role="dialog"
     aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"
                    id="deleteCategoryModalLabel">{{ __('admin_dashboard/ads/messages.reject') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('ads.destroy', $reportAd->sender) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body" style="text-align: center">
                    <h3>الرد علي الابلاغ <span style="color: red">{{ $reportAd->sender->name }}</span></h3>
                </div>
                <div class="modal-body">
                    <label> اشعار </label>
                    <textarea type="text" name="reason" class="form-control" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
            </form>

        </div>
    </div>
</div>
