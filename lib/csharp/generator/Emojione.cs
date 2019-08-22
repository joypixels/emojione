using System.Collections.Generic;

public class Emojione {

    public static string ShortnameToUnicode(string shortname)
    {
        string unicode = null;
        unicodeMap.TryGetValue(shortname, out unicode);
        return unicode;
    }

    public static string UnicodeToShortname(string unicode)
    {
        string shortname = null;
        reverseMap.TryGetValue(unicode, out shortname);
        return shortname;
    }

    private static Dictionary<string, string> unicodeMap = new Dictionary<string, string>(){
        <%= mapping %>
    };

    private static Dictionary<string, string> reverseMap = new Dictionary<string, string>(){
        <%= shortname_uni %>
    };

}
