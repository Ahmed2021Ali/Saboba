<div class="modal fade" id="edit_blocked_user_{{$blockedUser->id}}" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">فك حظر المستخدم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('blocked_user.update',$blockedUser)}}" method="post">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="message-text" class="col-form-label"> هل تريد فك حظر المستخدم  </label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn mb-2 btn-primary"> نعم </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

