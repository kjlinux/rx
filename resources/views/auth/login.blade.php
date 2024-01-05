<!doctype html>
<html lang="fr">

<head>
    <title>X-ray service</title>
    <link rel="shortcut icon" type="image/png" href={{ asset('img/rx-logo-2.png') }}>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href={{ asset('css/style.css') }}>

    <style>
        body {
            overflow: hidden;
        }
    </style>

</head>

<body class="" style="background-image: url('{{ asset('img/bg_login.jpg') }}');">
    <section class="ftco-section mt-n3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section"><iconify-icon icon="jam:medical" style="color: white" width="60"
                            height="60"></iconify-icon>Service RX</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Connectez-vous</h3>
                        {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
                        <form method="POST" action="{{ route('login') }}" class="signin-form">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="E-mail" required>
                            </div>
                            <div class="form-group">
                                <input id="password-field" type="password" class="form-control" name="password"
                                    placeholder="Mot de passe" autocomplete="false" required>
                                <span toggle="#password-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-success text-white px-3">Me
                                    connecter</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    {{-- <label class="checkbox-wrap checkbox-primary">Se souvenir de moi
                                        <input id="remember_me" type="checkbox" name="remember">
                                        <span class="checkmark"></span>
                                    </label> --}}
                                </div>
                                <div class="w-50 text-md-right">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src={{ asset('js/jquery.min.js') }}></script>
    <script src={{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('js/main.js') }}></script>

</body>

</html>
{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
