<?php
$config = require __DIR__ . '/../../../config/data.php';
$project = $config['projects'][0];
$documents = $config['documents'];
$title = $project['name'] . ' - Documents - Kallani';
ob_start();
?>

<div class="w-full px-6 pt-2 pb-10" x-data="{ selectedDoc: null }">
    <h1 class="text-4xl font-bold mb-2">Project Documents</h1>
    <p class="text-lg text-kallani-text-secondary mb-12">Access project documentation, reports, and verification records.</p>

    <!-- Document Vault -->
    <div class="space-y-8">
        <?php foreach ($documents as $category => $docs): ?>
        <div class="card">
            <h3 class="text-2xl font-bold mb-6"><?php echo $category; ?></h3>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Document</th>
                            <th>Reference</th>
                            <th>Size</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($docs as $doc): ?>
                        <tr>
                            <td class="font-semibold"><?php echo $doc['name']; ?></td>
                            <td class="text-kallani-accent"><?php echo $doc['reference']; ?></td>
                            <td><?php echo $doc['size']; ?></td>
                            <td><?php echo $doc['date']; ?></td>
                            <td>
                                <button @click="selectedDoc = <?php echo htmlspecialchars(json_encode($doc)); ?>" class="btn-secondary text-xs">
                                    View
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Document Preview Modal -->
    <div class="modal" x-show="selectedDoc" @click="selectedDoc = null" style="display: none;">
        <div class="modal-content max-w-lg" @click.stop>
            <button class="modal-close" @click="selectedDoc = null">×</button>
            <template x-if="selectedDoc">
                <div>
                    <h3 class="text-2xl font-bold mb-4" x-text="selectedDoc.name"></h3>
                    
                    <div class="bg-kallani-muted rounded-lg p-8 text-center mb-6 min-h-[200px] flex items-center justify-center">
                        <div>
                            <svg class="w-12 h-12 text-kallani-text-secondary mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <p class="text-sm text-kallani-text-secondary">Document Preview</p>
                            <p class="text-xs text-kallani-text-secondary mt-2" x-text="selectedDoc.size"></p>
                        </div>
                    </div>

                    <div class="space-y-4 border-t border-kallani-border pt-6">
                        <div>
                            <p class="text-kallani-text-secondary text-sm">Document Reference</p>
                            <p class="font-bold text-kallani-accent" x-text="selectedDoc.reference"></p>
                        </div>
                        <div>
                            <p class="text-kallani-text-secondary text-sm">Status</p>
                            <p class="font-bold">
                                <span class="badge badge-verified">Verified</span>
                            </p>
                        </div>
                        <div>
                            <p class="text-kallani-text-secondary text-sm">Uploaded</p>
                            <p class="font-bold" x-text="selectedDoc.date"></p>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-kallani-border">
                        <span class="badge badge-demo">DEMO DOCUMENT</span>
                        <p class="text-xs text-kallani-text-secondary mt-3">This is a demonstration document record. Actual file viewing is not available in this demo environment.</p>
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
