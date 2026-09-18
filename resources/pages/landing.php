<?php
$config = require __DIR__ . '/../../config/data.php';
$project = $config['projects'][0];
$title = 'Kallani - Operating System for Productive Natural Assets';

$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$basePrefix = (strpos($currentPath, '/kallani/public') === 0) ? '/kallani/public' : '';

ob_start();
?>

<style>
    @keyframes heroFadeInUp {
        0% {
            opacity: 0;
            transform: translateY(35px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-title-anim {
        animation: heroFadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) 0.15s both;
    }
    .hero-sub-anim {
        animation: heroFadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) 0.35s both;
    }
    .hero-desc-anim {
        animation: heroFadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) 0.55s both;
    }
    .hero-btn-anim {
        animation: heroFadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) 0.75s both;
    }

    /* Scroll Reveal Animation System */
    .reveal-on-scroll {
        opacity: 0;
        transform: translateY(35px);
        transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1), transform 0.85s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: opacity, transform;
    }

    .reveal-on-scroll.is-revealed {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<!-- Full Screen Viewport Hero Section -->
<section class="relative w-full min-h-[calc(100vh-73px)] flex items-center justify-center text-center overflow-hidden bg-cover bg-center shadow-md" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.40) 0%, rgba(13, 20, 11, 0.75) 100%), url('<?php echo $basePrefix; ?>/lanskap-sawi_Miftahurrohman.jpg');">
    <!-- Gradient Overlay for Contrast -->
    <div class="absolute inset-0 bg-black/20 pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-5xl mx-auto px-6 py-16">
        <h1 class="text-6xl md:text-8xl font-extrabold text-white tracking-tight mb-6 drop-shadow-lg hero-title-anim">KALLANI</h1>
        <p class="text-2xl md:text-4xl font-semibold text-emerald-300 mb-8 drop-shadow-md max-w-4xl mx-auto hero-sub-anim">Operating System for Productive Natural Assets</p>
        <p class="text-lg md:text-xl text-gray-100 max-w-3xl mx-auto mb-12 leading-relaxed drop-shadow hero-desc-anim">A unified operating layer for managing physical assets, project operations, verification, capital allocation, revenue distribution, ESG and auditability.</p>
        
        <div class="flex flex-wrap gap-5 justify-center items-center hero-btn-anim">
            <a href="<?php echo $basePrefix; ?>/explore" class="btn-primary text-lg px-8 py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:shadow-emerald-500/40">Explore Kallani</a>
            <a href="<?php echo $basePrefix; ?>/projects/north-kalimantan-palm" class="btn-secondary text-lg px-8 py-4 bg-white/20 hover:bg-white/30 text-white font-bold rounded-xl border border-white/40 backdrop-blur-md transition-all duration-300 transform hover:-translate-y-1">View North Kalimantan Project</a>
        </div>
    </div>
</section>

