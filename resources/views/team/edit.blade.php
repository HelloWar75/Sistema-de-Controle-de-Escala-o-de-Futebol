@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Editar equipe</div>
                    <div class="card-body">
                      <form action="{{ route('team.update', $team["id"]) }}" method="post" id="form">
                        @csrf
                        @method("PUT")
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="name">Nome da equipe</label>
                              <input type="text" class="form-control" id="name" name="name" value="{{ $team["name"] }}" required>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="card-footer">
                      <div class="float-right">
                        <button type="button" onclick="window.history.back();" class="btn btn-danger">Cancelar</button>
                        <button type="button" onclick="submit('form');" class="btn btn-success">Salvar</button>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
