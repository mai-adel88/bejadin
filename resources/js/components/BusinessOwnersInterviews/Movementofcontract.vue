<template>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">متابعة العقد</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-2">
                    <label for="branch">الفرع</label>
                    <select class="form-control" v-model="branch" name="branch_id" id="branch" @change="branche()">
                        <option disabled value="">select one</option>
                        <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{branch.name_ar}}</option>
                    </select>
                    <template v-for="error in errors.branche_id">
                        <div :key="error" v-if="errors.branche_id != ''" class="alert alert-danger" style="margin:10px 0" role="alert">{{error}}</div>
                    </template>
                </div>
                <div class="col-md-3">
                    <label for="employer">المتعاقد - الباحث عن العمل</label>
                    <select2 class="form-control applicant" v-model="employer" name="applicanth_id" id="employer" v-on:input="getcompany()">
                        <option disabled value="">Select one</option>
                        <template v-for="(applicant,index) in applicants">
                            <option :key="index" :value="index">{{applicant}}</option>
                        </template>
                    </select2>
                    <template v-for="error in errors.applicant_id">
                        <div :key="error" v-if="errors.applicant_id != ''" class="alert alert-danger" style="margin:10px 0" role="alert">{{error}}</div>
                    </template>
                </div>
                <div class="col-md-3">
                    <label for="company">اصحاب الاعمال</label>
                    <input disabled class="form-control" :value="company != '' ? companies[0].name_ar : ''" type="text" name="" id="company">
                    <!-- <select2 class="form-control applicant" v-model="company" name="company_id" id="company" v-on:input="companyform()">
                        <option disabled value="">Select one</option>
                        <template v-for="company in companies">
                            <option :key="company.id" :value="company.id">{{company.name_ar}}</option>
                        </template>
                    </select2>
                    <template v-for="error in errors.company_id">
                        <div :key="error" v-if="errors.company_id != ''" class="alert alert-danger" style="margin:10px 0" role="alert">{{error}}</div>
                    </template> -->
                </div>
                <div class="col-md-2">
                    <label for="date">التاريخ</label>
                    <input class="form-control" v-model="form.datecontract" type="date" name="" id="date">
                </div>
                <div class="col-md-2">
                    <label for="movementnumber">رقم الحركة</label>
                    <input disabled v-model="form.move_number" class="form-control" type="text" name="" id="movementnumber">
                    <!-- <input class="form-control" v-model="form.move_number_contract" type="text" name="" id="movementnumber"> -->
                </div>
            </div>
            <hr>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="col-md-3">نوع المستند</th>
                        <th scope="col" class="col-md-3">تم</th>
                        <th scope="col" class="col-md-3">لم يتم</th>
                        <th scope="col" class="col-md-3">تاريخ الاستلام</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">توثيق العقد بالقنصلية</th>
                        <td class="alert" :class="{'alert-warning' : form.consular_contract == '' && alert == true}"><input @change="spinnercheck()" v-model="form.consular_contract" value="1" type="radio" name="consular_contract" id=""></td>
                        <td class="alert" :class="{'alert-warning' : form.consular_contract == '' && alert == true}"><input @change="spinnercheck()" v-model="form.consular_contract" value="0" type="radio" name="consular_contract" id=""></td>
                        <td><input v-model="form.date_consular_contract" class="form-control" type="date" name="" id=""></td>
                    </tr>
                    <tr>
                        <th scope="row">توثيق القوى العاملة</th>
                        <td class="alert" :class="{'alert-warning' : form.man_power == '' && alert == true}"><input @change="spinnercheck()" v-model="form.man_power" value="1" type="radio" name="man_power" id=""></td>
                        <td class="alert" :class="{'alert-warning' : form.man_power == '' && alert == true}"><input @change="spinnercheck()" v-model="form.man_power" value="0" type="radio" name="man_power" id=""></td>
                        <td><input v-model="form.date_man_power" class="form-control" type="date" name="" id=""></td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <button :disabled="spinner" class="btn btn-primary" @click="senddata()">
                <i class="fa fa-spinner fa-pulse" v-if="spinner"></i>
                <span v-else>{{save}}</span>
                <!-- {{spinner == true ? <i class="fas fa-spinner fa-pulse"></i> : 'حفظ'}} -->
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
            companies:[],
            company:'',
            branches:[],
            branch:'',
            errors:[],
            alert:false,
            spinner:false,
            save:'حفظ',
            form:{
                branche_id:'',
                applicant_id:'',
                company_id:'',
                datecontract:'',
                move_number:'',
                // move_number_contract:'',
                consular_contract:'',
                date_consular_contract:'',
                man_power:'',
                date_man_power:'',
            }
        }
    },
    methods:{
        branche:function(){
            this.form.branche_id = this.branch
            this.employer = ''
            $('#select2-employer-container').text('Select one')
            // console.log(this.employer)
        },
        companyform:function(){
            this.form.company_id = this.company
            console.log(this.branch);
            console.log(this.employer);
            console.log(this.company);
            axios.get('api/admin/datarecoverycontract/' + this.branch + '/' + this.employer +'/'+ this.company).then((response)=>{
                if (response.data[0] != '') {
                    this.form = response.data[0]
                    this.branch = this.form.branche_id
                    this.form.datecontract ? this.form.datecontract : this.getdate()
                    this.save = 'تعديل'
                }else{
                    this.form.datecontract = ''
                    this.form.move_number = response.data[1]
                    // this.form.move_number_contract = ''
                    this.form.consular_contract = ''
                    this.form.date_consular_contract = ''
                    this.form.man_power = ''
                    this.form.date_man_power = ''
                    this.save = 'حفظ'
                    this.alert = false
                    this.getdate();
                }
            })
        },
        getapplicants:function(){
            axios.get('api/admin/applicantmovement').then((response)=>{
                this.applicants = response.data[0]
            }).catch((error)=>{
                console.log(error)
            })
        },
        getcompany:function(){
            this.company = ''
            this.companies = []
            this.form.applicant_id = this.employer
            axios.get('api/admin/companiesmovement/'+ this.employer).then((response)=>{
                this.companies = response.data[0]
                this.company = this.companies[0].id
                this.companyform();
            }).catch((error)=>{
                console.log(error)
            })
        },
        getbranches:function(){
            axios.get('api/admin/branches').then((response)=>{
                this.branches = response.data[0]
            }).catch((error)=>{
                console.log(error)
            })
        },
        senddata:function(){
            this.spinner = true
                if(this.employer == '' || this.branch == '' || this.company == '') {
                    axios.post('api/admin/datacontractpost',this.form).catch(({ response })=>{
                        this.errors = response.data.errors
                         this.spinner = false
                    })
                }else{
                    if (this.form.consular_contract == '' || this.form.man_power == '') {
                        this.alert = true
                        this.errors = []
                    }else{
                        axios.post('api/admin/datacontractpost',this.form).then((response)=>{

                        }).finally(()=>{
                            this.spinner = false
                            Swal.fire({
                                type: 'success',
                                title: 'تم الحفظ بنجاح'
                            })
                        })
                    }
                }

        },
        spinnercheck:function(){
            if (this.form.consular_contract != '' && this.form.man_power != '') {
                this.spinner = false
            }
        },
        getdate:function(){
            var date = new Date()
            var getyear = date.getFullYear()
            var getmouth = date.getUTCMonth() + 1
            var getday = date.getDate()
            if(getday<10)
            {
                getday='0'+getday;
            }

            if(getmouth<10)
            {
                getmouth='0'+getmouth;
            }
            var fulldate = getyear + '-' + getmouth + '-' + getday
            this.form.datecontract = fulldate
            // console.log(fulldate)
        }
    },
    computed:{

    },
    created(){
        this.getapplicants()
        this.getbranches()
        this.getdate()
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
.table tbody tr .alert{
    padding: 0 !important;
}
.alert input{
    width: 100%;
    height: 45px;
}
</style>

