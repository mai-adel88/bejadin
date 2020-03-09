<?php
use App\Enums\GenderType;
use App\Enums\SpecialNeeds;
use App\Enums\SalaryType;
use App\Enums\TypeType;
use App\Enums\RelationType;
use App\Enums\ReligionType;
use App\Enums\SocialType;
use App\Enums\WorkStatusType;
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
use App\Enums\GearboxType;
use App\Enums\BusStatusType;
use App\Enums\ScheduleType;
use App\Enums\PayType;
use App\Enums\BranchType;
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

return [

    GenderType::class => [
        GenderType::male => 'male',
        GenderType::female => 'female',
    ],
    SpecialNeeds::class => [
        SpecialNeeds::normal => 'Normal', //0
        SpecialNeeds::special_need => 'Special Needs',//1
    ],
    BranchType::class => [
        BranchType::manage => 'Management', //0
        BranchType::main_store => 'Main Store', //1
        BranchType::branch => 'Branch Store', //2
        BranchType::sales_point => 'Sale Point', //3
    ],
    LevelType::class => [
        LevelType::accounts => 'Accounts',
        LevelType::cost_centers => 'Cost Centers',
        LevelType::final_account => 'Final Account',
        LevelType::center_analysis => 'Center Analysis',
    ],
    TypeType::class => [
        TypeType::student => 'student',
        TypeType::single => 'single',
        TypeType::company => 'company',
        TypeType::domestic_flights => 'domestic flights',
    ],
    RelationType::class => [
        RelationType::father => 'father',
        RelationType::mother => 'mother',
        RelationType::brother => 'brother',
        RelationType::sister => 'sister',
        RelationType::grandfather => 'grandfather',
        RelationType::grandmother => 'grandmother',
        RelationType::Stepfather => 'Stepfather',
        RelationType::HusbandAunt => 'HusbandAunt',
        RelationType::uncle => 'uncle',
        RelationType::aunt => 'aunt',
        RelationType::uncle_M => "uncle from mother",
        RelationType::aunt_M => 'aunt from mother',
        RelationType::brother_in_law => 'brother in law',
        RelationType::cousin => 'cousin',
        RelationType::husband => 'husband',
    ],
    ReligionType::class => [
        ReligionType::Muslim => 'Muslim',
        ReligionType::Christian => 'Christian',
        ReligionType::Jewish => 'Jewish',
        ReligionType::Others => 'Others',
    ],
    SocialType::class => [
        SocialType::Single => 'Single',
        SocialType::Married => 'Married',
        SocialType::Divorcee => 'Divorcee',
        SocialType::Widowed => 'Widowed',
    ],
    HealthType::class => [
        HealthType::Normal => 'Normal',
        HealthType::SpecialNeeds => 'Special Needs',
    ],
    WorkType::class => [
        WorkType::Administrative => 'Administrative',
        WorkType::sales => 'sales',
        WorkType::Worker => 'Worker',
        WorkType::night_worker => 'night worker',
    ],
    WorkStatusType::class => [
        WorkStatusType::vacation => 'vacation',
        WorkStatusType::termination_of_service => 'termination of service',
        WorkStatusType::On_the_job => 'On the job',
    ],
    LicenseType::class => [
        LicenseType::SpecialLicense => 'Special License',
        LicenseType::FirstClassLicense => 'First Class License',
        LicenseType::SecondClassLicense => 'Second Class License',
        LicenseType::ThirdClassLicense => 'Third Class License',
    ],
    BloodType::class => [
        BloodType::O => 'O+',
        BloodType::Om => 'O-',
        BloodType::A => 'A+',
        BloodType::Am => 'A-',
        BloodType::B => 'B+',
        BloodType::Bm => 'B-',
        BloodType::AB => 'AB+',
        BloodType::ABm => 'AB-',
    ],
    EducateType::class => [
        EducateType::preparatory => 'preparatory',
        EducateType::secondary => 'secondary',
        EducateType::QualifiedAverage => 'Qualified Average',
        EducateType::HighQualified => 'High Qualified',
    ],
    StatusType::class => [
        StatusType::Stopped => 'Stopped',
        StatusType::Serves => 'Serves',
        StatusType::InVacation => 'In Vacation',
        StatusType::Sick => 'Sick',
        StatusType::Damage => 'Damage',
        StatusType::Escape => 'Escape',
        StatusType::WithoutCar => 'Without Car',
    ],
    ExperianceType::class => [
        ExperianceType::LessThanYear => 'Less Than Year',
        ExperianceType::OneYear => 'One Year',
        ExperianceType::TwoYears => 'Two Years',
        ExperianceType::ThreeYears => 'Three Years',
        ExperianceType::FourYears => 'Four Years',
        ExperianceType::FiveYears => 'Five Years',
        ExperianceType::MoreThanFive => 'More Than Five Years',
    ],
    SupplierType::class => [
        SupplierType::GeneralSupplier => 'General Supplier',
        SupplierType::SupplierOfSpareParts => 'Supplier Of Spare Parts',
    ],
    CurrencyType::class => [
        CurrencyType::SAR => 'SAR',
        CurrencyType::USD => 'USD',
        CurrencyType::EUR => 'EUR',
    ],
    SalaryType::class => [
        SalaryType::monthly => 'monthly',
        SalaryType::daily => 'daily',
    ],
    ClassbusType::class => [
        ClassbusType::bus => 'bus',
        ClassbusType::minibus => 'minibus',
        ClassbusType::microbus => 'microbus'
    ],
    GearboxType::class => [
        GearboxType::automatic => 'automatic',
        GearboxType::manual => 'manual',
    ],
    ScheduleType::class => [
        ScheduleType::go => 'go',
        ScheduleType::rturn => 'return',
    ],
    BusStatusType::class => [
        BusStatusType::working => 'working',
        BusStatusType::noexist => 'no exist',
        BusStatusType::maintance => 'under maintance',
        BusStatusType::accident => 'accident',
        BusStatusType::stopedaccident => 'stoped accident',
        BusStatusType::stopedselling => 'stoped selling',
        BusStatusType::bookingtraffic => 'booking traffic',
        BusStatusType::withoutdriver => 'without driver',
        BusStatusType::stoped => 'stoped',
        BusStatusType::weekend => 'weekend',
    ],
    PayType::class => [
        PayType::cache => 'cache',//1
        PayType::check => 'check',//2
        PayType::cache => 'visa',//3
        PayType::bank => 'bank transform',//4
    ],


//    data links
    ReceiptType::class => [
        ReceiptType::open => 'Open Reciept',
        ReceiptType::cache_in => 'Cash receipt voucher',
        ReceiptType::cheq_in => 'Check receipt voucher',
        ReceiptType::cache_out => 'Cash exchange voucher',
        ReceiptType::cheq_out => 'Check voucher',
        ReceiptType::daily => 'Daily voucher',
        ReceiptType::future_sale => 'Term sales',
        ReceiptType::cache_sale => 'Cache sales',
        ReceiptType::future_purchase => 'Term purchase',
        ReceiptType::cache_purchase => 'Cache purchase',
        ReceiptType::trnsform_in => 'Enter delivery',
        ReceiptType::transform_out => 'Give up delivery',
        ReceiptType::add_equation => 'Settlement by addition',
        ReceiptType::sub_equation => 'Discount settlement',
        ReceiptType::debt_notify => 'Debit notify',
        ReceiptType::credit_notify => 'Credit notify',
    ],
    OperationType::class => [
        OperationType::suppliers => 'Suppliers',
        OperationType::customers => 'Customers',
        OperationType::projects => 'Projects',
        OperationType::accounts => 'Accounts',
        OperationType::employees => 'Employees',
        OperationType::cashiers => 'Cashiers',
        OperationType::banks => 'Banks',
        OperationType::minus_document => 'Minus Document',
        OperationType::plus_document => 'Plus Document',
    ],
    FinaAccountType::class => [
        FinaAccountType::budget_elements => 'Budget Elements',
        FinaAccountType::incoming_list => 'Incoming List',
        FinaAccountType::money_flow_up => 'Money Flow Up',
    ],
    DiscounRevenueType::class => [
        DiscounRevenueType::revenue => 'Revenue Account',
        DiscounRevenueType::Discount => 'Discount Account',
    ],
    BondRestrictionsType::class => [
        BondRestrictionsType::inCash => 'Gl In Cash',
        BondRestrictionsType::inCheck => 'Gl In Check',
        BondRestrictionsType::outCash => 'Gl Out Cash',
        BondRestrictionsType::outCheck => 'Gl Out Check',
//        BondRestrictionsType::adjustment => 'Gl Adjustment',
//        BondRestrictionsType::inExchange => 'Gl In Exchange',
//        BondRestrictionsType::outExchange => 'Gl Out Exchange',
//        BondRestrictionsType::notificationMinus => 'Gl Notification Minus',
//        BondRestrictionsType::notificationPluse => 'Gl Notification Pluse',
//        BondRestrictionsType::discountInVoucher => 'Discount In Voucher',
//        BondRestrictionsType::discountOutVoucher => 'Discount Out Voucher',
//        BondRestrictionsType::purchasesReturn => 'Purchases Return',
//        BondRestrictionsType::salesReturn => 'Sales Return',
//        BondRestrictionsType::store => 'Store',
        BondRestrictionsType::daily => 'Daily',
        BondRestrictionsType::NoticeDebt => 'Notice Debt',
        BondRestrictionsType::NoticeCreditor => 'Notice Creditor',
        BondRestrictionsType::sales => 'Sales',
        BondRestrictionsType::purchases => 'Purchases',
        BondRestrictionsType::RevenuePayable => 'Revenue Payable',
        BondRestrictionsType::ExchangeOfMaterials => 'Exchange Of Materials',
        BondRestrictionsType::start => 'Gl Start',
    ],
    CcType::class => [
        CcType::withoutCc => 'Without Cc',
        CcType::withCc => 'With Cc',
        CcType::multi => 'multi Cc',
    ],
    StatusAccountType::class => [
        StatusAccountType::suspend => 'Suspend',
        StatusAccountType::open => 'Open',
        StatusAccountType::post => 'Post',
        StatusAccountType::confirmed => 'Confirmed',
    ],
    CategoryAccountType::class => [
        CategoryAccountType::dept => 'debt',
        CategoryAccountType::crpt => 'crpt',
    ],
    TypeAccountType::class => [
        TypeAccountType::main => 'Main',
        TypeAccountType::sub => 'Sub',
    ],
    InvoiceSaleType::class => [
        InvoiceSaleType::purchaseInvoice => 'Purchase Invoice',
        InvoiceSaleType::saleInvoice => 'Sale Invoice',
        InvoiceSaleType::other => 'Other',
    ],
    BankAppearType::class => [
        BankAppearType::bankClipboard => 'Bank appears within the scope of the clipboard',
        BankAppearType::bannkRestriction => 'Bank appears within the scope of the restrictions',
    ],
    AccountTypeType::class => [
        AccountTypeType::allAccounts => 'All Accounts',
        AccountTypeType::onlyTrans => 'Only Transaction',
        AccountTypeType::noTrans => 'No Transaction',
        AccountTypeType::deptAccounts => 'Dept Accounts',
        AccountTypeType::crtAccounts => 'Crt Accounts',
    ],
    BalanceReviewType::class => [
        BalanceReviewType::reviewBalance => 'Review Balance',
        BalanceReviewType::levelReview => 'Level Review Balance',
    ],
    ExpenseIncomeType::class => [
        ExpenseIncomeType::expense => 'Expense',
        ExpenseIncomeType::income => 'Income',
    ],
    LimitTimeType::class => [
        LimitTimeType::firstDate => 'First Date',
        LimitTimeType::inTime => 'In Come',
    ],
    IncomeListType::class => [
        IncomeListType::budget => 'Budget',
        IncomeListType::tradeAccount => 'income list',
        IncomeListType::operatingAccount => 'Operating Account',
    ],
    StatusTreeType::class => [
        StatusTreeType::active => 'active',
        StatusTreeType::deactive => 'deactive',
    ],
    LimitationsType::class => [
        LimitationsType::dailyLimitations => 'Daily Limitations',
        LimitationsType::NoticeDebt => 'Notice Debt',
        LimitationsType::NoticeCreditor => 'Notice Creditor',
        LimitationsType::SalesInvoice => 'Sales Invoice',
        LimitationsType::PurchaseInvoice => 'Purchase Invoice',
        LimitationsType::RevenuePayable => 'Revenue Payable',
        LimitationsType::ExchangeOfMaterials => 'Exchange Of Materials',
    ],
    MonthType::class => [
        MonthType::January => 'January',
        MonthType::February => 'February',
        MonthType::March => 'March',
        MonthType::April => 'April',
        MonthType::May => 'May',
        MonthType::June => 'June',
        MonthType::July => 'July',
        MonthType::August => 'August',
        MonthType::September => 'September',
        MonthType::October => 'October',
        MonthType::November => 'November',
        MonthType::December => 'December',
    ],
    DepartmentReportType::class => [
        DepartmentReportType::levelNumber => 'level Number',
        DepartmentReportType::trustAccounts => 'trust Accounts',
        DepartmentReportType::DeptDepartement => 'Deptor Departement',
        DepartmentReportType::CrdDepartement => 'Creditor Departement',
        DepartmentReportType::PersonalDepartement => 'Personal Departement',
        DepartmentReportType::BranchDepartement => 'Branch Departement',
    ],
    DocType::class => [
        DocType::Rcpt_Flg => 'Bill document',
        DocType::Pymt_Flg => 'Spent document',
        DocType::Jv_Flg => 'Daily document',
        DocType::Sal_Flg => 'Sales',
        DocType::Pur_Flg => 'Purchases',
        DocType::Inv_Flg => 'Stores',
    ],
    PostEnum::class => [
        PostEnum::DlyPst_CshSal => 'Posting cash sales on the fund',
        PostEnum::DlyPst_CshPur => 'Posting cash purchases to the fund',
    ],
    AccountPostingType::class => [
        AccountPostingType::JVPst_SalCash => 'Post cashe sales to fund automatically', //2
        AccountPostingType::JVPst_PurCash => 'Post cashe purchases to fund automatically', //3
        AccountPostingType::JVPst_NetSalCrdt => 'Post net credit sales to accounting', //4
        AccountPostingType::JVPst_NetPurCrdt => 'Post net credit purchases to accounting', //5
        AccountPostingType::JVPst_TrnsferVch => 'Post transfer bonds to accounting', //6
        AccountPostingType::JVPst_AdjustVch => 'Post settlement bonds to accounting', //7
        AccountPostingType::JVPst_InvCost => 'Post inventories at cost to accounting', //8
        AccountPostingType::JVPst_InvSal => 'Post inventories at sale to accounting', //9
    ],
    FormsType::class => [
        FormsType::Spcrpt_Rcpt => 'Reciept form',//2
        FormsType::Spcrpt_Pymt => 'Payment form',//3
        FormsType::Spcrpt_Sal => 'Sales invoice form',//4
        FormsType::Spcrpt_Pur => 'Purchases invoice form',//5
        FormsType::Spcrpt_Trnf => 'Transform form',//6
        FormsType::Spcrpt_Adjust => 'Adjustment form',//7
        FormsType::Spcrpt_SRV => 'Goods entring form',//8
        FormsType::Spcrpt_DNV => 'Goods delivering form',//9
    ],
    PrintersType::class => [
        PrintersType::PrintOrder_DNV => 'Print delivery form with sales invoice',//2
        PrintersType::PrintOrder_SRV => 'Print reciept form with sales invoice',//3
        PrintersType::SelctNorm_Prntr1 => 'Select reports printer 1',//4
        PrintersType::SelctNorm_Prntr2 => 'Select reports printer 2',//5
        PrintersType::SelctNorm_Prntr3 => 'Select reports printer 3',//6
        PrintersType::SelctBarCod_Prntr1 => 'Select barcode printer 1',//7
        PrintersType::SelctBarCod_Prntr2 => 'Select barcode printer 2',//8
        PrintersType::SelctBarCod_Prntr3 => 'Select barcode printer 3',//9
        PrintersType::SelctPosSlip_Prntr1 => 'Select sales point printer 1',//10
        PrintersType::SelctPosSlip_Prntr2 => 'Select sales point printer 2',//11
        PrintersType::SelctPosSlip_Prntr3 => 'Select sales point printer 3',//12
    ],
    AllowedType::class => [
        AllowedType::AllwItm_RepatVch => 'Allow item repeating in same form',//2
        AllowedType::AllwItmLoc_ZroBlnc => 'Allow show sites for zero balance items',//3
        AllowedType::AllwItmQty_CostCalc => 'Allow cost calculations based on quantity',//4
        AllowedType::AllwDisc1Pur_Dis1Sal => 'Allow sale discount 1 = purchase discount 1',//5
        AllowedType::AllwDisc2Pur_Dis2Sal => 'Allow sale discount 2 = purchase discount 2',//6
        AllowedType::AllwStock_Minus => 'Allow minus goods delivery',//7
        AllowedType::AllwPur_Disc1 => 'Allow purchase dicount 1',//8
        AllowedType::AllwPur_Disc2 => 'Allow purchase dicount 2',//9
        AllowedType::AllwPur_Bouns => 'Allow purchase bonus',//10
        AllowedType::AllwSal_Disc1 => 'Allow sale dicount 1',//11
        AllowedType::AllwSal_Disc2 => 'Allow sale dicount 2',//12
        AllowedType::AllwSal_Bouns => 'Allow sale bonus',//13
        AllowedType::AllwTrnf_Cost => 'Allow issuing transfer forms at cost',//14
        AllowedType::AllwTrnf_Disc1 => 'Allow discount 1 in transfer forms among branches',//15
        AllowedType::AllwTrnf_Bouns => 'Allow bonus in transfer forms among branches',//16
        AllowedType::AllwBatch_No => 'Allow batch for medicine',//17
        AllowedType::AllwExpt_Dt => 'Allow expire date',//18
        AllowedType::ActvDnv_No => 'Activate goods delivery form',//19
        AllowedType::ActvSRV_No => 'Activate goods entring form',//20
        AllowedType::ActvTrnf_No => 'Activate goods transfer form',//21
        AllowedType::TabOrder_Pur => 'Special ordering for purchases screen',//22
        AllowedType::TabOrder_SaL => 'Special ordering for sales screen',//23
    ],
    OptionsType::class => [
        OptionsType::Itm_SrchRef => 'Search items bu Ref.',//2
        OptionsType::Date_Status => 'Transaction in Hijry Date',//3
        OptionsType::JvAuto_Mnth => 'Monthly serial for daily reports',//4
        OptionsType::Cshr_Status => 'Fund and Bank Account',//5
        OptionsType::PhyTy_CostPrice => 'Periodic inventory - cost',//6
        OptionsType::PhyTy_SalePrice => 'Posting Convenant at sale price',//7
        OptionsType::Fraction_Cost => 'Fraction Cost - 4 Digits',//8
        OptionsType::Fraction_Curncy => 'Fraction Currency',//9
    ],
    LangType::class => [
        LangType::arabic => 'Arabic',
        LangType::english => 'English',
    ],
    AccountType::class => [
        AccountType::accounts => 'Accounts',//1
        AccountType::clients => 'Clients',//2
        AccountType::suppliers => 'Suppliers',//3
        AccountType::employees => 'Employees',//4
        // AccountType::fixed_assets => 'Fixed assets',//5
        // AccountType::approvals => 'Approvals',//6
        // AccountType::projects => 'Projects',//7
    ],
    TransactionType::class => [
        TransactionType::open_entry => 'Open entry',//1
        TransactionType::cash_reciept => 'Cash receipt',//2
        TransactionType::cheque_reciept => 'Chequw receipt',//3
        TransactionType::cash_payment => 'Cash payment',//4
        TransactionType::cheque_payment => 'CHeque payment',//5
        TransactionType::daily_entry => 'Daily entry',//6
        TransactionType::future_sales => 'Future sales',//7
        TransactionType::cash_sales => 'Cash sales',//8
        TransactionType::future_purchases => 'Future purchases',//9
        TransactionType::cash_purchases => 'Cash purchases',//10
        TransactionType::income_transform => 'Income transform',//11
        TransactionType::outcome_transform => 'Outcome transform',//12
        TransactionType::addition_adiustment => 'Addition adjustment',//13
        TransactionType::discount_adujstment => 'Discount adjustment',//14
        TransactionType::debt_notify => 'Debt Not.',//15
        TransactionType::credit_notify => 'Credit Not.',//16
    ],

    PrjStatus::class => [
        PrjStatus::enquiry    => 'Enquiry',    //0
        PrjStatus::quted      => 'Quted',     //1
        PrjStatus::refused    => 'Refused',   //2
        PrjStatus::ordered    => 'Ordered',   //3
        PrjStatus::under_work => 'Under Work',//4
        PrjStatus::completed  => 'Completed',//5
        PrjStatus::warnty     => 'Warnty',  //6
    ],
];
