@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase font-bold">create car</h1>
        </div>

        <div class="flex justify-center pt-20">
            <form action="/cars" method="post" enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <input type="file" name="image" class="mb-10">
                    <input
                        type="text"
                        name="name"
                        class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                        placeholder="Brand name..."
                    >
                    <input
                        type="text"
                        name="founded"
                        class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                        placeholder="Founded..."
                    >
                    <input
                        type="text"
                        name="description"
                        class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400"
                        placeholder="Description..."
                    >
                    <button class="bg-green-500 shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                        Submit
                    </button>
                </div>
            </form>
        </div>
        @if ($errors->any())
            <div class="w-4/8 m-auto text-center">
                @foreach ($errors->all() as $error)
                    <li class="text-red-500 list-none">
                        {{ $error }}
                    </li>
                @endforeach
            </div>
        @endif
    </div>
@endsection
