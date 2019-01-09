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
namespace theme_ltiessentiallerenisleuk\output;

use html_writer;

class core_renderer extends \theme_essential\output\core_renderer {

    /**
     * Constructor
     *
     * @param moodle_page $page the page we are doing output for.
     * @param string $target one of rendering target constants
     */
    public function __construct(\moodle_page $page, $target) {
        parent::__construct($page, $target);
        $this->themeconfig[] = \theme_config::load('ltiessentiallerenisleuk');  // Initialised by the Essential constructor.
    }

    public function get_tile_file($filename) {
        global $CFG;
        $themedir = $this->page->theme->dir;
        $filenameext = $filename.'.php';
        // Check only if a child of 'Essential' to prevent conflicts with other themes using the 'tiles' folder....
        if (in_array('essential', $this->page->theme->parents)) {
            $themename = $this->page->theme->name;
            if (file_exists("$themedir/layout/tiles/$filenameext")) {
                return "$themedir/layout/tiles/$filenameext";
            } else if (file_exists("$CFG->dirroot/theme/$themename/layout/tiles/$filenameext")) {
                return "$CFG->dirroot/theme/$themename/layout/tiles/$filenameext";
            } else if (!empty($CFG->themedir) and file_exists("$CFG->themedir/$themename/layout/tiles/$filenameext")) {
                return "$CFG->themedir/$themename/layout/tiles/$filenameext";
            }
        }
        return parent::get_tile_file($filename);
    }

    /**
     * Return the standard string that says whether you are logged in (and switched
     * roles/logged in as another user).
     * @param bool $withlinks if false, then don't include any links in the HTML produced.
     * If not set, the default is the nologinlinks option from the theme config.php file,
     * and if that is not set, then links are included.
     * @return string HTML fragment.
     */
    public function login_info($withlinks = null) {
        global $USER, $CFG, $DB, $SESSION;

        if ((during_initial_install()) || ((!empty($USER->auth)) && ($USER->auth == 'lti'))) {
            return '';
        }

        if (is_null($withlinks)) {
            $withlinks = empty($this->page->layout_options['nologinlinks']);
        }

        $course = $this->page->course;
        if (\core\session\manager::is_loggedinas()) {
            $realuser = \core\session\manager::get_realuser();
            $fullname = fullname($realuser, true);
            if ($withlinks) {
                $loginastitle = get_string('loginas');
                $realuserinfo = " [<a href=\"$CFG->wwwroot/course/loginas.php?id=$course->id&amp;sesskey=".sesskey()."\"";
                $realuserinfo .= "title =\"".$loginastitle."\">$fullname</a>] ";
            } else {
                $realuserinfo = " [$fullname] ";
            }
            $realuserinfo .= '<br>';
        } else {
            $realuserinfo = '';
        }

        $loginpage = $this->is_login_page();
        $loginurl = get_login_url();

        if (empty($course->id)) {
            // $course->id is not defined during installation.
            return '';
        } else if (isloggedin()) {
            $context = \context_course::instance($course->id);

            $fullname = fullname($USER, true);
            // Since Moodle 2.0 this link always goes to the public profile page (not the course profile page).
            if ($withlinks) {
                $linktitle = get_string('viewprofile');
                $username = "<a href=\"$CFG->wwwroot/user/profile.php?id=$USER->id\" title=\"$linktitle\" class=\"bold\">$fullname</a>";
            } else {
                $username = $fullname;
            }
            if (is_mnet_remote_user($USER) and $idprovider = $DB->get_record('mnet_host', array('id'=>$USER->mnethostid))) {
                if ($withlinks) {
                    $username .= " from <a href=\"{$idprovider->wwwroot}\">{$idprovider->name}</a>";
                } else {
                    $username .= " from {$idprovider->name}";
                }
            }
            if (isguestuser()) {
                $loggedinas = $realuserinfo;
                if (!$loginpage && $withlinks) {
                    $loggedinas .= " (<a href=\"$loginurl\">".get_string('login').'</a>)';
                }
            } else if (is_role_switched($course->id)) { // Has switched roles.
                $rolename = '';
                if ($role = $DB->get_record('role', array('id'=>$USER->access['rsw'][$context->path]))) {
                    $rolename = ': '.role_get_name($role, $context);
                }
                $loggedinas = $username.$rolename;
                if ($withlinks) {
                    $url = new \moodle_url('/course/switchrole.php', array('id'=>$course->id,'sesskey'=>sesskey(), 'switchrole'=>0, 'returnurl'=>$this->page->url->out_as_local_url(false)));
                    $loggedinas .= ' ('.html_writer::tag('a', get_string('switchrolereturn'), array('href' => $url)).')';
                }
            } else {
                $loggedinas = $realuserinfo.$username;
                if ($withlinks) {
                    $loggedinas .= "<br>(<a href=\"$CFG->wwwroot/login/logout.php?sesskey=".sesskey()."\">".get_string('logout').'</a>)';
                }
            }
        } else {
            $loggedinas = get_string('loggedinnot', 'moodle');
            if (!$loginpage && $withlinks) {
                $loggedinas .= "<br>(<a href=\"$loginurl\">".get_string('login').'</a>)';
            }
        }

        $loggedinas = '<div class="logininfo">'.$loggedinas.'</div>';

        if (isset($SESSION->justloggedin)) {
            unset($SESSION->justloggedin);
            if (!empty($CFG->displayloginfailures)) {
                if (!isguestuser()) {
                    // Include this file only when required.
                    require_once($CFG->dirroot . '/user/lib.php');
                    if ($count = user_count_login_failures($USER)) {
                        $loggedinas .= '<div class="loginfailures">';
                        $a = new stdClass();
                        $a->attempts = $count;
                        $loggedinas .= get_string('failedloginattempts', '', $a);
                        if (file_exists("$CFG->dirroot/report/log/index.php") and has_capability('report/log:view', context_system::instance())) {
                            $loggedinas .= ' ('.html_writer::link(new \moodle_url('/report/log/index.php', array('chooselog' => 1,
                                    'id' => 0 , 'modid' => 'site_errors')), get_string('logs')).')';
                        }
                        $loggedinas .= '</div>';
                    }
                }
            }
        }

        return $loggedinas;
    }

