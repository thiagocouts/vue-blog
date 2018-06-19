@extends('layouts.app')

@section('content')
<pagina size="10">
	@if($errors->all())
		<div class="alert alert-danger alertp-dismissible text-center" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			@foreach($errors->all() as $error)
				<li><strong>{{ $error }}</strong></li>
			@endforeach
		</div>
	@endif
    <painel title="Lista de Artigos" color="orange">
        <breadcrumbs v-bind:lista="{{$listaBread}}"></breadcrumbs>
    	{{-- <modal-link type="button" name="modalTeste" title="Novo" css=""></modal-link> --}}
        <tabela-lista 
            v-bind:titles="['#', 'Título', 'Descrição', 'Autor', 'Data']"
            v-bind:itens="{{ json_encode($artigos) }}"
            create="#create" details="/admin/artigos/" edit="/admin/artigos/" deletar="/admin/artigos/" token="{{ csrf_token() }}"
            ordem="desc" ordemCol="1" modal="sim"
        ></tabela-lista>
        <div align="center">
        	{{ $artigos->links() }}
        </div>
    </painel>
</pagina>

<modal name="add" title="Novo Registro">
	<formulario id="form-add" css="" action="{{ route('artigos.store') }}" method="post" token="{{ csrf_token() }}" enctype="">
		<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
		<div class="form-group">
			<label for="title">Título</label>
			<input type="text" class="form-control" id="title" name="title" placeholder="Título" value="{{ old('title') }}">
		</div>
		<div class="form-group">
			<label for="description">Descrição</label>
			<input type="text" class="form-control" id="description" name="description" placeholder="Descrição" value="{{ old('description') }}">
		</div>
		<div class="form-group">
			<label for="add_content">Conteúdo</label>
			<textarea class="form-control" id="content" name="content" placeholder="Conteúdo...">{{ old('content') }}</textarea>
			
		</div>

		<div class="form-group">
			<label for="data">Data</label>
			<input type="date" class="form-control" id="data" name="data" value="{{ old('data') }}">
		</div>
	</formulario>
	<span slot="buttons">
		<button form="form-add" type="submit" class="btn btn-primary">Salvar</button>
	</span>
	
</modal>

<modal name="edit" title="Editar Registro">
	<formulario id="form-edit" css="" v-bind:action="'/admin/artigos/' + $store.state.item.id" method="put" token="{{ csrf_token() }}">
		<div class="form-group">
			<label for="title">Título</label>
			<input type="text" class="form-control" id="title" name="title" v-model="$store.state.item.title" placeholder="Título">
		</div>
		<div class="form-group">
			<label for="description">Descrição</label>
			<input type="text" class="form-control" id="description" name="description" v-model="$store.state.item.description" placeholder="Descrição">
		</div>
		<div class="form-group">
			<label for="edit_content">Conteúdo</label>
			<textarea class="form-control" id="edit_content" name="content" placeholder="Conteúdo..." v-model="$store.state.item.content"></textarea>
		</div>

		<div class="form-group">
			<label for="data">Data</label>
			<input type="datetime" class="form-control" id="data" name="data" v-model="$store.state.item.data">
		</div>
	</formulario>
	<span slot="buttons">
		<button form="form-edit" type="submit" class="btn btn-primary">Salvar</button>
	</span>
</modal>

<modal name="details" :title="$store.state.item.title">
	{{-- <p>@{{ $store.state.item.description }}</p>	 --}}
	<p>@{{ $store.state.item.content }}</p>	
</modal>
@endsection
