@extends('layouts.app')

@section('content')
    <pagina size="7">
        <painel title="Artigos" color="panel-primary">
            <h2 align="center">{{ $artigo->title }}</h2>
            <h4 align="center">{{ $artigo->description }}</h4>
            <p>{{ $artigo->content }}</p>
            <h4 align="center"><small>{{ date('d/m/Y', strtotime($artigo->data)) }} - {{ $artigo->user->name }}</small></h4>
        </painel>
    </pagina>
@endsection