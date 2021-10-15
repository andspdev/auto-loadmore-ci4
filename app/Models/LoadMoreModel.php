<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class LoadMoreModel extends Model
{
    public function ambilData($limit, $start)
    {
        $builder    = $this->db->table('countries');
        $query      = $builder->select('code, name')
                        ->orderBy('name', 'ASC')
                            ->get($limit, $start)
                                ->getResult();
        return $query;
    }
}