<?php

declare(strict_types=1);

return [
    'menu' =>[
        'support'=>'أنواع تذاكر الدعم الفني',
        'ticket_category'=>'قائمة تصنيفات التذاكر'
    ],

    'fields' => [
        'name'=>'اسم النوع',
    ],

    'pages' => [
        'index' => 'قائمة تصنيفات التذاكر',
        'create' => 'انشاء نوع تذكرة',
        'edit' => 'تعديل نوع التذكرة',
    ],

    'buttons' => [
        'create' =>'اضافة',
        'edit' => 'تحديث',
        'delete' => 'حذف',
        'all_tickets'=>'جميع تصنيفات التذاكر'
    ],

    'messages' => [
        'create' => 'تم إضافة النوع بنجاح',
        'edit' => 'تم تعديل النوع بنجاح',
        'delete' => 'تم حذف النوع بنجاح',
        'failed_edit' =>'لم تم تعديل النوع بنجاح',
        'failed_delete' => 'لم تم حذف النوع بنجاح',
    ],

    'extra'=> [
        'name'=>'ادخل اسم النوع هنا',
        'actions'=>'العمليات',
        'confirm_delete'=>'تأكيد الحذف',
        'confirm'=>'تأكيد',
        'Are you sure you want delete this item'=>'هل أنت متأكد من حذف هذا العنصر حذف نهائي؟',
        'close'=>'اغلاق',
        'yes'=>'نعم',

    ]
];