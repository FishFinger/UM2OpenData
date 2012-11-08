<div class="slide">
	<h1>Plan</h1>
	
	<ol>
		<li>Présentation du projet</li>
		<li><b><u>Modèle de données</u></b></li>
		<li>Scraping des données</li>
		<li>Réalisations</li>
	</ol>
</div>

<div class="slide">
	<h1>Modèle de données</h1>
	<h3>Modèle relationnel</h3>

	<center>
	<img src="img/diag_class.svg" alt="diagramme de classes" style="height:15em"/>
	</center>
</div>

<div class="slide">
	<h1>Modèle de données</h1>
	
	<h3>Modèle RDF (Ontologie)</h3>

	<center>
	<img src="img/graph_ontology.svg" alt="ontologie" style="height:25em"/>
	</center>

	<ul>
		<li>xsd <a href="http://www.w3.org/2001/XMLSchema#">http://www.w3.org/2001/XMLSchema#</a> (Formats)</li>
		<li>lgdm <a href="http://linkedgeodata.org/ontology/">http://linkedgeodata.org/ontology/</a> (LinkedGeoData)</li>
		<li>ev <a href="http://purl.org/NET/c4dm/event.owl#">http://purl.org/NET/c4dm/event.owl#</a> (Événements)</li>
		<li>swrc <a href="http://swrc.ontoware.org/ontology#">http://swrc.ontoware.org/ontology#</a> (Université)</li>
	</ul>
</div>

<div class="slide">
	<h1>Modèle de données</h1>
	
	<h3>Mapping</h3>
	<pre>
################
# Course table #
################

map:Course a d2rq:ClassMap;
	d2rq:dataStorage map:database;
	d2rq:uriPattern "Course/@@Course.id@@";
	d2rq:class mo:Course;

	d2rq:classDefinitionLabel "Course";
	d2rq:classDefinitionComment "Course class";
.

map:Course_label a d2rq:PropertyBridge;
	d2rq:belongsToClassMap map:Course;
	d2rq:property rdfs:label;
	d2rq:column "Course.libelle";
.

map:Course_comment a d2rq:PropertyBridge;
	d2rq:belongsToClassMap map:Course;
	d2rq:property rdfs:comment;
	d2rq:column "Course.comments";
.

map:Course_managedby a d2rq:PropertyBridge;
	d2rq:belongsToClassMap map:Course;
	d2rq:property mo:managedby;
	d2rq:refersToClassMap map:Person;
	d2rq:join "Course.managed_by = Personne.id";
.
	</pre>
</div>
