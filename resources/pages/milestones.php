<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '11 / Milestones — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'milestones';

ob_start();
?>

<div class="space-y-8 w-full">
    <div class="flex items-center justify-between border-b border-[#152416] pb-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono text-gray-400 mb-1">
                <span>11</span>
                <span>/</span>
                <span class="text-white font-semibold uppercase">MILESTONE CONTROL</span>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Milestone Release Matrix (1–4)</h1>
        </div>
        <span class="px-2.5 py-1 rounded text-[10px] font-mono bg-emerald-950 text-emerald-300 border border-emerald-500/40">VERIFIED EXECUTION</span>
    </div>

    <div class="bg-[#0A110B] border border-[#152416] rounded-xl p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-[#040804] border border-emerald-500/40 rounded-xl p-5 space-y-2">
                <span class="text-xs font-mono text-emerald-400 font-bold block">MILESTONE 01</span>
                <h4 class="text-sm font-bold text-white">RAB & PO Collection</h4>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-emerald-950 text-emerald-300 border border-emerald-500/30">COMPLETED</span>
            </div>
            <div class="bg-[#040804] border border-[#152416] rounded-xl p-5 space-y-2">
                <span class="text-xs font-mono text-gray-400 font-bold block">MILESTONE 02</span>
                <h4 class="text-sm font-bold text-white">Land Clearing & Prep</h4>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-amber-950 text-amber-300 border border-amber-800">IN PROGRESS</span>
            </div>
            <div class="bg-[#040804] border border-[#152416] rounded-xl p-5 space-y-2">
                <span class="text-xs font-mono text-gray-400 font-bold block">MILESTONE 03</span>
                <h4 class="text-sm font-bold text-white">Planting & Infrastructure</h4>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-white/5 text-gray-400">PENDING</span>
            </div>
            <div class="bg-[#040804] border border-[#152416] rounded-xl p-5 space-y-2">
                <span class="text-xs font-mono text-gray-400 font-bold block">MILESTONE 04</span>
                <h4 class="text-sm font-bold text-white">Commercial Harvest</h4>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-white/5 text-gray-400">PENDING</span>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
