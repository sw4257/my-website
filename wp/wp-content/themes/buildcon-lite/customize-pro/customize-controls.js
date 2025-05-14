( function( api ) {

	// Extends our custom "buildcon-lite" section.
	api.sectionConstructor['buildcon-lite'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );