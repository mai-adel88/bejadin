<template>
    <div>
        <div class="row">
            <div class="form-group col-md-4">
                <label class="control-label">{{ trans('admin.companies') }}</label>
                <!-- <select name="companies" class="form-control companies" v-model="companyname" required @change="selectrequest()">
                    <option value="">{{ trans('admin.select') }}</option>
                    <option v-for="company in companies" :value="company.id">{{company.name_ar}}</option>
                </select> -->
                <select2 name="companies" id="tree" class="form-control companies" v-model="companyname" required v-on:input="selectrequest()">
                    <option value="">Select one</option>
                    <template v-for="company in companies">
                        <option :value="company.id">{{company.name_ar}}</option>
                    </template>
                </select2>
            </div>
            <div class="form-group col-md-4">
                <label class="control-label">{{ trans('admin.jobs') }}</label>
                <!-- <select name="jobs" class="form-control jobs" v-model="applicantsRequestsname" required @change="selectapplicant()">
                    <option value="">{{ trans('admin.select') }}</option>
                    <option v-for="applicantsRequest in filterrequests" :value="applicantsRequest.id">{{applicantsRequest.job.name_ar}} ({{applicantsRequest.job_spec.name_ar}})</option>
                </select> -->
                <select2 name="jobs" id="tree" class="form-control jobs" v-model="applicantsRequestsname" required v-on:input="selectapplicant()">
                    <option value="">Select one</option>
                    <template v-for="applicantsRequest in filterrequests">
                        <option :value="applicantsRequest.id">{{applicantsRequest.job.name_ar}} ({{applicantsRequest.job_spec.name_ar}})</option>
                    </template>
                </select2>
            </div>

            <div class="form-group col-md-4">
                <label class="control-label">{{ trans('admin.applicants') }}</label>
                <!-- <select name="applicants" class="form-control applicants" v-model="applicantsname" required>
                    <option value="">{{ trans('admin.select') }}</option>
                    <option v-for="applicant in filterapplicants" :value="applicant.applicants.id">{{applicant.applicants.name_ar}}</option>
                </select> -->
                <select2 name="applicants" id="tree" class="form-control applicants" v-model="applicantsname" required v-on:input="viewbox()">
                    <option value="">Select one</option>
                    <template v-for="applicant in filterapplicants">
                        <option :value="applicant.applicants.id">{{applicant.applicants.name_ar}}</option>
                    </template>
                </select2>
            </div>
        </div>


    </div>
</template>

<script>
    import Select2 from './Select2.vue';
    export default {
        data(){
            return {
                companies: {
                    id:'',
                    name_ar:''
                },
                applicantsRequests: {
                    id:'',
                    job:'',
                    job_spec:'',
                    companies_id:''
                },
                applicants: {
                    applicants:'',
                    companies:'',
                    applicants_requests_id:'',
                },
                companyname: '',
                applicantsRequestsname: '',
                applicantsname: '',
                filterrequests:[],
                filterapplicants:[],
            }
        },
        mounted(){
            this.getcompanies;
            this.getapplicantsRequests;
            this.getapplicants;
            $("#tree").select2();
        },
        methods:{
            selectrequest: function() {
                if (this.companyname != '')
                {
                    this.applicantsRequestsname = '';
                    this.filterrequests = [];
                    this.applicantsname = '';
                    this.filterapplicants = [];
                    this.filterrequests = this.applicantsRequests.filter((applicantsRequest) => applicantsRequest.companies_id == this.companyname);
                }else{
                    this.applicantsRequestsname = '';
                    this.filterrequests = [];
                    this.applicantsname = '';
                    this.filterapplicants = [];
                }

            },
            selectapplicant: function() {
                if (this.applicantsRequestsname != ''){
                    this.applicantsname = '';
                    this.filterapplicants = [];
                    this.filterapplicants = this.applicants.filter((applicant) => applicant.applicants_requests_id == this.applicantsRequestsname);
                }else{
                    this.applicantsname = '';
                    this.filterapplicants = [];
                }
            },
            viewbox:function(){
                var companies = this.companyname;
                var jobs = this.applicantsRequestsname;
                var applicants = this.applicantsname;
                // console.log(jobs,companies,applicants);
                if (this){
                    $.ajax({
                        url: 'progress/details',
                        type:'get',
                        dataType:'html',
                        data:{companies : companies,jobs: jobs,applicants: applicants},
                        success: function (data) {
                            $('.column-form').css("display","block").html(data);
                            $('.datepicker').datepicker({
                                format: 'yyyy-mm-dd',
                                rtl: true,
                                language: 'ar',
                                inline:true,
                                minDate: 0,
                                autoclose:true,

                            });

                        }
                    });
                }else{
                    $('.column-form').html('');
                }
            }
        },
        computed: {
            getcompanies: function() {
                axios.get('/api/companies').then(response => {
                    return this.companies = response.data;
                }).catch(errors =>{
                    console.log(errors);
                });
            },
            getapplicantsRequests: function() {
                axios.get('/api/applicantsRequests').then(response => {
                    return this.applicantsRequests = response.data;
                }).catch(errors =>{
                    console.log(errors);
                });
            },
            getapplicants: function() {
                axios.get('/api/applicants').then(response => {
                    return this.applicants = response.data;
                }).catch(errors =>{
                    console.log(errors);
                });
            },
        },
        components:{
          'select2':Select2
        },
    }
</script>
