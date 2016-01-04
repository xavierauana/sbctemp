<template>
    <form class="form" @submit="formSubmit">

        <div class="form-group">
            <input type="text" class="form-control" v-model="pnumber" @blur="punmberChange" placeholder="P Number">
        </div>
        <div class="form-group" v-show="pnumberIsValid">
            <input class="form-control" v-model="presult" type="text" disabled >
        </div>
        <div class="form-group">
            <input type="number" class="form-control" v-model="cnumber" @blur="cunmberChange" placeholder="C Number">
        </div>
        <div class="form-group" v-show="cnumberIsValid">
            <input  class="form-control" v-model="cresult" type="text" disabled >
        </div>
        <button class="btn btn-purple">Create Linkage</button>
    </form>
</template>

<script>
    export default {
        data:function(){
            return{
                pnumber:'',
                cnumber:'',
                presult:'Chan Ta Man',
                cresult:'abc company',
                pnumberIsValid: false,
                cnumberIsValid: false
            }
        },
        computed:{
//            pnumberIsValid: function(){
//                if(this.pnumber){
//                    if(this.pnumber == 'aaaa')return true;
//                    console.log('P number incorrect');
//                }
//                return false;
//            },
//            cnumberIsValid: function(){
//                if(this.cnumber){
//                    if (this.cnumber == '9999') return true;
//                    if (this.cnumber == '8888'){
//                        console.log('This company already link with other p number.');
//                        return false;
//                    }
//                    console.log('C number incorrect');
//                }
//                return false;
//            }
        },
        methods:{
            cunmberChange:function(){
                if(this.cnumber == '8888'){
                    this.cnumberIsValid = true
                }else if(this.cnumber == '9999'){
                    alert('This company already link with other p number.');
                    this.cnumberIsValid = false
                }else{
                    this.cnumberIsValid = false
                }
            },
            punmberChange:function(){
                this.pnumberIsValid = this.pnumber == 'aaaa'? true:false;
            },
            formSubmit:function(e){
                e.preventDefault();
                this.cunmberChange();
                this.punmberChange();
            }
        }
    }
</script>