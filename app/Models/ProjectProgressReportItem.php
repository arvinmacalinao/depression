<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectProgressReportItem extends Model
{
    use SoftDeletes;

    protected $table = 'psi_project_progress_report_items';
    const CREATED_AT = 'date_encoded';
    const UPDATED_AT = 'last_updated';
    protected $primaryKey = 'prjprogitem_id';
    protected $fillable = ['prjprogitem_accomplishment', 'prjprogitem_percentage', 'prjprogitem_cummulative', 'prjprogitem_expenditure', 'prjprogitem_remarks', 'prjprogtarget_id', 'prjprogrep_id', 'prj_id', 'region_id', 'synched', 'sync_date', 'date_encoded', 'last_updated', 'encoder', 'updater', 'deleted_at'];

}
