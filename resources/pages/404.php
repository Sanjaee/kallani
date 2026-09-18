<?php
$title = 'Page Not Found - Kallani';
ob_start();
?>

<div class="container-maxw px-6 py-20 text-center">
    <div class="py-20">
        <div class="text-8xl font-bold text-kallani-text-secondary mb-6">404</div>
        <h1 class="text-4xl font-bold mb-4">Page Not Found</h1>
        <p class="text-lg text-kallani-text-secondary mb-12 max-w-md mx-auto">
            The page you're looking for doesn't exist or has been moved. Please return to the home page or explore the Kallani platform.
        </p>
        <div class="flex gap-4 justify-center">
            <a href="/kallani/public/" class="btn-primary">Back to Home</a>
            <a href="/kallani/public/explore" class="btn-secondary">Explore Projects</a>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
