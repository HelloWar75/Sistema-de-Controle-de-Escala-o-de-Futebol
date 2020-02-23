@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6" style="padding-top: 5px;">
                                <h4>Atletas</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('athlete.create') }}" class="btn btn-primary float-right">Criar nova equipe</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                      @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{ session('status') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Camisa</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Posição</th>
                                    <th scope="col">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($athletes as $v)
                                <tr>
                                    <th scope="row">{{ $v["id"] }}</th>
                                    <td>{{ $v["name"] }}</td>
                                    <td>{{ $v["shirt_number"] }}</td>
                                    <td>{{ $v["team"]["name"] }}</td>
                                    <td>{{ $v["position"]["name"] }}</td>
                                    <td>
                                      <a href="{{ route('athlete.show', $v["id"]) }}" class="btn btn-primary">Visualizar</a>
                                      <a href="{{ route('athlete.edit', $v["id"]) }}" class="btn btn-warning">Editar</a>
                                      <form style="display: inline;" action="{{ route('athlete.destroy', $v["id"]) }}" method="post">
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
