@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6" style="padding-top: 5px;">
                                <h4>Escalações</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('escalation.create') }}" class="btn btn-primary float-right">Criar nova escalação</a>
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
                                    <th scope="col">Time 1</th>
                                    <th scope="col">Time 2</th>
                                    <th scope="col">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($escalations as $v)
                                <tr>
                                    <th scope="row">{{ $v["id"] }}</th>
                                    <td>{{ $v["name"] }}</td>
                                    <td>{{ $v["team_1"]["name"] }}</td>
                                    <td>{{ $v["team_2"]["name"] }}</td>
                                    <td>
                                      <a href="{{ route('escalation.show', $v["id"]) }}" class="btn btn-primary">Visualizar</a>
                                      <a href="{{ route('escalation.edit', $v["id"]) }}" class="btn btn-warning">Editar</a>
                                      <form style="display: inline;" action="{{ route('escalation.destroy', $v["id"]) }}" method="post">
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
