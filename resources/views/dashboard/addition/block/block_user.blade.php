<div class="modal fade" id="block_user{{ $moduleId }}" tabindex="-1" role="dialog"
     aria-labelledby="block_user_id" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"
                    id="deleteCategoryModalLabel">{{$message}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('blocked_user.store') }}" method="POST">
                @csrf
                <div class="modal-body" style="text-align: center">
                    <h3> {{$message}} <span style="color: red">{{ $user->name }}</span></h3>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                </div>
                <div class="modal-body">
                    <label>  {{ __('admin_dashboard/notify/messages.User newsletter') }}  </label>
                    <textarea type="text" name="reason" class="form-control" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin_dashboard/notify/messages.close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('admin_dashboard/notify/messages.Confirm sending Block') }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
