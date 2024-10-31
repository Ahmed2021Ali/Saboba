<!-- Edit Category Modal -->
<div class="modal fade" id="notify_edit{{ $ad->id }}" tabindex="-1" role="dialog" aria-labelledby="notify_edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel"> {{ __('admin_dashboard/ads/messages.notify_edit') }}  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('notify_edit', $ad) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <br>
                <h3 class="text-center"> {{ __('admin_dashboard/ads/messages.ad') }}  {{$ad->name}}</h3>
                <div class="modal-body">
                    <div class="modal-body">
                    <div class="form-group">
                        <label>  {{ __('admin_dashboard/ads/messages.reason_edit') }}  </label>
                        <textarea type="text" name="reason" class="form-control" required></textarea>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin_dashboard/ads/messages.close') }}</button>
                    <button type="submit" class="btn btn-primary"> {{ __('admin_dashboard/ads/messages.notify_edit') }}  </button>
                </div>
            </form>
        </div>
    </div>
</div>
