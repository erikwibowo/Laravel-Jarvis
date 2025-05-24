@props([
    'controller',
    'model',
    'migration',
    'indexRequest',
    'storeRequest',
    'updateRequest',
    'pageIndex',
    'pageForm',
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

        @isset($controller)
            <div class="flex space-x-1">
                <span class="font-bold">{{ $controller }}</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green uppercase">created</span>
            </div>
        @endisset

        @isset($model)
            <div class="flex space-x-1">
                <span class="font-bold">{{ $model }}</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green uppercase">created</span>
            </div>
        @endisset

        @isset($migration)
            <div class="flex space-x-1">
                <span class="font-bold">{{ $migration }}</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green uppercase">created</span>
            </div>
        @endisset

        @isset($indexRequest)
            <div class="flex space-x-1">
                <span class="font-bold">{{ $indexRequest }}</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green uppercase">created</span>
            </div>
        @endisset

        @isset($storeRequest)
            <div class="flex space-x-1">
                <span class="font-bold">{{ $storeRequest }}</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green uppercase">created</span>
            </div>
        @endisset

        @isset($updateRequest)
            <div class="flex space-x-1">
                <span class="font-bold">{{ $updateRequest }}</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green uppercase">created</span>
            </div>
        @endisset

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

        @isset($pageCreate)
            <div class="flex space-x-1">
                <span class="font-bold">{{ $pageCreate }}</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green uppercase">created</span>
            </div>
        @endisset

        @isset($pageEdit)
            <div class="flex space-x-1">
                <span class="font-bold">{{ $pageEdit }}</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green uppercase">created</span>
            </div>
        @endisset

        @isset($pageDelete)
            <div class="flex space-x-1">
                <span class="font-bold">{{ $pageDelete }}</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green uppercase">created</span>
            </div>
        @endisset

        @isset($pageDeleteBulk)
            <div class="flex space-x-1">
                <span class="font-bold">{{ $pageDeleteBulk }}</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green uppercase">created</span>
            </div>
        @endisset

        @isset($permission)
            <div class="flex space-x-1">
                <span class="font-bold">{{ $permission }}</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green uppercase">created</span>
            </div>
        @endisset

        @isset($route)
            <div class="flex space-x-1">
                <span class="font-bold">{{ $route }}</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green uppercase">created</span>
            </div>
        @endisset

        <span class="text-blue mt-1">Please run 'php artisan migrate'</span>
    </div>
</div>
