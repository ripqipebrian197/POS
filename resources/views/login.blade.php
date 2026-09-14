<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - POS System</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-card {
            background: #ffffff;
            padding: 36px 32px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 400px;
        }

        .login-title {
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #334155;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            font-size: 15px;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s ease;
            color: #1e293b;
        }

        .input-wrapper input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .alert-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .forgot-password {
            display: block;
            margin-top: -6px;
            margin-bottom: 24px;
            font-size: 13px;
            color: #64748b;
            text-decoration: none;
        }

        .forgot-password:hover {
            color: #4f46e5;
        }

        .btn-submit {
            width: 100%;
            padding: 12px 20px;
            background-color: #4338ca;
            color: #ffffff;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            transition: background-color 0.2s;
        }

        .btn-submit:hover {
            background-color: #3730a3;
        }

        .btn-submit i {
            position: absolute;
            right: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h2 class="login-title">Login POS</h2>

        <!-- Pesan error validasi Laravel -->
        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- <form action="{{ route('login') }}" method="POST"> --}}
               <form action="{{ route('auth') }}" method="POST">
            @csrf

            <!-- Field Email -->
            <div class="form-group">
                <label for="email">Email address</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        placeholder="contoh@email.com" required autofocus>
                </div>
            </div>

            <!-- Field Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="password" required>
                </div>
            </div>


            <button type="submit" class="btn-submit">
                Submit
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>
    </div>

</body>

</html>