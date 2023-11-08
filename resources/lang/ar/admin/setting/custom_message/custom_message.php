<?php

declare(strict_types=1);

return [
    'menu' =>[
        'custom_messages'=>'الرسائل المخصصة',
        'all'=>'جميع الرسائل المخصصة'
    ],
    
    'fields' => [
        'code'=>'الرمز',
        'subject'=>'العنوان',
        'type'=>'النوع',
        'language'=>'اللغة',
        'text'=>'النص',
        'is_active'=>'الحالة',
    ],

    'pages' => [
        'index' => 'روابط مختصرة',
        'create' => 'انشاء رسائل مخصصة',
        'edit' => ' تحرير رسائل مخصصة ',
    ],

    'buttons' => [
        'create' =>'اضافة',
        'edit' => 'تحديث',
        'delete' => 'حذف',
        'index'=>'جميع الرسائل المخصصة'
    ],

    'messages' => [
        'create' => 'تم إضافة الرسالة بنجاح',
        'edit' => 'تم تعديل الرسالة بنجاح',
        'delete' => 'تم حذف الرسالة بنجاح',
        'edit_active' =>'تم تعديل حالة الرسالة المخصصة بنجاح',
    ],

    'extra'=> [
        'arabic' =>'العربية',
        'english' => 'الانجليزية',
        'email' => 'ايميل',
        'code' =>'ادخل الرمز',
        'type' => 'اختر نوع الرسالة',
        'subject' =>'ادخل العنوان',
        'text' => 'اكتب النص هنا',
        'language' => 'اختر اللغة',
        'actions'=>'العمليات',
        'confirm_delete'=>'تأكيد الحذف',
        'confirm'=>'تأكيد',
        'Are you sure you want delete this item'=>'هل أنت متأكد من حذف هذا العنصر حذف نهائي؟',
        'close'=>'اغلاق',
        'yes'=>'نعم',

    ]
];