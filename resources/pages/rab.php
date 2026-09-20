<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '12 / RAB & Production Budget — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'rab';

ob_start();
?>

<div class="space-y-8 w-full">
    <div class="flex items-center justify-between border-b border-[#152416] pb-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono text-gray-400 mb-1">
                <span>12</span>
                <span>/</span>
                <span class="text-white font-semibold uppercase">RAB / PRODUCTION BUDGET</span>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Rp15B Budget Breakdown (Per 100 HA Batch)</h1>
        </div>
        <span class="px-2.5 py-1 rounded text-[10px] font-mono bg-emerald-950 text-emerald-300 border border-emerald-500/40">RP15B / BATCH</span>
    </div>

    <div class="bg-[#0A110B] border border-[#152416] rounded-xl p-6 space-y-6">
        <div class="flex justify-between items-center border-b border-[#152416] pb-4">
            <div>
                <span class="text-xs font-mono text-emerald-400 font-bold">TOTAL PRODUCTION BUDGET</span>
                <div class="text-2xl font-bold font-mono text-white mt-1">Rp15,000,000,000</div>
            </div>
            <span class="text-xs font-mono text-gray-400">Rp150,000,000 / HA</span>
        </div>

        <div class="space-y-3 font-mono text-xs">
            <div class="flex justify-between p-3 bg-[#040804] rounded-lg border border-[#152416]">
                <span class="text-gray-300">01. Land Preparation & Infrastructure (30%)</span>
                <span class="text-emerald-400 font-bold">Rp4,500,000,000</span>
            </div>
            <div class="flex justify-between p-3 bg-[#040804] rounded-lg border border-[#152416]">
                <span class="text-gray-300">02. Seeds & Planting Material (25%)</span>
                <span class="text-emerald-400 font-bold">Rp3,750,000,000</span>
            </div>
            <div class="flex justify-between p-3 bg-[#040804] rounded-lg border border-[#152416]">
                <span class="text-gray-300">03. Fertilization & Field Operations (25%)</span>
                <span class="text-emerald-400 font-bold">Rp3,750,000,000</span>
            </div>
            <div class="flex justify-between p-3 bg-[#040804] rounded-lg border border-[#152416]">
                <span class="text-gray-300">04. Verification & Working Reserve (20%)</span>
                <span class="text-emerald-400 font-bold">Rp3,000,000,000</span>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
