<x-layout title="Contact Us - Perfume Store">
    <div class="max-w-7xl mx-auto py-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Get in Touch</h1>
            <p class="text-lg text-gray-600">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div>
                <div class="card bg-base-100 border border-base-300">
                    <div class="card-body">
                        <h2 class="card-title text-2xl mb-6">Send us a Message</h2>

                        <form action="{{ route('contact.store') }}" method="post">
                            @csrf
                            <fieldset class="fieldset">
                                <label class="label">Name</label>
                                <input type="text" name="name" class="input w-full validator" placeholder="Your name" required />

                                <label class="label mt-4">Email</label>
                                <input type="email" name="email" class="input w-full validator" placeholder="your@email.com" required />

                                <label class="label mt-4">Message</label>
                                <textarea name="message" class="textarea h-32 w-full validator" placeholder="How can we help you?" required></textarea>

                                <button type="submit" class="btn btn-primary w-full mt-6">
                                    <i data-lucide="send" class="w-4 h-4 mr-2"></i>
                                    Send Message
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="card bg-base-100 border border-base-300">
                    <div class="card-body">
                        <h3 class="card-title text-xl mb-4">Contact Information</h3>

                        <div class="flex items-center mb-4">
                            <i data-lucide="mail" class="w-5 h-5 text-primary mr-3"></i>
                            <div>
                                <p class="text-gray-600">support@perfumestore.com</p>
                            </div>
                        </div>

                        <div class="flex items-start mb-4">
                            <i data-lucide="map-pin" class="w-5 h-5 text-primary mr-3 mt-0.5"></i>
                            <div>
                                <p class="text-gray-600">123 Perfume Street<br>Fragrance City, FC 12345</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <i data-lucide="clock" class="w-5 h-5 text-primary mr-3 mt-0.5"></i>
                            <div>
                                <p class="text-gray-600">Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM<br>Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 border border-base-300">
                    <div class="card-body">
                        <h3 class="card-title text-xl mb-4">Frequently Asked Questions</h3>

                        <div class="space-y-3">
                            <div class="collapse collapse-plus bg-base-200">
                                <input type="radio" name="faq-accordion" checked="checked" />
                                <div class="collapse-title font-medium">
                                    How long does shipping take?
                                </div>
                                <div class="collapse-content">
                                    <p class="text-sm text-gray-600">Standard shipping takes 3-5 business days. Express shipping is available for 1-2 business day delivery.</p>
                                </div>
                            </div>

                            <div class="collapse collapse-plus bg-base-200">
                                <input type="radio" name="faq-accordion" />
                                <div class="collapse-title font-medium">
                                    Do you offer international shipping?
                                </div>
                                <div class="collapse-content">
                                    <p class="text-sm text-gray-600">Yes, we ship to most countries worldwide. International orders typically arrive within 7-14 business days.</p>
                                </div>
                            </div>

                            <div class="collapse collapse-plus bg-base-200">
                                <input type="radio" name="faq-accordion" />
                                <div class="collapse-title font-medium">
                                    Can I return or exchange a perfume?
                                </div>
                                <div class="collapse-content">
                                    <p class="text-sm text-gray-600">We accept returns of unopened products within 30 days of purchase. Unfortunately, we cannot accept returns on opened perfumes for hygiene reasons.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-primary text-primary-content">
                    <div class="card-body">
                        <h3 class="card-title text-white mb-4">Need Immediate Assistance?</h3>
                        <p class="mb-4 text-sm opacity-90">Our customer support team is available during business hours.</p>
                        <a href="tel:+15551234567" class="btn btn-outline btn-white">
                            <i data-lucide="phone" class="w-4 h-4 mr-2 animate-wiggle"></i>
                            Call Us: +1 (555) 123-4567
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes wiggle {
            0%, 100% { transform: rotate(-15deg); }
            50% { transform: rotate(15deg); }
        }
        .animate-wiggle {
            animation: wiggle 1s ease-in-out infinite;
        }
    </style>
</x-layout>
