<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <title>Full Stack Tech Test</title>
        <link rel="stylesheet" href="<?php echo e(URL::asset('css/app.css')); ?>">
    </head>
    <body>
        <div id="app">
            <book-listing></book-listing>
        </div>

        <script src="<?php echo e(mix('js/app.js')); ?>"></script>
    </body>
</html>
<?php /**PATH /mnt/c/Users/mofeo/documents/full-stack-tech-test/resources/views/welcome.blade.php ENDPATH**/ ?>