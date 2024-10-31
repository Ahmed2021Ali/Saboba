 {{-- Delete Modal --}}
 <div class="modal fade" id="deleteRoleModal_{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteRoleModalLabel_{{ $role->id }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoleModalLabel_{{ $role->id }}">{{ __('admin_dashboard/roles/messages.delete') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <h4 style="text-align: center">{{ __('admin_dashboard/roles/messages.sure_delete') }}: <span style="color: red">{{ $role->name }}</span></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin_dashboard/roles/messages.close') }}</button>
                    <button type="submit" class="btn btn-danger"> {{ __('admin_dashboard/roles/messages.delete') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
