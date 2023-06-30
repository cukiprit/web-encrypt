<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laravel Website Data Encryption</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-inverse bg-dark">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand text-light" href="{{ route('dashboard') }}">Encryption PDF</a>
      </div>

      <div class="navbar-header">

        <a href="{{ route('dashboard') }}" class="navbar-brand text-light">Dashboard</a>
        <a class="navbar-brand text-light" href="{{ route('encrypt') }}">Encryption</a>
        <a class="navbar-brand text-light" href="{{ route('decrypt') }}">Decryption</a>
        @guest
        <a href="/login" class="navbar-brand text-light">Login</a>
        <a href="/register" class="navbar-brand text-light">Register</a>
        @endguest

        @auth
        <a class="navbar-brand text-light" href="{{ route('logout') }}">
          Logout
        </a>
        @endauth
      </div>
    </div>
  </nav>

  @yield('content')

</body>

</html>