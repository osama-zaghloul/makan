/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

// CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
// };

// CKEDITOR.editorConfig = function( config ) {

//   //   config.enterMode = 2; //disabled <p> completely
//         config.enterMode = CKEDITOR.ENTER_BR; // pressing the ENTER KEY input <br/>
//         config.shiftEnterMode = CKEDITOR.ENTER_P; //pressing the SHIFT + ENTER KEYS input <p>
//         config.autoParagraph = false; // stops automatic insertion of <p> on focus
//     };


CKEDITOR.editorConfig = function( config ) {
   config.autoParagraph = false; 
   config.shiftEnterMode = CKEDITOR.ENTER_BR;
    config.shiftEnterMode = CKEDITOR.ENTER_DIV;
    config.shiftEnterMode = CKEDITOR.ENTER_P; //pressing the SHIFT + ENTER KEYS input <p>
config.disallowedContent = 'a';
config.disallowedContent = 'br';
config.disallowedContent = 'p';
config.disallowedContent = 'pre';
    // stops automatic insertion of <p> on focus

    config.allowedContent = false; // don't filter my data

};  