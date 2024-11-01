<div class="modal fade" id="delete_latest_news_{{$blockedUser->id}}" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verticalModalTitle"> {{ __('admin_dashboard/block_user/messages.delete') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" action="{{ route('blocked_user.destroy', $blockedUser) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <h4 style="text-align: center"> {{ __('admin_dashboard/block_user/messages.sure_delete') }}   </h4>
                <div class="modal-footer">
                    <button type="submit" class="btn mb-2 btn-primary " > {{ __('admin_dashboard/block_user/messages.delete') }} </button>
                </div>
            </form>
        </div>
    </div>
</div>
