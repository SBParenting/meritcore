<?php namespace App\Libraries\State;

use Illuminate\Config\Repository as Config;
use Illuminate\Session\SessionManager  as Session;
use Illuminate\View\Factory as View;

class State {

    protected $config;

    protected $session;

    protected $view;

    protected $page;

    protected $defaults;
    
    public function __construct(Config $config, Session $session, View $view)
    {
        $this->config = $config; 

        $this->session = $session;

        $this->view = $view;
    }

    public function page($page)
    {
        $this->page = str_replace('/', '_', $page);

        foreach ($this->config->get('state.fields') as $key)
        {
            if (array_key_exists($key, $_GET))
            {
                if ($_GET[$key] == 'clear')
                {
                    $this->session->forget("$this->page.$key");
                }
                else
                {
                    $this->session->put("$this->page.$key", $_GET[$key]);   
                }
            }
        }

        return $this;
    }

    public function get($key, $default=null)
    {
        return $this->session->has("$this->page.$key") ? $this->session->get("$this->page.$key") : $this->getDefault($key, $default);
    }

    public function view($extra=false)
    {
        $data = [];

        $state = [];

        $fields = $this->config->get('state.fields');

        if ($extra !== false && is_array($extra))
        {
            $fields = array_merge($fields, $extra);
        }

        foreach ($fields as $key)
        {
            array_set($data, $key, $this->get($key));

            if ($this->get($key))
            {
                array_set($state, $key, $this->get($key));                
            }
        }

        $this->view->share($data);

        $this->view->share(['state' => $state]);

        return $this;
    }

    public function format($return)
    {
        return is_array($return) ? (object)$return : $return;
    }

    public function set($default)
    {
        
        foreach ($default as $key => $row)
        {
            array_set($this->defaults, "$this->page.$key", $row);
        }

        return $this;
    }

    public function getDefault($key, $default=null)
    {
        return array_get($this->defaults, "$this->page.$key") ? array_get($this->defaults, "$this->page.$key") : $default;
    }
}