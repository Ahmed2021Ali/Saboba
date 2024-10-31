<div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">إنشاء بوست جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('blocked_user.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="message-text" class="col-form-label"> اختار  المستخدم الذي ستيم حظرة  </label>
                        <select name="user_id"  class="form-control" required>
                            @foreach($users as $user)
                                @if ($user->email === 'saboba@gmail.com' && $user->hasRole('manager'))
                                    <!-- Hide edit and delete buttons for the specific manager -->
                                @else
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">سبب الجظر</label>
                        <textarea class="form-control" name="reason" id="message-text"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn mb-2 btn-primary">حظر المستخدم</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

