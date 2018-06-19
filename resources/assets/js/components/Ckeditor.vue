<template>
    <div class="app">
        <ckeditor 
            v-model="content" 
            :config="config" 
            @blur="onBlur($event)" 
            @focus="onFocus($event)">
        </ckeditor>
    </div>
</template>

<script>

export default {
    components: { Ckeditor },
    data () {
        return {
            content: '',
            config: {
            toolbar: [
                [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
            ],
            height: 300
            }
        }
    },
    methods: {
        onBlur (editor) {
            console.log(editor)
        },
        onFocus (editor) {
            console.log(editor)
        }
    }
}
</script>