<div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel"
     style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">{{ __('admin_dashboard/city/messages.add') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('city.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h3 class="text-center">  {{$country->name}}   </h3>
                    <div class="form-group">
                        <input type="hidden" name="country_id" value="{{ $country->id }}">
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">{{ __('admin_dashboard/city/messages.add') }} </label>
                        <textarea class="form-control" name="name" id="message-text" required></textarea>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn mb-2 btn-primary"> {{ __('admin_dashboard/city/messages.add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

