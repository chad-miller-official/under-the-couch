<?
    db_include(
        'get_member_session_by_key',
        'create_or_update_member_session_by_key',
        'delete_member_session_by_key',
        'delete_stale_member_sessions'
    );

    class GTMNSessionHandler implements SessionHandlerInterface
    {
        private $dbHandle;
        private $cookie;

        const _SESSION_NAME            = 'gtmn';
        const _SESSION_TIMEOUT_SECONDS = 3600;

        const _LIFETIME  = 'lifetime';
        const _PATH      = 'path';
        const _DOMAIN    = 'domain';
        const _SECURE    = 'secure';
        const _HTTP_ONLY = 'http_only';

        public function __construct()
        {
            $this->cookie = [
                self::_LIFETIME  => 0,
                self::_PATH      => '/',
                self::_DOMAIN    => $_SERVER['SERVER_NAME'],
                self::_SECURE    => ( @$_SERVER['HTTPS'] ?: false ),
                self::_HTTP_ONLY => true
            ];

            ini_set( 'session.use_cookies', 1 );
            ini_set( 'session.use_only_cookies', 1 );

            session_name( self::_SESSION_NAME );

            session_set_cookie_params(
                $this->cookie[self::_LIFETIME],
                $this->cookie[self::_PATH],
                $this->cookie[self::_DOMAIN],
                $this->cookie[self::_SECURE],
                $this->cookie[self::_HTTP_ONLY]
            );
        }

        public function open( $save_path, $session_name )
        {
            error_log( "SessionHandler::open() called!" );
            $this->dbHandle = get_or_connect_to_db();
            return $this->dbHandle !== null;
        }

        public function close()
        {
            error_log( "SessionHandler::close() called!" );
            return true;
        }

        public function read( $session_id )
        {
            error_log( "SessionHandler::read() called!" );

            $session = get_member_session_by_key( $session_id );

            if( !is_array( $session ) )
                return '';

            error_log( "Member session found!" );

            if( $session['age_seconds'] >= self::_SESSION_TIMEOUT_SECONDS )
            {
                error_log( "Member session is old - deleting!" );
                $this->destroy( $session_id );
                return '';
            }

            return $session['value'];
        }

        public function write( $session_id, $data )
        {
            error_log( "SessionHandler::write() called!" );

            $member_session_columns = [
                'member'   => SessionLib::get( 'user_member.member' ),
                'value'    => $data,
                'accessed' => 'now()'
            ];

            $session = create_or_update_member_session_by_key( $session_id, $member_session_columns );
            return $session !== false;
        }

        public function destroy( $session_id )
        {
            error_log( "SessionHandler::destroy() called!" );

            setcookie(
                self::_SESSION_NAME,
                '',
                time() - 42000,
                $this->cookie[self::_PATH],
                $this->cookie[self::_DOMAIN],
                $this->cookie[self::_SECURE],
                $this->cookie[self::_HTTP_ONLY]
            );

            delete_member_session_by_key( $session_id );
            return true;
        }

        public function gc( $lifetime )
        {
            error_log( "SessionHandler::gc() called!" );
            //delete_stale_member_sessions( $lifetime );
            return true;
        }
    }
?>
