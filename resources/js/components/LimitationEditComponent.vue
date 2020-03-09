<template>
    <div class="box" style="background: #fafbff">
        <div class="box-body">
            <div class="form-group row">
                <div class="col-md-4">
                    <label>{{ trans('admin.date') }}</label>
                    <input  v-model="form.created_at" type="date" name="created_at" class="form-control" :class="{ 'is-invalid': form.errors.has('created_at') }" @change="branchechange">
                    <has-error :form="form" field="created_at"></has-error>
                </div>
                <div class="col-md-4">
                    <label>{{ trans('admin.date_hijri') }}</label>
                    <input  v-model="form.date" type="text" name="date" class="form-control" :class="{ 'is-invalid': form.errors.has('date') }" readonly>
                    <has-error :form="form" field="date"></has-error>
                </div>
                <div class="col-md-4">
                    <label>{{ trans('admin.account_type') }}</label>
                    <select v-model="form.operations" name="limitations" class="form-control operations" :class="{ 'is-invalid': form.errors.has('operations') }" @change="operationschange(form.operations)">
                        <option value="" selected>{{ trans('admin.select') }}</option>
                        <option v-for="operation in operations" :value="operation.id">{{operation.name_ar}}</option>
                    </select>
                    <has-error :form="form" field="operations"></has-error>
                </div>
            </div>
            <div class="row">
                <input v-model="form.name_ar" type="hidden" name="name_ar" class="form-control" :class="{ 'is-invalid': form.errors.has('name_ar') }">
                <div class="col-md-4">
                    <label v-if="operationselect" v-for="ads in address">{{ads}}</label>
                    <label v-if="!address" style="margin-top: 15px"></label>
                    <label v-if="!operationselect" style="margin-top: 15px"></label>
                    <!-- <select v-model.number="form.tree" name="tree" class="form-control tree" :class="{ 'is-invalid': form.errors.has('tree') }" @change="getcc">
                        <option v-for="t in tree" :value="t.id">{{t.name_ar}}{{t.dep_name_ar}}</option>
                    </select> -->
                    <select2 class="form-control tree" name="tree" id="tree" v-model.number="form.tree" :class="{ 'is-invalid': form.errors.has('tree') }" v-on:input="getcc()">
                        <option selected value="">Select one</option>
                        <template v-for="t in tree">
                            <option :value="t.id">{{t.name_ar}}{{t.dep_name_ar}}</option>
                        </template>
                    </select2>
                    <has-error :form="form" field="operations"></has-error>
                </div>
                <div class="col-md-4">
                    <label>{{ trans('admin.month_for') }}</label>
                    <select v-model="form.month_for" name="tree" class="form-control month" :class="{ 'is-invalid': form.errors.has('month_for') }">
                        <option value="">{{ trans('admin.select') }}</option>
                        <option v-for="month in month_for" :value="month.id">{{month.title}}</option>
                    </select>
                    <has-error :form="form" field="month_for"></has-error>
                </div>
                <div class="col-md-4">
                    <label>{{ trans('admin.receipt_number') }}</label>
                    <input v-model="form.receipt_number" v-on:keyup.enter="addto" type="text" name="receipt_number" class="form-control" :class="{ 'is-invalid': form.errors.has('receipt_number') }">
                    <has-error :form="form" field="receipt_number"></has-error>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{ trans('admin.movement_indebted') }}</label>
                    <input v-model="form.debtor" v-on:keyup.enter="addto" type="text" name="debtor" class="form-control" :class="{ 'is-invalid': form.errors.has('debtor') }">
                    <has-error :form="form" field="debtor"></has-error>
                </div>
                <div class="col-md-4">
                    <label>{{ trans('admin.motion_creditor') }}</label>
                    <input v-model="form.creditor" v-on:keyup.enter="addto" type="text" name="note" class="form-control" :class="{ 'is-invalid': form.errors.has('creditor') }">
                    <has-error :form="form" field="creditor"></has-error>
                </div>
                <div class="col-md-4" v-if="glccselect">
                    <label>{{ trans('admin.single_cc') }}</label>
                    <!-- <select @change="getccname" v-model="form.cc" name="tree" class="form-control" :class="{ 'is-invalid': form.errors.has('cc') }">
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
                <div class="col-md-6">
                    <label>{{ trans('admin.note_ar') }}</label>
                    <input  v-model="form.note" v-on:keyup.enter="addto" type="text" name="note" class="form-control" :class="{ 'is-invalid': form.errors.has('note') }">
                    <has-error :form="form" field="note"></has-error>
                </div>
                <div class="col-md-6">
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
                    <th>{{trans('admin.month_for')}}</th>
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
                    <td @click="addtoform(index)">{{info.month_for != '' && info.month_for != null ? month_for[info.month_for - 1].title : ' '}}</td>
                    <td><a href="JavaScript:Void(0);" @click="removerows(index)"><i class="fa fa-trash"></i></a></td>
                </tr>


                <tr>
                    <td colspan="2"><strong>{{trans('admin.total_motion_creditor')}}</strong></td>
                    <td colspan="6"><strong>{{allcreditor}} {{trans('admin.EGP')}}</strong></td>
                    <input type="hidden" value="" class="totel_credit">
                </tr>
                <tr>
                    <td colspan="1"><strong>{{trans('admin.total_motion_debtor')}}</strong></td>
                    <td colspan="7"><strong>{{alldebtor}} {{trans('admin.EGP')}}</strong></td>
                    <input type="hidden" value="" class="totel_debtor">
                </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary" v-if="allcreditor == alldebtor" v-show="allcreditor != 0 && alldebtor != 0" @click="login">{{trans('admin.save_print')}}</button>
        </div>
    </div>
