@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Crie a escalação</div>
                    <div class="card-body">
                        <form action="{{ route('escalation.store') }}" method="post" id="form">
                            <input type="hidden" name="team_1_id" value="{{ $first_team }}">
                            <input type="hidden" name="team_2_id" value="{{ $second_team }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nome da escalação</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="party_date">Data da partida</label>
                                        <input type="date" class="form-control" id="party_date" name="party_date" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="athletes_team_1">Selecione jogadores escalados <strong>Equipe 1</strong></label>
                                        <select multiple class="form-control" id="athletes_team_1[]" name="athletes_team_1[]" required>
                                            @foreach($athletes_first_team as $v)
                                                <option value="{{ $v["id"] }}">{{ $v["name"] }} - ({{ $v["position"]["name"] }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="athletes_team_2">Selecione jogadores escalados <strong>Equipe 2</strong></label>
                                        <select multiple class="form-control" id="athletes_team_2[]" name="athletes_team_2[]" required>
                                            @foreach($athletes_second_team as $v)
                                                <option value="{{ $v["id"] }}">{{ $v["name"] }} - ({{ $v["position"]["name"] }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="button" onclick="window.history.back();" class="btn btn-danger">Cancelar
                            </button>
                            <button type="button" onclick="submit('form');" class="btn btn-success">Criar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
