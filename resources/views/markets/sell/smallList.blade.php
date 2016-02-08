<div class="gallery-box-item-list list-row">
    <div class="flex-row">
        <div class="flex-item padding-right">
            @include('markets.partials.gallery._baseImage')
        </div>
        <div class="flex-item width100">
            {{--<div class="flex-row width100">--}}
                @include('markets.partials.gallery._baseTitle')
            {{--</div>--}}
            <div class="flex-row">
                @include('markets.partials.gallery._listDesc')
            </div>
        </div>
    </div>
</div>
{{-- Not using sections because of problem with sections/show/overwrite in multiple includes --}}
		