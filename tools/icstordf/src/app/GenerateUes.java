package app;

import java.io.FileInputStream;
import java.util.Set;

import java.util.Iterator;

import resources.UesMatching;

public class GenerateUes {

	public static void main(String[] args) {

		Set ues_keys = UesMatching.ues.keySet();
		Iterator it = ues_keys.iterator();
		while (it.hasNext())
			GenerateUes.printUe((String) it.next());
	}

	public static void printEntete() {
		System.out.println("<rdf:RDF");
		System.out
				.println("xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\"");
		System.out
				.println("xmlns:rdfs=\"http://www.w3.org/2000/01/rdf-schema#\"");
		System.out.println("xmlns:ev=\"http://purl.org/NET/c4dm/event.owl#\"");
		System.out.println("xmlns:time=\"http://w3c.org/2006/time/#\"");
		System.out
				.println("xmlns:mo=\"http://localhost/UM2opendata/ontologies/my-ontology.owl#\">");
	}

	public static void printUe(String key) {

	}
}
