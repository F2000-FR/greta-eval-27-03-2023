<main class="container">
    <h1>Tous les personnages</h1>

    <div class="text-end my-3">
        <a class="btn btn-secondary" data-bs-toggle="collapse" href="#createCharacter" role="button"
           aria-expanded="false" aria-controls="createCharacter">
            Nouveau personnage
        </a>
    </div>

    <div class="collapse" id="createCharacter">
        <fieldset class="border p-2">
            <legend>Créer un personnage</legend>

            <!-- L'attribut enctype="multipart/form-data" permet d'upload de fichiers -->
            <form method="POST" enctype="multipart/form-data">
                <div class="row align-items-center my-3">
                    <div class="col-md-4 text-end">
                        <label for="type">Classe</label>
                    </div>
                    <div class="col-md">
                        <select required class="form-control" id="type" name="field_type">
                            <option value="">Choisir votre classe (TODO)</option>
                        </select>
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-4 text-end">
                        <label for="picture">Photo d'illustration</label>
                    </div>
                    <div class="col-md">
                        <input required class="form-control" id="picture" name="field_picture" type="file"/>
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-4 text-end">
                        <label for="name">Nom</label>
                    </div>
                    <div class="col-md">
                        <input required class="form-control" id="name" name="field_name" type="text"/>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-4 text-end">
                        <label for="description">Description</label>
                    </div>
                    <div class="col-md">
                        <textarea required class="form-control" id="description" name="field_description"></textarea>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-secondary w-50" type="submit">Créer</button>
                </div>
            </form>
        </fieldset>
    </div>

    <fieldset class="border p-2">
        <legend>Filtrer les résultats</legend>

        <form class="search-form" action="?page=<?= $_GET['page'] ; ?>"  method="POST">
            <div class="row">
                <div class="col-md-4 my-1">
                    <input class="form-control" id="magic-search" type="text" name="magic-search" value="<?= $_SESSION['characters_criterias']['magic-search'] ?? '' ; ?>"
                           placeholder="Recherche multi-critères">
                </div>

                <div class="col-md-4 my-1">
                    <select class="form-control" id="type" name="type">
                        <option value="">Toutes les classes (TODO)</option>
                    </select>
                </div>

                <div class="col-md-4 my-1">
                    <button class="btn btn-primary w-100" type="submit">Rechercher</button>
                </div>
            </div>
        </form>
    </fieldset>

    <div id="container-ajax" data-search="?page=<?= PAGE_CHARACTER_SEARCH; ?>">
        <div class="text-center">
            <img class="loader" src="public/img/loader.gif" alt="Chargement.." />
        </div>
    </div>
</main>

<script>
    let containerAjax = document.getElementById('container-ajax');

    // == JS ==
    function listenLinks() {
        let links = document.querySelectorAll('#container-ajax .ajax-pagination a');
        Array.from(links).forEach(function (elt) {
            elt.addEventListener('click', function () {
                callAjaxResults(this.getAttribute('data-page'));
            });
        });
    }

    function listenForm() {
        let form = document.querySelector('form.search-form')
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            return false;
        });

        // Objectif : écouter le formulaire (select / input) et déclencher un appel AJAX
        let form_elts = document.querySelectorAll('form.search-form input, form select');
        Array.from(form_elts).forEach(function (elt) {
            elt.addEventListener('change', function () {
                callAjaxResults();
            });
        });

        let btnSearch = document.querySelector('form.search-form button[type=submit]');
        btnSearch.addEventListener('click', function () {
            callAjaxResults();
        });
    }

    /**
     * Solution la plus pertinente : utilisation de fetch/then et des objets URL et FormData
     * Solution générique car construction de l'objet FormData à partir du formulaire
     */
    function callAjaxResults(page = 1)
    {
        // On met en place un loader en attendant les nouvelles informations
        containerAjax.innerHTML = '<div class="text-center"><img class="loader" src="public/img/loader.gif" /></div>';

        // window.location.origin = host + domain
        // window.location.pathname = sub-directory + filename
        let baseUrl = window.location.origin + window.location.pathname;
        let url = new URL(containerAjax.getAttribute('data-search'), baseUrl);

        // Création de l'objet FormData à partir du formulaire
        let formData = new FormData(document.querySelector('form.search-form'));
        formData.append('page', page);

        fetch(url.toString(), {method: 'POST', body: formData})
            .then(function (response) {
                return response.text();
            })
            .then(function (result_text) {
                // Mettre à jour le container
                containerAjax.innerHTML = result_text;

                // Rafraîchir l'écoute des évènements
                listenLinks();
            })
        ;
    }

    /**
     * L'évènement DOMContentLoaded permet à notre code JS de s'exécuter
     * à la fin du chargement de la page par le navigateur
     */
    window.addEventListener('DOMContentLoaded', function() {
        console.log('(js) DOM fully loaded and parsed');

        // Ecoute des liens relatifs à la pagination (a)
        listenLinks();

        // Ecoute des champs de formulaire (select, input)
        listenForm();

        // Ecoute des boutons relatifs à la sélection (button)
        // TODO

        callAjaxResults();
    });
</script>
