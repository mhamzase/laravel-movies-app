@extends('layouts.main')
@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-8 lg:px-32 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img  src="{{ $movie['poster_path'] }}"
                class="w-full md:w-64 lg:w-96"
                alt="{{ $movie['title'] }}" />
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ $movie['title'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <span><i class="fas fa-star text-yellow-400 fill-current w-4"></i></span>
                    <span class="ml-1">{{ $movie['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $movie['release_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>
                        {{ $movie['genres'] }}
                    </span>
                </div>

                <p class="text-gray-300 mt-8 text-justify">
                    {{ $movie['overview'] }}
                </p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured Crew</h4>
                    <div class="flex mt-4">
                        @foreach ($movie['credits']['crew'] as $crew)
                            @if ($loop->index < 3)
                                <div class="mr-8">
                                    <div>{{ $crew['name'] }}</div>
                                    <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                                </div>
                            @else
                                @break
                            @endif
                        @endforeach
                    </div>
                </div>


                <div x-data="{ isOpen: false }">
                    @if (count($movie['videos']['results']) > 0)
                        <div class="mt-12">
                            <button @click="isOpen = true"
                                class="flex inline-flex items-center bg-yellow-300 text-gray-900 rounded font-semibold px-5 py-4 hover:opacity-75 transition ease-in-out duration-150">
                                <i class="far fa-play-circle"></i>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>

                        <template x-if="isOpen">
                            <div style="background-color: rgba(0, 0, 0, .5);"
                                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto w-9/12">
                                    <div class="bg-gray-900 rounded">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                                                class="text-3xl leading-none hover:text-gray-300">&times;
                                            </button>
                                        </div>
                                        <div class="modal-body px-8 py-8">
                                            <div class="responsive-container overflow-hidden relative"
                                                style="padding-top: 56.25%">
                                                <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                    src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}"
                                                    style="border:0;" allow="autoplay; encrypted-media"
                                                    allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-8 lg:px-32 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($movie['cast'] as $cast)
                    <div class="mt-8">
                        <a href="">
                            <img src="{{ $cast['profile_path'] }}" alt="actor-{{ $loop->iteration }}"
                                class="hover:opacity-75 transition ease-in-out duration-150 w-full " />
                        </a>
                        <div class="mt-2">
                            <a href="" class="text-lg mt-2 hover:text-gray:300">{{ $cast['name'] }}</a>
                            <div class="text-sm text-gray-400">
                                {{ $cast['character'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> <!-- end movie-cast -->

    <div class="movie-images" x-data="{ isOpen: false, image: ''}">
        <div class="container mx-auto px-8 lg:px-32 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($movie['images'] as $image)
                    <div class="mt-8">
                        <a
                            @click.prevent="
                                isOpen = true
                                image='{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
                            "
                            href="#"
                        >
                            <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" alt="image1" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>
                @endforeach
            </div>

            <template x-if="isOpen">
                <div style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto w-9/12">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300">&times;
                                </button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <img :src="image" alt="full view image">
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div> <!-- end movie-images -->
@endsection