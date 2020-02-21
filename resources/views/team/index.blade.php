@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Equipes</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teams as $v)
                                <tr>
                                    <th scope="row">{{ $v["id"] }}</th>
                                    <td>{{ $v["name"] }}</td>
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
