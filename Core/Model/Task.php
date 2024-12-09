<?php
namespace ProjectA\Core\Model;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $table = 'tasks';
	protected $fillable = ['username', 'email', 'task_text', 'status'];
	public $timestamps = true;

	public static function getTaskById(int $id = 0)
	{
		return self::find($id);
	}
}
