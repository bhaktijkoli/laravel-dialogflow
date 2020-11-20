<?php

namespace BhaktijKoli\LaravelDialogflow;

use Google\Cloud\Dialogflow\V2\EntityType;
use Google\Cloud\Dialogflow\V2\EntityTypesClient;

class EntityTypeHelper
{
    /**
     * Get Client
     *
     * @return \Google\Cloud\Dialogflow\V2\EntityTypesClient
     */
    public static function getClient()
    {
        return new EntityTypesClient([
            'credentials' => base_path('google-credentials.json')
        ]);
    }

    /**
     * Create Entity Type
     *
     * @param  string $name
     * @param  \Google\Cloud\Dialogflow\V2\EntityType\Entity[] $entities
     * @return \Google\Cloud\Dialogflow\V2\EntityType
     */
    public static function create($name, $entities)
    {
        $entityTypesClient = Self::getClient();
        $formattedParent = $entityTypesClient->agentName('doctorappointment-oidy');
        $entityType = new EntityType([
            'display_name' => $name,
            'kind' => 2,
            'enable_fuzzy_extraction' => true,
            'entities' => $entities,
        ]);
        return $entityTypesClient->createEntityType($formattedParent, $entityType);
    }

    /**
     * Get Entity Type TypeID
     *
     * @param  string $name
     * @return string
     */
    public static function getId($name)
    {
        $entityType = Self::get($name);
        if ($entityType === null) return null;
        $folders = explode('/', $entityType->getName());
        return $folders[count($folders) - 1];
    }

    /**
     * Get Entity Type
     *
     * @param  string $name
     * @return \Google\Cloud\Dialogflow\V2\EntityType
     */
    public static function get($name)
    {
        $entityTypesClient = Self::getClient();
        $formattedParent = $entityTypesClient->agentName('doctorappointment-oidy');
        $pagedResponse = $entityTypesClient->listEntityTypes($formattedParent);
        foreach ($pagedResponse->iterateAllElements() as $element) {
            if ($element->getDisplayName() === $name) {
                return $element;
            }
        }
        return null;
    }

    /**
     * Update Entity Type
     *
     * @param  string $name
     * @param  \Google\Cloud\Dialogflow\V2\EntityType\Entity[] $entities
     * @return \Google\Cloud\Dialogflow\V2\EntityType
     */
    public static function update($name, $entities)
    {
        $entityType = Self::get($name);
        if ($entityType === null) {
            return Self::create($name, $entities);
        } else {
            $entityTypesClient = Self::getClient();
            return  $entityTypesClient->updateEntityType($entityType);
        }
    }

    /**
     * Delete Entity Type
     *
     * @param  string $name
     * @return void
     */
    public static function delete($name)
    {
        $typeId = Self::getId($name);
        if ($typeId === null) {
            return null;
        } else {
            $entityTypesClient = Self::getClient();
            $formattedName = $entityTypesClient->entityTypeName('doctorappointment-oidy', $typeId);
            $entityTypesClient->deleteEntityType($formattedName);
        }
    }
}
