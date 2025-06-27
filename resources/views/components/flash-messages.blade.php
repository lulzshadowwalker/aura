<div x-sync id="flash-messages" role="alert" class="toast toast-end z-50">
    @if(session('success'))
    <div class="alert alert-success gap-2">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-error gap-2">
        <i class="fa-solid fa-circle-xmark"></i>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    @if(session('warning'))
    <div class="alert alert-warning gap-2">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <span>{{ session('warning') }}</span>
    </div>
    @endif

    @if(session('info'))
    <div class="alert alert-info gap-2">
        <i class="fa-solid fa-circle-info"></i>
        <span>{{ session('info') }}</span>
    </div>
    @endif

     <!-- TODO: I am not sure if this is something we should keep, maybe display a generic error message to the user -->
    @if($errors->any())
    <div class="alert alert-error gap-2">
        <i class="fa-solid fa-circle-exclamation"></i>
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

<script>
    //  NOTE: We are using polling here because scripts to do not seem to be executed when using the Alpine-Ajax.
    document.addEventListener('DOMContentLoaded', function() {
        setInterval(function() {
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
