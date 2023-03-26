<?php $iMaxPage = ceil($nb_results / $nb_results_per_page); ?>

<span><?= $nb_results ?> résultats au total</span>
<br />
<nav class="ajax-pagination">
    <?php if ($page > 1) { ?>
        <a class="mx-1" href="#!" data-page="<?= ($page - 1) ?>">Précédent</a>
    <?php } ?>

    <?php for ($i = 1; $i <= $iMaxPage ; $i++) {
        $bIsActive = ($page == $i);
        ?>
        <a class="mx-1 <?= ($bIsActive ? 'active' : ''); ?>" href="#!" data-page="<?= $i ?>"><?= $i ?></a>
    <?php } ?>

    <?php  if ($page < $iMaxPage) { ?>
        <a class="mx-1" href="#!" data-page="<?= ($page + 1) ?>">Suivant</a>
    <?php } ?>
</nav>
