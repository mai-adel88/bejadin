<template>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">تسجيل استلام جواز السفر</h3>
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
                    <input class="form-control" v-model="form.datepassport" type="date" name="" id="date">
                </div>
                <div class="col-md-2">
                    <label for="movementnumber">رقم الحركة</label>
                    <input disabled v-model="form.move_number" class="form-control" type="text" name="" id="movementnumber">
                    <!-- <input class="form-control" v-model="form.move_number_passport" type="text" name="" id="movementnumber"> -->
                </div>
            </div>
            <hr>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="col-md-6">نوع المستند</th>
                        <th scope="col" class="col-md-6">التسجيل</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">قيمة العقد</th>
                        <!-- <td><input class="form-control" @keyup="total(),spinnercheck()"  :class="{'is_valid' : form.contract_value == '' && alert == true}" v-model.number="form.contract_value" value="0" type="number" name="contract_value" id=""></td> -->
                        <span class="total">{{price.contract_value}}</span>
                        <!-- <td><input class="form-control" @keyup="total(),spinnercheck()"  :class="{'is_valid' : form.contract_value == '' && alert == true}" v-model.number="price.contract_value" value="0" type="number" name="contract_value" id=""></td> -->
                    </tr>
                    <tr>
                        <th scope="row">قيمة الاتعاب</th>
                        <span class="total">{{price.company_fees}}</span>
                        <!-- <td><input class="form-control" @keyup="total()" v-model.number="form.value_of_fees" value="0" type="number" name="value_of_fees" id=""></td> -->
                        <!-- <td><input class="form-control" @keyup="total()" v-model.number="price.company_fees" value="0" type="number" name="company_fees" id=""></td> -->
                    </tr>
                    <tr>
                        <th scope="row">المسدد</th>
                        <span class="total">{{creditor}}</span>
                        <!-- <td><input class="form-control" @keyup="total()" v-model.number="form.payee" value="0" type="number" name="payee" id=""></td> -->
                    </tr>
                    <tr>
                        <th scope="row">الباقى</th>
                        <td><span class="total" :style="'color:'+color">{{rest}}</span></td>
                    </tr>
                    <tr>
                        <th scope="row">تاريخ التسليم</th>
                        <td><input :disabled="color != 'green'" class="form-control" @change="spinnercheck()" :class="{'is_valid' : form.delivery_date == '' && alert == true}" v-model="form.delivery_date" value="" type="date" name="delivery_date" id=""></td>
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
            rest:0,
            creditor:0,
            alert:false,
            spinner:false,
            color:'green',
            save:'حفظ',
            price:{
                company_fees:0,
                contract_value:0
            },
            form:{
                branche_id:'',
                applicant_id:'',
                company_id:'',
                datepassport:'',
                move_number:'',
                // move_number_passport:'',
                // contract_value:0,
                // value_of_fees:0,
                // payee:0,
                delivery_date:'',
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
            axios.get('api/admin/datarecoverypassport/' + this.branch + '/' + this.employer +'/'+ this.company).then((response)=>{
                if (response.data[0] != '') {
                    this.form = response.data[0]
                    this.branch = this.form.branche_id
                    this.price = response.data[1][0]
                    this.form.datepassport ? this.form.datepassport : this.getdate()
                    if (response.data[2] != null) {
                        var sum = response.data[2].reduce((acc, item) => Number(acc) + Number(item.creditor), 0);
                        this.creditor = sum
                        // console.log(sum);
                    }else{
                        this.creditor = 0
                    }
                    this.branch = this.form.branche_id
                    this.save = 'تعديل'
                    this.total()
                    if (this.rest < 0 ) {
                        this.color = 'red'
                    }else if(this.rest > 0){
                        this.color = 'blue'
                    }else if (this.rest == 0) {
                        this.color = 'green'
                    }
                }else{
                    this.form.datepassport = ''
                    this.form.move_number = response.data[1]
                    this.price.company_fees = 0
                    this.price.contract_value = 0
                    this.creditor = 0
                    // this.form.move_number_passport = ''
                    // this.form.contract_value = 0
                    // this.form.value_of_fees = 0
                    // this.form.payee = 0
                    this.form.rest = 0
                    this.form.delivery_date = ''
                    this.save = 'حفظ'
                    this.alert = false
                    this.total()
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
                    axios.post('api/admin/datapassportpost',this.form).catch(({ response })=>{
                        this.errors = response.data.errors
                         this.spinner = false
                    })
                }else{
                    if (this.form.delivery_date == '') {
                        this.alert = true
                        this.errors = []
                    }else{
                        axios.post('api/admin/datapassportpost',this.form).then((response)=>{

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
        total:function(){
            this.rest = Number(this.price.company_fees) - Number(this.creditor)
        },
        spinnercheck:function(){
            if (this.form.delivery_date != '') {
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
            this.form.datepassport = fulldate
            // console.log(fulldate)
        }
    },
    computed:{

    },
    created(){
        this.getapplicants()
        this.getbranches()
        this.getdate();
    },
    mounted() {
        $(".applicant").select2();
    },
    components:{
        'select2':Select2
    },
}
</script>

<style scoped>
.table tbody tr .alert{
    padding: 10px !important;
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
.alert input{
    padding: 10px
}
.total{
    display: flex;
    justify-content: center;
    font-size: 40px;
}
.is_valid{
    border: 1px solid red;
    box-shadow: 0 0 3px 0px red;
}
</style>

