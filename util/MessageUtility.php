<?php

/*
  PHP script to send SMS messages with the HTTP API of Diafaan SMS Server

  Created:       26-10-2015
  Last modified: 26-10-2015
 */

//echo SendMessage('127.0.0.1', '9710', 'admin', '123', '+94718124812', 'My text message');
class MessageUtility {

    static function SendMessage($number, $message) {
        
        $host = SMS_CONFIG["host"];
        $port = SMS_CONFIG["port"];
        $username = SMS_CONFIG["username"];
        $password = SMS_CONFIG["password"];
        
        /* Create a TCP/IP socket. */
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            return "socket_create() failed: reason: " . socket_strerror(socket_last_error());
        }

        /* Make a connection to the Diafaan SMS Server host */
        $result = socket_connect($socket, $host, $port);
        if ($result === false) {
            return "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket));
        }

        /* Create the HTTP API query string */
        $query = '/http/send-message/';
        $query .= '?username=' . urlencode($userName);
        $query .= '&password=' . urlencode($password);
        $query .= '&to=' . urlencode($number);
        $query .= '&message=' . urlencode($message);

        /* Send the HTTP GET request */
        $in = "GET " . $query . " HTTP/1.1\r\n";
        $in .= "Host: www.myhost.com\r\n";
        $in .= "Connection: Close\r\n\r\n";
        $out = '';
        socket_write($socket, $in, strlen($in));

        /* Get the HTTP response */
        $out = '';
        while ($buffer = socket_read($socket, 2048)) {
            $out = $out . $buffer;
        }
        socket_close($socket);

        /* Extract the last line of the HTTP response to filter out the HTTP header and get the send result */
        $lines = explode("\n", $out);
        return end($lines);
    }
}