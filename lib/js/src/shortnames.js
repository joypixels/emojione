import emojioneList from './emojioneList';

var tmpShortNames = [], emoji;
for (emoji in emojioneList) {
    if (!emojioneList.hasOwnProperty(emoji) || (emoji === '')) continue;
    tmpShortNames.push(emoji.replace(/[+]/g, "\\$&"));
    for (var i = 0; i < emojioneList[emoji].shortnames.length; i++) {
        tmpShortNames.push(emojioneList[emoji].shortnames[i].replace(/[+]/g, "\\$&"));
    }
}
export default tmpShortNames.join('|');