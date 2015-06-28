<?php

  class Player {

    private $db;

    public function __construct($db) {
      $this->db = $db;
    }

    // Converts SteamID back to STEAM_X:Y:ZZZZZZZZ format
    private function convertId($id) {
      $idstr = (string)$id;
      $x = substr($idstr, 0, 1);
      $y = substr($idstr, 1, 1);
      $z = substr($idstr, 2);
      $steamid = 'STEAM_'.$x.':'.$y.':'.$z;
      return $steamid;
    }

    public function getList() {
      return $this->db->fetchAll('SELECT * From playerrank ORDER BY points DESC LIMIT 25');
    }

    public function getDetail($id) {
      $steamid = $this->convertId($id);
      $player = [];
      $rank = $this->db->fetch('SELECT name, points From `playerrank` WHERE steamid = "'.$steamid.'"');
      $jumpstats = $this->db->fetch('SELECT multibhoprecord, bhoprecord, ljrecord FROM `playerjumpstats3` WHERE steamid = "'.$steamid.'"');
      return array_merge($player, $rank, $jumpstats);
    }

  }