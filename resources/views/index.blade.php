@extends('main')
@section('title', 'Área de trabalho')
@section('content')

<main>
    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                <div class="col new-workboard">
                    <div class="card shadow-sm" data-toggle="modal" data-target="#modal_add_workboard">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                            xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                            preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#66695c" /><text x="43%" y="50%"
                                fill="#eceeef">Novo</text>
                        </svg>
                    </div>
                </div>

                @foreach ($userWorkboardAccess as $userWorkboardAcces)
                    <div class="col">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>{{ $userWorkboardAcces->workboard_name }}</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="40%" y="50%"
                                    fill="#eceeef">{{ $userWorkboardAcces->workboard_name }}</text>
                            </svg>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

</main>

<!-- Modal -->
<div class="modal fade" id="modal_add_workboard" tabindex="-1" role="dialog" aria-labelledby="modal_add_workboard"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar novo quadro de trabalho</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="requisitar-novo-quadro-de-trabalho">
                @csrf
                <div class="modal-body">
                    <input type="text" class="form-control" id="workboard_name" name="workboard_name" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection
