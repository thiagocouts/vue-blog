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
    <painel title="Lista de Administradores" color="orange">
        <breadcrumbs v-bind:lista="{{$listaBread}}"></breadcrumbs>
    	{{-- <modal-link type="button" name="modalTeste" title="Novo" css=""></modal-link> --}}
        <tabela-lista 
            v-bind:titles="['#', 'Name', 'E-mail']"
            v-bind:itens="{{ json_encode($admins) }}"
            create="#create" details="/admin/admin/" edit="/admin/admin/"
            ordem="desc" ordemCol="1" modal="sim"
        ></tabela-lista>
        <div align="center">
        	{{ $admins->links() }}
        </div>
    </painel>
</pagina>

<modal name="add" title="Novo Registro">
	<formulario id="form-add" css="" action="{{ route('admin.store') }}" method="post" token="{{ csrf_token() }}" enctype="">
		<div class="form-group">
			<label for="name">Nome</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
		</div>
		<div class="form-group">
			<label for="email">E-mail</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{ old('email') }}">
		</div>
		<div class="form-group">
			<label for="adm">Admin</label>
			<select class="form-control" id="adm" name="adm">
				<option {{ (old('adm') && old('adm') == 'N' ? 'selected' : '') }} value="N">Não</option>
				<option {{ (old('adm') && old('adm') == 'S' ? 'selected' : '') }} value="S">Sim</option>
			</select>
		</div>
		<div class="form-group">
			<label for="password">Senha</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Senha">
		</div>
	</formulario>
	<span slot="buttons">
		<button form="form-add" type="submit" class="btn btn-primary">Salvar</button>
	</span>
	
</modal>

<modal name="edit" title="Editar Registro">
	<formulario id="form-edit" css="" v-bind:action="'/admin/admin/' + $store.state.item.id" method="put" token="{{ csrf_token() }}">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" v-model="$store.state.item.name" placeholder="Name">
		</div>
		<div class="form-group">
			<label for="email">E-mail</label>
			<input type="email" class="form-control" id="email" name="email" v-model="$store.state.item.email" placeholder="E-mail">
		</div>
		<div class="form-group">
			<label for="adm">Admin</label>
			<select class="form-control" id="adm" name="adm" v-model="$store.state.item.adm">
				<option value="N">Não</option>
				<option value="S">Sim</option>
			</select>
		</div>
		<div class="form-group">
			<label for="content">Senha</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Senha">
		</div>
	</formulario>
	<span slot="buttons">
		<button form="form-edit" type="submit" class="btn btn-primary">Salvar</button>
	</span>
</modal>

<modal name="details" :title="$store.state.item.name">
	{{-- <p>@{{ $store.state.item.description }}</p>	 --}}
	<p>@{{ $store.state.item.email }}</p>	
</modal>
@endsection