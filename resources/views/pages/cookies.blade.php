@extends('layouts.app')

@section('title', 'Cookie Policy')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="mb-4">Cookie Policy</h1>
            <p class="text-muted mb-4">Last updated: {{ date('F d, Y') }}</p>
            
            <div class="card">
                <div class="card-body">
                    <h2 class="h4 mb-3">What Are Cookies</h2>
                    <p>Cookies are small text files that are placed on your computer or mobile device when you visit our website. They are widely used to make websites work more efficiently and provide information to website owners.</p>
                    
                    <h2 class="h4 mt-5 mb-3">How We Use Cookies</h2>
                    <p>M3alam uses cookies to:</p>
                    <ul>
                        <li>Remember your login status and preferences</li>
                        <li>Analyze how you use our website</li>
                        <li>Improve our services and user experience</li>
                        <li>Provide personalized content and advertisements</li>
                        <li>Ensure security and prevent fraud</li>
                    </ul>
                    
                    <h2 class="h4 mt-5 mb-3">Types of Cookies We Use</h2>
                    
                    <h3 class="h5 mt-4 mb-2">Essential Cookies</h3>
                    <p>These cookies are necessary for the website to function properly. They enable core functionality such as security, network management, and accessibility.</p>
                    <ul>
                        <li><strong>Session cookies:</strong> Keep you logged in during your visit</li>
                        <li><strong>Security cookies:</strong> Protect against cross-site request forgery</li>
                        <li><strong>Load balancing cookies:</strong> Ensure optimal website performance</li>
                    </ul>
                    
                    <h3 class="h5 mt-4 mb-2">Analytics Cookies</h3>
                    <p>These cookies help us understand how visitors interact with our website by collecting and reporting information anonymously.</p>
                    <ul>
                        <li><strong>Google Analytics:</strong> Tracks website usage and performance</li>
                        <li><strong>Heatmap cookies:</strong> Show how users navigate our pages</li>
                        <li><strong>A/B testing cookies:</strong> Help us test different versions of our site</li>
                    </ul>
                    
                    <h3 class="h5 mt-4 mb-2">Functional Cookies</h3>
                    <p>These cookies enable enhanced functionality and personalization, such as remembering your preferences.</p>
                    <ul>
                        <li><strong>Language preferences:</strong> Remember your chosen language</li>
                        <li><strong>Theme preferences:</strong> Remember your display preferences</li>
                        <li><strong>Location cookies:</strong> Remember your location for relevant content</li>
                    </ul>
                    
                    <h3 class="h5 mt-4 mb-2">Marketing Cookies</h3>
                    <p>These cookies are used to deliver advertisements that are relevant to you and your interests.</p>
                    <ul>
                        <li><strong>Advertising cookies:</strong> Track your browsing habits for targeted ads</li>
                        <li><strong>Social media cookies:</strong> Enable sharing on social platforms</li>
                        <li><strong>Retargeting cookies:</strong> Show you relevant ads on other websites</li>
                    </ul>
                    
                    <h2 class="h4 mt-5 mb-3">Third-Party Cookies</h2>
                    <p>We may also use third-party cookies from trusted partners:</p>
                    <ul>
                        <li><strong>Google Analytics:</strong> For website analytics</li>
                        <li><strong>Facebook Pixel:</strong> For advertising and analytics</li>
                        <li><strong>Payment processors:</strong> For secure payment processing</li>
                        <li><strong>Customer support tools:</strong> For live chat functionality</li>
                    </ul>
                    
                    <h2 class="h4 mt-5 mb-3">Managing Your Cookie Preferences</h2>
                    <p>You have several options for managing cookies:</p>
                    
                    <h3 class="h5 mt-4 mb-2">Browser Settings</h3>
                    <p>Most web browsers allow you to control cookies through their settings. You can:</p>
                    <ul>
                        <li>Block all cookies</li>
                        <li>Block third-party cookies only</li>
                        <li>Delete cookies when you close your browser</li>
                        <li>Get notified when cookies are set</li>
                    </ul>
                    
                    <h3 class="h5 mt-4 mb-2">Cookie Consent Tool</h3>
                    <p>We provide a cookie consent tool that allows you to:</p>
                    <ul>
                        <li>Accept or reject different types of cookies</li>
                        <li>Change your preferences at any time</li>
                        <li>View detailed information about each cookie</li>
                    </ul>
                    
                    <div class="alert alert-info mt-4">
                        <h4 class="alert-heading">Cookie Settings</h4>
                        <p>You can manage your cookie preferences by clicking the \"Cookie Settings\" link in our website footer or by using your browser's cookie management tools.</p>
                        <button class="btn btn-primary" onclick="showCookieSettings()">Manage Cookie Preferences</button>
                    </div>
                    
                    <h2 class="h4 mt-5 mb-3">Impact of Disabling Cookies</h2>
                    <p>If you choose to disable cookies, some features of our website may not function properly:</p>
                    <ul>
                        <li>You may need to log in repeatedly</li>
                        <li>Your preferences may not be saved</li>
                        <li>Some personalized features may not work</li>
                        <li>Website performance may be affected</li>
                    </ul>
                    
                    <h2 class="h4 mt-5 mb-3">Updates to This Policy</h2>
                    <p>We may update this cookie policy from time to time to reflect changes in our practices or for other operational, legal, or regulatory reasons.</p>
                    
                    <h2 class="h4 mt-5 mb-3">Contact Us</h2>
                    <p>If you have any questions about our use of cookies, please contact us:</p>
                    <ul class="list-unstyled">
                        <li><strong>Email:</strong> privacy@m3alam.com</li>
                        <li><strong>Phone:</strong> +1 (555) 123-4567</li>
                        <li><strong>Address:</strong> 123 Cookie Street, Privacy City, PC 12345</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showCookieSettings() {
    // This would typically open a cookie consent modal
    alert('Cookie settings panel would open here. This is where users can manage their cookie preferences.');
}
</script>
@endsection