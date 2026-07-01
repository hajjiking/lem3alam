@extends('layouts.app')

@section('title', 'Tasker Guide - M3alam')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary mb-3">Complete Tasker Guide</h1>
        <p class="lead text-muted">Everything you need to know to succeed as a tasker on M3alam</p>
    </div>

    <!-- Getting Started Section -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <h2 class="text-primary mb-4"><i class="fas fa-rocket me-2"></i>Getting Started</h2>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <span class="fw-bold">1</span>
                                </div>
                                <div>
                                    <h5 class="mb-2">Create Your Profile</h5>
                                    <p class="text-muted mb-0">Set up a compelling profile with your skills, experience, and portfolio.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <span class="fw-bold">2</span>
                                </div>
                                <div>
                                    <h5 class="mb-2">Browse Tasks</h5>
                                    <p class="text-muted mb-0">Find tasks that match your skills and interests in various categories.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <span class="fw-bold">3</span>
                                </div>
                                <div>
                                    <h5 class="mb-2">Submit Proposals</h5>
                                    <p class="text-muted mb-0">Write compelling proposals that showcase your expertise and approach.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <span class="fw-bold">4</span>
                                </div>
                                <div>
                                    <h5 class="mb-2">Complete & Get Paid</h5>
                                    <p class="text-muted mb-0">Deliver quality work on time and receive secure payments.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tips for Success -->
    <div class="row mb-5">
        <div class="col-lg-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="text-primary mb-4"><i class="fas fa-lightbulb me-2"></i>Tips for Success</h3>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>Complete your profile:</strong> Add a professional photo, detailed description, and showcase your best work.
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>Write personalized proposals:</strong> Address the client's specific needs and explain your approach.
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>Communicate clearly:</strong> Respond promptly and ask clarifying questions when needed.
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>Deliver on time:</strong> Meet deadlines and keep clients updated on your progress.
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>Build relationships:</strong> Provide excellent service to encourage repeat business and referrals.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="text-primary mb-4"><i class="fas fa-shield-alt me-2"></i>Safety Guidelines</h3>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                            <strong>Verify client information:</strong> Check client profiles and reviews before accepting tasks.
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                            <strong>Use platform messaging:</strong> Keep all communication within M3alam for security.
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                            <strong>Document everything:</strong> Keep records of work progress and client communications.
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                            <strong>Report issues:</strong> Contact support immediately if you encounter problems.
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                            <strong>Trust your instincts:</strong> If something feels wrong, don't hesitate to decline or report.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Information -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <h2 class="text-primary mb-4"><i class="fas fa-credit-card me-2"></i>Payment & Fees</h2>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <h5 class="mb-3">How You Get Paid</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-arrow-right text-primary me-2"></i>Payments are released when tasks are completed</li>
                                <li class="mb-2"><i class="fas fa-arrow-right text-primary me-2"></i>Funds are transferred to your account within 24-48 hours</li>
                                <li class="mb-2"><i class="fas fa-arrow-right text-primary me-2"></i>Multiple payment methods available</li>
                                <li class="mb-2"><i class="fas fa-arrow-right text-primary me-2"></i>Secure and encrypted transactions</li>
                            </ul>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h5 class="mb-3">Service Fees</h5>
                            <div class="bg-light p-3 rounded">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Basic Plan:</span>
                                    <span class="fw-bold">5% service fee</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Pro Plan:</span>
                                    <span class="fw-bold">3% service fee</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Enterprise:</span>
                                    <span class="fw-bold">Custom pricing</span>
                                </div>
                            </div>
                            <small class="text-muted mt-2 d-block">Service fees are automatically deducted from your earnings</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <h2 class="text-center mb-4">Frequently Asked Questions</h2>
            <div class="accordion" id="taskerFAQ">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            How do I increase my chances of getting hired?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#taskerFAQ">
                        <div class="accordion-body">
                            Complete your profile with a professional photo and detailed description, write personalized proposals for each task, respond quickly to client messages, and maintain a high rating by delivering quality work on time.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            What should I include in my proposal?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#taskerFAQ">
                        <div class="accordion-body">
                            Address the client's specific requirements, explain your approach and timeline, showcase relevant experience or portfolio items, provide a clear price breakdown, and ask any clarifying questions.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            How long does it take to get paid?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#taskerFAQ">
                        <div class="accordion-body">
                            Once a task is marked as completed and approved by the client, payment is typically processed within 24-48 hours. The exact timing may vary depending on your chosen payment method.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            What if there's a dispute with a client?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#taskerFAQ">
                        <div class="accordion-body">
                            Contact our support team immediately. We have a dispute resolution process that reviews all communications and work delivered. Keep detailed records of your work and all client interactions to support your case.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="text-center py-5 bg-primary text-white rounded">
        <h3 class="mb-3">Ready to Start Earning?</h3>
        <p class="mb-4">Join thousands of successful taskers on M3alam today!</p>
        // Around line 234, update:
        <a href="{{ localized_route('tasks.index') }}" class="btn btn-outline-light btn-lg">Browse Tasks</a>
        // Around line 233, also update:
        <a href="{{ localized_route('register') }}" class="btn btn-light btn-lg me-3">Sign Up as Tasker</a>
    </div>
</div>
@endsection