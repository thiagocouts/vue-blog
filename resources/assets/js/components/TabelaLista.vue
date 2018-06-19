<template>
    <div>
        <div class="form-inline">
            <a v-if="create && !modal" v-bind:href="create">Novo Artigo</a>
            <modal-link v-if="create && modal" type="button" name="add" title="Novo" css=""></modal-link>
            <div class="form-group pull-right">
                <input v-model="buscar" type="search" placeholder="Buscar" class="form-control" name="">
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th style="cursor:pointer" v-on:click="ordenaColuna(index)" v-for="(title, index) in titles">{{title}}</th>
                    <th v-if="details || edit || deletar">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in lista">
                    <td v-for="it in item">{{ it | formatDate }}</td>
                    
                    <td v-if="details || edit || deletar">
                        <form v-bind:id="index" v-if="deletar && token" :action="deletar + item.id" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" v-bind:value="token">

                            <a v-if="details && !modal" v-bind:href="details">Exibir |</a>
                            <modal-link v-if="details && modal" v-bind:item="item" v-bind:url="details" type="link" name="details" title="Detalhes" css="btn btn-primary btn-xs"></modal-link>

                            <a v-if="edit && !modal" v-bind:href="edit"> Editar |</a>
                            <modal-link v-if="edit && modal" v-bind:item="item" v-bind:url="edit" type="link" name="edit" title="Editar" css="btn btn-warning btn-xs"></modal-link>

                            <a class="btn btn-danger btn-xs" v-on:click="execForm(index)" href="#">Excluir</a>
                        </form>
                        <span v-if="!token">
                            <a v-if="details && !modal" v-bind:href="details">Exibir |</a>
                            <modal-link v-if="details && modal" v-bind:item="item" v-bind:url="details" type="link" name="details" title="Detalhes" css="btn btn-primary btn-xs"></modal-link>

                            <a v-if="edit && !modal" v-bind:href="edit"> Editar |</a>
                            <modal-link v-if="edit && modal" type="link" v-bind:item="item" v-bind:url="edit" name="edit" title="Editar" css="btn btn-warning btn-xs"></modal-link>

                            <a v-if="deletar" v-bind:href="deletar">Excluir</a>
                        </span>
                        <span v-if="token && !deletar">
                            <a v-if="details && !modal" v-bind:href="details">Exibir |</a>
                            <modal-link v-if="details && modal" v-bind:item="item" v-bind:url="details" type="link" name="details" title="Detalhes" css="btn btn-primary btn-xs"></modal-link>

                            <a v-if="edit && !modal" v-bind:href="edit"> Editar |</a>
                            <modal-link v-if="edit && modal" type="link" v-bind:item="item" v-bind:url="edit" name="edit" title="Editar" css="btn btn-warning btn-xs"></modal-link>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: [
            'titles', 'itens', 'create', 'details', 'edit', 'deletar', 'token',
            'ordem', 'ordemCol', 'modal'
        ],
        data: function(){
            return {
                buscar: '',
                ordemAux: this.ordem || "asc",
                ordemAuxCol: this.ordemCol || 0 
            }
        },
        methods: {
            execForm: function(index){
                document.getElementById(index).submit();
            },
            ordenaColuna: function(coluna){
                this.ordemAuxCol = coluna;
                if(this.ordemAux.toLowerCase() == "asc"){
                    this.ordemAux = "desc";
                }else{
                    this.ordemAux = "asc";
                }
            }
        },
        filters: {
            formatDate: function(value){
                if(!value) return '';

                value = value.toString();

                if(value.split('-').length == 3){
                    value = value.split('-');
                    return value[1] + ' ' + value[0];
                }
                
                return value;
            }
        },
        computed: {
            lista: function(){
                let lista = this.itens.data;
                let ordem = this.ordemAux;
                let ordemCol = this.ordemAuxCol;
                ordem = ordem.toLowerCase();
                ordemCol = parseInt(ordemCol);

                if(ordem == 'asc'){
                    lista.sort(function(a, b) {
                        if(Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) {return 1;}
                        if(Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) {return -1;}
                        return 0;
                    });
                }else{
                    lista.sort(function(a, b) {
                        if(Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) {return 1;}
                        if(Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) {return -1;}
                        return 0;
                    });
                }

                if(this.buscar){
                    return lista.filter(response => {
                        response = Object.values(response);
                        for(let i=0; i<response.length; i++){
                            if((response[i] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0){
                                //"" transforma para string. indexOf retorna negativo o positivo
                                return true;
                            }
                        }
                        return false;
                    });
                }

                return lista;
            }
        }
    }
</script>
