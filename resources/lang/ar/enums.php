<?php
use App\Enums\GenderType;
use App\Enums\SpecialNeeds;
use App\Enums\SalaryPaymentWay;
use App\Enums\HrHousePaymentType;
use App\Enums\Hr\HousingClassification;
use App\Enums\Hr\AstcHldyEarn;
use App\Enums\CompanyEmployeeClass;
use App\Enums\Hr\EducationType;
use App\Enums\Hr\HrTransType;
use App\Enums\Hr\EmployeeClass; // فئة الموظفين
use App\Enums\Hr\MBudg_typ; // فئة الموظفين
use App\Enums\Hr\PassportType; // انواع جواز السفر
use App\Enums\Hr\IDType; // انواع الإقامات
use App\Enums\Hr\DriveLicenceType; // انواع رخص القيادة
use App\Enums\Hr\HrAstAttachType; // انواع المرفقات
use App\Enums\ShiftTypes;
use App\Enums\SalaryClassNo;
use App\Enums\Nationalities;
use App\Enums\JobStatus;
use App\Enums\TypeType;
use App\Enums\RelationType;
use App\Enums\ReligionType;
use App\Enums\Hr\SocialType; 
use App\Enums\WorkType;
use App\Enums\LicenseType;
use App\Enums\HealthType;
use App\Enums\BloodType;
use App\Enums\EducateType;
use App\Enums\StatusType;
use App\Enums\ExperianceType;
use App\Enums\SupplierType;
use App\Enums\CurrencyType;
use App\Enums\ClassbusType;
use App\Enums\SalaryType;
use App\Enums\GearboxType;
use App\Enums\BusStatusType;
use App\Enums\ScheduleType;
use App\Enums\PayType;
use App\Enums\BranchType;
use App\Enums\WorkStatusType;
use App\Enums\LevelType;
use App\Enums\DocType;
use App\Enums\PostEnum;
use App\Enums\AccountPostingType;
use App\Enums\FormsType;
use App\Enums\PrintersType;
use App\Enums\AllowedType;
use App\Enums\OptionsType;
use App\Enums\LangType;
use App\Enums\AccountType;
use App\Enums\TransactionType;
//data links
use App\Enums\dataLinks\OperationType;
use App\Enums\dataLinks\FinaAccountType;
use App\Enums\dataLinks\DiscounRevenueType;
use App\Enums\dataLinks\BondRestrictionsType;
use App\Enums\dataLinks\CcType;
use App\Enums\dataLinks\StatusAccountType;
use App\Enums\dataLinks\CategoryAccountType;
use App\Enums\dataLinks\TypeAccountType;
use App\Enums\dataLinks\InvoiceSaleType;
use App\Enums\dataLinks\BankAppearType;
use App\Enums\dataLinks\AccountTypeType;
use App\Enums\dataLinks\BalanceReviewType;
use App\Enums\dataLinks\ExpenseIncomeType;
use App\Enums\dataLinks\LimitTimeType;
use App\Enums\dataLinks\IncomeListType;
use App\Enums\dataLinks\StatusTreeType;
use App\Enums\dataLinks\ReceiptType;
use App\Enums\dataLinks\LimitationsType;
use App\Enums\dataLinks\MonthType;
use App\Enums\dataLinks\DepartmentReportType;
use App\Enums\PrjStatus;
use App\Enums\NotiType;


