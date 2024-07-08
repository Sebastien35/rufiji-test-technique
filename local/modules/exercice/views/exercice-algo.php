<link rel="stylesheet" href="<?= WEBSITE_URL ?>/public/css/exercice.css">
<div class="body-content">
    <div class="container">
        <h1>Exercice Algo</h1>
        <h2>Retourner la plus grande valeure paire d'un tableau</h2>
        <!-- <button id="populateArray">Remplir</button>Remplir le tableau</button><br>
        <p>Valeurs : </p><span id="displayArray"></span><br>
        <button id="Trier">Trier</button>Demander au back de trier</button><br>
        <p>Résultat : </p><span id="displayResult"></span> -->
        <p>Tableau généré : </p>
        <?php foreach($this->view['tableau'] as $value): ?>
            <?= $value ?>,
        <?php endforeach; ?>
        <p>Plus grande valeure paire: </p>
        <?= $this->view['ProcessedTableau'] ?>



    </div>
    <!-- <script src="/public/js/exerciceAlgo.js"></script> -->
</div>





