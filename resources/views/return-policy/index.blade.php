<x-layout title="Return Policy">
    <div class="container mx-auto px-4 my-20 max-md:my-8">
    <article class="prose prose-lg prose-gray dark:prose-invert">
            <h1>Return Policy</h1>

            <p class="lead">We want you to be completely satisfied with your purchase. Please review our return policy below.</p>

            <h2>Return Window</h2>
            <p>You have <strong>30 days</strong> from the date of purchase to return eligible items. All returns must be initiated within this timeframe.</p>

            <h2>What Can Be Returned</h2>
            <ul>
                <li><strong>Unopened perfumes</strong> - Items must be in their original packaging with seals intact</li>
                <li><strong>Defective products</strong> - Items damaged during shipping or with manufacturing defects</li>
                <li><strong>Wrong items</strong> - If we sent you an incorrect product</li>
            </ul>

            <h2>What Cannot Be Returned</h2>
            <p>For health and safety reasons, we cannot accept returns on:</p>
            <ul>
                <li><strong>Opened perfumes</strong> - Any fragrance that has been opened, tested, or used</li>
                <li><strong>Custom orders</strong> - Personalized or special order items</li>
                <li><strong>Final sale items</strong> - Products marked as final sale (unless defective)</li>
            </ul>

            <h2>How to Return an Item</h2>
            <ol>
                <li>Contact our customer service team with your order number</li>
                <li>We'll provide you with a return authorization number and instructions</li>
                <li>Package the item securely in its original packaging</li>
                <li>Ship the item back using our prepaid return label (for eligible returns)</li>
            </ol>

            <h2>Refunds</h2>
            <p>Once we receive and inspect your return, we'll process your refund within <strong>3-5 business days</strong>. Refunds will be issued to your original payment method. Please note that original shipping costs are non-refundable unless the return is due to our error.</p>

            <h2>Exchanges</h2>
            <p>We don't offer direct exchanges. If you'd like a different product, please return the original item for a refund and place a new order.</p>

            <h2>Important Note</h2>
            <p>Due to health regulations, we cannot accept returns on opened fragrances. We recommend ordering samples first if you're unsure about a scent, or visiting our store to test products before purchasing.</p>
        </article>

        <div class="mt-12 text-center">
            <div class="card bg-base-100 border border-base-300 container mx-auto">
                <div class="card-body">
                    <h3 class="card-title justify-center mb-3">Still have questions?</h3>
                    <p class="text-gray-600 mb-6 text-pretty">Our customer service team is here to help with any return inquiries.</p>
                    <a href="{{ route('contact.index') }}" class="btn btn-primary max-w-fit mx-auto">
                        <i data-lucide="message-circle" class="w-4 h-4 me-1"></i>
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
