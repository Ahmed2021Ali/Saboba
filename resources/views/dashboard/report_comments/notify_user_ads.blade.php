<!-- Delete Category Modal -->
<div class="modal fade" id="notify_user_ads{{ $reportAd->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryModalLabel">{{ __('admin_dashboard/report/messages.Advertiser warning message') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('report_ads.notify', $reportAd->ad->user->id) }}" method="POST">
                @csrf
                <div class="modal-body" style="text-align: center">
                    <h3> {{ __('admin_dashboard/report/messages.Advertiser warning message') }}  <span style="color: red">{{ $reportAd->ad->user->name }}</span></h3>
                </div>
                <div class="modal-body">
                    <label>  {{ __('admin_dashboard/report/messages.User newsletter') }}   </label>
                    <textarea type="text" name="reason" class="form-control" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin_dashboard/report/messages.close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('admin_dashboard/report/messages.Advertiser warning message') }} </button>
                </div>
            </form>

        </div>
    </div>
</div>
