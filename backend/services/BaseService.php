<?php

class BaseService {
    protected $dao;

    public function __construct($dao) {
        $this->dao = $dao;
    }

    public function getAll() {
        return $this->dao->getAll();
    }

    public function getById($id) {
        $result = $this->dao->getById($id);

        if (!$result) {
            throw new Exception("Record not found", 404);
        }

        return $result;
    }

    public function create($data) {
        return $this->dao->create($data);
    }

    public function update($id, $data) {
        $this->getById($id);

        return $this->dao->update($id, $data);
    }

    public function delete($id) {
        $this->getById($id);

        return $this->dao->delete($id);
    }
}
