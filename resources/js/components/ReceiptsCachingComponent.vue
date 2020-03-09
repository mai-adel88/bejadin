<style>
    .check .col-md-3{
        width: 25%;
    }
</style>
<template>
    <div>
        <div class="box limitations">
            <div class="box-header">
                <h3 class="box-title">اضافة سند جديد</h3>
                <label v-if="receiptnumber" style="float: left ;font-size:20px">رقم السند {{receiptnumber}}</label>
            </div>
            <div class="box-body">
                <form @submit.prevent="login">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label>{{ trans('admin.branche') }}</label>
                            <select v-model="form.branches" name="branches" class="form-control" :class="{ 'is-invalid': form.errors.has('branches') }" @change="branchechange">
                                <option value="" selected>{{ trans('admin.select') }}</option>
                                <option v-for="branche in branches" :value="branche.id">{{branche.name_ar}}</option>
                            </select>
                            <has-error :form="form" field="branches"></has-error>
                        </div>
                        <div class="col-md-3">
                            <label>{{ trans('admin.date') }}</label>
                            <input  v-model="form.created_at" type="date" name="created_at" class="form-control" :class="{ 'is-invalid': form.errors.has('created_at') }" @change="branchechange">
                            <has-error :form="form" field="created_at"></has-error>
                        </div>
                        <div class="col-md-3">
                            <label>{{ trans('admin.date_hijri') }}</label>
                            <input  v-model="form.date" type="text" name="date" class="form-control" :class="{ 'is-invalid': form.errors.has('date') }" readonly>
                            <has-error :form="form" field="date"></has-error>
                        </div>
                        <div class="col-md-3">
                            <label>{{ trans('admin.receipts_type') }}</label>
                            <select v-model="form.receipts" name="receipts" class="form-control" :class="{ 'is-invalid': form.errors.has('receipts') }" @change="receiptschange">
                                <option value="" selected>{{ trans('admin.select') }}</option>
                                <option v-if="branchselect" v-for="receipt in receipts" :value="receipt.id">{{receipt.name_ar}}</option>
                            </select>
                            <has-error :form="form" field="receipts"></has-error>
                        </div>
                        <div class="col-md-3">
                            <label>{{ trans('admin.account_type') }}</label>
                            <select v-model="form.operations" name="limitations" class="form-control operations" :class="{ 'is-invalid': form.errors.has('operations') }" @change="operationschange(form.operations)">
                                <option value="" selected>{{ trans('admin.select') }}</option>
                                <option v-if="receiptsselect && branchselect" v-for="operation in operations" :value="operation.id">{{operation.name_ar}}</option>
                            </select>
                            <has-error :form="form" field="operations"></has-error>
                        </div>
                    </div>
                    <div class="form-group row check" v-if="checkselect">
                        <div class="col-md-3">
                            <label>{{ trans('admin.check_number') }}</label>
                            <input v-model="form.check" v-on:keyup.enter="addto" type="text" name="check" class="form-control" :class="{ 'is-invalid': form.errors.has('check') }">
                            <has-error :form="form" field="check"></has-error>
                        </div>
                        <div class="col-md-3">
                            <label>{{ trans('admin.checkDate') }}</label>
                            <input v-model="form.checkDate" v-on:keyup.enter="addto" type="date" name="checkDate" class="form-control" :class="{ 'is-invalid': form.errors.has('checkDate') }">
                            <has-error :form="form" field="checkDate"></has-error>
                        </div>
                        <div class="col-md-3">
                            <label>{{ trans('admin.person_received') }}</label>
                            <input v-model="form.person" v-on:keyup.enter="addto" type="text" name="person" class="form-control" :class="{ 'is-invalid': form.errors.has('person') }">
                            <has-error :form="form" field="person"></has-error>
                        </div>
                        <div class="col-md-3">
                            <label>{{ trans('admin.person_taken') }}</label>
                            <input v-model="form.taken" v-on:keyup.enter="addto" type="text" name="person_taken" class="form-control" :class="{ 'is-invalid': form.errors.has('person_taken') }">
                            <has-error :form="form" field="taken"></has-error>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label v-if="receiptsselect && branchselect" v-for="ads in address">{{ads}}</label>
                            <label v-if="!address" style="margin-top: 15px"></label>
                            <label v-if="!receiptsselect || !branchselect" style="margin-top: 15px"></label>
                            <select2 class="form-control tree" id="tree" v-model.number="form.tree" :class="{ 'is-invalid': form.errors.has('tree') }" v-on:input="getcc()">
                                <option selected :value="0">Select one</option>
                                <template v-for="t in tree">
                                    <option v-if="receiptsselect && branchselect" :value="t.id">{{t.name_ar}}{{t.dep_name_ar}}</option>
                                </template>
                            </select2>
                            <has-error :form="form" field="operations"></has-error>
                        </div>
                        <div class="col-md-3" v-if="debtorselect">
                            <label>{{ trans('admin.amount') }}</label>
                            <input v-model.number="form.debtor" v-on:keyup.enter="addto" type="text" name="debtor" class="form-control" :class="{ 'is-invalid': form.errors.has('debtor') }">
                            <has-error :form="form" field="debtor"></has-error>
                        </div>
                        <div class="col-md-3" v-if="creditorselect">
                            <label>{{ trans('admin.amount') }}</label>
                            <input v-model.number="form.creditor" v-on:keyup.enter="addto" type="text" name="creditor" class="form-control" :class="{ 'is-invalid': form.errors.has('creditor') }">
                            <has-error :form="form" field="creditor"></has-error>
                        </div>
                        <div class="col-md-3" v-if="!creditorselect && !debtorselect">
                            <label>{{ trans('admin.amount') }}</label>
                            <input type="text" name="creditor" class="form-control" :class="{ 'is-invalid': form.errors.has('creditor') }">
                            <has-error :form="form" field="creditor"></has-error>
                        </div>
                        <div class="col-md-3">
                            <label>{{ trans('admin.tax') }} %</label>
                            <input v-model.number="form.tax" v-on:keyup.enter="addto" type="text" name="tax" class="form-control" :class="{ 'is-invalid': form.errors.has('tax') }">
                            <has-error :form="form" field="tax"></has-error>
                        </div>
                        <div class="col-md-3" v-if="creditorselect">
                            <label>{{ trans('admin.motion_creditor') }}</label>
                            <input class="form-control" disabled :value="calccreditor" style="background: #dada3d;">
                            <!--                            <div>{{calccreditor}}</div>-->
                        </div>
                        <div class="col-md-3" v-if="debtorselect">
                            <label>{{ trans('admin.motion_debtor') }}</label>
                            <input v-if="debtorselect" class="form-control" disabled :value="calcdebtor" style="background: #dada3d;">
