<style>
    @media (min-width: 992px){
        .limitations .col-md-3 {
            width: 20%;
        }
    }
</style>
<template>
    <div>
        <div class="box limitations">
            <div class="box-header">
                <h3 class="box-title">اضافة قيد افتتاحي جديد</h3>
                <label v-if="limitationnumber" style="float: left ;font-size:20px">رقم القيد {{limitationnumber}}</label>
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
                            <label>{{ trans('admin.limitation_type') }}</label>
                            <select v-model="form.limitations" name="limitations" class="form-control" :class="{ 'is-invalid': form.errors.has('limitations') }" @change="limitationschange">
                                <option value="" selected>{{ trans('admin.select') }}</option>
                                <option v-if="branchselect" v-for="limitation in limitations" :value="limitation.id">{{limitation.name_ar}}</option>
                            </select>
                            <has-error :form="form" field="limitations"></has-error>
                        </div>
                        <div class="col-md-3">
                            <label>{{ trans('admin.account_type') }}</label>
                            <select v-model="form.operations" name="limitations" class="form-control operations" :class="{ 'is-invalid': form.errors.has('operations') }" @change="operationschange(form.operations)">
                                <option value="" selected>{{ trans('admin.select') }}</option>
                                <option v-if="limitationsselect && branchselect" v-for="operation in operations" :value="operation.id">{{operation.name_ar}}</option>
                            </select>
                            <has-error :form="form" field="operations"></has-error>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label v-if="limitationsselect && branchselect" v-for="ads in address">{{ads}}</label>
                            <label v-if="!address" style="margin-top: 15px"></label>
                            <label v-if="!limitationsselect || !branchselect" style="margin-top: 15px"></label>
                            <!-- <select v-model="form.tree" name="tree" class="form-control tree" :class="{ 'is-invalid': form.errors.has('tree') }" @change="getcc">
                                <option v-if="limitationsselect && branchselect" v-for="t in tree" :value="t.id">{{t.name_ar}}{{t.dep_name_ar}}</option>
                            </select> -->
                            <select2 class="form-control tree" name="tree" id="tree" v-model.number="form.tree" :class="{ 'is-invalid': form.errors.has('tree') }" v-on:input="getcc()">
                                <option selected value="">Select one</option>
                                <template v-for="t in tree">
                                    <option v-if="limitationsselect && branchselect" :value="t.id">{{t.name_ar}}{{t.dep_name_ar}}</option>
                                </template>
                            </select2>
                            <has-error :form="form" field="operations"></has-error>
                        </div>
                        <div class="col-md-3">
                            <label>{{ trans('admin.movement_indebted') }}</label>
                            <input v-model="form.debtor" v-on:keyup.enter="addto" type="text" name="debtor" class="form-control" :class="{ 'is-invalid': form.errors.has('debtor') }">
                            <has-error :form="form" field="debtor"></has-error>
                        </div>
                        <div class="col-md-3">
                            <label>{{ trans('admin.motion_creditor') }}</label>
                            <input v-model="form.creditor" v-on:keyup.enter="addto" type="text" name="note" class="form-control" :class="{ 'is-invalid': form.errors.has('creditor') }">
                            <has-error :form="form" field="creditor"></has-error>
                        </div>
                        <div class="col-md-3">
                            <label>{{ trans('admin.month_for') }}</label>
                            <select v-model="form.month_for" name="tree" class="form-control month" :class="{ 'is-invalid': form.errors.has('month_for') }">
                                <option value="">{{ trans('admin.select') }}</option>
                                <option v-for="month in month_for" :value="month.id">{{month.title}}</option>
                            </select>
                            <has-error :form="form" field="month_for"></has-error>
                        </div>
                        <div class="col-md-3" v-if="glccselect && limitationsselect && branchselect">
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
                            <th>{{trans('admin.month_for')}}</th>
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
                            <td>{{info.monthname}}</td>
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
                limitations:'',
                operations:'',
                cc:'',
                ccname:'',
                address:'',
                tree:'',
                debtor:0,
                creditor:0,
                limitationnumber:0,
                branchselect:false,
                glccselect:false,
                limitationsselect:false,
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
                    'created_at':new Date().toISOString().slice(0,10),
                    'date':new Intl.DateTimeFormat("en-Sa-u-ca-islamicc").format(new Date(new Date().toISOString().slice(0,10))),
                    'limitations':'',
                    'operations':'',
                    'tree':'',
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
                    'branches':'',
                    'date':'',
                    'created_at':'',
                    'limitations':'',
                    'operations':'',
                    'tree':'',
                    'name':'',
                    'debtor':'',
                    'creditor':'',
                    'month_for':'',
                    'monthname':'',
                    'note':'',
                    'note_en':'',
                    'cc':'',
                    'ccname':'',
                    'receipt_number':'',
                    'limitationnumber':'',
                    'invoice': '',
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
                this.$Progress.start();
                axios.post('/api/admin/openingentry/store',this.infos).then(response => {
                    var url = response.data;
                    window.open(url, "_blank");
                    $('body').focus();
                    Swal.fire({
                        type: 'success',
                        title: 'تم حفظ القيد بنجاح ^_^'
                    }).then(() => {
                        location.reload();
                    });
                    this.$Progress.finish();
                    this.infos.splice(0);
                })
            },
            removerows:function(index){
                this.$delete(this.infos, index);
            },
            addto:function(){
                if (this.form.branches != '',this.form.date != '',this.form.limitations != '',this.form.operations != '',this.form.tree != ''){
                    if (this.month_for[this.form.month_for-1] != null){
                        var titlel = this.month_for[this.form.month_for-1].title
                    }else{
                        var titlel = this.form.month_for
                    }
                    this.infos.push({
                        branches: this.form.branches,
                        created_at:  this.form.created_at,
                        date:  this.form.date,
                        limitations: this.form.limitations,
                        operations: this.form.operations,
                        tree: this.form.tree,
                        name: $('.tree option:selected').text(),
                        monthname: titlel,
                        debtor: this.form.debtor,
                        creditor: this.form.creditor,
                        month_for: this.form.month_for,
                        note: this.form.note,
                        note_en: this.form.note_en,
                        cc: this.form.cc,
                        receipt_number: this.form.receipt_number,
                        ccname: this.ccname,
                        limitationnumber: this.limitationnumber,
                        invoice: this.invoice,
                    });
                    this.form.debtor = 0;
                    this.form.creditor = 0;
                    this.ccname = '';
                }else{
                    ''
                }

            },
            deleteFind: function (index) {
                this.infos.splice(index,1);
            },
            branchechange:function(e){
                if(this.form.created_at){
                    var formatter = new Intl.DateTimeFormat("ar-Sa-u-ca-islamicc")
                    this.form.date = formatter.format(new Date(this.form.created_at))
                }
                if (this.form.created_at == '' || this.form.branches == ''){
                    return this.branchselect = false;
                }else {
                    return this.branchselect = true;
                }
            },
            limitationschange:function(e){
                axios.get('/api/admin/limitationnum/'+ this.form.limitations).then(response => {
                    this.limitationnumber = response.data;
                })
                if (e.target.value == ''){
                    return this.limitationsselect = false;
                }else {
                    return this.limitationsselect = true;
                }
            },
            operationschange:function(operation){
                if (this.tree != null) {
                    this.tree = null;
                }
                axios.get('/api/admin/operations/'+ operation).then(response => {
                    this.form.tree = null;
                    this.form.cc = null;
                    this.glccselect = false;
                    this.tree = response.data[0];
                    this.address = response.data[1];
                })
            }
        },
        created(){
            axios.get('/api/admin/openingentry').then(response => {
                this.branches = response.data[1]
            });
            axios.get('/api/admin/openingentry').then(response => {
                this.limitations = response.data[0]
            });
            axios.get('/api/admin/openingentry').then(response => {
                this.operations = response.data[2]
            });
            this.operationschange();
            this.deleteFind();

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
