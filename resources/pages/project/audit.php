<?php
$config = require __DIR__ . '/../../../config/data.php';
$project = $config['projects'][0];
$audit = $config['audit'];
$title = $project['name'] . ' - Audit Trail - Kallani';
ob_start();
?>

<div class="w-full px-0 sm:px-6 pt-0 sm:pt-2 pb-4 sm:pb-10" x-data="{ selectedEvent: null }">
    <h1 class="text-4xl font-bold mb-2 text-[#171717]">Audit Trail</h1>
    <p class="text-lg text-[#6B6B6B] mb-12">Traceable record of project data and operational events.</p>

    <!-- Audit Timeline -->
    <div class="bg-white border border-[#E5E5E5] rounded-xl p-8 shadow-sm">
        <div class="space-y-8">
            <?php foreach ($audit as $index => $event): 
                $isLast = $index === count($audit) - 1;
            ?>
            <div class="relative pl-8">
                <!-- Timeline Dot -->
                <div class="absolute left-0 top-1.5 w-4 h-4 bg-[#2D5016] rounded-full border-2 border-white ring-2 ring-[#E5E5E5] z-10"></div>
                
                <!-- Timeline Line (Continuous) -->
                <?php if (!$isLast): ?>
                <div class="absolute left-[7px] top-4 bottom-[-2rem] w-[2px] bg-[#E5E5E5] z-0"></div>
                <?php endif; ?>

                <!-- Event Card -->
                <div class="cursor-pointer p-6 bg-[#F0F0EC] rounded-xl hover:bg-[#E5E5E5] transition-all border border-[#E5E5E5]" 
                     @click="selectedEvent = <?php echo htmlspecialchars(json_encode($event)); ?>">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="text-lg font-bold text-[#171717]"><?php echo $event['event']; ?></h4>
                        <span class="text-xs font-bold text-[#2D5016] bg-white px-2.5 py-1 rounded-md border border-[#E5E5E5]"><?php echo $event['reference']; ?></span>
                    </div>
                    <p class="text-xs font-medium text-[#6B6B6B] mb-3"><?php echo $event['date']; ?></p>
                    <div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-white text-[#171717] border border-[#E5E5E5]"><?php echo $event['category']; ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Event Detail Modal -->
    <div class="modal" x-show="selectedEvent" @click="selectedEvent = null" style="display: none;">
        <div class="modal-content max-w-2xl" @click.stop>
            <button class="modal-close" @click="selectedEvent = null">×</button>
            <template x-if="selectedEvent">
                <div>
                    <h3 class="text-2xl font-bold mb-6 text-[#2D5016]" x-text="selectedEvent.event"></h3>
                    
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-[#6B6B6B] text-xs font-medium mb-1">Timestamp</p>
                                <p class="text-sm font-semibold text-[#171717]" x-text="selectedEvent.date + ' — 14:32 UTC'"></p>
                            </div>
                            <div>
                                <p class="text-[#6B6B6B] text-xs font-medium mb-1">Category</p>
                                <p class="text-sm font-semibold text-[#171717]" x-text="selectedEvent.category"></p>
                            </div>
                        </div>

                        <div>
                            <p class="text-[#6B6B6B] text-xs font-medium mb-1">Reference</p>
                            <p class="text-base font-bold text-[#2D5016]" x-text="selectedEvent.reference"></p>
                        </div>

                        <div class="bg-[#F0F0EC] p-4 rounded-lg border border-[#E5E5E5]">
                            <p class="text-[#6B6B6B] text-xs mb-1">Event Details</p>
                            <p class="text-[#171717] font-semibold text-sm" x-text="selectedEvent.event"></p>
                        </div>

                        <div>
                            <p class="text-[#6B6B6B] text-xs font-medium mb-2">Change Type</p>
                            <div class="flex gap-4 items-center">
                                <div>
                                    <p class="text-xs text-[#6B6B6B]">Previous Status</p>
                                    <p class="font-semibold text-xs text-[#171717]">Pending</p>
                                </div>
                                <div class="text-lg text-[#6B6B6B]">→</div>
                                <div>
                                    <p class="text-xs text-[#6B6B6B]">New Status</p>
                                    <p class="font-semibold text-xs text-[#059669]">Updated</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-[#E5E5E5]">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-[#F0F0EC] text-[#171717]">DEMO EVENT</span>
                        <p class="text-xs text-[#6B6B6B] mt-2">This is a demonstration audit event record.</p>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