return [

    GenderType::class => [
        GenderType::male => 'ذكر',
        GenderType::female => 'أنثي',
    ],
    SpecialNeeds::class => [
        SpecialNeeds::normal => 'طبيعي', //0
        SpecialNeeds::special_need => 'احتياجات خاصه',//1
    ],
    SalaryPaymentWay::class => [
        SalaryPaymentWay::none => 'بدون',
        SalaryPaymentWay::bank => 'بنك',
        SalaryPaymentWay::cash => 'نقدي',
        SalaryPaymentWay::check => 'شيك',
    ],
    HrHousePaymentType::class => [
        HrHousePaymentType::none => 'بدون',
        HrHousePaymentType::monthly => 'شهري',
        HrHousePaymentType::quarterYear => 'ربع سنوي',
        HrHousePaymentType::halfYear => 'نصف سنوي',
        HrHousePaymentType::fullYear => 'سنوي',
        HrHousePaymentType::companyHouse => 'سكن بالشركة',
    ],
    HousingClassification::class => [
        HousingClassification::none => 'بدون',
        HousingClassification::room => 'غرفه',
        HousingClassification::tworooms => 'غرفتين',
        HousingClassification::roomhall => 'غرفتين وصاله',
        HousingClassification::flat => 'شقه كامله',
    ],
    SalaryClassNo::class => [
        SalaryClassNo::none => 'بدون',
        SalaryClassNo::Managers => 'المديرين',
        SalaryClassNo::Technicians => 'الفنيين',
        SalaryClassNo::Laborers => 'العمال',
        SalaryClassNo::Administration => 'الاداره',
        SalaryClassNo::factory => 'المصنع',
        SalaryClassNo::foreign => 'خارجي',
    ],
    CompanyEmployeeClass::class => [
        CompanyEmployeeClass::none => 'بدون',
        CompanyEmployeeClass::permanentEmployee => 'موظف دائم',
        CompanyEmployeeClass::temporaryEmployee => 'موظف مؤقت',
    ],
    HrTransType::class => [
        HrTransType::none => 'بدون', 
        HrTransType::air => 'جوا',
        HrTransType::sea => 'بحرا',
        HrTransType::land => 'برا',
    ],
    Nationalities::class => [
        Nationalities::Saudi => 'السعوديه',
        Nationalities::egyptian => 'المصريه',
    ],
    // المرفقات
    HrAstAttachType::class => [
        HrAstAttachType::photograph => 'صورة شخصية',
        HrAstAttachType::residence => 'الاقامة',
        HrAstAttachType::passport => 'جواز السفر',
        HrAstAttachType::graduationCertificate => 'شهادة التخرج',
    ],
    EducationType::class => [
        EducationType::none => 'بدون', 
        EducationType::noRead => 'أميّ',
        EducationType::writingReading => 'يقرأ ويكتب',
        EducationType::primary => 'ابتدائي',
        EducationType::mediate => 'متوسط',
        EducationType::secondary => 'ثانوى',
        EducationType::diploma => 'دبلوم',
        EducationType::academic => 'جامعى',
        EducationType::ma => 'ماجستير',
        EducationType::doctorate => 'دكتوراه',
    ],
    EmployeeClass::class => [
        EmployeeClass::none => 'بدون', 
        EmployeeClass::ExcellentClass => 'فئة ممتازة',
        EmployeeClass::ClassA => 'فئة أ', 
        EmployeeClass::ClassB => 'فئة ب',
        EmployeeClass::ClassG => 'فئة ج',
        EmployeeClass::ClassD => 'فئة د',
    ],
    MBudg_typ::class => [
        MBudg_typ::none => 'بدون', 
        MBudg_typ::year => 'سنة', 
        MBudg_typ::twoYears => 'سنتين',
        MBudg_typ::threeYears => 'ثلاث سنوات', 
        MBudg_typ::fourYears => 'أربع سنوات',
        MBudg_typ::fiveYears => 'خمس سنوات',
        MBudg_typ::flexibleYears => 'أكثر',
    ],
    IDType::class => [
        IDType::none => 'بدون', 
        IDType::systemic => 'نظامية', 
        IDType::nonSystemic => 'غير نظامية',
        IDType::nationalityId => 'هوية وطنية', 
        IDType::workVisiting => 'زيارة عمل',
    ],
    DriveLicenceType::class => [
        DriveLicenceType::none => 'بدون', 
        DriveLicenceType::spacial => 'خصوصى', 
        DriveLicenceType::mediate => 'متوسط',
        DriveLicenceType::generalGreat => 'عمومى كبير', 
    ],
    PassportType::class => [
        PassportType::none => 'بدون', 
        PassportType::normal => 'عادى', 
        PassportType::diplomatic => 'دبلوماسى',
        PassportType::document => 'وثيقة', 
        PassportType::other => 'أخرى',
    ],
    JobStatus::class => [
        JobStatus::none => 'بدون',
        JobStatus::stayWork => 'على رأس العمل',
        JobStatus::inVacation => 'القيام بأجازة',
        JobStatus::finishService => 'إنهاء الخدمة',
        JobStatus::goneNoReturn => 'خرج ولم يعد',
        JobStatus::escape => 'هروب',
        JobStatus::other => 'أخرى',
    ],
    ShiftTypes::class => [
        ShiftTypes::none => 'بدون',
        ShiftTypes::Administration => 'الاداره',
        ShiftTypes::first_patrol => 'الورديه الأولى',
        ShiftTypes::second_patrol => 'الورديه الثانيه',
        ShiftTypes::third_patrol => 'الورديه الثالثه',
    ],
    AstcHldyEarn::class => [
        AstcHldyEarn::none => 'بدون',
        AstcHldyEarn::according_law => 'حسب القانون',
        AstcHldyEarn::annual15 => 'سنويه 15',
        AstcHldyEarn::annual30 => 'سنويه 30',
        AstcHldyEarn::annual21 => 'سنويه 21',
        AstcHldyEarn::annual45 => 'سنويه 45',
        AstcHldyEarn::years30  =>  'سنتين 30',
    ],
    BranchType::class => [
        BranchType::manage => 'اداره', //0
        BranchType::main_store => 'مستودع رئيسى', //1
        BranchType::branch => 'مستودع فرعى', //2
        BranchType::sales_point => 'نقطة بيع', //3
    ],
    TypeType::class => [
        TypeType::student => 'طالب',
        TypeType::single => 'فردي',
        TypeType::company => 'شركة',
        TypeType::domestic_flights => 'رحلات داخليه',
    ],
    RelationType::class => [
        RelationType::father => 'أب',
        RelationType::mother => 'أم',
        RelationType::brother => 'أخ',
        RelationType::sister => 'أخت',
        RelationType::grandfather => 'جد',
        RelationType::grandmother => 'جدة',
        RelationType::Stepfather => 'زوج الأم',
        RelationType::HusbandAunt => 'زوج العمة',
        RelationType::uncle => 'عم',
        RelationType::aunt => 'عمة',
        RelationType::uncle_M => 'خال',
        RelationType::aunt_M => 'خالة',
        RelationType::brother_in_law => 'زوج الأخت',
        RelationType::cousin => 'ابن العم',
        RelationType::husband => 'زوج',
    ],
    ReligionType::class => [
        ReligionType::Muslim => 'مسلم',
        ReligionType::Christian => 'مسيحي',
        ReligionType::Jewish => 'يهودي',
        ReligionType::Others => 'ديانات أخري',
    ],
    SocialType::class => [
        SocialType::Single => 'أعزب',
        SocialType::Married => 'متزوج',
        SocialType::Divorcee => 'مطلق',
        SocialType::Widowed => 'أرمل',
    ],
    HealthType::class => [
        HealthType::Normal => 'طبيعي',
        HealthType::SpecialNeeds => 'احتياجات خاصه',
    ],
    WorkType::class => [
        WorkType::Administrative => 'اداري',
        WorkType::sales => 'مبيعات',
        WorkType::Worker => 'عامل',
        WorkType::night_worker => 'عامل ليلي',
    ],
    WorkStatusType::class => [
        WorkStatusType::vacation => 'القيام بأجازه',
        WorkStatusType::termination_of_service => 'انهاء الخدمه',
        WorkStatusType::On_the_job => 'علي رأس العمل',
    ],
    LicenseType::class => [
        LicenseType::SpecialLicense => 'رخصه خاصه',
        LicenseType::FirstClassLicense => 'رخصه درجه أولي',
        LicenseType::SecondClassLicense => 'رخصه درجه تانيه',
        LicenseType::ThirdClassLicense => 'رخصه درجه تالته',
    ],
    BloodType::class => [
        BloodType::O => 'O موجب',
        BloodType::Om => 'O سالب',
        BloodType::A => 'A موجب',
        BloodType::Am => 'A سالب',
        BloodType::B => 'B موجب',
        BloodType::Bm => 'B سالب',
        BloodType::AB => 'AB موجب',
        BloodType::ABm => 'AB سالب',
    ],
    EducateType::class => [
        EducateType::preparatory => 'اعدادي',
        EducateType::secondary => 'ثانوي',
        EducateType::QualifiedAverage => 'مؤهل متوسط',
        EducateType::HighQualified => 'مؤهل عالي',
    ],
    StatusType::class => [
        StatusType::Stopped => 'ايقاف',
        StatusType::Serves => 'يعمل',
        StatusType::InVacation => 'في أجازه',
        StatusType::Sick => 'مريض',
        StatusType::Damage => 'عطل في السياره',
        StatusType::Escape => 'هروب',
        StatusType::WithoutCar => 'بدون سياره',
    ],
    ExperianceType::class => [
        ExperianceType::LessThanYear => 'أقل من سنه',
        ExperianceType::OneYear => 'سنه',
        ExperianceType::TwoYears => 'سنتين',
        ExperianceType::ThreeYears => 'ثلاث سنين',
        ExperianceType::FourYears => 'أربع سنين',
        ExperianceType::FiveYears => 'خمس سنين',
        ExperianceType::MoreThanFive => 'أكثر من خمس سنين',
    ],
    SupplierType::class => [
        SupplierType::GeneralSupplier => 'مورد عام',
        SupplierType::SupplierOfSpareParts => 'مورد قطع غيار',
    ],
    CurrencyType::class => [
        CurrencyType::SAR => 'ريال سعودي',
        CurrencyType::USD => 'دولار',
        CurrencyType::EUR => 'يورو',
    ],
    SalaryType::class => [
        SalaryType::monthly => 'شهري',
        SalaryType::daily => 'يومي',
    ],
    ClassbusType::class => [
        ClassbusType::bus => 'أتوبيس',
        ClassbusType::minibus => 'ميني باص',
        ClassbusType::microbus => 'ميكروباص'
    ],
    GearboxType::class => [
        GearboxType::automatic => 'أتوماتيك',
        GearboxType::manual => 'عادي',
    ],
    ScheduleType::class => [
        ScheduleType::go => 'ذهاب',
        ScheduleType::rturn => 'عوده',
    ],
    BusStatusType::class => [
        BusStatusType::working => 'في الخدمه',
        BusStatusType::noexist => 'غير موجود',
        BusStatusType::maintance => 'في الصيانه',
        BusStatusType::accident => 'حادث',
        BusStatusType::stopedaccident => 'توقف-حادث',
        BusStatusType::stopedselling => 'توقف بيع',
        BusStatusType::bookingtraffic => 'حجز مروري',
        BusStatusType::withoutdriver => 'بدون سائق',
        BusStatusType::stoped => 'ايقاف',
        BusStatusType::weekend => 'نهاية الأسبوع',
    ],
    PayType::class => [
        PayType::cache => 'نقدي',//1
        PayType::check => 'شيك',//2
        PayType::visa => 'فيزا',//3
        PayType::bank => 'تحويل بنكى',//4
    ],

//    data links

    ReceiptType::class => [
        ReceiptType::open => 'قيد افتتاحى',
        ReceiptType::cache_in => 'سند قبض نقدى',
        ReceiptType::cheq_in => 'سند قبض شيك',
        ReceiptType::cache_out => 'سند صرف نقدى',
        ReceiptType::cheq_out => 'سند صرف شيك',
        ReceiptType::daily => 'قيد يوميه',
        ReceiptType::future_sale => 'مبيعات اجله',
        ReceiptType::cache_sale => 'مبيعات نقديه',
        ReceiptType::future_purchase => 'مشتريات اجله',
        ReceiptType::cache_purchase => 'مشتريات نقديه',
        ReceiptType::trnsform_in => 'وارد تحويل',
        ReceiptType::transform_out => 'منصرف تحويل',
        ReceiptType::add_equation => 'تسويه بالاضافه',
        ReceiptType::sub_equation => 'تسويه بالخصم',
        ReceiptType::debt_notify => 'اشعار مدين',
        ReceiptType::credit_notify => 'اشعار دائن',
    ],
    LevelType::class => [
        LevelType::accounts => 'حسابات',
        LevelType::cost_centers => 'مراكز تكلفه',
        LevelType::final_account => 'حساب ختامي',
        LevelType::center_analysis => 'مركز تحليل',
    ],
    OperationType::class => [
        OperationType::suppliers => 'موردين',
        OperationType::customers => 'عملاء',
        OperationType::projects => 'مشروعات',
        OperationType::accounts => 'حسابات',
        OperationType::employees => 'موظفين',
        OperationType::cashiers => 'الصندوق',
        OperationType::banks => 'البنوك',
        OperationType::minus_document => 'اشعار خصم',
        OperationType::plus_document => 'اشعار اضافه',
    ],
    FinaAccountType::class => [
        FinaAccountType::budget_elements => 'بنود الميزانيه',
        FinaAccountType::incoming_list => 'قائمة الدخل',
        FinaAccountType::money_flow_up => 'تدفقات نقديه',
    ],
    DiscounRevenueType::class => [
        DiscounRevenueType::revenue => 'حساب الايرادات',
        DiscounRevenueType::Discount => 'حساب خصومات',
    ],
    BondRestrictionsType::class => [
        BondRestrictionsType::inCash => 'سند قبض نقدي',
        BondRestrictionsType::inCheck => 'سند قبض شيك',
        BondRestrictionsType::outCash => 'سند صرف نقدي',
        BondRestrictionsType::outCheck => 'سند صرف شيك',
//        BondRestrictionsType::adjustment => 'قيد تسويه',
//        BondRestrictionsType::inExchange => 'سند قبض حواله',
//        BondRestrictionsType::outExchange => 'سند صرف حواله',
//        BondRestrictionsType::notificationMinus => 'سند اشعار بالخصم',
//        BondRestrictionsType::notificationPluse => 'سند اشعار بالاضافه',
//        BondRestrictionsType::discountInVoucher => 'سند قبض خصم رصيد',
//        BondRestrictionsType::discountOutVoucher => 'سند صرف خصم رصيد',
//        BondRestrictionsType::store => 'قيد المخزون',
//        BondRestrictionsType::purchasesReturn => 'قيد مرتجع المشتريات',
//        BondRestrictionsType::salesReturn => 'قيد مرتجع المبيعات',
        BondRestrictionsType::daily => 'قيد يوميه',
        BondRestrictionsType::NoticeDebt => 'اشعار مدين',
        BondRestrictionsType::NoticeCreditor => 'اشعار دائن',
        BondRestrictionsType::sales => 'فاتورة المبيعات',
        BondRestrictionsType::purchases => 'فاتورة المشتريات',
        BondRestrictionsType::RevenuePayable => 'ايراد مستحق',
        BondRestrictionsType::ExchangeOfMaterials => 'صرف مواد',
        BondRestrictionsType::start => 'قيد افتتاحي',
    ],
    CcType::class => [
        CcType::withoutCc => 'بدون مركز',
        CcType::withCc => 'له مركز',
        CcType::multi => 'متعدد المراكز',
    ],
    StatusAccountType::class => [
        StatusAccountType::suspend => 'معلق',
        StatusAccountType::open => 'مفتوح',
        StatusAccountType::post => 'ترحيل',
        StatusAccountType::confirmed => 'اعتماد',
    ],
    CategoryAccountType::class => [
        CategoryAccountType::dept => 'مدين',
        CategoryAccountType::crpt => 'دائن',
    ],
    TypeAccountType::class => [
        TypeAccountType::main => 'رئيسي',
        TypeAccountType::sub => 'فرعي',
    ],
    InvoiceSaleType::class => [
        InvoiceSaleType::purchaseInvoice => 'فاتورة مبيعات',
        InvoiceSaleType::saleInvoice => 'فاتورة بيع',
        InvoiceSaleType::other => 'أخري',
    ],
    BankAppearType::class => [
        BankAppearType::bankClipboard => 'يظهر البنك داخل نطاق الحافظه',
        BankAppearType::bannkRestriction => 'يظهر البنك داخل نطاق القيود',
    ],
    AccountTypeType::class => [
        AccountTypeType::allAccounts => 'جميع الحسابات',
        AccountTypeType::onlyTrans => 'حسابات يوجد عليها حركه',
        AccountTypeType::noTrans => 'حسابات لايوجد عليها حركه',
        AccountTypeType::deptAccounts => 'حسابات ذات حركة مدينة فقط',
        AccountTypeType::crtAccounts => 'حسابات ذات حركة دائنة فقط',
    ],
    BalanceReviewType::class => [
        BalanceReviewType::reviewBalance => 'ميزان مراجعة الأستاذ المساعد',
        BalanceReviewType::levelReview => 'ميزان مراجعة حسب المستوي',
    ],
    ExpenseIncomeType::class => [
        ExpenseIncomeType::expense => 'مصروف',
        ExpenseIncomeType::income => 'ايراد',
    ],
    LimitTimeType::class => [
        LimitTimeType::firstDate => 'أول المده',
        LimitTimeType::inTime => 'حتي تاريخه',
    ],
    LimitTimeType::class => [
        LimitTimeType::firstDate => 'أول المده',
        LimitTimeType::inTime => 'حتي تاريخه',
    ],
    IncomeListType::class => [
        IncomeListType::budget => 'حساب ميزانية',
        IncomeListType::tradeAccount => 'حساب قائمة الدخل',
        IncomeListType::operatingAccount => 'حساب تشغيل',
    ],
    StatusTreeType::class => [
        StatusTreeType::active => 'فعال',
        StatusTreeType::deactive => 'غير فعال',
    ],
    LimitationsType::class => [
        LimitationsType::dailyLimitations => 'قيد يوميه',
        LimitationsType::NoticeDebt => 'اشعار مدين',
        LimitationsType::NoticeCreditor => 'اشعار دائن',
        LimitationsType::SalesInvoice => 'فاتورة المبيعات',
        LimitationsType::PurchaseInvoice => 'فاتورة المشتريات',
        LimitationsType::RevenuePayable => 'ايراد مستحق',
        LimitationsType::ExchangeOfMaterials => 'صرف مواد',
    ],
    MonthType::class => [
        MonthType::January => 'يناير',
        MonthType::February => 'فبراير',
        MonthType::March => 'مارس',
        MonthType::April => 'ابريل',
        MonthType::May => 'مايو',
        MonthType::June => 'يونيو',
        MonthType::July => 'يوليو',
        MonthType::August => 'أغسطس',
        MonthType::September => 'سبتمبر',
        MonthType::October => 'أكتوبر',
        MonthType::November => 'نوفمبر',
        MonthType::December => 'ديسمبر',
    ],
    DepartmentReportType::class => [
        DepartmentReportType::levelNumber => 'برقم المستوي',
        DepartmentReportType::trustAccounts => 'حسابات الترصيد',
        DepartmentReportType::DeptDepartement => 'حسابات مدينه',
        DepartmentReportType::CrdDepartement => 'حسابات دائنه',
        DepartmentReportType::PersonalDepartement => 'حسابات رئيسيه',
        DepartmentReportType::BranchDepartement => 'حسابات فرعيه',
    ],
    DocType::class => [
        DocType::Rcpt_Flg => 'سند قبض',
        DocType::Pymt_Flg => 'سند صرف',
        DocType::Jv_Flg => 'قيود يوميه',
        DocType::Sal_Flg => 'مبيعات',
        DocType::Pur_Flg => 'مشتريات',
        DocType::Inv_Flg => 'مخازن',
    ],
    PostEnum::class => [
        PostEnum::DlyPst_CshSal => 'ترحيل المبيعات اليوميه على الصندوق',
        PostEnum::DlyPst_CshPur => 'ترحيل المشتريات النقديه على الصندوق',
    ],
    AccountPostingType::class => [
        AccountPostingType::JVPst_SalCash => 'ترحيل المبيعات النقديه للصندوق اليا', //2
        AccountPostingType::JVPst_PurCash => 'ترحيل المشتريات النقديه للصندوق اليا', //3
        AccountPostingType::JVPst_NetSalCrdt => 'ترحيل صافى المبيعات الاجله للحسابات', //4
        AccountPostingType::JVPst_NetPurCrdt => 'ترحيل صافى المشتريات الاجله للحسابات', //5
        AccountPostingType::JVPst_TrnsferVch => 'ترحيل سندات التحويل بين المستودعات للحسابات', //6
        AccountPostingType::JVPst_AdjustVch => 'ترحيل سندات تسوية المخازن للحسابات', //7
        AccountPostingType::JVPst_InvCost => 'ترحيل المخازن بالتكلفه للحسابات', //8
        AccountPostingType::JVPst_InvSal => 'ترحيل المخازن بالنبيعات للحسابات', //9
    ],
    FormsType::class => [
        FormsType::Spcrpt_Rcpt => 'نموذخ خاص سندات القبض',//2
        FormsType::Spcrpt_Pymt => 'نموذج خاص سندات الصرف',//3
        FormsType::Spcrpt_Sal => 'نموذج خاص فاتورة المبيعات',//4
        FormsType::Spcrpt_Pur => 'نموذج خاص فاتورة المشتريات',//5
        FormsType::Spcrpt_Trnf => 'نموذج خاص سندات التحويل',//6
        FormsType::Spcrpt_Adjust => 'نموذج خاص سندات التسويه',//7
        FormsType::Spcrpt_SRV => 'نموذج خاص سند ادخال بضاعه',//8
        FormsType::Spcrpt_DNV => 'نموذج خاص سند تسليم بضاعه',//9
    ],
    PrintersType::class => [
        PrintersType::PrintOrder_DNV => 'طابعة سند التسليم مع فاتورة المبيعات',//2
        PrintersType::PrintOrder_SRV => 'طابعة سند الاستلام مع فاتورة المبيعات',//3
        PrintersType::SelctNorm_Prntr1 => 'اختيار طابعة تقارير 1',//4
        PrintersType::SelctNorm_Prntr2 => 'اختيار طابعة تقارير 2',//5
        PrintersType::SelctNorm_Prntr3 => 'اختيار طابعة تقارير 3',//6
        PrintersType::SelctBarCod_Prntr1 => 'اختيار طابعة الباركود 1',//7
        PrintersType::SelctBarCod_Prntr2 => 'اختيار طابعة الباركود 2',//8
        PrintersType::SelctBarCod_Prntr3 => 'اختيار طابعة الباركود 3',//9
        PrintersType::SelctPosSlip_Prntr1 => 'اختيار طابعة نقاط البيع 1',//10
        PrintersType::SelctPosSlip_Prntr2 => 'اختيار طابعة نقاط البيع 2',//11
        PrintersType::SelctPosSlip_Prntr3 => 'اختيار طابعة نقاط البيع 3',//12
    ],
    AllowedType::class => [
        AllowedType::AllwItm_RepatVch => 'سماحية تكرار الصنف بنفس السند',//2
        AllowedType::AllwItmLoc_ZroBlnc => 'سماحية اظهار المواقع للاصناف ذات الارصده الصفريه',//3
        AllowedType::AllwItmQty_CostCalc => 'سماحية حساب التكلفه يعتمد على الكميه',//4
        AllowedType::AllwDisc1Pur_Dis1Sal => 'سماحية خصم 1 بيع = خصم 1 شراء',//5
        AllowedType::AllwDisc2Pur_Dis2Sal => 'سماحية خصم 2 بيع = خصم 2 شراء',//6
        AllowedType::AllwStock_Minus => 'سماحية تسليم البضاعه بالسالب',//7
        AllowedType::AllwPur_Disc1 => 'سماحية خصم شراء 1',//8
        AllowedType::AllwPur_Disc2 => 'سماحية خصم شراء 2',//9
        AllowedType::AllwPur_Bouns => 'سماحية بونص شراء',//10
        AllowedType::AllwSal_Disc1 => 'سماحية خصم بيع 1',//11
        AllowedType::AllwSal_Disc2 => 'سماحية خصم بيع 2',//12
        AllowedType::AllwSal_Bouns => 'سماحية بونص بيع',//13
        AllowedType::AllwTrnf_Cost => 'سماحية اصدار سندات التحويل بسعر التكلفه',//14
        AllowedType::AllwTrnf_Disc1 => 'سماحية خصم 1 بسندات التحويل بين الفروع',//15
        AllowedType::AllwTrnf_Bouns => 'سماحية البونص بسندات التحويل بين الفروع',//16
        AllowedType::AllwBatch_No => 'سماحية رقم التشغيله للادويه',//17
        AllowedType::AllwExpt_Dt => 'سماحية تاريخ الصلاحيه',//18
        AllowedType::ActvDnv_No => 'تفعيل سند تسليم بضاعه',//19
        AllowedType::ActvSRV_No => 'تفعيل سند ادخال بضاعه',//20
        AllowedType::ActvTrnf_No => 'تفعيل سندات تحويل البضاعه',//21
        AllowedType::TabOrder_Pur => 'ترتيب خاص لشاشة المشتريات',//22
        AllowedType::TabOrder_SaL => 'ترتيب خاص لشاشة المبيعات',//23
    ],
    OptionsType::class => [
        OptionsType::Itm_SrchRef => 'البحث برقم المرجع للصنف',//2
        OptionsType::Date_Status => 'الحركه بالتاريخ الهجرى',//3
        OptionsType::JvAuto_Mnth => 'تسلسل قيد اليويمه اليا حسب الشهر',//4
        OptionsType::Cshr_Status => 'حساب الصندوق و البنوك',//5
        OptionsType::PhyTy_CostPrice => 'الجرد الدورى بالتكلفه',//6
        OptionsType::PhyTy_SalePrice => 'ترحيل العهده بسعر البيع',//7
        OptionsType::Fraction_Cost => 'تكلفة الصنف لاقرب 4 علامات عشريه',//8
        OptionsType::Fraction_Curncy => 'الارقام العشاريه للعمله',//9
    ],
    LangType::class => [
        LangType::arabic => 'العربيه',
        LangType::english => 'الانجليزيه',
    ],
    AccountType::class => [
        AccountType::accounts => 'حسابات',//1
        AccountType::clients => 'عملاء',//2
        AccountType::suppliers => 'موردين',//3
        AccountType::employees => 'موظفين',//4
        // AccountType::fixed_assets => 'الاصول الثابته',//5
        // AccountType::approvals => 'الاعتمادات',//6
        // AccountType::projects => 'المشاريع',//7
    ],
    TransactionType::class => [
        TransactionType::open_entry => 'قيد افتتاحى',//1
        TransactionType::cash_reciept => ' قبض نقدى',//2
        TransactionType::cheque_reciept => ' قبض شيك',//3
        TransactionType::cash_payment => ' صرف نقدى',//4
        TransactionType::cheque_payment => ' صرف شيك',//5
        TransactionType::daily_entry => 'قيد يوميه',//6
        TransactionType::future_sales => 'مبيعات اجله',//7
        TransactionType::cash_sales => 'مبيعات نقديه',//8
        TransactionType::future_purchases => 'مشتريات اجله',//9
        TransactionType::cash_purchases => 'مشتريات نقديه',//10
        TransactionType::income_transform => 'وراد تحويل',//11
        TransactionType::outcome_transform => 'منصرف تحويل',//12
        TransactionType::addition_adiustment => 'تسويه بالاضافه',//13
        TransactionType::discount_adujstment => 'تشويه بالخصم',//14
        TransactionType::debt_notify => 'اشعار مدين',//15
        TransactionType::credit_notify => 'اشعار دائن',//16
    ],

    PrjStatus::class => [
        PrjStatus::enquiry    => 'تحت الدراسه',    //0
        PrjStatus::quted      => 'عرض سعر',     //1
        PrjStatus::refused    => 'مرفوض',   //2
        PrjStatus::ordered    => 'تنفيذ',   //3
        PrjStatus::under_work => 'تحت التشغيل',//4
        PrjStatus::completed  => 'انتهاء المشروع',//5
        PrjStatus::warnty     => 'الضمان',//6
    ],

    NotiType::class => [
        NotiType::Creditor    => 'دائن',    //0
        NotiType::Debit       => 'مدين',     //1
    ],

    \App\Enums\BarCodeSize::class =>[
        \App\Enums\BarCodeSize::large => 'كبير',
        \App\Enums\BarCodeSize::medium => 'متوسط',
        \App\Enums\BarCodeSize::small => 'صغير',
    ],
    \App\Enums\Hr\HrReligion::class => [
        \App\Enums\Hr\HrReligion::islam => 'مسلم',
        \App\Enums\Hr\HrReligion::christian => 'مسيحي',
        \App\Enums\Hr\HrReligion::jewish => 'يهودي',
        \App\Enums\Hr\HrReligion::other => 'ديانات أخري',
    ],

    \App\Enums\Hr\HrTransType::class => [
        \App\Enums\Hr\HrTransType::none => 'بدون',
        \App\Enums\Hr\HrTransType::air => 'جواً',
        \App\Enums\Hr\HrTransType::land => 'براً',
        \App\Enums\Hr\HrTransType::sea => 'بحراً',
    ],

    \App\Enums\Hr\HrHousePaymentType::class => [
        \App\Enums\Hr\HrHousePaymentType::none => 'بدون',
        \App\Enums\Hr\HrHousePaymentType::monthly => 'شهري',
        \App\Enums\Hr\HrHousePaymentType::quarterYear => 'ربع سنوي',
        \App\Enums\Hr\HrHousePaymentType::halfYear => 'نصف سنوي',
        \App\Enums\Hr\HrHousePaymentType::fullYear => 'سنوي',
        \App\Enums\Hr\HrHousePaymentType::companyHouse => 'سكن بالشركة',
    ],

    \App\Enums\Hr\CompanyStatus::class => [
        \App\Enums\Hr\CompanyStatus::none => 'بدون',
        \App\Enums\Hr\CompanyStatus::still => 'قائمة',
        \App\Enums\Hr\CompanyStatus::stop => 'متوقفة',
        \App\Enums\Hr\CompanyStatus::underCreation => 'تحت الإنشاء',
    ],

    \App\Enums\Hr\BuildOwnerShip::class => [
        \App\Enums\Hr\BuildOwnerShip::none => 'بدون',
        \App\Enums\Hr\BuildOwnerShip::governmentOwn => 'أملاك دولة',
        \App\Enums\Hr\BuildOwnerShip::rentFromOther => 'تأجير من الغير',
        \App\Enums\Hr\BuildOwnerShip::CompanyOwn => 'ملك الشركة',
        \App\Enums\Hr\BuildOwnerShip::specialOwn => 'ملك خاص',
    ],

    \App\Enums\Hr\FeesPaymentWayTypes::class => [
        \App\Enums\Hr\FeesPaymentWayTypes::none => 'بدون',
        \App\Enums\Hr\FeesPaymentWayTypes::monthly => 'شهري',
        \App\Enums\Hr\FeesPaymentWayTypes::quarterYear => 'ربع سنوي',
        \App\Enums\Hr\FeesPaymentWayTypes::halfYear => 'نصف سنوي',
        \App\Enums\Hr\FeesPaymentWayTypes::fullYear => 'سنوي',
    ],

    \App\Enums\Hr\SalaryPaymentWay::class => [
        \App\Enums\Hr\SalaryPaymentWay::none => 'بدون',
        \App\Enums\Hr\SalaryPaymentWay::bank => 'بنك',
        \App\Enums\Hr\SalaryPaymentWay::cash => 'نقدي',
        \App\Enums\Hr\SalaryPaymentWay::check => 'شيك',
    ],

    \App\Enums\Hr\JobStatus::class => [
        \App\Enums\Hr\JobStatus::none => 'بدون',
        \App\Enums\Hr\JobStatus::stayWork => 'على رأس العمل',
        \App\Enums\Hr\JobStatus::inVacation => 'القيام بأجازة',
        \App\Enums\Hr\JobStatus::finishService => 'إنهاء الخدمة',
        \App\Enums\Hr\JobStatus::goneNoReturn => 'خرج ولم يعد',
        \App\Enums\Hr\JobStatus::escape => 'هروب',
        \App\Enums\Hr\JobStatus::other => 'أخرى',
    ],

    \App\Enums\Hr\BankPaymentWay::class => [
        \App\Enums\Hr\BankPaymentWay::none => 'بدون',
        \App\Enums\Hr\BankPaymentWay::bank => 'بنك',
        \App\Enums\Hr\BankPaymentWay::cash => 'نقدي',
        \App\Enums\Hr\BankPaymentWay::check => 'شيك',
    ],

    \App\Enums\Hr\LegalForPartnersAndDelegates::class => [
        \App\Enums\Hr\LegalForPartnersAndDelegates::none => 'بدون',
        \App\Enums\Hr\LegalForPartnersAndDelegates::partner => 'شريك',
        \App\Enums\Hr\LegalForPartnersAndDelegates::signedDelegate => 'مفوض بالتوقيع',
        \App\Enums\Hr\LegalForPartnersAndDelegates::agent => 'وكيل',
    ],

    \App\Enums\Hr\ActiveType::class => [
        \App\Enums\Hr\ActiveType::none => 'بدون',
        \App\Enums\Hr\ActiveType::trade => 'تجاري',
        \App\Enums\Hr\ActiveType::industrial => 'صناعي',
        \App\Enums\Hr\ActiveType::printAndPackaging => 'طباعة وتغليف',
        \App\Enums\Hr\ActiveType::building => 'عقارات',
        \App\Enums\Hr\ActiveType::generalRent => 'أجرة عامة',
        \App\Enums\Hr\ActiveType::carsRent => 'تأجير سيارات',
        \App\Enums\Hr\ActiveType::transporter => 'نقليات',
        \App\Enums\Hr\ActiveType::generalConstruction => 'مقاولات عامة',
        \App\Enums\Hr\ActiveType::maintenanceAndOperation => 'صيانة وتشغيل',
        \App\Enums\Hr\ActiveType::schools => 'مدارس',
        \App\Enums\Hr\ActiveType::hospitals => 'مستشفيات',
        \App\Enums\Hr\ActiveType::pharmacies => 'صيدليات',
        \App\Enums\Hr\ActiveType::other => 'أخرى',
    ],

    \App\Enums\Hr\LocationsType::class => [
        \App\Enums\Hr\LocationsType::none => 'بدون',
        \App\Enums\Hr\LocationsType::licencedLocation => 'موقع بترخيص',
        \App\Enums\Hr\LocationsType::spaceLand => 'أرض فضاء',
        \App\Enums\Hr\LocationsType::building => 'عقار',
        \App\Enums\Hr\LocationsType::byWriting => 'بصك',
        \App\Enums\Hr\LocationsType::withoutWriting => 'بدون صك',
        \App\Enums\Hr\LocationsType::townShipLicenced => 'مرخص من بلدية',
        \App\Enums\Hr\LocationsType::gallery => 'معرض',
        \App\Enums\Hr\LocationsType::hall => 'حوش',
        \App\Enums\Hr\LocationsType::other => 'أخرى',
    ],

    \App\Enums\Hr\IDType::class => [
        \App\Enums\Hr\IDType::none => 'بدون',
        \App\Enums\Hr\IDType::systemic => 'نظامية',
        \App\Enums\Hr\IDType::nonSystemic => 'غير نظامية',
        \App\Enums\Hr\IDType::nationalityId => 'هوية وطنية',
        \App\Enums\Hr\IDType::workVisiting => 'زيارة عمل',
    ],

    \App\Enums\Hr\PassportType::class => [
        \App\Enums\Hr\PassportType::none => 'بدون',
        \App\Enums\Hr\PassportType::normal => 'عادي',
        \App\Enums\Hr\PassportType::diplomatic=> 'دبلوماسي',
        \App\Enums\Hr\PassportType::document => 'وثيقة',
        \App\Enums\Hr\PassportType::other => 'أخرى',
    ],

    \App\Enums\Hr\EducationType::class => [
        \App\Enums\Hr\EducationType::none => 'بدون',
        \App\Enums\Hr\EducationType::noRead => 'أمي',
        \App\Enums\Hr\EducationType::writingReading => 'يقرأ ويكتب',
        \App\Enums\Hr\EducationType::primary => 'ابتدائي',
        \App\Enums\Hr\EducationType::mediate => 'متوسط',
        \App\Enums\Hr\EducationType::secondary => 'ثانوي',
        \App\Enums\Hr\EducationType::diploma => 'دبلوم',
        \App\Enums\Hr\EducationType::academic => 'جامعي',
        \App\Enums\Hr\EducationType::ma => 'ماجستير',
        \App\Enums\Hr\EducationType::doctorate => 'دكتوراه',
    ],

    \App\Enums\Hr\SpecialNeeds::class => [
        \App\Enums\Hr\SpecialNeeds::none => 'بدون',
        \App\Enums\Hr\SpecialNeeds::mentalityObstruction => 'إعاقة ذهنية',
        \App\Enums\Hr\SpecialNeeds::physicalObstruction => 'إعاقة عضوية',
    ],

    \App\Enums\Hr\CompanyClass::class => [
        \App\Enums\Hr\CompanyClass::none => 'بدون',
        \App\Enums\Hr\CompanyClass::shareHoldingCompany => 'شركة مساهمة',
        \App\Enums\Hr\CompanyClass::companyHaveMM => 'شركة ذات م م',
        \App\Enums\Hr\CompanyClass::simpleRecommendationCompany => 'ذات توصية بسيطة',
        \App\Enums\Hr\CompanyClass::industrialCraft => 'حرفة صناعية',
        \App\Enums\Hr\CompanyClass::individualFoundation => 'مؤسسة فردية',
        \App\Enums\Hr\CompanyClass::industrialFoundation => 'منشأة صناعية',
        \App\Enums\Hr\CompanyClass::specialParticipate => 'مساهمة مقفلة',
        \App\Enums\Hr\CompanyClass::generalParticipate => 'مساهمة عامة',
    ],

    \App\Enums\Hr\CompanyEmployeeClass::class => [
        \App\Enums\Hr\CompanyEmployeeClass::none => 'بدون',
        \App\Enums\Hr\CompanyEmployeeClass::permanentEmployee => 'موظف دائم',
        \App\Enums\Hr\CompanyEmployeeClass::temporaryEmployee => 'موظف مؤقت',
    ],

    \App\Enums\Hr\EmployeeClass::class => [
        \App\Enums\Hr\EmployeeClass::none => 'بدون',
        \App\Enums\Hr\EmployeeClass::ExcellentClass => 'فئة ممتازة',
        \App\Enums\Hr\EmployeeClass::ClassA => 'فئة أ',
        \App\Enums\Hr\EmployeeClass::ClassB => 'فئة ب',
        \App\Enums\Hr\EmployeeClass::ClassG => 'فئة ج',
        \App\Enums\Hr\EmployeeClass::ClassD => 'فئة د',
    ],

    \App\Enums\Hr\SocialStatus::class => [
        \App\Enums\Hr\SocialStatus::none => 'بدون',
        \App\Enums\Hr\SocialStatus::single => 'أعزب',
        \App\Enums\Hr\SocialStatus::married => 'متزوج',
        \App\Enums\Hr\SocialStatus::divorced => 'مطلق',
        \App\Enums\Hr\SocialStatus::widower => 'أرمل',
    ],

    \App\Enums\Hr\DriveLicenceType::class => [
        \App\Enums\Hr\DriveLicenceType::none => 'بدون',
        \App\Enums\Hr\DriveLicenceType::spacial => 'خصوصي',
        \App\Enums\Hr\DriveLicenceType::mediate => 'متوسط',
        \App\Enums\Hr\DriveLicenceType::generalGreat => 'عمومي كبير',
    ],


];
