<?php

class Search_Command extends Search_Replace_Command {

	// Override replacement strings.
	protected $replacements_col_header = 'Matches';
	protected $replacements_to_be_made = array( '%d match.', '%d matches.' );

	/**
	 * Search for strings in the database.
	 *
	 * Shorthand for `wp search-replace <search> '' --dry-run`.
	 * See search-replace for details.
	 */
	public function __invoke( $args, $assoc_args ) {
		if ( null !== \WP_CLI\Utils\get_flag_value( $assoc_args, 'export' ) ) {
			WP_CLI::error( 'You cannot search and --export at the same time.' );
		}
		$old = array_shift( $args );
		$args = array_merge( array( $old, '' ), $args );
		$assoc_args['dry-run'] = true;
		parent::__invoke( $args, $assoc_args );
	}
}
