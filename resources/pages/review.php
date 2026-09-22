<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$constants = $config['system_constants'] ?? [];
$title = 'Production Network & Reputation Review — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'review';
$activeTab = 'allocations';

$type = $_GET['type'] ?? 'land-partner'; // 'land-partner' or 'vendor'

/* ---------- Helpers & Icons ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$svg = fn(string $inner, string $cls = 'w-4 h-4') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'star'      => '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>',
    'check'     => '<path d="M20 6L9 17l-5-5"/>',
    'shield'    => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
    'upload'    => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>',
    'arrowLeft' => '<path d="M19 12H5M12 19l-7-7 7-7"/>',
    'building'  => '<path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2Z"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2Z"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/>',
    'truck'     => '<rect x="1" y="3" width="15" height="13" rx="2"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
    'user'      => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    'leaf'      => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
];

$card    = 'rounded-xl border border-white/10 bg-[#0B1815]/90 shadow-xl';
$subCard = 'rounded-xl border border-white/10 bg-white/[0.03] p-4';

ob_start();
?>

<div class="relative w-full font-sans pb-12" x-data="{
    activeTab: '<?= $e($type) ?>',
    
    // Layout 1 State (Land Partner Review)
    lpOverallRating: 4.8,
    lpCatRatings: {
        execution: 4.5,
        documentation: 5.0,
        communication: 4.5,
        verification: 4.0,
        delivery: 5.0,
        commercial: 4.5
    },
    lpWrittenReview: 'Land preparation was completed on schedule and the quality met the agreed standard. Communication was responsive and documentation was complete.',
    lpConfirmed: true,

    // Layout 2 State (Vendor Review)
    vOverallRating: 4.7,
    vCatRatings: {
        quality: 5.0,
        delivery: 4.5,
        documentation: 4.5,
        support: 4.0,
        compliance: 5.0
    },
    vWrittenReview: 'Bibit yang dikirim sesuai spesifikasi dan kualitas baik. Pengiriman tepat waktu dan dokumentasi lengkap. Tim support juga responsif saat ada pertanyaan.',
    vConfirmed: true,

    submitted: false,
    showNotification: false,

    submitReview() {
        this.showNotification = true;
        setTimeout(() => this.showNotification = false, 4000);
    }
}">

    <!-- Notification Toast -->
    <div x-show="showNotification" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-[-20px]"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed top-20 right-6 z-50 flex items-center gap-3 rounded-xl border border-emerald-500/50 bg-[#061A14] px-5 py-3.5 shadow-2xl text-white font-mono text-xs"
         style="display: none;">
        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/40">
            <?= $svg($ic['check'], 'w-4 h-4') ?>
        </span>
        <div>
            <div class="font-bold text-emerald-300 uppercase">Review Successfully Submitted!</div>
            <div class="text-[10px] text-gray-300">Your review will be verified and aggregated to the Production Reputation ledger.</div>
        </div>
    </div>

    <!-- BACKGROUND GLOW -->
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
        <img src="<?= $basePrefix ?>/1.jpg" alt="" class="h-full w-full scale-110 object-cover opacity-20 blur-xl" />
        <div class="absolute inset-0 bg-gradient-to-b from-[#06120F]/70 via-[#06120F]/90 to-[#04100B]"></div>
    </div>

    <div class="relative z-10 space-y-6 px-4 py-6 sm:px-6 lg:px-8 w-full">

        <!-- ================= TOP SWITCHER & BREADCRUMB HEADER ================= -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-white/10 pb-5">
            <div class="space-y-1">
                <!-- Breadcrumb -->
                <div class="flex items-center gap-2 text-[10px] font-mono uppercase tracking-wider text-gray-400">
                    <a href="<?= $basePrefix ?>/allocations" class="hover:text-white transition-colors flex items-center gap-1">
                        <?= $svg($ic['arrowLeft'], 'w-3 h-3') ?>
                        <span>Back to Projects / Allocations</span>
                    </a>
                    <span>/</span>
                    <span class="text-emerald-400 font-bold" x-text="activeTab === 'land-partner' ? 'Review Land Partner' : 'Review Vendor'">Review Land Partner</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
                    <span x-text="activeTab === 'land-partner' ? 'Review Land Partner' : 'Review Vendor'">Review Land Partner</span>
                    <span x-show="activeTab === 'land-partner'" class="rounded-full bg-emerald-500/20 px-3 py-0.5 text-xs font-mono font-bold text-emerald-300 border border-emerald-500/40 inline-flex items-center gap-1">
                        <?= $svg($ic['shield'], 'w-3.5 h-3.5') ?> Verified Batch
                    </span>
                    <span x-show="activeTab === 'vendor'" class="rounded-full bg-emerald-500/20 px-3 py-0.5 text-xs font-mono font-bold text-emerald-300 border border-emerald-500/40 inline-flex items-center gap-1" style="display:none;">
                        <?= $svg($ic['check'], 'w-3.5 h-3.5') ?> Work Order Completed
                    </span>
                </h1>
                <p class="text-xs text-gray-400 max-w-2xl" x-text="activeTab === 'land-partner' ? 'NINA Participant memberikan review terhadap Land Partner setelah batch selesai dan terverifikasi. Review ini akan mempengaruhi Production Reputation dan badge/tier Land Partner.' : 'Land Partner memberikan review terhadap Vendor setelah work order selesai dan diverifikasi. Review ini akan mempengaruhi Vendor Reputation.'">
                    NINA Participant memberikan review terhadap Land Partner setelah batch selesai dan terverifikasi.
                </p>
            </div>

            <!-- LAYOUT SWITCHER TOGGLE BUTTONS -->
            <div class="flex items-center bg-black/60 p-1.5 rounded-xl border border-white/10 self-start md:self-auto font-mono text-xs shrink-0">
                <button @click="activeTab = 'land-partner'" 
                        :class="activeTab === 'land-partner' ? 'bg-emerald-500/20 text-emerald-300 border-emerald-500/40 font-bold shadow-lg' : 'text-gray-400 hover:text-white border-transparent'"
                        class="px-4 py-2 rounded-lg border transition-all flex items-center gap-2">
                    <?= $svg($ic['building'], 'w-4 h-4') ?>
                    <span>LAYOUT 1: Review Land Partner</span>
                </button>
                <button @click="activeTab = 'vendor'" 
                        :class="activeTab === 'vendor' ? 'bg-emerald-500/20 text-emerald-300 border-emerald-500/40 font-bold shadow-lg' : 'text-gray-400 hover:text-white border-transparent'"
                        class="px-4 py-2 rounded-lg border transition-all flex items-center gap-2">
                    <?= $svg($ic['leaf'], 'w-4 h-4') ?>
                    <span>LAYOUT 2: Review Vendor</span>
                </button>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- ================= LAYOUT 1: REVIEW LAND PARTNER (Participant) =========== -->
        <!-- ========================================================================= -->
        <div x-show="activeTab === 'land-partner'" class="space-y-6">

            <!-- HERO LAND PARTNER TARGET CARD -->
            <div class="<?= $card ?> p-5 lg:p-6">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                    <!-- Image preview -->
                    <div class="lg:col-span-4 relative rounded-xl overflow-hidden border border-white/10 h-44 lg:h-48 group">
                        <img src="<?= $basePrefix ?>/1.jpg" alt="North Kalimantan Palm" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute top-3 left-3 flex items-center gap-2">
                            <span class="rounded bg-black/70 px-2 py-0.5 text-[9px] font-mono font-bold text-amber-300 border border-amber-500/30 uppercase">NORTH KALIMANTAN</span>
                        </div>
                        <div class="absolute bottom-3 left-3">
                            <span class="rounded bg-emerald-950/90 px-2.5 py-1 text-[10px] font-mono font-extrabold text-emerald-300 border border-emerald-500/40 uppercase">Completed Batch</span>
                        </div>
                    </div>

                    <!-- Details & Target Profile -->
                    <div class="lg:col-span-8 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3 border-b border-white/10 pb-4">
                            <div>
                                <h2 class="text-xl sm:text-2xl font-extrabold text-white">North Kalimantan Palm</h2>
                                <div class="text-xs font-mono text-gray-400 mt-0.5">Batch NK-001 &bull; 100 HA</div>
                                <div class="mt-2 flex items-center gap-2 text-xs font-mono">
                                    <span class="text-gray-400">Land Partner:</span>
                                    <span class="font-bold text-white flex items-center gap-1.5">
                                        <?= $svg($ic['user'], 'w-3.5 h-3.5 text-emerald-400') ?>
                                        PT Mitra Lahan Sejahtera
                                    </span>
                                    <span class="text-gray-500 text-[10px]">(LP-0061)</span>
                                </div>
                                <div class="mt-1.5 flex items-center gap-2">
                                    <span class="rounded border border-slate-500/40 bg-slate-800/80 px-2 py-0.5 text-[9px] font-mono font-bold text-slate-300 uppercase">Silver</span>
                                    <span class="rounded border border-emerald-500/40 bg-emerald-950/80 px-2 py-0.5 text-[9px] font-mono font-bold text-emerald-300 uppercase">Production Partner</span>
                                </div>
                            </div>

                            <!-- Current Reputation Display -->
                            <div class="bg-black/50 border border-white/10 rounded-xl p-3.5 text-right font-mono shrink-0">
                                <div class="text-[9px] text-gray-400 uppercase tracking-wider">Current Production Reputation</div>
                                <div class="text-xl font-black text-amber-300 mt-0.5 flex items-center justify-end gap-1">
                                    <span class="text-amber-400">★</span> 4.8 <span class="text-xs font-normal text-gray-400">/ 5</span>
                                </div>
                                <div class="text-[10px] text-gray-400 mt-0.5">(37 verified reviews)</div>
                            </div>
                        </div>

                        <!-- 3 Stats Grid -->
                        <div class="grid grid-cols-3 gap-3 font-mono">
                            <div class="bg-white/5 border border-white/5 rounded-lg p-2.5">
                                <div class="text-[9px] text-gray-400 uppercase">Completed Batches</div>
                                <div class="text-base font-black text-white mt-0.5">8</div>
                            </div>
                            <div class="bg-white/5 border border-white/5 rounded-lg p-2.5">
                                <div class="text-[9px] text-gray-400 uppercase">Completed Area</div>
                                <div class="text-base font-black text-white mt-0.5">800 HA</div>
                            </div>
                            <div class="bg-white/5 border border-white/5 rounded-lg p-2.5">
                                <div class="text-[9px] text-gray-400 uppercase">On-Time Completion</div>
                                <div class="text-base font-black text-emerald-300 mt-0.5">94%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FORM SECTION 1 & 2: REVIEW DETAILS & CONFIRMATION -->
            <div class="<?= $card ?> p-6 space-y-6">

                <!-- 1. REVIEW DETAILS -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 border-b border-white/10 pb-3">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 text-xs font-mono font-bold">1</span>
                        <div>
                            <h3 class="text-sm font-mono font-bold uppercase text-white tracking-wider">REVIEW DETAILS</h3>
                            <p class="text-[11px] text-gray-400">Rate your experience with this land partner for this completed batch.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                        <!-- Left Col: Overall Rating & Categories -->
                        <div class="lg:col-span-6 space-y-5">
                            
                            <!-- Overall Rating -->
                            <div class="bg-black/40 border border-white/10 rounded-xl p-4 space-y-2">
                                <div class="text-xs font-mono font-bold text-white uppercase tracking-wider">Overall Rating</div>
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center text-amber-300 text-xl tracking-widest">
                                        <template x-for="i in 5">
                                            <button @click="lpOverallRating = i" class="hover:scale-125 transition transform focus:outline-none">
                                                <span x-text="i <= Math.round(lpOverallRating) ? '★' : '☆'" :class="i <= Math.round(lpOverallRating) ? 'text-amber-300' : 'text-gray-600'"></span>
                                            </button>
                                        </template>
                                    </div>
                                    <div class="text-lg font-mono font-bold text-amber-300">
                                        <span x-text="lpOverallRating.toFixed(1)">4.8</span> <span class="text-xs text-gray-400">/ 5</span>
                                    </div>
                                </div>
                                <div class="text-[10px] font-mono text-gray-400">Based on your experience with this batch</div>
                            </div>

                            <!-- Review Categories Slider / Rating Pickers -->
                            <div class="space-y-3 font-mono text-xs">
                                <div class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Review Categories</div>
                                
                                <!-- Execution -->
                                <div class="flex items-center justify-between bg-white/[0.02] p-2.5 rounded-lg border border-white/5">
                                    <span class="text-gray-300">Production Execution</span>
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-amber-300 text-sm">★★★★★</div>
                                        <span class="font-bold text-white w-7 text-right">4.5</span>
                                    </div>
                                </div>

                                <!-- Documentation -->
                                <div class="flex items-center justify-between bg-white/[0.02] p-2.5 rounded-lg border border-white/5">
                                    <span class="text-gray-300">Documentation</span>
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-amber-300 text-sm">★★★★★</div>
                                        <span class="font-bold text-white w-7 text-right">5.0</span>
                                    </div>
                                </div>

                                <!-- Communication -->
                                <div class="flex items-center justify-between bg-white/[0.02] p-2.5 rounded-lg border border-white/5">
                                    <span class="text-gray-300">Communication</span>
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-amber-300 text-sm">★★★★★</div>
                                        <span class="font-bold text-white w-7 text-right">4.5</span>
                                    </div>
                                </div>

                                <!-- Verification -->
                                <div class="flex items-center justify-between bg-white/[0.02] p-2.5 rounded-lg border border-white/5">
                                    <span class="text-gray-300">Verification</span>
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-amber-300 text-sm">★★★★☆</div>
                                        <span class="font-bold text-white w-7 text-right">4.0</span>
                                    </div>
                                </div>

                                <!-- Delivery -->
                                <div class="flex items-center justify-between bg-white/[0.02] p-2.5 rounded-lg border border-white/5">
                                    <span class="text-gray-300">Delivery</span>
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-amber-300 text-sm">★★★★★</div>
                                        <span class="font-bold text-white w-7 text-right">5.0</span>
                                    </div>
                                </div>

                                <!-- Commercial Process -->
                                <div class="flex items-center justify-between bg-white/[0.02] p-2.5 rounded-lg border border-white/5">
                                    <span class="text-gray-300">Commercial Process</span>
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-amber-300 text-sm">★★★★★</div>
                                        <span class="font-bold text-white w-7 text-right">4.5</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Right Col: Written Review & Add Media -->
                        <div class="lg:col-span-6 space-y-5">
                            
                            <!-- Written Review -->
                            <div class="space-y-1.5 font-mono text-xs">
                                <div class="flex items-center justify-between text-gray-300 font-bold">
                                    <span>Written Review <span class="text-gray-500 font-normal">(Optional)</span></span>
                                    <span class="text-[10px] text-gray-500" x-text="lpWrittenReview.length + '/500'">142/500</span>
                                </div>
                                <textarea x-model="lpWrittenReview" rows="4" 
                                          class="w-full rounded-xl border border-white/10 bg-black/60 p-3.5 text-xs text-white placeholder-gray-500 focus:border-emerald-400 focus:outline-none focus:ring-1 focus:ring-emerald-400 font-sans"
                                          placeholder="Share details of your experience with this land partner..."></textarea>
                            </div>

                            <!-- Add Media Upload Box -->
                            <div class="space-y-1.5 font-mono text-xs">
                                <div class="text-gray-300 font-bold">Add Media <span class="text-gray-500 font-normal">(Optional)</span></div>
                                <div class="border-2 border-dashed border-white/15 hover:border-emerald-500/50 bg-black/40 rounded-xl p-6 text-center cursor-pointer transition group">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/5 text-gray-400 group-hover:text-emerald-400 group-hover:bg-emerald-500/10 transition">
                                            <?= $svg($ic['upload'], 'w-5 h-5') ?>
                                        </span>
                                        <div class="text-xs text-gray-300 font-bold">Upload photos or videos</div>
                                        <div class="text-[10px] text-gray-500">PNG, JPG, MP4 (Max 10MB)</div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- 2. REVIEW CONFIRMATION & ACTIONS -->
                <div class="border-t border-white/10 pt-5 space-y-4 font-mono text-xs">
                    <div class="flex items-center gap-3">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 text-xs font-bold">2</span>
                        <div>
                            <h3 class="text-sm font-bold uppercase text-white tracking-wider">REVIEW CONFIRMATION</h3>
                            <p class="text-[10px] text-gray-400">The review will be verified and published to the network once all conditions are met.</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-black/40 p-4 rounded-xl border border-white/10">
                        <label class="flex items-center gap-3 cursor-pointer text-xs text-gray-300">
                            <input type="checkbox" x-model="lpConfirmed" class="h-4 w-4 rounded border-gray-600 bg-gray-900 text-emerald-500 focus:ring-emerald-400" />
                            <span>I confirm that this review is based on my actual experience with this batch and is truthful and accurate.</span>
                        </label>

                        <div class="flex items-center gap-3 shrink-0 self-end sm:self-auto">
                            <a href="<?= $basePrefix ?>/allocations" class="px-5 py-2.5 rounded-lg border border-white/10 bg-white/5 hover:bg-white/10 text-gray-300 text-xs font-bold transition">Cancel</a>
                            <button @click="submitReview()" :disabled="!lpConfirmed" 
                                    :class="lpConfirmed ? 'bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-black shadow-lg shadow-emerald-950/50' : 'bg-gray-800 text-gray-500 cursor-not-allowed'"
                                    class="px-6 py-2.5 rounded-lg text-xs uppercase transition">
                                Submit Review
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- EXISTING REVIEWS SECTION -->
            <div class="<?= $card ?> p-6 space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3 font-mono">
                    <h3 class="text-sm font-bold uppercase text-white tracking-wider">Existing Reviews</h3>
                    <a href="#" class="text-xs text-emerald-400 hover:underline flex items-center gap-1">View All Reviews &rarr;</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 font-mono">
                    
                    <!-- Review Card 1 -->
                    <div class="<?= $subCard ?> space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center font-bold text-emerald-300">R</div>
                            <div>
                                <div class="text-xs font-bold text-white">R*** A***</div>
                                <div class="text-[10px] text-gray-400">Participant ID: NINA-002713</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-xs border-t border-b border-white/5 py-1.5">
                            <div class="flex text-amber-300 text-sm">★★★★★ <span class="text-white font-bold ml-1">5.0</span></div>
                            <span class="text-[10px] text-gray-500">12 Mar 2026</span>
                        </div>
                        <p class="text-xs text-gray-300 leading-relaxed font-sans">
                            "Excellent land preparation quality and professional team. Very responsive."
                        </p>
                        <div class="flex flex-wrap gap-1 pt-1 text-[9px]">
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Execution</span>
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Documentation</span>
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Communication</span>
                        </div>
                    </div>

                    <!-- Review Card 2 -->
                    <div class="<?= $subCard ?> space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-white/10 border border-white/10 flex items-center justify-center font-bold text-gray-300">
                                <?= $svg($ic['user'], 'w-4 h-4 text-gray-400') ?>
                            </div>
                            <div>
                                <div class="text-xs font-bold text-white">Private Participant</div>
                                <div class="text-[10px] text-gray-400">Participant ID: NINA-004821</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-xs border-t border-b border-white/5 py-1.5">
                            <div class="flex text-amber-300 text-sm">★★★★☆ <span class="text-white font-bold ml-1">4.5</span></div>
                            <span class="text-[10px] text-gray-500">5 Mar 2026</span>
                        </div>
                        <p class="text-xs text-gray-300 leading-relaxed font-sans">
                            "Good overall performance. Some delays in initial mobilization, but resolved quickly."
                        </p>
                        <div class="flex flex-wrap gap-1 pt-1 text-[9px]">
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Execution</span>
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Delivery</span>
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Communication</span>
                        </div>
                    </div>

                    <!-- Review Card 3 -->
                    <div class="<?= $subCard ?> space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-blue-500/20 border border-blue-500/40 flex items-center justify-center font-bold text-blue-300">P</div>
                            <div>
                                <div class="text-xs font-bold text-white">PT ABC Capital</div>
                                <div class="text-[10px] text-gray-400">Participant ID: NINA-001882</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-xs border-t border-b border-white/5 py-1.5">
                            <div class="flex text-amber-300 text-sm">★★★★☆ <span class="text-white font-bold ml-1">4.0</span></div>
                            <span class="text-[10px] text-gray-500">28 Feb 2026</span>
                        </div>
                        <p class="text-xs text-gray-300 leading-relaxed font-sans">
                            "The land partner showed good commitment and delivered as planned."
                        </p>
                        <div class="flex flex-wrap gap-1 pt-1 text-[9px]">
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Execution</span>
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Documentation</span>
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Verification</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- ========================================================================= -->
        <!-- ================= LAYOUT 2: REVIEW VENDOR (Mitra Lahan -> Vendor) ======= -->
        <!-- ========================================================================= -->
        <div x-show="activeTab === 'vendor'" class="space-y-6" style="display:none;">

            <!-- HERO VENDOR TARGET CARD -->
            <div class="<?= $card ?> p-5 lg:p-6">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                    <!-- Image preview -->
                    <div class="lg:col-span-4 relative rounded-xl overflow-hidden border border-white/10 h-44 lg:h-48 group">
                        <img src="<?= $basePrefix ?>/2.jpg" alt="Certified Seed Producer" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute top-3 left-3 flex items-center gap-2">
                            <span class="rounded bg-emerald-950/90 px-2 py-0.5 text-[9px] font-mono font-bold text-emerald-300 border border-emerald-500/30 uppercase">SEED SUPPLIER</span>
                        </div>
                    </div>

                    <!-- Details & Target Profile -->
                    <div class="lg:col-span-8 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3 border-b border-white/10 pb-4">
                            <div>
                                <h2 class="text-xl sm:text-2xl font-extrabold text-white">Certified Seed Producer</h2>
                                <div class="text-xs font-mono text-gray-400 mt-0.5">VND-00081 &bull; Verified &bull; Seed Producer</div>
                                <div class="mt-2 flex items-center gap-2 text-xs font-mono">
                                    <span class="text-gray-400">Category:</span>
                                    <span class="font-bold text-emerald-300">Superior Planting Seeds</span>
                                </div>
                            </div>

                            <!-- Current Reputation Display -->
                            <div class="bg-black/50 border border-white/10 rounded-xl p-3.5 text-right font-mono shrink-0">
                                <div class="text-[9px] text-gray-400 uppercase tracking-wider">Vendor Reputation</div>
                                <div class="text-xl font-black text-amber-300 mt-0.5 flex items-center justify-end gap-1">
                                    <span class="text-amber-400">★</span> 4.7 <span class="text-xs font-normal text-gray-400">/ 5</span>
                                </div>
                                <div class="text-[10px] text-gray-400 mt-0.5">(14 verified reviews)</div>
                            </div>
                        </div>

                        <!-- 3 Stats Grid -->
                        <div class="grid grid-cols-3 gap-3 font-mono">
                            <div class="bg-white/5 border border-white/5 rounded-lg p-2.5">
                                <div class="text-[9px] text-gray-400 uppercase">Completed Work Orders</div>
                                <div class="text-base font-black text-white mt-0.5">12</div>
                            </div>
                            <div class="bg-white/5 border border-white/5 rounded-lg p-2.5">
                                <div class="text-[9px] text-gray-400 uppercase">On-Time Completion</div>
                                <div class="text-base font-black text-emerald-300 mt-0.5">96%</div>
                            </div>
                            <div class="bg-white/5 border border-white/5 rounded-lg p-2.5">
                                <div class="text-[9px] text-gray-400 uppercase">Verification Corrections</div>
                                <div class="text-base font-black text-white mt-0.5">1</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FORM SECTION 1 & 2: REVIEW DETAILS & CONFIRMATION -->
            <div class="<?= $card ?> p-6 space-y-6">

                <!-- 1. REVIEW DETAILS -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 border-b border-white/10 pb-3">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 text-xs font-mono font-bold">1</span>
                        <div>
                            <h3 class="text-sm font-mono font-bold uppercase text-white tracking-wider">REVIEW DETAILS</h3>
                            <p class="text-[11px] text-gray-400">Rate the vendor based on your experience with this work order.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                        <!-- Left Col: Overall Rating & Categories -->
                        <div class="lg:col-span-6 space-y-5">
                            
                            <!-- Overall Rating -->
                            <div class="bg-black/40 border border-white/10 rounded-xl p-4 space-y-2">
                                <div class="text-xs font-mono font-bold text-white uppercase tracking-wider">Overall Rating</div>
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center text-amber-300 text-xl tracking-widest">
                                        <template x-for="i in 5">
                                            <button @click="vOverallRating = i" class="hover:scale-125 transition transform focus:outline-none">
                                                <span x-text="i <= Math.round(vOverallRating) ? '★' : '☆'" :class="i <= Math.round(vOverallRating) ? 'text-amber-300' : 'text-gray-600'"></span>
                                            </button>
                                        </template>
                                    </div>
                                    <div class="text-lg font-mono font-bold text-amber-300">
                                        <span x-text="vOverallRating.toFixed(1)">4.7</span> <span class="text-xs text-gray-400">/ 5</span>
                                    </div>
                                </div>
                                <div class="text-[10px] font-mono text-gray-400">Based on your experience with this work order</div>
                            </div>

                            <!-- Review Categories Slider / Rating Pickers -->
                            <div class="space-y-3 font-mono text-xs">
                                <div class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Review Categories</div>
                                
                                <!-- Product Quality -->
                                <div class="flex items-center justify-between bg-white/[0.02] p-2.5 rounded-lg border border-white/5">
                                    <span class="text-gray-300">Product Quality</span>
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-amber-300 text-sm">★★★★★</div>
                                        <span class="font-bold text-white w-7 text-right">5.0</span>
                                    </div>
                                </div>

                                <!-- Delivery Reliability -->
                                <div class="flex items-center justify-between bg-white/[0.02] p-2.5 rounded-lg border border-white/5">
                                    <span class="text-gray-300">Delivery Reliability</span>
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-amber-300 text-sm">★★★★★</div>
                                        <span class="font-bold text-white w-7 text-right">4.5</span>
                                    </div>
                                </div>

                                <!-- Documentation -->
                                <div class="flex items-center justify-between bg-white/[0.02] p-2.5 rounded-lg border border-white/5">
                                    <span class="text-gray-300">Documentation</span>
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-amber-300 text-sm">★★★★★</div>
                                        <span class="font-bold text-white w-7 text-right">4.5</span>
                                    </div>
                                </div>

                                <!-- Operational Support -->
                                <div class="flex items-center justify-between bg-white/[0.02] p-2.5 rounded-lg border border-white/5">
                                    <span class="text-gray-300">Operational Support</span>
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-amber-300 text-sm">★★★★☆</div>
                                        <span class="font-bold text-white w-7 text-right">4.0</span>
                                    </div>
                                </div>

                                <!-- Specification Compliance -->
                                <div class="flex items-center justify-between bg-white/[0.02] p-2.5 rounded-lg border border-white/5">
                                    <span class="text-gray-300">Specification Compliance</span>
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-amber-300 text-sm">★★★★★</div>
                                        <span class="font-bold text-white w-7 text-right">5.0</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Right Col: Written Review & Add Media -->
                        <div class="lg:col-span-6 space-y-5">
                            
                            <!-- Written Review -->
                            <div class="space-y-1.5 font-mono text-xs">
                                <div class="flex items-center justify-between text-gray-300 font-bold">
                                    <span>Written Review <span class="text-gray-500 font-normal">(Optional)</span></span>
                                    <span class="text-[10px] text-gray-500" x-text="vWrittenReview.length + '/500'">138/500</span>
                                </div>
                                <textarea x-model="vWrittenReview" rows="4" 
                                          class="w-full rounded-xl border border-white/10 bg-black/60 p-3.5 text-xs text-white placeholder-gray-500 focus:border-emerald-400 focus:outline-none focus:ring-1 focus:ring-emerald-400 font-sans"
                                          placeholder="Share details of vendor performance..."></textarea>
                            </div>

                            <!-- Add Media Upload Box with Preview -->
                            <div class="space-y-1.5 font-mono text-xs">
                                <div class="text-gray-300 font-bold">Add Media <span class="text-gray-500 font-normal">(Optional)</span></div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="border-2 border-dashed border-white/15 hover:border-emerald-500/50 bg-black/40 rounded-xl p-4 text-center cursor-pointer transition group flex flex-col items-center justify-center">
                                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/5 text-gray-400 group-hover:text-emerald-400 transition mb-1">
                                            <?= $svg($ic['upload'], 'w-4 h-4') ?>
                                        </span>
                                        <div class="text-[10px] text-gray-300 font-bold">Upload photos or videos</div>
                                        <div class="text-[9px] text-gray-500">PNG, JPG, MP4 (Max 10MB)</div>
                                    </div>

                                    <!-- Uploaded Preview Thumbnail -->
                                    <div class="relative rounded-xl overflow-hidden border border-emerald-500/40 group h-24">
                                        <img src="<?= $basePrefix ?>/2.jpg" alt="Uploaded Proof" class="w-full h-full object-cover" />
                                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition"></div>
                                        <span class="absolute top-1.5 right-1.5 rounded-full bg-black/70 p-1 text-white hover:text-red-400 cursor-pointer">
                                            &times;
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- 2. REVIEW CONFIRMATION & ACTIONS -->
                <div class="border-t border-white/10 pt-5 space-y-4 font-mono text-xs">
                    <div class="flex items-center gap-3">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 text-xs font-bold">2</span>
                        <div>
                            <h3 class="text-sm font-bold uppercase text-white tracking-wider">REVIEW CONFIRMATION</h3>
                            <p class="text-[10px] text-gray-400">This review will be verified and published to the network once all conditions are met.</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-black/40 p-4 rounded-xl border border-white/10">
                        <label class="flex items-center gap-3 cursor-pointer text-xs text-gray-300">
                            <input type="checkbox" x-model="vConfirmed" class="h-4 w-4 rounded border-gray-600 bg-gray-900 text-emerald-500 focus:ring-emerald-400" />
                            <span>I confirm that this review is based on my actual experience with the vendor and is truthful and accurate.</span>
                        </label>

                        <div class="flex items-center gap-3 shrink-0 self-end sm:self-auto">
                            <a href="<?= $basePrefix ?>/vendors" class="px-5 py-2.5 rounded-lg border border-white/10 bg-white/5 hover:bg-white/10 text-gray-300 text-xs font-bold transition">Cancel</a>
                            <button @click="submitReview()" :disabled="!vConfirmed" 
                                    :class="vConfirmed ? 'bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-black shadow-lg shadow-emerald-950/50' : 'bg-gray-800 text-gray-500 cursor-not-allowed'"
                                    class="px-6 py-2.5 rounded-lg text-xs uppercase transition">
                                Submit Review
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- PREVIOUS REVIEWS SECTION -->
            <div class="<?= $card ?> p-6 space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3 font-mono">
                    <h3 class="text-sm font-bold uppercase text-white tracking-wider">Previous Reviews</h3>
                    <a href="#" class="text-xs text-emerald-400 hover:underline flex items-center gap-1">View All Reviews &rarr;</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 font-mono">
                    
                    <!-- Review Card 1 -->
                    <div class="<?= $subCard ?> space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center font-bold text-emerald-300">R</div>
                            <div>
                                <div class="text-xs font-bold text-white">PT Mitra Lahan Sejahtera</div>
                                <div class="text-[10px] text-gray-400">LP-0061</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-xs border-t border-b border-white/5 py-1.5">
                            <div class="flex text-amber-300 text-sm">★★★★★ <span class="text-white font-bold ml-1">5.0</span></div>
                            <span class="text-[10px] text-gray-500">12 Mar 2026</span>
                        </div>
                        <p class="text-xs text-gray-300 leading-relaxed font-sans">
                            "Kualitas bibit sangat baik, sesuai spesifikasi dan pertumbuhan di lapangan optimal."
                        </p>
                        <div class="flex flex-wrap gap-1 pt-1 text-[9px]">
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Quality</span>
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Delivery</span>
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Compliance</span>
                        </div>
                    </div>

                    <!-- Review Card 2 -->
                    <div class="<?= $subCard ?> space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-amber-500/20 border border-amber-500/40 flex items-center justify-center font-bold text-amber-300">R</div>
                            <div>
                                <div class="text-xs font-bold text-white">PT Agrindo Nusantara</div>
                                <div class="text-[10px] text-gray-400">LP-0032</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-xs border-t border-b border-white/5 py-1.5">
                            <div class="flex text-amber-300 text-sm">★★★★☆ <span class="text-white font-bold ml-1">4.5</span></div>
                            <span class="text-[10px] text-gray-500">2 Mar 2026</span>
                        </div>
                        <p class="text-xs text-gray-300 leading-relaxed font-sans">
                            "Pengiriman tepat waktu, namun ada sedikit kendala pada dokumen awal."
                        </p>
                        <div class="flex flex-wrap gap-1 pt-1 text-[9px]">
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Delivery</span>
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Documentation</span>
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Support</span>
                        </div>
                    </div>

                    <!-- Review Card 3 -->
                    <div class="<?= $subCard ?> space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-white/10 border border-white/10 flex items-center justify-center font-bold text-gray-300">R</div>
                            <div>
                                <div class="text-xs font-bold text-white">Private Partner</div>
                                <div class="text-[10px] text-gray-400">NINA-000521</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-xs border-t border-b border-white/5 py-1.5">
                            <div class="flex text-amber-300 text-sm">★★★★☆ <span class="text-white font-bold ml-1">4.0</span></div>
                            <span class="text-[10px] text-gray-500">20 Feb 2026</span>
                        </div>
                        <p class="text-xs text-gray-300 leading-relaxed font-sans">
                            "Secara umum bagus, bibit tumbuh dengan baik di kondisi lapangan."
                        </p>
                        <div class="flex flex-wrap gap-1 pt-1 text-[9px]">
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Quality</span>
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Support</span>
                            <span class="rounded bg-white/5 border border-white/5 px-2 py-0.5 text-gray-400">Specification</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/dashboard.php';
