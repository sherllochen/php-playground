<x-blog-layout>
    @foreach ($blogList as $post)
        <div class=" md:w-4/12 px-4 float-left">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg bg-pink-600">
                <img alt="..."
                     src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1051&amp;q=80"
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
</x-blog-layout>
