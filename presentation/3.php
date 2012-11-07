<div class="slide">
	<h1>Plan</h1>
	
	<ol>
		<li>Présentation du projet</li>
		<li>Modèle de données</li>
		<li><b><u>Scraping des données</u></b></li>
		<li>Réalisations</li>
	</ol>
</div>

<div class="slide">
	<h1>Scraping de données</h1>
	
	<ul>
		<li>Emploi du temps (ADE)</li>
		<li>Batiments (LinkedGeoData)</li>
		<li>Enseignants</li>
		<li>UEs (w3b)</li>
	</ul>
</div>

<div class="slide">
	<h1>Scraping de données</h1>
	
	<h2>Enseignants</h2>
	<ul>
			<li>Annuaire du LIRMM</li>
		</ul>
	<p>http://www.lirmm.fr/xml/fr/0011-09.html</p>
	<object data="http://www.lirmm.fr/xml/fr/0011-09.html" type="text/html" width="100%" height="100%">
	</object>
</div>

<div class="slide">
	<h1>Scraping de données</h1>
	
	<h2>Enseignants</h2>
	<ul>
			<li>Annuaire du LIRMM</li>
		</ul>
	<p>Format HTML</p>
	<pre style="font-size:0.6em">
...
&lt;tr&gt;&lt;td class="td_annu"&gt;&lt;span class="texte"&gt;
  ​​​​​&lt;a href="http://www.lirmm.fr/xml/in/../fr/abdulhamee-05.html" target="_top"&gt;Abdulhameed&lt;/a&gt;&nbsp;&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;Abbas&nbsp;&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu" nowrap=""&gt;&lt;span class="texte"&gt;0467418564&nbsp;&nbsp;&nbsp;&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;1.2&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;
  &lt;a href="mailto:Abbas.Abdulhameed@lirmm.fr"&gt;Abbas.Abdulhameed@lirmm.fr&nbsp;&lt;/a&gt;&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;INFO/ICAR&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;Doctorant&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;&lt;tr&gt;&lt;td class="td_annu"&gt;&lt;span class="texte"&gt;
  &lt;a href="http://www.lirmm.fr/xml/in/../fr/akbarinia-05.html" target="_top"&gt;Akbarinia&lt;/a&gt;&nbsp;&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;Reza&nbsp;&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu" nowrap=""&gt;&lt;span class="texte"&gt;0467149783&nbsp;&nbsp;&nbsp;&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;G107&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;
  &lt;a href="mailto:Reza.Akbarinia@lirmm.fr"&gt;Reza.Akbarinia@lirmm.fr&nbsp;&lt;/a&gt;&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;INFO/ZENITH&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;Permanent&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;INRIA&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;&lt;tr&gt;&lt;td class="td_annu"&gt;&lt;span class="texte"&gt;
  &lt;a href="http://www.lirmm.fr/xml/in/../fr/akgul-05.html" target="_top"&gt;Akgul&lt;/a&gt;&nbsp;&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;Yeter&nbsp;&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu" nowrap=""&gt;&lt;span class="texte"&gt;&nbsp;&nbsp;&nbsp;&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;Exterieur&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;
  &lt;a href="mailto:Yeter.Akgul@lirmm.fr"&gt;Yeter.Akgul@lirmm.fr&nbsp;&lt;/a&gt;&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;MIC/SYSMIC&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;Doctorant&lt;/span&gt;&lt;/td&gt;
  &lt;td class="td_annu"&gt;&lt;span class="texte"&gt;&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;
...
	</pre>
</div>

<div class="slide">
	<h1>Scraping de données</h1>
	
	<h2>Enseignants</h2>
	<ul>
			<li>Annuaire du LIRMM</li>
		</ul>
	<p>Génération de RDF/XML</p>
	<pre style="font-size:0.6em">
&lt;rdf:RDF
  xmlns:rdf='http://www.w3.org/1999/02/22-rdf-syntax-ns#'
  xmlns:rdfs='http://www.w3.org/2000/01/rdf-schema#'
  xmlns:foaf='http://xmlns.com/foaf/0.1/'
  xmlns:lirmm_dir='http://localhost/UM2opendata/lirmm_dir_0.2.rdf#'
&gt;

&lt;rdf:Description rdf:about='http://www.lirmm.fr/xml/fr/abdulhamee-05.html'&gt;
	&lt;rdf:type rdf:resource='foaf:Person' /&gt;
	&lt;rdfs:isDefinedBy rdf:resource='http://localhost/UM2opendata/lirmm_dir_0.2.rdf#' /&gt;
	&lt;foaf:lastName&gt;Abdulhameed&lt;/foaf:lastName&gt;
	&lt;foaf:firstName&gt;Abbas&lt;/foaf:firstName&gt;
	&lt;foaf:phone&gt;0467418564&lt;/foaf:phone&gt;
	&lt;foaf:mbox&gt;Abbas.Abdulhameed@lirmm.fr&lt;/foaf:mbox&gt;
&lt;/rdf:Description&gt;

&lt;rdf:Description rdf:about='http://www.lirmm.fr/xml/fr/akbarinia-05.html'&gt;
	&lt;rdf:type rdf:resource='foaf:Person' /&gt;
	&lt;rdfs:isDefinedBy rdf:resource='http://localhost/UM2opendata/lirmm_dir_0.2.rdf#' /&gt;
	&lt;foaf:lastName&gt;Akbarinia&lt;/foaf:lastName&gt;
	&lt;foaf:firstName&gt;Reza&lt;/foaf:firstName&gt;
	&lt;foaf:phone&gt;0467149783&lt;/foaf:phone&gt;
	&lt;foaf:mbox&gt;Reza.Akbarinia@lirmm.fr&lt;/foaf:mbox&gt;
&lt;/rdf:Description&gt;
	</pre>
</div>

<div class="slide">
	<h1>Scraping de données</h1>
	
    <h2>Enseignants</h2>
	<ul>
		<li>W3B</li>
		</ul>
		<object data="http://w3b.info-ufr.univ-montp2.fr/siufr/offre" type="text/html" width="100%" height="100%">
	</object>
</div>

<div class="slide">
	<h1>Liaison de jeux de données</h1>
	<p>Martin Dupont == DUPOND Martin ?</p>
	<dl>
		<dt>Mise en bas de casse</dt>
		<dd>martin dupont == dupond martin ?</dd>
		
		<dt>coefficient de Jaccard</dt>
		<dd><img class="tex" src="img/jaccard.png" alt=" J(A,B) = \frac{|A \cap B|}{|A \cup B|}"></dd>
		
		<dt>distance de Levenshtein</dt>
		<dd>
		distance("dupont", "dupond") => 1 <br />
		normalisation: <br />
				1 / ((6 + 6) / 2) => 0.16
		</dd>
	</dl>
		
</div>
