<?php

declare(strict_types=1);

return [
    'menu' => 'الدعم الفني',
    
    'fields' => [
        'subject'=>'العنوان',
        'message'=>'النص',
        'ticket_category_id'=>'النوع',
        'name'=>'اسم المستخدم',
        'status'=>'الحالة'
    ],

    'pages' => [
        'index' => 'قائمة التذاكر',
        'show'=>'قائمة الرسائل المخصصة'
    ],

    'buttons' => [

        'send'=>'ارسال',

    ],

    'extra'=> [
        'actions'=>'العمليات',
        'header'=>'الرسائل الخاصة بالتذكرة',
        'message'=>'اكتب رسالتك هنا',
        'open'=>'مفتوحة',
        'close'=>'مغلقة',
        'notfound'=>'لا يوجد',
        'see_message'=>'مشاهدة الرسالة',
        'no_tickets'=>'لا توجد رسائل بعد'

    ]
];