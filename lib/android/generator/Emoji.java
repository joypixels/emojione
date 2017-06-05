package com.emojione;

import android.os.Build;

import java.util.HashMap;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public abstract class Emojione
{
	private static final HashMap<String, Emoji> _shortNameToEmoji = new HashMap<String, Emoji>();
    private static final Pattern SHORTNAME_PATTERN = Pattern.compile(":([-+\\w]+):");

	public class Emoji {
		private String shortname;
		private String unicodeJavaString;
		private String unicodeHexcode;
		private String category;
		
		public Emoji (String shortname, String unicodeJavaString, String unicodeHexcode, String category) {
			this.shortname = shortname;
			this.unicodeJavaString = unicodeJavaString;
			this.unicodeHexcode = unicodeHexcode;
			this.category = category;
		}
		
		public String getUnicodeJavaString() {
			return this.unicodeJavaString;
		}
	}
	
	public static Emoji shortnameToEmoji(String shortname){
		return _shortNameToEmoji.get(shortname);
	}
	
    /**
     * Replace shortnames to unicode characters.
     */
    public static String shortnameToUnicode(String input, boolean removeIfUnsupported)
    {
        Matcher matcher = SHORTNAME_PATTERN.matcher(input);
        boolean supported = Build.VERSION.SDK_INT >= 16;

        while (matcher.find()) {
            String unicode = _shortNameToEmoji.get(matcher.group(1)).getUnicodeJavaString();
            if (unicode == null) {
                continue;
            }

            if (supported) {
                input = input.replace(":" + matcher.group(1) + ":", unicode);
            } else if (!supported && removeIfUnsupported) {
                input = input.replace(":" + matcher.group(1) + ":", "");
            }
        }

        return input;
    }


    static {
        <%= mapping %>
    }

}
