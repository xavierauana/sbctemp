<style>
    .docTypeCode{
        width: 150px;
    }
    .docTypeName{
    }
    .actionButtons{
        text-align: right;
        width: 100px;
    }
</style>

<template>
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="docTypeCode">編號 Codes</th>
            <th class="docTypeName">文件類別名稱 Doc Type Name</th>
            <th class="actionButtons">指令 Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="docType in documentTypes">
            <td style="max-width:25%" class="docTypeCode">
                <input class="form-control" type="text" name="index" v-model="docType.index" :disabled="!docType.status">
            </td>
            <td class="docTypeName">
                <input class="form-control" type="text" name="type" v-model="docType.type" :disabled="!docType.status">
            </td>
            <td class="actionButtons">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="submit"
                           class="btn btn-xs"
                           :class="{'btn-primary': !docType.status, 'btn-success': docType.status}"
                           @click.prevent="edit($event, docType)"><i class="fa fa-2x"
                                                                     :class="{
                                                                     'fa-pencil-square-o':editInputValue(docType),
                                                                     'fa-floppy-o':!editInputValue(docType),
                                                                     }"></i></button>
                </div>
                <div class="btn-group-vertical" role="group" aria-label="Basic example">
                    <button
                           class="btn btn-xs btn-danger"
                           @click.prevent="deleteDocType($event, docType)"><i class="fa fa-trash fa-2x"></i></button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        events:{
          'restEdit': function(){
              this.documentTypes.map(function(type){
                  type.status = false;
                  return type;
              });
          }
        },
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
                return docType.status ? false:true;
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