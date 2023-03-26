<header>
    <nav>
        <a href="?page=<?= PAGE_HOME; ?>">Tous les personnages</a>
        |
        <a href="?page=<?= PAGE_CHARACTER_FIGHT; ?>">
            Fight ! (<?= count($_SESSION['fight_characters']) ; ?> / 2 joueurs)
        </a>
    </nav>
</header>
