<template>
        <div class="col-md-9">
            <div class="p-3">
                <div class="w-100 text-right mb-3">
                    <div class="w-100 color_main">
                        <div class="font-weight-bolder h5"><i class="fas fa-graduation-cap ml-2"></i>المختارين</div>
                        <hr class="color_main">
                    </div>
                    <div class="form-group">
                        <label class="control-label">الوظائف</label>
                        <select name="jobs" class="form-control jobs" v-model="jobname" required @change="selectapplicant()">
                            <option value="">اختر....</option>
                            <option v-for="job in jobs" :value="job.id">{{job.job.name_ar}} {{job.job_spec.name_ar}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="w-100 form-cv">
                <div class="w-100 flex-wrap d-flex">
                    <div class="col-sm-12 mb-3 float-right table-responsive">

                        <table class="table table-bordered table-striped table-hover text-center" v-if="disabled">
                            <thead class="bg_main color-white">
                            <tr>
                                <th scope="col">اسم المرشح</th>
                                <th scope="col">الوظيفة المتقدم اليها</th>
                                <th scope="col">الخبرات</th>
                                <th scope="col">القاعة</th>
                                <th scope="col">ميعاد المقابلة</th>
                                <th scope="col">التاريخ</th>
                                <th scope="col">تقييم المرشح</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr scope="row" v-for="applicant,index in filterapplicants" v-model="applicantsname" :key="applicant.id">

                                <td style="display: none"><input value="applicant.id" id="applicant.id" ></td>

                                <td class="font-weight-normal" scope="row">{{ applicant.applicants.name_ar }}</td>

                                <td v-if="applicantJobApplied(index)">{{ applicant.applicants.job_applied }}</td>
                                <td v-else><div class="badge">لا يوجد بيانات</div></td>

                                <td>{{ applicant.applicants.experience }}</td>

                                <td v-if="applicantHall(index)">{{ applicant.hall }}</td>
                                <td v-else><div class="badge">لا يوجد بيانات</div></td>

                                <td v-if="applicantSchedule(index)">{{ applicant.schedules }}</td>
                                <td v-else><div class="badge">لا يوجد بيانات</div></td>

                                <td v-if="applicantDate(index)">{{ applicant.date | dateformat }}</td>
                                <td v-else><div class="badge">لا يوجد بيانات</div></td>

                                <td>
                                    <div class="card-tools">
                                        <button class="btn btn-success"  @click="editModal(index)">
                                            تقييم
                                        </button>

                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="alert alert-danger" v-if="jobname != '' && filterapplicants == ''">لا يوجد مختارين لهذة الوظيفة</div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addNewLabel">التقييم</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="updateEval(applicantindex)">
                            <div class="modal-body">
                                <input type="hidden" :value="applicants.id">
                                <div class="form-group">
                                    <label for="technical" class="col-form-label">التقييم الفنى</label>
                                    <input v-model.number="form.technical" @keyup="gettotal()" type="text" name="technical" placeholder="من فضلك ادخل قيمه من 1 الى 50"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('technical') }" id="technical">
                                    <has-error :form="form" field="technical"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="educational" class="col-form-label">التقييم التربوي</label>
                                    <input v-model.number="form.educational" @keyup="gettotal()" type="text" name="educational" placeholder="من فضلك ادخل قيمه من 1 الى 25"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('educational') }" id="educational">
                                    <has-error :form="form" field="educational"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="general_look" class="col-form-label">المظهر العام</label>
                                    <input v-model.number="form.general_look" @keyup="gettotal()" type="text" name="general_look" placeholder="من فضلك ادخل قيمه من 1 الى 15"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('general_look') }" id="general_look">
                                    <has-error :form="form" field="general_look"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="skills" class="col-form-label">المهارات</label>
                                    <input v-model.number="form.skills" @keyup="gettotal()" type="text" name="skills" placeholder="من فضلك ادخل قيمه من 1 الى 10"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('skills') }" id="skills">
                                    <has-error :form="form" field="skills"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="sum" class="col-form-label">الاجمالي</label>
                                    <span  id="sum">{{total}}
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="Candidate_case" class="col-form-label">حاله المرشح</label>
                                    <select v-model="form.Candidate_case" name="Candidate_case" id="Candidate_case"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('Candidate_case') }">
                                        <option value="">اختر......</option>
                                        <option value="1">اساسي</option>
                                        <option value="2">احتياطى</option>
                                        <option value="0">مرفوض</option>
                                    </select>
                                    <has-error :form="form" field="Candidate_case"></has-error>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" @click="goback()" class="btn btn-danger" data-dismiss="modal">تراجع</button>
                                <button type="submit" class="btn btn-primary">حفظ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

