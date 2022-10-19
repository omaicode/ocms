window.Ckeditor = ClassicEditor.Editor

class Shortcodes extends ClassicEditor.Plugin {
    init() {
        const editor = this.editor;
        const t = editor.t;

        editor.ui.componentFactory.add( 'shortcodes', (locale) => {
            const dropdownView = ClassicEditor.createDropdown(locale);
            const shortcodes = window.OCMS?.Shortcodes || []

			const buttons = shortcodes.map( option => editor.ui.componentFactory.create(`shortcodes:${option}`) );
			ClassicEditor.addToolbarToDropdown( dropdownView, buttons );            

			dropdownView.buttonView.set( {
				label: t( 'Shortcodes' ),
				withText: true
			} );                   

            dropdownView.toolbarView.isVertical = true;

            return dropdownView;
        } );
    }
}

window.Ckeditor.builtinPlugins = window.Ckeditor.builtinPlugins.concat([Shortcodes])
window.Ckeditor.defaultConfig.toolbar.items = window.Ckeditor.defaultConfig.toolbar.items.concat(['shortcodes'])