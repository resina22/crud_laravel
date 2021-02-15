@extends('template')
@section('title', 'Novo usuário')

@section('content')
<form form="{{route('store.user')}}" method="POST">
  @csrf()
  <div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input
      minlength="5"
      required
      type="text"
      class="form-control"
      name="name"
      aria-describedby="name"
    >
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input
      required
      type="email"
      class="form-control"
      name="email"
      aria-describedby="email"
    >
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Senha</label>
    <input
      required
      type="password"
      class="form-control"
      name="password"
      aria-describedby="password"
      value=""
    >
  </div>

  <button type="submit" class="btn btn-primary">Salvar</button>
</form>
@endsection