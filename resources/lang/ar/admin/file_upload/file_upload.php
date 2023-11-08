<?php

declare(strict_types=1);

return [
    'menu' => 'ملفات الرفع',
    
    'fields' => [
        'name'=>'الاسم',
    ],

    'pages' => [
        'index' => 'الملفات',
        'create' => 'إضافة ملفات',
        'edit' => 'تعديل ملفات',
    ],

    'buttons' => [
        'create' =>'اضافة ملفات',
        'delete' => 'حذف',
        'upload' => 'بدء الرفع',
        'stop' => 'ايقاف الرفع',
        'start'=>'بدء',
        'cancel'=>'ايقاف'
    ],

    /* 'messages' => [
        'create' => 'تم إضافة القسم بنجاح',
        'edit' => 'تم تعديل القسم بنجاح',
        'delete' => 'تم حذف القسم بنجاح',
    ], */

    'extra'=> [
        'actions'=>'العمليات',
        'confirm_delete'=>'تأكيد الحذف',
        'confirm'=>'تأكيد',
        'Are you sure you want delete this item'=>'هل أنت متأكد من حذف هذا العنصر حذف نهائي؟',
        'close'=>'اغلاق',
        'yes'=>'نعم',
        'This type of file is not allowed'=>'غير مسموح بادخال هذا النوع من الملفات',

    ]
];