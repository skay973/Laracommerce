<?php

namespace Gateways;

use Repositories\Product\IProductRepository;

class ProductGateway {

  protected $productRepository;

  function __construct(IProductRepository $productRepository) {
    $this->productRepository = $productRepository;
  }

  public function createProduct($input) {
    // Set the array to return
    $data = array();

		$rules = $this->productRepository->getRules();

		$messages = $this->productRepository->getMessages();

		$validator = \Validator::make($input, $rules, $messages);

		if ($validator->fails()) {
      $data['success'] = false;
      $data['message'] = $validator;
      return $data;

		}

    $this->productRepository->create($input);

    $data['success'] = true;

    return $data;

  }

  public function updateProduct($id, $input) {
    // Set the array to return
    $data = array();

    // Remove the image restriction to avoid the image update each time
		$rules = $this->productRepository->getRules();
		unset($rules['image']);

		$messages = $this->productRepository->getMessages();

		$validator = \Validator::make($input, $rules, $messages);

    if ($validator->fails()) {
			$data['success'] = false;
			$data['message'] = $validator;
      $data['productId'] = $input['id'];
			return $data;
		}

    $this->productRepository->update($id, $input);

    $data['success'] = true;

    return $data;

  }

  public function deleteProduct($id) {
    // Set the array to return
    $data = array();

		if (!$this->productRepository->delete($id)) {
      $data['success'] = false;
			return $data;
    }

    $data['success'] = true;

    return $data;

  }

  public function getAllProducts() {
    return $this->productRepository->all();
  }

  public function getProductById($id) {
    return $this->productRepository->find($id);
  }
}
