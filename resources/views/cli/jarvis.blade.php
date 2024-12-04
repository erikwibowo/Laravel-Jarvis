@props([
    'controller',
    'model',
    'migration',
    'indexRequest',
    'storeRequest',
    'updateRequest',
    'pageIndex',
    'pageCreate',
    'pageDelete',
    'pageDeleteBulk',
    'pageEdit',
    'permission',
    'route'
])
<div class="mx-2 my-1">
    <div class="my-1">
        <span class="font-bold text-green">Jarvis Resource Generated</span>

        <div class="flex space-x-1">
            <span class="font-bold">{{ $controller }}</span>
            <span class="flex-1 content-repeat-[.] text-gray"></span>
            <span class="font-bold text-green uppercase">created</span>
        </div>
        <div class="flex space-x-1">
            <span class="font-bold">{{ $model }}</span>
            <span class="flex-1 content-repeat-[.] text-gray"></span>
            <span class="font-bold text-green uppercase">created</span>
        </div>
        <div class="flex space-x-1">
            <span class="font-bold">{{ $migration }}</span>
            <span class="flex-1 content-repeat-[.] text-gray"></span>
            <span class="font-bold text-green uppercase">created</span>
        </div>
        <div class="flex space-x-1">
            <span class="font-bold">{{ $indexRequest }}</span>
            <span class="flex-1 content-repeat-[.] text-gray"></span>
            <span class="font-bold text-green uppercase">created</span>
        </div>
        <div class="flex space-x-1">
            <span class="font-bold">{{ $storeRequest }}</span>
            <span class="flex-1 content-repeat-[.] text-gray"></span>
            <span class="font-bold text-green uppercase">created</span>
        </div>
        <div class="flex space-x-1">
            <span class="font-bold">{{ $updateRequest }}</span>
            <span class="flex-1 content-repeat-[.] text-gray"></span>
            <span class="font-bold text-green uppercase">created</span>
        </div>
        <div class="flex space-x-1">
            <span class="font-bold">{{ $pageIndex }}</span>
            <span class="flex-1 content-repeat-[.] text-gray"></span>
            <span class="font-bold text-green uppercase">created</span>
        </div>
        <div class="flex space-x-1">
            <span class="font-bold">{{ $pageCreate }}</span>
            <span class="flex-1 content-repeat-[.] text-gray"></span>
            <span class="font-bold text-green uppercase">created</span>
        </div>
        <div class="flex space-x-1">
            <span class="font-bold">{{ $pageDelete }}</span>
            <span class="flex-1 content-repeat-[.] text-gray"></span>
            <span class="font-bold text-green uppercase">created</span>
        </div>
        <div class="flex space-x-1">
            <span class="font-bold">{{ $pageDeleteBulk }}</span>
            <span class="flex-1 content-repeat-[.] text-gray"></span>
            <span class="font-bold text-green uppercase">created</span>
        </div>
        <div class="flex space-x-1">
            <span class="font-bold">{{ $pageEdit }}</span>
            <span class="flex-1 content-repeat-[.] text-gray"></span>
            <span class="font-bold text-green uppercase">created</span>
        </div>
        <div class="flex space-x-1">
            <span class="font-bold">{{ $permission }}</span>
            <span class="flex-1 content-repeat-[.] text-gray"></span>
            <span class="font-bold text-green uppercase">created</span>
        </div>
        <div class="flex space-x-1">
            <span class="font-bold">{{ $route }}</span>
            <span class="flex-1 content-repeat-[.] text-gray"></span>
            <span class="font-bold text-green uppercase">created</span>
        </div>
        <span class="text-blue mt-1">Please run 'php artisan migrate'</span>
    </div>
</div>