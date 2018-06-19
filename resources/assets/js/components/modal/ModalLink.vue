<template>
    <span>
        <span v-if="item">
            <button v-on:click="preencheForm()" v-if="!type || (type != 'button' && type != 'link')" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#'+ name">{{title}}</button>
            <button v-on:click="preencheForm()" v-if="type == 'button'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#'+ name">{{title}}</button>
            <a v-on:click="preencheForm()" v-if="type == 'link'" href="#" data-toggle="modal" v-bind:class="css || ''" v-bind:data-target="'#'+ name">{{title}}</a>
        </span>

        <span v-if="!item">
            <button v-if="!type || (type != 'button' && type != 'link')" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#'+ name">{{title}}</button>
            <button v-if="type == 'button'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#'+ name">{{title}}</button>
            <a v-if="type == 'link'" href="#" data-toggle="modal" v-bind:class="css || ''" v-bind:data-target="'#'+ name">{{title}}</a>
        </span> 
    </span>
</template>

<script>
    export default {
        props: [
            'type', 'name', 'title', 'css', 'item', 'url'
        ],
        methods: {
            preencheForm: function(){
                axios.get(this.url + this.item.id).then((response) => {
                    this.$store.commit('setItem', response.data);
                });
                // this.$store.commit('setItem', this.item);
            }
        }
    }
</script>
