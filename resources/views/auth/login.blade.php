<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Afacad:wght@400;600;700&family=Sora:wght@400;600&display=swap" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">

</head>

<body class="bgAdmin font-afacad">

    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-100 px-3" style="max-width: 1000px; width: 100%;"> <!-- max-width ditambah + padding -->

            <!-- Bagian Kiri (Logo) -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center bg-white">
                <div class="text-center">
                    <img src="{{ asset('assets/logo-mapan.png') }}" alt="Logo" class="logo-image mb-4" style="width: 80%;"/>
                </div>
            </div>

            <!-- Bagian Kanan (Login Form) -->
            <div class="login col-md-6 d-flex flex-column justify-content-center align-items-center" style="background-color: #b11004;">
                <div class="login-section" style="width: 100%;">

                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-white">Welcome To Mapan</h2>
                        <p style="font-size: 25px;"><span style="color: #E74127;">Manajemen Pegawai &</span> <span style="color: #342F35;">Niaga</span></p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <x-text-input id="name" class="form-control input-size" type="text" name="name"
                                :value="old('name')" required autofocus placeholder="Username" />
                            <x-input-error :messages="$errors->get('name')" class="text-danger mt-1" />
                        </div>

                        <div class="mb-3">
                            <x-text-input id="email" class="form-control input-size" type="email" name="email"
                                :value="old('email')" required placeholder="Email" />
                            <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
                        </div>

                        <div class="mb-4">
                            <x-text-input id="password" class="form-control input-size" type="password" name="password"
                                required placeholder="Password" />
                            <x-input-error :messages="$errors->get('password')" class="text-danger mt-1" />
                        </div>

                        <div class="d-flex justify-content-center text-dark">
                            <button type="submit" class="btn btn-login w-30">
                                {{ __('Login') }}
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</body>

</html>