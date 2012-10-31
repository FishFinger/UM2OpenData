package resources;

public class ConvertTime {

	public static String convertTimeFromIcsToXsd(String date) {
		return date.substring(0,4)+'-'+date.substring(4,6)+'-'+date.substring(6,11)+':'+date.substring(11,13)+':'+date.substring(13,15);
	}
}
