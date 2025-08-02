<div x-data="{ isRegister: false }">
    <button class="btn btn-primary" onclick="auth_modal.showModal()">
        Account
    </button>

    <dialog id="auth_modal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>

            <!-- Login View -->
            <div x-show="!isRegister">
                <h3 class="font-bold text-lg">Login</h3>
                <div class="py-4">
                    <p class="mb-4">Enter your phone number to receive an OTP.</p>
                    <form id="otp-login-form">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Phone Number</span>
                            </label>
                            <input type="tel" name="phone_number" placeholder="e.g. +1234567890" class="input input-bordered w-full" />
                        </div>
                        <button type="submit" class="btn btn-primary w-full mt-4">Send OTP</button>
                    </form>
                    <div class="divider">OR</div>
                    <a href="{{ route('auth.google') }}" class="btn w-full">
                        <i class="fab fa-google"></i>
                        Continue with Google
                    </a>
                </div>
                <p class="text-center">
                    Don't have an account?
                    <button class="link" @click="isRegister = true">Register</button>
                </p>
            </div>

            <!-- Register View -->
            <div x-show="isRegister">
                <h3 class="font-bold text-lg">Register</h3>
                <div class="py-4">
                    <p class="mb-4">Enter your phone number to create an account.</p>
                    <form id="otp-register-form">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Phone Number</span>
                            </label>
                            <input type="tel" name="phone_number" placeholder="e.g. +1234567890" class="input input-bordered w-full" />
                        </div>
                        <button type="submit" class="btn btn-primary w-full mt-4">Send OTP</button>
                    </form>
                    <div class="divider">OR</div>
                    <a href="{{ route('auth.google') }}" class="btn w-full">
                        <i class="fab fa-google"></i>
                        Continue with Google
                    </a>
                </div>
                <p class="text-center">
                    Already have an account?
                    <button class="link" @click="isRegister = false">Login</button>
                </p>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const otpLoginForm = document.getElementById('otp-login-form');
        otpLoginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('{{ route("auth.otp") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                    }
                });
        });

        const otpRegisterForm = document.getElementById('otp-register-form');
        otpRegisterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('{{ route("auth.otp") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                    }
                });
        });
    });
</script>