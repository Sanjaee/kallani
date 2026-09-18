<?php
$config = require __DIR__ . '/../../../config/data.php';
$project = $config['projects'][0];
$operations = $config['operations'];
$metrics = $config['operations_metrics'];
$title = $project['name'] . ' - Operations - Kallani';
ob_start();
?>

<div class="w-full px-0 sm:px-6 pt-0 sm:pt-2 pb-4 sm:pb-10" x-data="{ selectedOp: null }">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-8 pb-6 border-b border-gray-200 dark:border-gray-800 gap-4 text-left">
        <div class="flex flex-col items-start text-left">
            <div class="flex flex-wrap items-center justify-start gap-2 mb-2 text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                    <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Active Concession Operations
                </span>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight text-left">Operational Tracking</h1>
            <p class="text-base text-gray-600 dark:text-gray-400 mt-1 text-left">Monitor project execution, field activities, infrastructure development, and planting progress.</p>
        </div>
        <div class="flex items-center justify-start gap-3 shrink-0 text-left self-start">
            <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 font-medium text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition shadow-sm">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Export Operations Log
            </button>
        </div>
    </div>

    <!-- Operational Metrics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">
        <?php foreach ($metrics as $metric): ?>
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-5 border border-gray-200 dark:border-gray-700/70 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400"><?php echo $metric['name']; ?></span>
            </div>
            <div class="text-3xl font-black text-gray-900 dark:text-white tracking-tight mb-2">
                <?php echo $metric['percentage']; ?>%
            </div>
            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                <div class="bg-emerald-600 dark:bg-emerald-400 h-2 rounded-full" style="width: <?php echo $metric['percentage']; ?>%"></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Recent Operations Table -->
    <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-6 border border-gray-200 dark:border-gray-700/70 shadow-sm">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100 dark:border-gray-700/60">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Recent Field Operations</h3>
            <span class="text-xs text-gray-400">Showing last 5 activity logs</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300 text-xs uppercase font-semibold border-b border-gray-200 dark:border-gray-700">
                        <th class="py-3.5 px-4 rounded-l-xl">Activity</th>
                        <th class="py-3.5 px-4">Area Covered</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Date</th>
                        <th class="py-3.5 px-4">Reference Code</th>
                        <th class="py-3.5 px-4 rounded-r-xl">Contractor</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60 text-sm">
                    <?php foreach ($operations as $op): 
                        $isCompleted = $op['status'] === 'Completed';
                    ?>
                    <tr @click="selectedOp = <?php echo htmlspecialchars(json_encode($op)); ?>" class="cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700/40 transition">
                        <td class="py-4 px-4 font-bold text-gray-900 dark:text-white"><?php echo $op['activity']; ?></td>
                        <td class="py-4 px-4 text-gray-700 dark:text-gray-300 font-medium"><?php echo $op['area']; ?> Ha</td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold <?php echo $isCompleted ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300'; ?>">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo $isCompleted ? 'bg-emerald-500' : 'bg-blue-500'; ?>"></span>
                                <?php echo $op['status']; ?>
                            </span>
                        </td>
                        <td class="py-4 px-4 text-gray-500 dark:text-gray-400"><?php echo $op['date']; ?></td>
                        <td class="py-4 px-4 font-mono font-semibold text-emerald-600 dark:text-emerald-400"><?php echo $op['reference']; ?></td>
                        <td class="py-4 px-4 text-gray-600 dark:text-gray-300"><?php echo $op['contractor']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Operation Detail Modal -->
    <div class="modal" x-show="selectedOp" x-cloak style="display: none;" @click="selectedOp = null">
        <div class="modal-content" @click.stop>
            <button class="modal-close" @click="selectedOp = null">×</button>
            <template x-if="selectedOp">
                <div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white" x-text="selectedOp.activity"></h3>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-100 dark:border-gray-700">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Area Covered</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white" x-text="selectedOp.area + ' Ha'"></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Status</p>
                                <p class="text-lg font-bold text-emerald-600 dark:text-emerald-400" x-text="selectedOp.status"></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Execution Date</p>
                                <p class="text-base font-semibold text-gray-800 dark:text-gray-200" x-text="selectedOp.date"></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Reference Code</p>
                                <p class="text-base font-mono font-semibold text-emerald-600 dark:text-emerald-400" x-text="selectedOp.reference"></p>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <span class="text-xs text-gray-500">Contractor Partner</span>
                            <span class="font-semibold text-gray-800 dark:text-gray-200 text-sm" x-text="selectedOp.contractor"></span>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
