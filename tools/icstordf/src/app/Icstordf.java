package app;

import java.io.FileInputStream;
import java.io.IOException;
import java.util.Iterator;

import resources.RoomLocation;

import net.fortuna.ical4j.data.CalendarBuilder;
import net.fortuna.ical4j.data.ParserException;
import net.fortuna.ical4j.model.Calendar;
import net.fortuna.ical4j.model.Component;
import net.fortuna.ical4j.model.Property;

public class Icstordf {

	/**
	 * @param args
	 */
	public static void main(String[] args) {

		System.out.println("Icstordf parser...");
		FileInputStream file = null;

		try {
			System.out.println("Ouverture du fichier " + args[0]);
			file = new FileInputStream(args[0]);
			CalendarBuilder builder = new CalendarBuilder();
			Calendar calendar = builder.build(file);

			for (Iterator i = calendar.getComponents().iterator(); i.hasNext();) {
				Component component = (Component) i.next();
				System.out.println("Component [" + component.getName() + "]");

				for (Iterator j = component.getProperties().iterator(); j
						.hasNext();) {
					Property property = (Property) j.next();
					System.out.println("	Property [" + property.getName()
							+ ", " + property.getValue() + "]");
					if (property.getName().equals("LOCATION")) {
						for (String room : RoomLocation
								.getRoomLocations(property.getValue())) {
							System.out.println("		Add [TRUE_ROOM, " + room
									+ "]");
							System.out.println("		Add [BATIMENT, "
									+ RoomLocation.getRoomRdf(room) + "]");
						}
					}
				}
			}
		} catch (Exception e) {
			System.err
					.println("Erreur lors de l'execution : " + e.getMessage());
		}

		for (String s : RoomLocation.getRoomLocations("Amphi SC 1 05")) {
			System.out
					.println('"' + s + "\" --> " + RoomLocation.getRoomRdf(s));
		}
	}

}
