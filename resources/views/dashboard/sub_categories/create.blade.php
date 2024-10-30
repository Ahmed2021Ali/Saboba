<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal2" tabindex="-1" role="dialog" aria-labelledby="createCategoryModal2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">{{ __('admin_dashboard/category/messages.add') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('sub_categories.store',$category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">


                    <div class="form-group">
                        <label>{{ __('admin_dashboard/category/messages.name') }}</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="files">{{ __('admin_dashboard/category/messages.image') }}</label>
                        <input type="file" name="images[]" id="files" class="form-control" multiple accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin_dashboard/category/messages.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('admin_dashboard/category/messages.add') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