<!--                            <div v-if="debtorselect">{{calcdebtor}}</div>-->
                        </div>
                        <div class="col-md-3" v-if="glccselect && receiptsselect && branchselect">
                            <label>{{ trans('admin.single_cc') }}</label>
                            <!-- <select @change="getccname" v-model="form.cc" name="tree" class="form-control" :class="{ 'is-invalid': form.errors.has('cc') }">
                                <option value="">Select one</option>
                                <option v-for="c, index in cc" :value="index">{{c}}</option>
                            </select> -->
                            <select2 v-on:input="getccname" v-model="form.cc" name="tree" class="form-control" :class="{ 'is-invalid': form.errors.has('cc') }">
                                <option selected value="">Select one</option>
                                <template v-for="c, index in cc">
                                    <option :value="index">{{c}}</option>
                                </template>
                            </select2>
                            <has-error :form="form" field="cc"></has-error>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>{{ trans('admin.receipt_number') }}</label>
                            <input v-model="form.receipt_number" v-on:keyup.enter="addto" type="text" name="receipt_number" class="form-control" :class="{ 'is-invalid': form.errors.has('receipt_number') }">
                            <has-error :form="form" field="receipt_number"></has-error>
                        </div>
                        <div class="col-md-5">
                            <label>{{ trans('admin.note_ar') }}</label>
                            <input  v-model="form.note" v-on:keyup.enter="addto" type="text" name="note" class="form-control" :class="{ 'is-invalid': form.errors.has('note') }">
                            <has-error :form="form" field="note"></has-error>
                        </div>
                        <div class="col-md-5">
                            <label>{{ trans('admin.note_en') }}</label>
                            <input  v-model="form.note_en" v-on:keyup.enter="addto" type="text" name="note_en" class="form-control" :class="{ 'is-invalid': form.errors.has('note_en') }">
                            <has-error :form="form" field="note_en"></has-error>
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered table-striped table-hover data-table">
                        <thead>
                        <tr>
                            <th>{{trans('admin.account_name')}}</th>
                            <th>{{trans('admin.motion_debtor')}}</th>
                            <th>{{trans('admin.motion_creditor')}}</th>
                            <th>{{trans('admin.note_ar')}}</th>
                            <th>{{trans('admin.note_en')}}</th>
                            <th>{{trans('admin.single_cc')}}</th>
                            <th>{{trans('admin.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="info,index in infos">
                            <td>{{info.name}}</td>
                            <td>{{info.debtor}}</td>
                            <td>{{info.creditor}}</td>
                            <td>{{info.note}}</td>
                            <td>{{info.note_en}}</td>
                            <td>{{info.ccname}}</td>
                            <td><a href="JavaScript:Void(0);" @click="removerows(index)"><i class="fa fa-trash"></i></a></td>
                        </tr>


<!--                        <tr v-if="creditorselect">-->
<!--                            <td colspan="2"><strong>{{trans('admin.total_motion_creditor')}}</strong></td>-->
<!--                            <td colspan="5"><strong>{{allcreditor}}</strong></td>-->
<!--                            <input type="hidden" value="" class="totel_credit">-->
<!--                        </tr>-->
<!--                        <tr  v-if="debtorselect">-->
<!--                            <td colspan="1"><strong>{{trans('admin.total_motion_debtor')}}</strong></td>-->
<!--                            <td colspan="6"><strong>{{alldebtor}}</strong></td>-->
<!--                            <input type="hidden" value="" class="totel_debtor">-->
<!--                        </tr>-->
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-4">
                            <label v-if="!creditorselect && !debtorselect" style="margin-top: 15px"></label>
                            <label v-if="creditorselect">{{ trans('admin.dept_account') }}</label>
                            <label v-if="debtorselect">{{ trans('admin.credit_account') }}</label>
                            <select v-model="form.banksfunds" name="banksfunds" class="form-control" :class="{ 'is-invalid': form.errors.has('banksfunds') }">
                                <option value="" selected>{{ trans('admin.select') }}</option>
                                <option v-if="branchselect" v-for="banksfund in banksfunds" :value="banksfund.id">{{banksfund.dep_name_ar}}</option>
                            </select>
                            <has-error :form="form" field="banksfunds"></has-error>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('admin.note_ar') }}</label>
                            <input  v-model="form.fnote" type="text" name="note" class="form-control" :class="{ 'is-invalid': form.errors.has('note') }">
                            <has-error :form="form" field="note"></has-error>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('admin.note_en') }}</label>
                            <input  v-model="form.fnote_en" type="text" name="note_en" class="form-control" :class="{ 'is-invalid': form.errors.has('note_en') }">
                            <has-error :form="form" field="note_en"></has-error>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 position-relative">
                            <strong class="" style="top: 30px;right: 60px;position: absolute">{{trans('admin.total_motion_creditor')}}</strong>
                        </div>
                        <!-- <div class="col-md-4 position-relative" v-show="debtorselect">
                            <strong class="" style="top: 30px;right: 60px;position: absolute">{{trans('admin.total_motion_debtor')}}</strong>
                        </div> -->
                        <div class="col-md-3">
                            <label>{{ trans('admin.debtor') }}</label>
                            <input v-model="form.fdebtor" type="text" name="fdebtor" class="form-control" :class="{ 'is-invalid': form.errors.has('fdebtor') }" readonly="readonly">
                            <has-error :form="form" field="fdebtor"></has-error>
                        </div>
                        <div class="col-md-3">
                            <label>{{ trans('admin.creditor') }}</label>
                            <input v-model="form.fcreditor" type="text" name="fcreditor" class="form-control" :class="{ 'is-invalid': form.errors.has('fcreditor') }" readonly="readonly">
                            <has-error :form="form" field="fcreditor"></has-error>
                        </div>
                        <div class="col-md-3">
                            <label>{{ trans('admin.subtract') }}</label>
                            <input id="subtract" class="form-control" disabled :value="form.fdebtor - form.fcreditor" style="background: #dada3d;">
