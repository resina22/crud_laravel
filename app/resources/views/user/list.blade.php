@extends('template')
@section('title', 'Usuários')

@section('content')
<table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Email</th>
      <th scope="col" colspan="2" class="text-center">Ação</th>
    </tr>
  </thead>

  <tbody>
    @if (empty($users))
    <tr>
      <td colspan="4" class="text-center"> Sem registros </td>
    </tr>
    @endif
    @foreach ($users as $user)
    <tr>
      <th scope="row">{{$user['id']}}</th>
      <td>{{$user['name']}}</td>
      <td>{{$user['email']}}</td>
      <td width="80px" class="text-center">
        <a
          href="{{route('edit.user', ['id' => $user['id']])}}"
          class="btn btn-sm btn-primary"
        >
          Editar
        </a>
      </td>
      <td width="80px" class="text-center">
        <form
          method="POST"
          action="{{route('edit.del', ['id' => $user['id']])}}"
        >
          @csrf
          @method('DELETE')
          <button
            type="submit"
            class="btn btn-sm btn-danger"
          >
            Remover
          </button>
        </form>

      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="row">
  <div class="col-1">
    <a
      href="{{route('new.user')}}"
      class="btn btn-sm btn-success"
    >
      Novo
    </a>
  </div>
</div>
@endsection