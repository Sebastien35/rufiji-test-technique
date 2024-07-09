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
        <h3>Commentaires</h3>
        <?php if(count($this->view['commentaires']) == 0): ?>
            <p>Aucun commentaire</p>
        <?php else: ?>
            <?php foreach($this->view['commentaires'] as $commentaire): ?>
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <?= $commentaire['created_at'] ?>
                    </div>
                    <div class="card-body">
                        <p><?= $commentaire['comment'] ?></p>
                        <p class="text-muted">Posté par <?= $commentaire['firstname'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>