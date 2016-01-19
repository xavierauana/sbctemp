<style>
    iframe{
        width: 100%;
        height: 550px;
    }
</style>
<template>
    <iframe :src="previewSrc" frameborder="2"></iframe>
</template>

<script>
    export default{
        props:['file', 'show'],
        computed:{
            previewSrc: function(){
                var url = ""
                if(this.file instanceof File && this.show){
                    url = URL.createObjectURL(this.file, {oneTimeOnly: true});
                    if (window.navigator.msSaveOrOpenBlob) {
                        url = "/js/pdfjs/web/viewer.html?file=" + encodeURIComponent(url);
                    }
                }
                return  url;
            }
        }
    }
</script>