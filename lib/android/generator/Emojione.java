package com.emojione;

import android.graphics.Typeface;
import android.os.Build;
import android.support.v4.util.Pair;
import android.text.SpannableStringBuilder;
import android.text.Spanned;

import java.util.*;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class Emojione {

    private static final Map<String, Pair<Integer[], Integer>> SHORT_NAME_TO_UNICODE = new HashMap<>();
    private static final Set<Integer> UNICODES = new HashSet<>();
    private static final Pattern SHORTNAME_PATTERN = Pattern.compile(":([-+\\w]+):");

    private Emojione() {
    }

    /**
     * Replace shortnames to emoji unicode characters.
     */
    public static String shortnameToUnicode(String input, boolean removeIfUnsupported) {
        Matcher matcher = SHORTNAME_PATTERN.matcher(input);
        boolean supported = Build.VERSION.SDK_INT >= Build.VERSION_CODES.JELLY_BEAN;

        while (matcher.find()) {

            String unicode = getUnicodeString(SHORT_NAME_TO_UNICODE.get(matcher.group(1)));
            if (unicode == null) {
                continue;
            }

            if (supported) {
                input = input.replace(":" + matcher.group(1) + ":", unicode);
            } else if (removeIfUnsupported) {
                input = input.replace(":" + matcher.group(1) + ":", "");
            }
        }

        return input;
    }

    private static String getUnicodeString(Pair<Integer[], Integer> pair) {
        if (pair != null) {
            return new String(toPrimitive(pair.first), 0, pair.second);
        }
        return null;
    }

    private static int[] toPrimitive(Integer[] obj) {

        int[] prim = new int[obj.length];
        for (int i = 0; i < obj.length; i++) {
            prim[i] = obj[i];
        }
        return prim;
    }

    /**
     * Wrap emojis with font. Useful if the default font doesn't support (all) emojis.
     *
     * @param text containing emojis
     * @param emojiTf ie. emojione
     */
    public static SpannableStringBuilder wrapEmojis(String text, Typeface emojiTf) {

        SpannableStringBuilder res = new SpannableStringBuilder();
        res.append(text);

        for (int i = 0; i < text.length();) {
            int start = i;
            int end = i;
            int unicode = Character.codePointAt(text, i);
            int charCount = Character.charCount(unicode);

            while (UNICODES.contains(unicode)) {
                charCount = Character.charCount(unicode);
                end += charCount;

                i += charCount;
                if (i >= text.length()) {
                    break;
                }
                unicode = Character.codePointAt(text, i);
            }

            // Emoji sequence found
            if (start != end) {
                res.setSpan(new CustomTypeFaceSpan(emojiTf), start, end, Spanned.SPAN_EXCLUSIVE_EXCLUSIVE);
            } else {
                i += charCount;
            }
        }
        return res;
    }

    static {
        <%= mapping %>

        for (Pair<Integer[], Integer> val : SHORT_NAME_TO_UNICODE.values()) {
            Collections.addAll(UNICODES, val.first);
        }
    }

}
