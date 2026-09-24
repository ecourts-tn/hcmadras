<?php

namespace App\Controllers;

use App\Models\Announcement;
use App\Models\Document;

/**
 * Legacy: search.php + getSearch.php (ILIKE across announcement/document).
 */
class Search extends BaseController
{
    public function index()
    {
        return view('layouts/main', $this->data)
            . view('cms/search', $this->data)
            . view('layouts/footer', $this->data);
    }

    public function results()
    {
        $rules = ['search_for' => 'required|max_length[200]'];
        if (! $this->validate($rules)) {
            return redirect()->back()->with('error', 'Please enter a search term.');
        }

        $term = trim((string) $this->request->getPost('search_for'));
        $db   = db_connect('default');

        $this->data['term'] = $term;
        $this->data['results'] = array_merge(
            $db->table('announcement')
               ->select("an_id AS id, an_text AS text, an_icon_img, an_update_date, 'A' AS title")
               ->like('an_text', $term, 'both')
               ->where('display', 'Y')
               ->orderBy('an_update_date', 'DESC')
               ->get()->getResultArray(),
            $db->table('mhc_document')
               ->select('doc_id AS id, doc_title AS text, doc_icon AS an_icon_img, doc_f_date AS an_update_date, \'D\' AS title')
               ->like('doc_title', $term, 'both')
               ->where('display', 'Y')
               ->orderBy('doc_f_date', 'DESC')
               ->get()->getResultArray()
        );

        return view('layouts/main', $this->data)
            . view('cms/search_results', $this->data)
            . view('layouts/footer', $this->data);
    }
}
