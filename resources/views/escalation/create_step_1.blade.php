@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Criar nova escalção: <strong>Selecione a segunda equipe</strong></div>
                    <div class="card-body">
                        <form action="{{ route('escalation.create') }}" method="get" id="form">
                            <input type="hidden" name="step" value="2">
                            <input type="hidden" name="first_team" value="{{ $first_team }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="first_team">Segunda Equpe</label>
                                        <select class="form-control" id="first_team" name="second_team" required>
                                            @foreach($teams as $v)
                                                <option value="{{ $v["id"] }}">{{ $v["name"] }}</option>
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
