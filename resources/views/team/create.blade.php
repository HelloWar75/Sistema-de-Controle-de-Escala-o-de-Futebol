@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Criar nova equipe</div>
                    <div class="card-body">
                      <form action="{{ route('team.store') }}" method="post" id="form">
                        @csrf
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="name">Nome da equipe</label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="nome">
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="card-footer">
                      <div class="float-right">
                        <button type="button" onclick="window.history.back();" class="btn btn-danger">Cancelar</button>
                        <button type="button" onclick="submit();" class="btn btn-success">Criar</button>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
<script>
function submit() {
  var form = document.getElementById("form");
  form.submit();
}
</script>
@endsection
