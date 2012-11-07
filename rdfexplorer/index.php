<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Test</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen">
    </head>

    <body>
        <form action="explore.php" method="get">
            RDF URL : <input name="repo" type="text" value="http://" />
            <select name="input_type">
                <option value="rdfxml">RDF/XML</option>
                <option value="ntriples">N-Triples</option>
                <option value="turtle">Turtle</option>
                <option value="rss-tag-soup">RSS Tag Soup</option>
            </select>
            <hr/>
            <input type="submit" value="Graphizer" />
        </form>
    </body>
</html>
