<?php
use DebugBar\StandardDebugBar;

// Utilisation de la bibliothèque maximebf/debugbar (via doc)
// https://packagist.org/packages/maximebf/debugbar
$oDebugbar = new StandardDebugBar();
$oDebugbarRenderer = $oDebugbar->getJavascriptRenderer('vendor/maximebf/debugbar/src/DebugBar/Resources');

// Exemple
$oDebugbar['messages']->addMessage('hello world!');
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1">

		<title><?= $seo_title ?? ''; ?> - Evaluation PHP-POO</title>

        <!-- CSS (Webpack) -->
        <link rel="stylesheet" href="public/build/app.css">

        <!-- JS (Webpack) -->
        <script src="public/build/runtime.js"></script>
        <script src="public/build/vendors-node_modules_bootstrap_dist_js_bootstrap_esm_js.js"></script>
        <script src="public/build/app.js"></script>

        <?php echo $oDebugbarRenderer->renderHead(); ?>
	</head>
	<body class="<?= str_replace('.php', '', $sView); ?>">
        <a href="#" id="showDebug">Afficher les données de "debug"</a>
        <pre id="debug">
            <?php
            print_r($_GET);     // Données contenus dans l'url
            print_r($_POST);    // Données de formulaire
            print_r($_SESSION); // Données de session (PHP)
            ?>
        </pre>

        <?php
        include '_header.php';

        // Affichage des messages utilisateurs (flash messages)
        foreach ($_SESSION['flashes'] as $iIdx => $aMessages) {
            foreach ($aMessages as $sType => $sMessage) {
                echo '<div class="alert alert-' . $sType . '">' . $sMessage . '</div>';
            }
            //unset($_SESSION['flashes'][$iIdx]);
        }
        $_SESSION['flashes'] = [];

        if (file_exists('views/'.$sView)) {
            include $sView;
        }

        include '_footer.php';

        echo $oDebugbarRenderer->render();
        ?>
	</body>
</html>
