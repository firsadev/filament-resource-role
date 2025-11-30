<?php

namespace Firsadev\FilamentResourceRole\Traits;


trait HasAccesResources
{
    public function canAccessResource($resource,$action):bool
    {
        $res = $this->role->canAccesResources->where("name",$resource)->first();
        switch ($action) {
            case "viewAny":
                return $res->pivot->viewAny;
                break;
            case "view":
                return $res->pivot->view;
                break;
            case "create":
                return $res->pivot->create;
                break;
            case "update":
                return $res->pivot->update;
                break;
            case "delete":
                return $res->pivot->delete;
                break;
            case "restore":
                return $res->pivot->restore;
                break;
            case "forceDelete":
                return $res->pivot->forceDelete;
                break;
            default:
                false;
        }
        return false;
    }
}
