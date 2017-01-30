using System.Collections.Generic;

public class Emojione {

    public static string ShortnameToUnicode(string shortname)
    {
        string unicode = null;
        unicodeMap.TryGetValue(shortname, out unicode);
        return unicode;
    }

    private static Dictionary<string, string> unicodeMap = new Dictionary<string, string>(){
        <%= mapping %>
    };

}