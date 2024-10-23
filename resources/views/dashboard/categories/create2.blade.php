<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal2" tabindex="-1" role="dialog" aria-labelledby="createCategoryModal2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">إضافة فئة فرعية  جديدة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label> اختر الفئة الرائيسية</label>
                        <select name="store_id" class="form-control" required>
                            <option value="" style="display: none"> اختر الفئة </option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label>اسم الفئة الفرعية </label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="files">الصور</label>
                        <input type="file" name="images[]" id="files" class="form-control" multiple accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">إضافة</button>
                </div>
            </form>
        </div>
    </div>
</div>
