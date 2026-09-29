<?php
ob_start();
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$constants = $config['system_constants'] ?? [];
$title = '22 / Participant Network — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'participant-network';

/* ---------- Helpers & Icons ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$svg = fn(string $inner, string $cls = 'w-4 h-4') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'star'      => '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>',
    'check'     => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'shield'    => '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
    'user'      => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    'building'  => '<path d="M4 21V7l8-4v18"/><path d="M20 21V11l-8-4"/><path d="M8 9h.01"/><path d="M8 13h.01"/><path d="M8 17h.01"/>',
    'globe'     => '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
    'arrow'     => '<path d="M5 12h14M12 5l7 7-7 7"/>',
    'filter'    => '<polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>',
    'layers'    => '<polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>',
    'award'     => '<circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>',
    'info'      => '<circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>',
    'close'     => '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',
    'seed'      => '<path d="M12 22c5-3 8-8 8-13a8 8 0 0 0-16 0c0 5 3 10 8 13z"/><path d="M12 22V9"/>',
    'orbit'     => '<circle cx="12" cy="12" r="3"/><ellipse cx="12" cy="12" rx="10" ry="4.5"/>',
    'stars'     => '<path d="M12 2v4M12 18v4M4.9 4.9l2.8 2.8M16.3 16.3l2.8 2.8M2 12h4M18 12h4M4.9 19.1l2.8-2.8M16.3 7.7l2.8-2.8"/><circle cx="12" cy="12" r="3"/>',
    'crown'     => '<path d="M3 18h18l-1.5-9-4.5 4-3-7-3 7-4.5-4L3 18z"/>',
    'bank'      => '<path d="M4 21V7l8-4v18"/><path d="M20 21V11l-8-4"/><path d="M2 21h20"/>',
    'reputation'=> '<path d="M12 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/><path d="M8.5 13.5L6 21l6-3 6 3-2.5-7.5"/>',
    'calendar'  => '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
];

$card      = 'rounded-xl border border-white/10 bg-[#0B1815]/90 shadow-xl';
$metricLbl = 'text-[9px] font-mono font-medium uppercase tracking-wider text-gray-400';

/* ---------- Tier definitions (used to drive section 02) ---------- */
$tiers = [
    ['key' => 'NOVA', 'no' => '01', 'icon' => $ic['seed'], 'color' => 'emerald', 'label' => 'Entry Network Participant', 'threshold' => '≥ US$8,000', 'desc' => 'PO Allocation Unit:'],
    ['key' => 'ORBIT', 'no' => '02', 'icon' => $ic['orbit'], 'color' => 'sky', 'label' => 'Established Network Participant', 'threshold' => '≥ US$18,000', 'desc' => 'PO Allocation Unit:'],
    ['key' => 'CONSTELLATION', 'no' => '03', 'icon' => $ic['stars'], 'color' => 'purple', 'label' => 'Advanced Network Participant', 'threshold' => '≥ US$28,000', 'desc' => 'PO Allocation Unit:'],
    ['key' => 'SOVEREIGN', 'no' => '04', 'icon' => $ic['crown'], 'color' => 'amber', 'label' => 'High-Capacity Private Participant', 'threshold' => '≥ US$88,000', 'desc' => 'PO Allocation Unit:'],
    ['key' => 'INSTITUTIONAL', 'no' => '05', 'icon' => $ic['bank'], 'color' => 'cyan', 'label' => 'Qualified Institutional Participant', 'threshold' => '≥ US$280,000', 'desc' => 'PO Allocation Unit:'],
];
$tierColorMap = [
    'emerald' => ['ring' => 'border-emerald-500/30 hover:border-emerald-400', 'chip' => 'bg-emerald-950 text-emerald-300 border-emerald-500/30', 'ic' => 'bg-emerald-950 text-emerald-300 border-emerald-500/40', 'bar' => 'bg-emerald-400'],
    'sky'     => ['ring' => 'border-sky-500/30 hover:border-sky-400', 'chip' => 'bg-sky-950 text-sky-300 border-sky-500/30', 'ic' => 'bg-sky-950 text-sky-300 border-sky-500/40', 'bar' => 'bg-sky-400'],
    'purple'  => ['ring' => 'border-purple-500/30 hover:border-purple-400', 'chip' => 'bg-purple-950 text-purple-300 border-purple-500/30', 'ic' => 'bg-purple-950 text-purple-300 border-purple-500/40', 'bar' => 'bg-purple-400'],
    'amber'   => ['ring' => 'border-amber-500/30 hover:border-amber-400', 'chip' => 'bg-amber-950 text-amber-300 border-amber-500/30', 'ic' => 'bg-amber-950 text-amber-300 border-amber-500/40', 'bar' => 'bg-amber-400'],
    'cyan'    => ['ring' => 'border-cyan-500/30 hover:border-cyan-400', 'chip' => 'bg-cyan-950 text-cyan-300 border-cyan-500/30', 'ic' => 'bg-cyan-950 text-cyan-300 border-cyan-500/40', 'bar' => 'bg-cyan-400'],
];

/* ---------- Entity class distribution (derived summary for section 04) ---------- */
$entityClassDist = [
    ['label' => 'Private', 'count' => 4],
    ['label' => 'Private Office', 'count' => 2],
    ['label' => 'Family Office', 'count' => 2],
    ['label' => 'Private Equity', 'count' => 2],
    ['label' => 'Hedge Fund', 'count' => 1],
    ['label' => 'Asset Manager', 'count' => 4],
    ['label' => 'Institutional Capital', 'count' => 3],
    ['label' => 'Sovereign', 'count' => 3],
    ['label' => 'Public / State', 'count' => 2],
    ['label' => 'Financial Institution', 'count' => 2],
    ['label' => 'Corporate', 'count' => 3],
];

