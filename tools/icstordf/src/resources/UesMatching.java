package resources;

import java.util.HashMap;
import java.util.LinkedList;

public class UesMatching {
	public static HashMap<String, String> ues = new HashMap<>();

	private static void init() {
		UesMatching.ues.put("FMIN104", "");
	}

	public static String getName(String key) {
		return UesMatching.ues.get(key);
	}

	public static LinkedList<String> deduceUeNumber(String chaine) {
		LinkedList<String> tmp = new LinkedList<>();
		tmp.add(chaine);
		return tmp; // TODO faire la fonction
	}
}
