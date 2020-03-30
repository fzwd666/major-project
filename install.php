<?php
include("Connet.php");
$SQL="DROP TABLE IF EXISTS `web`;";
$SQL2="CREATE TABLE `web` (
    `webId` int(11) NOT NULL,
    `web` varchar(1000) NOT NULL,
    `webAbout` varchar(1000) NOT NULL,
    `webtime` datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
  $SQL3="ALTER TABLE `web` ADD PRIMARY KEY (`webId`);";
  $SQL4="ALTER TABLE `web` MODIFY `webId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;";
  $link->query($SQL);
  $link->query($SQL2);
  $link->query($SQL3);
  $link->query($SQL4);
?>