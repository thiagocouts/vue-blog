@extends('layouts.app')

@section('content')
    <pagina size="12">
        <painel title="Artigos" color="panel-primary">
            <p>
                <form class="form-inline text-center" action="{{ url('/') }}" method="GET">
                    <input class="form-control" type="search" name="busca" placeholder="Buscar"
                    value="{{ isset($busca) ? $busca : ""}}">
                    <button class="btn btn-primary">Buscar</button>
                </form>
            </p>
            <div class="row">
                @foreach($artigos as $artigo)
                    <card 
                    sm="6" md="4" title="{{ $artigo->title }}" description="{{ str_limit($artigo->description, 40, ' ...') }}"
                    autor="{{ $artigo->autor }}" data="{{ $artigo->data }}"
                    img="https://estado.rs.gov.br/upload/recortes/201712/13163410_1413662_GD.jpg"
                    link="{{ route('artigo', [$artigo->id, str_slug($artigo->title, '-') ]) }}"
                    ></card>
                @endforeach
            </div>
            <div align="center">
                {{$artigos}}
            </div>
        </painel>
    </pagina>
@endsection