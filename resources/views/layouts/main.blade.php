<!DOCTYPE html>
<html lang="en">
    <x-admin.header title="duolingo" />

    <style>
        #jsonDisplay {
            width: 100%;
            height: auto;
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            font-family: monospace;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
<body>
    <div class="flex w-full h-full">
        <div>
            @include("includes.sidebar")
        </div>
        <div class="flex-1 bg-gray-200 w-full  p-4 h-[100vh] overflow-hidden overflow-y-auto">
            @yield("content")
        </div>
    </div>

    @livewireScripts
</body>
</html>

