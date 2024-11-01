<!-- Delete Category Modal -->
<div class="modal fade" id="block_user_id{{ $reportAd->id }}" tabindex="-1" role="dialog" aria-labelledby="block_user_id" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryModalLabel">حظر المستخدم </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('blocked_user.destroy', $reportAd->ad->user) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body" style="text-align: center">
                    <h3>{{ __('admin_dashboard/ads/messages.sure_delete') }} <span style="color: red">{{ $reportAd->ad->user->name }}</span></h3>
                </div>
                <div class="modal-body">
                    <label>  سبب الحظر  </label>
                    <textarea type="text" name="reason" class="form-control" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق </button>
                    <button type="submit" class="btn btn-danger">حظر المستخدم </button>
                </div>
            </form>

        </div>
    </div>
</div>
