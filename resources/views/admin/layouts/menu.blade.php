
<aside class="main-sidebar" id="mySidenav">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="@if(admin()->user()->image !== null){{asset('storage/'.admin()->user()->image)}}@else {{asset('public/adminlte/previewImage.png')}} @endif"  style="height: 45px !important;" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{admin()->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> {{trans('admin.Online')}}</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            {{-- @if(admin()->user()->branches != null) <li class="header" style="color: #ccc !important;"><p>{{session_lang(admin()->user()->branches->Brn_NmEn,admin()->user()->branches->Brn_NmEn)}}</p></li> --}}
            {{-- @else --}}
            <li class="header" style="color: #ccc !important;"><p>{{trans('admin.MAIN_NAVIGATION')}}</p></li>
            {{-- @endif --}}

            {{-- لوحة التحكم --}}
            {{--            <li class="treeview {{ active_menu('dashboard')[0]  }} {{ active_menu('setting')[0]  }} {{ active_menu('branches')[0]  }}">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-dashboard"></i> <span>{{trans('admin.Dashboard')}}</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}
            {{--                <ul class="treeview-menu" style="{{ active_menu('dashboard')[1]  }}{{ active_menu('setting')[1]  }}{{ active_menu('branches')[1]  }}">--}}
            {{--                    @hasrole('admin')--}}
            {{--                        <li><a href="{{route('setting')}}"><i class="fa fa-circle-o"></i> {{trans('admin.Setting')}}</a></li>--}}
            {{--                        --}}{{-- conditions are set for test purposes and this part will be handled using roles and permissions later --}}
            {{--                        @if(session('Cmp_No') != -1)--}}
            {{--                            <li><a href="{{route('companies.edit', session('Cmp_No'))}}"><i class="fa fa-circle-o"></i>{{trans('admin.company_fixed_data')}}</a></li>--}}
            {{--                        @endif--}}
            {{--                        @if(session('Cmp_No') == -1)--}}
            {{--                            <li><a href="{{route('companies.index')}}"><i class="fa fa-circle-o"></i>{{trans('admin.companies')}}</a></li>--}}
            {{--                        @endif--}}
            {{--                        --}}{{-- end of conditions --}}
            {{--                        <li><a href="{{route('branches.index')}}"><i class="fa fa-circle-o"></i> {{trans('admin.Branches')}}</a></li>--}}
            {{--                        <li><a href="{{route('activities.index')}}"><i class="fa fa-circle-o"></i> {{trans('admin.trad_actitvities')}}</a></li>--}}
            {{--                        <li><a href="{{route('expulsion.index')}}"><i class="fa fa-circle-o"></i> {{trans('admin.expulsion_to_transaction')}}</a></li>--}}
            {{--                        <li><a href="{{route('expulsioncc.index')}}"><i class="fa fa-circle-o"></i> {{trans('admin.expulsioncc_to_transaction')}}</a></li>--}}
            {{--                    @endhasrole--}}
            {{--                </ul>--}}
            {{--            </li>--}}


            <li  class="">

                <a href="{{url('/admin/Dashboard_setting')}}">
                    <i class="fa fa-dashboard"></i> <span>{{trans('admin.Dashboard')}}</span>
                    <span class="pull-right-container"></span>
                </a>

            </li>


            <li  class="">

                <a href="{{url('/admin/project_data')}}">
                    <i class="fa fa-user"></i> <span>{{trans('admin.contract_and_projects')}}</span>
                    <span class="pull-right-container"></span>
                </a>

            </li>

            {{-- نهاية لوحة التحكم --}}

            {{--             project_old --}}
            {{--            <li class="treeview {{ active_menu('contract_and_projects')[0]  }} {{ active_menu('setting')[0]  }} {{ active_menu('branches')[0]  }}">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-dashboard"></i> <span>{{trans('admin.contract_and_projects')}}</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}
            {{--                <ul class="treeview-menu" style="{{ active_menu('dashboard')[1]  }}{{ active_menu('setting')[1]  }}{{ active_menu('branches')[1]  }}">--}}
            {{--                    <li class=""><a href="{{url('/admin/projects')}}"><i class="fa fa-circle-o"></i>{{trans('admin.projects')}}</a></li>--}}
            {{--                    <li class=""><a href="{{url('/admin/ProjectsSites')}}"><i class="fa fa-circle-o"></i>{{trans('admin.locations')}}</a></li>--}}
            {{--                    <li class=""><a href="{{url('/admin/project_contract')}}"><i class="fa fa-circle-o"></i>{{trans('admin.projects_contracts')}}</a></li>--}}
            {{--                    <li class=""><a href="{{url('/admin/contracts')}}"><i class="fa fa-circle-o"></i>{{trans('admin.subcontractors_contracts')}}</a></li>--}}
            {{--                    @can('create')--}}
            {{--                    <li><a href="{{route('projects.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_project')}} </a></li>--}}
            {{--                    <li><a href="{{route('project_contract.create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_project_contract')}} </a></li>--}}
            {{--                    <li><a href="{{route('ProjectsSites.create')}}"><i class="fa fa-plus"></i>{{trans('admin.Add_a_site_to_a_project')}} </a></li>--}}
            {{--                    @endcan--}}
            {{--                    <li class=""><a href="#"><i class="fa fa-circle-o"></i>{{trans('admin.reports')}}</a></li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
            {{--  project_old--}}

            {{-- ادارة المشاريع --}}
            <li class="treeview {{ active_menu('project_management')[0]  }} {{ active_menu('setting')[0]  }} {{ active_menu('branches')[0]  }}">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>{{trans('admin.project_management')}}</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            {{-- نهاية ادارة المشاريع --}}

            {{-- متابعة العماله و المعدات --}}
            <li class="treeview {{ active_menu('labor_and_equipments')[0]  }} {{ active_menu('setting')[0]  }} {{ active_menu('branches')[0]  }}">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>{{trans('admin.labor_and_equipments')}}</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            {{-- نهاية متابعة العماله و المعدات --}}

            {{--project_reports --}}
            {{--            <li class="treeview {{ active_menu('project_reports')[0]  }} {{ active_menu('setting')[0]  }} {{ active_menu('branches')[0]  }}">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-dashboard"></i> <span>{{trans('admin.project_reports')}}</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--project_reports --}}

            <li  class="">

                <a href="{{route('getSalesInvoicesGeneralView')}}">
                    <i class="fa fa-money"></i> <span>{{trans('admin.sells')}}</span>
                    <span class="pull-right-container"></span>
                </a>

            </li>

            <li  class="">

                <a href="{{url('/admin/purchases')}}">
                    <i class="fa fa-money"></i> <span>{{trans('admin.purchases')}}</span>
                    <span class="pull-right-container"></span>
                </a>

            </li>

            <li  class="">

                <a href="{{url('/admin/stores')}}">
                    <i class="fa fa-money"></i> <span>{{trans('admin.stores')}}</span>
                    <span class="pull-right-container"></span>
                </a>

            </li>

            <li  class="">

                <a href="{{url('/admin/basic_data')}}">
                    <i class="fa fa-money"></i> <span>{{trans('admin.main_data')}}</span>
                    <span class="pull-right-container"></span>
                </a>

            </li>



            {{-- data --}}
            {{--            <li class="treeview {{ active_menu('main_data')[0]  }} {{ active_menu('setting')[0]  }} {{ active_menu('branches')[0]  }}">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-dashboard"></i> <span>{{trans('admin.main_data')}}</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}
            {{--                <ul class="treeview-menu" style="{{ active_menu('dashboard')[1]  }}{{ active_menu('setting')[1]  }}{{ active_menu('branches')[1]  }}">--}}
            {{--                    --}}{{-- البيانات الاساسية للعملاء --}}
            {{--                    <li class=""><a href="{{url('/admin/subscribers')}}"><i class="fa fa-circle-o"></i>{{trans('admin.clients')}}</a></li>--}}
            {{--                    --}}{{-- نهاية البيانات الاساسيه للعملاء --}}

            {{--                    --}}{{-- بيانات مقاولين الباطن --}}
            {{--                    <li class=""><a href="{{url('/admin/contractors')}}"><i class="fa fa-circle-o"></i>{{trans('admin.subcontractors')}}</a></li>--}}
            {{--                    --}}{{-- نهاية مقاولين الباطن --}}

            {{--                    --}}{{-- دليل الحسابات --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('departments')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-tasks"></i> <span>{{trans('admin.Departments')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style=" {{ active_menu('departments')[1]  }}">--}}
            {{--                            <li class="active"><a href="{{url('/admin/departments')}}"><i class="fa fa-circle-o"></i>{{trans('admin.Departments')}} </a></li>--}}
            {{--                            @can('create')--}}
            {{--                            <li><a href="{{url('/admin/departments/create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.Create_New_Department')}} </a></li>--}}
            {{--                            @endcan--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية دليل الحسابات --}}

            {{--                    --}}{{-- مراكز التكلفه --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('cc')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-tasks"></i> <span>{{trans('admin.cc')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style=" {{ active_menu('cc')[1]  }}">--}}
            {{--                            <li class="active"><a href="{{url('/admin/cc')}}"><i class="fa fa-circle-o"></i>{{trans('admin.cc')}} </a></li>--}}
            {{--                            --}}{{--<li class="active"><a href="{{url('/admin/cc/reports/report')}}"><i class="fa fa-circle-o"></i>{{trans('admin.Departments_reports')}} </a></li>--}}
            {{--                            @can('create')--}}
            {{--                                <li><a href="{{url('/admin/cc/create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.create_new_cc')}} </a></li>--}}
            {{--                            @endcan--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية مراكز التكلفه --}}

            {{--                    --}}{{-- الموردين --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview  {{ active_menu('suppliers')[0]  }} ">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-bus"></i> <span>{{trans('admin.Suppliers')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style="{{ active_menu('suppliers')[1]  }}">--}}
            {{--                            <li class="active"><a href="{{url('/admin/suppliers')}}"><i class="fa fa-circle-o"></i>{{trans('admin.Suppliers')}} </a></li>--}}
            {{--                            <li class="active"><a href="{{url('/admin/astsupctg')}}"><i class="fa fa-circle-o"></i>{{trans('admin.Classification_suppliers')}} </a></li>--}}
            {{--                            @can('create')--}}
            {{--                                <li><a href="{{url('/admin/suppliers/create')}}"><i class="fa fa-plus"></i>{{trans('admin.Add_New_Suppliers')}} </a></li>--}}
            {{--                            @endcan--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية الموردين --}}

            {{--                    --}}{{-- الموظفين --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('employees')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.employees')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style=" {{ active_menu('drivers')[1]  }}">--}}
            {{--                            <li class="active"><a href="{{url('/admin/employees')}}"><i class="fa fa-circle-o"></i>{{trans('admin.employees_accounts')}} </a></li>--}}
            {{--                            @can('create')--}}
            {{--                            <li><a href="{{url('/admin/employees/create')}}"><i class="fa fa-plus"></i>{{trans('admin.Add_New_employee')}} </a></li>--}}
            {{--                            @endcan--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية الموظفين --}}

            {{--                    --}}{{-- المشرفين --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('supervisors')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.supervisors')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style=" {{ active_menu('drivers')[1]  }}">--}}
            {{--                            <li class="active"><a href="{{url('/admin/supervisors')}}"><i class="fa fa-circle-o"></i>{{trans('admin.supervisors')}} </a></li>--}}
            {{--                            @can('create')--}}
            {{--                                <li><a href="{{url('/admin/supervisors/create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_supervisor')}} </a></li>--}}
            {{--                            @endcan--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- لمندوبين --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('delegates')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.delegates')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style=" {{ active_menu('drivers')[1]  }}">--}}
            {{--                            <li class="active"><a href="{{url('/admin/delegates')}}"><i class="fa fa-circle-o"></i>{{trans('admin.delegates')}} </a></li>--}}
            {{--                            @can('create')--}}
            {{--                                <li><a href="{{url('/admin/delegates/create')}}"><i class="fa fa-plus"></i>{{trans('admin.add_delegate')}} </a></li>--}}
            {{--                            @endcan--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}

            {{--                    --}}{{-- الاصول الثابته --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('fixed_assets')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.fixed_assets')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية الاصول الثابته --}}

            {{--                    --}}{{-- السيارات --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('cars')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.cars')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية السيارات --}}
            {{--                </ul>--}}
            {{--            </li>--}}
            {{-- data--}}

            {{-- تقارير البيانات الاساسيه --}}
            {{--            <li class="treeview {{ active_menu('main_data_reports')[0]  }} {{ active_menu('setting')[0]  }} {{ active_menu('branches')[0]  }}">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-dashboard"></i> <span>{{trans('admin.main_data_reports')}}</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}
            {{--                --}}{{-- تقارير دليل الحسابات --}}
            {{--                <ul class="treeview-menu" style="{{ active_menu('departments_reports')[1]  }}{{ active_menu('setting')[1]  }}{{ active_menu('branches')[1]  }}">--}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('departments_reports')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-tasks"></i> <span>{{trans('admin.departments_reports')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style=" {{ active_menu('departments')[1]  }}">--}}
            {{--                            <li><a target="_blank" href="{{url('/admin/departments/department/print')}}"><i class="fa fa-circle-o"></i>{{trans('admin.department_print')}} </a></li>--}}
            {{--                            <li><a href="{{url('/admin/departments/reports/report')}}"><i class="fa fa-circle-o"></i>{{trans('admin.Departments_reports')}} </a></li>--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية تقارير دليل الحسابات --}}

            {{--                    --}}{{-- تقارير الموردين --}}
            {{--                    <li><a href="#"><i class="fa fa-circle-o"></i> {{trans('admin.suppliers_reports')}}</a></li>--}}
            {{--                    --}}{{-- نهاية تقارير الموردين --}}

            {{--                    --}}{{-- تقارير الموظفين --}}
            {{--                    <li><a href="#"><i class="fa fa-circle-o"></i> {{trans('admin.empolyee_reports')}}</a></li>--}}
            {{--                    --}}{{-- نهاية تقارير الموظفين --}}

            {{--                    --}}{{-- تقارير الاصول الثابته --}}
            {{--                    <li><a href="#"><i class="fa fa-circle-o"></i> {{trans('admin.fixes_assets_reports')}}</a></li>--}}
            {{--                    --}}{{-- نهاية تقارير الاصول الثابته --}}
            {{--                </ul>--}}
            {{--            </li>--}}
            {{-- نهاية تقارير البيانات الاساسيه --}}

            {{-- تقارير مراكز التكلفه --}}
            {{--            <li class="treeview">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-dashboard"></i> <span>{{trans('admin.cc_reports')}}</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}
            {{--                <ul class="treeview-menu">--}}
            {{--                    @hasanyrole('admin')--}}
            {{--                    @can('create')--}}
            {{--                        <li><a href="{{url('admin/cc/report/checkReports')}}"><i class="fa fa-circle-o"></i>{{trans('admin.disclosure_of_balances_of_accounts_of_cost_centers')}} </a></li>--}}
            {{--                        <li><a href="{{url('admin/cc/report/motioncc')}}"><i class="fa fa-circle-o"></i>{{trans('admin.motion_detection_center_cost')}} </a></li>--}}
            {{--                        <li><a href="{{url('admin/cc/report/ccpublicbalance')}}"><i class="fa fa-circle-o"></i>{{trans('admin.cc_general_palance')}} </a></li>--}}
            {{--                        <li><a href="#"><i class="fa fa-circle-o"></i>{{trans('admin.cc_analysis_reports')}} </a></li>--}}
            {{--                        <li><a href="#"><i class="fa fa-circle-o"></i>{{trans('admin.cc_daily_limitation_reports')}} </a></li>--}}
            {{--                    @endcan--}}
            {{--                    @endhasanyrole--}}
            {{--                </ul>--}}
            {{--            </li>--}}
            {{-- نهاية تقارير مراكز التكلفه --}}

            {{-- التقارير المحاسبيه --}}



            <li  class="">

                <a href="{{url('/admin/financial_reports')}}">
                    <i class="fa fa-credit-card"></i> <span>التقارير الماليه</span>
                    <span class="pull-right-container"></span>
                </a>

            </li>

            {{--            <li class="treeview {{ active_menu('dailyReport')[0]  }} {{ active_menu('accountStatement')[0]  }} {{ active_menu('trialbalance')[0]  }}">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-credit-card"></i> <span>{{trans('admin.accounting_reports')}}</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}
            {{--                <ul class="treeview-menu" style="{{ active_menu('dailyReport')[1]  }} {{ active_menu('accountStatement')[1]  }} {{ active_menu('trialbalance')[1]  }}">--}}
            {{--                    <li><a href="{{url('/admin/dailyReport')}}"><i class="fa fa-circle-o"></i>{{trans('admin.daily_report')}} </a></li>--}}
            {{--                    <li><a href="{{url('/admin/accountStatement')}}"><i class="fa fa-circle-o"></i>{{trans('admin.account_statement')}} </a></li>--}}
            {{--                    <li><a href="{{url('/admin/trialbalance')}}"><i class="fa fa-circle-o"></i>{{trans('admin.trial_balance')}} </a></li>--}}
            {{--                    <li><a href="{{url('/admin/publicbalance')}}"><i class="fa fa-circle-o"></i>{{trans('admin.public_balance')}} </a></li>--}}
            {{--                    <li><a href="{{url('/admin/departments/department/Review')}}"><i class="fa fa-circle-o"></i>{{trans('admin.Departments_Review')}} </a></li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}



            {{--            @hasanyrole('writer|admin')--}}
            {{--            <li  class="">--}}

            {{--                <a href="{{url('/admin/basic_reports')}}">--}}
            {{--                    <i class="fa fa-credit-card"></i> <span>التقارير البيانات الاساسية</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}


            {{--            </li>--}}
            {{--            @endhasanyrole--}}

            {{--            </li>--}}
            {{--            @endhasanyrole--}}
            {{--            @hasanyrole('writer|admin')--}}
            {{--            <li class="treeview {{ active_menu('dailyReport')[0]  }} {{ active_menu('accountStatement')[0]  }} {{ active_menu('trialbalance')[0]  }}">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-credit-card"></i> <span>{{trans('admin.accounting_reports')}}</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}
            {{--                <ul class="treeview-menu" style="{{ active_menu('dailyReport')[1]  }} {{ active_menu('accountStatement')[1]  }} {{ active_menu('trialbalance')[1]  }}">--}}
            {{--                    <li><a href="{{url('/admin/dailyReport')}}"><i class="fa fa-circle-o"></i>{{trans('admin.daily_report')}} </a></li>--}}
            {{--                    <li><a href="{{url('/admin/accountStatement')}}"><i class="fa fa-circle-o"></i>{{trans('admin.account_statement')}} </a></li>--}}
            {{--                    <li><a href="{{url('/admin/trialbalance')}}"><i class="fa fa-circle-o"></i>{{trans('admin.trial_balance')}} </a></li>--}}
            {{--                    <li><a href="{{url('/admin/publicbalance')}}"><i class="fa fa-circle-o"></i>{{trans('admin.public_balance')}} </a></li>--}}
            {{--                    <li><a href="{{url('/admin/departments/department/Review')}}"><i class="fa fa-circle-o"></i>{{trans('admin.Departments_Review')}} </a></li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
            {{--            @endhasanyrole--}}



            {{-- نهاية التقارير المحاسبيه --}}

            <li  class="">

                <a href="{{url('/admin/get_snadat')}}">
                    <i class="fa fa-users"></i> <span>{{trans('admin.fund_and_banks')}}</span>
                    <span class="pull-right-container"></span>
                </a>

            </li>



            {{-- نهاية التقارير المحاسبيه --}}


            {{-- الصندوق و البنوك --}}
            {{--            @hasanyrole('account|admin|Casher')--}}
            {{--            <li class="treeview {{ active_menu('banks')[0]  }}">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-tasks"></i><span>{{trans('admin.fund_and_banks')}}</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}
            {{--                <ul class="treeview-menu" style=" {{ active_menu('banks')[1]  }}">--}}
            {{--                    --}}{{-- <li><a href="{{url('/admin/limitations/cred/create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.create_cred_limitations')}} </a></li> --}}
            {{--                    <li><a href="{{route('rcatchs.index')}}"><i class="fa fa-circle-o"></i>{{trans('admin.catch_receipt')}} </a></li>--}}

            {{--                    <li><a href="{{route('receiptCash.index')}}"><i class="fa fa-circle-o"></i>{{trans('admin.caching_receipt')}} </a></li>--}}
            {{--                    <li><a href="{{route('notice.index')}}"><i class="fa fa-circle-o"></i>{{trans('admin.debt_limitations')}}</a></li>--}}
            {{--                     <li><a href="{{url('admin/limitations/notice/noticecred')}}"><i class="fa fa-circle-o"></i>{{trans('admin.cred_limitations')}}</a></li>--}}
            {{--                    <li><a href="{{route('rcatchs.create')}}"><i class="fa fa-plus"></i>{{trans('admin.create_catch_receipt')}}</a></li>--}}
            {{--                    <li><a href="{{route('receiptCash.create')}}"><i class="fa fa-plus"></i>{{trans('admin.create_caching_receipt')}}</a></li>--}}
            {{--                    <li><a href="{{route('notice.create')}}"><i class="fa fa-plus"></i>{{trans('admin.create_debt_limitations')}} </a></li>--}}

            {{--                </ul>--}}
            {{--            </li>--}}
            {{--            @endhasanyrole--}}
            {{-- نهاية الصندوق و البنوك --}}

            <li  class="">

                <a href="{{url('/admin/get_limitions')}}">
                    <i class="fa fa-users"></i> <span>{{trans('admin.register_daily_limitations')}}</span>
                    <span class="pull-right-container"></span>
                </a>

            </li>

            {{-- تسجيل القيود اليوميه --}}
            {{--            @hasanyrole('account|admin')
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-tasks"></i><span>{{trans('admin.register_daily_limitations')}}</span>
                                <span class="pull-right-container">
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('admin/limitations')}}"><i class="fa fa-circle-o"></i>{{trans('admin.daily_limitations_edit')}}</a></li>
                                <li><a href="{{url('/admin/limitations/create')}}"><i class="fa fa-plus"></i>{{trans('admin.create_daily_limitations')}} </a></li>
                                <li><a href="{{url('/admin/openingentry/create')}}"><i class="fa fa-plus"></i>{{trans('admin.create_opening_entry')}} </a></li>
                            </ul>
                        </li>
                        @endhasanyrole--}}
            {{-- نهاية تسجيل القيود اليوميه --}}

            {{-- الاخبار --}}
            {{--            @hasanyrole('writer|admin')--}}
            {{--            <li class="treeview {{ active_menu('news')[0]  }}">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-id-card-o"></i> <span>{{trans('admin.news')}}</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            @endhasanyrole--}}
            {{-- نهاية الاخبار --}}

            {{-- الاعدادات --}}
            {{-- نهاية الاعدادات --}}

            <li  class="">

                <a href="{{url('/admin/general_setting')}}">
                    <i class="fa fa-credit-card"></i> <span>{{trans('admin.settings')}}</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            {{--            <li  class="">--}}

            {{--                <ul class="treeview-menu" style="{{ active_menu('settings')[1]  }}{{ active_menu('setting')[1]  }}{{ active_menu('branches')[1]  }}">--}}
            {{--                    --}}{{-- اعدادات عامه --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('general_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.general_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style="{{ active_menu('accounting_setting')[1]  }}{{ active_menu('setting')[1]  }}{{ active_menu('branches')[1]  }}">--}}
            {{--                            @hasanyrole('writer|admin')--}}
            {{--                            <li><a href="{{route('curencies.index')}}"><i class="fa fa-circle-o"></i>{{trans('admin.currency_setting')}} </a></li>--}}
            {{--                            @endhasanyrole--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية اعدادات عامه --}}

            {{--                    --}}{{-- اعدادات الحسابات --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('accounting_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.accounting_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style="{{ active_menu('accounting_setting')[1]  }}{{ active_menu('setting')[1]  }}{{ active_menu('branches')[1]  }}">--}}
            {{--                            @hasanyrole('writer|admin')--}}
            {{--                            <li class="active"><a href="{{route('limitationType.index')}}"><i class="fa fa-circle-o"></i>{{trans('admin.limitation_setting')}} </a></li>--}}
            {{--                            <li><a href="#"><i class="fa fa-circle-o"></i>{{trans('admin.asset_setting')}} </a></li>--}}
            {{--                            <li><a href="{{route('accbanks.create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.accbanks')}} </a></li>--}}
            {{--                            @endhasanyrole--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية اعدادات الحسابات --}}

            {{--                    --}}{{-- اعدادات الصندوق و البنوك --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('accbanks_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.accbanks_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style="{{ active_menu('accounting_setting')[1]  }}{{ active_menu('setting')[1]  }}{{ active_menu('branches')[1]  }}">--}}
            {{--                            @hasanyrole('writer|admin')--}}
            {{--                            <li><a href="{{route('accbanks.index')}}"><i class="fa fa-circle-o"></i>{{trans('admin.accbanks')}} </a></li>--}}
            {{--                            @endhasanyrole--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية اعدادت الصندوق و البنوك --}}

            {{--                    --}}{{-- اعدادات الموظفين --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('employee_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.employee_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية اعدادات الموظفين --}}

            {{--                    --}}{{-- اعدادات السيارات --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('car_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.car_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية اعدادات السيارات --}}

            {{--                    --}}{{-- اعدادات المشاريع --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('project_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.project_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style=" {{ active_menu('fund_and_banks')[1]  }}">--}}
            {{--                            <li><a href="{{route('contractor.type')}}"><i class="fa fa-circle-o"></i> {{trans('admin.Types_of_Contractors')}}</a></li>--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية اعدادات المشاريع --}}

            {{--                    --}}{{-- الدول و المدن --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('countries')[0]  }} {{ active_menu('cities')[0]  }} {{ active_menu('state')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-flag-o"></i> <span>{{trans('admin.Countries_and_Cities')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style="{{ active_menu('countries')[1]  }} {{ active_menu('cities')[1]  }} {{ active_menu('state')[1]  }}">--}}
            {{--                            <li class="active"><a href="{{url('admin/countries')}}"><i class="fa fa-circle-o"></i> {{trans('admin.Countries_and_Cities')}}</a></li>--}}
            {{--                            @can('create')--}}
            {{--                            <li><a href="{{url('admin/countries/create')}}"><i class="fa fa-plus"></i> {{trans('admin.create_new_country')}}</a></li>--}}
            {{--                            <li><a href="{{url('admin/cities/create')}}"><i class="fa fa-plus"></i> {{trans('admin.create_new_city')}}</a></li>--}}
            {{--                            <li><a href="{{url('admin/state/create')}}"><i class="fa fa-plus"></i> {{trans('admin.create_new_state')}}</a></li>--}}
            {{--                            @endcan--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية الدول و المدن --}}

            {{--            </li>--}}

            {{--         <li class="treeview {{ active_menu('news')[0]  }}">--}}
            {{--                <ul class="treeview-menu" style="{{ active_menu('settings')[1]  }}{{ active_menu('setting')[1]  }}{{ active_menu('branches')[1]  }}">--}}
            {{--                    --}}{{-- اعدادات عامه --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('general_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.general_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style="{{ active_menu('accounting_setting')[1]  }}{{ active_menu('setting')[1]  }}{{ active_menu('branches')[1]  }}">--}}
            {{--                            @hasanyrole('writer|admin')--}}
            {{--                            <li><a href="{{route('curencies.index')}}"><i class="fa fa-circle-o"></i>{{trans('admin.currency_setting')}} </a></li>--}}
            {{--                            @endhasanyrole--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية اعدادات عامه --}}

            {{--                    --}}{{-- اعدادات الحسابات --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('accounting_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.accounting_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style="{{ active_menu('accounting_setting')[1]  }}{{ active_menu('setting')[1]  }}{{ active_menu('branches')[1]  }}">--}}
            {{--                            @hasanyrole('writer|admin')--}}
            {{--                            <li class="active"><a href="{{route('limitationType.index')}}"><i class="fa fa-circle-o"></i>{{trans('admin.limitation_setting')}} </a></li>--}}
            {{--                            <li><a href="#"><i class="fa fa-circle-o"></i>{{trans('admin.asset_setting')}} </a></li>--}}
            {{--                            <li><a href="{{route('accbanks.create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.accbanks')}} </a></li>--}}
            {{--                            @endhasanyrole--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية اعدادات الحسابات --}}

            {{--                    --}}{{-- اعدادات الصندوق و البنوك --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('accbanks_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.accbanks_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style="{{ active_menu('accounting_setting')[1]  }}{{ active_menu('setting')[1]  }}{{ active_menu('branches')[1]  }}">--}}
            {{--                            @hasanyrole('writer|admin')--}}
            {{--                            <li><a href="{{route('accbanks.index')}}"><i class="fa fa-circle-o"></i>{{trans('admin.accbanks')}} </a></li>--}}
            {{--                            @endhasanyrole--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية اعدادت الصندوق و البنوك --}}

            {{--                    --}}{{-- اعدادات الموظفين --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('employee_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.employee_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية اعدادات الموظفين --}}

            {{--                    --}}{{-- اعدادات السيارات --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('car_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.car_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية اعدادات السيارات --}}

            {{--                    --}}{{-- اعدادات المشاريع --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('project_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.project_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style=" {{ active_menu('fund_and_banks')[1]  }}">--}}
            {{--                            <li><a href="{{route('contractor.type')}}"><i class="fa fa-circle-o"></i> {{trans('admin.Types_of_Contractors')}}</a></li>--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية اعدادات المشاريع --}}

            {{--                    --}}{{-- الدول و المدن --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('countries')[0]  }} {{ active_menu('cities')[0]  }} {{ active_menu('state')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-flag-o"></i> <span>{{trans('admin.Countries_and_Cities')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style="{{ active_menu('countries')[1]  }} {{ active_menu('cities')[1]  }} {{ active_menu('state')[1]  }}">--}}
            {{--                            <li class="active"><a href="{{url('admin/countries')}}"><i class="fa fa-circle-o"></i> {{trans('admin.Countries_and_Cities')}}</a></li>--}}
            {{--                            @can('create')--}}
            {{--                            <li><a href="{{url('admin/countries/create')}}"><i class="fa fa-plus"></i> {{trans('admin.create_new_country')}}</a></li>--}}
            {{--                            <li><a href="{{url('admin/cities/create')}}"><i class="fa fa-plus"></i> {{trans('admin.create_new_city')}}</a></li>--}}
            {{--                            <li><a href="{{url('admin/state/create')}}"><i class="fa fa-plus"></i> {{trans('admin.create_new_state')}}</a></li>--}}
            {{--                            @endcan--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{-- نهاية الدول و المدن --}}


            {{--            </li>--}}
            {{--            @endhasanyrole--}}
            {{--            <li class="treeview">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-dashboard"></i> <span>{{trans('admin.settings')}}</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}
            {{--                <ul class="treeview-menu">--}}

            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('accounting_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.accounting_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style="{{ active_menu('accounting_setting')[1]  }}{{ active_menu('setting')[1]  }}{{ active_menu('branches')[1]  }}">--}}
            {{--                            @hasanyrole('writer|admin')--}}
            {{--                            <li class="active"><a href="#"><i class="fa fa-circle-o"></i>{{trans('admin.limitation_setting')}} </a></li>--}}
            {{--                            <li><a href="#"><i class="fa fa-circle-o"></i>{{trans('admin.asset_setting')}} </a></li>--}}
            {{--                            <li><a href="{{route('accbanks.create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.accbanks')}} </a></li>--}}
            {{--                            @endhasanyrole--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{----}}{{-- نهاية اعدادات الحسابات --}}

            {{--                    --}}{{----}}{{-- اعدادات الصندوق و البنوك --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('accbanks_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.accbanks_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style="{{ active_menu('accounting_setting')[1]  }}{{ active_menu('setting')[1]  }}{{ active_menu('branches')[1]  }}">--}}
            {{--                            @hasanyrole('writer|admin')--}}
            {{--                            <li><a href="{{route('accbanks.index')}}"><i class="fa fa-circle-o"></i>{{trans('admin.accbanks')}} </a></li>--}}
            {{--                            @endhasanyrole--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{----}}{{-- نهاية اعدادت الصندوق و البنوك --}}

            {{--                    --}}{{----}}{{-- اعدادات الموظفين --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('employee_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.employee_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{----}}{{-- نهاية اعدادات الموظفين --}}

            {{--                    --}}{{----}}{{-- اعدادات السيارات --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('car_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.car_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{----}}{{-- نهاية اعدادات السيارات --}}

            {{--                    --}}{{----}}{{-- اعدادات المشاريع --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('project_setting')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-id-card-o"></i> <span>{{trans('admin.project_setting')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style=" {{ active_menu('fund_and_banks')[1]  }}">--}}
            {{--                            <li><a href="{{route('contractor.type')}}"><i class="fa fa-circle-o"></i> {{trans('admin.Types_of_Contractors')}}</a></li>--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{----}}{{-- نهاية اعدادات المشاريع --}}

            {{--                    --}}{{----}}{{-- الدول و المدن --}}
            {{--                    @hasanyrole('writer|admin')--}}
            {{--                    <li class="treeview {{ active_menu('countries')[0]  }} {{ active_menu('cities')[0]  }} {{ active_menu('state')[0]  }}">--}}
            {{--                        <a href="#">--}}
            {{--                            <i class="fa fa-flag-o"></i> <span>{{trans('admin.Countries_and_Cities')}}</span>--}}
            {{--                            <span class="pull-right-container"></span>--}}
            {{--                        </a>--}}
            {{--                        <ul class="treeview-menu" style="{{ active_menu('countries')[1]  }} {{ active_menu('cities')[1]  }} {{ active_menu('state')[1]  }}">--}}
            {{--                            <li class="active"><a href="{{url('admin/countries')}}"><i class="fa fa-circle-o"></i> {{trans('admin.Countries_and_Cities')}}</a></li>--}}
            {{--                            @can('create')--}}
            {{--                                <li><a href="{{url('admin/countries/create')}}"><i class="fa fa-plus"></i> {{trans('admin.create_new_country')}}</a></li>--}}
            {{--                                <li><a href="{{url('admin/cities/create')}}"><i class="fa fa-plus"></i> {{trans('admin.create_new_city')}}</a></li>--}}
            {{--                                <li><a href="{{url('admin/state/create')}}"><i class="fa fa-plus"></i> {{trans('admin.create_new_state')}}</a></li>--}}
            {{--                            @endcan--}}
            {{--                        </ul>--}}
            {{--                    </li>--}}
            {{--                    @endhasanyrole--}}
            {{--                    --}}{{----}}{{-- نهاية الدول و المدن --}}

            {{--                </ul>--}}
            {{--            </li>--}}

            {{--            --}}{{-- حساب المدير --}}
            {{--            @hasrole('admin')--}}
            {{--            <li class="treeview {{ active_menu('admins')[0]  }} {{ active_menu('permissions')[0]  }} {{ active_menu('roles')[0]  }}">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-users"></i> <span>{{trans('admin.Admin_Account')}}</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}
            {{--                <ul class="treeview-menu" style="{{ active_menu('admins')[1]  }} {{ active_menu('permissions')[1]  }} {{ active_menu('roles')[1]  }}">--}}
            {{--                    <li class="active"><a href="{{url('/admin/admins')}}"><i class="fa fa-circle-o"></i>{{trans('admin.Admin_Account')}} </a></li>--}}
            {{--                    <li><a href="{{url('/admin/permissions')}}"><i class="fa fa-circle-o"></i>{{trans('admin.permission')}} </a></li>--}}
            {{--                    <li><a href="{{url('/admin/roles')}}"><i class="fa fa-circle-o"></i>{{trans('admin.Roles')}} </a></li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
            {{--            @endhasrole--}}

            {{--            @hasanyrole('writer|admin')--}}
            {{--            <li  class="">--}}

            {{--                <a href="{{url('/admin/admin_setting')}}">--}}
            {{--                    <i class="fa fa-money"></i> <span>{{trans('admin.Admin_Account')}}</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}

            {{--            </li>--}}
            {{--            @endhasanyrole--}}
            {{--            --}}{{-- نهاية حساب المدير --}}

            {{--            --}}{{-- حساب المستخدم --}}
            {{--            @hasrole('admin')--}}
            {{--            <li class="treeview {{ active_menu('relatedness')[0]  }} {{ active_menu('systems')[0]  }} {{ active_menu('users')[0]  }}">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-users"></i> <span>{{trans('admin.User_Account')}}</span>--}}
            {{--                    <span class="pull-right-container">--}}
            {{--                </span>--}}
            {{--                </a>--}}

            {{--                <ul class="treeview-menu" style="{{ active_menu('subscribers')[1]  }} {{ active_menu('relatedness')[1]  }} {{ active_menu('systems')[1]  }} {{ active_menu('users')[1]  }}">--}}
            {{--                    <li class="active"><a href="{{url('/admin/users')}}"><i class="fa fa-circle-o"></i>{{trans('admin.User_Account')}}</a></li>--}}
            {{--                    @can('create')--}}
            {{--                                            <li><a href="{{url('admin/subscribers/create')}}"><i class="fa fa-plus"></i> {{trans('admin.Create_New_Subscriber')}}</a></li>--}}
            {{--                        @hasanyrole('writer|admin')--}}
            {{--                                            <li><a href="{{url('admin/systems/create')}}"><i class="fa fa-plus"></i> {{trans('admin.Create_New_Sub_System')}}</a></li>--}}
            {{--                        @endhasanyrole--}}
            {{--                    @endcan--}}
            {{--                </ul>--}}
            {{--            </li>--}}
            {{--            @endhasrole--}}
            {{--            --}}{{-- نهاية حساب المستخدم --}}

            {{--            --}}{{-- البيانات الاساسيه للعملاء --}}
            {{--            --}}{{-- <li class="treeview {{ active_menu('subscribers')[0]  }}">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-users"></i> <span>{{trans('admin.Subscriber_Account')}}</span>--}}
            {{--                    <span class="pull-right-container">--}}
            {{--                    </span>--}}
            {{--                </a>--}}
            {{--                <ul class="treeview-menu" style="{{ active_menu('subscribers')[1]  }} {{ active_menu('relatedness')[1]  }} {{ active_menu('systems')[1]  }} {{ active_menu('users')[1]  }}">--}}
            {{--                    <li><a href="{{url('/admin/subscribers')}}"><i class="fa fa-circle-o"></i>{{trans('admin.Subscriber_Account')}} </a></li>--}}
            {{--                    <li><a href="{{url('/admin/relatedness')}}"><i class="fa fa-circle-o"></i>{{trans('admin.related_Account')}} </a></li>--}}
            {{--                    <li><a href="{{route('activities.index')}}"><i class="fa fa-circle-o"></i> {{trans('admin.types_of_activities')}}</a></li>--}}
            {{--                @can('create')--}}
            {{--                    <li><a href="{{url('admin/subscribers/create')}}"><i class="fa fa-plus"></i> {{trans('admin.Create_New_Subscriber')}}</a></li>--}}
            {{--                @endcan--}}
            {{--                </ul>--}}
            {{--            </li> --}}
            {{--            --}}{{-- نهاية البيانات الاساسيه للعملاء --}}

            {{--            --}}{{-- بيانات مقاولين الباطن --}}
            {{--            --}}{{-- @hasanyrole('writer|admin')--}}
            {{--            <li class="treeview {{ active_menu('contracts')[0]  }}">--}}
            {{--                <a href="#">--}}
            {{--                    <i class="fa fa-id-card-o"></i>--}}
            {{--                    <span>{{trans('admin.Data_of_subcontractors')}}</span>--}}
            {{--                    <span class="pull-right-container"></span>--}}
            {{--                </a>--}}
            {{--                <ul class="treeview-menu" style="{{ active_menu('contracts')[1]  }}">--}}
            {{--                    <li class=""><a href="{{url('/admin/contractors')}}"><i class="fa fa-circle-o"></i>{{trans('admin.Contractors_data')}}</a></li>--}}
            {{--                    <li class=""><a href="{{url('/admin/contracts')}}"><i class="fa fa-circle-o"></i>{{trans('admin.Contractors_contracts_data')}}</a></li>--}}
            {{--                    <li class="active"><a href="{{url('/admin/contract')}}"><i class="fa fa-circle-o"></i>{{trans('admin.cost_staff')}}</a></li>--}}
            {{--                    @can('create')--}}
            {{--                    <li><a href="{{route('contractors.create')}}"><i class="fa fa-plus"></i>{{trans('admin.Add_a_contractor')}}</a></li>--}}
            {{--                    <li><a href="{{route('contracts.create')}}"><i class="fa fa-plus"></i>{{trans('admin.Add_a_contract')}}</a></li>--}}
            {{--                    <li><a href="{{route('contracts.create')}}"><i class="fa fa-plus"></i>{{trans('admin.Add_a_contract')}}</a></li>--}}
            {{--                    @endcan--}}

            {{--                </ul>--}}
            {{--            </li>--}}
            {{--            @endhasanyrole --}}
            {{--            --}}{{-- نهاية بيانات مقاولين الباطن --}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
