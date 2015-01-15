package com.emojione;

import android.os.Build;

import java.util.HashMap;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public abstract class Emojione
{
    private static final HashMap<String, String> _shortNameToUnicode = new HashMap<String, String>();
    private static final Pattern SHORTNAME_PATTERN = Pattern.compile(":([-+\\w]+):");

    /**
     * Replace shortnames to unicode characters.
     */
    public static String shortnameToUnicode(String input, boolean removeIfUnsupported)
    {
        Matcher matcher = SHORTNAME_PATTERN.matcher(input);
        boolean supported = Build.VERSION.SDK_INT >= 16;

        while (matcher.find()) {
            String unicode = _shortNameToUnicode.get(matcher.group(1));
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
