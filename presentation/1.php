<div class="slide">
	<h1>GMIN309</h1>
	<div style="text-align:center">
	<h2>Projet Technologies avancées du Web</h2>
	<p><span>Université Montpellier 2</span></p>
	<p><span style="font-style:italic">Thibaut Marmin - Clément Sipieter</span></p>
	<p>Jeudi 8 Novembre 2012</p>
	</div>
</div>

<div class="slide">
	<h1>Plan</h1>
	
	<ol>
		<li>Présentation du projet</li>
		<li>Modèle des données</li>
		<li>Scraping des données</li>
		<li>Réalisations</li>
	</ol>
</div>
	
<div class="slide">
	<h1>Objectif</h1>
	
	<h3>Mise en ligne des infos de l'UM2</h3>

	<ul>
		<li>Enseignants</li>
		<li>UEs</li>
		<li>Batiments</li>
		<li>Emploi du temps</li>
	</ul>
</div>

<div class="slide">
	<h1>Solutions techniques</h1>
	<h2>Mapping Relationnel &lt;-&gt; RDF</h2>
	<div class="hbox" style="height:auto">
		<table style="width:100%;margin:0;text-align:center;">
			<tr>
				<th style="width:50%">Relationnel</th>
				<th style="width:50%">RDF</th>
			</tr>
			<tr>
				<td>Mature</td>
				<td>Sémantique</td>
			</tr>
			<tr>
				<td>Nombreux outils</td>
				<td>Accès aux données</td>
			</tr>
			<tr>
				<td>Intégrité des données</td>
				<td>Données liées</td>
			</tr>
		</table>
	</div>
	<p>
	Utilisation de D2RQ (serveur)
	</p>
</div>

<div class="slide">
	<h1>Solutions techniques</h1>
	<h2>D2RQ</h2>
	<center>
	<img src="img/architecture_d2rq.png" alt="D2RQ architecture" style="height:15em"/>
	</center>
</div>

<div class="slide">
	<h1>Solutions techniques</h1>
	<h2>D2RQ</h2>
	<h3>Linked Open Data</h3>
	<ul>
		<li>Utiliser des URI comme identifiant</li>
		<li>Utiliser le schéma des URIs HTTP</li>
		<li>Faites en sorte que les URIs délivrent des informations</li>
		<li>Faire des liens vers d'autres corpus de données</li>
	</ul>
</div>
