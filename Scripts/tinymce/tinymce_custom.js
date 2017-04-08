// Custom Settings
var custom_button_style = "background: #f2f6f8;background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2YyZjZmOCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUwJSIgc3RvcC1jb2xvcj0iI2Q4ZTFlNyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUxJSIgc3RvcC1jb2xvcj0iI2I1YzZkMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNlMGVmZjkiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);background: -moz-linear-gradient(top,  #f2f6f8 0%, #d8e1e7 50%, #b5c6d0 51%, #e0eff9 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f2f6f8), color-stop(50%,#d8e1e7), color-stop(51%,#b5c6d0), color-stop(100%,#e0eff9));background: -webkit-linear-gradient(top,  #f2f6f8 0%,#d8e1e7 50%,#b5c6d0 51%,#e0eff9 100%);background: -o-linear-gradient(top,  #f2f6f8 0%,#d8e1e7 50%,#b5c6d0 51%,#e0eff9 100%);background: -ms-linear-gradient(top,  #f2f6f8 0%,#d8e1e7 50%,#b5c6d0 51%,#e0eff9 100%);background: linear-gradient(to bottom,  #f2f6f8 0%,#d8e1e7 50%,#b5c6d0 51%,#e0eff9 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f6f8', endColorstr='#e0eff9',GradientType=0 );";
if(customMCEHeight==''){customMCEHeight='400';}else{customMCEHeight=customMCEHeight;}
if(customMCEWidth==''){customMCEWidth='400';}else{customMCEWidth=customMCEWidth;}

tinymce.init({
	selector:'.mceEditor',
	language:customMCEchar,
	menubar:false,
	plugins: 'textcolor,link,image,charmap,code,table,emoticons,wordcount',
	toolbar1: 'formatselect fontselect fontsizeselect forecolor backcolor',
	toolbar2: 'bold italic underline strikethrough alignleft aligncenter alignright alignjustify bullist numlist outdent indent blockquote',
	toolbar3: 'link unlink image charmap | table | firmname firmaddress firmtel firmfax firmmail firmweb | code',
	height: customMCEHeight,
	width:customMCEWidth,
	entity_encoding : "raw",
	
	    setup : function(ed) {
		
			if(customButCMS){
				// Add Firm Name Button
				ed.addButton('firmname', {
				title : 'Site Name',
				image : 'Scripts/tinymce/skins/lightgray/buttons/firmname.png',
				style: custom_button_style,
				onclick : function() {
					// Add you own code to execute something on click
					ed.focus();
					ed.selection.setContent('<strong>[[sitename]]</strong>');
					},
				});
				// Add Firm Address Button
				ed.addButton('firmaddress', {
				title : 'Post Address',
				image : 'Scripts/tinymce/skins/lightgray/buttons/firmaddress.png',
				style: custom_button_style,
				onclick : function() {
					// Add you own code to execute something on click
					ed.focus();
					ed.selection.setContent('<strong>[[address]]</strong>');
					}
				});
				// Add Phone Button
				ed.addButton('firmtel', {
				title : 'Phone Number',
				image : 'Scripts/tinymce/skins/lightgray/buttons/firmtel.png',
				style: custom_button_style,
				onclick : function() {
					// Add you own code to execute something on click
					ed.focus();
					ed.selection.setContent('<strong>[[phone]]</strong>');
					}
				});
				// Add Fax Button
				ed.addButton('firmfax', {
				title : 'Fax Number',
				image : 'Scripts/tinymce/skins/lightgray/buttons/firmfax.png',
				style: custom_button_style,
				onclick : function() {
					// Add you own code to execute something on click
					ed.focus();
					ed.selection.setContent('<strong>[[fax]]</strong>');
					}
				});
				// Add E-Mail Address Button
				ed.addButton('firmmail', {
				title : 'E-Mail Address',
				image : 'Scripts/tinymce/skins/lightgray/buttons/firmmail.png',
				style: custom_button_style,
				onclick : function() {
					// Add you own code to execute something on click
					ed.focus();
					ed.selection.setContent('<strong>[[email]]</strong>');
					}
				});
				// Add Web Button
				ed.addButton('firmweb', {
				title : 'Web Address',
				image : 'Scripts/tinymce/skins/lightgray/buttons/firmweb.png',
				style: custom_button_style,
				onclick : function() {
					// Add you own code to execute something on click
					ed.focus();
					ed.selection.setContent('<strong>[[web]]</strong>');
					}
				});
			}
    }

});