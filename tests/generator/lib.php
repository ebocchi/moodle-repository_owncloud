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
 *
 * @package    repository_owncloud
 * @category   test
 * @copyright  2017 Project seminar (Learnweb, University of Münster)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 *
 * @package    repository_sciebo
 * @category   test
 * @copyright  2017 Project seminar (Learnweb, University of Münster)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class repository_owncloud_generator extends testing_repository_generator {

    /**
     * Creates an issuer and a user.
     * @return \core\oauth2\core\oauth2\issuer
     */
    public function test_create_issuer () {
        $generator = advanced_testcase::getDataGenerator();
        $data = array();
        $issuerdata = new stdClass();
        $issuerdata->name = "Service";
        $issuerdata->clientid = "Clientid";
        $issuerdata->clientsecret = "Secret";
        $issuerdata->loginscopes = "openid profile email";
        $issuerdata->loginscopesoffline = "openid profile email";
        $issuerdata->baseurl = "";
        $issuerdata->image = "aswdf";

        // Create the issuer.
        $issuer = \core\oauth2\api::create_issuer($issuerdata);
        return $issuer;
    }
    /**
     * Creates an issuer and a user.
     * @param int $issuerid
     * @return \core\oauth2\core\oauth2\issuer
     */
    public function test_create_endpoints ($issuerid) {
        $this->test_create_single_endpoint("ocs_endpoint", $issuerid);
        $this->test_create_single_endpoint("authorization_endpoint", $issuerid);
        $this->test_create_single_endpoint("webdav_endpoint", $issuerid, "https://www.default.de/webdav/index.php");
        $this->test_create_single_endpoint("token_endpoint", $issuerid);
    }
    /**
     * @param $endpointtype
     * @param int $issuerid
     * @param string $url
     * @return mixed
     */
    public function test_create_single_endpoint($endpointtype, $issuerid, $url="https://www.default.de") {
        $endpoint = new stdClass();
        $endpoint->name = $endpointtype;
        $endpoint->url = $url;
        $endpoint->issuerid = $issuerid;
        $return = \core\oauth2\api::create_endpoint($endpoint);
        return $return;
    }
}