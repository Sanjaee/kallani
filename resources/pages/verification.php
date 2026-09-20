<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '17 / Verification — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'verification';

ob_start();
?>

<div class="space-y-8 w-full">
    <div class="flex items-center justify-between border-b border-[#152416] pb-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono text-gray-400 mb-1">
                <span>17</span>
                <span>/</span>
                <span class="text-white font-semibold uppercase">VERIFICATION MATRIX</span>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Independent Verification Vault</h1>
        </div>
        <span class="px-2.5 py-1 rounded text-[10px] font-mono bg-emerald-950 text-emerald-300 border border-emerald-500/40">AUDITED MATRIX</span>
    </div>

    <div class="bg-[#0A110B] border border-[#152416] rounded-xl p-6 space-y-4 font-mono text-xs">
        <div class="flex justify-between items-center py-3 border-b border-[#152416]">
            <span class="text-white font-bold">LAND TITLES & CADASTRAL SURVEY</span>
            <span class="px-3 py-1 rounded bg-emerald-950 text-emerald-400 border border-emerald-500/30">VERIFIED</span>
        </div>
        <div class="flex justify-between items-center py-3 border-b border-[#152416]">
            <span class="text-white font-bold">PRODUCTION PARTNER REPUTATION</span>
            <span class="px-3 py-1 rounded bg-emerald-950 text-emerald-400 border border-emerald-500/30">VERIFIED</span>
        </div>
        <div class="flex justify-between items-center py-3 border-b border-[#152416]">
            <span class="text-white font-bold">SEED SOURCE CERTIFICATION</span>
            <span class="px-3 py-1 rounded bg-emerald-950 text-emerald-400 border border-emerald-500/30">VERIFIED</span>
        </div>
        <div class="flex justify-between items-center py-3 border-b border-[#152416]">
            <span class="text-white font-bold">RSPO / ISPO COMPLIANCE ASSESSMENT</span>
            <span class="px-3 py-1 rounded bg-amber-950 text-amber-300 border border-amber-800">PENDING AUDIT</span>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
