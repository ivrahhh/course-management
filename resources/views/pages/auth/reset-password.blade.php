@extends('layouts.authentication')

@section('content')
<div class="mt-20">
    <i class="fa-brands fa-laravel text-5xl text-red-600"></i>
</div>
<div class="flex flex-col w-96 p-4 rounded-lg border border-gray-300 mt-10">
    <form action="{{ route('password.update') }}" method="POST" class="space-y-6">@method('PUT')
        <input type="hidden" value="{{ $token }}" name="token">
        <div>
            <x-form.label for="email" :value="__('Email Address')" />
            <x-form.text-box type="email" id="email" name="email" placeholder="example@email.com" :value="old('email', $email)" readonly />
            @error('email')
                <x-form.input-error :message="$message" />
            @enderror
        </div>
        <div>
            <x-form.label for="password" :value="__('New Password')" />
            <x-form.text-box type="password" id="password" name="password" autocomplete="new-password" />
            @error('password')
                <x-form.input-error :message="$message" />
            @enderror
        </div>
        <div>
            <x-form.label for="password_confirmation" :value="__('Confirm Password')" />
            <x-form.text-box type="password" id="password_confirmation" name="password_confirmation" />
        </div>
        <x-form.submit :label="__('Save new Password')"/>
    </form>
</div>
@endsection