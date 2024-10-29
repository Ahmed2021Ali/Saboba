<div class="modal fade" id="accept_verification_{{$verification->id}}" tabindex="-1" role="dialog"
     aria-labelledby="varyModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel"> قبول اثبات الهوية </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('verifications.update',$verification)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <br>
                    <h4 style="text-align: center"> هل تريد قبول مستندات هذه الموسسة   {{$verification->user->name}}</h4>
                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn mb-2 btn-primary">  قبول اثبات الهوية  </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

