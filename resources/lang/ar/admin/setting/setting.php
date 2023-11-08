<?php

declare(strict_types=1);

return [
    'menu' => 'الاعدادات',
    
    'fields' => [
        'app_name'=>'اسم الموقع',
        'site_description'=>'وصف الموقع',
        'site_logo'=>'شعار الموقع',
        'site_status'=>'حالة الموقع',

        'facebook_enable' =>'الفيسبوك',
        'services_facebook_client_id' => 'المعرف',
        'services_facebook_client_secret' => 'كلمة الأمان',

        'google_enable' =>'جوجل',
        'services_google_client_id' => 'المعرف',
        'services_google_client_secret' => 'كلمة الأمان',

        'mail_default' =>'بريد الارسال',
        'mail_mailers_smtp_host' => 'مضيف البريد',
        'mail_mailers_smtp_port' => 'منفذ البريد',
        'mail_mailers_smtp_username' =>'اسم مستخدم البريد',
        'mail_mailers_smtp_password' => 'كلمة سر البريد',
        'mail_from_address' => 'عنوان المرسل',
        'mail_from_name' =>'اسم المرسل',

        'captcha_enable' =>'تعطيل / تمكين الميزة',
        'recaptcha_api_site_key' =>'المعرف',
        'recaptcha_api_secret_key' => 'كلمة الأمان',

        'telegram_report_enable' =>'تيليجرام',
        'telegram_chat_id' => 'معرف الشات',
        'logging_channels_telegram_token' => 'سلسلة الرموز',
        'slack_report_enable' =>'سلاك',
        'logging_channels_slack_url' => 'الرابط',

        'faq_enable' =>'الأسئلة الشائعة',
        'article_enable' => 'المقالات',
        'page_enable' => 'المدونات',
        'short_link_enable' =>'الروابط المختصرة',
        'register_enable' => 'تمكين/تعطيل التسجيل',
        'email_confirm_enable' => 'تمكين/تعطيل التحقق من الإيميل لفتح حساب',
        'comment_enable' =>'تمكين/تعطيل التعليقات',
        'header_script' => 'أكواد الرأس',
        'footer_script' => 'أكواد الذيل',
    ],

    'pages' => [
        'index' => 'اعدادات الموقع',
    ],

    'buttons' => [
        'confirm_reset' =>'تهيئة قاعدة البيانات',
        'confirm_clear_session_cookie' => 'حذف الجلسات و ملفات تعريف الارتباط',
        'clear_cache' => 'حذف التخزين المؤقت',
        'load' =>'تحميل الاعدادات',
        'prepare_production' => 'تجهيز الموقع للاطلاق',
        'submit' =>'حفظ',

        'edit' => 'تحديث',
        'delete' => 'حذف',
    ],

    'messages' => [
        'create' => 'تم إضافة السؤال بنجاح',
        'edit' => 'تم تعديل السؤال بنجاح',
        'delete' => 'تم حذف السؤال بنجاح',
    ],

    'extra'=> [
        'general_settings'=>'اعدادت عامة',
        'enter_name'=>'ادخل اسم الموقع',
        'enter_text'=>'ادخل النص هنا',
        'open'=>'مفتوح',
        'close'=>'مغلق',
        'reason_locked'=>'سبب قفل الموقع',
        'enter_reason_locked'=>'اذكر سبب قفل الموقع',

        'login_applications'=>'تطبيقات تسجيل الدخول',
        'enter_services_facebook_client_id' =>'ادخل معرف الفيسبوك',
        'enter_services_facebook_client_secret' => 'ادخل كلمة امان الفيسبوك',
        'enter_services_google_client_id' =>'ادخل معرف جوجل',
        'enter_services_google_client_secret' => 'ادخل كلمة امان جوجل',

        'smtp'=>'SMTP',
        'mail_mailers_smtp_host' => 'أدخل مضيف البريد',
        'mail_mailers_smtp_port' => 'أدخل منفذ البريد',
        'mail_mailers_smtp_username' =>'أدخل اسم مستخدم البريد',
        'mail_mailers_smtp_password' => 'أدخل كلمة سر البريد',
        'mail_from_address' => 'أدخل عنوان المرسل',
        'mail_from_name' =>'أدخل اسم المرسل',
        'confirm_test_email' => 'إرسال ايميل تجريبي',

        'captcha'=>'حروف التحقق',
        'recaptcha_api_site_key' =>'أدخل معرف حروف التحقق',
        'recaptcha_api_secret_key' => 'أدخل كلمة أمان حروف التحقق',

        'report'=>'التبليغ عن الأخطاء',
        'telegram_chat_id' => 'أدخل معرف الشات لتليجرام',
        'logging_channels_telegram_token' => 'ادخل التوكن',
        'logging_channels_slack_url' => 'ادخل رابط التقرير الى سلاك',
        'confirm-test-report-channel' =>'ارسال تبليغ تجريبي',
        'web_status' => 'حالة الموقع',
        
        'additional_settings'=>'اعدادات اضافية',
        'add_cancel_features' =>'إضافة أو إلغاء بعض الميزات في الموقع',
        'add_codes' => 'إضافة أكواد للرأس والذيل',
        'footer_script' => 'اكتب اكواد الذيل هنا',
        'header_script' =>'اكتب اكواد الرأس هنا',

        'cleanup'=>'التنظيف',


        'confirm_reset'=>'تأكيد التهيئة',
        'Are you sure you want to reset'=>'هل أنت متأكد من هذه الخطوة؟ ستفقد كل البيانات الخاصة بالموقع ولا يمكنك التراجع عن هذه الخطوة بعد القيام بها',
        'confirm_cleanup'=>'تأكيد تنظيف الجلسات وملفات تعريف الارتباط',
        'Are you sure you want to cleanup'=>'هل أنت متأكد من هذه الخطوة؟ يؤدي هذا الخيار إلى تسجيل خروجك من النظام',
        'close'=>'اغلاق',
        'yes'=>'نعم',
        'send'=>'ارسال',

        'confirm_delete_cache'=>'تأكيد حذف الكاش',
        'Are you sure you want to delete cache'=>'قد يتم تحميل الموقع بشكل أبطأ عند زيارته في المرة القادمة',
        
        'confirm_reload'=>'تأكيد إعادة التحميل',
        'Are you sure you want to reload'=>'هل أنت متأكد من هذه الخطوة، سيتم تحميل الإعدادات من السيرفر',
        
        'confirm_launch'=>'تأكيد تجهيز الموقع للإطلاق',
        'Are you sure you want to launch'=>'هل أنت متأكد من هذه الخطوة، سيتم تجهيز الموقع للإطلاق',
    
        'confirm_test'=>'تأكيد الاختبار',
        'Are you sure you want to launch'=>'ادخل الإيميل المراد الإرسال له',

        'confirm_test_report'=>'تأكيد الاختبار',

    ]

];