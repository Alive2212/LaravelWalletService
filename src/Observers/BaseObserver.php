<?php
/**
 * Created by PhpStorm.
 * User: alive
 * Date: 12/14/17
 * Time: 6:49 AM
 */

/** User Manual
 *  Base Observer Help to create event listener simple
 * 1- add what event you want into event service provider with this convention
 * 'App\Events\{model}{method}Event' => [
 * 'App\Listeners\{model}{method}Listener',
 * ],
 * 2- generate events
 * 3- extend all event with 'BaseModelEvent' and remove all code
 * 4- get model in listener class with following command
 * $event->getModel();
 * 5- add observer class into boot method of model
 */

namespace Alive2212\LaravelWalletService\Observers;


use Alive2212\LaravelStringHelper\StringHelper;

class BaseObserver
{
    protected $eventNamePrefix = 'Alive2212\\LaravelWalletService\\Events\\';

    /**
     * @param $model
     */
    public function creating($model)
    {
        $this->callEvent($model);
    }

    /**
     * @param $params
     */
    public function callEvent(...$params)
    {
        $eventName = $this->getEventListenerName();
        $this->messageHandler($params);
        if (class_exists($eventName)) {
            event(new $eventName($params));
        }
    }

    /**
     * @return string
     */
    public function getEventListenerName()
    {
        $calledClass = (str_replace('Observer', '', collect(explode('\\', get_class($this)))->last()));
        $calledMethod = (new StringHelper())->upperFirstLetter(debug_backtrace()[2]['function']);
        $eventName = $this->eventNamePrefix . $calledClass . $calledMethod . 'Event';
        return (string)$eventName;
    }

    /**
     * @param $model
     */
    public function created($model)
    {
        $this->callEvent($model);
    }

    /**
     * @param $model
     */
    public function updating($model)
    {
        $this->callEvent($model);
    }

    /**
     * @param $model
     */
    public function updated($model)
    {
        $this->callEvent($model);
    }

    /**
     * @param $model
     */
    public function saving($model)
    {
        $this->callEvent($model);
    }

    /**
     * @param $model
     */
    public function saved($model)
    {
        $this->callEvent($model);
    }

    /**
     * @param $model
     */
    public function deleting($model)
    {
        $this->callEvent($model);
    }

    /**
     * @param $model
     */
    public function deleted($model)
    {
        $this->callEvent($model);
    }

    /**
     * @param $model
     */
    public function restoring($model)
    {
        $this->callEvent($model);
    }

    /**
     * @param $model
     */
    public function restored($model)
    {
        $this->callEvent($model);
    }

    /**
     * For many to many relation
     * Before do it
     * Attaching
     *
     * @param $model
     * @param $relationName
     * @param $pivotIds
     * @param $pivotIdsAttributes
     */
    public function pivotAttaching($model, $relationName, $pivotIds, $pivotIdsAttributes)
    {
        $this->callEvent($model, $relationName, $pivotIds, $pivotIdsAttributes);
    }

    /**
     * For many to many relation
     * Before do it
     * Detaching
     *
     * @param $model
     * @param $relationName
     * @param $pivotIds
     * @param $pivotIdsAttributes
     */
    public function pivotDetaching($model, $relationName, $pivotIds, $pivotIdsAttributes)
    {
        $this->callEvent($model, $relationName, $pivotIds, $pivotIdsAttributes);
    }

    /**
     * For many to many relation
     * Before do it
     * Updating
     *
     * @param $model
     * @param $relationName
     * @param $pivotIds
     * @param $pivotIdsAttributes
     */
    public function pivotUpdating($model, $relationName, $pivotIds, $pivotIdsAttributes)
    {
        $this->callEvent($model, $relationName, $pivotIds, $pivotIdsAttributes);
    }

    /**
     * For many to many relation
     * After it done
     * Attached
     *
     * @param $model
     * @param $relationName
     * @param $pivotIds
     * @param $pivotIdsAttributes
     */
    public function pivotAttached($model, $relationName, $pivotIds, $pivotIdsAttributes)
    {
        $this->callEvent($model, $relationName, $pivotIds, $pivotIdsAttributes);
    }

    /**
     * For many to many relation
     * After it done
     * Detached
     *
     * @param $model
     * @param $relationName
     * @param $pivotIds
     * @param $pivotIdsAttributes
     */
    public function pivotDetached($model, $relationName, $pivotIds, $pivotIdsAttributes)
    {
        $this->callEvent($model, $relationName, $pivotIds, $pivotIdsAttributes);
    }

    /**
     * For many to many relation
     * After it done
     * Updated
     *
     * @param $model
     * @param $relationName
     * @param $pivotIds
     * @param $pivotIdsAttributes
     */
    public function pivotUpdated($model, $relationName, $pivotIds, $pivotIdsAttributes)
    {
        $this->callEvent($model, $relationName, $pivotIds, $pivotIdsAttributes);
    }

    /**
     * @return string
     */
    public function getEventNamePrefix()
    {
        return $this->eventNamePrefix;
    }

    /**
     * @param string $eventNamePrefix
     */
    public function setEventNamePrefix($eventNamePrefix)
    {
        $this->eventNamePrefix = $eventNamePrefix;
    }

    /**
     * @param $params
     */
    public function messageHandler($params)
    {
    }
}
