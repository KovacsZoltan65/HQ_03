<?php

/**
 * Adatbázis függvények
 * 
 * @author Kovács Zoltán <zoltan1_kovacs@msn.com>
 * @date 2024-07-24
 */

namespace App\Traits;

trait Database
{
    public function createDatabase(int $subdomain_id)
    {
        $subdomain = \App\Models\Subdomain::getSubdomainById($subdomain_id);
        $db_host = $subdomain->db_host;
        $db_name = $subdomain->db_name;
        $db_user = $subdomain->db_user;
        $db_password = $subdomain->db_password;
        
        $query = "
                CREATE USER '$db_user'@'$db_host' IDENTIFIED WITH mysql_native_password BY '***';
                GRANT USAGE ON *.* TO '$db_user'@'$db_host';
                ALTER USER '$db_user'@'$db_host' 
                REQUIRE NONE WITH 
                    MAX_QUERIES_PER_HOUR 0 
                    MAX_CONNECTIONS_PER_HOUR 0 
                    MAX_UPDATES_PER_HOUR 0 
                    MAX_USER_CONNECTIONS 0;
                CREATE DATABASE IF NOT EXISTS `$db_name`;
                GRANT ALL PRIVILEGES ON `$db_user`.* TO '$db_name'@'$db_host';";
        /*
        \Illuminate\Support\Facades\Config::set('database.connections.host', $subdomain->db_host);
        \Illuminate\Support\Facades\Config::set('database.connections.database', $subdomain->db_name);
        \Illuminate\Support\Facades\Config::set('database.connections.username', $subdomain->db_user);
        \Illuminate\Support\Facades\Config::set('database.connections.password', $subdomain->db_password);
        
        return $subdomain;
        */
    }
}