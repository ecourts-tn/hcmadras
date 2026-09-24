<?php

namespace App\Models;

/**
 * Legacy: admin/function/ann_fun.php (class ANNOFUN), announcement_grid.php,
 * announcement_pdf.php, sidebar_r.php.
 * Tables: announcement + announcement_file (an_pdf stored in separate table).
 */
class Announcement extends BaseModel
{
    protected $table      = 'announcement';
    protected $primaryKey = 'an_id';
    protected $allowedFields = [
        'an_label', 'an_text', 'an_pdf_size', 'an_pdf_lanuage', 'an_update_date',
        'an_new_icon', 'an_archive', 'display', 'updateuser', 'an_order',
        'an_icon_img', 'ann_link', 'external_link',
    ];

    /** Public list – mirrors: select * from announcement where display='Y' order by an_order desc */
    public function activeList(): array
    {
        return $this->where("display", 'Y')
                    ->orderBy('an_order', 'DESC')
                    ->findAll();
    }

    public function getWithFile(int $id): ?array
    {
        $row = $this->find($id);
        if (! $row) {
            return null;
        }
        $file = db_connect('default')
            ->table('announcement_file')
            ->where('announc_id', $id)
            ->get()->getRowArray();
        if ($file) {
            $row['an_pdf'] = $file['an_pdf'];
        }
        return $row;
    }

    public function saveFile(int $announcementId, string $pdfData): void
    {
        db_connect('default')->table('announcement_file')->insertOrIgnore([
            'announc_id' => $announcementId,
            'an_pdf'     => $pdfData,
        ]);
    }
}
