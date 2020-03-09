<template>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">تقارير قسم القنصلية</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="branch">الفرع</label>
                    <select class="form-control" v-model="branch" name="branch_id" id="branch" @change="branche()">
                        <option disabled value="">select one</option>
                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{branch.name_ar}}</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="employer">المتعاقد - الباحث عن العمل</label>
                    <select2 class="form-control applicant" v-model="employer" name="applicanth_id" id="employer" v-on:input="applicant()">
                        <option disabled value="">Select one</option>
                        <template v-for="(applicant,index) in applicants">
                            <option :key="index" :value="index">{{applicant}}</option>
                        </template>
                    </select2>
                    <!-- <template v-for="error in errors.applicant_id">
                        <div :key="error" v-if="errors.applicant_id != ''" class="alert alert-danger" style="margin:10px 0" role="alert">{{error}}</div>
                    </template> -->
                </div>
            </div>
            <hr>
            <button :disabled="spinner" class="btn btn-primary" @click="senddata()">
                <!-- <i class="fa fa-spinner fa-pulse" v-if="spinner"></i> -->
                <!-- <span v-else>{{save}}</span> -->
                <span>{{save}}</span>
            </button>
        </div>
        <!-- /.box-body -->
    </div>

</template>

<script>
import axios from 'axios';
import Select2 from '../Select2.vue';
export default {
    data(){
        return{
            applicants:[],
            employer:'',
            branches:[],
            branch:'',
            spinner:false,
            save:'طباعة',
            form:{
                branche_id:'',
                applicant_id:'',
            },
        }
    },
    methods:{
        getbranches:function(){
            axios.get('api/admin/branches').then((response)=>{
                this.branches = response.data[0]
            }).catch((error)=>{
                console.log(error)
            })
        },
        getapplicants:function(){
            axios.get('api/admin/applicantmovement').then((response)=>{
                this.applicants = response.data[0]
            }).catch((error)=>{
                console.log(error)
            })
        },
        branche:function(){
            this.form.branche_id = this.branch
        },
        applicant:function(){
            this.form.applicant_id = this.employer
        },
        senddata:function(){
            axios.post('api/admin/datacontractorreport', this.form).then((response)=>{
                var url = response.data;
                console.log(url)
                window.open(url, "_blank");
            }).catch((error)=>{

            }).finally(()=>{

            })
        },
        spinnercheck:function(){

        },
        // getdate:function(){
        //     var date = new Date()
        //     var getyear = date.getFullYear()
        //     var getmouth = date.getUTCMonth() + 1
        //     var getday = date.getDate()
        //     if(getday<10)
        //     {
        //         getday='0'+getday;
        //     }

        //     if(getmouth<10)
        //     {
        //         getmouth='0'+getmouth;
        //     }
        //     var fulldate = getyear + '-' + getmouth + '-' + getday
        //     this.form.from = fulldate
        //     this.form.to = fulldate
        //     // console.log(fulldate)
        // }
    },
    created(){
        this.getbranches()
        // this.getdate()
        this.getapplicants()
    },
    mounted() {
        $(".applicant").select2();
    },
    components:{
        'select2':Select2
    },
}
</script>

<style>

</style>

