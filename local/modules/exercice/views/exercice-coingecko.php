<link rel="stylesheet" href="<?= WEBSITE_URL ?>/public/css/exercice.css">
<div class="body-content">
    <div class="container">

        
        <h1>Exercice coingecko</h1>
        <p>Voici les 100 premières cryptomonnaies sur coingecko</p>
        <p>Taux de change EUR / USD :<?= $this->view['rate'] ?> </p><a href="https://app.currencyapi.com" target="_blank">Source</a>

        <?php if(isset($this->view['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= $this->view['error'] ?>
            </div>
        <?php endif; ?>
        <?php if(isset($this->view['cryptos'])): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Rang</th>
                        <th>Logo</th>
                        <th>Nom</th>
                        <th>Symbol</th>
                        <th>€</th>
                        <th>$</th>
                        <th>Variation 24h</th>
                        <th>Variation 7j</th>
                        <th>Variation 30j</th>
                        <th>Evolution 7 jours</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($this->view['cryptos'] as $crypto): ?>
                        <tr>  
                            <td><?= $crypto['market_cap_rank'] ?></td>
                            <td><img src="<?= $crypto['image'] ?>" alt="<?= $crypto['name'] ?>" style="width: 25px;"></td>
                            <td><?= $crypto['name'] ?></td>
                            <td><?= $crypto['symbol']?></td>
                            <td><?= round($crypto['current_price'], 4) ?></td>
                            <td><?= round($crypto['current_price']*$this->view['rate'], 4) ?></td>
                            <td class="var"><?= round($crypto['price_change_percentage_24h_in_currency'], 2) ?>%</td>
                            <td class="var"><?= round($crypto['price_change_percentage_7d_in_currency'], 2) ?>%</td>
                            <td class="var"><?= round($crypto['price_change_percentage_30d_in_currency'],2) ?>%</td>
                            <td>
                                <canvas class="canvases" data-prices="<?= json_encode($crypto['sparkline_in_7d']['price']) ?>" ></canvas>
                            </td>
                            

                            
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="alert alert-info" role="alert">
                Chargement des données...
            </div>
        <?php endif; ?>
        
        <script>
            let canvases = document.querySelectorAll('.canvases');
            canvases.forEach(canvas => {
        let ctx = canvas.getContext('2d');
        let prices = JSON.parse(canvas.getAttribute('data-prices'));
        

        canvas.width = 200; // Je pense qu'il faudrait l'enlever en cas de mobile, ou alors l'inclure sur une page détails
        canvas.height = 25; // Même taille que les images
        let width = canvas.width;
        let height = canvas.height;
        let dataLength = prices.length;
        
        let maxPrice = Math.max(...prices);
        let minPrice = Math.min(...prices);
        let range = maxPrice - minPrice;

        ctx.clearRect(0, 0, width, height);
        ctx.fillStyle = 'rgba(0, 0, 0, 0)'; // Fond transparent
        ctx.fillRect(0, 0, width, height);
        
        ctx.beginPath();
        ctx.moveTo(0, height);
        
        // Placer les points à partir des données
        prices.forEach((price, index) => {
            let x = index / (dataLength - 1) * width;
            let y = height - (price - minPrice) / range * height;
            ctx.lineTo(x, y);
        });
        
        ctx.lineTo(width, height); 
        ctx.closePath();
        
        // Tracer que la courbe
        ctx.strokeStyle = 'rgba(0, 0, 255, 1)'; 
        ctx.stroke();
        
        
    });

    const variables = document.querySelectorAll('.var');
    variables.forEach(variable => {
        let value = parseFloat(variable.textContent);
        if(value > 0){
            variable.style.color = 'green';
        } else if(value < 0){
            variable.style.color = 'red';
        }
    });



        </script>
            
        
    </div>
</div>





