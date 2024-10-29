
<div class="modal fade" id="imageModal_{{$model->id}}" tabindex="-1" role="dialog" aria-labelledby="imageModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel"> الصور </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @foreach($model->getMedia($folder) as $image)
                @if(Str::endsWith($image->getFullUrl(), ['jpg', 'jpeg', 'png', 'gif']))
                    <!-- Display image -->
                    <img class="mySlides" src="{{$image->getFullUrl()}}" width="500" height="350">
                @elseif(Str::endsWith($image->getFullUrl(), ['mp4', 'mov', 'ogg']))
                    <!-- Display video -->
                    <video width="500" height="350" controls>
                        <source src="{{$image->getFullUrl()}}" type="video/mp4">
                    </video>
                @elseif(Str::endsWith($image->getFullUrl(), ['pdf']))

                    <iframe src="{{$image->getFullUrl()}}" width="100%" height="450px" loading="lazy" title="PDF-file"></iframe>
                @else
                    <p> File format not supported for display.</p>
                @endif
            @endforeach
<br>
            <div class="text-center">
                <button class="btn btn-info" onclick="plusDivs(-1)">&#10094;</button>
                <button class="btn btn-info" onclick="plusDivs(+1)">&#10095;</button>
            </div>
            <br>

        </div>
        <script>
            var slideIndex = 1;
            showDivs(slideIndex);

            function plusDivs(n) {
                showDivs(slideIndex += n);
            }

            function showDivs(n) {
                var i;
                var x = document.getElementsByClassName("mySlides");
                if (n > x.length) {slideIndex = 1}
                if (n < 1) {slideIndex = x.length} ;
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                x[slideIndex-1].style.display = "block";
            }
        </script>
    </div>
</div>

