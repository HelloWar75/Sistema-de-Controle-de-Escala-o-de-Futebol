@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Equipes</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teams as $v)
                                <tr>
                                    <th scope="row">{{ $v["id"] }}</th>
                                    <td>{{ $v["name"] }}</td>
                                    <td>
                                      <a href="{{ route('team.show', $v["id"]) }}" class="btn btn-primary">Visualizar</a>
                                      <a href="{{ route('team.edit', $v["id"]) }}" class="btn btn-warning">Editar</a>
                                      <form style="display: inline;" action="{{ route('team.destroy', $v["id"]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Deletar</button>
                                      </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $links  !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
