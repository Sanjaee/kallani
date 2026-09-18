<?php
$config = require __DIR__ . '/../../../config/data.php';
$project = $config['projects'][0];
$asset = $config['asset'];
$parcels = $config['parcels'];
$title = $project['name'] . ' - Asset - Kallani';
ob_start();
?>

<div class="w-full px-0 sm:px-6 pt-0 sm:pt-2 pb-4 sm:pb-10" x-data="{ selectedParcel: null }">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-6 pb-4 border-b border-gray-200 dark:border-gray-800 gap-4 text-left">
        <div class="flex flex-col items-start text-left">
            <div class="flex flex-wrap items-center justify-start gap-2 mb-2 text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                    <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    GIS Verified Concession
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                    <svg class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                    <?php echo $asset['survey_coverage']; ?>% Surveyed
                </span>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight text-left">Asset Intelligence</h1>
            <p class="text-base text-gray-600 dark:text-gray-400 mt-1 text-left">Comprehensive view of physical land parcels, cultivation status, and boundary verification.</p>
        </div>
        <div class="flex items-center justify-start gap-3 shrink-0 text-left self-start">
            <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 font-medium text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition shadow-sm">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Export GIS Parcels
            </button>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <!-- Left Column: Asset Breakdown & Metrics -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700/70 rounded-2xl p-6 shadow-sm">
                <h3 class="text-xl font-bold mb-5 text-gray-900 dark:text-white">Asset Breakdown</h3>
                <div class="space-y-3.5">
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100 dark:border-gray-700/60">
                        <span class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Area</span>
                        <span class="font-bold text-gray-900 dark:text-white text-base"><?php echo number_format($asset['total_area']); ?> Ha</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100 dark:border-gray-700/60">
                        <span class="text-gray-500 dark:text-gray-400 text-sm font-medium">Cultivated</span>
                        <span class="font-bold text-emerald-600 dark:text-emerald-400 text-base"><?php echo number_format($asset['cultivated']); ?> Ha</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100 dark:border-gray-700/60">
                        <span class="text-gray-500 dark:text-gray-400 text-sm font-medium">Development</span>
                        <span class="font-bold text-blue-600 dark:text-blue-400 text-base"><?php echo number_format($asset['development']); ?> Ha</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 dark:text-gray-400 text-sm font-medium">Reserved</span>
                        <span class="font-bold text-gray-600 dark:text-gray-300 text-base"><?php echo number_format($asset['reserved']); ?> Ha</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700/70 rounded-2xl p-6 shadow-sm">
                <h3 class="text-xl font-bold mb-5 text-gray-900 dark:text-white">Verification Metrics</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <span class="text-gray-600 dark:text-gray-300 text-sm font-medium">Survey Coverage</span>
                            <span class="font-bold text-emerald-600 dark:text-emerald-400"><?php echo $asset['survey_coverage']; ?>%</span>
                        </div>
                        <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                            <div class="bg-emerald-600 dark:bg-emerald-400 h-full rounded-full" style="width: <?php echo $asset['survey_coverage']; ?>%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <span class="text-gray-600 dark:text-gray-300 text-sm font-medium">Boundary Verification</span>
                            <span class="font-bold text-emerald-600 dark:text-emerald-400"><?php echo $asset['boundary_verification']; ?>%</span>
                        </div>
                        <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                            <div class="bg-emerald-600 dark:bg-emerald-400 h-full rounded-full" style="width: <?php echo $asset['boundary_verification']; ?>%"></div>
                        </div>
                    </div>
                </div>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-5 pt-4 border-t border-gray-100 dark:border-gray-700/60">Last GIS Audit Review: <?php echo $asset['last_review']; ?></p>
            </div>
        </div>

        <!-- Right Column: Land Parcel Map -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700/70 rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-5 pb-3 border-b border-gray-100 dark:border-gray-700/60">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Land Parcel Map</h3>
                    <div class="flex items-center gap-3 text-xs">
                        <span class="inline-flex items-center gap-1 text-emerald-600 dark:text-emerald-400 font-semibold"><span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span> Cultivated</span>
                        <span class="inline-flex items-center gap-1 text-blue-600 dark:text-blue-400 font-semibold"><span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span> Developing</span>
                        <span class="inline-flex items-center gap-1 text-gray-500 dark:text-gray-400 font-semibold"><span class="w-2.5 h-2.5 rounded-full bg-gray-400"></span> Reserved</span>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-900/60 p-4 md:p-6 rounded-xl overflow-x-auto overflow-y-auto max-h-[550px] border border-gray-100 dark:border-gray-800">
                    <svg viewBox="0 0 810 435" class="w-full h-auto min-w-[700px] border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-800 p-2 shadow-inner">
                        <?php
                        $cellWidth = 190;
                        $cellHeight = 95;
                        $padding = 10;
                        
                        $colorMap = [
                            'Cultivated' => '#059669',
                            'Developing' => '#3B82F6',
                            'Reserved' => '#6B7280',
                            'Under Review' => '#F59E0B'
                        ];

                        foreach ($parcels as $parcel):
                            $x = $padding + ($parcel['col'] * ($cellWidth + $padding));
                            $y = $padding + ($parcel['row'] * ($cellHeight + $padding));
                            $color = $colorMap[$parcel['status']] ?? '#E5E5E5';
                        ?>
                        <g class="parcel-group cursor-pointer hover:opacity-100 transition-all transform hover:scale-[1.01]" @click="selectedParcel = <?php echo htmlspecialchars(json_encode($parcel)); ?>" style="opacity: 0.95;">
                            <rect x="<?php echo $x; ?>" y="<?php echo $y; ?>" width="<?php echo $cellWidth; ?>" height="<?php echo $cellHeight; ?>" rx="8" ry="8" fill="<?php echo $color; ?>" stroke="#ffffff" stroke-width="2"/>
                            <text x="<?php echo $x + $cellWidth/2; ?>" y="<?php echo $y + $cellHeight/2 - 8; ?>" text-anchor="middle" dominant-baseline="middle" fill="white" font-size="15" font-weight="bold">
                                <?php echo $parcel['id']; ?>
                            </text>
                            <text x="<?php echo $x + $cellWidth/2; ?>" y="<?php echo $y + $cellHeight/2 + 12; ?>" text-anchor="middle" dominant-baseline="middle" fill="white" font-size="12" font-weight="medium" opacity="0.9">
                                <?php echo $parcel['area']; ?> Ha
                            </text>
                        </g>
                        <?php endforeach; ?>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Parcel Detail Modal -->
    <div class="modal" x-show="selectedParcel" x-cloak style="display: none;" @click="selectedParcel = null">
        <div class="modal-content" @click.stop>
            <button class="modal-close" @click="selectedParcel = null">×</button>
            <template x-if="selectedParcel">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white" x-text="'Parcel ' + selectedParcel.id"></h3>
                        <span class="px-3 py-1 rounded-full text-xs font-bold"
                              :class="{
                                  'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300': selectedParcel.status === 'Cultivated',
                                  'bg-blue-100 text-blue-800 dark:bg-blue-950 dark:text-blue-300': selectedParcel.status === 'Developing',
                                  'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300': selectedParcel.status === 'Reserved'
                              }"
                              x-text="selectedParcel.status">
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 my-6 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-100 dark:border-gray-700">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Area Size</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-white" x-text="selectedParcel.area + ' Ha'"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Planted Year</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-white" x-text="selectedParcel.planted ? selectedParcel.planted : 'N/A'"></p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center text-xs text-gray-500">
                        <span>GIS Coordinates Verified</span>
                        <span class="font-mono text-emerald-600 dark:text-emerald-400">Parcel Grid <?php echo $project['id']; ?></span>
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
