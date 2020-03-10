<aside class="main-sidebar" id="mySidenav">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="@if(hr()->user()->image !== null){{asset(hr()->user()->image)}}@else {{url('/')}}/public/hr/adminlte/previewImage.png @endif"  style="height: 45px !important;" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{hr()->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> {{trans('hr.online')}}</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            @if(hr()->user()->branches != null) <li class="header" style="color: #ccc !important;"><p>{{session_lang(hr()->user()->branches->name_en,hr()->user()->branches->name_ar)}}</p></li>
            @else
                <li class="header" style="color: #ccc !important;"><p>{{trans('hr.main_navigation')}}</p></li>
            @endif


            {{-- لوحة التحكم --}}
            <li class="treeview {{ active_menu('admin/dashboard')[0] }} {{ active_menu('admin/setting')[0] }} {{ active_menu('admin/branches')[0] }}{{ active_menu('admin/branches/create')[0] }}">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>{{trans('hr.dashboard')}}</span>
                    <spahn class="pull-right-container"></spahn>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('admin/branches/create')[1] }}{{ active_menu('admin/dashboard')[1] }} {{ active_menu('admin/setting')[1] }} {{ active_menu('admin/branches')[1] }}{{ active_menu('admin/branches/create')[1] }}">
                    <li class="{{ active_menu('admin/dashboard')[2] }}">
                        <a href="{{route('hr.home')}}"><i class="fa fa-circle-o"></i> {{trans('hr.dashboard')}}</a>
                    </li>
                    @hasrole('hr')
{{--                        <a href="{{route('hr.home')}}"><i class="fa fa-circle-o"></i> {{trans('hr.control_panel_setting')}}</a>--}}
                    @endhasrole
                </ul>
            </li>
            {{--  نهاية لوحة التحكم --}}


             {{-- بداية شؤون الموظفين--}}
            <li class="treeview
            {{ active_menu('admin/grades')[0] }}
            {{ active_menu('admin/class')[0] }}
            {{ active_menu('admin/classroom')[0] }}
                ">
                <a href="#">
                    <i class="fa fa-users"></i> <span>{{trans('hr.emp_affairs')}}</span>
                    <span class="pull-right-container"></span>
                </a>
                <ul class="treeview-menu" style="
                {{ active_menu('admin/grades')[1] }}
                {{ active_menu('admin/class')[1] }}
                {{ active_menu('admin/classroom')[1] }}
                    ">
                    <li class="treeview
                {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                    </li>
                    {{--الحركة الإدارية للموظفين--}}
                    <li class="treeview
                        {{ active_menu('admin/grades')[0] }}
                        {{ active_menu('admin/class')[0] }}
                        {{ active_menu('admin/classroom')[0] }}
                        {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.administrative_movement')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                    {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.emp_change_work_time')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.update_additional_time')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.emp_exit_permission')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.emp_payment_request')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.change_location_and_work_time')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.emp_administrative_movement_reports')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.emp_approval_daily_movement')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>
                    {{--القرارات الإدارية والتدرج الوظيفي--}}
                    <li class="treeview
                        {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.administrative_decisions')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                    {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.edit_form_salary_and_upgrade')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.alert_and_punish_decisions')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.fire_and_end_service_decisions')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.update_emp_info_form')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.visa_request_trace')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.emp_level_decisions_trace')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>
                    {{--استيفاء بيانات الموظفين--}}
                    <li class="treeview
                        {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.data_complete')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                    {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.request_job')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.job_descriptions')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.installation_decisions')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>
                    {{--التدريب--}}
                    <li class="treeview
                        {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.training')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                    {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.training_cycle_trace')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.selection_training')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.yearly_training_plane')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.request_training_need')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.training_providers')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.training_programs')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>

                    {{--طباعة الكروت للموظفين--}}
                    <li class="treeview
                        {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-id-card"></i> <span>{{trans('hr.card_print')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    {{--تغير تسلسل كارت الموظفين--}}
                    <li class="treeview
                        {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-id-card"></i> <span>{{trans('hr.change_card_serial')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>

                    {{--الموظفين المنتهي خدماتهم--}}
                    <li class="treeview
                        {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-user-times"></i> <span>{{trans('hr.emp_finished_serves')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>


                </ul>
            </li>
            {{-- نهاية شؤون الموظفين--}}


            {{-- بداية الحضور والانصراف--}}
            <li class="treeview
            {{ active_menu('admin/grades')[0] }}
            {{ active_menu('admin/class')[0] }}
            {{ active_menu('admin/classroom')[0] }}
                ">
                <a href="#">
                    <i class="fa fa-clock-o"></i> <span>{{trans('hr.attend_leaving')}}</span>
                    <span class="pull-right-container"></span>
                </a>
                <ul class="treeview-menu" style="
                {{ active_menu('admin/grades')[1] }}
                {{ active_menu('admin/class')[1] }}
                {{ active_menu('admin/classroom')[1] }}
                    ">
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                    </li>
                    {{--جهاز الساعه /متابعة الحضور والانصراف --}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.clock_exists_leaving_trace')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.move_data_from_finger_print')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.import_card_movements')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.trace_card_movements')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.view_card_movements')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.attend_delay_movements_and_work_orders')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.update_addition_attend_delay_discount')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.close_daily_movement_for_card')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.exists_leaving_trace')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.exists_leaving_reports')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>
                    {{--العمليات/متابعة الحضور والانصراف--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.operation_exists_leaving_trace')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.daily_exists_location_and_work_time')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.detect_daily_exists')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.operation_attend_leaving_trace')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.report_operation_and_event')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>
                    {{--المقاولات/إدخال بيانات الكارت--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.construction_card_info_insert')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- نهاية الحضور والانصراف--}}


            {{-- بداية الرواتب --}}
            <li class="treeview
            {{ active_menu('admin/grades')[0] }}
            {{ active_menu('admin/class')[0] }}
            {{ active_menu('admin/classroom')[0] }}
                ">
                <a href="#">
                    <i class="fa fa-money"></i> <span>{{trans('hr.salaries')}}</span>
                    <span class="pull-right-container"></span>
                </a>
                <ul class="treeview-menu" style="
            {{ active_menu('admin/grades')[1] }}
                {{ active_menu('admin/class')[1] }}
                {{ active_menu('admin/classroom')[1] }}
                    ">
                    <li class="treeview
                {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                    </li>
                    {{--حركة الاستحقاقات --}}
                    <li class="treeview
                {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.merit_cutting_movement')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
            {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.merit_movement')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.merit_cutting_movement')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.daily_reports_movements')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.emp_cash_information')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>
                    {{--التعامل مع بيانات السلف والذمم--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.payment_receivables_data_handel')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.update_discount_monthly_receivables')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.payment_receivables_basic_information')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.payment_receivables_report')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.receivables_stock_check')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>
                    {{--التعامل مع كوبونات المطعم--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.restaurant_coupon')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.restaurant_coupon_basic_information')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.restaurant_basic_information')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>
                    {{--بينات التأمينات--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.insurance_info')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.society_insurance')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.medical_insurance')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.medical_risks_insurance')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>
                    {{--احتساب الرواتب الشهرية--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.month_salary_calc')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.month_salary_calc')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.show_emp_month_salary')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.close_month_salary_movement')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>

                    {{--تقارير إحصائية للرواتب--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.statistical_salaries_reports')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.statistical_details_for_emp_salary')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.statistical_reports_for_emp_salary')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>
                    {{--كشف الراتب الشهري للموظفين--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.detect_emp_month_salary')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    {{--مفرادت الراتب الشهري للموظفين--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.details_emp_month_salary')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    {{--كشف رواتب الموظفين للبنك--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.detect_bank_emp_salary')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    {{--كشف رواتب الموظفين نقدا--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.detect_cash_emp_salary')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    {{--كشف حركة الرواتب تفصيلى للموظف--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.details_emp_salary_movements')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>

                </ul>
            </li>
            {{-- نهاية الرواتب --}}


            {{-- بداية الأجازات --}}
            <li class="treeview
            {{ active_menu('admin/grades')[0] }}
            {{ active_menu('admin/class')[0] }}
            {{ active_menu('admin/classroom')[0] }}
                ">
                <a href="#">
                    <i class="fa fa-clock-o"></i> <span>{{trans('hr.vacations')}}</span>
                    <span class="pull-right-container"></span>
                </a>
                <ul class="treeview-menu" style="
                {{ active_menu('admin/grades')[1] }}
                {{ active_menu('admin/class')[1] }}
                {{ active_menu('admin/classroom')[1] }}
                    ">
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                    </li>
                    {{-- الأجازة الدورية/الطارئة --}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.vacations_cycle_emergency')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.request_vacations')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.vacations_benefits_calc')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.vacation_give_form')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.return_form_vacation')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.extend_vacation')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.stock_effect')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.emp_vacations_information')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>
                    {{--صرف بدل الأجازة للموظف--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.cashing_allowance_vacations')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.request_cash_allowance')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.cash_exchange_form')}}</a></li>
                            <li class="{{ active_menu('admin/discount')[2] }}"><a href="{{route('discount.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.stock_effect')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>

                    {{--مخطط الأجازات السنوية--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.yearly_vacations_planner')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.vacations_planner_data')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.print_vacation_planner')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>
                    {{--حساب مستحقات نهاية الخدمة--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.calculation_end_service_benefits')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>

                    {{--تقارير المخصصات--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.allocations_reports')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    {{--تقارير حركة الأجازات--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.vacations_movements_reports')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- نهاية الأجازات --}}


            {{-- بداية البيانات الأساسية --}}
            <li class="treeview
            {{ active_menu('admin/grades')[0] }}
            {{ active_menu('admin/class')[0] }}
            {{ active_menu('admin/classroom')[0] }}
                ">
                <a href="#">
                    <i class="fa fa-info-circle"></i> <span>{{trans('hr.basic_information')}}</span>
                    <span class="pull-right-container"></span>
                </a>
                <ul class="treeview-menu" style="
                {{ active_menu('admin/grades')[1] }}
                {{ active_menu('admin/class')[1] }}
                {{ active_menu('admin/classroom')[1] }}
                    ">
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                    </li>
                    {{--البيانات الأساسية للموظفين --}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="{{route('emp_data')}}">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.emp_basic_information')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    {{--البيانات المالية للموظفين--}}
                    <li class="treeview
                {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.emp_money_information')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>

                    {{--بيانات المرافقين للموظفين--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.emp_followers_information')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    {{--بيانات المرفقات للموظفين--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.emp_attaches_information')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>

                    {{--بيانات الأجازات للموظفين--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.emp_vacations_information')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    {{--بيانات العناوين للموظفين--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.emp_addresses_information')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>

                    {{--البيانات الأساسية للشركات--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.com_basic_information')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>

                    {{--البيانات الأساسية للأصول الثابتة--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.fixed_root_basic_information')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    {{--البيانات الأساسية للسيارات--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.cars_basic_information')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>

                </ul>
            </li>
            {{-- نهاية البيانات الأساسية --}}


            {{-- بداية التقارير --}}
            <li class="treeview
            {{ active_menu('admin/grades')[0] }}
            {{ active_menu('admin/class')[0] }}
            {{ active_menu('admin/classroom')[0] }}
                ">
                <a href="#">
                    <i class="fa fa-print"></i> <span>{{trans('hr.reports')}}</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            {{-- نهاية التقارير --}}


            {{--بداية الرخص للشركات --}}
            <li class="treeview
            {{ active_menu('admin/grades')[0] }}
            {{ active_menu('admin/class')[0] }}
            {{ active_menu('admin/classroom')[0] }}
                ">
                <a href="#">
                    <i class="fa fa-paperclip"></i> <span>{{trans('hr.com_license')}}</span>
                    <span class="pull-right-container"></span>
                </a>

                <ul class="treeview-menu" style="
                {{ active_menu('admin/grades')[1] }}
                {{ active_menu('admin/class')[1] }}
                {{ active_menu('admin/classroom')[1] }}
                    ">
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                    </li>
                    {{--تأسيس شركات --}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.com_create')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    {{--بيانات الرخص للشركات--}}
                    <li class="treeview
                {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.com_license_information')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>

                    {{--تعديل بيانات الرخص للشركات--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.edit_com_license_information')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- نهاية الرخص للشركات --}}


            {{--بداية الأصول الثابتة والسيارات --}}
            <li class="treeview
            {{ active_menu('admin/grades')[0] }}
            {{ active_menu('admin/class')[0] }}
            {{ active_menu('admin/classroom')[0] }}
                ">
                <a href="#">
                    <i class="fa fa-bar-chart"></i><span>{{trans('hr.fixed_root_and_cars')}}</span>
                    <span class="pull-right-container"></span>
                </a>

                <ul class="treeview-menu" style="
                {{ active_menu('admin/grades')[1] }}
                {{ active_menu('admin/class')[1] }}
                {{ active_menu('admin/classroom')[1] }}
                    ">
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                    </li>
                    {{--الأصول الثابتة --}}
                    <li class="treeview
                     {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.fixed_root')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.prepare_consuming_monthly_record')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.ending_fixed_root')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.root_and_protection_movement')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>
                    {{--السيارات--}}
                    <li class="treeview
                     {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.cars')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.cars_rating')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.trace_traffic_violation')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.cars_accidents')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.cars_users')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>

                </ul>
            </li>
            {{-- نهاية الأصول الثابتة والسيارات --}}


            {{--بداية الإعدادات --}}
            <li class="treeview
            {{ active_menu('admin/grades')[0] }}
            {{ active_menu('admin/class')[0] }}
            {{ active_menu('admin/classroom')[0] }}
                ">
                <a href="#">
                    <i class="fa fa-dashboard"></i><span>{{trans('hr.settings')}}</span>
                    <span class="pull-right-container"></span>
                </a>

                <ul class="treeview-menu" style="
                 {{ active_menu('admin/grades')[1] }}
                {{ active_menu('admin/class')[1] }}
                {{ active_menu('admin/classroom')[1] }}
                    ">
                    <li class="treeview
                     {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                    </li>
                    {{--إعدادات شؤون الموظفين --}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.emp_affairs_settings')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
    {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.when_system_start')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.branches_information')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.com_fixed')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.nationality')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.education_status')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.social_status')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.job_status')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.religion')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.stay_id_types')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.passport_types')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.driving_licenses_types')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.where_licences_cities')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.entry_and_departure_ports')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.management_jobs')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.job_specialization')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.license_types_for_job')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.where_license_job')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.special_needs')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.attaches_types')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.emp_class')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.salary_group_class')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.com_worker_class')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.com_sections_information')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.com_management_class')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.com_providers_work')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.com_management')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>

                    {{--إعدادت الرواتب والأجازات--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.salary_vacations_settings')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.salary_payment_way')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.banks_information')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.request_money_form')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.merit_types')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.cutting_types')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.additional_types')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.violation_repeat')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.live_exchange_class')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.live_types_class')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.travelling_means_type')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.vacations_merit_types')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.vacations_request_types')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>

                    {{--إعدادت الشركات--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.com_settings')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.com_class')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.where_com_license')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.com_license_providers')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.com_status')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.com_owner_build')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.edit_com_information')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.payment_fees_way_types')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.Legal_capacity_of_partners_delegates')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.activity_type')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.location_types')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.license_types')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>

                    {{--إعدادت الحضور والانصراف--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.exists_leaving_settings')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.exists_leaving_list_by_clock')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.work_time_division_depend_on_work')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.vacation_and_rest_planner_in_month')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.vacation_and_rest_planner_in_week')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.work_day_statement_in_week')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.work_day_type_in_week')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.work_group_class')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.group_work_time_by_date')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.early_exit_policy_discount')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.delay_policy_discount')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.emp_work_time_class')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.government_vacation_planner')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.com_punishing_list')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>

                    {{--إعدادت الأصول والسيارات--}}
                    <li class="treeview
                    {{ active_menu('admin/grades')[0] }}
                    {{ active_menu('admin/class')[0] }}
                    {{ active_menu('admin/classroom')[0] }}
                    {{ active_menu('admin/discount')[0] }}">
                        <a href="#">
                            <i class="fa fa-bars"></i> <span>{{trans('hr.fixed_root_and_cars_settings')}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                        <ul class="treeview-menu" style="
                        {{ active_menu('admin/grades')[1] }}
                        {{ active_menu('admin/class')[1] }}
                        {{ active_menu('admin/classroom')[1] }}
                        {{ active_menu('admin/discount')[1] }}
                            ">
                            @hasrole('hr')
                            <li class="{{ active_menu('admin/grades')[2] }}"><a href="{{route('grades.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.consuming_way')}}</a></li>
                            <li class="{{ active_menu('admin/class')[2] }}"><a href="{{route('class.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.root_types')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.root_location')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.root_status')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.cars_type')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.cars_model')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.cars_model_type')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.cars_color')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.made_date')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.manufacture_country')}}</a></li>
                            <li class="{{ active_menu('admin/classroom')[2] }}"><a href="{{route('classroom.index')}}"><i class="fa fa-circle-o"></i> {{trans('hr.classes_for_cars')}}</a></li>
                            @endhasrole
                        </ul>
                    </li>

                </ul>
            </li>
            {{-- نهاية الإعدادات --}}


            {{-- حساب المدير --}}
            @hasrole('hr')
            <li class="treeview {{active_menu('admin/admins')[0]}}{{active_menu('admin/permissions')[0]}}{{active_menu('admin/roles')[0]}}">
                <a href="#">
                    <i class="fa fa-users"></i> <span>{{trans('hr.hr_account')}}</span>
                    <span class="pull-right-container">
        </span>
                </a>
                <ul class="treeview-menu" style="{{active_menu('admin/admins')[1]}}{{active_menu('admin/permissions')[1]}}{{active_menu('admin/roles')[1]}}">
                    <li class="{{active_menu('hr/hrs')[2]}}"><a href="{{route('hrs.index')}}"><i class="fa fa-circle-o"></i>{{trans('hr.hr_account')}} </a></li>
                    <li class="{{active_menu('hr/HrPermissions')[2]}}"><a href="{{route('HrPermissions.index')}}"><i class="fa fa-circle-o"></i>{{trans('hr.permissions')}} </a></li>
                    <li class="{{active_menu('hr/HrRoles')[2]}}"><a href="{{route('HrRoles.index')}}"><i class="fa fa-circle-o"></i>{{trans('hr.roles')}} </a></li>
                </ul>
            </li>
            @endhasrole
            {{-- نهاية حساب المدير--}}


        </ul>
    </section>
</aside>
