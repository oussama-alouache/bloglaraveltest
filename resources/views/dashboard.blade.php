<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
        <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md mb-5" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div>
                <p class="font-bold">Bonne nouvelle ! </p>
                <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
            </div>
        @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @foreach ( $posts as $post)
            <a href="{{ route('post.edit', $post) }}" class="bg-yellow-500 px-2 py-3 block">Editer {{ $post->title }}</a>
            <a href="#" class="text-red-600 hover:text-red-900 ml-3" onclick="
                            event.preventDefault();
                            document.getElementById('destroy-post-form').submit();
                            ">Supprimer

                                <form method="post" action="{{ route('post.destroy', $post) }}" id="destroy-post-form">
                                    @csrf
                                    @method('delete')
                                </form>
                            </a>





                @endforeach
                    
                
            </div>
        </div>
    </div>
</x-app-layout>
