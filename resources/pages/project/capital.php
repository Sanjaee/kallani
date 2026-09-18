<?php
$config = require __DIR__ . '/../../../config/data.php';
$project = $config['projects'][0];
$capital = $config['capital'];
$title = $project['name'] . ' - Capital - Kallani';
ob_start();

$committedRatio = ($capital['capital_committed'] / $capital['capital_required']) * 100;
?>

<div class="w-full px-6 pt-2 pb-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-6 pb-4 border-b border-gray-200 dark:border-gray-800 gap-3 text-left">
        <div class="flex flex-col items-start text-left">
            <div class="flex flex-wrap items-center justify-start gap-2 mb-1.5 text-left">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                    <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Institutional Capital Ledger
                </span>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                    <?php echo round($committedRatio, 1); ?>% Funded
                </span>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight text-left">Project Capital</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5 text-left">Illustrative capital requirements and allocation breakdown across project activities.</p>
        </div>
        <div class="flex items-center justify-start gap-3 shrink-0 text-left self-start">
            <button class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 font-medium text-xs hover:bg-gray-50 dark:hover:bg-gray-700 transition shadow-sm">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Download Financial Deck
            </button>
        </div>
    </div>

    <!-- Capital Top Metrics Cards (Compact Single Horizontal Row) -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <!-- Project Value -->
        <div class="bg-white dark:bg-gray-800/80 rounded-xl p-4 border border-gray-200 dark:border-gray-700/70 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Project Valuation</span>
                <div class="p-2 rounded-lg bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="text-2xl font-black text-gray-900 dark:text-white tracking-tight mb-0.5">
                $<?php echo number_format($capital['project_value'] / 1000000, 1); ?>M
            </div>
            <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium">Estimated Gross Value</p>
        </div>

        <!-- Capital Required -->
        <div class="bg-white dark:bg-gray-800/80 rounded-xl p-4 border border-gray-200 dark:border-gray-700/70 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Capital Required</span>
                <div class="p-2 rounded-lg bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
            </div>
            <div class="text-2xl font-black text-gray-900 dark:text-white tracking-tight mb-0.5">
                $<?php echo number_format($capital['capital_required'] / 1000000, 1); ?>M
            </div>
            <p class="text-xs text-amber-600 dark:text-amber-400 font-medium">Total Budget Target</p>
        </div>

        <!-- Capital Committed -->
        <div class="bg-white dark:bg-gray-800/80 rounded-xl p-4 border border-gray-200 dark:border-gray-700/70 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Capital Committed</span>
                <div class="p-2 rounded-lg bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
            <div class="text-2xl font-black text-emerald-600 dark:text-emerald-400 tracking-tight mb-1">
                $<?php echo number_format($capital['capital_committed'] / 1000000, 1); ?>M
            </div>
            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1.5 overflow-hidden">
                <div class="bg-emerald-600 dark:bg-emerald-400 h-1.5 rounded-full" style="width: <?php echo $committedRatio; ?>%"></div>
            </div>
        </div>

        <!-- Remaining Requirement -->
        <div class="bg-white dark:bg-gray-800/80 rounded-xl p-4 border border-gray-200 dark:border-gray-700/70 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Remaining Gap</span>
                <div class="p-2 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path></svg>
                </div>
            </div>
            <div class="text-2xl font-black text-gray-900 dark:text-white tracking-tight mb-0.5">
                $<?php echo number_format($capital['remaining_requirement'] / 1000000, 1); ?>M
            </div>
            <p class="text-xs text-indigo-600 dark:text-indigo-400 font-medium">Series B Funding Gap</p>
        </div>
    </div>

    <!-- Capital Allocation Section (Compact 2-Column Grid) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart Card -->
        <div class="bg-white dark:bg-gray-800/80 rounded-xl p-5 border border-gray-200 dark:border-gray-700/70 shadow-sm">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-100 dark:border-gray-700/60">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Capital Allocation Chart</h3>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                    Total: $<?php echo number_format($capital['capital_required'] / 1000000, 1); ?>M
                </span>
            </div>
            <div style="position: relative; height: 240px;" class="flex items-center justify-center">
                <canvas id="capitalChart"></canvas>
            </div>
        </div>

        <!-- Breakdown Details Card -->
        <div class="bg-white dark:bg-gray-800/80 rounded-xl p-5 border border-gray-200 dark:border-gray-700/70 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-100 dark:border-gray-700/60">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Allocation Breakdown</h3>
                    <span class="text-xs text-gray-400">% Share</span>
                </div>

                <div class="space-y-4">
                    <?php 
                    $colors = ['#059669', '#2D5016', '#3B82F6', '#D97706'];
                    $i = 0;
                    foreach ($capital['allocation'] as $item): 
                        $percentage = ($item['amount'] / $capital['capital_required']) * 100;
                        $color = $colors[$i % count($colors)];
                        $i++;
                    ?>
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full" style="background-color: <?php echo $color; ?>;"></span>
                                <span class="text-xs font-semibold text-gray-800 dark:text-gray-200"><?php echo $item['category']; ?></span>
                            </div>
                            <span class="text-xs font-bold text-gray-900 dark:text-white">$<?php echo number_format($item['amount'] / 1000000, 1); ?>M (<?php echo round($percentage, 1); ?>%)</span>
                        </div>
                        <div class="w-full bg-gray-100 dark:bg-gray-700/60 rounded-full h-2 overflow-hidden">
                            <div class="h-2 rounded-full transition-all duration-500" style="width: <?php echo $percentage; ?>%; background-color: <?php echo $color; ?>;"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700/50 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                <span class="px-2 py-0.5 rounded-md bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 text-[11px] font-semibold">
                    Simulated Financial Model
                </span>
                <span class="text-[11px]">Audited 2026</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('capitalChart').getContext('2d');
    
    const isDark = document.documentElement.classList.contains('dark');
    const textColor = isDark ? '#9CA3AF' : '#6B6B6B';
    const borderColor = isDark ? '#141C12' : '#FFFFFF';

    const data = {
        labels: ['Development', 'Operations', 'Infrastructure', 'Reserve'],
        datasets: [{
            data: [8000000, 5000000, 7000000, 4000000],
            backgroundColor: ['#059669', '#2D5016', '#3B82F6', '#D97706'],
            borderColor: borderColor,
            borderWidth: 2
        }]
    };

    new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        font: { size: 12, family: 'Inter, sans-serif', weight: '500' },
                        color: textColor,
                        padding: 12
                    }
                }
            },
            cutout: '68%'
        }
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
