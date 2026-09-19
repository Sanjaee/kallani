<?php
$config = require __DIR__ . '/../../config/data.php';
$projects = $config['projects'];
$title = 'Explore Projects - Kallani';

$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$basePrefix = (strpos($currentPath, '/kallani/public') === 0) ? '/kallani/public' : '';

ob_start();
?>

<div class="max-w-7xl mx-auto px-6 pt-6 pb-16" x-data="{ activeFilter: 'All' }">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
        <div>
            <h1 class="text-4xl font-extrabold mb-2 text-kallani-text dark:text-white tracking-tight">Project Portfolio</h1>
            <p class="text-lg text-kallani-text-secondary dark:text-gray-300">Explore productive natural assets managed through the Kallani operating layer.</p>
        </div>
        <div class="px-4 py-2 bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 rounded-xl text-xs font-bold border border-emerald-200 dark:border-emerald-800/80 shadow-sm">
            Total Projects: <?php echo count($projects); ?>
        </div>
    </div>

    <!-- Interactive Category Filters -->
    <div class="mb-10 flex gap-2.5 flex-wrap">
        <?php
        $categories = ['All', 'Developing', 'Operational', 'Agriculture', 'Forestry', 'Infrastructure'];
        foreach ($categories as $cat):
        ?>
        <button @click="activeFilter = '<?php echo $cat; ?>'" 
                :class="activeFilter === '<?php echo $cat; ?>' ? 'bg-emerald-700 text-white font-bold shadow-md' : 'bg-kallani-surface dark:bg-black/40 text-kallani-text-secondary dark:text-gray-300 hover:text-kallani-text dark:hover:text-white hover:bg-kallani-muted dark:hover:bg-white/10'" 
                class="px-5 py-2.5 text-sm rounded-xl transition-all duration-200 border border-kallani-border dark:border-white/10 cursor-pointer">
            <?php echo $cat; ?>
        </button>
        <?php endforeach; ?>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($projects as $index => $project): 
            $catsJson = htmlspecialchars(json_encode($project['categories'] ?? ['All']), ENT_QUOTES, 'UTF-8');
            $imgFile = !empty($project['image']) ? $project['image'] : '1.jpg';
        ?>
        <div class="card hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between overflow-hidden group bg-white dark:bg-[#141C12] border border-gray-200 dark:border-[#243220]" 
             x-show="<?php echo $catsJson; ?>.includes(activeFilter)" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 scale-95" 
             x-transition:enter-end="opacity-100 scale-100">
            <div>
                <!-- Image Box -->
                <div class="relative h-48 -mx-6 -mt-6 mb-5 overflow-hidden bg-kallani-muted dark:bg-emerald-950/40">
                    <img src="<?php echo $basePrefix; ?>/<?php echo $imgFile; ?>" alt="<?php echo $project['name']; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <span class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold bg-emerald-600 text-white shadow-md">
                        <?php echo $project['category'] ?? 'Agriculture'; ?>
                    </span>
                    <div class="absolute bottom-3 left-4 right-4 flex justify-between items-end text-white">
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-md bg-black/40 backdrop-blur-md border border-white/20">
                            <svg class="w-3.5 h-3.5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <?php echo $project['location']; ?>
                        </span>
                    </div>
                </div>

                <h3 class="text-xl font-bold mb-2 text-kallani-text dark:text-white group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors"><?php echo $project['name']; ?></h3>
                
                <div class="space-y-3 mb-6 pb-6 border-b border-kallani-border dark:border-white/10">
                    <div class="flex gap-2 flex-wrap">
                        <span class="inline-block px-3 py-1 bg-kallani-muted dark:bg-emerald-950/60 text-kallani-text dark:text-emerald-200 text-xs font-semibold rounded-md border dark:border-emerald-800/40">
                            <?php echo $project['asset_type']; ?>
                        </span>
                        <span class="inline-block px-3 py-1 bg-kallani-muted dark:bg-emerald-950/60 text-kallani-text dark:text-emerald-200 text-xs font-semibold rounded-md border dark:border-emerald-800/40">
                            <?php echo number_format($project['area']); ?> Ha
                        </span>
                    </div>
                    <p class="text-xs font-medium text-kallani-text-secondary dark:text-gray-300">Status: <span class="font-bold text-kallani-text dark:text-white"><?php echo $project['status']; ?></span></p>
                </div>

                <div class="space-y-4 mb-6">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-xs font-medium text-kallani-text-secondary dark:text-gray-300">GIS Verification</span>
                            <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400"><?php echo $project['verification']; ?>%</span>
                        </div>
                        <div class="w-full bg-kallani-muted dark:bg-white/10 rounded-full h-2 overflow-hidden">
                            <div class="bg-emerald-600 dark:bg-emerald-500 h-full transition-all duration-500" style="width: <?php echo $project['verification']; ?>%"></div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 text-xs p-3.5 rounded-xl bg-kallani-muted/60 dark:bg-black/50 border border-kallani-border/50 dark:border-white/10">
                        <div>
                            <p class="text-kallani-text-secondary dark:text-gray-300">Capital Required</p>
                            <p class="font-bold text-sm text-kallani-text dark:text-white mt-0.5">$<?php echo number_format($project['capital_required'] / 1000000, 1); ?>M</p>
                        </div>
                        <div>
                            <p class="text-kallani-text-secondary dark:text-gray-300">Capital Committed</p>
                            <p class="font-bold text-sm text-emerald-700 dark:text-emerald-400 mt-0.5">$<?php echo number_format($project['capital_committed'] / 1000000, 1); ?>M</p>
                        </div>
                    </div>
                </div>
            </div>

            <a href="<?php echo $basePrefix; ?>/projects/<?php echo $project['id']; ?>" class="btn-primary block text-center py-3 text-sm font-bold shadow-sm hover:shadow-md transition-all">
                View Project →
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
