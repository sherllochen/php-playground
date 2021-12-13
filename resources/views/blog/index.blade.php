<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Hello notion!    All blog from Notion.
                    @foreach ($blogList as $post)
                        <p>ID {{ $post->pageId}}</p>
                        <p>TITLE {{ $post->title}}</p>
                        <p>DATE {{ $post->publishedDate}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
