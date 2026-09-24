<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AuditTrail;

/**
 * Shared CRUD scaffolding for the converted admin modules. Each concrete
 * controller only declares its model class, view folder and audit label –
 * replacing the duplicated *_add/_edit/_del functions in admin/function/*.
 */
abstract class BaseCrud extends BaseController
{
    protected string $modelClass;
    protected string $viewPrefix;   // e.g. 'admin/announcement'
    protected string $itemLabel = 'record';
    protected array $validationRules = [];

    protected function redirectUrl(): string
    {
        return site_url($this->viewPrefix);
    }

    public function index()
    {
        $this->data['rows'] = model($this->modelClass)->orderBy(
            model($this->modelClass)->primaryKey,
            'DESC'
        )->findAll();

        return view($this->viewPrefix . '/index', $this->data);
    }

    public function create()
    {
        $this->data['row'] = null;
        return view($this->viewPrefix . '/form', $this->data);
    }

    public function store()
    {
        if (! $this->validate($this->validationRules)) {
            return redirect()->to($this->redirectUrl() . '/create')
                ->withInput()->with('errors', $this->validator->getErrors());
        }

        $id = model($this->modelClass)->insert($this->request->getPost());

        service('audit')->record(
            'Added new ' . $this->itemLabel,
            'INSERT ' . model($this->modelClass)->table,
            (int) $id
        );

        return redirect()->to($this->redirectUrl())->with('success', 'Added successfully.');
    }

    public function edit(int $id)
    {
        $this->data['row'] = model($this->modelClass)->find($id);
        if (! $this->data['row']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view($this->viewPrefix . '/form', $this->data);
    }

    public function update(int $id)
    {
        if (! $this->validate($this->validationRules)) {
            return redirect()->to($this->redirectUrl() . '/edit/' . $id)
                ->withInput()->with('errors', $this->validator->getErrors());
        }

        model($this->modelClass)->update($id, $this->request->getPost());

        service('audit')->record(
            'Updated ' . $this->itemLabel,
            'UPDATE ' . model($this->modelClass)->table . ' SET ... WHERE id=' . $id,
            $id
        );

        return redirect()->to($this->redirectUrl())->with('success', 'Updated successfully.');
    }

    public function delete(int $id)
    {
        model($this->modelClass)->delete($id);

        service('audit')->record(
            'Deleted ' . $this->itemLabel,
            'DELETE FROM ' . model($this->modelClass)->table . ' WHERE id=' . $id,
            $id
        );

        return redirect()->to($this->redirectUrl())->with('success', 'Deleted successfully.');
    }
}
