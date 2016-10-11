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
    public function create(array $data)
    {
        $this->db->insert('reports', $data);
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
      print_r($result);exit;
      //
      /*$locations = array();
      foreach($storedLocs as $l){
        $postId = $l->post_id;
        $locMeta = get_post_meta( $postId, 'location', true );
        $descrMeta = get_post_meta( $postId, 'description', true );
        $vidFeedUrl = get_post_meta( $postId, 'video_feed_url', true );
        array_push(
          $locations, array(
            'details' => $locMeta, 
            'description' => nl2br($descrMeta),
            'video_feed_url' => $vidFeedUrl
          )
        );
      }*/
    }
}