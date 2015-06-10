// @author: https://github.com/qnub/emojione/blob/master/qnub:emojione.js
if (Package.templating) {
  var Template = Package.templating.Template;
  var Blaze = Package.blaze.Blaze; // implied by `templating`
  var HTML = Package.htmljs.HTML; // implied by `blaze`

  Blaze.Template.registerHelper('emojione', new Template('emojione', function () {
    var view = this,
        content = '';

    if (view.templateContentBlock) {
      // this is for the block usage eg: {{#emoji}}:smile:{{/emoji}}
      content = Blaze._toText(view.templateContentBlock, HTML.TEXTMODE.STRING);
    }
    else {
      // this is for the direct usage eg: {{> emoji ':blush:'}}
      content = view.parentView.dataVar.get();
    }
    return HTML.Raw(emojione.toImage(content));
  }));
}