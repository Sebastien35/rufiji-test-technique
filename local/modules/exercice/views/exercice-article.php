<link rel="stylesheet" href="<?= WEBSITE_URL ?>/public/css/exercice.css">
<div class="body-content">
    <div class="container">
        <?php if(isset($this->view['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= $this->view['error'] ?>
            </div>
        <?php endif; ?>
        <h1>Article</h1>
        Titre de l'article : <?= $this->view['post']['title'] ?>
        <br>
        Texte de l'article : <?= $this->view['post']['content'] ?>
        <br>
        Auteur de l'article : <?= $this->view['post']['author']['first_name'] . ' ' . $this->view['post']['author']['last_name'] ?>
        <br/><br/>
        <h3>Ajouter les commentaires ci-dessous :</h3>
    </div>
</div>