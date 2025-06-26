<div class="toast toast-end z-50">
    @if(session('success'))
        <div class="alert alert-success">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i data-lucide="x-circle" class="w-4 h-4"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning">
            <i data-lucide="alert-triangle" class="w-4 h-4"></i>
            <span>{{ session('warning') }}</span>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info">
            <i data-lucide="info" class="w-4 h-4"></i>
            <span>{{ session('info') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <i data-lucide="alert-circle" class="w-4 h-4"></i>
            <div>
                <span class="font-semibold">Please fix the following errors:</span>
                <ul class="mt-1 text-sm">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>

@if(session('success') || session('error') || session('warning') || session('info') || $errors->any())
    <script>
        // Auto-hide toasts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const toasts = document.querySelectorAll('.toast .alert');
                toasts.forEach(function(toast) {
                    toast.style.transition = 'opacity 0.5s ease-out';
                    toast.style.opacity = '0';
                    setTimeout(function() {
                        toast.remove();
                    }, 500);
                });
            }, 5000);
        });
    </script>
@endif
