<?php

namespace App\Services\Base;

use App\Exceptions\CrudException;
use App\Services\Interfaces\BaseCrudServiceInterface;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseCrudService implements BaseCrudServiceInterface
{

    protected Model $model;

    protected function handle(Closure $callback)
    {
        try {
            return $callback();
        } catch (ModelNotFoundException $e) {
            $modelName = class_basename($this->model);
            throw new CrudException("{$modelName} Not Found", 404);
        } catch (\Throwable $e) {
            throw new CrudException('An unexpected error', 500);
        }
    }

    /**
     * Get paginated locations
     * 
     * @return LengthAwarePaginator The paginated list of  model
     */
    public function getAll()
    {
        return $this->handle(function () {
            return $this->model->paginate(10);
        });
    }

    /**
     * to get one model using id
     * 
     * @param string get model by id
     */
    public function get(string $id)
    {
        return $this->handle(function () use ($id) {
            return $this->model->findOrFail($id);
        });
    }

    /**
     * For store a new model
     * 
     * @param array $data To store the model
     */
    public function store(array $data)
    {
        return $this->handle(function () use ($data) {
            return $this->model->create($data);
        });
    }

    /**
     * For update a model
     * 
     * @param array $data To Update the model
     * @param string $id get model by id
     */
    public function update(array $data, string $id)
    {
        return $this->handle(function () use ($data, $id) {
            $model = $this->model->findOrFail($id);
            $model->update($data);
            return $model;
        });
    }

    /**
     *  Delete the specified model
     * 
     *  @param string $id get model by id
     *  @return bool|null True if the model was deleted, false otherwise
     */
    public function destroy(string $id)
    {
        return $this->handle(function () use ($id) {
            return $this->model->findOrFail($id)->delete();
        });
    }

    protected function createOrUpdateImage(Model $model, $file, string $folder = 'images')
    {
        $path = upload_img($file, $folder);
        $model->image()->updateOrCreate([], ['image_path' => $path]);
    }
}
