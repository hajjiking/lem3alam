@extends('layouts.app')

@section('title', 'Success Stories - M3alam')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary mb-3">Success Stories</h1>
        <p class="lead text-muted">Real stories from our community of clients and taskers who found success on M3alam</p>
    </div>

    <!-- Featured Success Story -->
    <div class="row mb-5">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow-lg">
                <div class="row g-0">
                    <div class="col-md-4">
                        <div class="bg-primary h-100 d-flex align-items-center justify-content-center">
                            <div class="text-center text-white p-4">
                                <i class="fas fa-star fa-3x mb-3"></i>
                                <h4>Featured Story</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-5">
                            <h3 class="text-primary mb-3">From Startup to Success</h3>
                            <p class="text-muted mb-4">"M3alam helped me find the perfect developer for my startup. Within 3 months, we launched our app and secured our first round of funding. The quality of talent on this platform is exceptional."</p>
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Sarah Ahmed</h6>
                                    <small class="text-muted">Tech Startup Founder</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Stories Grid -->
    <div class="row">
        <!-- Client Success Stories -->
        <div class="col-lg-6 mb-4">
            <h2 class="text-primary mb-4"><i class="fas fa-briefcase me-2"></i>Client Success Stories</h2>
            
            <!-- Story 1 -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-2">E-commerce Website Development</h5>
                            <p class="text-muted mb-3">"I needed a complete e-commerce solution for my business. The tasker I hired delivered beyond my expectations, creating a beautiful, functional website that increased my sales by 200%."</p>
                            <div class="d-flex align-items-center">
                                <strong class="text-primary me-2">Mohamed Hassan</strong>
                                <span class="text-muted">- Business Owner</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <small class="text-muted">Project Value: 25,000 MAD</small>
                    </div>
                </div>
            </div>

            <!-- Story 2 -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-2">Marketing Campaign Design</h5>
                            <p class="text-muted mb-3">"The graphic designer I found created an amazing brand identity for my restaurant. Our customer engagement increased significantly after implementing the new design."</p>
                            <div class="d-flex align-items-center">
                                <strong class="text-primary me-2">Fatima Al-Zahra</strong>
                                <span class="text-muted">- Restaurant Owner</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <small class="text-muted">Project Value: 8,000 MAD</small>
                    </div>
                </div>
            </div>

            <!-- Story 3 -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-2">Mobile App Development</h5>
                            <p class="text-muted mb-3">"Working with a tasker from M3alam was the best decision for our mobile app project. The app now has over 10,000 downloads and excellent user reviews."</p>
                            <div class="d-flex align-items-center">
                                <strong class="text-primary me-2">Omar Khalil</strong>
                                <span class="text-muted">- Entrepreneur</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <small class="text-muted">Project Value: 50,000 MAD</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasker Success Stories -->
        <div class="col-lg-6 mb-4">
            <h2 class="text-primary mb-4"><i class="fas fa-users me-2"></i>Tasker Success Stories</h2>
            
            <!-- Story 1 -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-2">Full-Time Freelancer Success</h5>
                            <p class="text-muted mb-3">"M3alam allowed me to transition from a 9-5 job to full-time freelancing. I now earn 3x more than my previous salary and have complete control over my schedule."</p>
                            <div class="d-flex align-items-center">
                                <strong class="text-success me-2">Ahmed Mansour</strong>
                                <span class="text-muted">- Web Developer</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <small class="text-muted">150+ Completed Projects</small>
                    </div>
                </div>
            </div>

            <!-- Story 2 -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-2">Building a Design Agency</h5>
                            <p class="text-muted mb-3">"Starting as a solo designer on M3alam, I built relationships with clients and now run a 5-person design agency. The platform gave me the foundation to grow my business."</p>
                            <div class="d-flex align-items-center">
                                <strong class="text-success me-2">Layla Ibrahim</strong>
                                <span class="text-muted">- Graphic Designer</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <small class="text-muted">200+ Completed Projects</small>
                    </div>
                </div>
            </div>

            <!-- Story 3 -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-2">International Opportunities</h5>
                            <p class="text-muted mb-3">"Through M3alam, I've worked with clients from 15 different countries. It opened doors to international opportunities I never thought possible from my home in Cairo."</p>
                            <div class="d-flex align-items-center">
                                <strong class="text-success me-2">Youssef Nader</strong>
                                <span class="text-muted">- Content Writer</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <small class="text-muted">300+ Completed Projects</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="row mt-5 mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body p-5 text-center">
                    <h2 class="text-primary mb-4">Our Community Impact</h2>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="h2 text-primary fw-bold">10,000+</div>
                            <p class="text-muted mb-0">Successful Projects</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="h2 text-primary fw-bold">5,000+</div>
                            <p class="text-muted mb-0">Happy Clients</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="h2 text-primary fw-bold">3,000+</div>
                            <p class="text-muted mb-0">Skilled Taskers</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="h2 text-primary fw-bold">98%</div>
                            <p class="text-muted mb-0">Satisfaction Rate</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="text-center py-5 bg-primary text-white rounded">
        <h3 class="mb-3">Ready to Write Your Success Story?</h3>
        <p class="mb-4">Join thousands of successful clients and taskers on M3alam today!</p>
        // Line 266: Update register link
        <a href="{{ localized_route('register') }}" class="btn btn-light btn-lg me-3">Get Started</a>
        // Around line 267, update:
        <a href="{{ localized_route('tasks.index') }}" class="btn btn-outline-light btn-lg">Browse Tasks</a>
    </div>
</div>
@endsection