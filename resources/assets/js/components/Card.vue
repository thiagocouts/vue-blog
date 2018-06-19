<template>
    <div :class="'col-sm-'+ (sm || '6') + ' col-md-'+ (md || '4')">
        <div class="thumbnail">
            <img :src="img" alt="...">
            <div class="caption">
                <small>{{ data | formatDate}} - {{ autor }}</small>
                <h3>{{ title }}</h3>
                <p>{{ description }}</p>
                <p><a :href="link" class="btn btn-primary" role="button">Leia Mais</a></p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'title', 'description', 'link', 'img', 'data', 'autor', 'sm', 'md'
        ],
        filters: {
            formatDate: function(value){
                if(!value) return '';

                value = value.toString();

                if(value.split('-').length == 3){
                    value = value.split('-');
                    return value[1] + ' ' + value[0];
                }
            }
        }
    }
</script>
