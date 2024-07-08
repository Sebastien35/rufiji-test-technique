<link rel="stylesheet" href="<?= WEBSITE_URL ?>/public/css/exercice.css">

<div class="body-content">
	<h1>Exercices</h1>

	<div class="container">
		<h2>1</h2>
		<h3>Algo</h3>
		<br>
		<?php $tab = [17,3,87,45,27,35,72,2,22,93]; ?>
		<?php print_r($tab); ?><br><br>
		Consigne : écris un algo en PHP qui renvoie l'index de la plus grande valeur paire du tableau.<br>
		<a href="/exercice-algo" target="_blank"><b>Page exercice</b></a>
	</div>

	<div class="container">
		<h2>2</h2>
		<h3>Utilisation de l'API Coingecko</h3> <br>
		Récupérer et afficher le top 100 des cryptos sous forme de tableau :
		<br/>
		<ul>
			<li>Logo</li>
			<li>Nom de la crypto</li>
			<li>Symbol</li>
			<li>Prix en euros et en dollar</li>
			<li>Variation de prix en pourcentage (24h, 7 jours, 30 jours)</li>
			<li>Bonus : afficher la courbe</li>
		</ul> <br><br>
		Documentation : <a href="https://docs.coingecko.com/reference/introduction" target="_blank">https://docs.coingecko.com/reference/introduction</a>
		<br/><br/>Tu es libre d'afficher ça à ta manière, l'idéal serait que ce soit sous forme d'un joli tableau :) 
		<a href="/exercice-coingecko" target="_blank"><b>Page exercice</b></a>
	</div>

	<div class="container">
		<h2>3</h2>
		<h3>Erreur 500 </h3>

		Corrige toutes les erreurs et fais en sorte que cette page affiche bien les informations de l'article (titre, texte et nom de l'auteur) : <a href="/exercice-article"><b>Article</b></a>
	</div>

	<div class="container">
		<h2>4</h2>
		La BDD est composée des tables : posts, posts_lang et users.<br>
		Les utilisateurs 25 et 155 ont commenté l'article 1 :<br />
		<ul>
			<li>Créer la table <b>posts_comments</b> et insérer des commentaires</li>
			<li>Récupérer les 2 commentaires (du plus récent au plus ancien) avec Prénom, Date du commentaire et texte du commentaire.</li>
			<li>Les afficher sur la <a href="/exercice-article"><b><u>page Article</u></b></a></li>
		</ul>
		<br/><br/>Idem pour l'affichage, tu fais comme tu le sens !
	</div>

	<div class="container">
		<h2>5</h2>
		Nous devons transférer tous les articles qui ne le sont pas encore vers la catégorie Crypto, mais je ne souhaite pas le faire à la main.<br />
		Il faut donc faire un script qui transfère les articles existants vers la <b>catégorie Crypto</b>.<br />
		Aussi, n'oublie pas d'incrémenter le compteur d'articles de la catégorie dans la table <i>blog_categories</i> (nb_posts)
		<br/>Tu peux ajouter le script dans le dossier <b>/scripts</b>.
	</div>
</div>