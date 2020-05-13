<?php

if(!defined('MyConst')) {
   die('Direct access not permitted');
}

// insert
$sqlInsertUser = "INSERT INTO  user(username, password) VALUES (?, ?)";

$sqlInsertDevice = "INSERT INTO devices(MAC, IP, device_type, OS, user) VALUES(?,?,?,?,?)";

// select
	
$sqlSelectID = "SELECT id from user WHERE username = ?";

$sqlSelectUser = "SELECT id, username, password, rol from user where username = ?";

$sqlSelectDevices = "SELECT MAC, IP, device_type, OS from devices where user = ?";

$sqlSelectApESSID = "SELECT AP_ESSID from access_point where MAC = ?";

$sqlSelectWiFiDetails = "SELECT * from access_point_details where AP_ESSID = ?";

$sqlSelectDeviceMAC = "SELECT MAC from devices where MAC = ?";

$sqlSelectDeviceIP = "SELECT IP from devices where IP = ?";

$sqlSelectDevicesSwitch = "SELECT * from switch";

// $sqlSelectAPBridge = "SELECT access_point_details.*, access_point_bridge.* from access_point_bridge, access_point_details WHERE access_point_bridge.ESSID = access_point_details.AP_ESSID AND access_point_bridge.ESSID = ?";

$sqlSelectApBSSID = "SELECT BSSID from access_point_bridge where ESSID = ?";

$sqlSelectServerDetails = "SELECT * FROM server WHERE server_type = ?";

$sqlSelectRouterDetails = "SELECT * FROM router";

$sqlSelectRouterINT0 = "SELECT IP_int_0 FROM router WHERE IP_int_0 = ? ";


// delete

$sqlDeleteUserDevice = "DELETE FROM devices where MAC = ?";

// update

$sqlUpdateRouterInt = "UPDATE router SET IP_int_0 = ?";
?>