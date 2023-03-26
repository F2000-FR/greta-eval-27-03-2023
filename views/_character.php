<div class="col my-2">
    <div class="card h-100 m-1">
        <img src="https://fakeimg.pl/440x320/282828/eae0d0/?retina=1" class="card-img-top" alt="Illustration">
        <div class="card-body">
            <h5 class="card-title text-center">Aragorn...</h5>
            <p class="card-text">.............</p>
        </div>
        <div class="card-footer text-center ">
            <div class="progress my-1" role="progressbar" aria-label="Santé" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-successs" style="width: 50%">
                    Santé : ..
                </div>
            </div>
            <div class="progress my-1" role="progressbar" aria-label="Force" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-warning" style="width: 50%">
                    Force : ..
                </div>
            </div>

            <div class="progress my-1" role="progressbar" aria-label="Magie" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-info" style="width: 50%">
                    Magie : ..
                </div>
            </div>

            <?php if ($bShowDetail ?? false) : ?>
                <hr />

                <div class="row">
                    <div class="col-12 my-2">
                        <a class="btn btn-secondary w-100" href="#">
                            Voir la fiche
                        </a>
                    </div>
                    <div class="col-12 my-2">
                        <a class="btn btn-primary <?= in_array($character, $_SESSION['fight_characters']) ? 'active' : ''; ?> w-100" href="#!">
                            <?= in_array($character, $_SESSION['fight_characters']) ? 'Joueur sélectionné' : 'Sélectionner le joueur'; ?>
                        </a>
                    </div>
                </div>
                <small class="text-muted">
                    Créé le..
                </small>
            <?php endif; ?>
        </div>
    </div>
</div>
