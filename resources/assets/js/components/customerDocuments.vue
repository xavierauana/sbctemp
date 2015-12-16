<template>
    <div class="well">
        <h3>Search User</h3>

        <form action="" method="POST" @submit.prevent="searchUser">
            <div class="input-group">
                <input type="number" v-model="cNumber" id="searchCNumber" class="form-control" placeholder="Search C Number" autofocus @keypress="keyPress">
                  <span class="input-group-btn">
                    <button class="btn" type="button" @click.prevent="searchUser">Go!</button>
                  </span>
            </div>
        </form>
    </div>
    <div v-show="user">
        <table class="table">
            <thead>
            <th>Upload Date</th>
            <th>Document Type</th>
            <th>Document Name</th>
            <th></th>
            </thead>
            <tbody>
            <tr v-for="document in user.documents">
                <td>{{document.uploadDate}}</td>
                <td>{{document.docType}}</td>
                <td>{{document.docName}}</td>
                <td>
                    <button class="btn btn-danger btn-sm" @click.prevent="deleteDocument(document)">Remove</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default{
        data:function(){
            return {
                user:""
            }
        },
        methods:{
            getUserDocuments: function(){
                console.log('get request to server to find the user documents');
                if(this.cNumber){
                    var url = "/getUserDocuments/"+this.cNumber;
                    this.$http.get(url, function(response){
                        console.log(response);
                        if(response){
                            this.$set('user', response);
                        }else{
                            this.user = "";
                            alert('no one match the c number! Please verify.')
                        }
                    })
                }else{
                    this.user = "";
                    alert('You have to input the C Number!');
                }
            },
            keyPress: function(e){
                if(e.keyCode == 13){
                    e.preventDefault();
                    this.getUserDocuments();
                }
            },
            deleteDocument: function(document){
                if(confirm('Are you sure you want to delete '+document.docName+'?')){
                    this.user.documents.$remove(document);
                    console.log('post to server to delete the doc');
                }
            }
        }
    }
</script>