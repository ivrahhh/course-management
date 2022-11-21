@extends('layouts.authentication')

@section('content')
<div class="mt-20">
    <i class="fa-brands fa-laravel text-5xl text-red-600"></i>
</div>
<div class="flex mt-10 flex-col w-96 rounded-lg border border-gray-300 p-4">
    <form method="POST" action="{{ route('verification.send') }}" class="space-y-6">
        <p class="text-sm">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.
        </p>
        @if (session('status'))
            <x-alert type="success" :message="session('status')" />
        @endif
        <x-form.submit :label="__('Resend Email Verification')"     />
    </form>
</div>
@endsection