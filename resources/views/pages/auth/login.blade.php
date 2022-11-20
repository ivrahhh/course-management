@extends('layouts.authentication')

@section('content')
    <div class="mt-20">
        <i class="fa-brands fa-laravel text-5xl text-red-600"></i>
    </div>
    <div class="flex mt-10 flex-col w-96 rounded-lg border border-gray-300 p-4">
        <form action="{{ route('login.auth') }}" method="POST" class="space-y-4">
            <div>
                <x-form.label for="email" :value="__('Email Address')" />
                <x-form.text-box type="email" id="email" name="email" placeholder="example@email.com" :value="old('email')" autocomplete="email" />
                @error('email')
                    <x-form.input-error :message="$message"/>
                @enderror
            </div>
            <div>
                <x-form.label for="password" :value="__('Password')" />
                <x-form.text-box type="password" id="password" name="password" autocomplete="current-password" />
                @error('password')
                    <x-form.input-error :message="$message"/>
                @enderror
            </div>
            <x-form.submit :label="__('Log in')" />
        </form>
    </div>
    <div class="mt-10 p-4 rounded-lg w-96 border border-gray-300 text-center block">
        <span class="text-sm">
            Look's like your getting old.
            <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Forgot password ?</a>
        </span>
    </div>
@endsection