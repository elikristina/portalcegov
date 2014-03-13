function filebrowser(field_name, url, type, win) {
		
		fileBrowserURL = "http://cegov.ufrgs.br/pdw/index.php?filter=" + type;
				
		tinyMCE.activeEditor.windowManager.open({
			title: "PDW File Browser",
			url: fileBrowserURL,
			width: 950,
			height: 650,
			inline: 0,
			maximizable: 1,
			close_previous: 0
		},{
			window : win,
			input : field_name
		});		
	}

function openKCFinder(field_name, url, type, win) {
    tinyMCE.activeEditor.windowManager.open({
        file: 'http://cegov.ufrgs.br/kcfinder/browse.php?opener=tinymce&type=' + type,
        title: 'KCFinder',
        width: 700,
        height: 500,
        resizable: "yes",
        inline: true,
        close_previous: "no",
        popup_css: false
    }, {
        window: win,
        input: field_name
    });
    return false;
}