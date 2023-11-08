<?php

declare(strict_types=1);

return [
    'menu' => 'ادارة الصفحات',
    
    'fields' => [
        'title'=>'العنوان',
        'content'=>'المحتوى',
        'is_in_footer'=>'في ال footer',
        'is_in_menu'=>'في القائمة' ,
        'is_active'=>'الحالة'
    ],

    'pages' => [
        'index' => ' الصفحات',
        'create' => 'إضافة صفحة',
        'edit' => 'تعديل صفحة',
    ],

    'buttons' => [
        'create' =>'اضافة',
        'edit' => 'تحديث',
        'delete' => 'حذف',
    ],

    'messages' => [
        'create' => 'تم إضافة الصفحة بنجاح',
        'edit' => 'تم تعديل الصفحة بنجاح',
        'failed_edit'=>'فشل غي تعديل الصفحة',
        'delete' => 'تم حذف الصفحة بنجاح',
        'failed_delete'=>'فشل في حذف الصفحة'
    ],

    'extra'=> [
        'open'=>'مفتوحة',
        'actions'=>'العمليات',
        'confirm_delete'=>'تأكيد الحذف',
        'confirm'=>'تأكيد',
        'Are you sure you want delete this item'=>'هل أنت متأكد من حذف هذا العنصر حذف نهائي؟',
        'close'=>'اغلاق',
        'yes'=>'نعم',

    ]
];