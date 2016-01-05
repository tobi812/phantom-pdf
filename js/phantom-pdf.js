var args = require('system').args;

if (args.length < 3) {

    console.log('Usage: phantomjs phantom-pdf.js $pageOptionJson');
    console.log('$pageOptionJson can contains following json-attributes:');

    phantom.exit();

} else {

    var fs = require('fs');
    var page = require('webpage').create();
    var resourcePath = args[1];
    var targetPath = args[2];
    var pageOptions = JSON.parse(args[3]);
    var format = { format: 'pdf' };

    page.onError = getErrorHandler();
    page.paperSize = getPaperSize(pageOptions);
    page.customHeaders = pageOptions.customHeaders;
    page.zoomFactor = pageOptions.zoomFactor;

    var pageNumPlaceholder = '#pageNum';
    var totalPagesPlaceholder = '#numPages';

    if (pageOptions.pageNumPlaceholder) {
        pageNumPlaceholder = pageOptions.pageNumPlaceholder;
    }

    if (pageOptions.totalPagesPlaceholder) {
        totalPagesPlaceholder = pageOptions.totalPagesPlaceholder;
    }

    page.open(resourcePath, function (status) {
        if (status !== 'success') {
            console.log('Unable to load the file!');
            phantom.exit(1);
        } else {
            console.log('SUCCESS');
            page.render(targetPath, format);
            phantom.exit(0);
        }
    });
}

function getPaperSize(pageOptions) {
    var paperSize = {};

    if (pageOptions.header) {
        paperSize.header = renderTemplate(pageOptions.header);
    }

    if (pageOptions.footer) {
        paperSize.footer = renderTemplate(pageOptions.footer);
    }

    paperSize.format = pageOptions.format;
    paperSize.orientation = pageOptions.orientation;
    paperSize.margin = pageOptions.margin;

    return paperSize;
}

function renderTemplate(template) {
    return {
        height: template.height,
        contents: phantom.callback(function(pageNum, numPages) {
            return template.content
                .replace(pageNumPlaceholder, pageNum)
                .replace(totalPagesPlaceholder, numPages)
            ;
        })
    };
}

function getErrorHandler() {
    return function (msg, trace) {

        var msgStack = ['ERROR: ' + msg];

        if (trace && trace.length) {
            msgStack.push('TRACE:');
            trace.forEach(function (t) {
                msgStack.push(' -> ' + t.file + ': ' + t.line + (t.function ? ' (in function "' + t.function + '")' : ''));
            });
        }

        console.error(msgStack.join('\n'));
    };
}
