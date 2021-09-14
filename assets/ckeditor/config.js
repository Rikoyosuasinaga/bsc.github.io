/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	config.uiColor = '#7C4DFF';
	// config.skin = 'moono-dark';
	config.codeSnippet_theme = 'monokai_sublime';
	config.filebrowserBrowseUrl = '../assets/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = '../assets/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = '../../assets/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = '../../assets/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = '../../assets/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = '../../assets/kcfinder/upload.php?type=flash';
};
