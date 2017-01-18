/**
 * Application launcher.
 */

// check browser support
dwv.browser.check();

// launch when page is loaded
$(document).ready( function()
{
    // main application
    var myapp = new dwv.App();
    // initialise the application
    myapp.init({
        "containerDivId": "dwv",
        "fitToWindow": true,
        "gui": ["tool"],
        "tools": ["Scroll", "Zoom/Pan", "Window/Level"],
        "isMobile": true
    });
	
	myapp.loadURLs(["https://raw.githubusercontent.com/ivmartel/dwv/master/tests/data/bbmri-53323851.dcm"]);
    dwv.gui.appendResetHtml(myapp);
});
