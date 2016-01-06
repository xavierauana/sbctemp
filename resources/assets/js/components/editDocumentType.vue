<template>
    <div>
        <h3>文件類別設定 Doc Type Setting</h3>
        <div class="panel panel-default">
            <document-type-table></document-type-table>
        </div>
        <form class="form-horizontal">
            <div class="form-group">
                <label for="docTypeIndex" class="col-sm-3 control-label">編號</label>
                <div class="col-sm-9">
                    <input type="number"
                           class="form-control"
                           id="docTypeIndex"
                           v-model="inputs.index"
                           placeholder="Index">
                </div>
            </div>
            <div class="form-group">
                <label for="docType" class="col-sm-3 control-label">文件類別名稱</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="docType" v-model="inputs.type" placeholder="Document Type Name">
                </div>
            </div>
            <div class="row button-group">
                <div class="col-sm-3">
                    <button class="btn btn-block btn-purple" @click.prevent="addNewDocumentType">新增 Create</button>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-block btn-purple" @click.prevent="reset">重設 Reset</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import DocumentTypeTable from "./documentTypeTable.vue";

    export default {
        data:function(){
            return {
                inputs:{
                    type:"",
                    index:""
                }
            }
        },
        components:{
            DocumentTypeTable
        },
        methods:{
            reset:function(){
                console.log('reset inputs')
                for(var key in this.inputs){
                    this.inputs[key]="";
                }
            },
            addNewDocumentType: function(){
                console.log('post to server to add a new document type')
            },
            toggleTooltip: function(e){
                e.keyCode <48 || e.keyCode > 57 ? $('#docTypeIndex').tooltip('show'):$('#docTypeIndex').tooltip('hide');
            }
        },
        ready:function(){
            document.getElementById("docTypeIndex").addEventListener("keypress", this.toggleTooltip);
            $("#docTypeIndex").tooltip({
                trigger:'manual',
                title:"number only"
            })
        }
    }
</script>