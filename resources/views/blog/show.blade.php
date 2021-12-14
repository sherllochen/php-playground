<x-blog-layout>
    {{--    <x-slot name="header">--}}
    {{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
    {{--            {{ __('Blog') }}--}}
    {{--        </h2>--}}
    {{--    </x-slot>--}}
    <div class="max-w-7xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <h3 class="text-4xl font-semibold leading-normal mb-2 text-gray-800">
                {{ $post->title}}
            </h3>
            <div class="text-sm leading-normal mt-0 mb-2 text-gray-500 font-bold uppercase">
                {{ $post->publishedDate }}
            </div>
        </div>
        <div class="border-t border-gray-290 pt-5 text-left">
            @foreach($post->content as $block)
                {!! $parsedown->text($block) !!}
            @endforeach
        </div>
    </div>
</x-blog-layout>
