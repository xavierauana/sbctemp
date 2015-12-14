<template>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>編號</th>
            <th>文件類別名稱</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="docType in documentTypes">
            <td style="max-width:25%">
                <input class="form-control" type="text" name="index" v-model="docType.index" :disabled="!docType.status">
            </td>
            <td style="max-width:25%">
                <input class="form-control" type="text" name="type" v-model="docType.type" :disabled="!docType.status">
            </td>
            <td style="min-width:30%">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="submit"
                           class="btn btn-sm"
                           :class="{'btn-primary': !docType.status, 'btn-success': docType.status}"
                           @click.prevent="edit($event, docType)">{{editInputValue(docType)}}</button>
                </div>
                <div class="btn-group-vertical" role="group" aria-label="Basic example">
                    <button
                           class="btn btn-sm btn-danger"
                           @click.prevent="deleteDocType($event, docType)">刪除</button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        data:function(){
          return {
              currentEditDocType:"",
              documentTypes:[]
          }
        },
        computed:{
          isEditing: function(docType){
              return docType == this.currentEditDocType;
          }
        },
        methods:{
            editInputValue: function(docType){
                return docType.status ? "更新":"編輯";
            },
            edit: function(e, docType){
                if(!docType.status){
                    this.currentEditDocType = docType;
                    this.documentTypes.map(function(type){
                        type.status = false;
                        return type;
                    });
                }else{
                    console.log('patch to server to save');
                    this.currentEditDocType = "";
                }
                docType.status = !docType.status;
            },
            deleteDocType:function(e, docType){
                var message = "Are you sure you want to deleted document type '"+docType.type+"'?";
                if(confirm(message)) {
                    this.documentTypes.$remove(docType);
                    console.log('submit to server to preserve change!')
                }
            }
        },
        created: function(){
            this.$http.get('/getdoctypes', function(response){
                response.map(function(type){
                    type['status'] = false;
                });
                this.$set("documentTypes", response);
            })
        }
    }
</script>