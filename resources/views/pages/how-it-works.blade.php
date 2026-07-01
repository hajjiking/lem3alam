@extends('layouts.app')

@section('title', __('ui.how_it_works') . ' - Step by Step Guide')
@section('description', 'Learn how M3alam connects clients with skilled taskers. Simple steps to post tasks, find professionals, and get work done safely.')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">{{ __('ui.how_it_works') }}</h1>
                <p class="lead mb-4">{{ __('ui.how_it_works_subtitle') }}. Follow these simple steps to connect with skilled professionals or find work opportunities.</p>
            </div>
        </div>
    </div>
</section>

<!-- For Clients Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">For Clients - Get Things Done</h2>
            <p class="lead text-muted">Post your task and let skilled professionals come to you</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 text-center mb-4">
                <div class="category-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <h4>1. Post Your Task</h4>
                <p class="text-muted">Describe what you need done, set your budget, location, and deadline. Be as detailed as possible to attract the right taskers.</p>
                <ul class="list-unstyled text-start">
                    <li><i class="fas fa-check text-success me-2"></i>Clear task description</li>
                    <li><i class="fas fa-check text-success me-2"></i>Set realistic budget</li>
                    <li><i class="fas fa-check text-success me-2"></i>Choose location & timing</li>
                    <li><i class="fas fa-check text-success me-2"></i>Add photos if needed</li>
                </ul>
            </div>
            
            <div class="col-lg-4 text-center mb-4">
                <div class="category-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h4>2. Review & Choose</h4>
                <p class="text-muted">Receive proposals from qualified taskers. Review their profiles, ratings, and previous work before making your choice.</p>
                <ul class="list-unstyled text-start">
                    <li><i class="fas fa-check text-success me-2"></i>Compare proposals</li>
                    <li><i class="fas fa-check text-success me-2"></i>Check tasker profiles</li>
                    <li><i class="fas fa-check text-success me-2"></i>Read reviews & ratings</li>
                    <li><i class="fas fa-check text-success me-2"></i>Message before hiring</li>
                </ul>
            </div>
            
            <div class="col-lg-4 text-center mb-4">
                <div class="category-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4>3. Get It Done</h4>
                <p class="text-muted">Work with your chosen tasker to complete the job. Pay securely through our platform once you're satisfied.</p>
                <ul class="list-unstyled text-start">
                    <li><i class="fas fa-check text-success me-2"></i>Secure communication</li>
                    <li><i class="fas fa-check text-success me-2"></i>Track progress</li>
                    <li><i class="fas fa-check text-success me-2"></i>Safe payment system</li>
                    <li><i class="fas fa-check text-success me-2"></i>Leave feedback</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- For Taskers Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">For Taskers - Find Work</h2>
            <p class="lead text-muted">Turn your skills into income by helping others</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 text-center mb-4">
                <div class="category-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h4>1. Create Your Profile</h4>
                <p class="text-muted">Build a compelling profile showcasing your skills, experience, and previous work. A great profile attracts more clients.</p>
                <ul class="list-unstyled text-start">
                    <li><i class="fas fa-check text-success me-2"></i>Professional photo</li>
                    <li><i class="fas fa-check text-success me-2"></i>Detailed bio</li>
                    <li><i class="fas fa-check text-success me-2"></i>Skills & certifications</li>
                    <li><i class="fas fa-check text-success me-2"></i>Portfolio samples</li>
                </ul>
            </div>
            
            <div class="col-lg-4 text-center mb-4">
                <div class="category-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h4>2. Find & Apply</h4>
                <p class="text-muted">Browse available tasks in your area or skills. Submit competitive proposals that highlight why you're the best fit.</p>
                <ul class="list-unstyled text-start">
                    <li><i class="fas fa-check text-success me-2"></i>Search by location</li>
                    <li><i class="fas fa-check text-success me-2"></i>Filter by skills</li>
                    <li><i class="fas fa-check text-success me-2"></i>Competitive pricing</li>
                    <li><i class="fas fa-check text-success me-2"></i>Quick response time</li>
                </ul>
            </div>
            
            <div class="col-lg-4 text-center mb-4">
                <div class="category-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h4>3. Complete & Get Paid</h4>
                <p class="text-muted">Deliver quality work on time and get paid securely. Build your reputation with positive reviews.</p>
                <ul class="list-unstyled text-start">
                    <li><i class="fas fa-check text-success me-2"></i>Quality delivery</li>
                    <li><i class="fas fa-check text-success me-2"></i>Meet deadlines</li>
                    <li><i class="fas fa-check text-success me-2"></i>Secure payments</li>
                    <li><i class="fas fa-check text-success me-2"></i>Build reputation</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Safety & Trust -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Safety & Trust</h2>
            <p class="lead text-muted">Your security is our top priority</p>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center mb-4">
                <div class="category-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h5>Verified Profiles</h5>
                <p class="text-muted">All taskers go through identity verification and background checks for your peace of mind.</p>
            </div>
            
            <div class="col-lg-3 col-md-6 text-center mb-4">
                <div class="category-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h5>Secure Payments</h5>
                <p class="text-muted">Your money is held securely until the work is completed to your satisfaction.</p>
            </div>
            
            <div class="col-lg-3 col-md-6 text-center mb-4">
                <div class="category-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h5>24/7 Support</h5>
                <p class="text-muted">Our customer support team is available around the clock to help resolve any issues.</p>
            </div>
            
            <div class="col-lg-3 col-md-6 text-center mb-4">
                <div class="category-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h5>Quality Guarantee</h5>
                <p class="text-muted">If you're not satisfied with the work, we'll help make it right or refund your money.</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Frequently Asked Questions</h2>
            <p class="lead text-muted">Got questions? We've got answers</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                How do I know if a tasker is reliable?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                All taskers on M3alam are verified and have ratings from previous clients. You can review their profiles, read feedback, and message them before hiring.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                When do I pay for the service?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Payment is held securely by M3alam and only released to the tasker once you confirm the work is completed satisfactorily.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                What if I'm not satisfied with the work?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                We offer a satisfaction guarantee. If you're not happy with the work, contact our support team and we'll help resolve the issue or provide a refund.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                How much does M3alam charge?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                M3alam charges a small service fee only when a task is completed successfully. There are no upfront costs for posting tasks or creating profiles.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Ready to Get Started?</h2>
        <p class="lead mb-4">Join thousands of satisfied users who trust M3alam</p>
        
        <div class="d-flex justify-content-center gap-3">
            // Lines 246, 249: Update register links
            <a href="{{ localized_route('register') }}?type=client" class="btn btn-light btn-lg px-4">
            <a href="{{ localized_route('register') }}?type=tasker" class="btn btn-outline-light btn-lg px-4">
                <i class="fas fa-user-plus me-2"></i>{{ __('I Need Services') }}
            </a>
            <a href="{{ localized_route('register') }}?type=tasker" class="btn btn-outline-light btn-lg px-4">
                <i class="fas fa-briefcase me-2"></i>{{ __('I Offer Services') }}
            </a>
        </div>
    </div>
</section>
@endsection