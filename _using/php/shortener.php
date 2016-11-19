<?php

/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
class URLShortener
{

    public function get_short_url()
    {
        $result = null;
        if (isset($_SESSION["url"])) {
            $url = $_SESSION["url"];
            include_once("database.php");
            include_once("config.php");
            $db = new Database();
            $config = new Config();
            $table = $config->get("db_urls_table");

            if (mysqli_num_rows(mysqli_query($db->get_connection(), "SELECT url FROM $table WHERE url='" . mysqli_escape_string($db->get_connection(), $url) . "'")) >= 1) {
                $result = mysqli_query($db->get_connection(), "SELECT code FROM $table WHERE url='" . mysqli_escape_string($db->get_connection(), $url) . "'");
                $code = "error";
                while ($row = mysqli_fetch_assoc($result)) {
                    $code = $row["code"];
                }
                $result = $config->get("protocol") . "://" . $config->get("domain") . $config->get("path") . $code;
            }
            else {
                mysqli_query($db->get_connection(), "INSERT INTO $table(id, url, code, datetime, ip_address) VALUES ('0','" . mysqli_escape_string($db->get_connection(), $url) . "','0','" . time() . "','" . $this->get_ip() . "')");
                $code = base_convert($db->get_connection()->insert_id, 10, 36);
                mysqli_query($db->get_connection(), "UPDATE $table SET code='$code' WHERE url='" . mysqli_escape_string($db->get_connection(), $url) . "'");
                $result = $config->get("protocol") . "://" . $config->get("domain") . $config->get("path") . $code;
            }
        }
        session_unset();
        session_destroy();
        return $result;
    }

    private function get_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}