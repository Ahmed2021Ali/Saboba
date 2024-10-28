<div class="modal fade" id="edit_latest_news_{{$city->id}}" tabindex="-1" role="dialog"
     aria-labelledby="varyModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">تحديث المدينة </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('city.update',$city)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <h3 class="text-center"> الدولة  {{$country->name}}   </h3>
                    <div class="form-group">
                        <input type="hidden" name="country_id" value="{{ $country->id }}">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label"> اسم المدينة </label>
                        <textarea class="form-control" name="name" id="message-text">{{$city->name}}</textarea>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn mb-2 btn-primary"> تحديث المدينة </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

