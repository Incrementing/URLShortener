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
class Database
{

    var $connection = null;

    public function get_connection()
    {
        include_once "config.php";
        $config = new Config();

        if ($this->connection == null) {
            $this->connection = mysqli_connect($config->get("db_host"), $config->get("db_username"), $config->get("db_password"), $config->get("db_name"), $config->get("db_port")) or die("Error connecting to mysql database! Might want to check your settings in config.php.");
        }
        return $this->connection;
    }
}