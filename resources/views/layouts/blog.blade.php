<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#000000"/>
    <link rel="shortcut icon" href="./assets/img/favicon.ico"/>
    <link
        rel="apple-touch-icon"
        sizes="76x76"
        href="./assets/img/apple-icon.png"
    />
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome-all.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/compiled-tailwind.min.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body class="font-sans text-gray-800 antialiased">
@include('layouts.blog.navigation')
<main class="profile-page">
    <section class="relative block" style="height: 500px;">
        <div
            class="absolute top-0 w-full h-full bg-center bg-cover"
            style='background-image: url("{{ asset('image/photo-1499336315816-097655dcfbda.jpeg') }}");'
        >
          <span
              id="blackOverlay"
              class="w-full h-full absolute opacity-50 bg-black"
          ></span>
        </div>
        <div
            class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden"
            style="height: 70px;"
        >
            <svg
                class="absolute bottom-0 overflow-hidden"
                xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="none"
                version="1.1"
                viewBox="0 0 2560 100"
                x="0"
                y="0"
            >
                <polygon
                    class="text-gray-300 fill-current"
                    points="2560 0 2560 100 0 100"
                ></polygon>
            </svg>
        </div>
    </section>
    <section class="relative py-16 bg-gray-300">
        <div class="container mx-auto px-4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64"
            >
                <div class="px-6">
                    <div class="flex flex-wrap justify-center">
                        <div
                            class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center"
                        >
                            <div class="relative">
                                <img
                                    alt="..."
                                    src="{{asset('image/avataaars_round.png')}}"
                                    class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16"
                                    style="max-width: 150px;"
                                />
                            </div>
                        </div>
                        <div
                            class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center"
                        >
                            <div class="py-6 px-3 mt-32 sm:mt-0">
                                <a
                                    class="bg-pink-500 active:bg-pink-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1"
                                    type="button"
                                    style="transition: all 0.15s ease 0s;"
                                    href="mailto:sherllochen@gmail.com"
                                >
                                    Connect
                                </a>
                            </div>
                        </div>
                        <div class="w-full lg:w-4/12 px-4 lg:order-1">
                            <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                <div class="mr-4 p-3 text-center">
                      <span
                          class="text-xl font-bold block uppercase tracking-wide text-gray-700"
                      >22</span
                      ><span class="text-sm text-gray-500">Friends</span>
                                </div>
                                <div class="mr-4 p-3 text-center">
                      <span
                          class="text-xl font-bold block uppercase tracking-wide text-gray-700"
                      >10</span
                      ><span class="text-sm text-gray-500">Photos</span>
                                </div>
                                <div class="lg:mr-4 p-3 text-center">
                      <span
                          class="text-xl font-bold block uppercase tracking-wide text-gray-700"
                      >89</span
                      ><span class="text-sm text-gray-500">Comments</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-12">
                        <h3
                            class="text-4xl font-semibold leading-normal mb-2 text-gray-800 mb-2"
                        >
                            Sherllo Chen
                        </h3>
                        <div
                            class="text-sm leading-normal mt-0 mb-2 text-gray-500 font-bold uppercase">
                            <i class="fas fa-map-marker-alt mr-2 text-lg text-gray-500"></i>
                            KEEP MOVING
                        </div>
                        <div class="mb-2 text-gray-700 mt-2">
                            <i class="fas fa-briefcase mr-2 text-lg text-gray-500"></i
                            >Independent IT Consultant Pursuing Freedom
                        </div>
                    </div>
                    <div class="mt-10 py-5 border-t border-gray-300 text-center">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@include('layouts.blog.footer')
</body>
<script>
    function toggleNavbar(collapseID) {
        document.getElementById(collapseID).classList.toggle("hidden");
        document.getElementById(collapseID).classList.toggle("block");
    }
</script>
</html>
