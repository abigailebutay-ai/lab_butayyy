<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Mini Twitter</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #e0bbc4ff, #ffd6e8);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            padding: 50px;
            border-radius: 20px;
            width: 450px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        h1 {
            font-size: 38px;
            margin-bottom: 10px;
            color: #333;
            font-weight: 600;
        }

        p {
            color: #555;
            margin-bottom: 30px;
            font-size: 16px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            text-align: center;
            text-decoration: none;
            color: white;
            border-radius: 10px;
            font-size: 17px;
            transition: 0.2s ease-in-out;
            font-weight: 500;
        }

        .btn-login {
            background-color: #6c63ff;
        }
        .btn-login:hover {
            background-color: #584ffd;
        }

        .btn-register {
            background-color: #ff8fab;
        }
        .btn-register:hover {
            background-color: #ff7698;
        }

    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome!</h1>
        <p>Your mini Twitter app starts here. Join the community now.</p>

        <a href="{{ route('login') }}" class="btn btn-login">Log In</a>
        <a href="{{ route('register') }}" class="btn btn-register">Create Account</a>
    </div>
</body>
</html>
