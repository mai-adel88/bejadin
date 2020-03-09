<template>
    <div class="box" style="background: #fafbff">
        <div class="box-body">
            <form @submit.prevent="login">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>{{ trans('admin.date') }}</label>
                        <input :disabled="disabledform"  v-model="form.created_at" type="date" name="created_at" class="form-control" :class="{ 'is-invalid': form.errors.has('created_at') }" @change="branchechange">
                        <has-error :form="form" field="created_at"></has-error>
                    </div>
                    <div class="col-md-6">
                        <label>{{ trans('admin.date_hijri') }}</label>
                        <input v-model="form.date" type="text" name="date" class="form-control" :class="{ 'is-invalid': form.errors.has('date') }" readonly>
                        <has-error :form="form" field="date"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>{{ trans('admin.account_type') }}</label>
                        <select :disabled="disabledform" v-model="form.operations" name="limitations" class="form-control operations" :class="{ 'is-invalid': form.errors.has('operations') }" @change="operationschange(form.operations)">
                            <option value="" selected>{{ trans('admin.select') }}</option>
                            <option v-for="operation in operations" :value="operation.id">{{operation.name_ar}}</option>
                        </select>
                        <has-error :form="form" field="operations"></has-error>
                    </div>
                    <div class="col-md-4">
                        <label v-if="receiptsselect" v-for="ads in address">{{ads}}</label>
                        <label v-if="!address" style="margin-top: 15px"></label>
                        <label v-if="!receiptsselect" style="margin-top: 15px"></label>
                        <select2 :disabled="disabledform" class="form-control tree" name="tree" id="tree" v-model.number="form.tree" :class="{ 'is-invalid': form.errors.has('tree') }" v-on:input="getcc">
                            <option value="">Select one</option>
                            <template v-for="t in tree">
                                <option :value="t.id">{{t.name_ar}}{{t.dep_name_ar}}</option>
                            </template>
                        </select2>
                        <has-error :form="form" field="operations"></has-error>
                    </div>
                    <div class="col-md-4">
                        <label>{{ trans('admin.receipt_number') }}</label>
                        <input :disabled="disabledform" v-model="form.receipt_number" v-on:keyup.enter="addto" type="text" name="receipt_number" class="form-control" :class="{ 'is-invalid': form.errors.has('receipt_number') }">
                        <has-error :form="form" field="receipt_number"></has-error>
                    </div>
                </div>
                <div class="form-group row check" v-if="checkselect">
                    <div class="col-md-3">
                        <label>{{ trans('admin.check_number') }}</label>
                        <input :disabled="disabledform" v-model="form.check" v-on:keyup.enter="addto" type="text" name="check" class="form-control" :class="{ 'is-invalid': form.errors.has('check') }">
                        <has-error :form="form" field="check"></has-error>
                    </div>
                    <div class="col-md-3">
                        <label>{{ trans('admin.checkDate') }}</label>
                        <input :disabled="disabledform" v-model="form.checkDate" v-on:keyup.enter="addto" type="text" name="checkDate" class="form-control" :class="{ 'is-invalid': form.errors.has('checkDate') }">
                        <has-error :form="form" field="checkDate"></has-error>
                    </div>
                    <div class="col-md-3">
                        <label>{{ trans('admin.person_received') }}</label>
                        <input :disabled="disabledform" v-model="form.person" v-on:keyup.enter="addto" type="text" name="person" class="form-control" :class="{ 'is-invalid': form.errors.has('person') }">
                        <has-error :form="form" field="person"></has-error>
                    </div>
                    <div class="col-md-3">
                        <label>{{ trans('admin.person_taken') }}</label>
                        <input :disabled="disabledform" v-model="form.taken" v-on:keyup.enter="addto" type="text" name="person_taken" class="form-control" :class="{ 'is-invalid': form.errors.has('person_taken') }">
                        <has-error :form="form" field="taken"></has-error>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4" v-if="debtorselect">
                        <label>{{ trans('admin.amount') }}</label>
                        <input :disabled="disabledform" v-model.number="form.debtor" v-on:keyup.enter="addto" type="text" name="debtor" class="form-control" :class="{ 'is-invalid': form.errors.has('debtor') }">
                        <has-error :form="form" field="debtor"></has-error>
                    </div>
                    <div class="col-md-4" v-if="creditorselect">
                        <label>{{ trans('admin.amount') }}</label>
                        <input :disabled="disabledform" v-model.number="form.creditor" v-on:keyup.enter="addto" type="text" name="creditor" class="form-control" :class="{ 'is-invalid': form.errors.has('creditor') }">
                        <has-error :form="form" field="creditor"></has-error>
                    </div>
                    <div class="col-md-4" v-if="!creditorselect && !debtorselect">
                        <label>{{ trans('admin.amount') }}</label>
                        <input :disabled="disabledform" type="text" name="creditor" class="form-control" :class="{ 'is-invalid': form.errors.has('creditor') }">
                        <has-error :form="form" field="creditor"></has-error>
                    </div>
                    <div class="col-md-4">
                        <label>{{ trans('admin.tax') }} %</label>
                        <input :disabled="disabledform" v-model.number="form.tax" v-on:keyup.enter="addto" type="text" name="tax" class="form-control" :class="{ 'is-invalid': form.errors.has('tax') }">
                        <has-error :form="form" field="tax"></has-error>
                    </div>
                    <div class="col-md-2" v-if="creditorselect">
                        <label>{{ trans('admin.motion_creditor') }}</label>
                        <!-- <div>{{calccreditor}} {{trans('admin.EGP')}}</div> -->
                        <input v-if="creditorselect" type="text" class="form-control" disabled :value="calccreditor +' '+ trans('admin.EGP')" style="background: #dada3d;">
                    </div>
                    <div class="col-md-2" v-if="debtorselect">
                        <label>{{ trans('admin.motion_debtor') }}</label>
                        <!-- <div v-if="debtorselect">{{calcdebtor}} {{trans('admin.EGP')}}</div> -->
                        <input v-if="debtorselect" type="text" class="form-control" disabled :value="calcdebtor +' '+ trans('admin.EGP')" style="background: #dada3d;">
                    </div>
                    <div class="col-md-2" v-if="glccselect">
                        <label>{{ trans('admin.single_cc') }}</label>
                        <!-- <select @change="getccname" v-model="form.cc" name="tree" class="form-control" :class="{ 'is-invalid': form.errors.has('cc') }">
                            <option v-for="c, index in cc" :value="index">{{c}}</option>
                        </select> -->
                        <select2 :disabled="disabledform" v-on:input="getccname" v-model="form.cc" name="tree" class="form-control" :class="{ 'is-invalid': form.errors.has('cc') }">
                            <option selected value="">Select one</option>
                            <template v-for="c, index in cc">
                                <option :value="index">{{c}}</option>
                            </template>
                        </select2>
                        <has-error :form="form" field="cc"></has-error>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>{{ trans('admin.note_ar') }}</label>
                        <input :disabled="disabledform"  v-model="form.note" v-on:keyup.enter="addto" type="text" name="note" class="form-control" :class="{ 'is-invalid': form.errors.has('note') }">
                        <has-error :form="form" field="note"></has-error>
                    </div>
                    <div class="col-md-6">
                        <label>{{ trans('admin.note_en') }}</label>
                        <input :disabled="disabledform"  v-model="form.note_en" v-on:keyup.enter="addto" type="text" name="note_en" class="form-control" :class="{ 'is-invalid': form.errors.has('note_en') }">
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
                        <td @click="addtoform(index)">{{info.name_ar}}</td>
                        <td @click="addtoform(index)">{{info.debtor}}</td>
                        <td @click="addtoform(index)">{{info.creditor}}</td>
                        <td @click="addtoform(index)">{{info.note}}</td>
                        <td @click="addtoform(index)">{{info.note_en}}</td>
                        <td @click="addtoform(index)">{{info.cc_id ? cc[info.cc_id] : ' '}}</td>
                        <td><a href="JavaScript:Void(0);" @click="removerows(index)"><i class="fa fa-trash"></i></a></td>
                    </tr>


                    <!-- <tr v-if="creditorselect">
                        <td colspan="2"><strong>{{trans('admin.total_motion_creditor')}}</strong></td>
                        <td colspan="5"><strong>{{allcreditor}} {{trans('admin.EGP')}}</strong></td>
                        <input type="hidden" value="" class="totel_credit">
                    </tr>
                    <tr  v-if="debtorselect">
                        <td colspan="1"><strong>{{trans('admin.total_motion_debtor')}}</strong></td>
                        <td colspan="6"><strong>{{alldebtor}} {{trans('admin.EGP')}}</strong></td>
                        <input type="hidden" value="" class="totel_debtor">
                    </tr> -->
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-4">
                        <label v-if="!creditorselect && !debtorselect" style="margin-top: 15px"></label>
                        <label v-if="creditorselect">{{ trans('admin.dept_account') }}</label>
                        <label v-if="debtorselect">{{ trans('admin.credit_account') }}</label>
                        <select :disabled="disabledform" v-model="form.banksfunds" name="banksfunds" class="form-control" :class="{ 'is-invalid': form.errors.has('banksfunds') }">
                            <option value="" selected>{{ trans('admin.select') }}</option>
                            <option v-for="banksfund in banksfunds" :value="banksfund.id">{{banksfund.dep_name_ar}}</option>
                        </select>
                        <has-error :form="form" field="banksfunds"></has-error>
                    </div>
                    <div class="col-md-4">
                        <label>{{ trans('admin.note_ar') }}</label>
                        <input :disabled="disabledform" v-model="form.fnote" type="text" name="note" class="form-control" :class="{ 'is-invalid': form.errors.has('note') }">
                        <has-error :form="form" field="note"></has-error>
                    </div>
                    <div class="col-md-4">
                        <label>{{ trans('admin.note_en') }}</label>
                        <input :disabled="disabledform" v-model="form.fnote_en" type="text" name="note_en" class="form-control" :class="{ 'is-invalid': form.errors.has('note_en') }">
                        <has-error :form="form" field="note_en"></has-error>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3 position-relative" v-show="creditorselect">
                        <strong class="" style="top: 30px;right: 60px;position: absolute">{{trans('admin.total_motion_creditor')}}</strong>
                    </div>
                    <div class="col-md-3 position-relative" v-show="debtorselect">
                        <strong class="" style="top: 30px;right: 60px;position: absolute">{{trans('admin.total_motion_debtor')}}</strong>
                    </div>
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
                        <!-- <div id="subtract">{{form.fdebtor - form.fcreditor}}</div> {{trans('admin.EGP')}} -->
                        <input id="subtract" type="text" class="form-control" disabled :value="form.fdebtor - form.fcreditor +' '+ trans('admin.EGP')" style="background: #dada3d;">
                    </div>
                </div>
                <br>
                <button type="button" class="btn btn-primary" v-if="form.banksfunds" v-show="form.fdebtor != 0 && form.fcreditor != 0" @click="login">{{trans('admin.save_print')}}</button>
            </form>
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
                cc:[],
                ccname:'',
                address:'',
                tree:'',
                debtor:0,
                creditor:0,
                receiptnumber:0,
                branchselect:false,
                creditorselect:false,
                debtorselect:false,
                checkselect:false,
                glccselect:false,
                receiptsselect:false,
                disabledform:false,
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
                    'index':'',
                    'branches':'',
                    'created_at':'',
                    'name_ar':'',
                    'name_en':'',
                    'date':'',
                    'receipts':'',
                    'operations':'',
                    'tree':'',
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
                    'id':'',
                    'branches':'',
                    'created_at':'',
                    'date':'',
                    'receipts':'',
                    'name_ar':'',
                    'name_en':'',
                    'operations':'',
                    'relation_id':'',
                    'tree_id':'',
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
                    'cc_id':'',
                    'banksfunds':'',
                    'check':'',
                    'checkDate':'',
                    'person':'',
                    'taken':'',
                    'receipt_number':'',
                    'invoice': '',
                }],
                formindex:''
            }
        },
        props:['invoice','receiptstype','id','branchesid','created_at','date','limitationsnumber'],
        methods:{
            addtoform: function(index) {
                this.form.tree = null;
                if (this.infos[index].id != null) {
                    if (this.infos[index].debtor == this.infos[index].creditor == 0) {
                        this.disabledform = false
                        this.formindex = index
                        this.form.id = this.infos[index].id;
                        this.form.index = index;
                        this.getdate();
                        this.branchechange();
                        this.form.operations = this.infos[index].operation_id;
                        this.operationschange(this.form.operations,this.formindex)
                        this.form.name_ar = this.infos[index].name_ar;
                        this.form.tax = this.infos[index].tax;
                        this.form.debtor = this.infos[index].tax ? this.infos[index].debtor / ((this.infos[index].tax / 100) + 1) : this.infos[index].debtor;
                        this.form.creditor = this.infos[index].tax ? this.infos[index].creditor / ((this.infos[index].tax / 100) + 1) : this.infos[index].creditor;
                        this.form.note = this.infos[index].note;
                        this.form.note_en = this.infos[index].note_en;
                        $('#select2-tree-ih-container').text(this.cc[this.infos[index].cc_id])
                        this.form.cc = this.infos[index].cc_id;
                        this.glccselect = this.infos[index].cc_id != null ? true : false;
                    } else {
                        this.disabledform = false
                        this.formindex = index
                        this.form.id = this.infos[index].id;
                        this.form.index = index;
                        this.getdate();
                        this.branchechange();
                        this.form.operations = this.infos[index].operation_id;
                        this.operationschange(this.form.operations,this.formindex)
                        this.form.name_ar = this.infos[index].name_ar;
                        this.form.tax = this.infos[index].tax;
                        this.form.debtor = this.infos[index].tax ? this.infos[index].debtor / ((this.infos[index].tax / 100) + 1) : this.infos[index].debtor;
                        this.form.creditor = this.infos[index].tax ? this.infos[index].creditor / ((this.infos[index].tax / 100) + 1) : this.infos[index].creditor;
                        this.form.note = this.infos[index].note;
                        this.form.note_en = this.infos[index].note_en;
                        $('#select2-tree-ih-container').text(this.cc[this.infos[index].cc_id])
                        this.form.cc = this.infos[index].cc_id;
                        this.glccselect = this.infos[index].cc_id != null ? true : false;
                    }
                }else {
                    return '';
                }
            },
            getsinglereceipt(){
                axios.get('/api/admin/receipts/'+this.id+'/edit').then(response => {
                    this.infos = response.data[0];
                    this.form.banksfunds = response.data[1].tree_id;
                    if (this.receiptstype == 1 ||this.receiptstype == 2){
                        this.form.fdebtor = this.allcreditor;
                        this.form.fcreditor = this.allcreditor;
                    }else {
                        this.form.fdebtor = this.alldebtor;
                        this.form.fcreditor = this.alldebtor;
                    }
                    if (this.receiptstype == 2 ||this.receiptstype == 4){
                        this.form.check = response.data[1].check;
                        this.form.checkDate = moment(response.data[1].checkDate).format('YYYY-MM-DD');
                        this.form.person = response.data[1].person;
                        this.form.taken = response.data[1].taken;
                    }
                    this.form.receipt_number = response.data[1].receipt_number;
                    this.form.fnote = response.data[1].note;
                    this.form.fnote_en = response.data[1].note_en;
                })
            },
            updateDate: function(date) {
                this.form.date = date;
            },
            getcc(){
                this.glccselect = false;
                this.form.name_ar = $('.tree option:selected').text()
                this.form.name_en = $('.tree option:selected').text()
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
                    taken: this.form.taken,
                    person: this.form.person,
                    checkDate: this.form.checkDate,
                    check: this.form.check,
                    created_at:  this.form.created_at != '' ? this.form.created_at : this.created_at,
                    date:  this.form.date != '' ? this.form.date : this.date,
                });
                axios.put('/api/admin/receipts/'+this.id,this.infos).then(response => {
                    var url = response.data;
                    window.open(url, "_blank");
                    Swal.fire({
                        type: 'success',
                        title: 'تم تعديل السند بنجاح ^_^'
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
                if (this.receiptstype == 1 ||this.receiptstype == 2){
                    this.form.fcreditor = this.allcreditor;
                    this.form.fdebtor = this.form.fcreditor;
                }else {
                    this.form.fdebtor = this.alldebtor;
                    this.form.fcreditor = this.form.fdebtor;
                }
            },
            addto:function(){
                if (this.form.id){
                    this.infos.splice(this.form.index,1);
                    console.log(this.form.name_ar);
                    this.infos.push({
                        id: this.form.id,
                        branches: this.branchesid,
                        created_at:  this.created_at,
                        date:  this.date,
                        receipt_number: this.limitationsnumber,
                        operation_id: this.form.operations,
                        relation_id: this.form.tree,
                        name_ar: this.form.name_ar,
                        name_en: this.form.name_en,
                        debtor: this.form.debtor,
                        creditor: this.form.creditor,
                        note: this.form.note,
                        note_en: this.form.note_en,
                        cc_id: this.form.cc,
                        ccname: this.ccname,
                        invoice_id: this.invoice,
                        tax: this.form.tax,
                    });
                    this.form.id = '';
                    this.form.name_ar = '';
                    this.form.name_en = '';
                    this.form.creditor = 0;
                    this.form.debtor = 0;
                    this.form.tax = 0;
                    this.ccname = '';
                    if (this.receiptstype == 1 ||this.receiptstype == 2){
                        console.log(this.allcreditor);
                        this.form.fcreditor = this.allcreditor;
                        this.form.fdebtor = this.allcreditor;
                    }else {
                        this.form.fdebtor = this.alldebtor;
                        this.form.fcreditor = this.alldebtor;
                    }
                    this.form.fnote = this.form.note;
                    this.form.fnote_en = this.form.note_en;
                }else{
                    console.log(this.form.name_ar);
                    this.infos.push({
                        receipts: this.id,
                        branches: this.branchesid,
                        created_at:  this.created_at,
                        date:  this.date,
                        operation_id: this.form.operations,
                        relation_id: this.form.tree,
                        name_ar: $('.tree option:selected').text(),
                        name_en: $('.tree option:selected').text(),
                        debtor: this.calcdebtor,
                        creditor: this.calccreditor,
                        note: this.form.note,
                        note_en: this.form.note_en,
                        tax: this.form.tax,
                        cc_id: this.form.cc,
                        ccname: this.ccname,
                        receipt_number: this.limitationsnumber,
                        invoice_id: this.invoice,
                    });
                    this.form.debtor = 0;
                    this.form.creditor = 0;
                    this.form.tax = 0;
                    if (this.receiptstype == 1 ||this.receiptstype == 2){
                        this.form.fdebtor = this.allcreditor;
                        this.form.fcreditor = this.allcreditor;
                    }else {
                        this.form.fdebtor = this.alldebtor;
                        this.form.fcreditor = this.alldebtor;
                    }
                    this.form.fnote = this.form.note;
                    this.form.fnote_en = this.form.note_en;
                }
                this.form.cc = ''
            },
            deleteFind: function (index) {
                this.infos.splice(index,1);
            },
            operationschange:function(operation,index=null){
                if (this.tree != null) {
                    this.tree = null;
                }
                if (operation != '') {
                    axios.get('/api/admin/roperations/' + operation).then(response => {
                        // this.form.tree = null;
                        // this.form.cc = null;
                        // this.glccselect = false;
                        this.tree = response.data[0];
                        this.address = response.data[1];
                    }).finally(()=>{
                        if (index != null) {
                            $('#select2-tree-container').text(this.infos[index].name_ar)

                            this.form.tree = this.infos[index].relation_id;
                        }
                    })
                }
                if (operation == ''){
                    return this.receiptsselect = false;
                }else {
                    return this.receiptsselect = true;
                }
            },
            branchechange:function(e){
                if(this.form.created_at){
                    var formatter = new Intl.DateTimeFormat("ar-Sa-u-ca-islamicc")
                    this.form.date = formatter.format(new Date(this.form.created_at))
                }
            },
            getdate:function(){
                var date = new Date(this.created_at)
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
                console.log(fulldate)
            }
        },
        created(){
            // this.getdate();
            axios.get('/api/admin/receipts').then(response => {
                this.branches = response.data[1]
            });
            axios.get('/api/admin/receipts').then(response => {
                this.receipts = response.data[0]
            });
            axios.get('/api/admin/receipts').then(response => {
                this.operations = response.data[2]
            });
            axios.get('/api/admin/receipts').then(response => {
                this.cc = response.data[3]
            });
            axios.get('/api/admin/receipts').then(response => {
                this.banksfunds = response.data[4]
            });
            this.operationschange();
            this.deleteFind();
            this.calccreditor;
            this.calcdebtor;
            this.getsinglereceipt();
            if (this.receiptstype == 2 || this.receiptstype == 4){
                this.checkselect = true;
            }else {
                this.checkselect = false;
            }
            if (this.receiptstype == 1 || this.receiptstype == 2){
                this.creditorselect = true;
                this.debtorselect = false;
            }else {
                this.creditorselect = false;
                this.debtorselect = true;
            }

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
            }
        },
        mounted() {
            $("#tree").select2();
        },
        components:{
          'select2':Select2
        },
    }
</script>
