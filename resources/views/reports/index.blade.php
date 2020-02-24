@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6" style="padding-top: 5px;">
                                <h4>Relatórios: Escalações por atletas</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('reports.partidas_disputadas') }}" class="btn btn-primary float-right">Relatórios partidas Disputadas</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Numero de escalções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($athletes as $v)
                                    <tr>
                                        <th scope="row">{{ $v["id"] }}</th>
                                        <td>{{ $v["name"] }}</td>
                                        <td>{{ $v["count"] }}</td>
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
