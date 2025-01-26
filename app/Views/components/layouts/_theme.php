<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <?= $title ?? "Task Manager" ?> </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body class="">
        <div class="d-flex flex-column min-vh-100">
            <!-- Header -->
            <header class="bg-light shadow-sm"></header>
            <!-- Main Content -->
            <main class="flex-grow-1">
                <?= $this->renderSection('content') ?>
            </main>
            <!-- Footer -->
            <footer class="bg-light shadow-sm mt-auto"></footer>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>