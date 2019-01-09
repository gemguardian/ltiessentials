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

$THEME->name = 'ltiessentiallerenisleuk';

$THEME->yuicssmodules = array();
$THEME->parents = array('essential', 'bootstrapbase');

$THEME->sheets[] = 'ltiessentiallerenisleuk';

$THEME->supportscssoptimisation = false;

$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->csspostprocess = 'theme_ltiessentiallerenisleuk_process_css';
