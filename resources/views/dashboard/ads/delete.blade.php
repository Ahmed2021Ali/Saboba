<!-- Delete Category Modal -->
<div class="modal fade" id="deleteCategoryModal{{ $ad->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryModalLabel">{{ __('admin_dashboard/ads/messages.reject') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                {{ __('admin_dashboard/ads/messages.sure_delete') }} <span style="color: red">{{ $ad->name }}</span>
            </div>

            <div class="modal-footer">
                <form action="{{ route('ads.destroy', $ad) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>  {{ __('admin_dashboard/ads/messages.reason_reject') }}  </label>
                            <textarea type="text" name="reason" class="form-control" required></textarea>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin_dashboard/ads/messages.close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('admin_dashboard/ads/messages.reject') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
