<?php

namespace Gateways;

use Repositories\Category\ICategoryRepository;

class CategoryGateway {

  protected $categoryRepository;

  function __construct(ICategoryRepository $categoryRepository) {
    $this->categoryRepository = $categoryRepository;
  }

  public function createCategory($input) {
    $rules = $this->categoryRepository->getRules();

    $messages = $this->categoryRepository->getMessages();

    $validator = \Validator::make($input, $rules, $messages);

		if ($validator->fails()) {
      $data['success'] = false;
      $data['message'] = $validator;
      return $data;
		}

    $this->categoryRepository->create($input);

    $data['success'] = true;
    return $data;
  }

  public function deleteCategory($id) {
    // Set the array to return
    $data = array();

		if (!$this->categoryRepository->delete($id)) {
      $data['success'] = false;
			return $data;
    }

    $data['success'] = true;

    return $data;
  }

  public function getAllCategories($array = true) {
    if($array) {
      return $this->categoryRepository->allCategoriesToArray();
    } else {
      return $this->categoryRepository->all();
    }
  }

  public function getCategoryByID($id) {
    return $this->categoryRepository->find($id);
  }
}
