package resources;

import java.awt.List;
import java.util.HashMap;
import java.util.LinkedList;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.util.regex.PatternSyntaxException;

public class RoomLocation {
	private static HashMap<String, String> matches;

	public static LinkedList<String> getRoomLocations(String name) {
		return RoomLocation.getAll(name);
	}
	
	public static String getRoomRdf(String name) {
		if (RoomLocation.matches == null)
			RoomLocation.init();

		return RoomLocation.getBatiment(name);
	}

	private static void init() {
		RoomLocation.matches = new HashMap<String, String>();

		RoomLocation.matches.put("1", "http://linkedgeodata.org/page/triplify/way32233489");
		RoomLocation.matches.put("2", "http://linkedgeodata.org/page/triplify/way32233488");
		RoomLocation.matches.put("3", "http://linkedgeodata.org/page/triplify/way32233487");
		RoomLocation.matches.put("4", "http://linkedgeodata.org/page/triplify/way32233485");
		RoomLocation.matches.put("5", "http://linkedgeodata.org/page/triplify/way76359654");
		RoomLocation.matches.put("6", "http://linkedgeodata.org/page/triplify/way76357127");
		RoomLocation.matches.put("7", "http://linkedgeodata.org/page/triplify/way76362815");
		RoomLocation.matches.put("8", "http://linkedgeodata.org/page/triplify/way76360233");
		RoomLocation.matches.put("9", "http://linkedgeodata.org/page/triplify/way76360249");
		RoomLocation.matches.put("10", "http://linkedgeodata.org/page/triplify/way76363738");
		RoomLocation.matches.put("11", "http://linkedgeodata.org/page/triplify/way88521153");
		RoomLocation.matches.put("12", "http://linkedgeodata.org/page/triplify/way76362690");
		RoomLocation.matches.put("13", "http://linkedgeodata.org/page/triplify/way76359278");
		RoomLocation.matches.put("14", "http://linkedgeodata.org/page/triplify/way76358978");
		RoomLocation.matches.put("15", "http://linkedgeodata.org/page/triplify/way76357837");
		RoomLocation.matches.put("16", "http://linkedgeodata.org/page/triplify/way76356405");
		RoomLocation.matches.put("17", "http://linkedgeodata.org/page/triplify/way76359154");
		RoomLocation.matches.put("18", "http://linkedgeodata.org/page/triplify/way76356640");
		RoomLocation.matches.put("19", "http://linkedgeodata.org/page/triplify/way76357455");
		RoomLocation.matches.put("20", "http://linkedgeodata.org/page/triplify/way76358159");
		RoomLocation.matches.put("21", "http://linkedgeodata.org/page/triplify/way76356543");
		RoomLocation.matches.put("22", "http://linkedgeodata.org/page/triplify/way76360570");
		RoomLocation.matches.put("23", "http://linkedgeodata.org/page/triplify/way76361462");
		RoomLocation.matches.put("24", "http://linkedgeodata.org/page/triplify/way76359669");
		RoomLocation.matches.put("25", "http://linkedgeodata.org/page/triplify/way76363143");
		RoomLocation.matches.put("26", "http://linkedgeodata.org/page/triplify/way76358296");
		RoomLocation.matches.put("27", "http://linkedgeodata.org/page/triplify/way76357918");
		RoomLocation.matches.put("28", "http://linkedgeodata.org/page/triplify/way76360419");
		RoomLocation.matches.put("29", "http://linkedgeodata.org/page/triplify/way76357540 ");
		RoomLocation.matches.put("30", "http://linkedgeodata.org/page/triplify/way76360989");
		RoomLocation.matches.put("34", "http://linkedgeodata.org/page/triplify/way76214243");
		RoomLocation.matches.put("43", "http://linkedgeodata.org/page/triplify/way76358519");
		RoomLocation.matches.put("RU TRIOLET", "http://linkedgeodata.org/page/triplify/way170953156");
		RoomLocation.matches.put("LIRMM", "http://linkedgeodata.org/page/triplify/way76043070");
		RoomLocation.matches.put("Saint Priest", "http://linkedgeodata.org/page/triplify/way43970061");
	}

	private static String simplifyName(String name) {
		return name;
	}

	private static LinkedList<String> getAll(String name) {
		LinkedList<String> list = new LinkedList<String>();

		Pattern p = Pattern.compile("(([a-zA-Z]+ )+[0-9]{1,2}([ \\.][0-9]{1,2})?)",
				Pattern.CASE_INSENSITIVE);
		Matcher m = p.matcher(name);

		while (m.find()) {
			list.add(m.group(0));
		}
		return list;
	}
	
	public static String getBatiment(String name) {
		Pattern p = Pattern.compile("([0-9]{1,2})",
				Pattern.CASE_INSENSITIVE);
		Matcher m = p.matcher(name);
		
		return (m.find())? RoomLocation.matches.get(m.group(0)) : "";
	}
	
	public static String getBatimentNumber(String name) {
		Pattern p = Pattern.compile("([0-9]{1,2})",
				Pattern.CASE_INSENSITIVE);
		Matcher m = p.matcher(name);
		
		return (m.find())? (String)m.group(0) : "";
	}
}
