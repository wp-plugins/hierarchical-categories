<?php
/*
Plugin Name: Hierarchical Categories
Plugin URI: http://www.pete-b.co.uk/downloads
Description: This plugin makes categories work hierarchically, so if you check a child, all it's parents are checked too
Author:  Pete Bonnett
Version: 0.3
Author URI: http://www.pete-b.co.uk/
*/

//Insert the JS function
function categoryJS() {
	echo "<script type='text/javascript'>
	function initCheckboxes_PSB() {
	if(document.getElementById('categorydiv')) {
		var boxes = document.getElementById('categorydiv').getElementsByTagName('INPUT');
		var isIE = (true && document.attachEvent)?true:false;
		for(var i=0; i<boxes.length; i++){
			if(isIE) {
				boxes[i].attachEvent('onclick', catHierarchy_PSB);
			} else {
				boxes[i].addEventListener('click', catHierarchy_PSB, false);
			}
		}
	}
}

function catHierarchy_PSB(e) {
	var id;
	if(e.target) {
		id = e.target.id;
	} else {
		id = window.event.srcElement.id;
	}
	var elem = document.getElementById(id);
	var isIE = (true && document.attachEvent)?true:false;
	while((elem) && (elem.nodeName == 'INPUT')) {
		if(elem.checked) {
			var pNode;
			if(isIE) {
				pNode = elem.parentNode.parentNode.parentNode.previousSibling.firstChild;
			} else {
				pNode = elem.parentNode.parentNode.parentNode.previousSibling.firstChild.firstChild;
			}
			if(pNode == null) {
				break;
			}
			pNode.checked = true;
			elem = pNode;
		} else {
			break;
		}
	}
}

addLoadEvent(initCheckboxes_PSB);

	</script>";
}

add_action('admin_head', 'categoryJS');

?>