@extends('web.layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Laravel Blade Admin Panel</h1>
            <p class="lead mb-4">A ready-to-use admin starter template with pre-built CRUD operations. Clone and start
                building your next project in minutes!</p>
            {{-- <div class="d-flex justify-content-center gap-3">
                <button class="btn btn-light btn-lg px-4">
                    <i class="fas fa-download me-2"></i>Download Now
                </button>
                <button class="btn btn-outline-light btn-lg px-4">
                    <i class="fas fa-book me-2"></i>Documentation
                </button>
            </div> --}}
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Why Use This Template?</h2>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h4>Quick Start</h4>
                    <p class="text-muted">Clone and start coding immediately. No need to rebuild common CRUDs from
                        scratch.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h4>Pre-built Modules</h4>
                    <p class="text-muted">Includes essential modules like user management, roles, locations, and media
                        handling.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h4>Blade Templates</h4>
                    <p class="text-muted">Clean and responsive Blade templates ready for customization.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Modules Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Included Modules</h2>
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="card module-card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Dashboard</h5>
                            <p class="card-text text-muted">Overview with statistics and quick access to key features.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card module-card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-globe fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Countries</h5>
                            <p class="card-text text-muted">Full CRUD operations for country management.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card module-card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marker-alt fa-3x text-warning mb-3"></i>
                            <h5 class="card-title">States</h5>
                            <p class="card-text text-muted">Manage states with relationship to countries.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card module-card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-city fa-3x text-info mb-3"></i>
                            <h5 class="card-title">Cities</h5>
                            <p class="card-text text-muted">City management linked to states and countries.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card module-card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-3x text-danger mb-3"></i>
                            <h5 class="card-title">Users</h5>
                            <p class="card-text text-muted">Complete user management system with authentication.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card module-card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-user-shield fa-3x text-secondary mb-3"></i>
                            <h5 class="card-title">Roles</h5>
                            <p class="card-text text-muted">Role-based access control and permissions.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card module-card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-images fa-3x text-purple mb-3"></i>
                            <h5 class="card-title">Media</h5>
                            <p class="card-text text-muted">Media library for managing uploads and files.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card module-card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-cog fa-3x text-dark mb-3"></i>
                            <h5 class="card-title">Settings</h5>
                            <p class="card-text text-muted">Application configuration and preferences.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Stack Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Tech Stack</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-0 shadow">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fab fa-laravel fa-2x text-danger me-3"></i>
                                        <div>
                                            <h5 class="mb-0">Laravel</h5>
                                            <small class="text-muted">PHP Framework</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-code fa-2x text-primary me-3"></i>
                                        <div>
                                            <h5 class="mb-0">Blade Templates</h5>
                                            <small class="text-muted">Templating Engine</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fab fa-bootstrap fa-2x text-purple me-3"></i>
                                        <div>
                                            <h5 class="mb-0">Bootstrap 5</h5>
                                            <small class="text-muted">CSS Framework</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-database fa-2x text-success me-3"></i>
                                        <div>
                                            <h5 class="mb-0">MySQL</h5>
                                            <small class="text-muted">Database</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-4 fw-bold">Ready to Start Your Next Project?</h2>
            <p class="lead text-muted mb-4">Clone this template and save hours of development time</p>
            {{-- <button class="btn btn-primary btn-lg px-5">
                <i class="fab fa-github me-2"></i>Clone Repository
            </button> --}}
        </div>
    </section>
@endsection
