@extends('layouts.authentication')

@section('content')
<div class="mt-20">
    <i class="fa-brands fa-laravel text-5xl text-red-600"></i>
</div>
<div class="flex flex-col w-96 p-4 rounded-lg border border-gray-300 mt-10">
    <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
        <p class="text-sm">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. 
        </p>
        @if (session('status'))
            <x-alert type="success" :message="session('status')" />
        @endif
        <div>
            <x-form.label for="email" :value="__('Email Address')" />
            <x-form.text-box type="email" id="email" name="email" placeholder="example@email.com" :value="old('email')" />
            @error('email')
                <x-form.input-error :message="$message" />
            @enderror
        </div>
        <x-form.submit :label="__('Email Password Reset Link')"/>
    </form>
</div>
@endsection