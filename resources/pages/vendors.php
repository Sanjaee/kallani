<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '13 / Vendors — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'vendors';

ob_start();
?>

<div class="space-y-8 w-full">
    <div class="flex items-center justify-between border-b border-[#152416] pb-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono text-gray-400 mb-1">
                <span>13</span>
                <span>/</span>
                <span class="text-white font-semibold uppercase">VENDOR MARKETPLACE</span>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Verified Ecosystem Suppliers</h1>
        </div>
        <span class="px-2.5 py-1 rounded text-[10px] font-mono bg-emerald-950 text-emerald-300 border border-emerald-500/40">REGISTERED VENDORS</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-[#0A110B] border border-[#152416] rounded-xl p-6 space-y-3 font-mono text-xs">
            <span class="px-2 py-0.5 rounded bg-emerald-950 text-emerald-300 border border-emerald-500/30 text-[10px]">SEED SUPPLIER</span>
            <h3 class="text-base font-bold text-white">PT Superior Seeds Corp</h3>
            <p class="text-gray-400 text-[11px] leading-relaxed">Certified oil palm germplasm & nursery supplier.</p>
            <div class="pt-2 border-t border-[#152416] text-emerald-400 font-bold">Reputation: 98% Verified</div>
        </div>

        <div class="bg-[#0A110B] border border-[#152416] rounded-xl p-6 space-y-3 font-mono text-xs">
            <span class="px-2 py-0.5 rounded bg-emerald-950 text-emerald-300 border border-emerald-500/30 text-[10px]">FERTILIZER VENDOR</span>
            <h3 class="text-base font-bold text-white">AgroNutrient Eco Ltd</h3>
            <p class="text-gray-400 text-[11px] leading-relaxed">Organic & balanced NPK fertilizer distributor.</p>
            <div class="pt-2 border-t border-[#152416] text-emerald-400 font-bold">Reputation: 95% Verified</div>
        </div>

        <div class="bg-[#0A110B] border border-[#152416] rounded-xl p-6 space-y-3 font-mono text-xs">
            <span class="px-2 py-0.5 rounded bg-emerald-950 text-emerald-300 border border-emerald-500/30 text-[10px]">HEAVY MACHINERY</span>
            <h3 class="text-base font-bold text-white">Kalimantan Heavy Ops</h3>
            <p class="text-gray-400 text-[11px] leading-relaxed">Land clearing, trenching, and road infrastructure contractors.</p>
            <div class="pt-2 border-t border-[#152416] text-emerald-400 font-bold">Reputation: 96% Verified</div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
