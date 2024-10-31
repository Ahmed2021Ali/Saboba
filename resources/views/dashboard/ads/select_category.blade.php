<!-- Edit Category Modal -->
<div class="modal fade" id="select_category" tabindex="-1" role="dialog" aria-labelledby="notify_edit"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel"> اشعار بالتعديل </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ad.create') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label for="country_id"><strong> اختار القسم الذي تريد اضافة اعلان فيه </strong></label>
                        <select name="category_id" id="country_id" class="form-control" required>
                            <option style="display: none"> اختار القسم الذي تريد اضافة اعلان فيه</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"> {{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary"> التأكيد الارسال</button>
                </div>
            </form>
        </div>
    </div>
</div>
