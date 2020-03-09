<?php

use App\Enums\CollectionFeesType;
use App\Enums\GenderType;
use App\Enums\WorkStatusType;
use App\Enums\EducationLevelType;
use App\Enums\SpecialNeedsType;
use App\Enums\EmployeesSonsType;
use App\Enums\MedicalConditionType;
use App\Enums\MedicalAttentionType;
use App\Enums\LaborSectorType;
use App\Enums\TypeType;
use App\Enums\RelationType;
use App\Enums\ReligionType;
use App\Enums\SocialType;
use App\Enums\WorkType;
use App\Enums\busType;
use App\Enums\LicenseType;
use App\Enums\HealthType;
use App\Enums\BloodType;
use App\Enums\EducateType;
use App\Enums\FeesType;
use App\Enums\StatusType;
use App\Enums\ExperianceType;
use App\Enums\PerstatusType;
use App\Enums\SupplierType;
use App\Enums\CurrencyType;
use App\Enums\ClassbusType;
use App\Enums\GearboxType;
use App\Enums\PersonalType;
use App\Enums\ParentsType;
use App\Enums\BusStatusType;
use App\Enums\ScheduleType;
use App\Enums\learntimeType;
use App\Enums\PayType;
use App\Enums\EduLevelType;
use App\Enums\BranchType;
use App\Enums\LevelType;
use App\Enums\FeesHeader;
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
use App\Enums\StudentActive;
use App\Enums\DiscountType;
use \App\Enums\MovementType;

