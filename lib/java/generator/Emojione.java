package com.emojione;


public abstract class Emojione
{
    private static final Map<String, String> _shortNameToUnicode;




    static {
        _shortNameToUnicode = new HashMap<String, String>();
        <%= mapping %>
    }

}
