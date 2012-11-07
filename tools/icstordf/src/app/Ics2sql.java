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
import resources.UesMatching;

import net.fortuna.ical4j.data.CalendarBuilder;
import net.fortuna.ical4j.data.ParserException;
import net.fortuna.ical4j.model.Calendar;
import net.fortuna.ical4j.model.Component;
import net.fortuna.ical4j.model.Property;

public class Ics2sql {

	public static final String BASE_DATA_URI = "http://localhost/UM2opendata/data/";
	public static final Boolean DEBUG = false;

	/**
	 * @param args
	 * @throws Exception 
	 */
	public static void main(String[] args) throws Exception {
		System.out.println("/*");
		FileInputStream file = null;

		try {
			// System.out.println("Ouverture du fichier " + args[0]);
			file = new FileInputStream(args[0]);
			CalendarBuilder builder = new CalendarBuilder();
			Calendar calendar = builder.build(file);
			
			System.out.println("*/");

			Ics2sql.printEntete();

			int nb_vevent = 0;

			for (Iterator i = calendar.getComponents().iterator(); i.hasNext();) {
				Component component = (Component) i.next();
				if (!Ics2sql.DEBUG || Math.random() < 0.05) {
					Ics2sql.printElement(component);
					++nb_vevent;
				}
			}
		} catch (Exception e) {
			System.err
					.println("Erreur lors de l'execution : " + e.getMessage());
			throw e;
		}
	}

	public static void printEntete() {
		System.out.println("INSERT INTO `Class` \n"
		+ "(`uid`, `label`, `dstart`, `dend`, `describe`, `related_to`) \n"
		+ "VALUES \n");
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

			System.out.println(
					"('" 
					+ values.get("UID").get(0) + "', '"
					+ values.get("SUMMARY").get(0) + "', '"
					+ ConvertTime.convertTimeFromIcsToXsd(values.get("DTSTART").get(0)) + "', '"
					+ ConvertTime.convertTimeFromIcsToXsd(values.get("DTEND").get(0)) + "', '"
					+ values.get("DESCRIPTION").get(0) + "', "
                                );
                        List<String> UE = UesMatching.deduceUeNumber(values.get("SUMMARY").get(0));
			if(!UE.isEmpty()){
				System.out.println("'"+UE.get(0)+"'");
			}else{
                            System.out.println("NULL");
                        }
                        
                        System.out.println("),");
                                
				

		}
	}
}
