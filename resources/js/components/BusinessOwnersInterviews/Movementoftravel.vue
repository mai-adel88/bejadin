<template>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">تسجيل مواعيد السفر</h3>
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
                    <input class="form-control" v-model="form.datetravelone" type="date" name="" id="date">
                </div>
                <div class="col-md-2">
                    <label for="movementnumber">رقم الحركة</label>
                    <input disabled v-model="form.move_number" class="form-control" type="text" name="" id="movementnumber">
                    <!-- <input class="form-control" v-model="form.move_number_travel" type="text" name="" id="movementnumber"> -->
                </div>
            </div>
            <hr>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="col-md-3">نوع المستند</th>
                        <th scope="col" class="col-md-3">تاريخ الاستلام</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">تاريخ السفر</th>
                        <td><input class="form-control" :class="{'is_valid' : form.date_travel == '' && alert == true}" @change="spinnercheck()" v-model="form.date_travel" value="" type="date" name="date_travel" id=""></td>
                    </tr>
                    <tr>
                        <th scope="row">ميناء الاقلاع</th>
                        <td><input class="form-control" :class="{'is_valid' : form.Port_takeoff == '' && alert == true}" @change="spinnercheck()" v-model="form.Port_takeoff" value="" type="text" name="Port_takeoff" id=""></td>
                    </tr>
                    <tr>
                        <th scope="row">وقت الاقلاع</th>
                        <td><input class="form-control" :class="{'is_valid' : form.takeoff_time == '' && alert == true}" @change="spinnercheck()" v-model="form.takeoff_time" value="" type="time" name="takeoff_time" id=""></td>
                    </tr>
                    <tr>
                        <th scope="row">تاريخ الوصول</th>
                        <td><input class="form-control" :class="{'is_valid' : form.date_arrival == '' && alert == true}" @change="spinnercheck()" v-model="form.date_arrival" value="" type="date" name="date_arrival" id=""></td>
                    </tr>
                    <tr>
                        <th scope="row">ميناء الوصول</th>
                        <td><input class="form-control" :class="{'is_valid' : form.port_access == '' && alert == true}" @change="spinnercheck()" v-model="form.port_access" value="" type="text" name="port_access" id=""></td>
                    </tr>
                    <tr>
                        <th scope="row">وقت الوصول</th>
                        <td><input class="form-control" :class="{'is_valid' : form.arrival_time == '' && alert == true}" @change="spinnercheck()" v-model="form.arrival_time" value="" type="time" name="arrival_time" id=""></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width:100%;height:400px">
                            <div v-if="!image" style="display:flex;width:100%;height:100%">
                                <div :class="['dropzone-area', dragging ? 'dropzone-over' : '', form.imagetravel == '' && alert == true ? 'is_valid_image' : '']" drag-over="handleDragOver" @dragenter="dragging=true" @dragleave="dragging=false">
                                    <div class="dropzone-text">
                                        <span class="dropzone-title">Drop image here or click to select</span>
                                        <span v-if="imagetype" style="color:red">The file is not image please upload file type: .png or .jpeg</span>
                                        <span v-if="imagesize" style="color:red">Maximum file size to upload is 2MB (2000 KB). try to reduce its resolution to make it under 2MB</span>
                                    </div>
                                    <input class="dataimage" type="file" @change="onFileChange">
                                </div>
                            </div>
                            <div class="dropzone-preview" v-if="image">
                                <img @click="openmodel()" width="100%" :src="imageexcist? '/storage/businessTravel/' + image: image" />
                                <i v-if="image" @click="removeimage" class="fa fa-trash-o delete_image"></i>
                            </div>
                            <div class="modal fade bd-example-modal-lg" @click="closemodel()" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body" @click="closemodel()">
                                            <img style="width:100%" :src="imageexcist? '/storage/businessTravel/' + image: image" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
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
            dragging: false,
            image: '',
            imageexcist:false,
            imagetype:false,
            imagesize:false,
            save:'حفظ',
            form:{
                branche_id:'',
                applicant_id:'',
                company_id:'',
                datetravelone:'',
                move_number:'',
                // move_number_travel:'',
                date_travel:'',
                Port_takeoff:'',
                takeoff_time:'',
                date_arrival:'',
                port_access:'',
                arrival_time:'',
                imagetravel:'',
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
            axios.get('api/admin/datarecoverytravel/' + this.branch + '/' + this.employer +'/'+ this.company).then((response)=>{
                if (response.data[0] != '') {
                    this.form = response.data[0]
                    this.branch = this.form.branche_id
                    this.form.datetravelone ? this.form.datetravelone : this.getdate()
                    this.save = 'تعديل'
                    if (this.form.imagetravel != null) {
                        this.imageexcist = true
                        this.image = this.form.imagetravel
                    }else{
                        this.imageexcist = false
                    }
                }else{
                    this.form.datetravelone = ''
                    this.form.move_number = response.data[1]
                    // this.form.move_number_travel = ''
                    this.form.date_travel = ''
                    this.form.Port_takeoff = ''
                    this.form.takeoff_time = ''
                    this.form.date_arrival = ''
                    this.form.port_access = ''
                    this.form.arrival_time = ''
                    this.form.imagetravel = ''
                    this.image = ''
                    this.save = 'حفظ'
                    this.alert = false
                    this.imageexcist = false
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
                axios.post('api/admin/datatravelpost',this.form).catch(({ response })=>{
                    this.errors = response.data.errors
                    this.spinner = false
                })
            }else{
                if (this.form.date_travel == '' || this.form.Port_takeoff == '' || this.form.takeoff_time == '' || this.form.date_arrival == '' || this.form.port_access == '' || this.form.arrival_time == '' || this.form.imagetravel == '') {
                    this.alert = true
                    this.errors = []
                }else{
                    axios.post('api/admin/datatravelpost',this.form).then((response)=>{
                        // console.log(response)
                    })
                    if (this.form.imagetravel == this.image) {
                        axios.post('api/admin/datatravelpostimage/'+this.form.applicant_id+'/'+this.form.company_id+'/'+this.form.imagetravel).then((response)=>{
                        // console.log(response)
                        }).finally(()=>{
                            this.spinner = false
                            Swal.fire({
                                type: 'success',
                                title: 'تم الحفظ بنجاح'
                            })
                        })
                    }else{
                        const formData = new FormData()
                        formData.append('imagetravel', this.form.imagetravel, this.form.imagetravel.name)
                        axios.post('api/admin/datatravelpostnewimage/'+this.form.applicant_id+'/'+this.form.company_id,formData).then((response)=>{
                        // console.log(response)
                        }).finally(()=>{
                            this.spinner = false
                            Swal.fire({
                                type: 'success',
                                title: 'تم الحفظ بنجاح'
                            })
                        })
                    }
                }
            }

        },
        spinnercheck:function(){
            if (this.form.date_travel != '' && this.form.Port_takeoff != '' && this.form.takeoff_time != '' && this.form.date_arrival != '' && this.form.port_access != '' && this.form.arrival_time != '' && this.form.imagetravel != '') {
                // console.log(this.form.datetravelone != '')
                this.spinner = false
            }
        },
        onFileChange:function(e){
            var files = e.target.files || e.dataTransfer.files;
            var imagetype = ['image/jpeg','image/png','image/jpg']
            // console.log(imagetype[0])
            var imagesize = 2000000
            if(files[0].type == imagetype[0] || files[0].type == imagetype[1] || files[0].type == imagetype[2]){
                console.log('image');
            }else{
                console.log('not image');
                this.form.imagetravel = ''
                this.image = ''
                this.imagetype = true
                this.imagesize = false
                return;
            }
            if (files[0].size > imagesize) {
                this.imagetype = false
                this.imagesize = true
                console.log('big')
                return;
            }else{
                console.log('small')
            }

            console.log(files[0].type);
            if (!files.length) return;
            this.createImage(files[0]);
            this.form.imagetravel = e.target.files[0];
            this.spinnercheck();
        },
        createImage(file) {
            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
            // this.spinnercheck();
        },
        choosefile:function(){
            $('.file_image').click()
        },
        removeimage:function(){
            this.image = ''
            this.form.imagetravel = ''
            this.imageexcist = false
            this.imagetype = false
            this.imagesize = false
        },
        openmodel:function(){
            // this.imagewindow = true
            $('#myModal').modal('show')
        },
        closemodel:function(){
            // this.imagewindow = false
            $('#myModal').modal('hide')
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
            this.form.datetravelone = fulldate
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

<style lang="scss" scoped>
.table tbody tr .alert{
    padding: 0 !important;
}
.alert input{
    width: 100%;
    height: 45px;
}
.is_valid{
    border: 1px solid red;
    box-shadow: 0 0 3px 0px red;
}
.is_valid_image{
    border: 1px dashed red !important;
    box-shadow: 0 0 3px 0px red;
}
.travel_ticket{
    width: 100%;
    height: 100%;
    display: flex;
    border: 1px dashed #000;
    background: #f1f1f1;
}
.cover_ticket{
    width:100%;
    height:100%;
    position: relative;
}
.dropzone-over {

  border: 1px solid red !important;
}

.dropzone-area {
    width: 100%;
    height: 100%;
    position: relative;
    border: 2px dashed #CBCBCB;
    &:hover {
        border: 2px dashed #2E94C4;
        .dropzone-title {
          color: #1975A0;
        }

    }
}

.dropzone-area input {
    position: absolute;
    cursor: pointer;
    top: 0px;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
}

.dropzone-text {
    position: absolute;
    top: 50%;
    text-align: center;
    transform: translate(0, -50%);
    width: 100%;
    span {
        display: block;
        font-family: Arial, Helvetica;
        line-height: 1.9;
    }
}

.dropzone-title {
    font-size: 13px;
    color: #787878;
    letter-spacing: 0.4px;
}
.dropzone-info {
    font-size: 13px;
    font-size: 0.8125rem;
    color: #A8A8A8;
    letter-spacing: 0.4px;
}

.dropzone-button {
    position: absolute;
    top: 10px;
    right: 10px;
    display: none;
}

.dropzone-preview {
    position: relative;
    height: 400px;
    overflow: hidden;
    display: flex;
    cursor: zoom-in;
    &:hover .dropzone-button {
        display: block;
    }
    img {
        object-fit: cover;
        object-position: center;
    }

}
.delete_image{
    cursor: pointer;
    position: absolute;
    bottom: 20px;
    right: 20px;
    font-size:48px;
    color: #cacaca;
}
.delete_image:hover{
    color:red;
}
.modal-body img{
    cursor: zoom-out;
}
</style>