/* ---------- 28 PARTICIPANT SIMULATED & ILLUSTRATIVE RECORDS ---------- */
$participants = require __DIR__ . '/../data/participants.php';

// Dynamically compute tier counts based on exact participant allocation history
$tierCounts = ['NOVA' => 0, 'ORBIT' => 0, 'CONSTELLATION' => 0, 'SOVEREIGN' => 0, 'INSTITUTIONAL' => 0];
foreach ($participants as $p) {
    if (isset($tierCounts[$p['tier']])) {
        $tierCounts[$p['tier']]++;
    }
}
foreach ($tiers as &$t) {
    $t['count'] = $tierCounts[$t['key']] ?? 0;
}
unset($t);

$tierBadgeCls = [
    'NOVA' => 'bg-emerald-950 border-emerald-500/40 text-emerald-300',
    'ORBIT' => 'bg-sky-950 border-sky-500/40 text-sky-300',
    'CONSTELLATION' => 'bg-purple-950 border-purple-500/40 text-purple-300',
    'SOVEREIGN' => 'bg-amber-950 border-amber-500/40 text-amber-300',
    'INSTITUTIONAL' => 'bg-cyan-950 border-cyan-500/40 text-cyan-300',
];

ob_start();
?>

<div class="relative w-full font-sans pb-16" x-data="{
    filterClass: 'ALL',
    selectedParticipant: null,
    drawerOpen: false,

    init() {
        this.$watch('drawerOpen', value => {
            const el = document.querySelector('.flex-1.overflow-y-auto');
            if(el) el.style.overflow = value ? 'hidden' : 'auto';
        });
    },
    openDetail(p) {
        this.selectedParticipant = p;
        this.drawerOpen = true;
    },
    
    getHistory(p) {
        if (!p) return [];
        let total = p.allocations;
        let unitPrice = parseInt((p.unit || '0').replace(/[^0-9]/g, ''));
        let history = [];
        if (total === 1) {
            history.push({ name: 'Project NINA-P-01 / Batch A', units: 1, amount: unitPrice });
        } else if (total === 2) {
            history.push({ name: 'Project NINA-P-01 / Batch A', units: 2, amount: unitPrice * 2 });
        } else if (total === 3) {
            history.push({ name: 'Project NINA-P-01 / Batch A', units: 2, amount: unitPrice * 2 });
            history.push({ name: 'Project NINA-P-02 / Batch B', units: 1, amount: unitPrice });
        } else if (total > 3) {
            let chunk1 = Math.floor(total * 0.3) || 1;
            let chunk2 = Math.floor(total * 0.2) || 1;
            let chunk3 = total - chunk1 - chunk2;
            history.push({ name: 'Project NINA-P-01 / Batch A', units: chunk1, amount: unitPrice * chunk1 });
            history.push({ name: 'Project NINA-P-02 / Batch B', units: chunk2, amount: unitPrice * chunk2 });
            history.push({ name: 'Project NINA-P-03 / Batch C', units: chunk3, amount: unitPrice * chunk3 });
        }
        return history.reverse(); // Newest first
    }
}">

    <!-- PAGE BACKGROUND -->
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
        <img src="<?= $basePrefix ?>/1.jpg" alt="" class="h-full w-full scale-110 object-cover opacity-25 blur-md" />
        <div class="absolute inset-0 bg-gradient-to-b from-[#06120F]/60 via-[#06120F]/85 to-[#04100B]"></div>
    </div>

    <!-- ================= 01. PAGE HEADER & HERO (No horizontal padding on outer, padded inside) ================= -->
    <div class="relative z-10 space-y-6">
        <section class="relative overflow-hidden rounded-2xl border border-white/10 shadow-2xl">
            <img src="<?= $basePrefix ?>/1.jpg" alt="Natural forest canopy" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/85 via-[#050D07]/45 to-[#050D07]/10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#06120F]/80 via-transparent to-transparent"></div>

            <div class="relative space-y-4 px-6 pt-6 pb-8 lg:px-8">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                        <span class="font-bold text-emerald-300">22 / PARTICIPANT NETWORK</span>
                    </nav>

                    <span class="rounded border border-amber-400/40 bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold tracking-wider text-amber-300 uppercase flex items-center gap-1.5 w-fit">
                        <?= $svg($ic['info'], 'w-3 h-3 text-amber-400') ?> DEMO / SIMULATION ENVIRONMENT
                    </span>
                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-center">
                    <div class="space-y-4 lg:col-span-8">
                        <div class="space-y-2">
                            <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">
                                Participation Across<br class="hidden sm:block" /> the NINA Network.
                            </h1>
                            <p class="max-w-2xl text-sm font-medium leading-relaxed text-gray-200">
                                From private participants and family offices to funds, institutional capital and sovereign-scale organizations, NINA provides a common operating layer for participation in productive production programs.
                            </p>
                        </div>
                        <span class="inline-flex items-center gap-1.5 rounded border border-sky-400/40 bg-sky-500/20 px-2 py-0.5 text-[9px] font-bold tracking-wider text-sky-300 uppercase w-fit">
                            <?= $svg($ic['orbit'], 'w-3 h-3 text-sky-400') ?> 100% SIMULATED — PRODUCT ARCHITECTURE DEMONSTRATION
                        </span>
                    </div>

                    <div class="lg:col-span-4">
                        <div class="space-y-2 rounded-xl border border-white/15 bg-[#08130F]/85 p-4 shadow-2xl backdrop-blur-xl">
                            <div class="text-[10px] font-mono text-gray-300 leading-relaxed">
                                All participant profiles, reviews, allocations and institutional references displayed on this page are simulated product data for demonstration purposes only.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- WRAPPER FOR ALL SECTIONS EXCEPT HEADER WITH SIDE PADDING -->
        <div class="space-y-6 px-4 sm:px-6 lg:px-8">

        <!-- ================= 02. PARTICIPANT TIER SYSTEM ================= -->
        <section class="space-y-4">
            <div class="border-b border-white/10 pb-3">
                <h2 class="text-sm font-mono font-bold uppercase tracking-wider text-white flex items-center gap-2">
                    <?= $svg($ic['award'], 'w-4 h-4 text-emerald-400') ?> PARTICIPANT TIER SYSTEM
                </h2>
                <div class="text-[11px] text-gray-300 mt-2 space-y-1">
                    <p>Current allocation denomination defines the participant's current tier.</p>
                    <p>Cumulative participation is maintained separately as historical allocation activity.</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch gap-2">
                <?php foreach ($tiers as $i => $t): $c = $tierColorMap[$t['color']]; ?>
                    <div class="<?= $card ?> <?= $c['ring'] ?> flex-1 p-4 space-y-3 text-center transition-all">
                        <div class="flex items-center justify-center">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full border <?= $c['ic'] ?>">
                                <?= $svg($t['icon'], 'w-5 h-5') ?>
                            </div>
                        </div>
                        <div>
                            <div class="text-xs font-mono font-bold text-white tracking-wider"><?= $e($t['key']) ?></div>
                        </div>
                        <div class="text-[11px] font-bold text-gray-200 leading-snug min-h-[2.2em]"><?= $e($t['label']) ?></div>
                        <div class="pt-2 border-t border-white/10 text-[10px] font-mono text-gray-400 space-y-0.5">
                            <div><?= $e($t['desc']) ?></div>
                            <div class="font-bold <?= 'text-' . $t['color'] . '-300' ?>"><?= $e($t['threshold']) ?></div>
                        </div>
                    </div>
                    <?php if ($i < count($tiers) - 1): ?>
                        <div class="hidden sm:flex items-center justify-center px-0.5 text-gray-500 shrink-0">
                            <?= $svg($ic['arrow'], 'w-4 h-4') ?>
                        </div>
                        <div class="flex sm:hidden items-center justify-center py-1.5 text-gray-500 shrink-0">
                            <?= $svg($ic['arrow'], 'w-4 h-4 rotate-90') ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ================= 03. THE NINA PARTICIPANT MODEL ================= -->
        <section class="<?= $card ?> p-5 space-y-5 mt-8">
            <div class="border-b border-white/10 pb-3">
                <h2 class="text-sm font-mono font-bold uppercase tracking-wider text-white">
                    THE NINA PARTICIPANT MODEL
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <!-- Participant Tier -->
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full border border-gray-500/40 bg-gray-900/60 text-gray-300">
                        <?= $svg($ic['layers'], 'w-5 h-5') ?>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-white uppercase tracking-wider mb-1">Participant Tier</div>
                        <p class="text-[11px] text-gray-400 leading-relaxed">Defines the participant's current allocation denomination.</p>
                    </div>
                </div>

                <!-- Entity Class -->
                <div class="flex items-start gap-4 border-t sm:border-t-0 sm:border-l border-white/10 pt-4 sm:pt-0 sm:pl-6">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full border border-gray-500/40 bg-gray-900/60 text-gray-300">
                        <?= $svg($ic['building'], 'w-5 h-5') ?>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-white uppercase tracking-wider mb-1">Entity Class</div>
                        <p class="text-[11px] text-gray-400 leading-relaxed mb-2">Identifies the participant's organizational or capital type.</p>
                        <p class="text-[9px] text-sky-400 leading-snug">Private • Family Office • Asset Manager • PE • Hedge Fund • Corporate • Sovereign • Financial Institution</p>
                    </div>
                </div>

                <!-- Project Experience -->
                <div class="flex items-start gap-4 border-t sm:border-t-0 sm:border-l border-white/10 pt-4 sm:pt-0 sm:pl-6">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full border border-gray-500/40 bg-gray-900/60 text-gray-300">
                        <?= $svg($ic['star'], 'w-5 h-5') ?>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-white uppercase tracking-wider mb-1">Project Experience</div>
                        <p class="text-[11px] text-gray-400 leading-relaxed">Measures the participant's experience with completed production projects.</p>
                    </div>
                </div>
            </div>

            <div class="pt-2 border-t border-white/10">
                <p class="text-[10px] text-gray-400">
                    Current Tier defines allocation denomination. Entity Class identifies participant type. Cumulative Participation records historical activity. Project Experience reflects completed production experience.
                </p>
            </div>
        </section>

        <!-- ================= 05. PARTICIPANT NETWORK SNAPSHOT ================= -->
        <section class="<?= $card ?> p-5 space-y-5">
            <h2 class="text-sm font-mono font-bold uppercase tracking-wider text-white flex items-center gap-2">
                <?= $svg($ic['globe'], 'w-5 h-5 text-emerald-400 shrink-0') ?> PARTICIPANT NETWORK — DEMO
            </h2>

            <!-- Stats Bar -->
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 font-mono">
                <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-2.5 min-w-0">
                    <div class="text-gray-400 p-2 rounded-lg bg-white/5 shrink-0">
                        <?= $svg($ic['user'], 'w-5 h-5') ?>
                    </div>
                    <div class="min-w-0">
                        <strong class="text-lg sm:text-xl font-extrabold text-white block leading-none truncate">28</strong>
                        <span class="text-[9px] text-gray-400 block uppercase mt-1 truncate">Profiles</span>
                    </div>
                </div>
                <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-2.5 min-w-0">
                    <div class="text-emerald-400 p-2 rounded-lg bg-emerald-950/60 border border-emerald-500/30 shrink-0">
                        <?= $svg($ic['layers'], 'w-5 h-5') ?>
                    </div>
                    <div class="min-w-0">
                        <strong class="text-lg sm:text-xl font-extrabold text-emerald-400 block leading-none truncate">5</strong>
                        <span class="text-[9px] text-gray-400 block uppercase mt-1 truncate">Participant Tiers</span>
                    </div>
                </div>
                <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-2.5 min-w-0">
                    <div class="text-purple-400 p-2 rounded-lg bg-purple-950/60 border border-purple-500/30 shrink-0">
                        <?= $svg($ic['building'], 'w-5 h-5') ?>
                    </div>
                    <div class="min-w-0">
                        <strong class="text-lg sm:text-xl font-extrabold text-purple-400 block leading-none truncate">28</strong>
                        <span class="text-[9px] text-gray-400 block uppercase mt-1 truncate">Participant Archetypes</span>
                    </div>
                </div>
                <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-2.5 min-w-0">
                    <div class="text-amber-400 p-2 rounded-lg bg-amber-950/60 border border-amber-500/30 shrink-0">
                        <?= $svg($ic['globe'], 'w-5 h-5') ?>
                    </div>
                    <div class="min-w-0">
                        <strong class="text-sm sm:text-lg font-extrabold text-amber-400 block leading-tight truncate">Multiple</strong>
                        <span class="text-[8px] sm:text-[9px] text-gray-400 block uppercase mt-0.5 truncate leading-tight">Geographic Markets</span>
                    </div>
                </div>
                <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-2.5 min-w-0 col-span-2 sm:col-span-1">
                    <div class="text-cyan-400 p-2 rounded-lg bg-cyan-950/60 border border-cyan-500/30 shrink-0">
                        <?= $svg($ic['shield'], 'w-5 h-5') ?>
                    </div>
                    <div class="min-w-0">
                        <strong class="text-lg sm:text-xl font-extrabold text-cyan-400 block leading-none truncate">100%</strong>
                        <span class="text-[9px] text-gray-400 block uppercase mt-1 truncate">Simulated</span>
                    </div>
                </div>
            </div>

            <!-- Distribution Panels -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 pt-2">
                <!-- Tier distribution bars -->
                <div class="rounded-xl border border-white/10 bg-black/30 p-4 space-y-3">
                    <div class="text-[10px] font-mono font-bold uppercase tracking-wider text-gray-300">Participant Tier Distribution</div>
                    <?php
                    $maxCount = max(array_column($tiers, 'count'));
                    foreach ($tiers as $t): $c = $tierColorMap[$t['color']]; $pct = round(($t['count'] / $maxCount) * 100);
                    ?>
                        <div class="flex items-center gap-3 text-[10px] font-mono">
                            <span class="w-28 shrink-0 font-bold <?= 'text-' . $t['color'] . '-300' ?>"><?= $e($t['key']) ?></span>
                            <div class="flex-1 h-2 rounded-full bg-white/5 overflow-hidden">
                                <div class="h-full <?= $c['bar'] ?> rounded-full" style="width: <?= $pct ?>%"></div>
                            </div>
                            <span class="w-4 text-right text-gray-300 font-bold"><?= $t['count'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Entity class distribution list -->
                <div class="rounded-xl border border-white/10 bg-black/30 p-4 space-y-2">
                    <div class="text-[10px] font-mono font-bold uppercase tracking-wider text-gray-300 mb-1">Entity Class Distribution</div>
                    <div class="grid grid-cols-2 gap-x-4 gap-y-1.5 text-[10px] font-mono">
                        <?php foreach ($entityClassDist as $ec): ?>
                            <div class="flex items-center justify-between border-b border-white/5 py-1">
                                <span class="text-gray-300"><?= $e($ec['label']) ?></span>
                                <strong class="text-white"><?= $ec['count'] ?></strong>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= 04. ENTITY CLASS FILTER ================= -->
        <section class="space-y-3">
            <div class="flex items-center justify-between text-xs font-mono uppercase text-gray-400">
                <span class="flex items-center gap-1.5 font-bold text-white">
                    <?= $svg($ic['filter'], 'w-4 h-4 text-emerald-400') ?> ENTITY CLASS FILTER
                </span>
                <span class="hidden sm:inline">Click a filter to isolate participant profiles</span>
            </div>

            <div class="flex flex-wrap items-center gap-2 font-mono text-[10px]">
                <?php
                $filters = [
                    'ALL', 'PRIVATE', 'PRIVATE OFFICE', 'FAMILY OFFICE', 'PRIVATE EQUITY',
                    'HEDGE FUND', 'ASSET MANAGER', 'CORPORATE', 'FINANCIAL INSTITUTION',
                    'PUBLIC INSTITUTION', 'INSTITUTIONAL CAPITAL'
                ];
                foreach ($filters as $flt):
                ?>
                    <button @click="filterClass = '<?= $flt ?>'"
                            :class="filterClass === '<?= $flt ?>' ? 'bg-emerald-500 text-black font-extrabold border-emerald-400' : 'bg-white/5 text-gray-300 hover:bg-white/10 border-white/10'"
                            class="rounded-lg px-3 py-1.5 border transition-all uppercase tracking-wider">
                        <?= $flt ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ================= 06. RECENT PROJECT EXPERIENCE ================= -->
        <section class="space-y-4">
            <div class="border-b border-white/10 pb-4">
                <h2 class="text-lg font-mono font-bold uppercase tracking-wider text-white flex items-center gap-2">
                    <?= $svg($ic['star'], 'w-5 h-5 text-emerald-400') ?> RECENT PROJECT EXPERIENCE
                </h2>
                <p class="text-xs text-emerald-400 font-mono mt-1">ILLUSTRATIVE PROJECT EXPERIENCE<br><span class="text-[10px] text-gray-400">Simulated production experience record for product architecture demonstration.</span></p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php 
                foreach ($participants as $idx => $p): 
                    $logoUrl = isset($p['logo']) ? $basePrefix . '/logo/' . $p['logo'] : $basePrefix . '/1.jpg';
                    $projects = ['PT. Kaltara Agro Mandiri', 'PT. Banua Palm Mandiri', 'PT. Kahayan Lestari', 'PT. Mahakam Tirta Perdana'];
                    $projName = $projects[$idx % count($projects)];
                    $batchId = 'BATCH-' . str_pad(($idx % 12) + 1, 2, '0', STR_PAD_LEFT);
                ?>
                    <div x-show="filterClass === 'ALL' || filterClass === '<?= $p['class'] ?>'"
                         class="rounded-xl border border-emerald-500/30 bg-[#040C0A] overflow-hidden shadow-2xl font-mono cursor-pointer hover:border-emerald-400/60 transition-all group flex flex-col"
                         @click="openDetail(<?= htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8') ?>)">
                         
                         <!-- Header (Institutional + NINA-R-0001) -->
                         <div class="flex items-center justify-between p-4 pb-0">
                             <span class="rounded-full px-3 py-1 text-[9px] font-bold border border-sky-500/40 text-sky-300 uppercase tracking-widest bg-sky-950/40">
                                 <?= $e($p['tier']) ?>
                             </span>
                             <span class="text-[10px] text-gray-500 uppercase tracking-widest">NINA-R-<?= str_pad($idx + 1, 4, '0', STR_PAD_LEFT) ?></span>
                         </div>
                         
                         <!-- Entity Info with Project Image -->
                         <div class="px-4 py-4 flex items-center gap-4 border-b border-emerald-500/20">
                            <div class="h-14 w-24 shrink-0 rounded-lg overflow-hidden relative border border-emerald-500/20 bg-white flex items-center justify-center p-2">
                                <img src="<?= $logoUrl ?>" onerror="this.src='<?= $basePrefix ?>/1.jpg'" class="h-full w-full object-contain" />
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-extrabold text-white tracking-tight leading-none group-hover:text-emerald-400 transition-colors uppercase"><?= $e($p['name']) ?></h3>
                                <p class="text-[11px] text-sky-200 mt-1.5 uppercase tracking-widest font-bold"><?= $e($p['role']) ?></p>
                            </div>
                            <div class="text-emerald-500/50">
                                <?= $svg($ic['arrow'], 'w-5 h-5') ?>
                            </div>
                         </div>
                         
                         <!-- Project Experience -->
                         <div class="px-4 py-4 space-y-4">
                             <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                                 <?= $svg($ic['layers'], 'w-4 h-4') ?> EXPERIENCE SCOPE
                             </div>
                             
                             <div class="text-emerald-300 text-[11px] uppercase tracking-widest font-bold pb-2 border-b border-emerald-500/20 leading-relaxed">
                                 <?= $e($p['review_scope'] ?? 'General Review Scope') ?>
                             </div>
                             
                             <div class="grid grid-cols-2 gap-y-4 gap-x-4 text-[9px] uppercase font-bold border-b border-emerald-500/20 pb-4">
                                 <div>
                                     <div class="text-gray-400 tracking-wider">Participant Tier</div>
                                     <div class="text-white mt-1 text-[11px] font-mono"><?= $e($p['tier']) ?></div>
                                 </div>
                                 <div>
                                     <div class="text-gray-400 tracking-wider">Allocation Unit</div>
                                     <div class="text-white mt-1 text-[11px] font-mono"><?= $e($p['unit']) ?> / Unit</div>
                                 </div>
                                 
                                 <div>
                                     <div class="text-gray-400 tracking-wider">Cumulative Alloc</div>
                                     <div class="text-white mt-1 text-[11px] font-mono"><?= $e($p['cum']) ?></div>
                                 </div>
                                 <div>
                                     <div class="text-gray-400 tracking-wider">Current Project Experience</div>
                                     <div class="text-emerald-300 mt-1 text-[11px] font-extrabold font-sans uppercase tracking-widest"><?= $projName ?></div>
                                     <div class="text-gray-400 mt-0.5 text-[10px] font-mono"><?= $batchId ?></div>
                                 </div>
                             </div>

                             <div class="p-4 rounded-xl border border-emerald-500/20 bg-emerald-950/10 text-[11px] text-gray-300 italic leading-relaxed">
                                 "<?= $e($p['review']) ?>"
                             </div>
                         </div>
                         
                         <!-- Score -->
                         <div class="px-4 pb-4">
                             <?php $stars = $p['stars'] ?? 4.8; ?>
                             <div class="flex items-end justify-between border-b border-emerald-500/20 pb-3 mb-4">
                                 <div class="flex items-center gap-1.5 text-[10px] font-bold text-emerald-400 uppercase tracking-widest">
                                     <?= $svg($ic['star'], 'w-4 h-4 text-amber-400') ?> EXPERIENCE SCORE
                                 </div>
                                 <div class="text-lg font-bold text-emerald-400 leading-none">
                                     <?= number_format($stars, 1) ?> <span class="text-sm text-emerald-400/50">/ 5</span>
                                 </div>
                             </div>
                             
                             <div class="text-[9px] font-bold text-emerald-400 uppercase tracking-widest mb-3">Review Breakdown</div>
                             
                             <div class="grid grid-cols-4 gap-2 text-[8px] text-gray-400 uppercase font-bold border-b border-emerald-500/20 pb-3">
                                 <div>
                                     <div>Operational<br/>Visibility</div>
                                     <div class="text-sm font-bold text-emerald-300 mt-1"><?= number_format($stars, 1) ?></div>
                                 </div>
                                 <div>
                                     <div>Documentation</div>
                                     <div class="text-sm font-bold text-emerald-300 mt-1"><?= number_format(min(5, $stars + 0.1), 1) ?></div>
                                 </div>
                                 <div>
                                     <div>Milestone<br/>Clarity</div>
                                     <div class="text-sm font-bold text-emerald-300 mt-1"><?= number_format(max(1, $stars - 0.1), 1) ?></div>
                                 </div>
                                 <div>
                                     <div>Field<br/>Evidence</div>
                                     <div class="text-sm font-bold text-emerald-300 mt-1"><?= number_format($stars, 1) ?></div>
                                 </div>
                             </div>
                         </div>
                         
                         <!-- Footer -->
                         <div class="px-4 pb-4 flex items-center justify-between text-[8px] uppercase font-bold tracking-wider">
                             <div class="flex items-center gap-1.5 text-gray-400">
                                 <?= $svg($ic['info'], 'w-3 h-3') ?> Reviewed • Sep 2026
                             </div>
                             <div class="flex items-center gap-1.5 text-emerald-400">
                                 <?= $svg($ic['shield'], 'w-3.5 h-3.5 text-emerald-400') ?> 
                                 <span class="leading-tight text-right">SIMULATED / ILLUSTRATIVE<br/>PROJECT EXPERIENCE</span>
                             </div>
                         </div>
                         
                         <?php if ($idx % 2 === 0): ?>
                         <div class="px-4 pb-4">
                             <div class="rounded-xl border border-emerald-500/20 bg-emerald-950/20 p-3 flex gap-3">
                                 <div class="h-16 w-24 shrink-0 rounded-lg relative overflow-hidden group/vid">
                                     <img src="<?= $basePrefix ?>/1.jpg" class="h-full w-full object-cover" />
                                     <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                         <div class="w-6 h-6 rounded-full bg-emerald-500/80 flex items-center justify-center pl-0.5 shadow-[0_0_10px_rgba(16,185,129,0.5)]">
                                             <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4l12 6-12 6z"/></svg>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="flex-1 space-y-1 pt-1">
                                     <div class="text-[9px] font-bold text-emerald-400 uppercase tracking-widest">Participant Testimonial</div>
                                     <div class="text-[8px] text-gray-500 uppercase font-bold">Video · 01:24</div>
                                     <div class="text-[9px] text-gray-300 italic line-clamp-2">"The transparency and traceability throughout the process gave us confidence in the outcome."</div>
                                 </div>
                             </div>
                         </div>
                         <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ================= 07. DESIGNED FOR MULTIPLE PARTICIPATION SCALES ================= -->
        <section class="relative overflow-hidden rounded-2xl border border-white/10 shadow-2xl">
            <img src="<?= $basePrefix ?>/1.jpg" alt="" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/95 via-[#050D07]/85 to-[#050D07]/60"></div>

            <div class="relative p-6 lg:p-8 space-y-5">
                <div class="text-[10px] font-mono font-bold uppercase tracking-widest text-emerald-300">Designed for Multiple Participation Scales</div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-[11px] font-mono">
                    <div>
                        <div class="font-bold text-white uppercase">Private</div>
                        <div class="text-gray-400 mt-0.5">Individual participation</div>
                    </div>
                    <div>
                        <div class="font-bold text-white uppercase">Private Capital</div>
                        <div class="text-gray-400 mt-0.5">Private office / family office</div>
                    </div>
                    <div>
                        <div class="font-bold text-white uppercase">Professional Capital</div>
                        <div class="text-gray-400 mt-0.5">PE / hedge fund / alternative fund</div>
                    </div>
                    <div>
                        <div class="font-bold text-white uppercase">Institutional Capital</div>
                        <div class="text-gray-400 mt-0.5">Asset manager / pension / insurance / corporate</div>
                    </div>
                </div>

                <h3 class="text-xl font-extrabold text-white">One operating architecture. Multiple participant classes.</h3>

                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <a href="<?= $basePrefix ?>/explore" class="rounded-lg bg-emerald-500 px-4 py-2 text-[11px] font-extrabold text-black uppercase tracking-wide hover:bg-emerald-400 transition-colors">
                        Explore Projects
                    </a>
                    <a href="<?= $basePrefix ?>/production-network" class="rounded-lg border border-white/20 bg-white/5 px-4 py-2 text-[11px] font-bold text-gray-200 uppercase tracking-wide hover:bg-white/10 transition-colors">
                        View Production Network
                    </a>
                </div>
            </div>
        </section>

        <p class="text-center text-[10px] font-mono text-gray-500 px-4">
            Participant names, institutional profiles, participation volumes, reviews, allocation records and institutional use cases shown on this page are simulated data created to demonstrate NINA's intended product architecture. References to real organizations or institutions do not constitute or imply participation, investment, partnership, endorsement, mandate, customer relationship or affiliation with NINA.
        </p>

        </div> <!-- END SIDE PADDING WRAPPER -->

        <!-- ================= PARTICIPANT RECORD DETAIL MODAL (CENTERED) ================= -->
        <div x-show="drawerOpen"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-black/80 backdrop-blur-md"
             x-cloak>
             
            <!-- Modal Backdrop Area (Click to Close) -->
            <div class="absolute inset-0" @click="drawerOpen = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"></div>

            <!-- Modal Container -->
            <div class="relative z-10 w-full max-w-sm sm:max-w-md lg:max-w-4xl bg-[#020A10] border border-emerald-500/30 rounded-xl max-h-[90vh] overflow-y-auto flex flex-col shadow-2xl font-sans text-white [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 @click.stop>
                 
                <!-- HEADER -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-emerald-500/20 shrink-0 bg-[#031018]">
                    <div class="flex items-center gap-3">
                        <button @click="drawerOpen = false" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                        </button>
                        <div>
                            <span class="text-xs font-extrabold text-white uppercase tracking-wider block">NINA PARTICIPANT</span>
                            <span class="text-[10px] text-emerald-400 font-bold block" x-show="selectedParticipant?.is_illustrative">Illustrative Entity Profile</span>
                        </div>
                    </div>
                    <button @click="drawerOpen = false" class="text-gray-400 hover:text-white p-2 rounded-lg bg-white/5 border border-white/10 transition-colors">
                        <?= $svg($ic['close'], 'w-4 h-4') ?>
                    </button>
                </div>

                <div class="p-6 flex-1 bg-[#020A10]">
                    <!-- Entity Banner -->
                    <div class="relative rounded-xl overflow-hidden border border-emerald-500/20 mb-6 bg-black">
                        <img src="<?= $basePrefix ?>/4.jpg" class="w-full h-32 lg:h-48 object-cover opacity-60 grayscale sepia-[.2] hue-rotate-[150deg]" />
                        <div class="absolute inset-0 bg-gradient-to-t from-[#020A10] to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4 flex flex-col lg:flex-row lg:items-end justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-white p-2 lg:p-3 rounded-lg border border-emerald-500/30 w-12 h-12 lg:w-16 lg:h-16 flex items-center justify-center overflow-hidden shrink-0">
                                    <img :src="selectedParticipant?.logo ? ('<?= $basePrefix ?>/logo/' + selectedParticipant.logo) : '<?= $basePrefix ?>/1.jpg'" 
                                         class="w-full h-full object-contain" 
                                         @error="$el.src='<?= $basePrefix ?>/1.jpg'" />
                                </div>
                                <div>
                                    <div class="text-xl lg:text-3xl font-extrabold text-white tracking-tight leading-none uppercase" x-text="selectedParticipant?.name"></div>
                                    <div class="text-[10px] lg:text-xs text-emerald-200 mt-1 uppercase font-bold tracking-widest" x-text="selectedParticipant?.role"></div>
                                </div>
                            </div>
                            <span class="rounded-full px-3 py-1.5 text-[9px] lg:text-[10px] font-bold border border-emerald-500/40 text-emerald-300 uppercase tracking-widest bg-emerald-950/40 self-start lg:self-end" x-text="selectedParticipant?.tier"></span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- LEFT COLUMN -->
                        <div class="space-y-6">

                            <!-- 01. ENTITY SUMMARY -->
                            <div class="rounded-xl border border-emerald-500/20 bg-emerald-950/10 overflow-hidden">
                        <div class="bg-emerald-950/20 px-4 py-2 border-b border-emerald-500/20 flex items-center gap-2">
                            <?= $svg($ic['shield'], 'w-4 h-4 text-emerald-400') ?>
                            <span class="text-[10px] font-bold text-white uppercase tracking-widest">01. Entity Summary</span>
                        </div>
                        <div class="p-4 grid grid-cols-2 gap-4 text-[10px] uppercase font-bold font-mono">
                            <div>
                                <div class="text-gray-500 tracking-wider">Entity Class</div>
                                <div class="text-white mt-1" x-text="selectedParticipant?.class"></div>
                            </div>
                            <div>
                                <div class="text-gray-500 tracking-wider">Joined NINA</div>
                                <div class="text-white mt-1">March 2026</div>
                            </div>
                            <div>
                                <div class="text-gray-500 tracking-wider">Current Tier</div>
                                <div class="text-white mt-1" x-text="selectedParticipant?.tier"></div>
                            </div>
                            <div>
                                <div class="text-gray-500 tracking-wider">Profile Status</div>
                                <div class="text-emerald-400 mt-1">Illustrative</div>
                            </div>
                            <div class="col-span-2 border-t border-emerald-500/20 pt-3">
                                <div class="text-gray-500 tracking-wider">Current Allocation Unit</div>
                                <div class="text-emerald-300 mt-1" x-text="'US$' + (parseInt((selectedParticipant?.unit || '0').replace(/[^0-9]/g, ''))).toLocaleString('en-US')"></div>
                            </div>
                        </div>
                    </div>

                    <!-- 02. PARTICIPATION SUMMARY -->
                    <div class="rounded-xl border border-emerald-500/20 bg-emerald-950/10 overflow-hidden">
                        <div class="bg-emerald-950/20 px-4 py-2 border-b border-emerald-500/20 flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                            <span class="text-[10px] font-bold text-white uppercase tracking-widest">02. Participation Summary</span>
                        </div>
                        <div class="p-4 grid grid-cols-4 gap-3 text-[10px] uppercase font-bold font-mono">
                            <div class="border border-emerald-500/20 rounded-lg p-2 bg-black/20 text-center flex flex-col items-center justify-center">
                                <div class="text-lg text-white mb-1" x-text="getHistory(selectedParticipant).length">5</div>
                                <div class="text-[8px] text-gray-500 leading-tight">Total<br/>Projects</div>
                            </div>
                            <div class="border border-emerald-500/20 rounded-lg p-2 bg-black/20 text-center flex flex-col items-center justify-center">
                                <div class="text-lg text-white mb-1" x-text="selectedParticipant?.allocations || 0">10</div>
                                <div class="text-[8px] text-gray-500 leading-tight">Total<br/>Units</div>
                            </div>
                            <div class="col-span-2 border border-emerald-500/20 rounded-lg p-3 bg-emerald-950/20 flex flex-col items-center justify-center">
                                <div class="text-gray-400 tracking-wider mb-1">Cumulative Participation</div>
                                <div class="text-lg text-emerald-300" x-text="'US$' + ((selectedParticipant?.allocations || 0) * parseInt((selectedParticipant?.unit || '0').replace(/[^0-9]/g, ''))).toLocaleString('en-US')">US$2,800,000</div>
                            </div>
                            <div class="col-span-4 border border-emerald-500/20 rounded-lg p-3 bg-black/20 flex flex-col items-center justify-center">
                                <div class="text-gray-400 tracking-wider mb-1">Confirmed Allocations</div>
                                <div class="text-lg text-white" x-text="selectedParticipant?.allocations || 0">10</div>
                            </div>
                        </div>
                    </div>

                    <!-- 03. PARTICIPATION ACTIVITY -->
                    <div class="rounded-xl border border-emerald-500/20 bg-emerald-950/10 overflow-hidden">
                        <div class="bg-emerald-950/20 px-4 py-2 border-b border-emerald-500/20 flex items-center gap-2">
                            <?= $svg($ic['calendar'], 'w-4 h-4 text-emerald-400') ?>
                            <span class="text-[10px] font-bold text-white uppercase tracking-widest">03. Participation Activity</span>
                        </div>
                        <div class="p-4 relative">
                            <!-- Timeline line -->
                            <div class="absolute left-[21px] top-6 bottom-6 w-px bg-emerald-500/20"></div>
                            
                            <div class="space-y-4">
                                <template x-for="(item, i) in getHistory(selectedParticipant)">
                                    <div class="flex items-start gap-4 relative z-10">
                                        <div class="w-3 h-3 rounded-full bg-[#020A10] border-2 border-emerald-500 flex-shrink-0 mt-0.5"></div>
                                        <div class="flex-1 flex justify-between items-center text-[10px] font-mono uppercase font-bold">
                                            <div>
                                                <div class="text-gray-400" x-text="item.name"></div>
                                                <div class="text-white mt-0.5">Allocation Confirmed</div>
                                            </div>
                                            <div class="text-right text-emerald-300" x-text="item.units + (item.units > 1 ? ' Units' : ' Unit') + ' · US$' + item.amount.toLocaleString('en-US')"></div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div> <!-- End LEFT COLUMN -->

                    <!-- RIGHT COLUMN -->
                    <div class="space-y-6">

                            <!-- 04. PROJECT EXPERIENCE -->
                            <div class="rounded-xl border border-emerald-500/20 bg-emerald-950/10 overflow-hidden">
                        <div class="bg-emerald-950/20 px-4 py-2 border-b border-emerald-500/20 flex items-center gap-2">
                            <?= $svg($ic['star'], 'w-4 h-4 text-emerald-400') ?>
                            <span class="text-[10px] font-bold text-white uppercase tracking-widest">04. Project Experience</span>
                        </div>
                        <div class="p-4 grid grid-cols-2 gap-4 text-[10px] font-mono uppercase font-bold border-b border-emerald-500/20">
                            <div>
                                <div class="text-gray-500 tracking-wider">Published Experience Reviews</div>
                                <div class="text-xl text-white mt-1" x-text="getHistory(selectedParticipant).length">2</div>
                            </div>
                            <div>
                                <div class="text-gray-500 tracking-wider">Experience Records</div>
                                <div class="text-xl text-white mt-1" x-text="getHistory(selectedParticipant).length">5</div>
                            </div>
                        </div>
                        <div class="p-3 bg-black/20 text-[9px] text-gray-400 flex items-start gap-2 italic">
                            <?= $svg($ic['info'] ?? $ic['check'], 'w-3 h-3 text-emerald-500/50 mt-0.5 shrink-0') ?>
                            <div>Review eligibility based on completed production cycles and commercial settlement. Individual project records are maintained confidentially.</div>
                        </div>
                    </div>

                    <!-- 05. PARTICIPANT VERIFICATION -->
                    <div class="rounded-xl border border-emerald-500/20 bg-emerald-950/10 overflow-hidden">
                        <div class="bg-emerald-950/20 px-4 py-2 border-b border-emerald-500/20 flex items-center gap-2">
                            <?= $svg($ic['check'], 'w-4 h-4 text-emerald-400') ?>
                            <span class="text-[10px] font-bold text-white uppercase tracking-widest">05. Participant Verification</span>
                        </div>
                        <div class="p-4 space-y-2">
                            <div class="text-[9px] font-bold text-emerald-500/70 uppercase tracking-widest mb-3">Entity Verification Checklist</div>
                            <template x-for="check in [
                                'Entity Profile Submitted',
                                'Entity Classification Confirmed',
                                'Participant Tier Verified',
                                'Active Allocation Record',
                                'Compliance Validation Active'
                            ]">
                                <div class="flex items-center gap-2 text-[10px] font-mono uppercase text-gray-300 font-bold">
                                    <div class="w-3.5 h-3.5 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-400">
                                        <?= $svg($ic['check'], 'w-2.5 h-2.5') ?>
                                    </div>
                                    <span x-text="check"></span>
                                </div>
                            </template>
                        </div>
                        </div>
                    </div> <!-- End Grid -->
                </div>
                
                <div class="p-4 border-t border-emerald-500/20 text-center bg-[#031018]">
                    <div class="text-[9px] font-bold text-emerald-500/50 uppercase tracking-widest flex items-center justify-center gap-2">
                        <?= $svg($ic['shield'], 'w-3 h-3') ?> SIMULATED / ILLUSTRATIVE ENTITY PROFILE
                    </div>
                </div>
            </div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
?>
