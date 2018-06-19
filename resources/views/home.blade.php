@extends('layouts.app')

@section('content')
<pagina size="8">
    <painel title="Dashboard 1" color="panel-primary">
        <breadcrumbs v-bind:lista="{{$listaBread}}"></breadcrumbs>
        <div class="row">
            @can('isAutor')
                <div class="col-md-3">
                    <caixa qtd="{{$artigos}}" title="Artigos" url="{{route('artigos.index')}}" color="orange" icon="ion ion-pie-graph"></caixa>
                </div>
            @endcan
            @can('isAdmin')
                <div class="col-md-3">
                    {{-- <painel title="Conteudo 1" color="blue"></painel> --}}
                    <caixa qtd="{{$users}}" title="Usuários" url="{{route('users.index')}}" color="red" icon="ion ion-person-stalker"></caixa>
                </div>
                <div class="col-md-3">
                    {{-- <painel title="Conteudo 2" color="orange"></painel> --}}
                    <caixa qtd="{{$autores}}" title="Autores" url="{{route('authors.index')}}" color="green" icon="ion ion-person"></caixa>
                </div>
            
                <div class="col-md-3">
                    {{-- <painel title="Conteudo 2" color="orange"></painel> --}}
                    <caixa qtd="{{$admins}}" title="Administradores" url="{{route('admin.index')}}" color="blue" icon="ion ion-person"></caixa>
                </div>
            @endcan
            {{-- <div class="col-md-3">
                <painel title="Conteudo 3" color="red"></painel>
                <caixa qtd="80" title="Artigos" url="#" color="orange" icon="ion ion-pie-graph"></caixa>
            </div> --}}
        </div>
    </painel>
</pagina>
@endsection
