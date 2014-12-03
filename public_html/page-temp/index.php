<?php
$error = false;
$success = false;
$firstname_error = false;
$lastname_error = false;
$email_error = false;
$email_error_special = false;
$agree_error = false;

if(isset($_POST['mailing-submit'])) {
    $mailing_firstname = htmlspecialchars($_POST['mailing-firstname']);
    $mailing_lastname = htmlspecialchars($_POST['mailing-lastname']);
    $mailing_email = htmlspecialchars($_POST['mailing-email']);

    if($mailing_firstname == '') {
        $firstname_error = true;
        $error = true;
    }

    if($mailing_lastname == '') {
        $lastname_error = true;
        $error = true;
    }

    if($mailing_email == '') {
        $email_error = true;
        $error = true;
    } else if(!filter_var($mailing_email, FILTER_VALIDATE_EMAIL)) {
        $email_error_special = true;
        $error = true;
    }

    if(!isset($_POST['mailing-agree']) || $_POST['mailing-agree'] == '') {
        $agree_error = true;
        $error = true;
    }

    if($error == false) {
        $success = true;
    }
}

include '_header.php';
?>
<main id="main" role="main">
    <div class="container">
        <article class="register-form">
            <div class="border">
                <h1>Vous aussi, petez d'la broue !</h1>
                <?php if(!$success) : ?>
                    <p>Inscrivez-vous pour être averti du lancement du site. <br/>
                        Recevez GRATUITEMENT les invitations et les avantages pour les événements des peteux de broue !</p>
                    <form action="index.php" method="post" class="form-horizontal" role="form">
                        <div class="form-group<?php if($firstname_error) : ?> error<?php endif; ?>">
                            <label for="mailing-firstname" class="control-label">Prénom</label>
                            <input type="text" name="mailing-firstname" id="mailing-firstname" class="form-control" value="<?php if(isset($mailing_firstname)) { echo $mailing_firstname; } ?>">
                            <?php if($firstname_error) : ?>
                                <span class="msg">Veuillez entrer votre prénom</span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group<?php if($lastname_error) : ?> error<?php endif; ?>">
                            <label for="mailing-lastname" class="control-label">Nom</label>
                            <input type="text" name="mailing-lastname" id="mailing-lastname" class="form-control" value="<?php if(isset($mailing_lastname)) { echo $mailing_lastname; } ?>">
                            <?php if($lastname_error) : ?>
                                <span class="msg">Veuillez entrer votre nom</span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group<?php if($email_error) : ?> error<?php endif; ?><?php if($email_error_special) : ?> error-special<?php endif; ?>">
                            <label for="mailing-email" class="control-label">Courriel</label>
                            <input type="email" name="mailing-email" id="mailing-email" class="form-control" value="<?php if(isset($mailing_email)) { echo $mailing_email; } ?>">
                            <?php if($email_error) : ?>
                                <span class="msg">Veuillez entrer votre adresse courriel</span>
                            <?php endif; ?>
                            <?php if($email_error_special) : ?>
                                <span class="msg">Veuillez entrer une adresse courriel valide</span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group<?php if($agree_error) : ?> error<?php endif; ?>">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="mailing-agree" class="custom-checkbox"<?php if(isset($_POST['mailing-agree'])) { echo ' checked'; } ?>> En cochant cette case j'accepte de recevoir les informations concernant lespeteuxdebroue.com par courriel
                                </label>
                                <?php if($agree_error) : ?>
                                    <span class="msg">Veuillez accepter de recevoir les informations concernant lespeteuxdebroue.com par courriel</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <button type="submit" name="mailing-submit" class="btn btn-default"><span>M'inscrire!</span></button>
                    </form>
                <?php else : ?>
                    <p>Merci de vous êtres inscrit à notre liste d'envoi, vous recevrez maintenant toutes les invitations à nos événements.</p>
                <?php endif; ?>
            </div>
        </article>
    </div>
</main>
<?php
include '_footer.php';
?>