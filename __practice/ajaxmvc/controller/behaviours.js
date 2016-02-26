// the behaviour class
var behaviours = {

    phpcontroller: "../controller/switch.php?request=",

    theButtonClick: function(e) {
        alert('Ouch! \n\nOK, I\'ll make a request for ya, buddy!');
		YAHOO.util.Connect.asyncRequest (
		    'GET',
		    behaviours.phpcontroller + 'loadSomething',
		    {success: updates.writeContent}
		);
        
    },
    
    trClick: function (e) {
        var target = (e.srcElement) ? 
            e.srcElement.parentNode : e.target.parentNode;
        if (target.tagName == 'TR') {
            if (target.className == 'tr-on') {
                target.className = '';
            } else {
                target.className = 'tr-on';
            }
        }
    },
    
    updateTableBehaviour: function () {
        var el = document.getElementById('content').firstChild;
        YAHOO.util.Event.addListener(
            el, 'click', behaviours.trClick);
    }    
}


// initial page load, attach onload event(s)
YAHOO.util.Event.addListener(
    'thebutton', 'click', behaviours.theButtonClick);
