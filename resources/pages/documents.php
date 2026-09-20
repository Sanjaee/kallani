<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '15 / Documents — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'documents';

ob_start();
?>

<div class="space-y-8 w-full">
    <div class="flex items-center justify-between border-b border-[#152416] pb-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono text-gray-400 mb-1">
                <span>15</span>
                <span>/</span>
                <span class="text-white font-semibold uppercase">DOCUMENTS VAULT</span>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Cryptographically Hashed Legal Vault</h1>
        </div>
        <span class="px-2.5 py-1 rounded text-[10px] font-mono bg-emerald-950 text-emerald-300 border border-emerald-500/40">HASHED VAULT</span>
    </div>

    <div class="bg-[#0A110B] border border-[#152416] rounded-xl p-6 space-y-4 font-mono text-xs">
        <div class="flex justify-between items-center py-3 border-b border-[#152416]">
            <div>
                <span class="text-white font-bold block">Concession Master Permit (HGU-2026-NK)</span>
                <span class="text-[10px] text-gray-500">Hash: 0x8a9f2c...41b0</span>
            </div>
            <button class="px-3 py-1 rounded bg-[#0E1F11] text-emerald-300 border border-emerald-500/30">Download PDF</button>
        </div>
        <div class="flex justify-between items-center py-3 border-b border-[#152416]">
            <div>
                <span class="text-white font-bold block">Offtake Supply Agreement (DR-2026-001)</span>
                <span class="text-[10px] text-gray-500">Hash: 0x4d1e8a...92c4</span>
            </div>
            <button class="px-3 py-1 rounded bg-[#0E1F11] text-emerald-300 border border-emerald-500/30">Download PDF</button>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
