<?php

namespace SampApi\Models;

use SampApi\Model;

/**
 * Class Varlist
 *
 * @package SampApi\Models
 *
 * @property-read string $bind
 * @property-read string $filterscripts
 * @property-read int    $incar_rate
 * @property-read string $lagcomp
 * @property-read int    $lagcompmode
 * @property-read string $logtimeformat
 * @property-read int    $maxplayers
 * @property-read string $nosign
 * @property-read int    $onfoot_rate
 * @property-read string $plugins
 * @property-read int    $port
 * @property-read string $version
 * @property-read int    $weapon_rate
 * @property int         $ackslimit
 * @property bool        $announce
 * @property int         $chatlogging
 * @property int         $conncookies
 * @property int         $connseedtime
 * @property int         $cookielogging
 * @property int         $db_log_queries
 * @property int         $db_logging
 * @property string      $gamemode0
 * @property string      $gamemode1
 * @property string      $gamemode10
 * @property string      $gamemode11
 * @property string      $gamemode12
 * @property string      $gamemode13
 * @property string      $gamemode14
 * @property string      $gamemode15
 * @property string      $gamemode2
 * @property string      $gamemode3
 * @property string      $gamemode4
 * @property string      $gamemode5
 * @property string      $gamemode6
 * @property string      $gamemode7
 * @property string      $gamemode8
 * @property string      $gamemode9
 * @property string      $gamemodetext
 * @property string      $gravity
 * @property string      $hostname
 * @property string      $language
 * @property bool        $lanmode
 * @property string      $logqueries
 * @property string      $mapname
 * @property int         $maxnpc
 * @property int         $messageholelimit
 * @property int         $messageslimit
 * @property int         $minconnectiontime
 * @property bool        $myriad
 * @property bool        $output
 * @property string      $password
 * @property int         $playertimeout
 * @property bool        $query
 * @property bool        $rcon
 * @property string      $rcon_password
 * @property int         $sleep
 * @property float       $stream_distance
 * @property int         $stream_rate
 * @property bool        $timestamp
 * @property string      $weather
 * @property string      $weburl
 * @property string      $worldtime
 */
class Varlist extends Model
{
    /**
     * List of parameters which not possible to change
     */
    protected array $readonly = [
        'bind',
        'filterscripts',
        'incar_rate',
        'lagcomp',
        'lagcompmode',
        'logtimeformat',
        'maxplayers',
        'nosign',
        'onfoot_rate',
        'plugins',
        'port',
        'version',
        'weapon_rate',
    ];

    /**
     * List of parameters which may be changed
     *
     * @var array
     */
    protected array $writable = [
        'ackslimit',
        'announce',
        'chatlogging',
        'conncookies',
        'connseedtime',
        'cookielogging',
        'db_log_queries',
        'db_logging',
        'gamemode0',
        'gamemode1',
        'gamemode10',
        'gamemode11',
        'gamemode12',
        'gamemode13',
        'gamemode14',
        'gamemode15',
        'gamemode2',
        'gamemode3',
        'gamemode4',
        'gamemode5',
        'gamemode6',
        'gamemode7',
        'gamemode8',
        'gamemode9',
        'gamemodetext',
        'gravity',
        'hostname',
        'language',
        'lanmode',
        'logqueries',
        'mapname',
        'maxnpc',
        'messageholelimit',
        'messageslimit',
        'minconnectiontime',
        'myriad',
        'output',
        'password',
        'playertimeout',
        'query',
        'rcon',
        'rcon_password',
        'sleep',
        'stream_distance',
        'stream_rate',
        'timestamp',
        'weather',
        'weburl',
        'worldtime',
    ];

    /**
     * List of properties which is a rules of server
     */
    protected array $rules = [
        'lagcomp',
        'version',
        'mapname',
        'weather',
        'weburl',
        'worldtime'
    ];
}