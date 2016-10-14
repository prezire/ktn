<?php defined('BASEPATH') OR exit('No direct script access allowed');

final class Report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function all()
    {
        return $this->db->get('reports');
    }
    private function savePhoto(array $values)
    {
        if(empty($values['photo']))
        {
            return '';
        }
        else
        {
            $photoData = $values['photo'];
            $binaryData = base64_decode($photoData);
            $filename = generateToken(rand(0, 99999)) . '.jpg';
            $filePath = "./public/uploads/photos/{$filename}";
            file_put_contents($filePath, $binaryData);
            return $filePath;
        }
    }
    public function create(array $values)
    {
        //Replace new value of photo key,
        //which will be saved later on.
        $values['photo'] = $this->savePhoto($values);
        $this->db->insert('reports', $values);
        $id = $this->db->insert_id();
        return $this->read($id);
    }
    public function read($id)
    {
        return $this->db->get_where('reports', ['id' => $id]);
    }
    public function update($id, array $values)
    {
        $this->db->where('id', $id);
        return $this->db->update('reports', $values);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('reports');
    }
    public function search(array $values)
    {
        //Distance in KM.
        extract($values);
        //
        $s = "SELECT *, (6371 * acos(cos(radians($lat)) * cos(radians(lat)) * cos(radians(lng) - radians($lng)) + sin(radians($lat)) * sin(radians(lat)))) distance FROM reports WHERE description LIKE '%$keywords%' GROUP BY id HAVING distance < $distance ORDER BY distance LIMIT 0, 20";
        $result = $this->db->query($s)->result();
        showJsonView(['result' => $result]);
    }
}