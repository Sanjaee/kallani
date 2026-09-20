<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$constants = $config['system_constants'] ?? [];
$demoDemand = $config['demo_demands'][0] ?? [];
$title = '02 / Production Requirement — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'demand';

/* ---------- Helpers & data ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$demoId      = $demoDemand['id']      ?? 'DR-2026-001';
$demoBuyer   = $demoDemand['buyer']   ?? 'DEMO OFFTAKE BUYER';
$demoProduct = $demoDemand['product'] ?? 'Palm Oil Product';
$rampUpYears = 5;
$deliveryYears = max(1, (int)($demoDemand['contract_horizon_years'] ?? 20) - $rampUpYears);

$productOptions = array_values(array_unique(array_merge(
    [$demoProduct],
    ['Palm Oil Product', 'Crude Palm Oil (CPO)', 'RBD Palm Oil', 'RBD Palm Olein']
)));

/* Reusable class strings (Tailwind) */
$cardCls   = 'h-full rounded-xl border border-white/10 bg-[#0B1815]/80 p-4 space-y-3';
$cardTitle = 'block text-[11px] font-bold text-white uppercase tracking-wider';
$cardHint  = 'text-[10px] text-gray-400 leading-snug';
$labelCls  = 'block text-[10px] font-medium text-gray-400 mb-1';
$selectCls = 'w-full appearance-none cursor-pointer rounded-lg border border-white/10 bg-[#07110E] px-3 py-2.5 pr-9 text-xs font-medium text-white focus:outline-none focus:border-emerald-400/70';
$chev      = '<svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';
$check     = '<svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>';
$docIcon   = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>';
$arrow     = '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>';
$leafIcon  = '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>';
$gridIcon  = '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/></svg>';
$calIcon   = '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>';
$statusIcon= '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M9 12l2 2 4-4"/></svg>';
$pinIcon   = '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="2.5"/></svg>';
$mapIcon   = '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>';

ob_start();
?>

