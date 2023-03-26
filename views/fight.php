<main class="container">
    <div class="row">
        <div class="col-md-4 my-1">
            <?php
            if (isset($characters[0])) {
                $character = $characters[0];
                include '_character.php';
            } else {
                echo 'Vous devez choisir un premier joueur !';
            }
            ?>
        </div>

        <div id="loading-zone" class="col-md-4 my-1 ">
            <?php
            foreach ($_SESSION['fight_messages'] as $sMessage) {
                echo '<p>'. $sMessage .'</p>';
            }
            ?>
        </div>

        <div class="col-md-4 my-1">
            <?php
            if (isset($characters[1])) {
                $character = $characters[1];
                include '_character.php';
            } else {
                echo 'Vous devez choisir un second joueur !';
            }
            ?>
        </div>
    </div>

    <div class="text-center my-3">
        <button id="btn-fight" class="btn btn-primary <?= (count($characters) !== 2) ? 'disabled' : ''; ?>">
            Fight!
        </button>
    </div>
</main>
