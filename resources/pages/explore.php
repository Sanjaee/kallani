<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '04 / Explore Production Projects — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'explore';

ob_start();
?>

<div class="space-y-8 w-full">
    <div class="flex items-center justify-between border-b border-[#152416] pb-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono text-gray-400 mb-1">
                <span>04</span>
                <span>/</span>
                <span class="text-white font-semibold uppercase">EXPLORE PRODUCTION PROJECTS</span>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Active Production Catalog</h1>
        </div>
        <span class="px-2.5 py-1 rounded text-[10px] font-mono bg-emerald-950 text-emerald-300 border border-emerald-500/40">OPERATIONAL SYSTEM</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($config['projects'] as $p): ?>
        <div class="bg-[#0A110B] border border-[#152416] rounded-xl overflow-hidden hover:border-emerald-600/60 transition group flex flex-col justify-between">
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-mono uppercase bg-emerald-950 text-emerald-300 px-2 py-0.5 rounded border border-emerald-500/30">100 HA BATCH READY</span>
                    <span class="text-xs font-mono text-gray-400"><?php echo number_format($p['area']); ?> HA</span>
                </div>
                <h3 class="text-lg font-bold text-white group-hover:text-emerald-300 transition"><?php echo $p['name']; ?></h3>
                <p class="text-xs text-gray-400"><?php echo $p['location']; ?></p>
            </div>
            <div class="p-6 bg-[#040804] border-t border-[#152416] flex items-center justify-between text-xs font-mono">
                <span class="text-gray-400">Req: Rp15B / Batch</span>
                <a href="<?php echo $basePrefix; ?>/demand" class="text-emerald-400 font-bold hover:underline">Select &rarr;</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
