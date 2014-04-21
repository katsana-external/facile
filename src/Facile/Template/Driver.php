<?php namespace Orchestra\Facile\Template;

use RuntimeException;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\View\Environment;
use Orchestra\Facile\Transformable;

abstract class Driver
{
    /**
     * View instance.
     *
     * @var \Illuminate\View\Environment
     */
    protected $view;

    /**
     * Transformable instance.
     *
     * @var \Orchestra\Facile\Transformable
     */
    protected $transformable;

    /**
     * List of supported format.
     *
     * @var array
     */
    protected $formats = array('html');

    /**
     * Default format.
     *
     * @var string
     */
    protected $defaultFormat = 'html';

    /**
     * Construct a new Facile service.
     *
     * @param  \Illuminate\View\Environment     $view
     * @param  \Orchestra\Facile\Transformable  $transformable
     */
    public function __construct(Environment $view, Transformable $tranformable = null)
    {
        $this->view = $view;
        $this->transformable = $tranformable ?: new Transformable;
    }

    /**
     * Get default format.
     *
     * @return string
     */
    public function getDefaultFormat()
    {
        return $this->defaultFormat;
    }

    /**
     * Compose requested format.
     *
     * @param  string   $format
     * @param  array    $compose
     * @return mixed
     * @throws \RuntimeException
     */
    public function compose($format, array $compose = array())
    {
        if (! in_array($format, $this->formats)) {
            return $this->composeError(null, array(), 406);
        } elseif (! method_exists($this, 'compose'.ucwords($format))) {
            throw new RuntimeException("Call to undefine method [compose".ucwords($format)."].");
        }

        $config = array_get($compose, "on.{$format}", array());

        return call_user_func(
            array($this, 'compose'.ucwords($format)),
            $compose['view'],
            $this->prepareDataValue($config, $compose['data']),
            $compose['status'],
            $config
        );
    }

    /**
     * Compose an error template.
     *
     * @param  mixed    $view
     * @param  array    $data
     * @param  integer  $status
     * @return \Illuminate\Http\Response
     */
    public function composeError($view, array $data = array(), $status = 404)
    {
        $engine = $this->view;

        $view = "{$status} Error";

        if ($engine->exists("error.{$status}")) {
            $view = $engine->make("error.{$status}", $data);
        }

        return new IlluminateResponse($view, $status);
    }

    /**
     * Transform given data.
     *
     * @param  mixed    $data
     * @return array
     */
    public function transformToArray($data)
    {
        return $this->transformable->run($data);
    }

    /**
     * Prepare data to be seen to template.
     *
     * @param  array   $config
     * @param  array   $data
     * @return mixed
     */
    protected function prepareDataValue(array $config, array $data)
    {
        $only   = array_get($config, 'only');
        $except = array_get($config, 'except');

        if (! is_null($only)) {
            return array_only($data, $only);
        } elseif (! is_null($except)) {
            return array_except($data, $except);
        }

        return $data;
    }
}
