<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://jquery.com" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       
    <style>
        
        body {
            height: 100vh;
            background: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            color: #fff;
        }

        .form-control {
            background: rgba(255,255,255,0.2);
            border: none;
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(255,255,255,0.7);
        }

        .form-control:focus {
            background: rgba(255,255,255,0.3);
            box-shadow: none;
            color: #fff;
        }

        .btn-login {
            background-color: #f8c291;
            border: none;
            color: #000;
            font-weight: 600;
            border-radius: 30px;
        }

        .btn-login:hover {
            background-color: #f6b48f;
        }

        .social-btn {
            background: #fff;
            color: #000;
            font-weight: 500;
        }

        .login-title {
            font-size: 24px;
            font-weight: bold;
        }

        .small-link {
            font-size: 14px;
            color: #fff;
            text-decoration: none;
        }

        .small-link:hover {
            text-decoration: underline;
        }
    </style>
     @vite('resources/js/login.js')

</head>
    
<body>

    <div class="login-card text-center">
        <div class="login-title mb-3">Login </div>
        <p class="mb-4">Tem uma conta?</p>

        <form>
            <div class="mb-3">
                <input type="email" class="form-control rounded-pill" placeholder="E-mail">
            </div>

            <div class="mb-3">
                <input type="password" class="form-control rounded-pill" placeholder="senha ">
            </div>
            <a class="btn btn-primary" href="2_segunda_pagina_site.html" role="button" 
            style="background-color: rgb(95, 236, 255); border-color: rgb(0, 0, 0); font-size: 18px; padding: 10px 50px;">
            ENTRAR
            </a>

        </form>
    </div>
