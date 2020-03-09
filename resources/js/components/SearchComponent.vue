<template>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">البحث عن موظفين</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                    <th>الاسم</th>
                    <th>الوظيفه</th>
                    <th>التخصص</th>
                    <th>التقدير</th>
                    <th>الخبرات</th>
                </tr>
                </thead>
                <tbody>
                <tr role="row" v-for="applicant in applicants.data">
                    <td class=""><a :href="'applicants/' + applicant.id" target="_blank">{{applicant.name}}</a></td>
                    <td>{{applicant.jobname}}</td>
                    <td class="sorting_1">{{applicant.job_spec}}</td>
                    <td>{{genum[applicant.grade].title}}</td>
                    <td>{{applicant.experience_desc.substr(0, 40)}}</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td><input @input="search" v-model="name" type="text" name="name" class="form-control"></td>
                    <td><input @input="search" v-model="jobs" type="text" name="jobs" class="form-control"></td>
                    <td><input @input="search" v-model="jobspec" type="text" name="jobspec" class="form-control"></td>
                    <td><input @input="search" v-model="grade" type="text" name="grade" class="form-control"></td>
                    <td><input @input="search" v-model="experience" type="text" name="experience" class="form-control"></td>
                </tr>
                </tfoot>
            </table>
                <pagination :data="applicants" v-on:pagination-change-page="getResults">
                </pagination>
            </div>
            </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('mounted');
            this.getResults();
        },
        data(){
            return{
                'name':'',
                'jobs':'',
                'jobspec':'',
                'grade':'',
                'experience':'',
                'applicants':{},
                'genum':[
                    {
                        id:1,
                        title:'مقبول'
                    },
                    {
                        id:2,
                        title:'جيد'
                    },
                    {
                        id:3,
                        title:'جيد جدا'
                    },
                    {
                        id:4,
                        title:'ممتاز'
                    },
                ]
            }
        },
        methods:{
            search(){
                axios.get('/api/admin/search?name='+this.name+'&jobs='+this.jobs+'&jobspec='+this.jobspec+'&grade='+this.grade+'&experience='+this.experience)
                .then(response => {
                    this.applicants = response.data;
                })
                .catch(err => {
                    this.getResults();
                })
            },
            getResults(page = 1) {
                axios.get('/api/admin/getapplicant?page=' + page)
                    .then(response => {
                        this.applicants = response.data;
                    });
            }
        }
    }
</script>
