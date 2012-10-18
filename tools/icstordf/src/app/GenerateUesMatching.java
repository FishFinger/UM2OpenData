package app;

import java.io.FileInputStream;

public class GenerateUesMatching {

	public static void main(String[] args) {

		FileInputStream file = null;

		try {
			file = new FileInputStream(args[0]);
		} catch (Exception e) {
			System.err.println("Error : " + e.getMessage());
		}
	}
}
