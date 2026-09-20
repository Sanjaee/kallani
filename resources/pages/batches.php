<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '08 / Batches — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'batches';

ob_start();
?>

<div class="space-y-8 w-full">
    <div class="flex items-center justify-between border-b border-[#152416] pb-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono text-gray-400 mb-1">
                <span>08</span>
                <span>/</span>
                <span class="text-white font-semibold uppercase">100 HA PRODUCTION BATCHES</span>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Executable Batches Overview</h1>
        </div>
        <span class="px-2.5 py-1 rounded text-[10px] font-mono bg-emerald-950 text-emerald-300 border border-emerald-500/40">100 HA STANDARD</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-[#0A110B] border border-[#152416] rounded-xl p-6 space-y-4 font-mono text-xs">
            <div class="flex justify-between items-center border-b border-[#152416] pb-3">
                <span class="text-white font-bold text-sm">BATCH NK-001</span>
                <span class="px-2 py-0.5 rounded bg-emerald-950 text-emerald-300 border border-emerald-500/30">100 HA</span>
            </div>
            <div class="flex justify-between py-1 border-b border-[#152416]/40">
                <span class="text-gray-400">Production Requirement</span>
                <span class="text-white font-bold">Rp15,000,000,000</span>
            </div>
            <div class="flex justify-between py-1 border-b border-[#152416]/40">
                <span class="text-gray-400">Min PO Allocation</span>
                <span class="text-emerald-400 font-bold">Rp1,000,000,000</span>
            </div>
            <div class="flex justify-between py-1 border-b border-[#152416]/40">
                <span class="text-gray-400">Contract Horizon</span>
                <span class="text-amber-300 font-bold">20 Years</span>
            </div>
        </div>

        <div class="bg-[#0A110B] border border-[#152416] rounded-xl p-6 space-y-4 font-mono text-xs">
            <div class="flex justify-between items-center border-b border-[#152416] pb-3">
                <span class="text-white font-bold text-sm">BATCH NK-002</span>
                <span class="px-2 py-0.5 rounded bg-emerald-950 text-emerald-300 border border-emerald-500/30">100 HA</span>
            </div>
            <div class="flex justify-between py-1 border-b border-[#152416]/40">
                <span class="text-gray-400">Production Requirement</span>
                <span class="text-white font-bold">Rp15,000,000,000</span>
            </div>
            <div class="flex justify-between py-1 border-b border-[#152416]/40">
                <span class="text-gray-400">Min PO Allocation</span>
                <span class="text-emerald-400 font-bold">Rp1,000,000,000</span>
            </div>
            <div class="flex justify-between py-1 border-b border-[#152416]/40">
                <span class="text-gray-400">Contract Horizon</span>
                <span class="text-amber-300 font-bold">20 Years</span>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
