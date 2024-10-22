 {{-- Delete Modal --}}
 <div class="modal fade" id="deleteRoleModal_{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteRoleModalLabel_{{ $role->id }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoleModalLabel_{{ $role->id }}">تأكيد الحذف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <h4 style="text-align: center">هل أنت متأكد من أنك تريد حذف الدور: <span style="color: red">{{ $role->name }}</span></</strong>؟</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">تأكيد الحذف</button>
                </div>
            </form>
        </div>
    </div>
</div>