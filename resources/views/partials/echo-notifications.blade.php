<!-- resources/views/partials/echo-notifications.blade.php -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.3/echo.iife.js"></script>

<style>
@keyframes fade-in {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
  animation: fade-in 0.3s ease-out;
}
</style>

<script>
    window.Echo = new Echo({
        broadcaster: "pusher",
        key: "{{ env('PUSHER_APP_KEY') }}",
        wsHost: window.location.hostname,
        wsPort: 6001,
        forceTLS: false,
        disableStats: true,
        enabledTransports: ["ws"]
    });

    Echo.channel(`reminder.{{ auth()->user()->id }}`)
        .listen(".reminder-message", (data) => {
            console.log("Received Reminder:", data);
            
            // ✅ الرسالة الأصلية
            // alert(`Reminder: ${data.title} - ${data.message}`);
            
            // ✅ الرسالة المنسقة باستخدام HTML + Tailwind
            // ✅ 2. إنشاء عنصر toast
            const oldToast = document.getElementById('reminder-toast');
        if (oldToast) oldToast.remove();

        // ✅ إنشاء العنصر
        const toast = document.createElement('div');
        toast.id = 'reminder-toast';
        toast.style.position = 'fixed';
        toast.style.top = '20px';
        toast.style.left = '50%';
        toast.style.transform = 'translateX(-50%)';
        toast.style.backgroundColor = '#f9fafb';
        toast.style.border = '2px solid #6CA8F1';
        toast.style.padding = '16px 20px 16px 16px';
        toast.style.borderRadius = '12px';
        toast.style.boxShadow = '0 10px 15px -3px rgba(0,0,0,0.5)';
        toast.style.zIndex = '9999';
        toast.style.display = 'flex';
        toast.style.alignItems = 'start';
        toast.style.gap = '12px';
        toast.style.maxWidth = '90%';
        toast.style.width = '400px';
        toast.style.fontFamily = 'sans-serif';
        toast.style.transition = 'opacity 0.3s ease-in-out';
        toast.style.opacity = '1';

        // ✅ محتوى الرسالة مع زر الإغلاق
        toast.innerHTML = `
            <div style="flex: 1;">
                <h3 class="font-primary " style="font-weight: 600; font-size: 18px; color: #222e3e; margin-bottom: 4px;">${data.title}</h3>
                <p  class="font-primary " style="font-size: 14px; color: #8C94A3;">${data.message}</p>
            </div>
            <button id="close-toast" style="
                background: transparent;
                border: none;
                color: #FC6441;
                font-size: 25px;
                line-height: 1;
                cursor: pointer;
                padding: 0 4px;
            ">&times;</button>
        `;

        // ✅ إغلاق يدوي
        toast.querySelector('#close-toast').addEventListener('click', () => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        });

        // ✅ إضافة للصفحة
        document.body.appendChild(toast);

        // ✅ حذف تلقائي بعد 30 ثانية
        setTimeout(() => {
            if (document.body.contains(toast)) {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }
        }, 30000); 

        });
</script>
