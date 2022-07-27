<?php
namespace App\Classes\Session;
require_once './app/classes/Session/abstracts/AbsSession.php';
use App\Classes\Session\Abstracts\AbsSession\AbsSessions as AbsSessions;
/**
 * Main app class.
 * @version 0.0.0
 */
class Session extends AbsSessions{
    public function __construct(){session_start();}
}
