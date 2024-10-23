<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">إضافة فئة جديدة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>اسم الفئة</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>المتجر</label>
                        <select name="store_id" class="form-control" required>
                            <option value="">اختر المتجر</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>تكلفة التوصيل</label>
                        <input type="number" name="delivery_cost" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>رسالة وقت التوصيل</label>
                        <input type="text" name="delivery_time_msg" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>الظهور لدي</label>
                        <select name="visibility" class="form-control" required>
                            <option value="المستخدمين">المستخدمين</option>
                            <option value="التجار">التجار</option>
                            <option value="الجميع">الجميع</option>
                        </select>
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
