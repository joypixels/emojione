//
//  Emojione.swift
//
//  Created by Rafael Kellermann Streit (@rafaelks) on 10/10/16.
//  Copyright (c) 2016.
//

import Foundation

struct Emojione {
    static let values = [
        <%= mapping %>
    ]
    
    static func transform(string: String) -> String {
        let oldString = string as NSString
        var transformedString = string as NSString
        
        let regex = try! NSRegularExpression(pattern: ":([-+\\w]+):", options: [])
        let matches = regex.matches(in: transformedString as String, options: [], range: NSMakeRange(0, transformedString.length))
        
        for result in matches {
            guard result.numberOfRanges == 2 else { continue }
            
            let shortname = oldString.substring(with: result.rangeAt(1))
            if let emoji = values[shortname] {
                transformedString = transformedString.replacingOccurrences(of: ":\(shortname):", with: emoji) as NSString
            }
        }
        
        return transformedString as String
    }
}
