<template>
    <div>
        <h3>賬戶資料總匯表 Export Users Info</h3>
        <form class="form" action="/exportData" @submit.prevent="checkInputs" method="post">
            <input type="hidden" name="_token" v-model="token">
            <div class="form-group">
                <label for="type">Select Customer Status: </label>
                <select name="status" class="form-control">
                    <option value="not" selected>Not Active</option>
                    <option value="active">Active</option>
                    <option value="all">All</option>
                </select>
            </div>
            <fieldset>
                <legend>Select C Number Range: </legend>
                <div class="form-group">
                    <label>Start:</label>
                    <input type="number" name="start" min="0" max="999999999" v-model="start" class="form-control">
                </div>
                <div class="form-group">
                    <label>End:</label>
                    <input type="number" name="end" min="0" max="999999999" v-model="end" class="form-control">
                </div>
            </fieldset>
            <button class="btn btn-purple btn-lg" >下載用戶資料 Export User Data</button>
        </form>
    </div>
</template>

<script>
    export default{
        data:function(){
            return {
                token: document.getElementById('csrf_token').getAttribute('content'),
                start: 0,
                end: 1000
            }
        },
        methods:{
            checkInputs: function(e){
                this.start > this.end? alert('Incorrect input for c number start and end!'): e.target.submit();
            }
        }
    }
</script>