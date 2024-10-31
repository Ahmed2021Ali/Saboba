<div class="modal fade" id="delete_latest_news_{{$city->id}}" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verticalModalTitle">{{ __('admin_dashboard/city/messages.delete') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" action="{{ route('city.destroy', $city) }}" style="display:inline">

                <h3 class="text-center"> الدولة  {{$country->name}}   </h3>
                <div class="form-group">
                    <input type="hidden" name="country_id" value="{{ $country->id }}">
                </div>

                @csrf
                @method('DELETE')
                <h4 style="text-align: center"> {{ __('admin_dashboard/city/messages.do_you_want_to_delete_this_country') }} {{$city->name}}</h4>
                <div class="modal-footer">
                    <button type="submit" class="btn mb-2 btn-primary " >{{ __('admin_dashboard/city/messages.delete') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
