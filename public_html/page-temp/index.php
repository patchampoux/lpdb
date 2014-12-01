<?php
include '_header.php';
?>
<main id="main" role="main">
    <div class="container">
        <article class="register-form">
            <div class="border">
                <h1>Vous aussi, petez d'la broue !</h1>
                <p>Inscrivez-vous pour être averti du lancement du site. <br/>
                    Recevez GRATUITEMENT les invitations et les avantages pour les événements des peteux de broue !</p>
                <form action="#" method="post" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="mailing-firstname" class="control-label">Prénom</label>
                        <input type="text" class="form-control" name="mailing-firstname" id="mailing-firstname">
                    </div>
                    <div class="form-group">
                        <label for="mailing-lastname" class="control-label">Nom</label>
                        <input type="text" class="form-control" name="mailing-lastname" id="mailing-lastname">
                    </div>
                    <div class="form-group">
                        <label for="mailing-email" class="control-label">Courriel</label>
                        <input type="text" class="form-control" name="mailing-email" id="mailing-email">
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> En cochant cette case j'accepte de recevoir les informations concernant lespeteuxdebroue.com par courriel
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 text-center">
                            <button type="submit" class="btn btn-default"><span>M'inscrire!</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </article>
    </div>
</main>
<?php
include '_footer.php';
?>