<div class="relative w-full font-sans"
     @keydown.escape.window="open = false"
     x-data="{
        open: false,
        product: <?= $e(json_encode($demoProduct)) ?>,
        capacity: 1000,
        rampUp: <?= (int)$rampUpYears ?>,
        deliveryYears: <?= (int)$deliveryYears ?>,
        standard: 'Standardized Agronomic Protocol',
        seed: 'Certified Superior Seed',
        density: 143,
        regions: {
            'Indonesia': true,
            'Kalimantan': false,
            'Sumatra': false,
            'Sulawesi': false,
            'Papua': false
        },
        verifications: [
            { id: 'land',      label: 'Verified Land',            checked: true },
            { id: 'partner',   label: 'Verified Production Partner', checked: true },
            { id: 'seedCert',  label: 'Certified Seed Source',    checked: true },
            { id: 'prodTrace', label: 'Production Traceability',  checked: true },
            { id: 'commTrace', label: 'Commercial Traceability',  checked: true },
            { id: 'audit',     label: 'Audit Trail',              checked: true }
        ],
        get horizon() { return Number(this.rampUp) + Number(this.deliveryYears); },
        get capacityText() { return Number(this.capacity || 0).toLocaleString('en-US'); },
        get spacing() { return Number(this.density) === 143 ? '9 × 9 × 9 m' : '9.2 × 9.2 × 9.2 m'; },
        get standardShort() { return this.standard.replace('Agronomic ', ''); },
        get activeVerificationsCount() { return this.verifications.filter(v => v.checked).length; },
        get selectedRegionsText() {
            const active = Object.keys(this.regions).filter(r => this.regions[r]);
            return active.length ? active.join(', ') : 'None';
        },
        applyCapacity() { this.capacity = Math.max(1, Math.round(Number(this.capacity) || 1000)); }
     }">

    <!-- PAGE BACKGROUND (soft blurred forest) -->
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
        <img src="<?= $basePrefix ?>/1.jpg" alt="" class="h-full w-full object-cover opacity-30 blur-md scale-110" />
        <div class="absolute inset-0 bg-gradient-to-b from-[#06120F]/60 via-[#06120F]/85 to-[#04100B]"></div>
    </div>

    <div class="relative z-10 space-y-6">

        <!-- ================= HERO + OVERVIEW STRIP ================= -->
        <section class="overflow-hidden border-0 shadow-2xl">

            <!-- Hero -->
            <div class="relative min-h-[260px] px-6 pt-3 pb-8 sm:px-8 lg:px-10 lg:pt-3 lg:pb-8">
                <img src="<?= $basePrefix ?>/1.jpg" alt="Natural forest canopy" class="absolute inset-0 h-full w-full object-cover" />
                <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/75 via-[#050D07]/35 to-transparent"></div>

                <div class="relative grid grid-cols-1 items-center gap-8 lg:grid-cols-12">

                    <!-- Left: title & actions -->
                    <div class="space-y-3 lg:col-span-7">
                        <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300 mb-1">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                            <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">PRODUCTION REQUIREMENTS</a>
                            <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <span class="font-bold text-white uppercase"><?= $e($demoId) ?></span>
                        </nav>

                        <h1 class="text-4xl font-extrabold leading-[1.05] tracking-tight text-white sm:text-5xl lg:text-[3.4rem]">Start With Demand.</h1>
                        <p class="max-w-xl text-sm leading-relaxed text-gray-100/90">
                            Every production program begins with a defined buyer requirement. NINA converts product demand into measurable production capacity, executable batches and traceable delivery requirements.
                        </p>

                        <div class="flex flex-wrap items-center gap-3 pt-2">
                            <a href="#requirement-form" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#6EE7B7] to-[#C9F5DE] px-6 py-3 text-[11px] font-bold uppercase tracking-wider text-[#04100B] shadow-lg shadow-emerald-950/40 transition hover:brightness-110">
                                <span>Create Production Requirement</span><?= $arrow ?>
                            </a>
                            <a href="<?= $basePrefix ?>/#system-architecture" class="inline-flex items-center gap-2 rounded-full border border-white/30 bg-black/30 px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-white backdrop-blur-md transition hover:bg-white/10">
                                <span>View System Flow</span>
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Right: glass offtake card -->
                    <div class="lg:col-span-5 lg:pl-10">
                        <div class="space-y-4 rounded-xl border border-white/15 bg-[#08130F]/70 p-5 shadow-2xl backdrop-blur-xl max-w-xs ml-auto">
                            <div class="flex items-center justify-between">
                                <span class="rounded border border-emerald-400/40 bg-emerald-950/70 px-2 py-0.5 text-[10px] font-semibold text-emerald-300">DEMO</span>
                                <span class="flex h-8 w-8 items-center justify-center rounded-lg border border-white/15 bg-white/5 text-gray-200"><?= $docIcon ?></span>
                            </div>
                            <div class="text-xs font-bold uppercase tracking-wide text-white">Demo Offtake Requirement</div>
                            <div>
                                <div class="text-[10px] text-gray-400">Requirement ID</div>
                                <div class="text-xs font-semibold text-white"><?= $e($demoId) ?></div>
                            </div>
                            <div>
                                <div class="text-[10px] text-gray-400">Buyer</div>
                                <div class="text-xs font-semibold text-white"><?= $e($demoBuyer) ?></div>
                            </div>
                            <div>
                                <div class="text-[10px] text-gray-400">Status</div>
                                <div class="flex items-center gap-1.5 text-[11px] font-semibold text-emerald-300">
                                    <span class="h-2 w-2 rounded-full border border-emerald-300"></span>
                                    EXAMPLE / SIMULATED
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Requirement overview strip -->
            <div class="border-t border-white/10 bg-[#08130F]/95">
                <div class="grid grid-cols-1 divide-y divide-white/10 md:grid-cols-5 md:divide-x md:divide-y-0">

                    <div class="flex flex-col justify-center px-5 py-4">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-white">Requirement Overview</span>
                        <span class="mt-0.5 text-[10px] text-gray-400">Current requirement details</span>
                    </div>

                    <div class="flex items-center gap-3 px-5 py-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-300"><?= $leafIcon ?></span>
                        <div>
                            <div class="text-[9px] font-medium uppercase text-gray-400">Product</div>
                            <div class="text-xs font-bold text-white" x-text="product"><?= $e($demoProduct) ?></div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 px-5 py-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-300"><?= $gridIcon ?></span>
                        <div>
                            <div class="text-[9px] font-medium uppercase text-gray-400">Production Capacity</div>
                            <div class="text-sm font-bold text-white" x-text="capacityText + ' ha'">1,000 ha</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 px-5 py-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-300"><?= $calIcon ?></span>
                        <div>
                            <div class="text-[9px] font-medium uppercase text-gray-400">Program Horizon</div>
                            <div class="text-sm font-bold text-white" x-text="horizon + ' years'">20 years</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 px-5 py-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-300"><?= $statusIcon ?></span>
                        <div>
                            <div class="text-[9px] font-medium uppercase text-gray-400">Status</div>
                            <div class="text-sm font-bold leading-tight text-white">Demo</div>
                            <div class="text-[9px] text-gray-400">Not yet contracted</div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ================= FORM + SUMMARY ================= -->
        <section id="requirement-form" class="!mt-0 grid grid-cols-1 items-start gap-8 lg:grid-cols-12 px-6 lg:px-8">

            <!-- LEFT: form -->
            <div class="space-y-5 lg:col-span-8 lg:border-r lg:border-white/10 lg:pr-8 pt-4 lg:pt-8">
                <div>
                    <h2 class="text-2xl font-extrabold tracking-tight text-white">Production Requirement</h2>
                    <p class="mt-1 text-xs text-gray-300">Define what needs to be produced before matching production capacity.</p>
                </div>

                <form id="demand-form" @submit.prevent="open = true" class="space-y-4">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                        <!-- 01. PRODUCT -->
                        <div class="<?= $cardCls ?>">
                            <div class="space-y-1">
                                <label for="product-select" class="<?= $cardTitle ?>">01.&nbsp; Product</label>
                                <p class="<?= $cardHint ?>">Select the product type and specification.</p>
                            </div>
                            <div class="relative">
                                <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-emerald-300"><?= str_replace('w-5 h-5', 'w-4 h-4', $leafIcon) ?></span>
                                <select id="product-select" x-model="product" class="<?= $selectCls ?> pl-9">
                                    <?php foreach ($productOptions as $opt): ?>
                                        <option value="<?= $e($opt) ?>"><?= $e($opt) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= $chev ?>
                            </div>
                        </div>

                        <!-- 02. REQUIRED CAPACITY -->
                        <div class="<?= $cardCls ?>">
                            <div class="space-y-1">
                                <label for="capacity-input" class="<?= $cardTitle ?>">02.&nbsp; Required Capacity</label>
                                <p class="<?= $cardHint ?>">Enter the production capacity needed.</p>
                            </div>
                            <div class="flex overflow-hidden rounded-lg border border-white/10 bg-[#07110E] focus-within:border-emerald-400/70">
                                <input id="capacity-input" type="number" min="1" x-model="capacity" @keydown.enter.prevent="applyCapacity()" placeholder="1,000"
                                       class="w-full bg-transparent px-3 py-2.5 text-xs font-bold text-white focus:outline-none" />
                                <span class="flex items-center border-l border-white/10 bg-white/5 px-4 text-[11px] font-bold text-gray-300">HA</span>
                            </div>
                            <p class="<?= $cardHint ?>">Equivalent productive area required to support the buyer requirement.</p>
                            <button type="button" @click="applyCapacity()"
                                    class="rounded-full border border-emerald-300/60 px-4 py-1.5 text-[10px] font-semibold uppercase tracking-wider text-emerald-200 transition hover:bg-emerald-400/10">
                                Apply Capacity
                            </button>
                        </div>

                        <!-- 03. COMMERCIAL DELIVERY -->
                        <div class="<?= $cardCls ?>">
                            <div class="space-y-1">
                                <label class="<?= $cardTitle ?>">03.&nbsp; Commercial Delivery</label>
                                <p class="<?= $cardHint ?>">Define the delivery schedule and timeline.</p>
                            </div>
                            <div class="relative">
                                <select aria-label="Delivery schedule" class="<?= $selectCls ?>">
                                    <option>Annual Requirement</option>
                                    <option>Quarterly Requirement</option>
                                </select>
                                <?= $chev ?>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <span class="<?= $labelCls ?>">Target Start</span>
                                    <div class="relative">
                                        <select aria-label="Target start" class="<?= $selectCls ?>">
                                            <option>Year 6</option>
                                            <option>Year 3</option>
                                        </select>
                                        <?= $chev ?>
                                    </div>
                                </div>
                                <div>
                                    <span class="<?= $labelCls ?>">Delivery Horizon</span>
                                    <div class="relative">
                                        <select aria-label="Delivery horizon" x-model.number="deliveryYears" class="<?= $selectCls ?>">
                                            <option value="15">15 Years</option>
                                            <option value="20">20 Years</option>
                                        </select>
                                        <?= $chev ?>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-0.5 text-[10px] text-gray-300">
                                <div>Development / ramp-up period: <span x-text="rampUp"></span> years.</div>
                                <div>Commercial delivery period: <span x-text="deliveryYears"></span> years.</div>
                            </div>
                        </div>

                        <!-- 04. PRODUCTION REGION -->
                        <div class="<?= $cardCls ?>">
                            <div class="space-y-1">
                                <label class="<?= $cardTitle ?>">04.&nbsp; Production Region</label>
                                <p class="<?= $cardHint ?>">Select preferred production region(s).</p>
                            </div>
                            <div class="space-y-3 pt-1">
                                <template x-for="(val, key) in regions" :key="key">
                                    <label class="flex cursor-pointer select-none items-center gap-3 text-xs font-medium"
                                           :class="regions[key] ? 'text-white' : 'text-gray-300'">
                                        <input type="checkbox" class="peer sr-only" x-model="regions[key]" />
                                        <span class="flex h-[18px] w-[18px] shrink-0 items-center justify-center rounded border transition peer-focus-visible:ring-2 peer-focus-visible:ring-emerald-300"
                                              :class="regions[key] ? 'border-emerald-300 bg-emerald-400 text-[#04100B]' : 'border-white/25 bg-[#07110E] text-transparent'">
                                            <?= $check ?>
                                        </span>
                                        <span x-text="key"></span>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <!-- 05. PRODUCTION STANDARD -->
                        <div class="<?= $cardCls ?>">
                            <div class="space-y-1">
                                <label class="<?= $cardTitle ?>">05.&nbsp; Production Standard</label>
                                <p class="<?= $cardHint ?>">Define the agronomic and technical standards.</p>
                            </div>
                            <div class="relative">
                                <select aria-label="Production standard" x-model="standard" class="<?= $selectCls ?>">
                                    <option>Standardized Agronomic Protocol</option>
                                    <option>GAP Certified Protocol</option>
                                </select>
                                <?= $chev ?>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <span class="<?= $labelCls ?>">Seed</span>
                                    <div class="relative">
                                        <select aria-label="Seed" x-model="seed" class="<?= $selectCls ?>">
                                            <option>Certified Superior Seed</option>
                                            <option>Tenera Hybrid Seed</option>
                                        </select>
                                        <?= $chev ?>
                                    </div>
                                </div>
                                <div>
                                    <span class="<?= $labelCls ?>">Planting Density</span>
                                    <div class="relative">
                                        <select aria-label="Planting density" x-model.number="density" class="<?= $selectCls ?>">
                                            <option value="143">143 trees / ha</option>
                                            <option value="136">136 trees / ha</option>
                                        </select>
                                        <?= $chev ?>
                                    </div>
                                </div>
                            </div>
                            <p class="<?= $cardHint ?>">Model parameter based on <span x-text="spacing"></span> triangular planting arrangement.</p>
                        </div>

                        <!-- 06. VERIFICATION REQUIREMENT -->
                        <div class="<?= $cardCls ?>">
                            <div class="space-y-1">
                                <label class="<?= $cardTitle ?>">06.&nbsp; Verification Requirement</label>
                                <p class="<?= $cardHint ?>">Set the minimum verification standards.</p>
                            </div>
                            <div class="space-y-3 pt-1">
                                <template x-for="item in verifications" :key="item.id">
                                    <label class="flex cursor-pointer select-none items-center gap-3 text-xs font-medium"
                                           :class="item.checked ? 'text-white' : 'text-gray-300'">
                                        <input type="checkbox" class="peer sr-only" x-model="item.checked" />
                                        <span class="flex h-[18px] w-[18px] shrink-0 items-center justify-center rounded border transition peer-focus-visible:ring-2 peer-focus-visible:ring-emerald-300"
                                              :class="item.checked ? 'border-emerald-300 bg-emerald-400 text-[#04100B]' : 'border-white/25 bg-[#07110E] text-transparent'">
                                            <?= $check ?>
                                        </span>
                                        <span x-text="item.label"></span>
                                    </label>
                                </template>
                            </div>
                        </div>

                    </div>

                    <!-- Submit -->
                    <div class="pt-2 pb-8">
                        <button type="submit"
                                class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#6EE7B7] to-[#C9F5DE] px-7 py-3.5 text-[11px] font-bold uppercase tracking-wider text-[#04100B] shadow-lg shadow-emerald-950/40 transition hover:brightness-110">
                            <span>Create Production Requirement</span><?= $arrow ?>
                        </button>
                    </div>
                </form>
            </div>

            <!-- RIGHT: sticky summary + help card -->
            <aside class="space-y-4 lg:sticky lg:top-20 lg:col-span-4 pt-4 lg:pt-8">

                <!-- Summary -->
                <div class="space-y-4 rounded-xl border border-white/10 bg-[#0B1815]/85 p-5 shadow-xl ">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-white">Requirement Summary</span>
                        <span class="rounded border border-emerald-400/40 bg-emerald-950/70 px-2 py-0.5 text-[10px] font-semibold text-emerald-300">DEMO</span>
                    </div>

                    <div class="flex items-start justify-between border-b border-white/10 pb-4">
                        <div>
                            <div class="text-lg font-bold leading-tight text-white"><?= $e($demoId) ?></div>
                            <div class="mt-0.5 text-[11px] font-semibold uppercase text-gray-300"><?= $e($demoBuyer) ?></div>
                        </div>
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg border border-white/15 bg-white/5 text-gray-200"><?= $docIcon ?></span>
                    </div>

                    <dl class="divide-y divide-white/10 text-[11px]">
                        <div class="flex items-center justify-between gap-4 py-2.5"><dt class="uppercase text-gray-400">Product</dt><dd class="text-right font-semibold text-white" x-text="product"></dd></div>
                        <div class="flex items-center justify-between gap-4 py-2.5"><dt class="uppercase text-gray-400">Capacity</dt><dd class="text-right font-bold text-white" x-text="capacityText + ' HA'"></dd></div>
                        <div class="flex items-center justify-between gap-4 py-2.5"><dt class="uppercase text-gray-400">Horizon</dt><dd class="text-right font-bold text-white" x-text="horizon + ' Years'"></dd></div>
                        <div class="flex items-center justify-between gap-4 py-2.5"><dt class="uppercase text-gray-400">Development</dt><dd class="text-right font-bold text-white" x-text="rampUp + ' Years'"></dd></div>
                        <div class="flex items-center justify-between gap-4 py-2.5"><dt class="uppercase text-gray-400">Commercial Delivery</dt><dd class="text-right font-bold text-white" x-text="deliveryYears + ' Years'"></dd></div>
                        <div class="flex items-center justify-between gap-4 py-2.5"><dt class="uppercase text-gray-400">Region</dt><dd class="text-right font-semibold text-white" x-text="selectedRegionsText"></dd></div>
                        <div class="flex items-center justify-between gap-4 py-2.5"><dt class="uppercase text-gray-400">Standard</dt><dd class="text-right font-semibold text-white" x-text="standardShort"></dd></div>
                        <div class="flex items-center justify-between gap-4 py-2.5 border-b border-white/10"><dt class="uppercase text-gray-400">Verification</dt><dd class="text-right font-bold text-white" x-text="activeVerificationsCount + ' Requirements'"></dd></div>
                    </dl>

                    <button type="submit" form="demand-form"
                            class="flex w-full items-center justify-center gap-2 rounded-lg border border-emerald-300/60 py-2.5 text-[11px] font-semibold uppercase tracking-wider text-white transition hover:bg-emerald-400/10">
                        <span>Create Requirement</span><?= $arrow ?>
                    </button>
                </div>

                <!-- Help / tutorial -->
                <div class="group rounded-xl border border-white/10 bg-[#0B1815]/85 p-3 shadow-xl">
                    <div class="relative h-28 overflow-hidden rounded-lg">
                        <img src="<?= $basePrefix ?>/2.jpg" alt="Tutorial preview" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-black/25"></div>
                        <span class="absolute left-1/2 top-1/2 flex h-9 w-9 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border border-white/50 bg-black/40 text-white backdrop-blur-md">
                            <svg class="h-3.5 w-3.5 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                    </div>
                    <div class="space-y-1 px-1 pb-1 pt-3">
                        <div class="text-xs font-bold text-white">Need help?</div>
                        <p class="text-[11px] leading-relaxed text-gray-300">View our step-by-step guide on creating production requirements.</p>
                        <a href="#" class="inline-flex items-center gap-1 pt-1 text-[10px] font-bold uppercase tracking-wider text-emerald-300 hover:text-emerald-200">
                            Watch Tutorial <span>&rarr;</span>
                        </a>
                    </div>
                </div>

            </aside>
        </section>

        <!-- ================= HOW IT WORKS ================= -->
        <section class="rounded-xl border border-white/10 bg-[#08130F]/90 shadow-xl !mt-0 p-5">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:gap-8">

                <div class="lg:w-44 lg:shrink-0">
                    <div class="text-[11px] font-bold uppercase tracking-wider text-white">How It Works</div>
                    <p class="mt-1 text-[10px] text-gray-400">From buyer demand to production batches.</p>
                </div>

                <div class="grid flex-1 grid-cols-1 items-center gap-4 md:grid-cols-[1fr_auto_1fr_auto_1fr]">

                    <div class="flex items-center gap-3">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-300"><?= $pinIcon ?></span>
                        <div>
                            <div class="text-[10px] font-semibold uppercase text-gray-400">01 Define</div>
                            <div class="text-xs font-bold text-white">Buyer Requirement</div>
                            <div class="text-[10px] leading-snug text-gray-400">Define the product, capacity and commercial requirement.</div>
                        </div>
                    </div>

                    <div class="hidden text-lg text-gray-500 md:block">&rsaquo;</div>

                    <div class="flex items-center gap-3">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-300"><?= $mapIcon ?></span>
                        <div>
                            <div class="text-[10px] font-semibold uppercase text-gray-400">02 Match</div>
                            <div class="text-xs font-bold text-white">Capacity Mapping</div>
                            <div class="text-[10px] leading-snug text-gray-400">NINA maps suitable productive assets and partners.</div>
                        </div>
                    </div>

                    <div class="hidden text-lg text-gray-500 md:block">&rsaquo;</div>

                    <div class="flex items-center gap-3">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-300"><?= $gridIcon ?></span>
                        <div>
                            <div class="text-[10px] font-semibold uppercase text-gray-400">03 Execute</div>
                            <div class="text-xs font-bold text-white">Production Batches</div>
                            <div class="text-[10px] leading-snug text-gray-400">The requirement is converted into executable 100-ha batches.</div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>

    <!-- ================= CONFIRMATION MODAL ================= -->
    <div x-show="open" x-transition.opacity style="display:none"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4 backdrop-blur-md"
         @click.self="open = false" role="dialog" aria-modal="true" aria-labelledby="confirm-title">
        <div class="w-full max-w-lg space-y-5 rounded-2xl border border-emerald-400/40 bg-[#07110E] p-6 text-center shadow-2xl sm:p-8">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full border border-emerald-400 bg-emerald-500/20 text-emerald-400">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div class="space-y-1">
                <span class="text-xs font-semibold uppercase tracking-widest text-emerald-400">Requirement created</span>
                <h3 id="confirm-title" class="text-2xl font-extrabold text-white"><?= $e($demoId) ?></h3>
                <p class="text-sm font-semibold text-emerald-300" x-text="capacityText + ' HA production requirement'"></p>
            </div>
            <p class="text-xs text-gray-400">The requirement has been recorded in NINA Operating System and is ready for capacity mapping.</p>
            <div class="flex flex-col gap-3 pt-2">
                <a href="<?= $basePrefix ?>/capacity-mapping"
                   class="block w-full rounded-full bg-gradient-to-r from-[#6EE7B7] to-[#C9F5DE] py-3.5 text-center text-xs font-bold uppercase tracking-wider text-[#04100B] transition hover:brightness-110">
                    View capacity map &rarr; (Screen 03)
                </a>
                <button type="button" @click="open = false"
                        class="w-full rounded-full border border-white/10 py-2.5 text-xs font-semibold text-gray-400 hover:text-white">
                    Dismiss
                </button>
            </div>
        </div>
    </div>

</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';