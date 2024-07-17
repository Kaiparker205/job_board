@extends("layouts.default")
@section("content")
<main style="min-height: 50vh">
    <section class="job-board">
        <div class="hero">
            <img src="{{asset('images/hero_1.jpg')}}" alt="Job Board Hero Image">
            <div class="overlay-text">
                <h1>The Easiest Way to Get Your Dream Job</h1>
                <p>Explore job opportunities, connect with employers, and take the next step in your career.</p>
                <p>Our job portal offers:</p>
                <ul>
                    <li>Customized job search</li>
                    <li>Resume building tools</li>
                    <li>Interview tips and resources</li>
                    <li>Networking opportunities</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="job-stats bg-dark text-light">
        <h1 class="text text-center">JobBoard</h1>
        <p>Explore job opportunities, connect with employers, and take the next step in your career.</p>
        <div class="stats-container">
            <div class="stat-item">
                <span class="stat-number">{{ $totalCondidates }}</span>
                <span class="stat-label">Candidates</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $totalApplications }}</span>
                <span class="stat-label">Jobs Posted</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{ $totalJobs }}</span>
                <span class="stat-label">Jobs </span>
            </div>
            <div class="stat-item">
                <span class="stat-number">{{  $companyies }}</span>
                <span class="stat-label">Companies</span>
            </div>
        </div>
        <p class="date-text">As of April 1, 2024</p>
    </section>
    <hr class="bg-light border-2 border-top border-light">

    <section class="bg-dark text-light">

        <h1 class="services-title">Our Services</h1>
        <div class="services">
            <div class="service btn-outline-dark">
                <h2>Resume Building</h2>
                <p>Create professional resumes that stand out.</p>
            </div>
            <div class="service btn-outline-dark">
                <h2>Job Search</h2>
                <p>Find relevant job opportunities tailored to your skills.</p>
            </div>
            <div class="service btn-outline-dark">
                <h2>Interview Prep</h2>
                <p>Get ready for interviews with expert tips and mock sessions.</p>
            </div>
        </div>
    </section>
</main>
@endsection
