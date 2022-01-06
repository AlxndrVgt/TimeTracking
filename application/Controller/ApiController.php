<?php

namespace Application\Controller;

use Avolutions\Controller\Controller;
use Avolutions\Orm\EntityCollection;

class ApiController extends Controller
{
    protected EntityCollection $EntityCollection;

    protected string $entity;

    public function __construct(EntityCollection $EntityCollection, string $entity)
    {
        $this->EntityCollection = $EntityCollection;
        $this->entity = $entity;
    }

    public function indexAction(): bool|string
    {
        $entities = $this->EntityCollection->getAll();

        return json_encode($entities, JSON_PRETTY_PRINT);
    }

    public function viewAction(int $id): bool|string
    {
        $entity = $this->EntityCollection->getById($id);

        if ($entity !== null) {
            return json_encode($entity, JSON_PRETTY_PRINT);
        } else {
            return interpolate('No Entity with id \'{0}\' found.', [$id]);
        }
    }

    public function deleteAction($id)
    {
        $entity = $this->EntityCollection->getById($id);

        if ($entity !== null) {
            $entity->delete();
        } else {
            return interpolate('No Entity with id \'{0}\' found.', [$id]);
        }
    }

    public function createAction(string $data): bool|string
    {
        $data = json_decode($data, true);

        $Entity = new ($this->entity)($data);
        if ($Entity->validate()) {
            $Entity->save();
            return json_encode($Entity);
        } else {
            return json_encode($Entity->getErrors());
        }
    }

    public function updateAction(int $id, string $data): bool|string
    {
        $Entity = $this->EntityCollection->getById($id);

        if ($Entity !== null) {
            $data = json_decode($data, true);
            $Entity->setValues($data);

            if ($Entity->validate()) {
                $Entity->save();
                return json_encode($Entity);
            } else {
                return json_encode($Entity->getErrors());
            }
        } else {
            return interpolate('No Entity with id \'{0}\' found.', [$id]);
        }
    }
}