<?php

// شغل websockets كـ Process
$websockets = proc_open('php artisan websockets:serve', [
    1 => ['pipe', 'w'],
    2 => ['pipe', 'w'],
], $pipes);

if (is_resource($websockets)) {
    echo "WebSocket server started.\n";

    while (true) {
        // كل ثانية شغّل أمر التذكير
        exec('php artisan app:remind-me');
        sleep(1);
    }

    // اغلاق السيرفر عند انتهاء الحلقة (لو صارت)
    proc_close($websockets);
} else {
    echo "فشل في تشغيل websockets.\n";
}
