@php $id  = 'js_auth_modal_' . uniqid() @endphp
<div x-data="{ isRegister: false }">
    <button class="btn btn-primary" onclick="{{ $id }}.showModal()">
        {{ __('app.account') }}
    </button>

    <dialog id="{{ $id }}" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
                        aria-label="{{ __('app.close') }}">✕
                </button>
            </form>

            <!-- Login View -->
            <div x-show="!isRegister">
                <h3 class="font-bold text-lg">{{ __('app.login') }}</h3>
                <div class="py-4">
                    <p class="mb-4">{{ __('app.enter-phone-for-otp') }}</p>
                    <form id="otp-login-form" onsubmit="handleOtpSubmit(event, 'login')">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">{{ __('app.phone-number') }}</span>
                            </label>
                            <input type="tel" name="phone_number" placeholder="{{ __('app.example-phone') }}"
                                   class="input input-bordered w-full"/>
                        </div>
                        <button type="submit" class="btn btn-primary w-full mt-4">{{ __('app.send-otp') }}</button>
                    </form>
                    <div class="divider">{{ __('app.or') }}</div>
                    <a href="{{ route('auth.google', ['language' => app()->getLocale()]) }}" class="btn w-full">
                        <i class="fab fa-google"></i>
                        {{ __('app.continue-with-google') }}
                    </a>
                </div>
                <p class="text-center">
                    {{ __('app.dont-have-account') }}
                    <button class="link" @click="isRegister = true">{{ __('app.register') }}</button>
                </p>
            </div>

            <!-- Register View -->
            <div x-show="isRegister">
                <h3 class="font-bold text-lg">{{ __('app.register') }}</h3>
                <div class="py-4">
                    <p class="mb-4">{{ __('app.enter-phone-to-register') }}</p>
                    <form id="otp-register-form" onsubmit="handleOtpSubmit(event, 'register')">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">{{ __('app.phone-number') }}</span>
                            </label>
                            <input type="tel" name="phone_number" placeholder="{{ __('app.example-phone') }}"
                                   class="input input-bordered w-full"/>
                        </div>
                        <button type="submit" class="btn btn-primary w-full mt-4">{{ __('app.send-otp') }}</button>
                    </form>
                    <div class="divider">{{ __('app.or') }}</div>
                    <a href="{{ route('auth.google', ['language' => app()->getLocale()]) }}" class="btn w-full">
                        <i class="fab fa-google"></i>
                        {{ __('app.continue-with-google') }}
                    </a>
                </div>
                <p class="text-center">
                    {{ __('app.already-have-account') }}
                    <button class="link" @click="isRegister = false">{{ __('app.login') }}</button>
                </p>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>{{ __('app.close') }}</button>
        </form>
    </dialog>
</div>

@pushOnce('scripts')
    <script>
        function handleOtpSubmit(event, type) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            fetch('{{ route('auth.otp', ['language' => app()->getLocale()]) }}', {
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
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        }
    </script>
@endpushOnce
