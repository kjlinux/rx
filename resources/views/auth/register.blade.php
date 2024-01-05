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
    <section class="ftco-section mt-n5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-0">
                    <h2 class="heading-section"><iconify-icon icon="jam:medical" style="color: white" width="60"
                            height="60"></iconify-icon>Service RX</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Enregistrez-vous</h3>
                        <form method="POST" action="{{ route('register') }}" class="signin-form">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Pseudo" required>
                            </div>
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
                                <input id="password-field_2" type="password" class="form-control"
                                    name="password_confirmation" placeholder="Répéter le mot de passe"
                                    autocomplete="false" required>
                                <span toggle="#password-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit"
                                    class="form-control btn btn-success text-white px-3">M'enregister</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="{{ route('login') }}" style="color: #fff">Déja enregistré.</a>
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
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