<!--                            <div id="subtract">{{form.fdebtor - form.fcreditor}}</div>-->
                        </div>
                    </div>
                    <br>
                    <button type="button" class="btn btn-primary" v-if="form.banksfunds" v-show="form.fdebtor != 0 && form.fcreditor != 0" @click="login">{{trans('admin.save_print')}}</button>
                    <a href="/admin/banks/Receipt/receipts/caching/caching" class="btn btn-danger" v-if="form.banksfunds" v-show="form.fdebtor != 0 && form.fcreditor != 0">تراجع</a>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Select2 from './Select2.vue';
    export default {
        data(){
            return{
                dateFormat:'yy-mm-dd',
                branches:'',
                receipts:'',
                operations:'',
                banksfunds:'',
                cc:'',
                options: [],
                ccname:'',
                address:'',
                tree:null,
                debtor:0,
                creditor:0,
                receiptnumber:0,
                branchselect:false,
                creditorselect:false,
                debtorselect:false,
                checkselect:false,
                glccselect:false,
                receiptsselect:false,
                month_for:[{
                    title:'يناير',
                    id:1
                },{
                    title:'فبراير',
                    id:2
                },{
                    title:'مارس',
                    id:3
                },{
                    title:'ابريل',
                    id:4
                },{
                    title:'مايو',
                    id:5
                },{
                    title:'يونيو',
                    id:6
                },{
                    title:'يوليو',
                    id:7
                },{
                    title:'أغسطس',
                    id:8
                },{
                    title:'سبتمبر',
                    id:9
                },{
                    title:'أكتوبر',
                    id:10
                },{
                    title:'نوفمبر',
                    id:11
                },{
                    title:'ديسمبر',
                    id:12
                },
                ],
                kind:[],
                type:[],
                form: new Form({
                    'id':'',
                    'branches':'',
                    'created_at':''/*new Date().toISOString().slice(0,10)*/,
                    'date':''/*new Intl.DateTimeFormat("en-Sa-u-ca-islamicc").format(new Date(new Date().toISOString().slice(0,10)))*/,
                    'receipts':'',
                    'operations':'',
                    'tree':0,
                    'debtor':'',
                    'creditor':'',
                    'fdebtor':0,
                    'fcreditor':0,
                    'tax':'',
                    'note':'',
                    'note_en':'',
                    'fnote':'',
                    'fnote_en':'',
                    'cc':'',
                    'banksfunds':'',
                    'check':'',
                    'checkDate':'',
                    'person':'',
                    'taken':'',
                    'receipt_number':'',
                    'invoice': this.invoice,
                }),
                infos: [{
                    'branches':'',
                    'created_at':'',
                    'date':'',
                    'receipts':'',
                    'operations':'',
                    'tree':[],
                    'debtor':'',
                    'creditor':'',
                    'fdebtor':'',
                    'fcreditor':'',
                    'tax':'',
                    'note':'',
                    'note_en':'',
                    'fnote':'',
                    'fnote_en':'',
                    'cc':'',
                    'banksfunds':'',
                    'check':'',
                    'checkDate':'',
                    'person':'',
                    'taken':'',
                    'receipt_number':'',
                    'invoice': '',
                    'receipt_number_data':'',
                }],
            }
        },
        props:['invoice'],
        methods:{
            updateDate: function(date) {
                this.form.date = date;
            },
            getcc(){
                this.glccselect = false;
                this.form.cc = ''
                this.ccname = ''
                if (this.form.tree != '' && this.form.operations != ''){
                    axios.get('/api/admin/rgetcc/'+this.form.tree+'/'+this.form.operations).then(response => {
                        if (response.data[0] == 1){
                            this.glccselect = true;
                            this.cc = response.data[1] ? response.data[1] : null;
                        }else{
                            this.glccselect = false;
                        }
                    })
                }
            },
            getccname(){
                axios.get('/api/admin/rgetccname/'+this.form.cc).then(response => {
                    this.ccname = response.data;
                })
            },
            login(){
                this.$Progress.start();
                this.infos.push({
                    fdebtor: this.form.fdebtor,
                    fcreditor: this.form.fcreditor,
                    fnote: this.form.fnote,
                    fnote_en: this.form.fnote_en,
                    banksfunds: this.form.banksfunds,
                    receipt_number_data: this.form.receipt_number,
                });
                axios.post('/api/admin/receipts/store',this.infos).then(response => {
                    var url = response.data;
                    window.open(url, "_blank");
                    Swal.fire({
                        type: 'success',
                        title: 'تم حفظ السند بنجاح ^_^'
                    }).then(() => {
                        location.reload();
                    }).catch(e => {
                        Swal.fire({
                            type: 'danger',
                            title: 'يوجد خطأ ما في السند'
                        })
                    });
                    this.$Progress.finish();
                    this.infos.splice(0);
                    // location.reload();
                })
            },
            removerows:function(index){
                this.$delete(this.infos, index);
                if (this.form.receipts == 1 ||this.form.receipts == 2){
                    this.form.fcreditor = this.allcreditor;
                    this.form.fdebtor = this.form.fcreditor;
                }else {
                    this.form.fdebtor = this.alldebtor;
                    this.form.fcreditor = this.form.fdebtor;
                }
            },
            addto:function(){
                if (this.form.branches != '' && this.form.created_at != '' && this.form.limitations != '' && this.form.operations != '' && this.form.tree != '' && this.form.tree != null){
                    this.infos.push({
                        branches: this.form.branches,
                        created_at:  this.form.created_at,
                        date:  this.form.date,
                        receipts: this.form.receipts,
                        operations: this.form.operations,
                        tree: this.form.tree,
                        name: $('.tree option:selected').text(),
                        debtor: this.calcdebtor,
                        creditor: this.calccreditor,
                        note: this.form.note,
                        note_en: this.form.note_en,
                        tax: this.form.tax,
                        cc: this.form.cc,
                        ccname: this.ccname,
                        taken: this.form.taken,
                        person: this.form.person,
                        checkDate: this.form.checkDate,
                        check: this.form.check,
                        receipt_number: this.receiptnumber,
                        invoice: this.invoice,
                    });
                    this.form.debtor = 0;
                    this.form.creditor = 0;
                    this.form.tax = 0;
                    this.ccname = '';
                    if (this.form.receipts == 1 ||this.form.receipts == 2){
                        this.form.fcreditor = this.allcreditor;
                        this.form.fdebtor = this.form.fcreditor;
                    }else {
                        this.form.fdebtor = this.alldebtor;
                        this.form.fcreditor = this.form.fdebtor;
                        this.form.fnote = this.alldebtor;
                    }
                    this.form.fnote = this.form.note;
                    this.form.fnote_en = this.form.note_en;
                }else{
                    ''
                }

            },
            deleteFind: function (index) {
                this.infos.splice(index,1);
            },
            branchechange:function(e){
                if(this.form.created_at){
                    var formatter = new Intl.DateTimeFormat("ar-Sa-u-ca-islamicc");
                    this.form.date = formatter.format(new Date(this.form.created_at))
                }
                if (this.form.created_at == '' || this.form.branches == ''){
                    return this.branchselect = false;
                }else {
                    return this.branchselect = true;
                }
            },
            receiptschange:function(e){
                axios.get('/api/admin/receiptnum/'+ this.form.receipts).then(response => {
                    this.receiptnumber = response.data;
                });
                if (this.form.receipts == 1 || this.form.receipts == 2){
                    this.creditorselect = true;
                    this.debtorselect = false;
                    this.infos.splice(0);
                    this.form.fdebtor = 0;
                    this.form.tax = 0;
                    this.form.fcreditor = 0;
                }else {
                    this.creditorselect = false;
                    this.debtorselect = true;
                    this.infos.splice(0);
                    this.form.fdebtor = 0;
                    this.form.tax = 0;
                    this.form.fcreditor = 0;
                }
                if (this.form.receipts == 2 || this.form.receipts == 4){
                    this.checkselect = true;
                }else {
                    this.checkselect = false;
                }
                if (e.target.value == ''){
                    return this.receiptsselect = false;
                }else {
                    return this.receiptsselect = true;
                }
            },
            operationschange:function(operation){
                // $('.select2-selection__rendered').html('')
                if (this.tree != null) {
                    this.tree = null;
                }
                axios.get('/api/admin/roperations/'+ operation).then(response => {
                    this.form.tree = null;
                    this.form.cc = null;
                    this.glccselect = false;


                    this.tree = response.data[0];
                    this.address = response.data[1];
                });
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
                this.form.created_at = fulldate
                this.branchechange();
                console.log(this.form.created_at)
            }
        },
        created(){
            this.getdate();
            axios.get('/api/admin/receipts').then(response => {
                this.branches = response.data[1]
            });
            axios.get('/api/admin/receipts/caching').then(response => {
                this.receipts = response.data[0]
            });
            axios.get('/api/admin/receipts').then(response => {
                this.operations = response.data[2]
            });
            axios.get('/api/admin/receipts').then(response => {
                this.banksfunds = response.data[4]
            });
            this.operationschange();
            this.deleteFind();
            this.calccreditor;
            this.calcdebtor;
            this.gettext;
        },
        computed:{
            alldebtor: function() {
                if (!this.infos) {
                    return 0;
                }
                return this.infos.reduce(function (total, value) {
                    return total + Number(value.debtor);
                }, 0);
            },
            allcreditor: function() {
                if (!this.infos) {
                    return 0;
                }
                return this.infos.reduce(function (total, value) {
                    return total + Number(value.creditor);
                }, 0);
            },
            calccreditor: function() {
                return this.form.creditor + (this.form.creditor/100 * this.form.tax);
            },
            calcdebtor: function() {
                return this.form.debtor + (this.form.debtor/100 * this.form.tax);
            },
        },
        mounted() {
            $("#tree").select2();
        },
        components:{
            'select2':Select2
        },
    }
</script>
