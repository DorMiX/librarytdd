@extends('layouts.app')

@section('content')

    <div class="w-2/3 bg-gray-200 mx-auto p-6">
        <form class="flex flex-col items-center" action="/authors" method="post">
            @csrf

            <h1>Add new author</h1>
            <div class="pt-4">
                <input type="text" name="name" placeholder="Full name" class="rounded py-2 px-4 w-64">
                {{-- @if ($errors->has('name'))
                    <p class="text-red-600"> {{ $errors->first() }} </p>
                @endif --}}
                {{-- OR --}}
                @error('name')
                    <p class="text-red-600"> {{ $message }} </p>
                @enderror
            </div>
            <div class="pt-4">
                <input type="text" name="dob" placeholder="Date of Birth" class="rounded py-2 px-4 w-64">
                @if ($errors->has('dob'))
                    <p class="text-red-600"> {{ $errors->first() }} </p>
                @endif
                {{-- OR --}}
                {{-- @error('dob')
                    <p class="text-red-600"> {{ $message }} </p>
                @enderror --}}
            </div>
            <div class="pt-4">
                <button class="bg-blue-400 text-white rounded py-2 px-4" type="submit" name="button">Add new author</button>
            </div>
        </form>
    </div>

@endsection
