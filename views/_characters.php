<div class="row justify-content-center row-cols-1 row-cols-md-4">
    <?php
    $bShowDetail = true;
    foreach ($characters as $character) {
        include '_character.php';
    }
    ?>
</div>

<div class="my-3 text-center">
    <?php include '_pagination.php'; ?>
</div>
