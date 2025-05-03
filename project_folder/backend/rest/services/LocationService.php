<?php 
require_once __DIR__ . '/../dao/LocationDao.php';
require_once __DIR__ . '/BaseService.php';


class LocationService extends BaseService {
    public function __construct() {
        parent::__construct(new LocationDao());
    }

    private function validate_location($location) {
        if (!isset($location['name']) || trim($location['name']) === '') {
            throw new Exception("Location name is required.");
        }
    
        if (!isset($location['address']) || trim($location['address']) === '') {
            throw new Exception("Location address is required.");
        }
    
        if ($this->dao->get_by_name($location['name'])) {
            throw new Exception("Location with that name already exists.");
        }
    }

    public function add_location($location) {
        $this->validate_location($location);
        return $this->dao->add($location);
    }

    public function update_location($id, $location) {
        if (!isset($location['name']) || trim($location['name']) === '') {
            throw new Exception("Location name is required.");
        }
        return $this->dao->update($location, $id);
    }

}
?>