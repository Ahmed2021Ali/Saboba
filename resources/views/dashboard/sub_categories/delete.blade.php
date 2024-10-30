<!-- Delete Category Modal -->
<div class="modal fade" id="deleteCategoryModal{{ $subCategory->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryModalLabel">{{ __('admin_dashboard/category/messages.delete') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('admin_dashboard/category/messages.sure_delete') }}<span style="color: red">{{ $subCategory->name }}</span>
            </div>
            <div class="modal-footer">
                <form action="{{ route('categories.destroy', $subCategory) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin_dashboard/category/messages.close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('admin_dashboard/category/messages.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
