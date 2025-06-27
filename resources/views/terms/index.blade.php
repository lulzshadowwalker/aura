<x-layout title="Terms of Service">
    <div class="container mx-auto px-4 my-20 max-md:my-8">
        <article class="prose prose-lg prose-gray dark:prose-invert">
            <h1>Terms of Service</h1>

            <p class="lead">Last updated: {{ date('F d, Y') }}</p>

            <p>Welcome to Aura. By accessing our website and purchasing our products, you agree to be bound by these Terms of Service. Please read them carefully.</p>

            <h2>1. Acceptance of Terms</h2>
            <p>By using our services, you confirm that you are at least 18 years old or have parental consent to use this website. You agree to comply with all applicable laws and regulations.</p>

            <h2>2. Products and Services</h2>
            <ul>
                <li><strong>Product Descriptions</strong> - We strive for accuracy in our product descriptions but cannot guarantee that all information is error-free</li>
                <li><strong>Pricing</strong> - All prices are subject to change without notice. We reserve the right to correct any pricing errors</li>
                <li><strong>Availability</strong> - Products are subject to availability and we may limit quantities purchased per customer</li>
            </ul>

            <h2>3. Ordering and Payment</h2>
            <p>When you place an order, you are making an offer to purchase products. We reserve the right to refuse or cancel any order for any reason, including:</p>
            <ul>
                <li>Product or pricing errors</li>
                <li>Suspected fraudulent activity</li>
                <li>Inventory limitations</li>
                <li>Credit card authorization issues</li>
            </ul>

            <h2>4. Shipping and Delivery</h2>
            <p>We aim to process and ship orders promptly, but delivery times are estimates only. We are not responsible for delays due to:</p>
            <ul>
                <li>Carrier issues</li>
                <li>Weather conditions</li>
                <li>Incorrect shipping information</li>
                <li>Customs delays for international orders</li>
            </ul>

            <h2>5. Intellectual Property</h2>
            <p>All content on this website, including text, images, logos, and product descriptions, is owned by Aura or our suppliers and is protected by intellectual property laws. You may not:</p>
            <ul>
                <li>Copy, reproduce, or distribute our content without permission</li>
                <li>Use our trademarks or logos without written consent</li>
                <li>Create derivative works based on our content</li>
            </ul>

            <h2>6. User Accounts</h2>
            <p>If you create an account with us, you are responsible for:</p>
            <ul>
                <li>Maintaining the confidentiality of your account information</li>
                <li>All activities that occur under your account</li>
                <li>Notifying us immediately of any unauthorized use</li>
            </ul>

            <h2>7. Privacy</h2>
            <p>Your use of our services is also governed by our Privacy Policy. By using our website, you consent to the collection and use of your information as described in our Privacy Policy.</p>

            <h2>8. Product Use and Safety</h2>
            <ul>
                <li><strong>Allergies</strong> - Please check ingredient lists carefully. We are not responsible for allergic reactions</li>
                <li><strong>Storage</strong> - Follow product storage instructions to maintain quality</li>
                <li><strong>External Use Only</strong> - Our fragrances are for external use only</li>
            </ul>

            <h2>9. Limitation of Liability</h2>
            <p>To the fullest extent permitted by law, Aura shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from:</p>
            <ul>
                <li>Use or inability to use our products or services</li>
                <li>Any products purchased through our website</li>
                <li>Unauthorized access to your personal information</li>
                <li>Any other matter relating to our services</li>
            </ul>

            <h2>10. Indemnification</h2>
            <p>You agree to indemnify and hold Aura harmless from any claims, damages, or expenses arising from your violation of these Terms of Service or your use of our website.</p>

            <h2>11. Governing Law</h2>
            <p>These Terms of Service are governed by the laws of [Your Jurisdiction] without regard to conflict of law principles. Any disputes shall be resolved in the courts of [Your Jurisdiction].</p>

            <h2>12. Changes to Terms</h2>
            <p>We reserve the right to modify these Terms of Service at any time. Changes will be effective immediately upon posting to the website. Your continued use of our services constitutes acceptance of any changes.</p>

            <h2>13. Severability</h2>
            <p>If any provision of these Terms is found to be unenforceable, the remaining provisions shall continue in full force and effect.</p>

            <h2>14. Contact Information</h2>
            <p>If you have any questions about these Terms of Service, please contact us through our contact page or at:</p>
            <address class="not-italic">
                <strong>Aura Fragrances</strong><br>
                [Your Address]<br>
                [Your City, State ZIP]<br>
                Email: legal@aura.com<br>
                Phone: [Your Phone Number]
            </address>
        </article>

        <div class="mt-12 text-center">
            <div class="card bg-base-100 border border-base-300 container mx-auto">
                <div class="card-body">
                    <h3 class="card-title justify-center mb-3">Have questions about our terms?</h3>
                    <p class="text-gray-600 mb-6 text-pretty">We're here to help clarify any concerns you may have.</p>
                    <a href="{{ route('contact.index') }}" class="btn btn-primary max-w-fit mx-auto">
                        <i data-lucide="message-circle" class="w-4 h-4 me-1"></i>
                        Contact Our Team
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
