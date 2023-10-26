@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center mt-10">
        <div class="text-4xl font-bold">Verify Your Email Address</div>

        @if (session('resent'))
            <div class="mt-4 text-sm text-gray-700">
                A fresh verification link has been sent to your email address.
            </div>
        @endif

        <div class="mt-4 text-sm text-gray-700">
            Before proceeding, please check your email for a verification link.
            If you did not receive the email,
            <form class="inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button class="text-blue-500 underline hover:text-blue-700" type="submit">
                    click here to request another
                </button>.
            </form>
        </div>
    </div>
@endsection
