Template.registerHelper('emojione', new Template('emojione', function () {
    var view = this;
    var content;

    if (view.templateContentBlock) {
        // this is for the block usage eg: {{#emoji}}:smile:{{/emoji}}
        content = Blaze._toText(view.templateContentBlock, HTML.TEXTMODE.STRING);
    } else {
        // this is for the direct usage eg: {{> emoji ':blush:'}}
        content = Blaze.getData(view);
    }

    return HTML.Raw(emojione.toImage(content));
}));
