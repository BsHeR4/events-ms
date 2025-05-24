<?php

namespace App\Services\Interfaces;

interface BaseCrudServiceInterface
{
    public function getAll();
    public function get(string $id);
    public function store(array $data);
    public function update(array $data, string $id);
    public function destroy(string $id);
}
