<?php
$config = require __DIR__ . '/../../../config/data.php';
$projectId = $_GET['project_id'] ?? 'north-kalimantan-palm';
$project = null;
foreach ($config['projects'] as $p) {
    if ($p['id'] === $projectId) {
        $project = $p;
        break;
    }
}
if (!$project) {
    $project = $config['projects'][0];
}
$overview = $config['overview'];
$title = $project['name'] . ' - Overview - Kallani';
ob_start();
?>

<div class="w-full px-0 sm:px-6 pt-0 sm:pt-2 pb-4 sm:pb-10">
    <!-- Project Header Banner -->
    <div class="bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700/70 rounded-2xl p-8 mb-8 shadow-sm">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">DEMO</span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/80 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Active Project
                    </span>
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-2"><?php echo $project['name']; ?></h1>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 flex items-center gap-3">
                    <span class="inline-flex items-center gap-1">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <?php echo $project['location']; ?>
                    </span>
                    <span>•</span>
                    <span class="inline-flex items-center gap-1">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        <?php echo $project['asset_type']; ?>
                    </span>
                </p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <span class="px-3.5 py-2 bg-gray-50 dark:bg-gray-700/60 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-xl border border-gray-200 dark:border-gray-600">
                    Area: <?php echo number_format($project['area']); ?> Ha
                </span>
                <span class="px-3.5 py-2 bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 text-xs font-semibold rounded-xl border border-emerald-200 dark:border-emerald-800">
                    Status: <?php echo $project['status']; ?>
                </span>
            </div>
        </div>
    </div>

    <!-- KPI Metric Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Asset Area -->
        <div class="bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700/70 rounded-2xl p-6 hover:shadow-md transition-all">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Asset Area</span>
                <span class="p-2.5 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1"><?php echo number_format($overview['asset_area']); ?> <span class="text-base font-semibold text-gray-500">Ha</span></div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Total verified land parcels</p>
        </div>

        <!-- Development Progress -->
        <div class="bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700/70 rounded-2xl p-6 hover:shadow-md transition-all">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Development Progress</span>
                <span class="p-2.5 rounded-xl bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mb-2"><?php echo $overview['development_progress']; ?>%</div>
            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
                <div class="bg-emerald-600 dark:bg-emerald-400 h-full rounded-full" style="width: <?php echo $overview['development_progress']; ?>%"></div>
            </div>
        </div>

        <!-- Verification Level -->
        <div class="bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700/70 rounded-2xl p-6 hover:shadow-md transition-all">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Verification Level</span>
                <span class="p-2.5 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mb-2"><?php echo $overview['verification']; ?>%</div>
            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
                <div class="bg-emerald-600 dark:bg-emerald-400 h-full rounded-full" style="width: <?php echo $overview['verification']; ?>%"></div>
            </div>
        </div>

        <!-- Capital Required -->
        <div class="bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700/70 rounded-2xl p-6 hover:shadow-md transition-all">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Capital Required</span>
                <span class="p-2.5 rounded-xl bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1">$<?php echo number_format($overview['capital_required'] / 1000000, 1); ?>M</div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Total project capital target</p>
        </div>

        <!-- Capital Committed -->
        <div class="bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700/70 rounded-2xl p-6 hover:shadow-md transition-all">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Capital Committed</span>
                <span class="p-2.5 rounded-xl bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mb-2">$<?php echo number_format($overview['capital_committed'] / 1000000, 1); ?>M</div>
            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
                <div class="bg-emerald-600 dark:bg-emerald-400 h-full rounded-full" style="width: <?php echo ($overview['capital_committed'] / $overview['capital_required']) * 100; ?>%"></div>
            </div>
        </div>

        <!-- Projected Annual Output -->
        <div class="bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700/70 rounded-2xl p-6 hover:shadow-md transition-all">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Projected Output</span>
                <span class="p-2.5 rounded-xl bg-green-50 dark:bg-green-950/50 text-green-600 dark:text-green-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </span>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-white mb-1"><?php echo number_format($overview['projected_output']); ?> <span class="text-base font-semibold text-gray-500">t/yr</span></div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Estimated annual yield</p>
        </div>
    </div>

    <!-- Project Timeline Section -->
    <div class="bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700/70 rounded-2xl p-8 mb-8 shadow-sm">
        <h3 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">Project Timeline</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">
            <?php foreach ($overview['timeline'] as $item): ?>
            <div class="bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 p-5 rounded-xl text-center hover:border-emerald-600 dark:hover:border-emerald-500 transition-colors">
                <div class="text-xl font-extrabold text-emerald-600 dark:text-emerald-400 mb-2"><?php echo $item['year']; ?></div>
                <p class="text-xs font-semibold text-gray-800 dark:text-gray-200"><?php echo $item['event']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Project Status Progress -->
    <div class="bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700/70 rounded-2xl p-8 shadow-sm">
        <h3 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">Operational Status Breakdown</h3>
        <div class="space-y-6">
            <?php foreach ($overview['status_progress'] as $status): ?>
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="font-bold text-sm text-gray-800 dark:text-gray-200"><?php echo $status['name']; ?></span>
                    <span class="text-xs font-extrabold text-emerald-700 dark:text-emerald-300 bg-emerald-100 dark:bg-emerald-950/80 border border-emerald-200 dark:border-emerald-800 px-2.5 py-0.5 rounded-full"><?php echo $status['percentage']; ?>%</span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
                    <div class="bg-emerald-600 dark:bg-emerald-400 h-full rounded-full transition-all duration-500" style="width: <?php echo $status['percentage']; ?>%"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
