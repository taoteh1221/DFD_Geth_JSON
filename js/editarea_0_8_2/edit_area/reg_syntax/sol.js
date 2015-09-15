editAreaLoader.load_syntax["sol"] = {
	'DISPLAY_NAME' : 'Solidity'
	,'COMMENT_SINGLE' : {1 : '//'}
	,'COMMENT_MULTI' : {'/*' : '*/'}
	,'QUOTEMARKS' : {1: "'", 2: '"'}
	,'KEYWORD_CASE_SENSITIVE' : false
	,'KEYWORDS' : {
		'statements' : [
			'as', 'break', 'case', 'catch', 'continue', 'decodeURI', 'delete', 'do',
			'else', 'encodeURI', 'eval', 'finally', 'for', 'if', 'in', 'is', 'item',
			'instanceof', 'return', 'switch', 'this', 'throw', 'try', 'typeof', 'void',
			'while', 'write', 'with', 'with', 'contract'
		]
 		,'keywords' : [
			'class', 'const', 'default', 'debugger', 'export', 'extends', 'false',
			'function', 'import', 'namespace', 'new', 'null', 'package', 'private',
			'protected', 'public', 'super', 'true', 'use', 'var', 'window', 'document',		
			// the list below must be sorted and checked (if it is a keywords or a function and if it is not present twice
			'Link ', 'outerHeight ', 'Anchor', 'FileUpload', 
			'location', 'outerWidth', 'Select', 'Area', 'find', 'Location', 'Packages', 'self', 
			'arguments', 'locationbar', 'pageXoffset', 'Form', 
			'Math', 'pageYoffset', 'setTimeout', 'assign', 'Frame', 'menubar', 'parent', 'status', 
			'blur', 'frames', 'MimeType', 'parseFloat', 'statusbar', 'Boolean', 'Function', 'moveBy', 
			'parseInt', 'stop', 'Button', 'getClass', 'moveTo', 'Password', 'String', 'callee', 'Hidden', 
			'name', 'personalbar', 'Submit', 'caller', 'history', 'NaN', 'Plugin', 'sun', 'captureEvents', 
			'History', 'navigate', 'print', 'taint', 'Checkbox', 'home', 'navigator', 'prompt', 'Text', 
			'Image', 'Navigator', 'prototype', 'Textarea', 'clearTimeout', 'Infinity', 
			'netscape', 'Radio', 'toolbar', 'close', 'innerHeight', 'Number', 'ref', 'top', 'closed', 
			'innerWidth', 'Object', 'RegExp', 'toString', 'confirm', 'isFinite', 'onBlur', 'releaseEvents', 
			'unescape', 'constructor', 'isNan', 'onError', 'Reset', 'untaint', 'Date', 'java', 'onFocus', 
			'resizeBy', 'unwatch', 'defaultStatus', 'JavaArray', 'onLoad', 'resizeTo', 'valueOf', 'document', 
			'JavaClass', 'onUnload', 'routeEvent', 'watch', 'Document', 'JavaObject', 'open', 'scroll', 'window', 
			'Element', 'JavaPackage', 'opener', 'scrollbars', 'Window', 'escape', 'length', 'Option', 'scrollBy', 'uint', 'uint8', 'uint9', 'uint10', 'uint11', 'uint12', 'uint13', 'uint14', 'uint15', 'uint16', 'uint17', 'uint18', 'uint19', 'uint20', 'uint21', 'uint22', 'uint23', 'uint24', 'uint25', 'uint26', 'uint27', 'uint28', 'uint29', 'uint30', 'uint31', 'uint32', 'uint33', 'uint34', 'uint35', 'uint36', 'uint37', 'uint38', 'uint39', 'uint40', 'uint41', 'uint42', 'uint43', 'uint44', 'uint45', 'uint46', 'uint47', 'uint48', 'uint49', 'uint50', 'uint51', 'uint52', 'uint53', 'uint54', 'uint55', 'uint56', 'uint57', 'uint58', 'uint59', 'uint60', 'uint61', 'uint62', 'uint63', 'uint64', 'uint65', 'uint66', 'uint67', 'uint68', 'uint69', 'uint70', 'uint71', 'uint72', 'uint73', 'uint74', 'uint75', 'uint76', 'uint77', 'uint78', 'uint79', 'uint80', 'uint81', 'uint82', 'uint83', 'uint84', 'uint85', 'uint86', 'uint87', 'uint88', 'uint89', 'uint90', 'uint91', 'uint92', 'uint93', 'uint94', 'uint95', 'uint96', 'uint97', 'uint98', 'uint99', 'uint100', 'uint101', 'uint102', 'uint103', 'uint104', 'uint105', 'uint106', 'uint107', 'uint108', 'uint109', 'uint110', 'uint111', 'uint112', 'uint113', 'uint114', 'uint115', 'uint116', 'uint117', 'uint118', 'uint119', 'uint120', 'uint121', 'uint122', 'uint123', 'uint124', 'uint125', 'uint126', 'uint127', 'uint128', 'uint129', 'uint130', 'uint131', 'uint132', 'uint133', 'uint134', 'uint135', 'uint136', 'uint137', 'uint138', 'uint139', 'uint140', 'uint141', 'uint142', 'uint143', 'uint144', 'uint145', 'uint146', 'uint147', 'uint148', 'uint149', 'uint150', 'uint151', 'uint152', 'uint153', 'uint154', 'uint155', 'uint156', 'uint157', 'uint158', 'uint159', 'uint160', 'uint161', 'uint162', 'uint163', 'uint164', 'uint165', 'uint166', 'uint167', 'uint168', 'uint169', 'uint170', 'uint171', 'uint172', 'uint173', 'uint174', 'uint175', 'uint176', 'uint177', 'uint178', 'uint179', 'uint180', 'uint181', 'uint182', 'uint183', 'uint184', 'uint185', 'uint186', 'uint187', 'uint188', 'uint189', 'uint190', 'uint191', 'uint192', 'uint193', 'uint194', 'uint195', 'uint196', 'uint197', 'uint198', 'uint199', 'uint200', 'uint201', 'uint202', 'uint203', 'uint204', 'uint205', 'uint206', 'uint207', 'uint208', 'uint209', 'uint210', 'uint211', 'uint212', 'uint213', 'uint214', 'uint215', 'uint216', 'uint217', 'uint218', 'uint219', 'uint220', 'uint221', 'uint222', 'uint223', 'uint224', 'uint225', 'uint226', 'uint227', 'uint228', 'uint229', 'uint230', 'uint231', 'uint232', 'uint233', 'uint234', 'uint235', 'uint236', 'uint237', 'uint238', 'uint239', 'uint240', 'uint241', 'uint242', 'uint243', 'uint244', 'uint245', 'uint246', 'uint247', 'uint248', 'uint249', 'uint250', 'uint251', 'uint252', 'uint253', 'uint254', 'uint255', 'uint256', 'int', 'int8', 'int9', 'int10', 'int11', 'int12', 'int13', 'int14', 'int15', 'int16', 'int17', 'int18', 'int19', 'int20', 'int21', 'int22', 'int23', 'int24', 'int25', 'int26', 'int27', 'int28', 'int29', 'int30', 'int31', 'int32', 'int33', 'int34', 'int35', 'int36', 'int37', 'int38', 'int39', 'int40', 'int41', 'int42', 'int43', 'int44', 'int45', 'int46', 'int47', 'int48', 'int49', 'int50', 'int51', 'int52', 'int53', 'int54', 'int55', 'int56', 'int57', 'int58', 'int59', 'int60', 'int61', 'int62', 'int63', 'int64', 'int65', 'int66', 'int67', 'int68', 'int69', 'int70', 'int71', 'int72', 'int73', 'int74', 'int75', 'int76', 'int77', 'int78', 'int79', 'int80', 'int81', 'int82', 'int83', 'int84', 'int85', 'int86', 'int87', 'int88', 'int89', 'int90', 'int91', 'int92', 'int93', 'int94', 'int95', 'int96', 'int97', 'int98', 'int99', 'int100', 'int101', 'int102', 'int103', 'int104', 'int105', 'int106', 'int107', 'int108', 'int109', 'int110', 'int111', 'int112', 'int113', 'int114', 'int115', 'int116', 'int117', 'int118', 'int119', 'int120', 'int121', 'int122', 'int123', 'int124', 'int125', 'int126', 'int127', 'int128', 'int129', 'int130', 'int131', 'int132', 'int133', 'int134', 'int135', 'int136', 'int137', 'int138', 'int139', 'int140', 'int141', 'int142', 'int143', 'int144', 'int145', 'int146', 'int147', 'int148', 'int149', 'int150', 'int151', 'int152', 'int153', 'int154', 'int155', 'int156', 'int157', 'int158', 'int159', 'int160', 'int161', 'int162', 'int163', 'int164', 'int165', 'int166', 'int167', 'int168', 'int169', 'int170', 'int171', 'int172', 'int173', 'int174', 'int175', 'int176', 'int177', 'int178', 'int179', 'int180', 'int181', 'int182', 'int183', 'int184', 'int185', 'int186', 'int187', 'int188', 'int189', 'int190', 'int191', 'int192', 'int193', 'int194', 'int195', 'int196', 'int197', 'int198', 'int199', 'int200', 'int201', 'int202', 'int203', 'int204', 'int205', 'int206', 'int207', 'int208', 'int209', 'int210', 'int211', 'int212', 'int213', 'int214', 'int215', 'int216', 'int217', 'int218', 'int219', 'int220', 'int221', 'int222', 'int223', 'int224', 'int225', 'int226', 'int227', 'int228', 'int229', 'int230', 'int231', 'int232', 'int233', 'int234', 'int235', 'int236', 'int237', 'int238', 'int239', 'int240', 'int241', 'int242', 'int243', 'int244', 'int245', 'int246', 'int247', 'int248', 'int249', 'int250', 'int251', 'int252', 'int253', 'int254', 'int255', 'int256', 'bool', 'byte', 'bytes1', 'bytes2', 'bytes3', 'bytes4', 'bytes5', 'bytes6', 'bytes7', 'bytes8', 'bytes9', 'bytes10', 'bytes11', 'bytes1', 'bytes12', 'bytes13', 'bytes14', 'bytes15', 'bytes16', 'bytes17', 'bytes18', 'bytes19', 'bytes20', 'bytes21', 'bytes22', 'bytes23', 'bytes24', 'bytes25', 'bytes26', 'bytes27', 'bytes28', 'bytes29', 'bytes30', 'bytes31', 'bytes32', 'bytes', 'string', 'delete', 'address', 'call', 'enum', 'struct', 'mapping', 'returns', 'msg', 'now'			
		]
    	,'functions' : [
			// common functions for Window object
			'alert', 'Array', 'back', 'blur', 'clearInterval', 'close', 'confirm', 'eval ', 'focus', 'forward', 'home',
			'name', 'navigate', 'onblur', 'onerror', 'onfocus', 'onload', 'onmove',
			'onresize', 'onunload', 'open', 'print', 'prompt', 'scroll', 'scrollTo', 'setInterval', 'status',
			'stop', 'sha3', 'sha256', 'ripemd160', 'ecrecover', 'suicide'
		]
	}
	,'OPERATORS' :[
		'+', '-', '/', '*', '=', '<', '>', '%', '!'
	]
	,'DELIMITERS' :[
		'(', ')', '[', ']', '{', '}'
	]
	,'STYLES' : {
		'COMMENTS': 'color: #AAAAAA;'
		,'QUOTESMARKS': 'color: #6381F8;'
		,'KEYWORDS' : {
			'statements' : 'color: #60CA00;'
			,'keywords' : 'color: #48BDDF;'
			,'functions' : 'color: #2B60FF;'
		}
		,'OPERATORS' : 'color: #FF00FF;'
		,'DELIMITERS' : 'color: #0038E1;'
				
	}
	,'AUTO_COMPLETION' :  {
		"default": {	// the name of this definition group. It's posisble to have different rules inside the same definition file
			"REGEXP": { "before_word": "[^a-zA-Z0-9_]|^"	// \\s|\\.|
						,"possible_words_letters": "[a-zA-Z0-9_]+"
						,"letter_after_word_must_match": "[^a-zA-Z0-9_]|$"
						,"prefix_separator": "\\."
					}
			,"CASE_SENSITIVE": true
			,"MAX_TEXT_LENGTH": 100		// the maximum length of the text being analyzed before the cursor position
			,"KEYWORDS": {
				'': [	// the prefix of thoses items
						/**
						 * 0 : the keyword the user is typing
						 * 1 : (optionnal) the string inserted in code ("{@}" being the new position of the cursor, "§" beeing the equivalent to the value the typed string indicated if the previous )
						 * 		If empty the keyword will be displayed
						 * 2 : (optionnal) the text that appear in the suggestion box (if empty, the string to insert will be displayed)
						 */
						 ['Array', '§()', '']
			    		,['alert', '§({@})', 'alert(String message)']
			    		,['document']
			    		,['window']
			    	]
		    	,'window' : [
			    		 ['location']
			    		,['document']
			    		,['scrollTo', 'scrollTo({@})', 'scrollTo(Int x,Int y)']
					]
		    	,'location' : [
			    		 ['href']
					]
			}
		}
	}
};
