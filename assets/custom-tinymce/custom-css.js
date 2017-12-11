// JavaScript Document

(function() {
     /* Register the buttons */
     tinymce.create('tinymce.plugins.wwsButtons', {
          init : function(ed, url) {
			  console.log(url);
               /**
               * Adds 'action-button' class to selected element
               */
               ed.addButton( 'button_cta', {
                    title : 'Turn into Call To Action button',
					image : url+'/button_grey.png',
                    cmd: 'button_cta_cmd'
               });
			   
               ed.addCommand( 'button_cta_cmd', function() {
					ed.dom.toggleClass (ed.selection.getNode(), 'action-button');
               });
          },
          createControl : function(n, cm) {
               return null;
          },
     });
     /* Start the buttons */
     tinymce.PluginManager.add( 'wws_button_script', tinymce.plugins.wwsButtons );
})();


