package resources;

import java.util.HashMap;
import java.util.LinkedList;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class UesMatching {
	public static HashMap<String, String> ues = new HashMap<>();

	private static void init() {
		UesMatching.ues.put("FMIN104", "");
	}

	public static String getName(String key) {
		return UesMatching.ues.get(key);
	}

	public static LinkedList<String> deduceUeNumber(String chaine) {
		LinkedList<String> liste = new LinkedList<>();
		
		Pattern p = Pattern.compile("([A-Z]{3,5}[0-9]{1,3}[A-Z]{0,1})",
				Pattern.CASE_INSENSITIVE);
		Matcher m = p.matcher(chaine);
		
		liste.add((m.find())? m.group(0) : "");
		
		return liste;
	}
}
