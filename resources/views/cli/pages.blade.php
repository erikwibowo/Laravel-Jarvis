@props([
    'pageIndex' => '',
    'pageForm' => '',
])

<div class="mx-2 my-1">
    <div class="my-1">
        <span class="font-bold text-green">Jarvis Resource Generated</span>

        @isset($pageIndex)
            <div class="flex space-x-1">
                <span class="font-bold">{{ $pageIndex }}</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green uppercase">created</span>
            </div>
        @endisset

        @isset($pageForm)
            <div class="flex space-x-1">
                <span class="font-bold">{{ $pageForm }}</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green uppercase">created</span>
            </div>
        @endisset

    </div>
</div>