<!-- Main Page Content Container -->
<div class="max-w-7xl mx-auto px-6 py-12">
    <!-- System Flow Section -->
    <section class="py-16 bg-gradient-to-b from-kallani-muted/80 to-kallani-muted rounded-3xl p-6 md:p-12 my-12 border border-kallani-border/80 shadow-md">
        <div class="text-center max-w-3xl mx-auto mb-12 reveal-on-scroll">
            <span class="px-3.5 py-1 rounded-full text-xs font-extrabold uppercase tracking-widest bg-emerald-600/10 text-emerald-700 dark:text-emerald-400 border border-emerald-600/20 inline-block mb-3">End-to-End Operating Pipeline</span>
            <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight text-kallani-text mb-4">The Kallani Operating Model</h2>
            <p class="text-base md:text-lg text-kallani-text-secondary">An integrated 8-stage architecture connecting physical natural assets directly to verification, capital allocation, revenue distribution, and institutional auditability.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" x-data="{ activeFlow: null }">
            <?php
            $flows = [
                [
                    'step' => '01',
                    'title' => 'Physical Asset',
                    'subtitle' => 'Land & Concession Base',
                    'description' => 'The physical foundation of the project: land, plantation, infrastructure and other productive assets.',
                    'icon' => '<svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5a2.5 2.5 0 002.5-2.5V11a2 2 0 002-2h.055M16.5 21a9.004 9.004 0 008.5-6.5M12 3a9 9 0 100 18 9 9 0 000-18z"/></svg>'
                ],
                [
                    'step' => '02',
                    'title' => 'Project',
                    'subtitle' => 'Governance & Permits',
                    'description' => 'Project structure, governance, legal permits, and stakeholder alignment.',
                    'icon' => '<svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>'
                ],
                [
                    'step' => '03',
                    'title' => 'Operations',
                    'subtitle' => 'Real-Time Field Execution',
                    'description' => 'Real-time operational visibility, harvest tracking, and execution monitoring.',
                    'icon' => '<svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>'
                ],
                [
                    'step' => '04',
                    'title' => 'Verification',
                    'subtitle' => 'Independent GIS Attestation',
                    'description' => 'Independent satellite verification, GIS surveys, and asset attestation.',
                    'icon' => '<svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>'
                ],
                [
                    'step' => '05',
                    'title' => 'Capital',
                    'subtitle' => 'Target & Allocation Ledger',
                    'description' => 'Capital requirements, allocation, commitment ledgers, and financing coordination.',
                    'icon' => '<svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                ],
                [
                    'step' => '06',
                    'title' => 'Revenue',
                    'subtitle' => 'Harvest Yield Recording',
                    'description' => 'Revenue generation tracking, sales reporting, and cashflow monitoring.',
                    'icon' => '<svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>'
                ],
                [
                    'step' => '07',
                    'title' => 'Distribution',
                    'subtitle' => 'Waterfall & Payout Ledger',
                    'description' => 'Revenue waterfall and distributable proceeds calculation for stakeholders.',
                    'icon' => '<svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>'
                ],
                [
                    'step' => '08',
                    'title' => 'ESG & Audit',
                    'subtitle' => 'Immutable Audit & Metrics',
                    'description' => 'Environmental, social, governance metrics and complete auditability.',
                    'icon' => '<svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>'
                ],
            ];
            foreach ($flows as $index => $flow):
            ?>
            <div class="card cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-lg p-6 relative group overflow-hidden border border-kallani-border flex flex-col justify-between reveal-on-scroll" 
                 style="transition-delay: <?php echo ($index % 4) * 100; ?>ms;"
                 @click="activeFlow = activeFlow === <?php echo $index; ?> ? null : <?php echo $index; ?>" 
                 :class="activeFlow === <?php echo $index; ?> ? 'ring-2 ring-emerald-600 dark:ring-emerald-400 bg-emerald-50/30 dark:bg-emerald-950/20' : ''">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center font-bold text-xs text-emerald-800 dark:text-emerald-300 border border-emerald-300/30">
                            <?php echo $flow['step']; ?>
                        </span>
                        <div class="p-2.5 rounded-xl bg-kallani-muted group-hover:bg-emerald-100 dark:group-hover:bg-emerald-900/50 transition-colors">
                            <?php echo $flow['icon']; ?>
                        </div>
                    </div>
                    <h4 class="font-bold text-lg text-kallani-accent mb-1 group-hover:text-emerald-600 transition-colors"><?php echo $flow['title']; ?></h4>
                    <p class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 mb-3 uppercase tracking-wider"><?php echo $flow['subtitle']; ?></p>
                    <p class="text-xs md:text-sm text-kallani-text-secondary leading-relaxed">
                        <?php echo $flow['description']; ?>
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-kallani-border/50 flex items-center justify-between text-xs font-semibold text-emerald-700 dark:text-emerald-400">
                    <span>Stage <?php echo $flow['step']; ?></span>
                    <span class="transform group-hover:translate-x-1 transition-transform">→</span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 reveal-on-scroll">Platform Capabilities</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $features = [
                ['title' => 'Asset Intelligence', 'description' => 'Comprehensive physical asset identification, tracking, and geographic visualization.'],
                ['title' => 'Operational Visibility', 'description' => 'Real-time monitoring of project execution, infrastructure development, and plantation activities.'],
                ['title' => 'Verification', 'description' => 'Independent verification of land identity, surveys, ownership, and legal documentation.'],
                ['title' => 'Capital Coordination', 'description' => 'Project capital requirements, allocation tracking, and commitment management.'],
                ['title' => 'Revenue & Distribution', 'description' => 'Transparent revenue waterfall and distributable proceeds calculation.'],
                ['title' => 'ESG & Risk', 'description' => 'Environmental impact, social metrics, governance controls, and risk monitoring.'],
                ['title' => 'Auditability', 'description' => 'Complete audit trail of all project events, updates, and changes.'],
                ['title' => 'Institutional Grade', 'description' => 'Enterprise-level data security, controls, and professional presentation.'],
            ];
            foreach ($features as $index => $feature):
            ?>
            <div class="card hover:shadow-md transition-shadow reveal-on-scroll" style="transition-delay: <?php echo ($index % 3) * 100; ?>ms;">
                <h4 class="font-bold text-kallani-accent mb-3"><?php echo $feature['title']; ?></h4>
                <p class="text-kallani-text-secondary"><?php echo $feature['description']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Project Preview -->
    <section class="py-16">
        <h2 class="text-3xl md:text-4xl font-bold mb-10 reveal-on-scroll">Demonstration Project</h2>
        <div class="card p-6 md:p-8 shadow-sm reveal-on-scroll">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-bold mb-4"><?php echo $project['name']; ?></h3>
                    <p class="text-kallani-text-secondary mb-2"><?php echo $project['location']; ?></p>
                    <p class="text-kallani-text-secondary mb-6"><?php echo $project['asset_type']; ?> • <?php echo number_format($project['area']); ?> Ha</p>
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between">
                            <span class="text-kallani-text-secondary">Verification</span>
                            <span class="font-bold"><?php echo $project['verification']; ?>%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?php echo $project['verification']; ?>%"></div>
                        </div>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between">
                            <span class="text-kallani-text-secondary">Capital Committed</span>
                            <span class="font-bold">$<?php echo number_format($project['capital_committed'] / 1000000, 1); ?>M</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?php echo ($project['capital_committed'] / $project['capital_required']) * 100; ?>%"></div>
                        </div>
                    </div>
                    <a href="<?php echo $basePrefix; ?>/projects/north-kalimantan-palm" class="btn-primary">View Project →</a>
                </div>
                <div class="bg-kallani-muted rounded-xl p-8 border border-kallani-border">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="stat-card">
                            <div class="stat-value"><?php echo number_format($project['area']); ?></div>
                            <div class="stat-label">Hectares</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value"><?php echo $project['verification']; ?>%</div>
                            <div class="stat-label">Verified</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value">$<?php echo number_format($project['capital_required'] / 1000000, 0); ?>M</div>
                            <div class="stat-label">Required</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value"><?php echo number_format($project['projected_output']); ?></div>
                            <div class="stat-label">Tonnes/Year</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 text-center bg-gradient-to-br from-emerald-900/10 via-kallani-muted to-emerald-950/20 rounded-2xl p-10 border border-kallani-border my-12 reveal-on-scroll">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Explore Kallani?</h2>
        <p class="text-lg text-kallani-text-secondary mb-10 max-w-2xl mx-auto">Discover how Kallani connects physical assets to operations, verification, capital, and revenue through a unified operating system.</p>
        <a href="<?php echo $basePrefix; ?>/explore" class="btn-primary text-lg px-8 py-3.5 shadow-md">Start Exploring</a>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -40px 0px',
            threshold: 0.1
        };

        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal-on-scroll').forEach(el => {
            revealObserver.observe(el);
        });
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>