return [

    WorkStatusType::class => [
        WorkStatusType::yes => 'نعم',
        WorkStatusType::no => 'لا',
    ],
    EducationLevelType::class => [
        EducationLevelType::High_school => 'الثانوية العامة',
        EducationLevelType::Diploma => 'دبلوم',
        EducationLevelType::Bachelor => 'بكالوريوس',
        EducationLevelType::Licentiate => 'ليسانس',
        EducationLevelType::Master => 'ماجستير',
        EducationLevelType::Doctorate => 'دكتوراه',
    ],
    EmployeesSonsType::class => [
        EmployeesSonsType::yes => 'نعم',
        EmployeesSonsType::no => 'لا',
    ],
    MedicalConditionType::class => [
        MedicalConditionType::good => 'جيدة',
        MedicalConditionType::bad => 'غير جيدة',
    ],
    MedicalAttentionType::class => [
        MedicalAttentionType::yes => 'نعم',
        MedicalAttentionType::no => 'لا',
    ],
    SpecialNeedsType::class => [
        SpecialNeedsType::yes => 'نعم',
        SpecialNeedsType::no => 'لا',
    ],
    LaborSectorType::class => [
        LaborSectorType::governmental => 'حكومي',
        LaborSectorType::private => 'خاص',
    ],
    GenderType::class => [
        GenderType::male => 'ذكر',
        GenderType::female => 'أنثي',
    ],
    BranchType::class => [
        BranchType::main => 'الاداره الرئيسيه',
        BranchType::primary => 'ابتدائى',
        BranchType::Preparatory => 'متوسط',
        BranchType::secondary => 'ثانوى',
        BranchType::secondary_night => 'ثانوى ليلى',
    ],

    MovementType::class => [
        MovementType::transferTo => 'منقول إلى',
        MovementType::Exclude => 'استبعاد',
    ],
    TypeType::class => [
        TypeType::noob => 'مستجد', //0
        TypeType::Movedfrom => 'منقول من', //1
        TypeType::Lift => 'مرفوع', //2
        TypeType::discontinued => 'منقطع', //3
        TypeType::Movedto => 'منقول الي', //4
        TypeType::Exclude => 'مستبعد', //4
        TypeType::comingyear => 'عام قادم', //5
        TypeType::failure => 'معيد', //6
        // TypeType::waiting => 'انتظار', //7
        // TypeType::regular => 'منتظم', //8
        // TypeType::irregular => 'غير منتظم', //9
    ],
    PerstatusType::class => [
        PerstatusType::regularity => 'منتظم',
        PerstatusType::irregular => 'غير منتظم',
        PerstatusType::coming => 'عام قادم',
        PerstatusType::waiting => 'انتظار',
    ],
    learntimeType::class => [
        learntimeType::fullyear => 'عام كامل',//0
        learntimeType::fullsemester => 'فصل دراسي كامل',//1
        learntimeType::Partofthefirstchapter => 'جزء من الفصل الأول',//2
        learntimeType::Partofthesecondchapter => 'جزء من الفصل الثاني',//3
    ],
    ParentsType::class => [
        ParentsType::have => 'يوجد لديه في القائمه',
        ParentsType::nothave => 'لا يوجد لديه في القائمه أضف جديد',
    ],
    PersonalType::class => [
        PersonalType::id => 'البطاقه الشخصيه',
        PersonalType::passport => 'جواز السفر',
        PersonalType::Residence => 'الاقامه',
    ],
    busType::class => [
        busType::notsubscriber => 'غير مشترك',
        busType::goandback => 'ذهاب وعوده',
        busType::back => 'عوده فقط',
        busType::go => 'ذهاب فقط',
    ],
    EduLevelType::class => [
        EduLevelType::primary => 'ابتدائي',
        EduLevelType::middle => 'متوسط',
        EduLevelType::secondary => 'ثانوي',
        EduLevelType::secondarynight => 'ثانوي ليلي',
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
        WorkType::Basic => 'أساسي',
        WorkType::Temporary => 'احتياطي',
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
        CurrencyType::EGP => 'جنيه مصري',
        CurrencyType::USD => 'دولار',
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
        PayType::complete => 'كامل',
        PayType::Premiums => 'أقساط',
    ],

//    data links

    ReceiptType::class => [
        ReceiptType::catchReceipt => 'سند قبض نقدي',
        ReceiptType::catchReceiptCheck => 'سند قبض شيك',
        ReceiptType::receipt => 'سند صرف نقدي',
        ReceiptType::ReceiptCheck => 'سند صرف شيك',
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
        BalanceReviewType::generalReview => 'ميزان المراجعه العام',
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
        IncomeListType::budget => 'ميزانية',
        IncomeListType::tradeAccount => 'حساب المتاجرة',
        IncomeListType::profitAccount => 'حساب أرباح وخسائر',
        IncomeListType::operatingAccount => 'حساب تشغيل',
    ],
    StatusTreeType::class => [
        StatusTreeType::active => 'نشط',
        StatusTreeType::deactive => 'متوقف',
    ],
    FeesType::class => [
        FeesType::studyfees => 'رسوم دراسيه', //0
        FeesType::busfees => 'رسوم  باص', //1
        FeesType::prvyear => 'رسوم عام سابق',//2
        FeesType::bookfees => 'رسوم الكتب', //3
        FeesType::costumefee => 'رسوم الزي', //4
        FeesType::activitiesfees => 'رسوم الأنشطه', //5
    ],
    DiscountType::class => [
        DiscountType::brothers => 'خصم اخوه', //1
        DiscountType::prvyeardis => 'خصم عام سابق',//2
        DiscountType::pecial => 'خصم خاص',//3
        DiscountType::emp_sons => 'خصم ابناء عاملين',//4
        DiscountType::busdis => 'خصم باص',//5
        DiscountType::bookdis => 'خصم كتب',//6
        DiscountType::uniformdis => 'خصم زى',//7
        DiscountType::activitydis => 'خصم انشطه',//8
    ],
    FeesHeader::class => [
        FeesHeader::value => 'القيمه', //0
        FeesHeader::discount => 'الخصم',//1
        FeesHeader::discount1 => 'خصم اخر',//2
        FeesHeader::net => 'المستحق',//3
        FeesHeader::back => 'المردود',//4
        FeesHeader::pay => 'المسدد',//5
        FeesHeader::blnc => 'الرصيد',//6
    ],
    LimitationsType::class => [
        LimitationsType::dailyLimitations => 'قيود يوميه',
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
        DepartmentReportType::CcDepartement => 'حسابات مراكز التكلفه',
    ],

    StudentActive::class => [
        StudentActive::active => 'فعال',
        StudentActive::inactive => 'غير فعال',
    ],


    CollectionFeesType::class => [
        CollectionFeesType::ListOutstandingTuitionFees => 'قائمة الرسوم الدراسية المستحقة',
        CollectionFeesType::FullyPaidList => 'قائمة الرسوم المسددة بالكامل',
        CollectionFeesType::FullUnpaidList => 'قائمة الرسوم الغير مسدده بالكامل',
        CollectionFeesType::DetailedTuitionFeesStudents => 'تفصيلى الرسوم الدراسية للطلاب',
        CollectionFeesType::ListExcludedStudents => 'قائمة أسماء الطلاب المستبعدين',
        CollectionFeesType::ListRegisteredStudentsNewYear => 'قائمة أسماء الطلاب المسجلين لعام جديد',
        CollectionFeesType::DetectNamesStudentsHaveBrother => 'كشف بأسماء طلاب لديهم أخوه',
    ],


    /**
     * Enum translation for HR system
     */
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
