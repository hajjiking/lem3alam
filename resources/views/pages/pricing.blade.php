@extends('layouts.app')

@section('title', 'Pricing - M3alam')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary mb-3">Simple, Transparent Pricing</h1>
        <p class="lead text-muted">Choose the plan that works best for you. No hidden fees, no surprises.</p>
    </div>

    <!-- Pricing Cards -->
    <div class="row justify-content-center">
        <!-- Basic Plan -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <h3 class="card-title text-primary mb-3">Basic</h3>
                    <div class="mb-4">
                        <span class="display-4 fw-bold">5%</span>
                        <span class="text-muted">service fee</span>
                    </div>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Post unlimited tasks</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Basic customer support</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Standard payment processing</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Basic profile features</li>
                    </ul>
                    // Lines 30, 54, 130: Update register links
                    <a href="{{ localized_route('register') }}" class="btn btn-outline-primary btn-lg w-100">Get Started</a>
                    <a href="{{ localized_route('register') }}" class="btn btn-primary btn-lg w-100">Choose Pro</a>
                    <a href="{{ localized_route('register') }}" class="btn btn-primary btn-lg me-3">Sign Up Now</a>
                    <a href="{{ localized_route('home') }}" class="btn btn-outline-secondary btn-lg">Learn More</a>
                </div>
            </div>
        </div>

        <!-- Pro Plan -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 border-primary shadow">
                <div class="card-header bg-primary text-white text-center py-3">
                    <span class="badge bg-warning text-dark">Most Popular</span>
                </div>
                <div class="card-body text-center p-4">
                    <h3 class="card-title text-primary mb-3">Pro</h3>
                    <div class="mb-4">
                        <span class="display-4 fw-bold">3%</span>
                        <span class="text-muted">service fee</span>
                    </div>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Everything in Basic</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Priority customer support</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Advanced analytics</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Featured task listings</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Enhanced profile badge</li>
                    </ul>
                    <a href="{{ localized_route('register') }}" class="btn btn-primary btn-lg w-100">Choose Pro</a>
                </div>
            </div>
        </div>

        <!-- Enterprise Plan -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <h3 class="card-title text-primary mb-3">Enterprise</h3>
                    <div class="mb-4">
                        <span class="display-4 fw-bold">Custom</span>
                        <span class="text-muted">pricing</span>
                    </div>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Everything in Pro</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Dedicated account manager</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Custom integrations</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>White-label solutions</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>24/7 priority support</li>
                    </ul>
                    <a href="#contact" class="btn btn-outline-primary btn-lg w-100">Contact Sales</a>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row mt-5">
        <div class="col-lg-8 mx-auto">
            <h2 class="text-center mb-4">Frequently Asked Questions</h2>
            <div class="accordion" id="pricingFAQ">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            How does the service fee work?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#pricingFAQ">
                        <div class="accordion-body">
                            The service fee is automatically deducted from your earnings when a task is completed. For example, if you earn 1,000 MAD on the Basic plan, you'll receive 950 MAD after the 5% service fee.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Can I change my plan anytime?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#pricingFAQ">
                        <div class="accordion-body">
                            Yes! You can upgrade or downgrade your plan at any time. Changes take effect immediately for new tasks.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Are there any hidden fees?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#pricingFAQ">
                        <div class="accordion-body">
                            No hidden fees! The service fee is the only cost. Payment processing fees are included in our service fee.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="text-center mt-5 py-5 bg-light rounded">
        <h3 class="mb-3">Ready to get started?</h3>
        <p class="text-muted mb-4">Join thousands of users who trust M3alam for their task needs.</p>
        <a href="{{ localized_route('register') }}" class="btn btn-primary btn-lg me-3">Sign Up Now</a>
        <a href="{{ localized_route('home') }}" class="btn btn-outline-secondary btn-lg">Learn More</a>
    </div>
</div>
@endsection