@if ($paginator->hasPages())
<ul class="flex justify-between">
    <!-- prev pages -->
    @if ($paginator->onFirstPage())
    <li class="w-16 px-2 py-1 text-center rounded border shadow bg-gray-200">Prev</li>
    @else
    <li class="w-16 px-2 py-1 text-center rounded border shadow bg-white" wire:click="previousPage()">Prev</li>
    @endif
    <!-- prev end -->

    <!-- start number -->
    @foreach($elements as $element)
    <div class="flex">
        @if(is_array($element))
            @foreach ($element as $page => $url)

                @if($page == $paginator->currentPage())
                    <li class="mx-2 w-10 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer bg-blue-400 text-white" wire:click="gotoPage({{$page}})">{{$page}}</li>
                @else
                    <li class="mx-2 w-10 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer" wire:click="gotoPage({{$page}})">{{$page}}</li>
                @endif
            @endforeach
        @endif
    </div>
    @endforeach
    <!-- end number -->

    <!-- next page -->
    @if ($paginator->onLastPage())
    <li class="w-16 px-2 py-1 text-center rounded border shadow bg-gray-200">Next</li>
    @else
    <li class="w-16 px-2 py-1 text-center rounded border shadow bg-white" wire:click="nextPage()">Next</li>
    @endif
    <!-- next end -->
</ul>
@endif