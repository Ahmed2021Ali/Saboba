<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">تعديل الفئة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>اسم الفئة</label>
                        <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                    </div>
                    <div class="form-group">
                        <label>المتجر</label>
                        <select name="store_id" class="form-control" required>
                            <option value="">اختر المتجر</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}" {{ $store->id == $category->store_id ? 'selected' : '' }}>{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>تكلفة التوصيل</label>
                        <input type="number" name="delivery_cost" class="form-control" value="{{ $category->delivery_cost }}" required>
                    </div>
                    <div class="form-group">
                        <label>رسالة وقت التوصيل</label>
                        <input type="text" name="delivery_time_msg" class="form-control" value="{{ $category->delivery_time_msg }}" required>
                    </div>
                    <div class="form-group">
                        <label>الظهور لدي</label>
                        <select name="visibility" class="form-control" required>
                            <option value="المستخدمين" {{ $category->visibility == 'المستخدمين' ? 'selected' : '' }}>المستخدمين</option>
                            <option value="التجار" {{ $category->visibility == 'التجار' ? 'selected' : '' }}>التجار</option>
                            <option value="الجميع" {{ $category->visibility == 'الجميع' ? 'selected' : '' }}>الجميع</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                </div>
            </form>
        </div>
    </div>
</div>
