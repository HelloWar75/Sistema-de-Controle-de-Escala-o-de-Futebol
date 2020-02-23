@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Visualizar equipe</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Nome da equipe</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ $team["name"] }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="button" onclick="window.history.back();" class="btn btn-danger">Voltar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
