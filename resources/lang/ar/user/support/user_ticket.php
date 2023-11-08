<?php

declare(strict_types=1);

return [
    
    'fields' => [
        'subject'=>'العنوان',
        'message'=>'النص',
        'ticket_category_id'=>'النوع',
        'name'=>'اسم المستخدم',
        'status'=>'الحالة'
    ],

    'pages' => [
        'index' => 'قائمة التذاكر',
        'create' => 'انشاء تذكرة',
        'show'=>'الرسائل الخاصة بالتذكرة'
    ],

    'buttons' => [
        'create'=>'اضافة',
        'send'=>'ارسال'
    ],

    
    'messages' => [
        'create'=>'تمت اضافة التذكرة بنجاح',
    ],

    'extra'=> [
        'actions'=>'العمليات',
        'header'=>'انشاء رسالة',
        'message'=>'اكتب النص هنا',
        'write_message'=>'اكتب رسالتك هنا',
        'ticket_category_id'=>'اختر نوع الرسالة',
        'subject'=>'العنوان',
        'open'=>'مفتوحة',
        'close'=>'مغلقة',
        'notfound'=>'لا يوجد',
        'see_message'=>'مشاهدة الرسالة',
    ]
];