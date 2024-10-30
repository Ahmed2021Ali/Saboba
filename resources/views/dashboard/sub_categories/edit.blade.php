<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal{{ $subCategory->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">{{ __('admin_dashboard/category/messages.edit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('sub_categories.update', $subCategory) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label> {{ __('admin_dashboard/category/messages.name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ $subCategory->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="files">{{ __('admin_dashboard/category/messages.image') }}</label>
                        <input type="file" name="images[]" id="files" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin_dashboard/category/messages.close') }}</button>
                    <button type="submit" class="btn btn-primary"> {{ __('admin_dashboard/category/messages.edit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
