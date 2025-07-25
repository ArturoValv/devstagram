@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center p-5">

        <div class="md:w-1/2 bg-white p-6 shadow">

            <form action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0"
                novalidate>
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text" id="username" name="username" placeholder="Tu Nombre de Usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input type="email" id="email" name="email" placeholder="Tu Nombre de Usuario"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ auth()->user()->email }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen del Perfil
                    </label>
                    <input type="file" id="imagen" name="imagen" accept=".jpg, .jpeg, .png"
                        class="border p-3 w-full rounded-lg">
                </div>
                {{-- 
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nuevo Password
                    </label>
                    <input type="password" id="password" name="password" placeholder="Nuevo Password"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Repite tu Password" class="border p-3 w-full rounded-lg">
                </div> --}}

                <div class="mb-5">
                    <label for="current_password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Ingresa tu Password Actual
                    </label>
                    <input type="password" id="current_password" name="current_password" placeholder="Password Actual"
                        class="border p-3 w-full rounded-lg @error('current_password') border-red-500 @enderror">
                    @error('current_password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                    @if (session('mensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ session('mensaje') }}
                        </p>
                    @endif
                </div>

                <input type="submit" value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>

        </div>

    </div>
@endsection