</template>

<script>
    import Select2 from './Select2.vue';
import { setTimeout } from 'timers';
    export default {
        mounted() {
            console.log('mounted');
        },
        data(){
            return{
                dateFormat:'yy-mm-dd',
                branches:'',
                limitations:'',
                operations:'',
                cc:[],
                ccname:'',
                address:'',
                tree:'',
                debtor:0,
                creditor:0,
                limitationnumber:0,
                glccselect:false,
                operationselect:false,
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
                    // 'name_ar':'',
                    'branches':'',
                    'created_at':'',
                    'date':'',
                    'limitations':'',
                    'operations':'',
                    'tree':'',
                    'relation':'',
                    'debtor':0,
                    'creditor':0,
                    'month_for':'',
                    'note':'',
                    'note_en':'',
                    'cc':'',
                    'receipt_number':'',
                    'invoice': this.invoice,
                }),
                infos: [{
                    'id':'',
                    'branches':'',
                    'date':'',
                    'created_at':'',
                    'limitations_id':'',
                    'operation_id':'',
                    'tree_id':'',
                    'relation_id':'',
                    'name_ar':'',
                    'name_en':'',
                    'debtor':'',
                    'creditor':'',
                    'month_for':'',
                    'monthname':'',
                    'note':'',
                    'note_en':'',
                    'cc_id':'',
                    'ccname':'',
                    'receipt_number':'',
                    'limitationnumber':'',
                    'invoice_id': '',
                }],
                formindex:''
            }
        },
        props:['invoice','id','branchesid','created_at','date','limitationsnumber'],
        methods:{
            addtoform: function(index) {
                this.form.tree = null;
                if (this.infos[index].id != null && this.infos[index].id != '') {
                    this.formindex = index
                    this.form.id = this.infos[index].id;
                    this.form.index = index;
                    this.form.operations = this.infos[index].operation_id;
                    this.getdate();
                    this.branchechange();
                    this.operationschange(this.form.operations,this.formindex)
                    this.form.name_ar = this.infos[index].name_ar;
                    // this.form.tree = this.infos[index].relation_id;
                    this.form.relation = this.infos[index].relation_id;
                    this.form.debtor = this.infos[index].debtor;
                    this.form.creditor = this.infos[index].creditor;
                    this.form.month_for = this.infos[index].month_for;
                    this.form.note = this.infos[index].note;
                    this.form.note_en = this.infos[index].note_en;
                     $('#select2-tree-ih-container').text(this.cc[this.infos[index].cc_id])
                    this.form.cc = this.infos[index].cc_id;
                    this.form.receipt_number = this.infos[index].receipt_number;
                    this.glccselect = this.infos[index].cc_id != null ? true : false;
                }else {
                    return '';
                }
            },
            updateDate: function(date) {
                this.form.date = date;
            },
            getcc(){
                this.glccselect = false;
                // this.form.relation = this.form.tree
                if (this.form.tree != '' && this.form.operations != ''){
                    axios.get('/api/admin/getcc/'+this.form.tree+'/'+this.form.operations).then(response => {

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
                axios.get('/api/admin/getccname/'+this.form.cc).then(response => {
                    this.ccname = response.data;
                })
            },
            login(){
                this.infos.push({
                    created_at:  this.form.created_at != '' ? this.form.created_at : this.created_at,
                    date:  this.form.date != '' ? this.form.date : this.date
                });
                this.$Progress.start();
                axios.put('/api/admin/limitations/'+this.id,this.infos).then(response => {
                    var url = response.data;
                    window.open(url, "_blank");
                    Swal.fire({
                        type: 'success',
                        title: 'تم تعديل القيد بنجاح ^_^'
                    }).then(() => {
                        location.reload();
                    });
                    this.$Progress.finish();
                    this.infos.splice(0);
                    // location.reload();
                })
            },
            removerows:function(index){
                this.$delete(this.infos, index);
            },
            getsinglelimitation(){
                axios.get('/api/admin/limitations/'+this.id+'/edit').then(response => {
                    this.infos = response.data;
                })
            },
            addto:function(){

                if (this.form.id != ''){
                    this.infos.splice(this.form.index,1);
                    this.infos.push({
                        id: this.form.id,
                        branches: this.branchesid,
                        created_at:  this.created_at,
                        date:  this.date,
                        receipt_number: this.limitationsnumber,
                        operation_id: this.form.operations,
                        tree_id: this.form.tree != '' ? this.form.tree : '',
                        relation_id: this.form.tree != '' ? this.form.tree : this.infos[this.form.index].relation_id,
                        name_ar: $('.tree option:selected').text() != '' ? $('.tree option:selected').text() : this.form.name_ar,
                        name_en: $('.tree option:selected').text() != '' ? $('.tree option:selected').text() : this.form.name_ar,
                        monthname: titlel,
                        debtor: this.form.debtor,
                        creditor: this.form.creditor,
                        month_for: this.form.month_for,
                        note: this.form.note,
                        note_en: this.form.note_en,
                        cc_id: this.form.cc,
                        ccname: this.ccname,
                        invoice_id: this.invoice,
                    });
                    this.form.id = '';
                    this.form.name_ar = '';
                    this.form.creditor = 0;
                    this.form.debtor = 0;
                    this.form.cc = ''
                    this.form.operations = ''
                    this.ccname = '';
                }else{
                    if (this.form.operations != '' && this.form.tree != ''){
                        if (this.month_for[this.form.month_for-1] != null && this.month_for[this.form.month_for-1] != ''){
                            var titlel = this.month_for[this.form.month_for-1].title
                        }else{
                            var titlel = this.form.month_for
                        }

                        this.infos.push({
                            branches: this.branchesid,
                            created_at:  this.created_at,
                            date:  this.date,
                            receipt_number: this.limitationsnumber,
                            operation_id: this.form.operations,
                            tree_id: this.form.tree,
                            relation_id: this.form.tree,
                            name_ar: $('.tree option:selected').text(),
                            name_en: $('.tree option:selected').text(),
                            monthname: titlel,
                            debtor: this.form.debtor,
                            creditor: this.form.creditor,
                            month_for: this.form.month_for,
                            note: this.form.note,
                            note_en: this.form.note_en,
                            cc_id: this.form.cc,
                            receipt_number: this.form.receipt_number,
                            ccname: this.ccname,
                            invoice_id: this.invoice,
                        });
                        this.form.debtor = 0;
                        this.form.creditor = 0;
                        this.form.cc = ''
                        this.form.operations = ''
                    }else{
                        ''
                    }
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
                    axios.get('/api/admin/operations/' + operation).then(response => {
                        // this.form.tree = null;
                        // this.form.cc = null;
                        // this.glccselect = false;
                        this.tree = response.data[0];
                        this.address = response.data[1];
                    }).finally(()=>{
                        if (index != null) {
                            $('#select2-tree-container').text(this.infos[index].name_ar)
                            // $('#select2-tree-ih-container').text(this.infos[index].name_ar)
                            this.form.tree = this.infos[index].relation_id;
                        }
                    })
                }
                if (operation == ''){
                    return this.operationselect = false;
                }else {
                    return this.operationselect = true;
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
            axios.get('/api/admin/limitations').then(response => {
                this.branches = response.data[1]
            });
            axios.get('/api/admin/limitations').then(response => {
                this.limitations = response.data[0]
            });
            axios.get('/api/admin/limitations').then(response => {
                this.operations = response.data[2]
            });
            axios.get('/api/admin/limitations').then(response => {
                this.cc = response.data[3]
            });
            this.operationschange();
            this.deleteFind();
            this.getsinglelimitation();

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

<style scoped>

</style>
