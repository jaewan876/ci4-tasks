<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <?= esc($title) ?> - Task Manager </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">    </head>
    <body class="">
        <div class="d-flex flex-column min-vh-100">
            <!-- Header -->
            <header class="bg-light shadow-sm">
                <div class="container py-3 d-flex justify-content-between align-items-center">
                    <h1 class="h4 mb-0">
                        <a class="brand" href="<?= base_url('/') ?>">Tasks</a>
                    </h1>
                    <nav>
                        <ul class="nav">
                            <li class="nav-item">
                                <a href="<?= base_url('/') ?>" class="nav-link text-dark">Home </a>
                            </li>

                            <?php if (session()->has('user')): ?>
                            <li class="nav-item">
                                <a href="<?= base_url('/tasks') ?>" class="nav-link text-dark">Tasks </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('/profile') ?>" class="nav-link text-dark">Profile </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('/logout') ?>" class="nav-link text-dark">Logout </a>
                            </li>
                            <?php else: ?>
                            <li class="nav-item">
                                <a href="<?= base_url('/login') ?>" class="nav-link text-dark">Login </a>
                            </li>
                            <?php endif ?>
                        </ul>
                    </nav>
                </div>
            </header>
            <!-- Main Content -->
            <main class="flex-grow-1">
                <?= $this->renderSection('content') ?>
            </main>
            <!-- Footer -->
            <footer class="bg-light shadow-sm mt-auto">
                <div class="container py-3 text-center">
                    <p class="mb-0">&copy; <?= date('Y') ?> Task Manager. All rights reserved. </p>
                    <small>Designed by Jae Wan</small>
                </div>
            </footer>
        </div>
        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

         <!-- CKEditor Script -->
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script> 
        <script>
            // Initialize CKEditor 5
            // ClassicEditor
            //     .create(document.querySelector('#editor'), {
            //         toolbar: ['bold', 'italic', 'link', 'code'],
            //         codeBlock: {
            //             languages: [
            //                 { language: 'javascript', label: 'JavaScript' },
            //                 { language: 'python', label: 'Python' },
            //                 { language: 'java', label: 'Java' }
            //             ]
            //         }
            //     })
            //     .catch(error => {
            //         console.error(error);
            //     });

            ClassicEditor
            .create( document.querySelector( '#editor' ), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'blockQuote', '|', 'link', 'image', 'mediaEmbed', '|', 'codeBlock', '|', 'indent', 'outdent', '|', 'horizontalLine' ],
                    codeBlock: {
                        languages: [
                            { language: 'javascript', label: 'JavaScript' },
                            { language: 'python', label: 'Python' },
                            { language: 'java', label: 'Java' }
                        ]
                    }
            } )
            .then( editor => {
                console.log( editor ); 
            } )
            .catch( error => {
                console.error( error ); 
            } );
        </script>

    </body>
</html>