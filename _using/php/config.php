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
class Config
{

    var $variables = array(
        "db_host" => "localhost", // The hostname of the database.
        "db_port" => 3306, // The port the database is using.
        "db_username" => "root", // The database username.
        "db_password" => "password", // The database password.
        "db_name" => "shortener", // The database name.
        "db_urls_table" => "urls", // The name of the table that holds the urls.
        "protocol" => "http", //HTTP or HTTPS
        "domain" => "192.168.1.81", // The domain (or sub-domain) the website is being hosted on.
        "path" => "/", // The path that the main index.php file is in (include trailing slash).
        "meta_description" => "An open-source URLShortener", // The content part of the description meta tag.
        "meta_keywords" => "URL, Shortener, URLShortener, OpenSource", // The content part of the keywords meta tag.
        "website_name" => "URLShortener", // The name of the website.
    );

    public function get($name)
    {
        try {
            return $this->variables[$name];
        } catch (Exception $ex) {
            return "ERROR";
        }
    }
}