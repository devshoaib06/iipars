<?php return array (
  'app' => 
  array (
    'name' => 'Teachinns',
    'env' => 'production',
    'debug' => true,
    'url' => 'http://teachinns.com',
    'asset_url' => NULL,
    'timezone' => 'Asia/Kolkata',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:0kOVTpNfd6tIdsCFY1Y2dVsgGMpOBI4OXPNKd/k336U=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'App\\Providers\\RouteServiceProvider',
      26 => 'Barryvdh\\DomPDF\\ServiceProvider',
      27 => 'Riskihajar\\Terbilang\\TerbilangServiceProvider',
      28 => 'Laravel\\Passport\\PassportServiceProvider',
      29 => 'Intervention\\Image\\ImageServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Hasher' => 'App\\Helpers\\HasherServiceHelper',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
      'Terbilang' => 'Riskihajar\\Terbilang\\Facades\\Terbilang',
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'admins' => 
      array (
        'driver' => 'session',
        'provider' => 'admins',
      ),
      'contributors' => 
      array (
        'driver' => 'session',
        'provider' => 'contributors',
      ),
      'resellers' => 
      array (
        'driver' => 'session',
        'provider' => 'resellers',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
      'admins' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Admin',
      ),
      'contributors' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
      'resellers' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/var/www/html/iipars/ugcnet/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'teachinns_cache',
  ),
  'constants' => 
  array (
    'site_name' => 'Teachinns',
    'admin_prefix' => 'admin',
    'item_per_page' => 3,
    'proposal_connect' => 1,
    'user_message_connect' => 1,
    'check_login_status' => 5000,
    'message_word_limit' => 500,
    'all_providers_item_per_page' => 4,
    'group_invite_user_item_per_page' => 30,
    'all_owners_item_per_page' => 4,
    'all_groups_item_per_page' => 3,
    'all_events_item_per_page' => 3,
    'LENGTH_MENU_BASIC_1' => '25, 50',
    'LENGTH_MENU_BASIC_2' => '25, 50',
    'PAGE_LENGTH_BASIC' => '25',
    'LENGTH_MENU_ADVANCE_1' => '25, 50, 100, 150',
    'LENGTH_MENU_ADVANCE_2' => '25, 50, 100, 150',
    'PAGE_LENGTH_ADVANCE' => '25',
    'STATIC_DATATABLE_PAGE_LENGTH' => '10',
    'user_image_thumb' => 150,
    'user_image_preview' => 300,
    'banner_image_thumb' => 200,
    'banner_image_preview' => 600,
    'blog_image_thumb' => 200,
    'blog_image_preview' => 600,
    'photo1_image_thumb' => 250,
    'photo1_image_preview' => 500,
    'photo2_image_thumb' => 100,
    'photo2_image_preview' => 600,
    'photo3_image_thumb' => 200,
    'photo3_image_preview' => 600,
    'home_menu_no' => 5,
    'home_banner_no' => 1,
    'home_client_no' => 4,
    'home_workcat_no' => 8,
    'home_client_testimonial_no' => 6,
    'home_audit_testimonial_no' => 6,
    'home_howitworks_no' => 4,
    'partner_image_thumb' => 250,
    'partner_image_preview' => 500,
    'speaker_image_thumb' => 100,
    'speaker_image_preview' => 300,
    'howit_work_thumb' => 150,
    'howit_work_preview' => 250,
    'member_pagination_limit' => 30,
    'pagination_limit' => 10,
    'trnsaction_pagination_limit' => 20,
    'rating_star_no' => 5,
    'paypal_connect' => 'http://www.karmickdev.com/workdeliver/ipn-connect',
    'paypal_escrow' => 'http://www.karmickdev.com/workdeliver/ipn-escrow',
    'paypal_release' => 'http://www.karmickdev.com/workdeliver/ipn-release-escrow',
    's3_folder' => 'test/',
  ),
  'cookie-consent' => 
  array (
    'enabled' => true,
    'cookie_name' => 'laravel_cookie_consent',
    'cookie_lifetime' => 7300,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'teachinns',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'teachinns',
        'username' => 'root',
        'password' => 'root',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'teachinns',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'teachinns',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'teachinns_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'disk' => 
  array (
    'get_material' => 'MATERIAL',
    'get_course' => 'COURSE',
    'get_mentor' => 'MENTOR',
    'get_article_image' => 'ARTICLE IMAGE',
    'get_article_file' => 'ARTICLE FILE',
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/iipars/ugcnet/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/iipars/ugcnet/storage/app/public',
        'url' => 'http://teachinns.com/storage',
        'visibility' => 'public',
      ),
      'banner' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/iipars/ugcnet/storage/uploads/banner',
        'url' => 'http://teachinns.com/storage/uploads/banner',
        'visibility' => 'public',
      ),
      'MATERIAL' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/iipars/ugcnet/storage/uploads/materials',
        'url' => 'http://teachinns.com/storage/uploads/materials',
        'visibility' => 'public',
      ),
      'COURSE' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/iipars/ugcnet/storage/uploads/courses',
        'url' => 'http://teachinns.com/storage/uploads/courses',
        'visibility' => 'public',
      ),
      'MENTOR' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/iipars/ugcnet/storage/uploads/mentors',
        'url' => 'http://teachinns.com/storage/uploads/mentors',
        'visibility' => 'public',
      ),
      'ARTICLE IMAGE' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/iipars/ugcnet/storage/uploads/articles/images',
        'url' => 'http://teachinns.com/storage/uploads/articles/images',
        'visibility' => 'public',
      ),
      'ARTICLE FILE' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/iipars/ugcnet/storage/uploads/articles/files',
        'url' => 'http://teachinns.com/storage/uploads/articles/files',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/var/www/html/iipars/ugcnet/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/var/www/html/iipars/ugcnet/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/var/www/html/iipars/ugcnet/storage/logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'mail.teachinns.com',
    'port' => '465',
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Example',
    ),
    'encryption' => 'ssl',
    'username' => 'noreply@teachinns.com',
    'password' => '=^z6s_MW?bO@',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/var/www/html/iipars/ugcnet/resources/views/vendor/mail',
      ),
    ),
    'log_channel' => NULL,
  ),
  'path' => 
  array (
    'absolute_path' => '',
    'frontend_path' => '/iipars/ugcnet/public/frontend/',
    'assets_path' => '/iipars/ugcnet/public',
    'main_site_path' => '/',
    'user_image' => '/iipars/ugcnet/public/uploads/user_image/',
    'material_image' => 'storage/uploads/materials/',
    'partner_image' => '/iipars/ugcnet/public/uploads/partner_image/',
    'portfolio_image' => '/iipars/ugcnet/public/uploads/portfolio_image/',
    'hotel_image' => '/iipars/ugcnet/public/uploads/hotel_image/',
    'banner_image' => '/iipars/ugcnet/public/uploads/banner_image/',
    'project_image' => '/iipars/ugcnet/public/uploads/project_image/',
    'blog_image' => '/iipars/ugcnet/public/uploads/blog_image/',
    'cms_image' => '/iipars/ugcnet/public/uploads/cms_image/',
    'cms_banner_image' => '/iipars/ugcnet/public/uploads/cms_image/banner_image/',
    'request_quote' => '/iipars/ugcnet/public/uploads/request_quote/',
    'wc_icon_path' => '/iipars/ugcnet/public/uploads/category_images/',
    'speaker_image_path' => '/iipars/ugcnet/public/uploads/speaker_images/',
    'how_it_work_image_path' => '/iipars/ugcnet/public/uploads/how_it_work_images/',
    'project_attachment' => '/iipars/ugcnet/public/uploads/project_attachment/',
    'resume_path' => '/iipars/ugcnet/public/uploads/resume/',
    'work_file' => '/iipars/ugcnet/public/uploads/work_file/',
    'proposal_file' => '/iipars/ugcnet/public/uploads/proposal_file/',
    'chat_image' => '/iipars/ugcnet/public/uploads/message_attachment/',
    'chat_thumbnails' => '/iipars/ugcnet/public/uploads/message_attachment/thumbnails/',
    'id_proof' => '/iipars/ugcnet/public/uploads/id_proof/',
    'police_report' => '/iipars/ugcnet/public/uploads/police_report/',
    'address_proof' => '/iipars/ugcnet/public/uploads/address_proof/',
    'course_image' => 'storage/uploads/courses/',
  ),
  'payment' => 
  array (
    'api_key' => 'rzp_test_N76afSguCDA0Cs',
    'api_secret' => 'Rp1iIlDMbTGBLJwvRHG927KU',
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'cookie',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/var/www/html/iipars/ugcnet/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'teachinns_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'usertype' => 1,
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/var/www/html/iipars/ugcnet/resources/views',
    ),
    'compiled' => '/var/www/html/iipars/ugcnet/storage/framework/views',
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => '/var/www/html/iipars/ugcnet/storage/fonts/',
      'font_cache' => '/var/www/html/iipars/ugcnet/storage/fonts/',
      'temp_dir' => '/tmp',
      'chroot' => '/var/www/html/iipars/ugcnet',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => true,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
    ),
    'send_logs_as_events' => true,
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'passport' => 
  array (
    'private_key' => NULL,
    'public_key' => NULL,
  ),
  'terbilang' => 
  array (
    'output' => 
    array (
      'date' => '{DAY} {MONTH} {YEAR}',
      'time' => '{HOUR} {SEPARATOR} {MINUTE} {MINUTE_LABEL} {SECOND} {SECOND_LABEL}',
    ),
    'short' => 'million',
    'period' => 
    array (
      'type' => 'DAY',
      'format' => '{YEAR} {MONTH} {DAY} {HOUR} {MINUTE} {SECOND}',
      'hide_zero_value' => true,
      'separator' => ' ',
      'terbilang' => false,
      'show' => 
      array (
        'year' => true,
        'month' => true,
        'day' => true,
        'hour' => true,
        'minute' => true,
        'second' => true,
      ),
    ),
  ),
  'captcha' => 
  array (
    'secret' => '6LehIOAUAAAAANeMsTdT0cY-6qWo7yrjGYqpkExz',
    'sitekey' => '6LehIOAUAAAAAG-Q18ug9MErIdWhkiUWgT06JPh5',
    'options' => 
    array (
      'timeout' => 30,
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
