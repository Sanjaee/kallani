<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '20 / Audit Trail — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'audit';

ob_start();
?>

<div class="space-y-8 w-full">
    <div class="flex items-center justify-between border-b border-[#152416] pb-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono text-gray-400 mb-1">
                <span>20</span>
                <span>/</span>
                <span class="text-white font-semibold uppercase">AUDIT TRAIL LOG</span>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Immutable System Event Logs</h1>
        </div>
        <span class="px-2.5 py-1 rounded text-[10px] font-mono bg-emerald-950 text-emerald-300 border border-emerald-500/40">SIMULATED AUDIT LOG</span>
    </div>

    <div class="bg-[#0A110B] border border-[#152416] rounded-xl p-6 space-y-3 font-mono text-xs">
        <div class="flex justify-between py-2 border-b border-[#152416] text-gray-400">
            <span>20 SEP 2026 14:32 WIB</span>
            <span class="text-emerald-300">BATCH NK-001 Production Batch Parameters Verified</span>
        </div>
        <div class="flex justify-between py-2 border-b border-[#152416] text-gray-400">
            <span>19 SEP 2026 11:15 WIB</span>
            <span class="text-emerald-300">PO-001 Offtake Requirement Registered (DR-2026-001)</span>
        </div>
        <div class="flex justify-between py-2 border-b border-[#152416] text-gray-400">
            <span>18 SEP 2026 09:40 WIB</span>
            <span class="text-emerald-300">RAB Structure Published (Rp15B / 100 HA)</span>
        </div>
        <div class="flex justify-between py-2 border-b border-[#152416] text-gray-400">
            <span>17 SEP 2026 16:20 WIB</span>
            <span class="text-emerald-300">Vendor VEN-001 Reputation Matrix Updated</span>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
