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
                        <input type="text" name="mailing-firstname" id="mailing-firstname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="mailing-lastname" class="control-label">Nom</label>
                        <input type="text" name="mailing-lastname" id="mailing-lastname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="mailing-email" class="control-label">Courriel</label>
                        <input type="text" name="mailing-email" id="mailing-email" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="mailing-agree" class="custom-checkbox"> En cochant cette case j'accepte de recevoir les informations concernant lespeteuxdebroue.com par courriel
                            </label>
                        </div>
                    </div>
                    <button type="submit" name="mailing-submit" class="btn btn-default"><span>M'inscrire!</span></button>
                </form>
            </div>
        </article>
    </div>
</main>
<?php
include '_footer.php';
?>