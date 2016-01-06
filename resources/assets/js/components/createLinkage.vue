<template>
    <div>
        <form class="form" @submit="formSubmit">

            <div class="form-group">
                <input type="text" class="form-control" v-model="pnumber" @change="punmberChange" placeholder="P Number">
            </div>
            <div class="form-group" v-show="userName">
                <input class="form-control" v-model="userName" type="text" disabled>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" v-model="cnumber" @change="cunmberChange" placeholder="C Number"
                       :disabled="!pnumber">
            </div>
            <div class="form-group" v-show="companyName">
                <input class="form-control" v-model="companyName" type="text" disabled>
            </div>
            <button class="btn btn-purple">Create Linkage</button>
        </form>
        <modal :show.sync="showModal">
            <p slot="body">{{modalBody}}</p>
            <h3 slot="header">{{modalHeader}}</h3>
        </modal>
    </div>


</template>

<script>
    import Modal from './modal.vue'
    export default {
        components:{
            Modal
        },
        data: function () {
            return {
                pnumber: '',
                userName: '',
                cnumber: '',
                companyName: '',
                presult: 'Chan Ta Man',
                cresult: 'abc company',
                pnumberIsValid: false,
                cnumberIsValid: false,
                showModal: false,
                modalHeader:"",
                modalBody:"",
                modalFooter:""
            }
        },
        methods: {
            cunmberChange: function () {
                if (this.cnumber) {
                    this.$http.get('/fetchCompany/' + this.cnumber + '/user/' + this.pnumber, function (response) {
                        if (response.code == 200) {
                            this.companyName = response.data.english_name;
                            this.cnumberIsValid = true;
                        } else {
                            this.cnumber = "";
                            this.companyName = "";
                            this.cnumberIsValid = false;
                            this.modalHeader = "Warning!";
                            this.showModal = true;
                            console.log(response.code);
                            if (response.code == 404) {
                                this.modalBody = 'No company for the c number.'
                            } else if (response.code == 201) {
                                this.modalBody = 'Your already linked this c number.'
                            } else if (response.code == 202) {
                                this.modalBody = 'The company already link with other account.'
                            }
                        }
                    });
                }
//                if(this.cnumber == '8888'){
//                    this.cnumberIsValid = true
//                }else if(this.cnumber == '9999'){
//                    alert('This company already link with other p number.');
//                    this.cnumberIsValid = false
//                }else{
//                    this.cnumberIsValid = false
//                }
            },
            punmberChange: function () {
                console.log(this.pnumber);
                if (this.pnumber) {
                    this.$http.get('/fetchUser/' + this.pnumber, function (response) {
                        if (response.code == 404) {
                            this.pnumber = "";
                            this.userName = ""
                            this.cnumberIsValid = false;
                        } else {
                            this.userName = response.data.name;
                            this.pnumberIsValid = true;
                        }
                    });
                }
            },
            formSubmit: function (e) {
                e.preventDefault();
                if (this.pnumberIsValid && this.cnumberIsValid) {
                    console.log('ajax fired');
                    this.$http.get('/createLinkage/user/' + this.pnumber + '/company/' + this.cnumber, function (response) {
                        if (response.code == 200) {
                            this.cnumber = "";
                            this.userName = "";
                            this.pnumber = "";
                            this.companyName = "";
                            this.modalHeader = "Success!";
                            this.modalBody = "You have successfully link the company to the user!";
                            this.showModal = true;
                        }
                        console.log(response)
                    });
                }
            }
        }
    }
</script>