    /**
     * The standard tags (typically performance information and validation links,
     * if we are in developer debug mode) that should be output in the footer area
     * of the page. Designed to be called in theme layout.php files.
     *
     * @return string HTML fragment.
     */
    public function standard_footer_html() {
        global $CFG, $SCRIPT;

        $output = '';
        if (during_initial_install()) {
            /* Debugging info can not work before install is finished,
               in any case we do not want any links during installation! */
            return $output;
        }

        /* Give plugins an opportunity to add any footer elements.
           The callback must always return a string containing valid html footer content. */
        $pluginswithfunction = get_plugins_with_function('standard_footer_html', 'lib.php');
        foreach ($pluginswithfunction as $plugins) {
            foreach ($plugins as $function) {
                if ($function == 'tool_mobile_standard_footer_html') {
                    continue;
                }
                $output .= $function();
            }
        }

        /* This function is normally called from a layout.php file in {@link core_renderer::header()}
           but some of the content won't be known until later, so we return a placeholder
           for now. This will be replaced with the real content in {@link core_renderer::footer()}. */
        $output .= $this->unique_performance_info_token;
        if ($this->page->devicetypeinuse == 'legacy') {
            // The legacy theme is in use print the notification
            $output .= html_writer::tag('div', get_string('legacythemeinuse'), array('class'=>'legacythemeinuse'));
        }

        // Get links to switch device types (only shown for users not on a default device).
        $output .= $this->theme_switch_links();

        if (!empty($CFG->debugpageinfo)) {
            $output .= '<div class="performanceinfo pageinfo">' . get_string('pageinfodebugsummary', 'core_admin',
                $this->page->debug_summary()) . '</div>';
        }
        if (debugging(null, DEBUG_DEVELOPER) and has_capability('moodle/site:config', \context_system::instance())) {  // Only in developer mode.
            // Add link to profiling report if necessary
            if (function_exists('profiling_is_running') && profiling_is_running()) {
                $txt = get_string('profiledscript', 'admin');
                $title = get_string('profiledscriptview', 'admin');
                $url = $CFG->wwwroot . '/admin/tool/profiling/index.php?script=' . urlencode($SCRIPT);
                $link= '<a title="' . $title . '" href="' . $url . '">' . $txt . '</a>';
                $output .= '<div class="profilingfooter">' . $link . '</div>';
            }
            $purgeurl = new \moodle_url('/admin/purgecaches.php', array('confirm' => 1,
                'sesskey' => sesskey(), 'returnurl' => $this->page->url->out_as_local_url(false)));
            $output .= '<div class="purgecaches">' .
                    html_writer::link($purgeurl, get_string('purgecaches', 'admin')) . '</div>';
        }
        if (!empty($CFG->debugvalidators)) {
            // NOTE: this is not a nice hack, $PAGE->url is not always accurate and $FULLME neither, it is not a bug if it fails. --skodak.
            $output .= '<div class="validators"><ul class="list-unstyled m-l-1">
              <li><a href="http://validator.w3.org/check?verbose=1&amp;ss=1&amp;uri=' . urlencode(qualified_me()) . '">Validate HTML</a></li>
              <li><a href="http://www.contentquality.com/mynewtester/cynthia.exe?rptmode=-1&amp;url1=' . urlencode(qualified_me()) . '">Section 508 Check</a></li>
              <li><a href="http://www.contentquality.com/mynewtester/cynthia.exe?rptmode=0&amp;warnp2n3e=1&amp;url1=' . urlencode(qualified_me()) . '">WCAG 1 (2,3) Check</a></li>
            </ul></div>';
        }
        return $output;
    }
}
