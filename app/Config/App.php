<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /** Application URL when served by XAMPP/Apache. */
    public string $baseURL = 'http://localhost/Caburao_DemoElectric/';

    /** @var list<string> */
    public array $allowedHostnames = [];

    public string $indexPage = '';

    public string $uriProtocol = 'REQUEST_URI';

    public string $permittedURIChars = 'a-z 0-9~%.:_\-';

    public string $defaultLocale = 'en';

    public bool $negotiateLocale = false;

    /** @var list<string> */
    public array $supportedLocales = ['en'];

    public string $appTimezone = 'Asia/Manila';

    public string $charset = 'UTF-8';

    public bool $forceGlobalSecureRequests = false;

    /** @var array<string, string> */
    public array $proxyIPs = [];

    public bool $CSPEnabled = false;
}
