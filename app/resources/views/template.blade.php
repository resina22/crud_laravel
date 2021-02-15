<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
        crossorigin="anonymous"
    >
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"
    ></script>

    <title>@yield('title')</title>
</head>

<body>
  @section('sidebar')
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('users')}}">Usuários</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  @show

  @if (session('errors'))
  <div class="container mt-3">
    <div class="alert alert-danger">
      <ul class="m-0">
        @foreach (session('errors') as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  <div>
  @endif

  @if (session('response'))
  <div class="container mt-3">
    @if(!empty(session('response')) && session('response')['success'])

    <div class="alert alert-success">
      {{session('response')['message'] ?? 'Salvo com sucesso!'}}
    </div>

    @else

    <div class="alert alert-danger">
      {{session('response')['message'] ?? 'Erro ao salvar!'}}
    </div>

    @endif
  <div>
  @endif

  <div class="container">
    @yield('content')
  </div>
</body>
</html>