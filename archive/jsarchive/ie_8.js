//Because IE cannot use the .trim function properly, this is a substitute that is called
	
	if(typeof String.prototype.trim !== 'function') {
		String.prototype.trim = function() {
	    	return this.replace(/^\s+|\s+$/g, ''); 
		}
	}