<div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
     style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">اضافة دولة </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('verifications.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="storeStatus"><strong> اختار الموسسة </strong></label>
                        <select name="company_id" id="storeStatus" class="form-control">
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label" > اسم دولة  </label>
                        <textarea class="form-control" name="name" id="message-text" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="files">الصور</label>
                        <input type="file" name="image" id="file" class="form-control" multiple accept="image/*" required>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn mb-2 btn-primary">  اضافة دولة جديدة </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

