<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '10 / My Allocations — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'allocations';

ob_start();
?>

<div class="space-y-8 w-full">
    <div class="flex items-center justify-between border-b border-[#152416] pb-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono text-gray-400 mb-1">
                <span>10</span>
                <span>/</span>
                <span class="text-white font-semibold uppercase">MY PRODUCTION ALLOCATIONS</span>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Mitra Allocation Dashboard</h1>
        </div>
        <span class="px-2.5 py-1 rounded text-[10px] font-mono bg-emerald-950 text-emerald-300 border border-emerald-500/40">REGISTERED ALLOCATION</span>
    </div>

    <div class="bg-[#0A110B] border border-[#152416] rounded-xl p-6 space-y-6">
        <div class="flex justify-between items-center border-b border-[#152416] pb-4">
            <div>
                <span class="text-xs font-mono text-emerald-400 font-bold">BATCH NK-001 (100 HA)</span>
                <h3 class="text-xl font-bold text-white mt-1">Rp1,000,000,000 PO Allocated</h3>
            </div>
            <span class="px-3 py-1 rounded bg-[#0E1F11] text-emerald-300 font-mono text-xs border border-emerald-500/40">
                Milestone 01 Active
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-xs font-mono">
            <div class="bg-[#040804] border border-[#152416] rounded-lg p-4 space-y-1">
                <span class="text-gray-400 block">PO STATUS</span>
                <span class="text-emerald-400 font-bold block">● PO Collected</span>
            </div>
            <div class="bg-[#040804] border border-[#152416] rounded-lg p-4 space-y-1">
                <span class="text-gray-400 block">CURRENT MILESTONE</span>
                <span class="text-emerald-400 font-bold block">● Milestone 01 (RAB)</span>
            </div>
            <div class="bg-[#040804] border border-[#152416] rounded-lg p-4 space-y-1">
                <span class="text-gray-400 block">NEXT MILESTONE</span>
                <span class="text-gray-400 block">○ Milestone 02 (Land Prep)</span>
            </div>
            <div class="bg-[#040804] border border-[#152416] rounded-lg p-4 space-y-1">
                <span class="text-gray-400 block">DELIVERY STATUS</span>
                <span class="text-amber-300 block">Scheduled Year 6</span>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
