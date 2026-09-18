<?php
$config = require __DIR__ . '/../../../config/data.php';
$project = $config['projects'][0];
$esg = $config['esg'];
$title = $project['name'] . ' - ESG & Sustainability - Kallani';
ob_start();
?>

<div class="w-full px-6 pt-2 pb-10">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-8 pb-6 border-b border-gray-200 dark:border-gray-800 gap-4 text-left">
        <div class="flex flex-col items-start text-left">
            <div class="flex flex-wrap items-center justify-start gap-2 mb-2 text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                    <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span data-i18n="auditedEsg">Audited ESG Ratings 2026</span>
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                    <svg class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span data-i18n="rspoCompliant">RSPO & ISPO Compliant</span>
                </span>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight text-left">ESG & Sustainability</h1>
            <p class="text-base text-gray-600 dark:text-gray-400 mt-1 text-left">Environmental impact, community engagement, governance framework, and ecological metrics.</p>
        </div>
        <div class="flex items-center justify-start gap-3 shrink-0 text-left self-start">
            <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 font-medium text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition shadow-sm">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                <span data-i18n="downloadReport">Download ESG Report</span>
            </button>
            <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                <span data-i18n="verifyAudit">Verify Audit Logs</span>
            </button>
        </div>
    </div>

    <!-- Key Metrics Cards (5 Grid) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 md:gap-5 mb-10">
        <!-- 1. Land Under Management -->
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-5 border border-gray-200 dark:border-gray-700/70 shadow-sm hover:shadow-md transition flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Land Management</span>
                    <div class="p-2.5 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                    </div>
                </div>
                <div class="text-3xl font-black text-gray-900 dark:text-white tracking-tight mb-1">
                    <?php echo number_format($esg['land_management']); ?> <span class="text-base font-semibold text-gray-500">Ha</span>
                </div>
            </div>
            <div class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 flex items-center gap-1 mt-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Land Under Management
            </div>
        </div>

        <!-- 2. Protected Area -->
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-5 border border-gray-200 dark:border-gray-700/70 shadow-sm hover:shadow-md transition flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Protected Area</span>
                    <div class="p-2.5 rounded-xl bg-teal-50 dark:bg-teal-950/50 text-teal-600 dark:text-teal-400 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                </div>
                <div class="text-3xl font-black text-gray-900 dark:text-white tracking-tight mb-1">
                    <?php echo number_format($esg['protected_area']); ?> <span class="text-base font-semibold text-gray-500">Ha</span>
                </div>
            </div>
            <div class="text-xs font-semibold text-teal-600 dark:text-teal-400 flex items-center gap-1 mt-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Protected Sanctuary Area
            </div>
        </div>

        <!-- 3. Reforestation -->
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-5 border border-gray-200 dark:border-gray-700/70 shadow-sm hover:shadow-md transition flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Reforestation</span>
                    <div class="p-2.5 rounded-xl bg-green-50 dark:bg-green-950/50 text-green-600 dark:text-green-400 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                </div>
                <div class="text-3xl font-black text-gray-900 dark:text-white tracking-tight mb-1">
                    <?php echo number_format($esg['reforestation']); ?> <span class="text-base font-semibold text-gray-500">Ha</span>
                </div>
            </div>
            <div class="text-xs font-semibold text-green-600 dark:text-green-400 flex items-center gap-1 mt-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                Restoration Planting
            </div>
        </div>

        <!-- 4. Carbon Potential -->
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-5 border border-gray-200 dark:border-gray-700/70 shadow-sm hover:shadow-md transition flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Carbon Potential</span>
                    <div class="p-2.5 rounded-xl bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 00-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                    </div>
                </div>
                <div class="text-3xl font-black text-gray-900 dark:text-white tracking-tight mb-1">
                    <?php echo $esg['carbon_potential']; ?>%
                </div>
            </div>
            <div class="text-xs font-semibold text-blue-600 dark:text-blue-400 flex items-center gap-1 mt-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                High Carbon Sequestration
            </div>
        </div>

        <!-- 5. Water Management -->
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-5 border border-gray-200 dark:border-gray-700/70 shadow-sm hover:shadow-md transition flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Water Management</span>
                    <div class="p-2.5 rounded-xl bg-cyan-50 dark:bg-cyan-950/50 text-cyan-600 dark:text-cyan-400 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                </div>
                <div class="text-3xl font-black text-gray-900 dark:text-white tracking-tight mb-1">
                    <?php echo $esg['water_management']; ?>%
                </div>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-3 overflow-hidden">
                <div class="bg-cyan-500 h-2 rounded-full" style="width: <?php echo $esg['water_management']; ?>%"></div>
            </div>
        </div>
    </div>

    <!-- ESG Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <!-- Environmental Category -->
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-6 border border-gray-200 dark:border-gray-700/70 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100 dark:border-gray-700/60">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5a2.5 2.5 0 002.5-2.5V11a2 2 0 012-2h1.065M12 2a10 10 0 100 20 10 10 0 000-20z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Environmental</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Ecological footprint & conservation</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/80 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                        Score: 92/100
                    </span>
                </div>

                <div class="space-y-5">
                    <?php foreach ($esg['environmental'] as $item): ?>
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200"><?php echo $item['name']; ?></span>
                            <span class="text-sm font-bold text-emerald-600 dark:text-emerald-400"><?php echo $item['value']; ?>%</span>
                        </div>
                        <div class="w-full bg-gray-100 dark:bg-gray-700/60 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-emerald-500 dark:bg-emerald-400 h-2.5 rounded-full transition-all duration-500" style="width: <?php echo $item['value']; ?>%;"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="mt-8 pt-4 border-t border-gray-100 dark:border-gray-700/50 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                <span>Verified by NDPE Policy</span>
                <span class="font-medium text-emerald-600 dark:text-emerald-400">Zero Deforestation</span>
            </div>
        </div>

        <!-- Social Category -->
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-6 border border-gray-200 dark:border-gray-700/70 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100 dark:border-gray-700/60">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-950/70 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Social</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Labor, safety & local communities</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 dark:bg-blue-950/80 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                        Score: 88/100
                    </span>
                </div>

                <div class="space-y-5">
                    <?php foreach ($esg['social'] as $item): 
                        $isPercentage = strpos($item['name'], 'Safety') !== false || strpos($item['name'], 'Programs') !== false || $item['value'] <= 100;
                    ?>
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200"><?php echo $item['name']; ?></span>
                            <span class="text-sm font-bold text-blue-600 dark:text-blue-400"><?php echo $isPercentage ? $item['value'] . '%' : number_format($item['value']); ?></span>
                        </div>
                        <?php if ($isPercentage): ?>
                        <div class="w-full bg-gray-100 dark:bg-gray-700/60 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-blue-500 dark:bg-blue-400 h-2.5 rounded-full transition-all duration-500" style="width: <?php echo min(100, $item['value']); ?>%;"></div>
                        </div>
                        <?php else: ?>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Direct local workers & smallholders employed</div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-100 dark:border-gray-700/50 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                <span>ILO Standards Compliant</span>
                <span class="font-medium text-blue-600 dark:text-blue-400">Fair Wages Certified</span>
            </div>
        </div>

        <!-- Governance Category -->
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-6 border border-gray-200 dark:border-gray-700/70 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100 dark:border-gray-700/60">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-950/70 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Governance</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Compliance, audits & transparency</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 dark:bg-indigo-950/80 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800">
                        Score: 95/100
                    </span>
                </div>

                <div class="space-y-5">
                    <?php foreach ($esg['governance'] as $item): ?>
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200"><?php echo $item['name']; ?></span>
                            <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400"><?php echo $item['value']; ?>%</span>
                        </div>
                        <div class="w-full bg-gray-100 dark:bg-gray-700/60 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-indigo-500 dark:bg-indigo-400 h-2.5 rounded-full transition-all duration-500" style="width: <?php echo $item['value']; ?>%;"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-100 dark:border-gray-700/50 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                <span>Independent Verification</span>
                <span class="font-medium text-indigo-600 dark:text-indigo-400">Quarterly Audits</span>
            </div>
        </div>
    </div>

    <!-- Sustainability Framework Section -->
    <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-8 border border-gray-200 dark:border-gray-700/70 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 pb-6 border-b border-gray-100 dark:border-gray-700/60 gap-4">
            <div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Sustainability Framework & Guiding Principles</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Aligned with international standards including GRI, RSPO, and United Nations SDGs.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">GRI Aligned</span>
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">UN SDG 13 & 15</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Environmental -->
            <div class="p-5 rounded-xl bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-100 dark:border-emerald-900/40">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h4 class="font-bold text-lg text-emerald-900 dark:text-emerald-300">Environmental Impact</h4>
                </div>
                <ul class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>Sustainable land management & HCV preservation</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>Water resource protection & zero-discharge policy</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>High Conservation Value (HCV) biodiversity protection</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>Carbon sequestration & peatland restoration</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>Active native tree reforestation programs</span>
                    </li>
                </ul>
            </div>

            <!-- Social -->
            <div class="p-5 rounded-xl bg-blue-50/50 dark:bg-blue-950/20 border border-blue-100 dark:border-blue-900/40">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/60 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h4 class="font-bold text-lg text-blue-900 dark:text-blue-300">Social Responsibility</h4>
                </div>
                <ul class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-blue-100 dark:bg-blue-900/60 text-blue-600 dark:text-blue-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>ISO 45001 workplace health & safety standards</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-blue-100 dark:bg-blue-900/60 text-blue-600 dark:text-blue-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>Local employment creation & empowerment</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-blue-100 dark:bg-blue-900/60 text-blue-600 dark:text-blue-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>Smallholder plasma community development</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-blue-100 dark:bg-blue-900/60 text-blue-600 dark:text-blue-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>Agronomy skills training & education programs</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-blue-100 dark:bg-blue-900/60 text-blue-600 dark:text-blue-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>Strict non-discrimination & fair labor practices</span>
                    </li>
                </ul>
            </div>

            <!-- Governance -->
            <div class="p-5 rounded-xl bg-indigo-50/50 dark:bg-indigo-950/20 border border-indigo-100 dark:border-indigo-900/40">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-indigo-100 dark:bg-indigo-900/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h4 class="font-bold text-lg text-indigo-900 dark:text-indigo-300">Corporate Governance</h4>
                </div>
                <ul class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-indigo-100 dark:bg-indigo-900/60 text-indigo-600 dark:text-indigo-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>Independent third-party verification & auditing</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-indigo-100 dark:bg-indigo-900/60 text-indigo-600 dark:text-indigo-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>Transparent documentation & public reporting</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-indigo-100 dark:bg-indigo-900/60 text-indigo-600 dark:text-indigo-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>Immutable digital audit log tracking</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-indigo-100 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>Strict anti-corruption & whistleblower protection</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="p-0.5 rounded-full bg-indigo-100 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span>Stakeholder & community grievance mechanism</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
