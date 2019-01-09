<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package     theme_ltiessentiallerenisleuk
 * @copyright   2019 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* Core */
$string['configtitle'] = 'LTI Leren is Leuk';
$string['pluginname'] = 'LTI Leren is Leuk';
$string['choosereadme'] = '
<div class="clearfix">
<div class="well">
<h2>LTI Leren is Leuk</h2>
<p><img class="img-polaroid" src="essential/pix/screenshot.jpg" /></p>
</div>
<div class="well">
<h3>About LTI Leren is Leuk</h3>
<p>LTI Leren is Leuk is a child theme of Essential.</p>
<h3>Theme Credits</h3>
<p>Author: Gareth J Barnard</p>
</div></div>';

$string['logo'] = 'LTI Leren is Leuk Logo';
$string['customcss'] = 'LTI Leren is Leuk Custom CSS';
$string['fontselectdesc'] = 'Choose from the list of available font defining mechanisms:<ul><li>\'User fonts\' are where the font is already installed at the users machine and you just specify its name.</li><li>\'Google web fonts\' are where you find a font on \'{$a->googlewebfonts}\' and specify its name.</li></ul>Please save to show the options for your choice.';

// Regions.
$string['region-side-post'] = 'Right';
$string['region-side-pre'] = 'Left';
$string['region-header'] = 'Header';
$string['region-home'] = 'Home';
$string['region-page-top'] = 'Page top';
$string['region-footer-left'] = 'Footer (Left)';
$string['region-footer-middle'] = 'Footer (Middle)';
$string['region-footer-right'] = 'Footer (Right)';
$string['region-hidden-dock'] = 'Hidden from users';

// Privacy.
$string['privacy:nop'] = 'The LTI Leren is Leuk theme stores lots of settings that pertain to its configuration.  None of the settings are related to a specific user.  It is your responsibilty to ensure that no user data is entered in any of the free text fields.  Setting a setting will result in that action being logged within the core Moodle logging system against the user whom changed it, this is outside of the themes control, please see the core logging system for privacy compliance for this.  When uploading images, you should avoid uploading images with embedded location data (EXIF GPS) included or other such personal data.  It would be possible to extract any location / personal data from the images.  Please examine the code carefully to be sure that it complies with your interpretation of your privacy laws.  Also check the parent Essential theme for privacy information.  I am not a lawyer and my analysis is based on my interpretation.  If you have any doubt then remove the theme forthwith.';
