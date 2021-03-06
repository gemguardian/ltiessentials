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
 * @package     theme_ltiessential
 * @copyright   2019 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$plugin->version = 2019010203; // YYYYMMDDVV.
$plugin->maturity = MATURITY_STABLE; // This version's maturity level.
$plugin->release = '3.5.0.4 (Build: 2019010203)';
$plugin->requires  = 2018051700.00; // 3.5 (Build: 20180517).
$plugin->component = 'theme_ltiessential';
$plugin->dependencies = array(
    'theme_essential'  => 2018051903 // When H5P setting was added.
);