<div class="gallery-box-item-list flex-container width100 flex-flex-start stripe">
    <div class="">
        @include('markets.partials.gallery._baseImage')
    </div>
    <div class="flex-grow-3 padding-left-5" style="flex-grow: 3">
        @include('markets.partials.gallery._baseTitle')
        @include('markets.partials.gallery._listAuctionDesc')
    </div>
</div>
{{-- Not using sections because of problem with sections/show/overwrite in multiple includes --}}