</template>

<script>
    export default {
        data() {
            return {
                // editMode: false,
                jobs: [],
                applicants: [],
                applicantindex: '',
                jobname: '',
                applicantsname: '',
                disabled:false,
                applicantHalls: false,
                applicantSchedules: false,
                applicantDates: false,
                applicantJobs: false,
                filterapplicants:[],
                hiddenvalue:'',
                total:0,
                form: new Form({
                    id: '',
                    technical: '',
                    educational: '',
                    general_look: '',
                    skills: '',
                    Candidate_case: '',
                })
            }
        },
        created() {
            this.getJobs();
            this.getapplicants();
        },
        computed:{
            // total: function(){
            //     console.log(this.form);
            //     return this.form.reduce(function(total, item){
            //
            //         return total + item.number;
            //     },0);
        },
        methods:{
            getJobs () {
                window.axios.get('/chosen/jobs').then(response => {
                    this.jobs = response.data
                }).catch( error => { console.log(error); });
            },
            gettotal(){
                return this.total = Number(this.form.technical) + Number(this.form.educational) + Number(this.form.general_look) + Number(this.form.skills)
            },
            getapplicants: function() {
                axios.get('/chosen_applicants').then(response => {
                    return this.applicants = response.data;
                }).catch(errors =>{
                    console.log(errors);
                });
            },
            selectapplicant: function() {
                if (this.jobname != ''){
                    this.applicantsname = '';
                    this.filterapplicants = [];
                    this.filterapplicants = this.applicants.filter((applicant) => applicant.applicants_requests_id == this.jobname);
                    if (this.filterapplicants == ''){
                        this.disabled = false;
                    } else{
                        this.disabled = true;
                    }
                }else{
                    this.applicantsname = '';
                    this.filterapplicants = [];
                    if (this.filterapplicants == ''){
                        this.disabled = false;
                    } else{
                        this.disabled = true;
                    }
                }

            },
            applicantHall:function (index) {
                if (this.filterapplicants[index].hall == null){
                    return this.applicantHalls = false;
                } else{
                    return this.applicantHalls = true;
                }
            },
            applicantSchedule:function (index) {
                if (this.filterapplicants[index].schedules == null){
                    return this.applicantSchedules = false;
                } else{
                    return this.applicantSchedules = true;
                }
            },
            applicantDate:function (index) {
                if (this.filterapplicants[index].date == null){
                    return this.applicantDates = false;
                } else{
                    return this.applicantDates = true;
                }
            },
            applicantJobApplied:function (index) {
                if (this.filterapplicants[index].applicants.job_applied == null){
                    return this.applicantJobs = false;
                } else{
                    return this.applicantJobs = true;
                }
            },
            editModal(index) {
                this.form.reset();
                $('#addNew').modal('show');
                // console.log(index);
                // this.form.fill(applicant);
                this.applicantindex = index
                this.form.id = this.filterapplicants[index].id;
                this.form.technical = this.filterapplicants[index].technical;
                this.form.educational = this.filterapplicants[index].educational;
                this.form.general_look = this.filterapplicants[index].general_look;
                this.form.skills = this.filterapplicants[index].skills;
                this.form.Candidate_case = this.filterapplicants[index].Candidate_case;
                this.gettotal();
            },
            updateEval(index) {
                // console.log(index.id);
                this.$Progress.start();
                this.filterapplicants[index].id = this.form.id;
                this.filterapplicants[index].technical = this.form.technical;
                this.filterapplicants[index].educational = this.form.educational ;
                this.filterapplicants[index].general_look = this.form.general_look;
                this.filterapplicants[index].skills = this.form.skills ;
                this.filterapplicants[index].Candidate_case = this.form.Candidate_case;
                this.form.put('/chosen_applicants/'+ this.form.id)
                    .then(() => {
                        $('#addNew').modal('hide');
                        Toast.fire({
                            type: 'success',
                            title: 'تم اضافة التقييم بنجاح'
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    }).finally(()=>{
                        this.getapplicants();
                    });
            },
            goback:function () {
                this.form.reset()
            }
        },
        // mounted() {
        //     this.getJobs;
        //     this.getapplicants;
        // }
    }

</script>
