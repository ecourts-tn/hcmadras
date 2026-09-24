<?php

namespace App\Controllers;

use App\Models\MenuContent;

/**
 * Legacy: menu-driven static pages whose body is stored in mhc_menu_content
 * and rendered with raw HTML (previously echoed straight from *_content.php
 * includes). Output is passed through the HTMLPurifier-style escaper where
 * possible; here we render trusted CMS HTML as-is like the original site.
 */
class Content extends BaseController
{
    public function show(string $slug)
    {
        $pages = model(MenuContent::class)->activeList();
        foreach ($pages as $page) {
            if ($this->slugify($page['title']) === $slug) {
                $this->data['page'] = $page;

                return view('layouts/main', $this->data)
                    . view('cms/page', $this->data)
                    . view('layouts/footer', $this->data);
            }
        }

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    private function slugify(string $text): string
    {
        $text = strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $text), '-'));
        return $text;
    }
}
