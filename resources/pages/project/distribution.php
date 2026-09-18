<?php
$config = require __DIR__ . '/../../../config/data.php';
$project = $config['projects'][0];
$distribution = $config['distribution'];
$title = $project['name'] . ' - Distribution - Kallani';
ob_start();

$totalDeductions = $distribution['operating_cost'] + $distribution['maintenance'] + $distribution['reserve'];
?>

<div class="w-full px-0 sm:px-6 pt-0 sm:pt-2 pb-4 sm:pb-10">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-6 pb-4 border-b border-gray-200 dark:border-gray-800 gap-4 text-left">
        <div class="flex flex-col items-start text-left">
            <div class="flex flex-wrap items-center justify-start gap-2 mb-2 text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                    <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Audited Distribution Ledger
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                    Quarterly Payouts Active
                </span>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight text-left">Revenue & Distribution</h1>
            <p class="text-base text-gray-600 dark:text-gray-400 mt-1 text-left">Flow of project revenue through operating costs, reserves, and net distributable proceeds.</p>
        </div>
        <div class="flex items-center justify-start gap-3 shrink-0 text-left self-start">
            <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 font-medium text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition shadow-sm">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Export Distribution Summary
            </button>
        </div>
    </div>

    <!-- Top Summary Cards (Single Horizontal Row - Sejajar) -->
    <div class="grid grid-cols-3 gap-5 mb-8">
        <!-- Gross Revenue -->
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-5 border border-gray-200 dark:border-gray-700/70 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Gross Revenue</span>
                <div class="p-2.5 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-black text-gray-900 dark:text-white tracking-tight mb-1">
                $<?php echo number_format($distribution['gross_revenue'] / 1000000, 1); ?>M
            </div>
            <p class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 flex items-center gap-1 mt-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                Annual Harvest Proceeds
            </p>
        </div>

        <!-- Total Deductions -->
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-5 border border-gray-200 dark:border-gray-700/70 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Deductions</span>
                <div class="p-2.5 rounded-xl bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-black text-rose-600 dark:text-rose-400 tracking-tight mb-1">
                -$<?php echo number_format($totalDeductions / 1000000, 1); ?>M
            </div>
            <p class="text-xs font-semibold text-rose-500 flex items-center gap-1 mt-2">
                Opex, Maintenance & Reserves
            </p>
        </div>

        <!-- Net Distributable -->
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-5 border border-gray-200 dark:border-gray-700/70 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Net Distributable</span>
                <div class="p-2.5 rounded-xl bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
            <div class="text-3xl font-black text-emerald-600 dark:text-emerald-400 tracking-tight mb-1">
                $<?php echo number_format($distribution['net_distributable'] / 1000000, 1); ?>M
            </div>
            <p class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 flex items-center gap-1 mt-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Available for Investor Distribution
            </p>
        </div>
    </div>

    <!-- Main Grid: Minimalist Waterfall Flow & History Chart -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Revenue Waterfall (Minimalist Step List) -->
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-6 border border-gray-200 dark:border-gray-700/70 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100 dark:border-gray-700/60">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Revenue Waterfall Flow</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Sequential distribution flow from gross to net proceeds</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/80 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                        FY 2026 Model
                    </span>
                </div>

                <div class="space-y-4">
                    <!-- 1. Gross Revenue -->
                    <div class="p-4 rounded-xl bg-emerald-50/70 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-900/40 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                            <div>
                                <h4 class="font-bold text-gray-900 dark:text-white text-sm">Gross Revenue</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Total harvest & palm oil sales</p>
                            </div>
                        </div>
                        <span class="text-xl font-extrabold text-emerald-600 dark:text-emerald-400">$<?php echo number_format($distribution['gross_revenue'] / 1000000, 1); ?>M</span>
                    </div>

                    <!-- 2. Operating Cost -->
                    <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/40 border border-gray-200 dark:border-gray-700 flex items-center justify-between ml-4">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                            <div>
                                <h4 class="font-bold text-gray-800 dark:text-gray-200 text-sm">Operating Cost (Opex)</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Field labor & processing expenses</p>
                            </div>
                        </div>
                        <span class="text-base font-bold text-rose-600 dark:text-rose-400">-$<?php echo number_format($distribution['operating_cost'] / 1000000, 1); ?>M</span>
                    </div>

                    <!-- 3. Maintenance -->
                    <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/40 border border-gray-200 dark:border-gray-700 flex items-center justify-between ml-4">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                            <div>
                                <h4 class="font-bold text-gray-800 dark:text-gray-200 text-sm">Maintenance & Equipment</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Infrastructure upkeep & machinery</p>
                            </div>
                        </div>
                        <span class="text-base font-bold text-rose-600 dark:text-rose-400">-$<?php echo number_format($distribution['maintenance'] / 1000000, 1); ?>M</span>
                    </div>

                    <!-- 4. Reserve -->
                    <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/40 border border-gray-200 dark:border-gray-700 flex items-center justify-between ml-4">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            <div>
                                <h4 class="font-bold text-gray-800 dark:text-gray-200 text-sm">Retained Reserve</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Capital buffer & emergency fund</p>
                            </div>
                        </div>
                        <span class="text-base font-bold text-amber-600 dark:text-amber-400">-$<?php echo number_format($distribution['reserve'] / 1000000, 1); ?>M</span>
                    </div>

                    <!-- 5. Net Distributable -->
                    <div class="p-4 rounded-xl bg-emerald-600 text-white shadow-md flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <h4 class="font-bold text-white text-base">Net Distributable Proceeds</h4>
                                <p class="text-xs text-emerald-100">Final distributable cash flow</p>
                            </div>
                        </div>
                        <span class="text-2xl font-black text-white">$<?php echo number_format($distribution['net_distributable'] / 1000000, 1); ?>M</span>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700/50 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                <span class="px-2.5 py-0.5 rounded-md bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 font-semibold">Simulated Model</span>
                <span>Audited 2026</span>
            </div>
        </div>

        <!-- Revenue History & Projections Chart Card -->
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-6 border border-gray-200 dark:border-gray-700/70 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100 dark:border-gray-700/60">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Revenue Growth & Projections</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Historical revenue trajectory and 2027 forecast</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                        2024 - 2027
                    </span>
                </div>

                <div style="position: relative; height: 320px;" class="flex items-center justify-center">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700/50 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                <span>*2027 values are projected targets</span>
                <span class="font-medium text-emerald-600 dark:text-emerald-400">+20% YoY Growth Target</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const isDark = document.documentElement.classList.contains('dark');
    const textColor = isDark ? '#9CA3AF' : '#6B6B6B';
    const gridColor = isDark ? '#243220' : '#E5E5E5';

    const data = {
        labels: ['2024', '2025', '2026', '2027 (Target)'],
        datasets: [{
            label: 'Gross Revenue ($)',
            data: [3200000, 5700000, 7000000, 8400000],
            borderColor: '#059669',
            backgroundColor: isDark ? 'rgba(5, 150, 105, 0.2)' : 'rgba(5, 150, 105, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.35,
            pointRadius: 6,
            pointBackgroundColor: '#059669',
            pointBorderColor: '#FFFFFF',
            pointBorderWidth: 2
        }]
    };

    new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + (value / 1000000).toFixed(1) + 'M';
                        },
                        color: textColor,
                        font: { family: 'Inter, sans-serif' }
                    },
                    grid: { color: gridColor }
                },
                x: {
                    ticks: {
                        color: textColor,
                        font: { family: 'Inter, sans-serif', weight: '600' }
                    },
                    grid: { color: gridColor }
                }
            }
        }
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
