<x-blog-layout>
    @include('layouts.blog.menu')
    <div class="grid grid-flow-row-dense grid-cols-3 gap-x-5 mt-5">
        @foreach ($blogList as $post)
            <div class="">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg bg-pink-600">
                    <img alt="..."
                         src="{{ App\Helpers\General::getPostCoverImage($post) }}"
                         class="w-full align-middle rounded-t-lg">
                    <blockquote class="relative p-8 mb-4">
                        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95"
                             class="absolute left-0 w-full block" style="height: 95px; top: -94px;">
                            <polygon points="-30,95 583,95 583,65" class="text-pink-600 fill-current"></polygon>
                        </svg>
                        <a target="_blank" href="/blog/{{$post->pageId}}">
                            <h4 class="text-xl font-bold text-white">
                                {{ $post->title}}
                            </h4>
                        </a>
                        <p class="text-md font-light mt-2 text-white">
                            {{$post->abstract}}
                        </p>
                        <p>@ {{ $post->published_date}}</p>
                    </blockquote>
                </div>
            </div>
        @endforeach
    </div>
</x-blog-layout>
