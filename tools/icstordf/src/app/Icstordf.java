package app;

import java.io.FileInputStream;

import java.io.IOException;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Random;

import edu.emory.mathcs.backport.java.util.LinkedList;

import resources.ConvertTime;
import resources.RoomLocation;

import net.fortuna.ical4j.data.CalendarBuilder;
import net.fortuna.ical4j.data.ParserException;
import net.fortuna.ical4j.model.Calendar;
import net.fortuna.ical4j.model.Component;
import net.fortuna.ical4j.model.Property;

public class Icstordf {

	public static final String BASE_DATA_URI = "http://localhost/UM2opendata/data/";
	public static final Boolean DEBUG = false;

	/**
	 * @param args
	 */
	public static void main(String[] args) {

		FileInputStream file = null;

		try {
			System.out.println("<!--");
			// System.out.println("Ouverture du fichier " + args[0]);
			file = new FileInputStream(args[0]);
			CalendarBuilder builder = new CalendarBuilder();
			Calendar calendar = builder.build(file);

			System.out.println("-->");
			Icstordf.printEntete();

			int nb_vevent = 0;

			for (Iterator i = calendar.getComponents().iterator(); i.hasNext();) {
				Component component = (Component) i.next();
				if (!Icstordf.DEBUG || Math.random() < 0.05) {
					Icstordf.printElement(component);
					++nb_vevent;
				}
			}
			System.out.println("</rdf:RDF>");
			System.out.println("<!-- Nb vevent add : " + nb_vevent + " -->");
		} catch (Exception e) {
			System.err
					.println("Erreur lors de l'execution : " + e.getMessage());
		}
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

	public static void printElement(Component component) {
		if (component.getName().equals("VEVENT")) {

			HashMap<String, List<String>> values = new HashMap<>();

			for (Iterator j = component.getProperties().iterator(); j.hasNext();) {
				Property property = (Property) j.next();
				List<String> tmp = new LinkedList();
				tmp.add(property.getValue());

				values.put(property.getName(), tmp);

				if (property.getName().equals("LOCATION")) {

					List<String> tmp_true_room = new LinkedList();
					List<String> tmp_batiment = new LinkedList();
					for (String room : RoomLocation.getRoomLocations(property
							.getValue())) {

						tmp_true_room.add(room);
						tmp_batiment.add(RoomLocation.getRoomRdf(room));
					}

					values.put("TRUE_ROOM", tmp_true_room);
					values.put("BATIMENT", tmp_batiment);
				}
			}

			System.out.println("<!-- NEW VEVENT -->");

			System.out.println("<rdf:Description");
			System.out.println("rdf:about=\"" + values.get("URL").get(0)
					+ "\">");
			System.out.println("<rdfs:isDefinedBy>" + Icstordf.BASE_DATA_URI
					+ "Classs/" + values.get("UID").get(0)
					+ "</rdfs:isDefinedBy>");
			System.out.println("<rdf:type>mo:Classs</rdf:type>");
			System.out.println("<rdfs:label>" + values.get("SUMMARY").get(0)
					+ "</rdfs:label>");
			System.out.println("<rdfs:comment><![CDATA["
					+ values.get("DESCRIPTION").get(0) + "]]></rdfs:comment>");
			for (int i = 0; i < values.get("TRUE_ROOM").size(); ++i) {
				System.out.println("<mo:takesplacein>");
				System.out.println("<mo:Room>");
				System.out.println("<rdfs:label>"
						+ values.get("TRUE_ROOM").get(i) + "</rdfs:label>");
				System.out.println("<mo:locatedin");
				System.out.println("rdf:resource=\""
						+ Icstordf.BASE_DATA_URI
						+ "Building/"
						+ RoomLocation.getBatimentNumber(values
								.get("TRUE_ROOM").get(i)) + "\" />");
				System.out.println("</mo:Room>");
				System.out.println("</mo:takesplacein>");
			}
			System.out.println("<ev:time>");
			System.out.println("<ev:Interval>");
			System.out.println("<ev:hasBeginning>");
			System.out.println("<ev:Instant>");
			System.out.println("<time:inXSDDateTime>"
					+ ConvertTime.convertTimeFromIcsToXsd(values.get("DTSTART")
							.get(0)) + "</time:inXSDDateTime>");
			System.out.println("</ev:Instant>");
			System.out.println("</ev:hasBeginning>");
			System.out.println("<ev:hasEnd>");
			System.out.println("<ev:Instant>");
			System.out.println("<time:inXSDDateTime>"
					+ ConvertTime.convertTimeFromIcsToXsd(values.get("DTEND")
							.get(0)) + "</time:inXSDDateTime>");
			System.out.println("</ev:Instant>");
			System.out.println("</ev:hasEnd>");
			System.out.println("</ev:Interval>");
			System.out.println("</ev:time>");
			System.out.println("</rdf:Description>");

		}
	}
}
