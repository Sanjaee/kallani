<?php
$config = require __DIR__ . '/../../../config/data.php';
$project = $config['projects'][0];
$verification = $config['verification'];
$title = $project['name'] . ' - Verification - Kallani';
ob_start();
?>

<div class="w-full px-0 sm:px-6 pt-0 sm:pt-2 pb-4 sm:pb-10" x-data="{ selectedItem: null }">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-8 pb-6 border-b border-gray-200 dark:border-gray-800 gap-4 text-left">
        <div class="flex flex-col items-start text-left">
            <div class="flex flex-wrap items-center justify-start gap-2 mb-2 text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                    <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Third-Party Verified
                </span>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight text-left">Asset Verification</h1>
            <p class="text-base text-gray-600 dark:text-gray-400 mt-1 text-left">Independent verification and asset attestation records.</p>
        </div>
    </div>

    <!-- Overall Verification Score -->
    <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-8 mb-8 border border-gray-200 dark:border-gray-700/70 shadow-sm text-center">
        <p class="text-gray-500 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider mb-2">Overall Verification Status</p>
        <div class="text-5xl font-black text-emerald-600 dark:text-emerald-400 mb-4">82%</div>
        <div class="w-full max-w-md mx-auto bg-gray-100 dark:bg-gray-700 rounded-full h-3 mb-4 overflow-hidden">
            <div class="bg-emerald-600 dark:bg-emerald-400 h-3 rounded-full transition-all duration-500" style="width: 82%"></div>
        </div>
        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Verified Compliance
        </span>
    </div>

    <!-- Verification Checklist -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($verification as $item): 
            $isVerified = $item['status'] === 'Verified';
        ?>
        <div class="bg-white dark:bg-gray-800/80 rounded-2xl p-6 border border-gray-200 dark:border-gray-700/70 shadow-sm hover:shadow-md cursor-pointer transition-all" @click="selectedItem = <?php echo htmlspecialchars(json_encode($item)); ?>">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1">
                    <h4 class="font-bold text-gray-900 dark:text-white text-lg mb-1"><?php echo $item['item']; ?></h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400"><?php echo $item['verification_method'] ?? $item['method']; ?></p>
                </div>
                <div class="p-2.5 rounded-xl <?php echo $isVerified ? 'bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400' : 'bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400'; ?>">
                    <?php if ($isVerified): ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <?php else: ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700/50 flex items-center justify-between">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold <?php echo $isVerified ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300' : 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300'; ?>">
                    <?php echo $item['status']; ?>
                </span>
                <span class="text-xs text-gray-400 dark:text-gray-500 flex items-center gap-1">
                    Click for details
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Verification Detail Modal -->
    <div class="modal" x-show="selectedItem" x-cloak style="display: none;" @click="selectedItem = null">
        <div class="modal-content" @click.stop>
            <button class="modal-close" @click="selectedItem = null">×</button>
            <template x-if="selectedItem">
                <div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white" x-text="selectedItem.item"></h3>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Status</p>
                            <p class="text-lg font-bold text-emerald-600 dark:text-emerald-400" x-text="selectedItem.status"></p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Verification Method</p>
                            <p class="text-base font-semibold text-gray-800 dark:text-gray-200" x-text="selectedItem.method || selectedItem.verification_method"></p>
                        </div>

                        <template x-if="selectedItem.date">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Last Verified</p>
                                <p class="text-base font-semibold text-gray-800 dark:text-gray-200" x-text="selectedItem.date"></p>
                            </div>
                        </template>

                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Reference Code</p>
                            <p class="text-base font-mono font-semibold text-emerald-600 dark:text-emerald-400" x-text="selectedItem.reference"></p>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">DEMO RECORD</span>
                        <p class="text-xs text-gray-400">Verified digital record</p>
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
