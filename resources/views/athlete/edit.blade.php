@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Editar equipe</div>
                    <div class="card-body">
                      <form action="{{ route('athlete.update', $athlete["id"]) }}" method="post" id="form">
                        @csrf
                        @method("PUT")
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="name">Nome do atleta</label>
                                      <input type="text" class="form-control" id="name" name="name" value="{{ $athlete["name"] }}" required>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="shirt_number">Numero da camiseta</label>
                                      <input type="text" class="form-control" id="name" name="shirt_number" value="{{ $athlete["shirt_number"] }}" required>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="position_id">Posição do Jogador</label>
                                      <select class="form-control" id="position_id" name="position_id">
                                          @foreach($positions as $position)
                                              @if( $position["id"] === $athlete["position"]["id"] )
                                                  <option value="{{ $position["id"] }}" selected>{{ $position["name"] }}</option>
                                              @else
                                                  <option value="{{ $position["id"] }}">{{ $position["name"] }}</option>
                                              @endif
                                          @endforeach
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="team_id">Equipe do jogador</label>
                                      <select class="form-control" id="team_id" name="team_id">
                                          @foreach($teams as $team)
                                              @if( $team["id"] === $athlete["team"]["id"] )
                                                  <option value="{{ $team["id"] }}" selected>{{ $team["name"] }}</option>
                                              @else
                                                  <option value="{{ $team["id"] }}">{{ $team["name"] }}</option>
                                              @endif
                                          @endforeach
                                      </select>
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
