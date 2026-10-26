<?php
$pageTitle = 'Events';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <p class="eyebrow">FIND YOUR NEXT THING</p>
        <h1>Good things happen <em>here.</em></h1>
        <p>
            Discover workshops, seminars and student activities.
            Search, filter, sort and explore.
        </p>
    </div>
</section>

<!-- Featured Event Images -->

<section class="section-pad">
    <div class="container">


    <div class="featured-events">

        <!-- Web Development Bootcamp -->
        <article class="featured-event-card">
            <img
                src="images/web-development.png"
                alt="Web Development Bootcamp"
                class="featured-event-image"
                loading="lazy"
            >
            <div class="featured-event-info">
                <p class="eyebrow">WEB DEVELOPMENT</p>
                <h2>Web Development Bootcamp</h2>
                <p>
                    Learn the fundamentals of building websites
                    using HTML, CSS, JavaScript and modern web technologies.
                </p>
            </div>
        </article>

        <!-- Project Showcase -->
        <article class="featured-event-card">
            <img
                src="images/project-showcase.png"
                alt="Students presenting their projects"
                class="featured-event-image"
                loading="lazy"
            >
            <div class="featured-event-info">
                <p class="eyebrow">STUDENT INNOVATION</p>
                <h2>Project Showcase</h2>
                <p>
                    Explore creative student projects, discover new ideas
                    and celebrate innovation and teamwork.
                </p>
            </div>
        </article>

        <!-- Networking Fundamentals -->
        <article class="featured-event-card">
            <img
                src="images/networking-fundamentals.png"
                alt="Computer networking fundamentals session"
                class="featured-event-image"
                loading="lazy"
            >
            <div class="featured-event-info">
                <p class="eyebrow">COMPUTER NETWORKING</p>
                <h2>Networking Fundamentals</h2>
                <p>
                    Discover network protocols, communication systems
                    and the fundamentals of computer networking.
                </p>
            </div>
        </article>

    </div>

</div>


</section>

<!-- Search, Filter and Sort Events -->

<section class="section-pad events-list-section">
    <div class="container">


    <div class="event-toolbar">

        <label class="search-box">
            <span>⌕</span>
            <input
                id="eventSearch"
                type="search"
                placeholder="Search events..."
                aria-label="Search events"
            >
        </label>

        <select id="eventCategory" aria-label="Filter by category">
            <option value="">All categories</option>
        </select>

        <select id="eventSort" aria-label="Sort events">
            <option value="date-asc">Date: soonest</option>
            <option value="date-desc">Date: latest</option>
            <option value="title-asc">Title: A–Z</option>
        </select>

    </div>

    <div id="eventStatus" class="muted" aria-live="polite">
        Loading events…
    </div>

    <div id="eventGrid" class="event-grid"></div>

    <div id="eventPagination" class="pagination"></div>

</div>


</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
