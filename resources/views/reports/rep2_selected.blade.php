@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6" style="padding-top: 5px;">
                                <h4>Relatórios: Partidas disputadas</h4>
                            </div>
                            <div class="col-md-6">
                                <button type="button" onclick="window.history.back();" class="btn btn-danger float-right">Voltar</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nome da escalação</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $party["name"] }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="party_date">Data da partida</label>
                                    <input type="date" class="form-control" id="party_date" name="party_date" value="{{ $party["date"] }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="athletes_team_1">Jogadores <strong>Equipe 1</strong></label>
                                    <select multiple class="form-control" id="athletes_team_1[]" name="athletes_team_1[]" disabled>
                                        @foreach($athletes_first_team as $v)
                                            @if($v["selected"])
                                                <option value="{{ $v["id"] }}" selected>{{ $v["name"] }} - ({{ $v["position"]["name"] }})</option>
                                            @else
                                                <option value="{{ $v["id"] }}">{{ $v["name"] }} - ({{ $v["position"]["name"] }})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="athletes_team_2">Jogadores <strong>Equipe 2</strong></label>
                                    <select multiple class="form-control" id="athletes_team_2[]" name="athletes_team_2[]" disabled>
                                        @foreach($athletes_second_team as $v)
                                            @if($v["selected"])
                                                <option value="{{ $v["id"] }}" selected>{{ $v["name"] }} - ({{ $v["position"]["name"] }})</option>
                                            @else
                                                <option value="{{ $v["id"] }}">{{ $v["name"] }} - ({{ $v["position"]["name"] }})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
